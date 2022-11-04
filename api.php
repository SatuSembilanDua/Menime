<?php

require "config/config.php";

function null_safety($v){
	foreach($v as $k => $a){$v[$k] = $a==null?"":$a;}
	return $v;
}

function get_all(){
	$q = $GLOBALS['tb_menime']->get_where(["display" => 1]);
	if(check_local()){
		$q = $GLOBALS['tb_menime']->get_all();
	}
	$ret = [];
	//while($v = $GLOBALS['tb_menime']->fetch_assoc($q)){
	while($v = $q->fetchArray(SQLITE3_ASSOC)){
		$v["id_anime"] = e_url($v["id_anime"]);
		unset($v["origin"],$v["sts"],$v["src"],$v["ket_sts"],$v["display"]);

		$v['link_anime'] = base_url("anime/".$v['link_anime']);
		//foreach($v as $k => $a){$v[$k] = $a==null?"":$a;}
		array_push($ret, null_safety($v));
	}
	return $ret;
}

function get_anime($id){
	$slug = htmlentities($id);
	$q = $GLOBALS['tb_menime']->get_slug($slug);
	$row = $q->fetchArray(SQLITE3_ASSOC);
	if(is_array($row)){ 
		$id_anime = $row['id_anime'];
	}else{
		$id_anime = htmlspecialchars(d_url($_GET['a']));
		$q = $GLOBALS['tb_menime']->get_byid($id_anime);
		$row = $q->fetchArray(SQLITE3_ASSOC);	
	}
	$row['link_anime'] = base_url("anime/".$row['link_anime']);
	$status_table = $row["ket_sts"];
	$id_anime = $row["id_anime"];
	$list_anime = [];
	unset($row["origin"],$row["sts"],$row["src"],$row["display"],$row['ket_sts']);
	$row = null_safety($row);
	if($status_table==3){
		if($id_anime!="ME0021"){
			$q = $GLOBALS['tb_avatar']->get_byfk($id_anime);
		}else{
			$q = $GLOBALS['tb_spongebob']->get_byfk($id_anime);
		}
		$avatar = [];
		while($rowa = $q->fetchArray(SQLITE3_ASSOC)){
			$link = base_url("view/$rowa[link_anime]_$rowa[id_eps]&src=".e_url(($id_anime!='ME0021')?$status_table:$status_table+2));
			$avatar[$rowa["book"]][] = [
				"id_episode" => e_url($rowa['id_episode']),
				"eps" => $rowa['eps'],
				"judul" => $rowa['judul'],
				"date" =>  $rowa['date'],
				"id_eps" => $rowa['id_eps'],
				"link_eps" => $link,
			];
		}
		array_push($list_anime, $avatar);
	}else{
		if($status_table==2){
			$q = $GLOBALS['tb_onepiece']->get_all("WHERE anime.id_anime = '$id_anime' ORDER BY id_eps DESC ");
		}else if($status_table==4){
			$q = $GLOBALS['tb_boruto']->get_all("WHERE anime.id_anime = '$id_anime' ORDER BY id_eps DESC ");
		}else{
			$ideps_sepcial = ["ME0013", "ME0014"]; /* IF videos is parted */
			if(in_array($id_anime, $ideps_sepcial)){
				$q = $GLOBALS['tb_episode']->get_qwhere("anime.id_anime = '$id_anime' GROUP BY episodes.eps ORDER BY id_eps ASC");
			}else{
				$q = $GLOBALS['tb_episode']->get_byfk($id_anime);
			}
		}
		while($rowa = $q->fetchArray(SQLITE3_ASSOC)){

			$lkeps = explode(" ", $rowa["eps"])[1];
			$link = base_url("view/$rowa[link_anime]_$lkeps&src=".e_url($status_table));
			$tmp = [
				"id_episode" => e_url($rowa['id_episode']),
				"eps" => $rowa['eps'],
				"judul" => $rowa['judul'],
				"date" =>  $rowa['date'],
				"id_eps" => $rowa['id_eps'],
				"link_eps" => $link,
			];
			
			array_push($list_anime, $tmp);
		}
	}
	$row["anime_list"] = ["length" => sizeof($list_anime), "data" => $list_anime];
	return $row;
}


function display_result($data){
	if($GLOBALS['beauty']){
		//pre($data);
		pre(json_encode($data, JSON_PRETTY_PRINT));
	}else{
		echo json_encode($data, JSON_UNESCAPED_SLASHES);
	}	
}

/*===================================================================================*/
/*===================================================================================*/
/*===================================================================================*/
$beauty = false;
if (isset($_GET['beauty'])){
	$beauty = true;
}else{
	header('Content-Type: application/json; charset=utf-8');
}


if(isset($_GET['type'])){
	//print_r($_GET);
	//print_r(substr($_GET['type'],0,4));
	if($_GET['type']=="get"){
		$data = get_all();
		display_result($data);
	}else{
		$get = explode("/", $_GET['type']);
		if($get[0]=="anim"){
			$data = get_anime($get[1]);
			display_result($data);

		}
	}
}

?>