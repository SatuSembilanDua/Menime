export const unescapeHTML = (str) => {
	var htmlEntities = {
		nbsp: " ",
		cent: "¢",
		pound: "£",
		yen: "¥",
		euro: "€",
		copy: "©",
		reg: "®",
		lt: "<",
		gt: ">",
		quot: '"',
		amp: "&",
		apos: "'",
	}
	return str.replace(/\&([^;]+);/g, function (entity, entityCode) {
		var match

		if (entityCode in htmlEntities) {
			return htmlEntities[entityCode]
			/*eslint no-cond-assign: 0*/
		} else if ((match = entityCode.match(/^#x([\da-fA-F]+)$/))) {
			return String.fromCharCode(parseInt(match[1], 16))
			/*eslint no-cond-assign: 0*/
		} else if ((match = entityCode.match(/^#(\d+)$/))) {
			return String.fromCharCode(~~match[1])
		} else {
			return entity
		}
	})
}

export const parseEpisodes = (data, sort, search) => {
	let tmp = []
	let ret = []
	data.map((dt) => {
		if (!tmp.includes(dt.eps)) {
			tmp.push(dt.eps)
			ret.push(dt)
		}
	})
	if (sort) ret.reverse()
	if (search !== "") {
		ret = ret.filter(
			(itm) =>
				itm.eps.toLowerCase().includes(search.toLowerCase()) ||
				itm.judul.toLowerCase().includes(search.toLowerCase()),
		)
	}
	return ret
}
