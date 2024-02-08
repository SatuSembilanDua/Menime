import { Link } from "react-router-dom"
import LogoImage from "../assets/icons.webp"

const FooterComponent = () => {
	return (
		<>
			<div className="footerComp border-solid border-t-4 border-color-menime px-[15px]">
				<div className="grid md:grid-cols-2 grid-cols-1">
					<div className="py-8">
						<Link to={"/"} aria-label="home">
							<img
								src={LogoImage}
								alt="Menime Logo"
								className="h-[45px] my-[5px]"
							/>
						</Link>
						<p className="border-solid border-t-2 border-white mb-1 py-2">
							Copyright &copy; 2024 Menime. All Rights Reserved
							<br />
						</p>
						<p className="text-xs leading-1">
							Disclaimer: This site Menime does not store any files on its
							server. All contents are provided by non-affiliated third parties.
						</p>
					</div>
					<div className="py-[50px] px-[20px] text-right text-color-abu">
						<Link to={"/dmca"} aria-label="DMCA">
							DMCA
						</Link>
						&nbsp;|&nbsp;
						<Link to={"/privacy"} aria-label="Privacy">
							Privacy
						</Link>
					</div>
				</div>
			</div>
		</>
	)
}

export default FooterComponent
