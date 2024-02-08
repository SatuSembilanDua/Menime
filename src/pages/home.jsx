import { useEffect } from "react"
import { useState } from "react"
import ItemComponent from "../components/ItemComponent"
import BodyMain from "../components/BodyMain"

const Home = () => {
	const apiurl =
		"https://raw.githubusercontent.com/laserine32/menimedb/main/anime.json"
	const [animes, setAnimes] = useState([])

	useEffect(() => {
		fetch(apiurl)
			.then((response) => response.json())
			.then((data) => {
				setAnimes(data)
				sessionStorage.setItem("anime", JSON.stringify(data))
			})
	}, [apiurl])

	return (
		<>
			<BodyMain breadcrumb={[]}>
				<h1 className="page-title md:text-md text-sm">LIST ANIME</h1>
				<ItemComponent animes={animes} />
			</BodyMain>
		</>
	)
}

export default Home
