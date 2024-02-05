import { Link } from "react-router-dom"
import LazyImage from "../components/LazyImage"
import PlaceholderImage from "../assets/imgplaceholder.png"
import { PlayCircle, FilmStrip } from "@phosphor-icons/react"
import Loading from "./Loading"

const ItemComponent = ({ animes }) => {
	if (!animes || animes.length == 0) return <Loading />
	return (
		<>
			<div className="grid md:grid-cols-6 grid-cols-3 md:gap-6 gap-4">
				{animes.map((data) => {
					return (
						<div key={data.id_anime} className="group">
							<div className="relative overflow-hidden rounded-xl md:h-[20vw] h-[40vw]">
								<Link to={`/anime/${data.link_anime}`}>
									{/* <img
										src={data.gambar}
										alt={data.id_anime}
										className="group-hover:scale-125 h-full w-full transition-all ease-in-out duration-200 group-hover:blur-sm"
									/> */}
									<LazyImage
										src={data.gambar}
										alt={data.id_anime}
										placeholderSrc={PlaceholderImage}
										className="group-hover:scale-125 h-full min-w-full transition-all ease-in-out duration-200 group-hover:blur-sm"
									/>
									<div className="absolute top-0 left-0 w-full h-full bg-black/50 text-white justify-center items-center hidden group-hover:flex transition-all ease-in-out duration-1000">
										<PlayCircle size={56} weight="bold" />
									</div>
									{data.sts === "0" ? (
										<div className="absolute top-0 left-0 px-2 py-1 text-xs bg-color-menime text-white">
											ONGOING
										</div>
									) : (
										""
									)}
								</Link>
							</div>
							<div className="flex justify-start text-color-menime items-center overflow-hidden text-ellipsis whitespace-nowrap">
								<div className="mr-[5px]">
									<FilmStrip size={18} weight="thin" />
								</div>
								<div>
									<Link
										to={`/anime/${data.link_anime}`}
										aria-label={data.judul_anime}
									>
										<p className="text-white text-md">{data.judul_anime}</p>
									</Link>
								</div>
							</div>
						</div>
					)
				})}
			</div>
		</>
	)
}

export default ItemComponent
