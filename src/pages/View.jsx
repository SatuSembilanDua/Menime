import { useEffect, useState } from "react"
import { useLocation } from "react-router-dom"
import { CaretDoubleLeft, CaretDoubleRight } from "@phosphor-icons/react"
import { Link } from "react-router-dom"
import BodyMain from "../components/BodyMain"
import NotFound from "./NotFound"
import Loading from "../components/Loading"

const View = () => {
	const [rawData, setRawData] = useState(false)
	const [episode, setEpisode] = useState([])
	const [animeSlug, setAnimeSlug] = useState("")
	const [oriSlug, setOriSlug] = useState("")
	const [animeJdl, setAnimeJdl] = useState("")
	const [btnNav, setBtnNav] = useState([])
	const [pageTitle, setPageTitle] = useState("")
	const [isError, setIsError] = useState(false)
	const location = useLocation()

	useEffect(() => {
		const slug = location.pathname.split("/")[2].split("_")
		setOriSlug(slug.join("_"))
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
			fetch(`${import.meta.env.VITE_API_BASE_URL}/${anime_slug}.json`)
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

	if (isError) return <NotFound />
	if (!episode) return <Loading />

	return (
		<>
			<BodyMain
				breadcrumb={[
					{ name: animeJdl, type: animeSlug },
					{ name: episode.eps, type: "current" },
				]}
			>
				<h1 className="page-title">{pageTitle}</h1>
				<iframe
					className="md:h-[500px] h-[280px] my-4 w-full"
					src={episode.vid}
					allowFullScreen={true}
				></iframe>
				{!rawData ? "" : <PartBtn data={rawData} cureps={episode} />}
				<div className="grid grid-cols-3 py-4 text-sm">
					<Link
						to={`/view/${btnNav.prev}`}
						className={`btn btn-danger flex items-center justify-center rounded-l-sm ${btnNav.prev === "" ? "disabled" : ""}`}
					>
						<CaretDoubleLeft size={16} />
						<span className="md:block hidden">Episode Sebelumnya&nbsp;</span>
					</Link>
					<Link
						to={`/anime/${animeSlug}`}
						className="btn btn-danger2 md:text-md text-xs"
					>
						List Episode
					</Link>
					<Link
						to={`/view/${btnNav.next}`}
						className={`btn btn-danger flex items-center justify-center rounded-r-sm ${btnNav.next === "" ? "disabled" : ""}`}
					>
						<span className="md:block hidden">Episode Berikutnya&nbsp;</span>
						<CaretDoubleRight size={16} />
					</Link>
				</div>
				<div className="py-4 text-sm">
					<Link
						className="btn block w-full py-2 bg-color-biru text-center text-white rounded-sm hover:bg-color-biru/70 hover:text-white"
						to={`/fullview/${oriSlug}`}
					>
						Full Screen Mode
					</Link>
				</div>
			</BodyMain>
		</>
	)
}

const PartBtn = ({ data, cureps }) => {
	if (!data) return ""
	if (!["ME0013", "ME0014"].includes(data.anime.id_anime)) {
		return ""
	}
	const part = data.episodes.filter((item) => item.eps.includes(cureps.eps))
	// part.reverse()
	return (
		<>
			{part.map((btn, i) => {
				const btnLink = `/view/${data.anime.link_anime}_${btn.id_eps}`
				const dis = location.pathname == btnLink ? "disabled" : ""
				return (
					<Link key={i} to={btnLink} className={`btn btn-success mr-2 ${dis}`}>
						Part {i + 1}
					</Link>
				)
			})}
		</>
	)
}

export default View
