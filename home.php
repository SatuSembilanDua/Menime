<h2>LIST ANIME</h2>
<div class="row">
<?php
	foreach ($menime_list as $k => $v):
		$img = "https://menime.herokuapp.com/assets/img/icon.png";
		if(isset($v['img'])){
			$img = $v['img'];
		}
?>
		<div class="col-md-2 col-xs-4 col-list">
			<div class="anime-list">
				<a href="index.php?page=anime&a=<?= $k;?>" title="<?= $v['judul']; ?>">
					<div class="poster-img">
						<div class="img-list" style="background-image: url(<?= $img; ?>);" ></div>
						<div class="see"><i class="fa fa-play"></i></div>
					</div>
				</a>
				<a href="index.php?page=anime&a=<?= $k;?>" title="<?= $v['judul']; ?>">
					<div class="anime-judul">
						<p><i class="fa fa-film"></i> <?= $v['judul']; ?></p>
					</div>
				</a>
			</div>
		</div>
<?php endforeach; ?>
</div>

<!-- <?= strlen($v['judul'])>11?substr($v['judul'], 0, 12).' ...':$v['judul']; ?> -->