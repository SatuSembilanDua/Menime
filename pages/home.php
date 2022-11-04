<h2>LIST ANIME</h2>
<div class="itemine">
<?php
	$q = $tb_menime->get_where(["display" => 1]);
	if(check_local()){
		$q = $tb_menime->get_all();
	}
	while($v = $tb_menime->fetch_assoc($q)):
		$k = e_url($v["id_anime"]);
		$img = "https://menime.herokuapp.com/assets/img/icon.png";
		if(isset($v['img'])){
			$img = $v['img'];
		}
		$ong = '';
		if($v['sts']==0){
			$ong = '<div class="featu">Ongoing</div>';
		}
		$link = base_url("anime/$v[link_anime]");
		$link_lama = "index.php?page=anime&a=<?= $k;?>";
?>
	<div class="itemine-list">
		<div class="poster">
			<img src="<?= $img; ?>" alt="<?= $v['judul_anime']; ?>">
			<?= $ong; ?>
			<a href="<?= $link;?>" class="asee"><div class="play2"></div></a>
		</div>
		<div class="data dfeatur">
			<h3>
				<i class="fa fa-film faext"></i> <a href="<?= $link;?>"><?= $v['judul_anime']; ?></a>
			</h3>
		</div>
	</div>
<?php endwhile; ?>
</div>