import { useEffect, useRef, useState } from "react"

const LazyImage = ({
	placeholderSrc,
	placeholderClassName,
	placeholderStyle,
	src,
	alt,
	className,
	style,
}) => {
	const [isLoading, setIsLoading] = useState(true)
	const [view, setView] = useState("")
	const placeholderRef = useRef(null)

	useEffect(() => {
		let options = {
			rootMargin: "10px 1px 3500px 1px",
		}
		const observer = new IntersectionObserver((entries) => {
			entries.forEach(function (entry) {
				if (entry.isIntersecting) {
					setView(src)
					try {
						observer.unobserve(placeholderRef.current)
					} catch (e) {
						console.log(src)
					}
				}
			})
		}, options)

		if (placeholderRef && placeholderRef.current) {
			observer.observe(placeholderRef.current)
		}
	}, [src])

	return (
		<>
			{isLoading && (
				<img
					src={placeholderSrc}
					alt=""
					className={className}
					style={placeholderStyle}
					ref={placeholderRef}
				/>
			)}
			<img
				src={view}
				className={className}
				style={isLoading ? { display: "none" } : style}
				alt={alt}
				onLoad={() => setIsLoading(false)}
			/>
		</>
	)
}

export default LazyImage
