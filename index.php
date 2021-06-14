
<?php

require "config/config.php";

$title = "Menime ";
$og_desc = 'Menine Adalah Website Nonton Anime Subtitle Indonesia Gratis Disini Bisa Streaming.'; 
$og_img = 'menime.herokuapp.com/assets/img/logo.png'; 
$og_url = "https://menime.herokuapp.com/index.php";

$dir = "pages";
$nav = '<li class="active">Home</li>';
$inc = "$dir/home.php";

if(isset($_GET['page'])){
	$files = scandir($dir);
	unset($files[0], $files[1]);
	$file = $_GET["page"].".php";
	if(in_array($file, $files)){
		$inc = "$dir/$file";

		if($_GET["page"]=="anime"){
			if(isset($_GET['a'])){
				$id_anime = htmlspecialchars(d_url($_GET['a']));
				$q = $tb_menime->get_byid($id_anime);
				$ml_current = [];
				$row = $tb_menime->fetch_assoc($q);
				$anime_txt = $row['judul_anime'];
				$title .= "| $anime_txt";
				$nav .= '<li class="active">'.$anime_txt.'</li>';
			}
		}

		if($_GET["page"]=="view_anime"){
			if(isset($_GET["id"])){
				$id_episode = htmlentities(d_url($_GET["id"]));
				$src = htmlentities(d_url($_GET["src"]));
				$tbl = "";
				if($src==1){
					$tbl = "tb_episode";
				}else if($src==2){
					$tbl = "tb_onepiece";
				}else if($src==3){
					$tbl = "tb_avatar";
				}else if($src==4){
					$tbl = "tb_boruto";
				}
				$q = ${$tbl}->get_byid($id_episode);
				$row = ${$tbl}->fetch_assoc($q);
			 	$anime_txt = $row["eps"]." - ".$row["judul"];
				if($src==3){
					$anime_txt = $row["book"]." - ".$anime_txt;
				}
				$title .= "| $row[judul_anime] - $anime_txt";

				$nav .= '<li><a href="index.php?page=anime&a='.e_url($row["id_anime"]).'">'.$row['judul_anime'].'</a></li>';
				$nav .= '<li class="active">'.str_replace(" - ".$row["judul"], "", $anime_txt).'</li>';
			}
		}
	}else{
		$inc = "$dir/404.php";
	}
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
	<link rel="stylesheet" href="assets/css/style.css?t=<?= time(); ?>">
	

	<link rel="stylesheet" href="assets/css/dataTables.bootstrap.min.css">

    <script src="assets/js/jquery.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
						<a href="index.php?page=about&p=dmca">DMCA</a>
						&nbsp;|&nbsp;
						<a href="index.php?page=about&p=privacy">Privacy</a>
					</div>
				</div>
				<div style="clear:both"></div>
			</div>
		</div>
	</div>
	<script src="assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="assets/js/dataTables.bootstrap.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			var table = $('.myTable').DataTable({
				"lengthMenu": [[20, 50, 100, -1], [20, 50, 100, "All"]]
			});
			$(".table-list>tbody>tr").click(function(){
				var link = $(this).children().children().attr("href");
				window.location = link;
			});
		});
	</script>
</body>
</html>