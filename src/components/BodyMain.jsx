import Breadcrumb from "./Breadcrumb"

const BodyMain = (props) => {
	return (
		<>
			<Breadcrumb dataNav={props.breadcrumb} />
			<div className="min-h-[540px] md:px-12 px-5 py-5 bg-color-hitam">
				{props.children}
			</div>
		</>
	)
}

export default BodyMain
