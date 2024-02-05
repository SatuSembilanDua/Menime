
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

export const parseEpisodes = (data) => {
	let tmp = []
	let ret = []
	data.map((dt) => {
		if(!tmp.includes(dt.eps)){
			tmp.push(dt.eps)
			ret.push(dt)
		}
	})
	return ret
}