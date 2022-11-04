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
	$tb_spyxfamily = new QueryBuilder($con, ["table" => "spy_x_family", "pk" => "id_episode", "fk" => "id_anime", "join" => "anime"]);
	$tb_avatar = new QueryBuilder($con, ["table" => "avatar", "pk" => "id_episode", "fk" => "id_anime", "join" => "anime"]);
	$tb_spongebob = new QueryBuilder($con, ["table" => "spongebob", "pk" => "id_episode", "fk" => "id_anime", "join" => "anime"]);

	function e_url( $s ) {
		return rtrim(strtr(base64_encode($s), '+/', '-_'), '='); 
	}
	 
	function d_url($s) {
		return base64_decode(str_pad(strtr($s, '-_', '+/'), strlen($s) % 4, '=', STR_PAD_RIGHT));
	}

	function base_url($url=""){
		$root = "";
		if(check_local()){
			$root = (isset($_SERVER['HTTPS']) ? "https://" : "http://").$_SERVER['HTTP_HOST'];
		}else{
			$root = "https://".$_SERVER['HTTP_HOST'];
		}
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

	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	
	function gen_tab($c=1){
		$ret = "";
		for($i=0; $i<$c; ++$i){
			$ret .= "\t";
		}
		return $ret;
	}

	function get_client_ip() {
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
		   $ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'IP tidak dikenali';
		return $ipaddress;
	}

	function get_client_ip_2() {
		$ipaddress = '';
		if (isset($_SERVER['HTTP_CLIENT_IP']))
			$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else if(isset($_SERVER['HTTP_X_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		else if(isset($_SERVER['HTTP_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_FORWARDED'];
		else if(isset($_SERVER['REMOTE_ADDR']))
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		else
			$ipaddress = 'IP tidak dikenali';
		return $ipaddress;
	}

	function get_client_browser() {
		$browser = '';
		if(strpos($_SERVER['HTTP_USER_AGENT'], 'Netscape'))
			$browser = 'Netscape';
		else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox'))
			$browser = 'Firefox';
		else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome'))
			$browser = 'Chrome';
		else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Opera'))
			$browser = 'Opera';
		else if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE'))
			$browser = 'Internet Explorer';
		else
			$browser = 'Other';
		return $browser;
	}

	function getOS() { 
		global $user_agent;
		$os_platform  = "Unknown OS Platform";
		$os_array     = array(
							  '/windows nt 10/i'      =>  'Windows 10',
							  '/windows nt 6.3/i'     =>  'Windows 8.1',
							  '/windows nt 6.2/i'     =>  'Windows 8',
							  '/windows nt 6.1/i'     =>  'Windows 7',
							  '/windows nt 6.0/i'     =>  'Windows Vista',
							  '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
							  '/windows nt 5.1/i'     =>  'Windows XP',
							  '/windows xp/i'         =>  'Windows XP',
							  '/windows nt 5.0/i'     =>  'Windows 2000',
							  '/windows me/i'         =>  'Windows ME',
							  '/win98/i'              =>  'Windows 98',
							  '/win95/i'              =>  'Windows 95',
							  '/win16/i'              =>  'Windows 3.11',
							  '/macintosh|mac os x/i' =>  'Mac OS X',
							  '/mac_powerpc/i'        =>  'Mac OS 9',
							  '/linux/i'              =>  'Linux',
							  '/ubuntu/i'             =>  'Ubuntu',
							  '/iphone/i'             =>  'iPhone',
							  '/ipod/i'               =>  'iPod',
							  '/ipad/i'               =>  'iPad',
							  '/android/i'            =>  'Android',
							  '/blackberry/i'         =>  'BlackBerry',
							  '/webos/i'              =>  'Mobile'
						);

		foreach ($os_array as $regex => $value)
			if (preg_match($regex, $user_agent)){
				$os_platform = $value;
				if($value=="Android"){
					preg_match('/android ([0-9.]+)/i', $user_agent, $oa);
					$os_platform .= " ".$oa[1];
				}

			}

		return $os_platform;
	}

	function getBrowser() {
		global $user_agent;
		$browser        = "Unknown Browser";
		$browser_array = array(
								'/mobile/i'    		=> 'Handheld Browser',
								'/msie/i'      		=> 'Internet Explorer',
								'/firefox/i'   		=> 'Firefox',
								'/safari/i'    		=> 'Safari',
								'/chrome/i'    		=> 'Chrome',
								'/edge/i'      		=> 'Edge',
								'/opera/i'     		=> 'Opera',
								'/netscape/i'  		=> 'Netscape',
								'/maxthon/i'   		=> 'Maxthon',
								'/konqueror/i' 		=> 'Konqueror',
								'/edg/i'    		=> 'Edge',
								'/samsungbrowser/i'	=> 'Samsung Browser',
						 );

		foreach ($browser_array as $regex => $value)
			if (preg_match($regex, $user_agent))
				$browser = $value;

		return $browser;
	}

	function check_local(){
		$ipaddress = '';
		if (
				(getenv('HTTP_CLIENT_IP')) || 
				(getenv('HTTP_X_FORWARDED_FOR')) || 
				(getenv('HTTP_X_FORWARDED')) || 
				(getenv('HTTP_FORWARDED_FOR')) || 
				(getenv('HTTP_FORWARDED'))
			)
		   return false;
		else
		   return true;
	}

	if(isset($_GET["get_time"])){
		echo date("d-m-Y H:i:s");
	}

?>