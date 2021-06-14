<?php
	//defined('BASEPATH') OR exit('No direct script access allowed');
	//session_start();
	date_default_timezone_set('Asia/jakarta');

	require_once("koneksi.php");

	$conf = array(
					'table' => 'anime', 
					'pk' => 'id_anime'
				);
	$tb_menime = new QueryBuilder($con, $conf);
	
	$tb_episode = new QueryBuilder($con, ["table" => "episodes", "pk" => "id_episode", "fk" => "id_anime", "join" => "anime"]);
	$tb_onepiece = new QueryBuilder($con, ["table" => "one_piece", "pk" => "id_episode", "fk" => "id_anime", "join" => "anime"]);
	$tb_boruto = new QueryBuilder($con, ["table" => "boruto", "pk" => "id_episode", "fk" => "id_anime", "join" => "anime"]);
	$tb_avatar = new QueryBuilder($con, ["table" => "avatar", "pk" => "id_episode", "fk" => "id_anime", "join" => "anime"]);

	function e_url( $s ) {
		return rtrim(strtr(base64_encode($s), '+/', '-_'), '='); 
	}
	 
	function d_url($s) {
		return base64_decode(str_pad(strtr($s, '-_', '+/'), strlen($s) % 4, '=', STR_PAD_RIGHT));
	}

	function base_url($url=""){
		$root = (isset($_SERVER['HTTPS']) ? "https://" : "http://").$_SERVER['HTTP_HOST'];
		$root .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
		//$config['base_url'] = "$root";
		return $root.$url;
	}


	function pre($isi){
		echo "<pre>";
		print_r($isi);
		echo "</pre>";
	}

	function msg($msg=[], $link=""){
		echo "<script>";

		if(!empty($msg) && $link!=""){
			$title = isset($msg["title"])?$msg["title"]:"Pesan";
			$msg = isset($msg["msg"])?$msg["msg"]:"";
			$type = isset($msg["type"])?$msg["type"]:"info";
			echo "swal(\"$title!\", \"$msg\", \"$type\");";
			echo "document.location=\"$link\";";
		}else if(!empty($msg) && $link==""){
			$title = isset($msg["title"])?$msg["title"]:"Pesan";
			$msg = isset($msg["msg"])?$msg["msg"]:"";
			$type = isset($msg["type"])?$msg["type"]:"info";
			echo "swal(\"$title!\", \"$msg\", \"$type\");";
		}else if(empty($msg) && $link!=""){
			echo "document.location=\"$link\";";
		}
		echo "</script>";
	}

	function gen_info($info, $tags){
		$ret = '<div class="ninfo">';
			$ret .= '<div class="info-content">';
				$ret .= '<div class="spe">';
				foreach ($info as $a => $b) {
					if($b!=""){
						$ret .= "<span><b>$a :</b> $b</span>";
					}
				}
				$ret .= '</div>';
				$ret .= '<div class="genxed">';
					foreach ($tags as $a => $b) {
						$ret .=  "<a href=\"".base_url("index.php?page=cari&tags=".e_url("$b"))."\" rel=\"rel\">$b</a>";
					}
				$ret .= '</div>';
			$ret .= '</div>';
		$ret .= '</div>';
		return $ret;
	}


	function gen_main_head($value=''){
		$title = "Menime ";
		$og_desc = 'Menine Adalah Website Nonton Anime Subtitle Indonesia Gratis Disini Bisa Streaming.'; 
		$og_img = 'menime.herokuapp.com/assets/img/logo.png'; 
		$og_url = "https://menime.herokuapp.com/index.php";
		$time = time();
		$ret = <<<EOF
			<!DOCTYPE html>
			<html lang="en">
			<head>
			    <meta charset="utf-8">
			    <meta http-equiv="X-UA-Compatible" content="IE=edge">
			    <meta name="viewport" content="width=device-width, initial-scale=1">
			    <!-- Chrome, Firefox OS and Opera -->
				<meta name="theme-color" content="#e50914">
				<!-- Windows Phone -->
				<meta name="msapplication-navbutton-color" content="#e50914">
				<!-- iOS Safari -->
				<meta name="apple-mobile-web-app-status-bar-style" content="#e50914">
				<meta property="og:url"           content="$og_url" />
			  	<meta property="og:type"          content="website" />
			  	<meta property="og:title"         content="$title" />
			  	<meta property="og:description"   content="$og_desc" />
			  	<meta property="og:image"         content="$og_img" />
				<title>$title</title>
				<link rel="shortcut icon" href="assets/img/logo.png" type="image/x-icon"/>
				<link rel="stylesheet" href="assets/css/bootstrap.min.css">
				<link rel="stylesheet" href="assets/css/font-awesome.css">
				<link rel="stylesheet" href="assets/css/style.css?t=$time">
				<link rel="stylesheet" href="assets/css/dataTables.bootstrap.min.css">
			    <script src="assets/js/jquery.min.js"></script>
				<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
			</head>
			EOF;
		return $ret; 
	}

	function gen_main_foot(){
		# code...
	}

	
?>