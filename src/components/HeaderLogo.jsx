import { Link } from "react-router-dom"
import LogoImage from "../assets/icons.webp"

const HeaderLogo = () => {
	return (
		<>
			<div className="HeaderLogo md:px-[100px] p-0 md:text-left text-center">
				<Link to={"/"}>
					<img
						src={LogoImage}
						alt="Menime Logo"
						className="h-[75px] my-[20px] md:mx-0 mx-auto"
					/>
				</Link>
			</div>
		</>
	)
}

export default HeaderLogo
