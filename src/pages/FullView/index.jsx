import {
	List,
	ArrowsOut,
	ArrowFatLeft,
	CaretDoubleLeft,
	CaretDoubleRight,
	ListDashes,
	MonitorPlay,
} from "@phosphor-icons/react"
import LogoImage from "../../assets/icons.webp"
import styles from "./FullView.module.css"
import { Link, useLocation, useNavigate } from "react-router-dom"
import { useEffect, useState, useRef } from "react"
import Loading from "../../components/Loading"
import NotFound from "../NotFound"

const useEventListener = (eventName, handler, element = window) => {
	const savedHandler = useRef()
	useEffect(() => {
		savedHandler.current = handler
	}, [handler])
	useEffect(() => {
		const eventListener = (event) => savedHandler.current(event)
		element.addEventListener(eventName, eventListener)
		return () => {
			element.removeEventListener(eventName, eventListener)
		}
	}, [eventName, element])
}

const FullView = () => {
	const KEYS = ["91", "[", "93", "]"]
	const menuContainer = useRef()
	const menu = useRef()
	const listEps = useRef()

	const [rawData, setRawData] = useState(false)
	const [episode, setEpisode] = useState([])
	const [animeSlug, setAnimeSlug] = useState("")
	const [animeJdl, setAnimeJdl] = useState("")
	const [btnNav, setBtnNav] = useState([])
	const [pageTitle, setPageTitle] = useState("")
	const [isError, setIsError] = useState(false)
	const location = useLocation()
	const navigate = useNavigate()

	const handler = ({ key }) => {
		if (KEYS.includes(String(key))) {
			if (key == "]") {
				navigate(`/fullview/${btnNav.next}`)
			}
			if (key == "[") {
				navigate(`/fullview/${btnNav.prev}`)
			}
		}
	}
	useEventListener("keydown", handler)

	useEffect(() => {
		const slug = location.pathname.split("/")[2].split("_")
		const eps_slug = slug.pop()
		const anime_slug = slug.join("_")
		setAnimeSlug(anime_slug)
		let doc_title = ""

		function getEps(data, asl, ongoing) {
			let ret = false
			if (ongoing) {
				data.reverse()
			}
			data.map((eps, i) => {
				if (eps.id_eps == eps_slug) {
					setEpisode(eps)
					const prev = data[i - 1] ? `${asl}_${data[i - 1].id_eps}` : ""
					const next = data[i + 1] ? `${asl}_${data[i + 1].id_eps}` : ""
					setBtnNav({ prev: prev, next: next })
					if (["ME0013", "ME0014"].includes(eps.id_anime)) {
						const part = data.filter((item) => item.eps.includes(eps.eps)).pop()
						const ids = data.findIndex(
							(item) => item.id_episode == part.id_episode,
						)
						const prev = data[ids - 1] ? `${asl}_${data[ids - 1].id_eps}` : ""
						const next = data[ids + 1] ? `${asl}_${data[ids + 1].id_eps}` : ""
						setBtnNav({ prev: prev, next: next })
					}
					ret = eps
					return
				}
			})
			// console.log(ret)
			if (!ret) setIsError(true)
			return ret
		}

		if (sessionStorage.getItem(anime_slug)) {
			const loc = JSON.parse(sessionStorage.getItem(anime_slug))
			setRawData(loc)
			const tmpeps = getEps(
				loc.episodes,
				anime_slug,
				loc.anime.sts == "1" ? false : true,
			)
			setAnimeJdl(loc.anime.judul_anime)
			doc_title = `${loc.anime.judul_anime}`
			let ket_sts =
				loc.anime.ket_sts == "3"
					? `${tmpeps.book} - ${tmpeps.eps} - ${tmpeps.judul}`
					: `${tmpeps.eps} - ${tmpeps.judul}`
			document.title = `Menime | ${doc_title} - ${ket_sts}`
			setPageTitle(ket_sts)
		} else {
			const apiurl =
				"https://raw.githubusercontent.com/laserine32/menimedb/main/"
			fetch(`${apiurl}${anime_slug}.json`)
				.then((response) => response.json())
				.then((data) => {
					setRawData(data)
					const tmpeps = getEps(
						data.episodes,
						anime_slug,
						data.anime.sts == "1" ? false : true,
					)
					sessionStorage.setItem(anime_slug, JSON.stringify(data))
					setAnimeJdl(data.anime.judul_anime)
					doc_title = `${data.anime.judul_anime}`
					let ket_sts =
						data.anime.ket_sts == "3"
							? `${tmpeps.book} - ${tmpeps.eps} - ${tmpeps.judul}`
							: `${tmpeps.eps} - ${tmpeps.judul}`
					document.title = `Menime | ${doc_title} - ${ket_sts}`
					setPageTitle(ket_sts)
				})
				.catch((err) => {
					console.log("ERROR MSG")
					console.log(err.message)
					setIsError(true)
				})
		}
	}, [location])

	const menuClick = () => {
		if (menuContainer.current.classList.contains("hidden")) {
			menuContainer.current.classList.toggle("block")
			menuContainer.current.classList.toggle("hidden")
			setTimeout(() => {
				// menu.current.style.width = "45%"
				menu.current.style.left = "0"
				listEps.current.classList.add("hidden")
			}, 210)
		} else {
			// menu.current.style.width = "0%"
			menu.current.style.left = "-1000px"
			setTimeout(() => {
				menuContainer.current.classList.toggle("block")
				menuContainer.current.classList.toggle("hidden")
			}, 210)
		}
	}

	const clickListEpisode = (e) => {
		e.preventDefault()
		listEps.current.classList.toggle("hidden")
	}

	const pencet = (e) => {
		console.log(e)
	}

	if (isError) return <NotFound />
	if (!episode) return <Loading />
	return (
		<>
			<iframe
				className="absolute t-0 l-0 h-dvh w-dvw"
				src={episode.vid}
				allowFullScreen={true}
			></iframe>
			<div className="absolute t-0 l-0 z-[9996] w-screen px-8 py-4">
				<div className="flex justify-between items-center gap-4 text-color-menime">
					<div>
						<button onClick={menuClick}>
							<List size={32} />
						</button>
					</div>
					<div>
						<h1 className="text-white">{pageTitle}</h1>
					</div>
					<div>
						<button>
							<ArrowsOut size={32} />
						</button>
					</div>
				</div>
			</div>
			<div className="hidden" ref={menuContainer}>
				<div
					className="fixed t-0 l-0 w-screen h-screen z-[9997] bg-black/80"
					onClick={menuClick}
				></div>
				<div
					className="menu-bar w-2/5 fixed h-screen bg-color-menime z-[9998] transition-[left] ease-in duration-200 overflow-hidden"
					ref={menu}
				>
					<div className="flex flex-col h-dvh">
						<div className="flex justify-center p-[20px] bg-[#222] border-solid border-b-2 border-black">
							<img src={LogoImage} alt="logo menime" className="w-1/2" />
						</div>
						<div>
							<MenuItem
								href={`/anime/${animeSlug}`}
								icon={<ArrowFatLeft size={24} weight="fill" />}
								text={"Kembali ke Normal"}
							/>
							<MenuItem
								href={`/fullview/${btnNav.prev}`}
								icon={<CaretDoubleLeft size={24} />}
								text={"Episode Sebelumnya"}
								onMClick={menuClick}
							/>
							<MenuItem
								href={`/fullview/${btnNav.next}`}
								icon={<CaretDoubleRight size={24} />}
								text={"Episode Berikutnya"}
								onMClick={menuClick}
							/>
							<Link to={"/"} onClick={(e) => clickListEpisode(e)}>
								<div className="flex items-center md:gap-8 gap-2 md:p-4 p-2 text-white hover:bg-[#222] transition-background ease-in duration-200">
									<ListDashes size={24} />
									<p className="md:text-xl text-xs">List Episode</p>
								</div>
							</Link>
						</div>
						<div
							className={`${styles.list_eps} ${styles.list_show} hidden overflow-y-auto`}
							ref={listEps}
						>
							{rawData.episodes?.map((eps, i) => {
								return (
									<MenuItem
										key={i}
										href={`/fullview/${rawData.anime.link_anime}_${eps.id_eps}`}
										text={eps.eps}
										icon={<MonitorPlay size={24} />}
										onMClick={menuClick}
										isActive={eps.id_eps == episode.id_eps ? true : false}
									/>
								)
							})}
						</div>
					</div>
				</div>
			</div>
		</>
	)
}

const MenuItem = ({ href, icon, text, onMClick, isActive }) => {
	const mia = useRef()
	let mcs =
		"flex items-center md:gap-8 gap-2 md:p-4 p-2 text-white hover:bg-[#222] transition-background ease-in duration-200"
	if (isActive) {
		mcs =
			"flex items-center md:gap-8 gap-2 md:p-4 p-2 text-white bg-[#222] transition-background ease-in duration-200"
	}

	// useEffect(() => {
	// 	if (isActive) {
	// 		mia.current.scrollIntoView(true)
	// 	}
	// }, [isActive, mia])

	return (
		<>
			<Link to={href} onClick={onMClick} ref={mia}>
				<div className={mcs}>
					{icon}
					<p className="md:text-xl text-xs">{text}</p>
				</div>
			</Link>
		</>
	)
}

export default FullView
