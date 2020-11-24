<?php
	$ml_current = $menime_list[$_GET['a']];
				
	$url = $ml_current['origin'];
	$anime = anime_info($url);
	
	$per_page = 100;
	if($ml_current["src"]==1){
		$anime = anime_info($url);
		$ml_current['img'] = "data:image/gif;base64,".$anime['img'];
	}else{
		$anime = $ml_current;
	}
	echo '<pre>';
	print_r($anime);
	echo '</pre>';
?>
	<h2>NONTON <?= strtoupper($anime_txt); ?></h2>
	<div class="row">
		<div class="col-xs-4 col-md-2">
			<img src="<?= $ml_current['img']; ?>" alt="anime" class="img-res">
		</div>
		<div class="col-xs-8 col-md-10 anime-desk">
			<?= html_entity_decode($anime['desc']); ?>
		</div>
	</div>
	<hr>
	<?= html_entity_decode($anime['info']); ?>


<!-- LIST ANIME -->
<h2>LIST ANIME <?= strtoupper($anime_txt); ?></h2>
<?php
	$list_episode = json_decode(file_get_contents("data/".$ml_current['link'].".json") ,true);	
?>
<link rel="stylesheet" href="assets/css/dataTables.bootstrap.min.css">
<script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="assets/js/dataTables.bootstrap.min.js"></script>
<br>
<?php if(explode("_", $ml_current['link'])[0]=="avatar"): ?>
<ul class="nav nav-tabs" role="tablist">
	<?php
		
		$i=0;
		$list_book = [];
		foreach ($list_episode as $k => $v) {
			$book = str_replace(" ", "_", strtolower($v['book']));
			$list_book[$book][] = $v;
		}
		foreach ($list_book as $k => $v):
			$book = ucwords(str_replace("_", " ", $k));
			$ac = $i==0?'class="active"':"";
	?>
	<li role="presentation" <?= $ac; ?> > 
		<a href="#<?= $k; ?>" aria-controls="<?= $k; ?>" role="tab" data-toggle="tab"><?= $book; ?></a>
	</li>
	<?php
		$i++;
		endforeach;
	?>
</ul>

<!-- Tab panes -->
<div class="tab-content">
	<?php
		$i=0;
		foreach ($list_book as $k => $a):
			$book = ucwords(str_replace("_", " ", $k));
			$ac = $i==0?'active':"";
	?>
	<div role="tabpanel" class="tab-pane <?= $ac; ?>" id="<?= $k; ?>">
		<br>
		<table class="table table-list myTable">
			<thead>
				<tr>
					<th>No</th>
					<th>Episode</th>
					<th>Judul</th>
					<th>Date</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$i=0;
				foreach($a as $k => $v): 
				$link  = "index.php?page=view_anime&sub=$_GET[a]&eps=$v[id_eps]";
			?>
				<tr>
					<td><?= ++$i; ?></td>
					<td>
						<a href="<?= $link; ?>">
							<?= $v['eps']; ?>
						</a>
					</td>
					<td>
						<a href="<?= $link; ?>">
							<?= $v['judul']; ?>
						</a>
					</td>
					<td><?= $v['date']; ?></td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<?php
		$i++;
		endforeach;
	?>
</div>
<?php else: // if not have seasson ?>
<table class="table table-list myTable">
	<thead>
		<tr>
			<th>No</th>
			<th>Episode</th>
			<th>Judul</th>
			<th>Date</th>
		</tr>
	</thead>
	<tbody>
	<?php
		if($ml_current['link']=="kekkaishi" || $ml_current['src']==5){
			$list_episode = $list_episode;
		}else{
			if($ml_current['sts']==0){
				//$le = list_episode_page($ml_current['origin']);
				$list_episode = cek_update_anime($list_episode, $ml_current['origin']);
			}
			$list_episode = array_reverse($list_episode);
		}
		$i=0;
		foreach($list_episode as $k => $v): 
			$judul = $v['judul'];
			$link  = "index.php?page=view_anime&sub=$_GET[a]&eps=$k";
			if(isset($v['sts'])){
				$judul .= '<img src="assets/img/new.gif" alt="New">';
				//$get_a -= $v['div'];
				//e_url
				$jdl = e_url($v['judul']);
				$lnk = e_url($v['link']);
				$link = "index.php?page=view_anime&sub=$_GET[a]&eps=$k&judul=$jdl&link=$lnk";
			}
	?>
		<tr>
			<td><?= ++$i; ?></td>
			<td>
				<a href="<?= $link; ?>">
					<?= $v['eps']; ?>
				</a>
			</td>
			<td>
				<a href="<?= $link; ?>">
					<?= $judul; ?>
				</a>
			</td>
			<td><?= $v['date']; ?></td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>
<?php endif; ?>
<script type="text/javascript">
	<?php if($ml_current['sts']==0): ?>
	var table = $('.myTable').DataTable({
		 "order": [[ 0, "desc" ]]
	});
	<?php else: ?>
	var table = $('.myTable').DataTable();
	<?php endif; ?>
	
</script>


