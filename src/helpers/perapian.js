export const testUrl = async () => {
	const href = window.location.href
	let wlh = href.split("/")
	let baseurl = wlh[2].split(":")[0]
	let url = `http://${baseurl}:81/video/pro/api.php?d=stprm`
	console.log(`Perapian : ${href} ${baseurl} ${url}`)
	const response = await fetch(url)
  const data = await response.json()
  return data.result
}

export const getAninme = async (slug) => {
  const apiurl = "https://raw.githubusercontent.com/laserine32/menimedb/main/"
  const response = await fetch(`${apiurl}${slug}`)
  const data = await response.json()
  return data
}
