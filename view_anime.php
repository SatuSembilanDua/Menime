<?php
	
?>
<pre>
<?= $list_anime['video']; ?><br>
<?= d_url($list_anime['video']); ?><br>
<?= $curr_le['link']; ?><br>
<?= $list_anime['html']; ?>
<br><br>
<?php
	$url = $curr_le['link'];
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	curl_setopt($ch, CURLOPT_PROXY, null);
	curl_setopt($ch, CURLOPT_HTTPHEADER,
	    array(
	        "Upgrade-Insecure-Requests: 1",
	        "User-Agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.87 Safari/537.36",
	        "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3",
	        "Accept-Language: en-US,en;q=0.9",
	        "cookie: __cfduid=d463c2c74b8cb4ad701c41487ef15ba271592223878; PHPSESSID=cq1245ofoi0qab5gun4lqfj365; _ga=GA1.2.205899321.1592223880; _gid=GA1.2.1323666345.1592223880; HstCfa4237846=1592223880537; HstCmu4237846=1592223880537; c_ref_4237846=https%3A%2F%2Fwww.google.com%2F; __dtsu=1040159222388239E79CA78CAA0D19A1; HstCnv4237846=2; _gat_gtag_UA_126097535_3=1; HstCla4237846=1592234566756; HstPn4237846=6; HstPt4237846=14; HstCns4237846=3"
	    ));

	$data = curl_exec($ch);
	$info = curl_getinfo($ch);
	$error = curl_error($ch);

	echo "INFO <br>";
	print_r($info);
	echo "<hr>";
	echo "ERROR <br>";
	print_r($error);
	echo "<hr>";
	echo "DATA <br>";
	echo htmlentities($data);
	echo "<hr>";
	curl_close($ch);

?>
</pre>
<h2><?= $anime_txt; ?></h2>
<br><br>
<iframe style="width:100%; height:500px;" src="<?= d_url($list_anime['video']); ?>" allowfullscreen="true" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" class="idframe" __idm_frm__="1931"></iframe>
<br><br>
<?php if(isset($ls_eps)): ?>
<div class="container nav_bottom">
	<div class="col-xs-4">
		<a href="index.php?page=view_anime&sub=<?= $_GET['sub']; ?>&eps=<?= $seb; ?>" class="btn btn-success btn-nav-bottom btn-seb <?= $dis; ?>">	
			<i class="fa fa-angle-double-left"></i> Episode Sebelumnya
		</a>
	</div>

	<div class="col-xs-4">
		<a href="<?= $ls_eps; ?>" class="btn btn-warning btn-nav-bottom btn-lis">List Episode</a>
	</div>
	<div class="col-xs-4">
		<a href="index.php?page=view_anime&sub=<?= $_GET['sub']; ?>&eps=<?= $nex; ?>" class="btn btn-success btn-nav-bottom btn-nex <?= $disn; ?>">
			Episode Berikutnya <i class="fa fa-angle-double-right"></i> 
		</a>
	</div>
</div>
<br><br>
<?php endif; ?>