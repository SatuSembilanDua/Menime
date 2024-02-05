import { useEffect, useState } from "react"
import { useLocation } from "react-router-dom"
import { parseEpisodes, unescapeHTML } from "../helpers/aparser"
import parse from "html-react-parser"
import { Link } from "react-router-dom"
import { MonitorPlay } from "@phosphor-icons/react"
import BodyMain from "../components/BodyMain"
import Loading from "../components/Loading"
import NotFound from "./NotFound"

const Anime = () => {
	const [data, setData] = useState(false)
	const [episodes, setEpisodes] = useState([])
	const [isError, setIsError] = useState(false)
	const location = useLocation()

	useEffect(() => {
		const apiurl = "https://raw.githubusercontent.com/laserine32/menimedb/main/"
		const slug = location.pathname.split("/")[2]
		let doc_title = ""
		if (sessionStorage.getItem(slug)) {
			const loc = JSON.parse(sessionStorage.getItem(slug))
			setData(loc.anime)
			setEpisodes(parseEpisodes(loc.episodes))
			doc_title = loc.anime.judul_anime
			document.title = `Menime | ${doc_title}`
		} else {
			fetch(`${apiurl}${slug}.json`)
				.then((response) => response.json())
				.then((data) => {
					setData(data.anime)
					setEpisodes(parseEpisodes(data.episodes.reverse()))
					sessionStorage.setItem(slug, JSON.stringify(data))
					doc_title = data.anime.judul_anime
					document.title = `Menime | ${doc_title}`
				})
				.catch((err) => {
					console.log("ERROR MSG")
					console.log(err.message)
					setIsError(true)
				})
		}
	}, [location])

	if (isError) return <NotFound />
	// if (1=1) return (<Loading />)
	if (!data) {
		return (
			<BodyMain>
				<Loading />
			</BodyMain>
		)
	}

	return (
		<>
			<BodyMain breadcrumb={[{ name: data.judul_anime, type: "current" }]}>
				<h1 className="page-title">NONTON {data.judul_anime.toUpperCase()}</h1>
				<div className="grid grid-cols-12 gap-2 py-4">
					<div className="md:col-span-2 col-span-4">
						<img
							src={data.gambar}
							alt={data.judul_anime}
							className="w-full h-auto"
						/>
					</div>
					<div className="scroll-box md:col-span-10 col-span-8 pl-4 leading-5 text-md text-pretty md:overflow-y-visible overflow-y-scroll md:h-auto h-60">
						{parse(unescapeHTML(data.desc_anime))}
					</div>
				</div>
				<hr />
				<div className="bg-color-putih p-8 border-solid border-[#e0dfdf] my-4">
					<div className="spe columns-2 overflow-hidden mb-4 text-black">
						<Ninfo
							label="Status"
							value={data.sts == 1 ? "Complete" : "Ongoing"}
						/>
						<Ninfo label="Studio" value={data.studio} />
						<Ninfo label="Dirilis pada tahun" value={data.release_year} />
						<Ninfo label="Durasi" value={data.duration} />
						<Ninfo label="Season" value={data.season} />
						<Ninfo label="Tipe" value={data.tipe} />
						<Ninfo label="Episodes" value={data.episodes} />
						<Ninfo label="Dirilis pada" value={data.release_date} />
					</div>
					<AnimTags tags={data.tags} />
				</div>
				<h2 className="page-title">
					LIST EPISODE {data.judul_anime.toUpperCase()}
				</h2>
				<div className="scroll-box h-80 overflow-y-auto">
					{episodes.map((episode, i) => {
						const link = `/view/${data.link_anime}_${episode.id_eps}`
						let eps = episode.eps
						if (data.ket_sts == "3") {
							eps = `${episode.book} - ${episode.eps}`
						}
						return (
							<Link to={link} key={i}>
								<div className="flex gap-2 text-white hover:bg-color-menime py-1">
									<div className="flex-none basis-12">
										<MonitorPlay size={40} className="w-full" />
									</div>
									<div className="grow">
										<div className="flex justify-between text-xs">
											<p>{eps}</p>
											<span className="text-white/50 pr-2">{episode.date}</span>
										</div>
										<h3 className="md:text-md text-sm">{episode.judul}</h3>
									</div>
								</div>
							</Link>
						)
					})}
				</div>
			</BodyMain>
		</>
	)
}

const Ninfo = ({ label, value }) => {
	if (value == "") return ""
	if (label == "Studio" || label == "Season") {
		return (
			<>
				<span>
					<strong>{label} : </strong>
					<Link to={`/search?${label.toLowerCase()}=${value}`}>{value}</Link>
				</span>
			</>
		)
	}
	return (
		<>
			<span>
				<strong>{label} : </strong> {value}
			</span>
		</>
	)
}

const AnimTags = ({ tags }) => {
	if (!tags || tags == "") return ""
	return (
		<>
			{tags.split(";").map((tag, i) => {
				return (
					<Link
						key={i}
						to={`/search?tags=${tag.trim()}`}
						className="inline-block py-1 px-2 mx-1 border-solid border border-color-menime rounded-md text-xs hover:bg-color-menime hover:text-white"
					>
						{tag}
					</Link>
				)
			})}
		</>
	)
}

export default Anime
