<?php
	$ml_current = $menime_list[$_GET['a']];
	$per_page = 100;
	/*			
	$url = $ml_current['origin'];
	
	if($ml_current["src"]==1){
		$anime = anime_info_py($url);
		$ml_current['img'] = "data:image/gif;base64,".$anime['img'];
	}else{
		$anime = $ml_current;
	}
	$anime['desc'] = html_entity_decode($anime['desc']);
	$anime['info'] = html_entity_decode($anime['info']);*/
?>
<h2>NONTON <?= strtoupper($anime_txt); ?></h2>
<div class="row">
	<div class="col-xs-4 col-md-2">
		<img src="<?= $ml_current['img']; ?>" alt="anime" class="img-res">
	</div>
	<div class="col-xs-8 col-md-10 anime-desk">
		<?= ''//$anime['desc']; ?>
		<div style="text-align:center;">
			<img src="assets/img/loading.svg" alt="loading">
		</div>
	</div>
</div>
<hr>
<div class="anime-infoni">
<?= '';//$anime['info']; ?>
</div>

<!-- LIST ANIME -->
<h2>LIST ANIME <?= strtoupper($anime_txt); ?></h2>
<link rel="stylesheet" href="assets/css/dataTables.bootstrap.min.css">
<script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="assets/js/dataTables.bootstrap.min.js"></script>
<br>
<?php if(explode("_", $ml_current['link'])[0]=="avatar"): ?>
<?php
	$list_episode = json_decode(file_get_contents("data/".$ml_current['link'].".json") ,true);	
?>
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
		<table class="table table-list">
			<thead>
				<tr>
					<th>No</th>
					<th>Episode</th>
					<th>Book</th>
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
							<?= "$book"; ?>
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
	
	</tbody>
</table>
<?php endif; ?>
<script type="text/javascript">
	$(document).ready(function(){
		$.getJSON("anime_load.php?desc&a=<?= $_GET['a']; ?>", function(result){
			//console.log(result);
			$(".anime-desk").html(result.desc);
			$(".anime-infoni").html(result.info);
			$(".img-res").attr("src",result.img);
	  	});
	});

	var table = $('.myTable').DataTable({
		"ajax": "anime_load.php?list&a=<?= $_GET['a']; ?>"
	});
	
</script>


