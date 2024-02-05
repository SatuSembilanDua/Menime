import { Routes, Route, Outlet } from "react-router-dom"
import HeaderLogo from "./components/HeaderLogo"
import FooterComponent from "./components/FooterComponent"
import Home from "./pages/home"
import About from "./pages/About"
import NotFound from "./pages/NotFound"
import Anime from "./pages/Anime"
import View from "./pages/View"
import Search from "./pages/Search"
import FullView from "./pages/FullView"

const App = () => {
	const MainLayout = () => {
		return (
			<>
				<HeaderLogo />
				<Outlet />
				<FooterComponent />
			</>
		)
	}

	return (
		<>
			<Routes>
				<Route path="/" element={<MainLayout />}>
					<Route path="/" element={<Home />} />
					<Route path="/anime/:slug" element={<Anime />} />
					<Route path="/view/:slug" element={<View />} />
					<Route path="/search/" element={<Search />} />
					<Route path="/dmca" element={<About halaman={"DMCA"} />} />
					<Route path="/privacy" element={<About halaman={"Privacy"} />} />
					<Route path="*" element={<NotFound />} />
				</Route>
				<Route path="/fullview/:slug" element={<FullView />} />
			</Routes>
		</>
	)
}

export default App
