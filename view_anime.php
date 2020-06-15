<?php
	
?>
<pre>
<?= $list_anime['video']; ?><br>
<?= d_url($list_anime['video']); ?><br>
<?= $curr_le['link']; ?>
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