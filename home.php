<h2>LIST ANIME</h2>
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
