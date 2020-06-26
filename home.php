<h2>LIST ANIME</h2>
<pre>
<?php
	/*$data = json_decode(file_get_contents("data/menime.json"),true);
	//print_r($data);
	$su = [array(
	            "judul" => "Captain Tsubasa 2018",
	            "link" => "captain_tsubasa",
	            "origin" => "https://www.oploverz.in/series/captain-tsubasa-2018/",
	            "sts" => 1,
	            "src" => 1,
	            "img" => "https://4.bp.blogspot.com/-GKPIDON27N0/WsW9rSWU-fI/AAAAAAAAUVk/GOxnrCzAz_YsHUwzTpKzH2emXojydRAmQCLcBGAs/s1600/Captain%2BTsubasa%2B%25282018%2529.jpg"
	        )];
	print_r($su);
	
	array_splice($data, 3, 0, $su);
	print_r($data);
	$myfile = fopen("data/menime.json", "w") or die("Unable to open file!");
	fwrite($myfile, json_encode($data));
	fclose($myfile);*/

	/*$ep = list_episode("https://www.oploverz.in/series/captain-tsubasa-2018/");
	unset($ep[0]);
	print_r($ep);
	$myfile = fopen("data/captain_tsubasa.json", "w") or die("Unable to open file!");
	fwrite($myfile, json_encode($ep));
	fclose($myfile);*/

?>
</pre>
<div class="row">
<?php
	foreach ($menime_list as $k => $v):
		$img = "https://menime.herokuapp.com/assets/img/icon.png";
		if(isset($v['img'])){
			$img = $v['img'];
		}
?>
	<a href="index.php?page=anime&a=<?= $k;?>">
		<div class="col-md-3 col-xs-4">
			<div class="anime-list">
				<div class="img-list" style="background-image: url(<?= $img; ?>);" ></div>
				<div class="anime-judul">
					<p><?= $v['judul']; ?></p>
				</div>
			</div>
		</div>
	</a>
<?php endforeach; ?>
</div>
