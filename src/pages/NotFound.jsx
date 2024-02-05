import BodyMain from "../components/BodyMain"

const NotFound = () => {
	return (
		<>
			<BodyMain>
				<div className="text-center">
					<div className="error" data-text="404">
						404
					</div>
					<p className="lead">Page Not Found</p>
					<p className="error-desc">
						It looks like you found a glitch in the matrix...
					</p>
					<a href="/">&larr; Back to Home</a>
				</div>
			</BodyMain>
		</>
	)
}

export default NotFound
