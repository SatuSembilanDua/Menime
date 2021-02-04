
<?php

require('func.php');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: x-access-header, Authorization, Origin, X-Requested-With, Content-Type, Accept");
$menime_list = json_decode(file_get_contents("data/menime.json") ,true);
$file = scandir(".");
unset($file[0], $file[1]);
$title = "Menine ";
$inc = '';
$og_desc = 'Menine Adalah Website Nonton Anime Subtitle Indonesia Gratis Disini Bisa Streaming.'; 
$og_img = 'menime.herokuapp.com/assets/img/logo.png'; 
$og_url = "https://menime.herokuapp.com/index.php";
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
			$file = $ml_current['link'];
			if(isset($_GET['judul'])){
				$curr_le['eps'] = "Episode ".$_GET['eps'];
				$anime_txt = $curr_le['eps']." - ".d_url($_GET['judul']);
				//$list_anime['video'] = d_url($_GET['link']);
				$list_anime = list_anime(d_url($_GET['link']));
			}else{
				$list_episode = json_decode(file_get_contents("data/".$file.".json") ,true);
				if($ml_current['link']=="avatar_the_legend_of_aang"){
					$curr_le = $list_episode[$_GET['eps']];
					$anime_txt = $curr_le['book']." : ".$curr_le['eps']." - ".$curr_le['judul'];
					$list_anime['thumb'] = $curr_le['thumb'];
					$list_anime['video'] = $curr_le['link'];
				}elseif($ml_current['link']=="avatar_the_legend_of_korra"){
					$curr_le = $list_episode[$_GET['eps']];
					$anime_txt = $curr_le['book']." : ".$curr_le['eps']." - ".$curr_le['judul'];
					$list_anime['thumb'] = $curr_le['thumb'];
					$list_anime['video'] = korra_vid($curr_le['link']);
					if($list_anime['video']=='embed'){
						$list_anime['video'] = $curr_le['link'];
						$ml_current['src']=1;
					}
				}elseif($ml_current['link']=="kekkaishi"){
					$curr_le = $list_episode[$_GET['eps']];
					$anime_txt = $curr_le['eps']." - ".$curr_le['judul'];
					$list_anime['thumb'] = $curr_le['thumb'];
					$list_anime['video'] = get_kekkaishi($curr_le['link']);
				}elseif(substr($ml_current['link'], 0, 11)=="dragon_ball"){
					$curr_le = $list_episode[$_GET['eps']];
					$anime_txt = $curr_le['judul'];
					//$list_anime['thumb'] = $curr_le['thumb'];
					$list_anime['video'] = get_dragonball($curr_le['link']);
				}else{
					$list_episode = array_reverse($list_episode);
					$curr_le = $list_episode[$_GET['eps']];
					$anime_txt = $curr_le['eps']." - ".$curr_le['judul'];
					echo $curr_le['link'];
					//$list_anime = list_anime($curr_le['link']);
					$list_anime = list_anime_py($curr_le['link']);
				}
				$ls_eps = "index.php?page=anime&a=$sub";
				$ep = $_GET['eps'];
				$seb = (int)$ep-1;
				$nex = (int)$ep+1;
				$dis = isset($list_episode[$seb])?'':'disabled';
				$disn = isset($list_episode[$nex])?'':'disabled';
			}

			$at = $ml_current['judul'];//join(" ", explode("_", $sub));
			$nav = '<li><a href="index.php">Home</a></li>';
			$nav .= '<li><a href="index.php?page=anime&a='.$sub.'">'.ucwords($at).'</a></li>';
			$nav .= '<li class="active">'.trim($curr_le['eps']).'</li>';
			$title .= " | ".ucwords($at)." ".ucwords($anime_txt);
		}
	}else{
		if($q=="dmca" || $q=="privacy"){
			$inc =  'about.php';
			$nav = '<li><a href="index.php">Home</a></li>';
			$nav .= '<li class="active">'.strtoupper($q).'</li>';
		}else{
			$inc = "404.php";
			$nav = '<li><a href="index.php">Home</a></li>';
			$nav .= '<li class="active">404</li>';
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
	<meta name="theme-color" content="#e50914">
	<!-- Windows Phone -->
	<meta name="msapplication-navbutton-color" content="#e50914">
	<!-- iOS Safari -->
	<meta name="apple-mobile-web-app-status-bar-style" content="#e50914">
	<meta property="og:url"           content="<?= $og_url; ?>" />
  	<meta property="og:type"          content="website" />
  	<meta property="og:title"         content="<?= $title; ?>" />
  	<meta property="og:description"   content="<?= $og_desc; ?>" />
  	<meta property="og:image"         content="<?= $og_img; ?>" />
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
						<a href="index.php">
							<h1>
							<img src="assets/img/icons.png" alt="Logo" height="45px" style="margin:5px 0;">
							</h1>
						</a>
						<p>Powered by <a href="http://heroku.com/" target="blank" style="color:#337ab7;">heroku</a></p>
					</div>
					<div class="col-xs-6 social-btn text-right">
						<a href="index.php?page=dmca">DMCA</a>
						&nbsp;|&nbsp;
						<a href="index.php?page=privacy">Privacy</a>
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