<?php
$header_text = "";
$get = $_GET;
$key = ["studio", "tags", "season"];
foreach ($get as $k => $v) {
	if(in_array($k, $key)){
		$g = htmlspecialchars(d_url($v));
		$q = $tb_menime->get_qwhere("$k LIKE '%$g%' ");
		$header_text .= "$g ";
	}
}
?>

<h2><?= $header_text; ?></h2>
<div class="row">
<?php
	if($tb_menime->num_rows($q)==0):
		pre("Search \"$header_text\"\n\nNot Found!");
	else:
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
?>
		<div class="col-md-2 col-xs-4 col-list">
			<div class="anime-list">
				<?= $ong; ?>
				<a href="index.php?page=anime&a=<?= $k;?>" title="<?= $v['judul_anime']; ?>">
					<div class="poster-img">
						<div class="img-list" style="background-image: url(<?= $img; ?>);" ></div>
						<div class="see"><i class="fa fa-play"></i></div>
					</div>
				</a>
				<a href="index.php?page=anime&a=<?= $k;?>" title="<?= $v['judul_anime']; ?>">
					<div class="anime-judul">
						<p><i class="fa fa-film"></i> <?= $v['judul_anime']; ?></p>
					</div>
				</a>
			</div>
		</div>
<?php endwhile;endif; ?>
</div>
