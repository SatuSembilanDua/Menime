
<?php

require('func.php');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: x-access-header, Authorization, Origin, X-Requested-With, Content-Type, Accept");

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
				$anime_txt = join(" ", explode("_", $_GET['a']));
			}
			$nav = '<li><a href="index.php">Home</a></li>';
			$nav .= '<li class="active">'.ucwords($anime_txt).'</li>';
			$title .= " | ".ucwords($anime_txt);
		}else{
			$inc = $p;
			$anime_txt = d_url($_GET['judul']);
			$sub = $_GET['sub'];
			$at = join(" ", explode("_", $sub));
			$nav = '<li><a href="index.php">Home</a></li>';
			$nav .= '<li><a href="index.php">'.ucwords($at).'</a></li>';
			$nav .= '<li class="active">'.trim($anime_txt).'</li>';
			$title .= " | ".ucwords($at)." ".ucwords($anime_txt);
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
	<nav class="navbar navbar-inverse navbar-main">
  		<div class="container-fluid">
	    	<!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		     	 <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
		      	</button>
		    </div>

		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      	<div class="container">
			      	<ul class="nav navbar-nav">
				        <!-- 
				        <li class="active"><a href="index.php">Home <span class="sr-only">(current)</span></a></li>
				         -->
			      	</ul>
		      	</div>
	    	</div><!-- /.navbar-collapse -->
	  	</div><!-- /.container-fluid -->
	</nav>
	<div class="container body-main">

	<?php
	?>
		<ol class="breadcrumb">
			<?php echo $nav; ?>
		  	<!-- 
		  	<li><a href="index.php">Home</a></li>
		  	<li><a href="#">Library</a></li>
		  	<li class="active">Data</li> -->
		</ol>
		<?php include $inc; ?>
	</div>
	<div class="footer">
		<div class="container">
			<div class="container">
				<div class="row">
					<div class="col-xs-6 footer-left">
						<h1>Menime</h1>
						<p>Powered by <a href="http://heroku.com/" target="blank">heroku</a></p>
					</div>
					
				</div>
				<div style="clear:both"></div>
			</div>
		</div>
	</div>
	<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>