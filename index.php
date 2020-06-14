
<?php

require('func.php');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: x-access-header, Authorization, Origin, X-Requested-With, Content-Type, Accept");
$menime_list = json_decode(file_get_contents("data/menime.json") ,true);
$file = scandir(".");
unset($file[0], $file[1]);
$title = "Menine ";
$inc = '';
if(isset($_GET['page'])){
	$q = $_GET['page'];
	$p = $q.".php";
	if(in_array($p, $file)){
		if($q!="view_anime"){
			$inc = $p;
			$anime_txt = "";
			if(isset($_GET['a'])){
				$anime_txt = $menime_list[$_GET['a']]['judul'];
			}
			$nav = '<li><a href="index.php">Home</a></li>';
			$nav .= '<li class="active">'.ucwords($anime_txt).'</li>';
			$title .= " | ".ucwords($anime_txt);
		}else{
			$inc = $p;
			$sub = $_GET['sub'];
			$ml_current = $menime_list[$sub];
			if($ml_current['sts']==0){
				$anime_txt = d_url($_GET['judul']);
				$at = $ml_current['judul'];//join(" ", explode("_", $sub));
				$nav = '<li><a href="index.php">Home</a></li>';
				$nav .= '<li><a href="index.php?page=anime&a='.$sub.'">'.ucwords($at).'</a></li>';
				$nav .= '<li class="active">'.trim($anime_txt).'</li>';
				$title .= " | ".ucwords($at)." ".ucwords($anime_txt);
				$link = d_url($_GET['link']);
				$list_anime = list_anime($link);
			}else{
				$file = $ml_current['link'];
				$list_episode = json_decode(file_get_contents("data/".$file.".json") ,true);
				$list_episode = array_reverse($list_episode);
				$curr_le = $list_episode[$_GET['eps']];
				$anime_txt = $curr_le['eps']." - ".$curr_le['judul'];
				
				$at = $ml_current['judul'];//join(" ", explode("_", $sub));
				$nav = '<li><a href="index.php">Home</a></li>';
				$nav .= '<li><a href="index.php?page=anime&a='.$sub.'">'.ucwords($at).'</a></li>';
				$nav .= '<li class="active">'.trim($anime_txt).'</li>';
				$title .= " | ".ucwords($at)." ".ucwords($anime_txt);

				$ls_eps = "index.php?page=anime&a=$sub";
				$ep = $_GET['eps'];
				$seb = (int)$ep-1;
				$nex = (int)$ep+1;
				$dis = isset($list_episode[$seb])?'':'disabled';
				$disn = isset($list_episode[$nex])?'':'disabled';

				$list_anime = list_anime($curr_le['link']);
			}
		}
	}
}else{
	$inc = "home.php";
	$nav = '<li  class="active">Home</li>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Chrome, Firefox OS and Opera -->
	<meta name="theme-color" content="#7A101C">
	<!-- Windows Phone -->
	<meta name="msapplication-navbutton-color" content="#7A101C">
	<!-- iOS Safari -->
	<meta name="apple-mobile-web-app-status-bar-style" content="#7A101C">
	<title><?= $title; ?></title>
	<link rel="shortcut icon" href="assets/img/logo.png" type="image/x-icon"/>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/font-awesome.css">
	<link rel="stylesheet" href="assets/css/style.css">
	
    <script src="assets/js/jquery.min.js"></script>
</head>
<body>
	<div class="container header-main">
		<a href="index.php">
			<img src="assets/img/icons.png" alt="Logo" height="75px" style="margin:20px 0;">
		</a>
	</div>
	<ol class="breadcrumb">
		<?php echo $nav; ?>
	</ol>
	<div class="container body-main">
		<?php include $inc; ?>
	</div>
	<div class="footer">
		<div class="container">
			<div class="container">
				<div class="row">
					<div class="col-xs-6 footer-left">
						<h1>Menime</h1>
						<p>Powered by <a href="http://heroku.com/" target="blank" style="color:#337ab7;">heroku</a></p>
					</div>
					
				</div>
				<div style="clear:both"></div>
			</div>
		</div>
	</div>
	<script src="assets/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$(".table-list>tbody>tr").click(function(){
				var link = $(this).children().children().attr("href");
				window.location = link;
			});
		});
	</script>
</body>
</html>