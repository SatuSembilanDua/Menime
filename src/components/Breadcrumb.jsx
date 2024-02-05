import { Link } from "react-router-dom"

const Breadcrumb = ({ dataNav }) => {
	return (
		<>
			<ol className="breadcrumb py-[8px] md:pl-[100px] pl-[8px] bg-[#0a0909] border-b-4 border-color-menime md:text-md text-sm flex">
				<li>
					<Link to={"/"}>Home</Link>
				</li>
				<NavBread crnav={dataNav} />
			</ol>
		</>
	)
}

const NavBread = ({ crnav }) => {
	if (!crnav) return ""
	return (
		<>
			{crnav.map((e, i) => {
				if (e.type == "current") {
					return <li key={i}>{e.name}</li>
				} else {
					return (
						<li key={i}>
							<Link to={`/anime/${e.type}`}>{e.name}</Link>
						</li>
					)
				}
			})}
		</>
	)
}

export default Breadcrumb
