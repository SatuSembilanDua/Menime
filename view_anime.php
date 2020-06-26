
<h2><?= $anime_txt; ?></h2>
<br>
<?php if($ml_current['src']!=1): ?>
	<video controls class="idframe" poster="<?= $list_anime['thumb']; ?>">
		<source src="<?= $list_anime['video']; ?>" type='video/mp4'/>
	    <source src="<?= $list_anime['video']; ?>" type='video/webm'/>
	</video>
<?php else: ?>
<iframe src="<?= $list_anime['video']; ?>" allowfullscreen="true" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" class="idframe"></iframe>
<?php endif; ?>
<br><br>

<?php if(isset($ls_eps)): ?>
<div class="container nav_bottom">
	<div class="col-xs-4">
		<a href="index.php?page=view_anime&sub=<?= $_GET['sub']; ?>&eps=<?= $seb; ?>" class="btn btn-danger2 btn-nav-bottom btn-seb <?= $dis; ?>">	
			<i class="fa fa-angle-double-left"></i> Episode Sebelumnya
		</a>
	</div>

	<div class="col-xs-4">
		<a href="<?= $ls_eps; ?>" class="btn btn-danger btn-nav-bottom btn-lis">List Episode</a>
	</div>
	<div class="col-xs-4">
		<a href="index.php?page=view_anime&sub=<?= $_GET['sub']; ?>&eps=<?= $nex; ?>" class="btn btn-danger2 btn-nav-bottom btn-nex <?= $disn; ?>">
			Episode Berikutnya <i class="fa fa-angle-double-right"></i> 
		</a>
	</div>
</div>
<br><br>
<?php endif; ?>
<?php if(!empty($list_anime['error'])): ?>
<pre>
--- debug
<?php
echo "\n";
print_r($list_anime['error']);
?>
</pre>
<?php endif; ?>


