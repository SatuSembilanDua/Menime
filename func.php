<?php

require('simplehtmldom/simple_html_dom.php');

function e_url( $s ) {
	return rtrim(strtr(base64_encode($s), '+/', '-_'), '='); 
}
 
function d_url($s) {
	return base64_decode(str_pad(strtr($s, '-_', '+/'), strlen($s) % 4, '=', STR_PAD_RIGHT));
}


function _filter_($arr){
	$ret = [];
	foreach ($arr as $k => $v) {
		if(strpos($v, 'lowongan') || strpos($v, 'iklan') || strpos($v, 'OneMangaDay')){
			//echo "$v <br>";
		}else{
			array_push($ret, $v);
		}
	}
	//print_r($ret) ;
	return $ret;
}


function _filter2($arr){
	$ret = [];
	foreach ($arr as $k => $v) {
		if(strpos($v, 'result')){
			array_push($ret, $v);
		}
	}
	if(sizeof($ret)==0){
		foreach ($arr as $k => $v) {
			if(strpos($v, 'creadit') || strpos($v, 'komen') || strpos($v, 'manga.png')){
			}else{
				array_push($ret, $v);
			}
		}	
	}
	//print_r($ret) ;
	return $ret;
}



/*
*
*
*
* //////////////////////////// ANIME AREA ///////////////////////////////////////
*
*
*
*
*/

function list_episode($url){
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	curl_setopt($ch, CURLOPT_PROXY, null);

	$data = curl_exec($ch);
	$info = curl_getinfo($ch);
	$error = curl_error($ch);

	curl_close($ch);
	$dom = new simple_html_dom(null, true, true, DEFAULT_TARGET_CHARSET, true, DEFAULT_BR_TEXT, DEFAULT_SPAN_TEXT);

	//$html = file_get_html($url);
	$html = $dom->load($data, true, true);
	$list_episode = array();

	foreach ($html->find(".episodelist") as $div) {
		foreach ($div->find("li") as $li) {
			$eps = $li->find(".leftoff",0);
			$judul = $li->find(".lefttitle",0);
			$dt = $li->find(".rightoff",0);
			array_push($list_episode, array(
											'link'	=> $eps->find("a",0)->href,
											'eps'	=> $eps->plaintext,
											'judul'	=> $judul->plaintext,
											'date'	=> $dt->plaintext
											));
		}
	}
	return $list_episode;
}


function list_episode_page($url){
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	//curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36");
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.87 Safari/537.36");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	curl_setopt($ch, CURLOPT_PROXY, null);

	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLINFO_HEADER_OUT, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER,
    array(
        "Upgrade-Insecure-Requests: 1",
        "User-Agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.87 Safari/537.36",
        "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3",
        "Accept-Language: en-US,en;q=0.9",
        "cookie: __cfduid=da5a43c33c765d8c5ecc8757d17acbaa21573400863; cf_clearance=dbdc95a38f52919ba3c14d5e8473195aa022b0e3-1573400868-0-150; _ga=GA1.2.1782458.1573400868; _gid=GA1.2.1987219291.1573400868; HstCfa4135177=1573400875080; HstCmu4135177=1573400875080; HstCnv4135177=1; HstCns4135177=1; __dtsu=1EE704453831C85D33301B0402D15797; __atuvc=3%7C46; __atuvs=5dc8312478a5a8d9002; HstCla4135177=1573401070454; HstPn4135177=3; HstPt4135177=3"
    ));

	$data = curl_exec($ch);
	$info = curl_getinfo($ch);
	$error = curl_error($ch);

	curl_close($ch);
	$dom = new simple_html_dom(null, true, true, DEFAULT_TARGET_CHARSET, true, DEFAULT_BR_TEXT, DEFAULT_SPAN_TEXT);

	//$html = file_get_html($url);
	$html = $dom->load($data, true, true);
	$list_episode = array();
	//echo $html;
	//echo htmlentities($html);
	foreach ($html->find(".episodelist") as $div) {
		$i=0;
		foreach ($div->find("li") as $li) {

			$eps = $li->find(".leftoff",0);
			$judul = $li->find(".lefttitle",0);
			$dt = $li->find(".rightoff",0);
			array_push($list_episode, array(
											'link'	=> $eps->find("a",0)->href,
											'eps'	=> $eps->plaintext,
											'judul'	=> $judul->plaintext,
											'date'	=> $dt->plaintext
											));

			if($i==10){
				return $list_episode;
			}
			$i++;
		}
	}
}


function list_anime($url){
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	curl_setopt($ch, CURLOPT_PROXY, null);

	$data = curl_exec($ch);
	$info = curl_getinfo($ch);
	$error = curl_error($ch);

	curl_close($ch);
	$dom = new simple_html_dom(null, true, true, DEFAULT_TARGET_CHARSET, true, DEFAULT_BR_TEXT, DEFAULT_SPAN_TEXT);

	//$html = file_get_html($url);
	$html = $dom->load($data, true, true);
	$list_anime = array();
	foreach ($html->find('.idframe') as $vid) {
		$list_anime['video'] = $vid->attr["src"];
	}
	
	
	return $list_anime;

}

