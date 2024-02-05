import LoadingImage from "../assets/loading.svg"

const Loading = () => {
	return (
		<>
			<div className="flex justify-center">
				<img src={LoadingImage} alt="Loading..." />
			</div>
		</>
	)
}

export default Loading
