<pre>
<?php
echo "<br>";

/*$data = json_decode(file_get_contents("data/menime.json") ,true);
$op = [array(
			"judul" => "One Piece",
			"link" => "one_piece",
			"origin" => "https://www.oploverz.in/series/one-piece-sub-indo/",
			"sts" => "2",
			"src" => "1",
			"img" => "https://cdn.myanimelist.net/images/anime/6/73245.jpg"
			)];
$start_data = array_slice($data,0, 8);
$end_data = array_slice($data,10);
$data = array_merge($start_data, $op, $end_data);*/
//print_r($data);
/*
$myfile = fopen("data/menime.json", "w") or die("Unable to open file!");
fwrite($myfile, json_encode($data));
fclose($myfile);
*/


/*$ani = json_decode(file_get_contents("../opmanga/anime.json") ,true);
//print_r(json_decode(file_get_contents("data/naruto.json") ,true));
$data = [];
foreach ($ani as $k => $v) {
	unset($ani[$k]['video']);
	$eps = preg_replace('/\s+/', ' ', trim($v['eps']));

	$data[] = array(
					'link' => $v['link'],
					'eps' => $eps,
					'judul' => trim($v['judul']),
					'date' => $v['date'],
					);	
}
print_r($data);*/
/*$data = json_decode(file_get_contents("data/one_piece.json") ,true);
$data = array_reverse($data);
print_r($data);*/
/*
$myfile = fopen("data/one_piece.json", "w") or die("Unable to open file!");
fwrite($myfile, json_encode($data));
fclose($myfile);
*/
/*$list_episode = json_decode(file_get_contents("data/one_piece.json") ,true);
$le = list_episode('https://www.oploverz.in/series/boruto-naruto-next-generations/');
foreach ($le as $k => $v) {
	$eps = preg_replace('/\s+/', ' ', trim($v['eps']));
	$judul = trim($v['judul']);
	$le[$k]['eps'] = $eps;
	$le[$k]['judul'] = $judul;
	
}
$myfile = fopen("data/boruto_naruto_next_generations.json", "w") or die("Unable to open file!");
fwrite($myfile, json_encode($le));
fclose($myfile);*/
/*
$list_episode = json_decode(file_get_contents("data/boruto_naruto_next_generations.json") ,true);
$le = list_episode_page('https://www.oploverz.in/series/boruto-naruto-next-generations/');
*/

/*$list_episode = json_decode(file_get_contents("data/one_piece.json") ,true);
$le = list_episode_page('https://www.oploverz.in/series/one-piece-sub-indo/');
$origin = 'https://www.oploverz.in/series/one-piece-sub-indo/';
//$list_episode = cek_update_anime($list_episode, $origin);

$eps_lama = (int)explode(" ", $list_episode[0]['eps'])[1];
	$eps_baru_arr = explode(" ", $le[0]['eps']);
	$eps_baru = $eps_lama;
	foreach ($eps_baru_arr as $k => $v) {
		if(is_numeric($v)){
			$eps_baru = (int)$v;
		}
	}
	$kur = 0;
	$new = [];
	if($eps_baru>$eps_lama){
		$kur = $eps_baru-$eps_lama;
		$new = array_splice($le, 0, $kur);
		foreach ($new as $k => $v) {
			$eps = preg_replace('/\s+/', ' ', trim($v['eps']));
			$judul = trim($v['judul']);
			$new[$k]['eps'] = $eps;
			$new[$k]['judul'] = $judul;
			$new[$k]['sts'] = '1';
			$new[$k]['div'] = $kur;
		}
		$list_episode = array_merge($new, $list_episode);
	}*/

/*
echo "eps_lama: $eps_lama<br>";
echo "eps_baru: $eps_baru<br>";
*/


/*if(sizeof($list_episode) != sizeof($le)){
	echo 'Tidak sama<br>';
	$kur =  sizeof($le) - sizeof($list_episode) - 3;
	echo "$kur";
	$div = array_splice($le, 0,  $kur);
	foreach ($div as $k => $v) {
		$eps = preg_replace('/\s+/', ' ', trim($v['eps']));
		$judul = trim($v['judul']);
		$div[$k]['eps'] = $eps;
		$div[$k]['judul'] = $judul;
		
	}
	$update = array_merge($div, $list_episode);
	print_r($update);
}*/

$menime = json_decode(file_get_contents("data/menime.json") ,true);
echo "<h4>Update Anime</h4><hr>";
foreach ($menime as $k => $v) {
	if($v['sts']==0){
		/*print_r($v);
		echo "<hr>";*/
		$list_episode = json_decode(file_get_contents("data/".$v['link'].".json") ,true);
		$le = list_episode_page($v['origin']);
		unset($le[0]);
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

?>
</pre>