/*$anime = list_anime("https://www.oploverz.in/samurai-x-episode-01-subtitle-indonesia/");
echo '<pre>';
print_r($anime);
echo '</pre>';*/

function anime_info($url){
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	curl_setopt($ch, CURLOPT_PROXY, null);

	$data = curl_exec($ch);
	$info = curl_getinfo($ch);
	$error = curl_error($ch);

	curl_close($ch);
	$dom = new simple_html_dom(null, true, true, DEFAULT_TARGET_CHARSET, true, DEFAULT_BR_TEXT, DEFAULT_SPAN_TEXT);

	//$html = file_get_html($url);
	$html = $dom->load($data, true, true);
	$info_anime = array();
	foreach ($html->find('.desc') as $con) {
		$info_anime['desc'] = htmlentities($con);
	}
	foreach ($html->find('.listinfo') as $con) {
		$info_anime['info'] = htmlentities($con);
	}
	foreach ($html->find('.imgdesc') as $con) {
		/*$a = file_get_contents($s->src);
				$src =  base64_encode($a);*/
		foreach ($con->find('img') as $im) {
			//echo $im->src;
			$a = file_get_contents($im->src);
			$src =  base64_encode($a);
			$info_anime['img'] = $src;
			//echo '<img src="data:image/gif;base64,'.$src.'"> ';
		}
	}
	
	
	return $info_anime;

}
/*$anime = anime_info("https://www.oploverz.in/series/boruto-naruto-next-generations/");
echo '<pre>';
print_r($anime);
echo '</pre>';*/

function list_anime2($url){
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	curl_setopt($ch, CURLOPT_PROXY, null);
	curl_setopt($ch, CURLOPT_HTTPHEADER,
	    array(
	        "Upgrade-Insecure-Requests: 1",
	        "User-Agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.87 Safari/537.36",
	        "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3",
	        "Accept-Language: en-US,en;q=0.9",
	        "cookie: __cfduid=d463c2c74b8cb4ad701c41487ef15ba271592223878; PHPSESSID=cq1245ofoi0qab5gun4lqfj365; _ga=GA1.2.205899321.1592223880; _gid=GA1.2.1323666345.1592223880; HstCfa4237846=1592223880537; HstCmu4237846=1592223880537; c_ref_4237846=https%3A%2F%2Fwww.google.com%2F; __dtsu=1040159222388239E79CA78CAA0D19A1; HstCnv4237846=2; _gat_gtag_UA_126097535_3=1; HstCla4237846=1592234566756; HstPn4237846=6; HstPt4237846=14; HstCns4237846=3"
	    ));

	$data = curl_exec($ch);
	$info = curl_getinfo($ch);
	$error = curl_error($ch);

	curl_close($ch);
	$dom = new simple_html_dom(null, true, true, DEFAULT_TARGET_CHARSET, true, DEFAULT_BR_TEXT, DEFAULT_SPAN_TEXT);
	
	$html = $dom->load($data, true, true);
	$a = array();
	$a["html"] = htmlentities($html);
	foreach ($html->find("#tontonin") as $div) {
		/*echo "<pre>";
		echo htmlentities($div);
		echo "</pre>";*/
		//return array("video" => e_url("http://".$div->attr["src"]));
		$a["video"] = e_url(htmlentities($div));
	}
	return $a;
	
}


/*$url = "https://anoboy.mobi/avatar-the-legend-of-aang-episode-01/";
//$url = "https://animenine.com/nonton-avatar-the-legend-of-aang-sub-indo/episode-60";
//$url = "https://www.oploverz.in/series/boruto-naruto-next-generations/";
$vid = list_anime2($url);
*/
function list_episode2($url){
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_PROXY, null);
	

	$data = curl_exec($ch);
	$info = curl_getinfo($ch);
	$error = curl_error($ch);

	curl_close($ch);
	$dom = new simple_html_dom(null, true, true, DEFAULT_TARGET_CHARSET, true, DEFAULT_BR_TEXT, DEFAULT_SPAN_TEXT);
	
	$html = $dom->load($data, true, true);
	$ls_eps = [];
	foreach ($html->find(".ep") as $div) {
		foreach ($div->find("a") as $a) {
			//echo $a->plaintext;
			$ls_eps[] = array(
								"judul" => $a->plaintext, 
								"link" => $a->attr["href"], 
								);
		}
	}
	return $ls_eps;
}

/*$url = "https://anoboy.mobi/anime/avatar-the-legend-of-aang/";
$vid = list_episode2($url);*/


?>
