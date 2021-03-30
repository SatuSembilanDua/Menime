
<?php
require('func.php');

$menime = json_decode(file_get_contents("data/menime.json") ,true);

if(isset($_GET['update'])){

echo "<pre>";
echo "<h4>Update Anime</h4><hr>";

foreach ($menime as $k => $v) {
	if($v['sts']==0 ){
		$list_episode = json_decode(file_get_contents("data/".$v['link'].".json") ,true);

		$le = file_get_contents("https://apimenime.herokuapp.com/eps_anime/".e_url($v['origin']));
		$le = json_decode($le, true);
		$le = array_values($le);
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
		/*pre($eps_baru_arr);
		pre($eps_lama);*/
		if($eps_baru>$eps_lama){
			$kur = $eps_baru-$eps_lama;
			echo "<strong>$v[judul]</strong><br>";
			$new = array_splice($le, 0, $kur);
			foreach ($new as $c => $d) {
				$eps = preg_replace('/\s+/', ' ', trim($d['eps']));
				$judul = trim($d['judul']);
				$new[$c]['eps'] = "Episode ".$eps;
				$new[$c]['judul'] = $judul;
				echo "- $eps, $judul <br>";
			}
			$list_episode = array_merge($new, $list_episode);
			//pre($list_episode);
			$myfile = fopen("data/".$v['link'].".json", "w") or die("Unable to open file!");
			fwrite($myfile, json_encode($list_episode));
			fclose($myfile);
		}
	}
}

echo "</pre>";
}
?>
