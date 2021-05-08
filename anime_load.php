<?php

require('func.php');

$menime_list = json_decode(file_get_contents("data/menime.json") ,true);

if(isset($_GET['a'])){
	$ml_current = $menime_list[$_GET['a']];
	if(isset($_GET['desc'])){
		$url = $ml_current['origin'];
		//pre($ml_current);
		if($ml_current["src"]==1 && $ml_current["link"]!="one_piece"){
			$anime = anime_info_py($url);
			$anime['img'] = "data:image/gif;base64,".$anime['img'];
			$ml_current['img'] = "data:image/gif;base64,".$anime['img'];
		}else{
			$anime = $ml_current;
		}
		$anime['desc'] = html_entity_decode($anime['desc']);
		$anime['info'] = html_entity_decode($anime['info']);

		$anime['desc'] = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $anime['desc']);

		$anime['desc'] = preg_replace("/\s+/", " ", $anime['desc']);
		$anime['info'] = preg_replace("/\s+/", " ", $anime['info']);
		//pre($anime);
		echo json_encode($anime);
	}

	if(isset($_GET['list'])){
		$list_episode = json_decode(file_get_contents("data/".$ml_current['link'].".json") ,true);
		
		if($ml_current['link']=="kekkaishi" || $ml_current['src']==5){
			$list_episode = $list_episode;
		}else{
			if($ml_current['sts']==0){
				$list_episode = cek_update_anime_py($list_episode, $ml_current['origin']);
			}
			$list_episode = array_reverse($list_episode);
		}
		$i=0;
		$table = [];
		foreach($list_episode as $k => $v){
			$judul = $v['judul'];
			$link  = "index.php?page=view_anime&sub=$_GET[a]&eps=$k";
			if(isset($v['sts'])){
				$judul .= '<img src="assets/img/new.gif" alt="New">';
				$jdl = e_url($v['judul']);
				$lnk = e_url($v['link']);
				$link = "index.php?page=view_anime&sub=$_GET[a]&eps=$k&judul=$jdl&link=$lnk";

				$table[] = array(
									"eps" => $v['eps'], "judul" => $judul, "jdl" => $jdl, "lnk" => $lnk, "link" => $link, "date" => $v['date'],
								);
			}else{
				$table[] = array(
									"eps" => $v['eps'], "judul" => $judul, "jdl" => e_url($v['judul']), "lnk" => e_url($v['link']), "link" => $link, "date" => $v['date'],
								);
			}
		}
		//pre($table);
		$ret = [];
		if($ml_current['sts']==0){
			$table = array_reverse($table);
		}
		foreach ($table as $k => $v) {
			$i = $k+1;
			$ret['data'][] = [
						$i,
						'<a href="'.$v['link'].'">'.$v['eps'].'</a>',
						'<a href="'.$v['link'].'">'.$v['judul'].'</a>',
						//$v['judul'],
						$v['date']
						];
		}
		echo json_encode($ret);
	}
}else if(isset($_GET['vid'])){
	$link = d_url($_GET['link']);
	$list_anime = list_anime_py($link);
	if($list_anime['error']!='' && isset($_GET['sub']) && $_GET['sub']==11){
		//echo "ROORROO";
		$opc = json_decode(file_get_contents("data/one_piece.json") ,true);
		$opc = array_reverse($opc);
		$eps = isset($_GET['eps'])?$_GET['eps']:0;
		//pre($opc);
		//pre($opc[$eps]);
		$list_anime = array("video"=> $opc[$eps]['vid'], 'error' => '');
	}
	echo json_encode($list_anime);
}else{
	//echo $curr_le['link'];

	$menime_list = json_decode(file_get_contents("data/menime.json") ,true);

	pre($menime_list);

	

}




	/*$menime_list = json_decode(file_get_contents("data/menime.json") ,true);
	$ml_current = $menime_list[11];
	$list_episode = json_decode(file_get_contents("data/".$ml_current['link'].".json") ,true);
	$origin = $ml_current['origin'];
	echo $origin;
	echo "<br>";
	echo e_url($origin);
	echo "<br>";
	//$le = list_episode_page($origin);
	$le = file_get_contents("http://127.0.0.1:5000/eps_anime/".e_url($origin));
	//unset($le[0]);
	$le = json_decode($le, true);
	$le = array_values($le);
	pre($le);
	echo "<br>";
	$eps_lama = (int)explode(" ", $list_episode[0]['eps'])[1];
	$eps_baru_arr = explode(" ", $le[0]['eps']);
	$eps_baru = $eps_lama;
	foreach ($eps_baru_arr as $k => $v) {
		if(is_numeric($v)){
			$eps_baru = (int)$v;
		}
	}
	echo "$eps_baru  $eps_lama"; 
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
	}
	//pre($list_episode);*/




?>


