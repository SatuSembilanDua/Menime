
<?php
require('func.php');
echo "<br>";

function anime_infox($url){
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
	$info_anime = array();
	/*
	// desc
	$entry_content = $html->find(".entry-content",0);
	//echo htmlentities($entry_content);

	//listinfo
	$ninfo = $html->find(".ninfo",0);
	//echo htmlentities($ninfo);
	
	$image = $html->find(".wp-post-image",0);
	//echo $image->src;
	*/

	$eplister = $html->find(".eplister",0);
	foreach ($eplister->find("li") as $li) {
		/*
		eps = li.find(class_="leftoff")
        judul = li.find(class_="lefttitle")
        dt = li.find(class_="rightoff")
        alink = eps.find("a")
		*/
		$eps = $li->find(".epl-num",0)->text();
		$judul = $li->find(".epl-title",0)->text();
		$dt = $li->find(".epl-date",0)->text();
		$alink = $li->find("a",0)->href;
		echo "$eps $judul $dt $alink";
		echo "<br>";
	}
}

//$a = anime_infox("https://oploverz.bz/anime/one-piece/");
//echo e_url("https://oploverz.bz/anime/one-piece/");
echo "<pre>";

$menime = json_decode(file_get_contents("data/menime.json") ,true);

/*
11 -> https://oploverz.bz/anime/one-piece/
18 -> https://oploverz.bz/anime/one-punch-man-season-2/
*/

print_r($menime);



/*
foreach ($menime as $k => $v) {
	if($v['src']==1){
		$ori = $v['origin'];
		$oar = explode("/", $ori);
		$oar[2] = "oploverz.bz";
		$oar[3] = "anime";
		$jadi = join("/",$oar);
		
		$menime[$k]["origin"] = $jadi;
		//print_r($v);
	}
}
print_r($menime)*/;
/*$myfile = fopen("data/menime.json", "w") or die("Unable to open file!");
fwrite($myfile, json_encode($menime));
fclose($myfile);*/
if(isset($_GET['update'])){


echo "<h4>Update Anime</h4><hr>";

foreach ($menime as $k => $v) {
	if($v['sts']==0 ){
		/*print_r($v);
		echo "<hr>";*/
		$list_episode = json_decode(file_get_contents("data/".$v['link'].".json") ,true);


		/*echo $v['origin'];
		echo "<br>";
		echo e_url($v['origin']);
		echo "<br>";*/
		//$le = cek_update_anime_py($list_episode, $v['origin']);
		$le = file_get_contents("https://apimenime.herokuapp.com/eps_anime/".e_url($v['origin']));
		$le = json_decode($le, true);
		$le = array_values($le);
		unset($le[0]);
		//print_r($le);
		//unset($le[0]);
		$le = array_values($le);
		$eps_lama = (int)explode(" ", $list_episode[0]['eps'])[1];
		$eps_baru_arr = explode(" ", $le[0]['eps']);
		$eps_baru = $eps_lama;
		foreach ($eps_baru_arr as $a => $b) {
			if(is_numeric($b)){
				$eps_baru = (int)$b;
			}
		}
		$kur = 0;
		$new = [];
		if($eps_baru>$eps_lama){
			$kur = $eps_baru-$eps_lama;
			echo "<strong>$v[judul]</strong><br>";
			$new = array_splice($le, 0, $kur);
			foreach ($new as $c => $d) {
				$eps = preg_replace('/\s+/', ' ', trim($d['eps']));
				$judul = trim($d['judul']);
				$new[$c]['eps'] = $eps;
				$new[$c]['judul'] = $judul;
				echo "- $eps, $judul <br>";
			}
			$list_episode = array_merge($new, $list_episode);
			$myfile = fopen("data/".$v['link'].".json", "w") or die("Unable to open file!");
			fwrite($myfile, json_encode($list_episode));
			fclose($myfile);
		}
	}
}

}
?>
</pre>
