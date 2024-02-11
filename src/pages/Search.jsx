import { useMemo, useEffect, useState } from "react"
import { useLocation } from "react-router-dom"
import BodyMain from "../components/BodyMain"
import NotFound from "./NotFound"
import Loading from "../components/Loading"
import ItemComponent from "../components/ItemComponent"

function useQuery() {
	const { search } = useLocation()
	return useMemo(() => new URLSearchParams(search), [search])
}

const Search = () => {
	let query = useQuery()
	const [animes, setAnimes] = useState(false)
	const [isNotFound, setIsNotFound] = useState(false)
	let queryParam = ""
	let queryParamValue = ""
	if (query.get("studio")) {
		queryParam = "Studio"
		queryParamValue = query.get("studio")
	} else if (query.get("season")) {
		queryParam = "Season"
		queryParamValue = query.get("season")
	} else if (query.get("tags")) {
		queryParam = "Tag"
		queryParamValue = query.get("tags")
	} else {
		return <NotFound />
	}

	useEffect(() => {
		const apiurl = `${import.meta.env.VITE_API_BASE_URL}/anime.json`
		fetch(apiurl)
			.then((response) => response.json())
			.then((data) => {
				let ret = []
				if (queryParam == "Studio") {
					console.log(queryParamValue)
					ret = data.filter((item) => item.studio.includes(queryParamValue))
				} else if (queryParam == "Season") {
					ret = data.filter((item) => item.season.includes(queryParamValue))
				} else if (queryParam == "Tag") {
					ret = data.filter((item) => item.tags.includes(queryParamValue))
				}
				setAnimes(ret)
				if (ret.length <= 0) setIsNotFound(true)
			})
		// console.log(queryParam, queryParamValue)
	}, [queryParam, queryParamValue])

	if (!animes) return <Loading />
	if (isNotFound) return <NotFound />

	return (
		<>
			<BodyMain>
				<h1 className="page-title">
					{queryParam} : {queryParamValue}
				</h1>
				<ItemComponent animes={animes} />
			</BodyMain>
		</>
	)
}

export default Search
