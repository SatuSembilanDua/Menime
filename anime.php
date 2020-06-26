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


	if($ml_current['sts']==0){
		$list_episode = list_episode($url);

		$page_count = ceil(sizeof($list_episode)/$per_page);
		if(isset($_GET['hal'])){
			$curr_page = $_GET['hal'];
			$first = ((int)$curr_page * $per_page) - ($per_page-1) ;
			$last = ($first+$per_page)-1;
		}else{
			$curr_page = 1;
			$first = 1;
			$last = ($first+$per_page)-1;
		}
		$fr = $curr_page>4?$curr_page-3:1;
		$ls = $fr+4;
		if($ls>=$page_count){
			$ls = $page_count;
		}
		if($last>sizeof($list_episode)){
			$last = sizeof($list_episode);
		}
?>
<table class="table table-list">
	<tbody>
		<?php
			for ($i=($first-1); $i < ($last) ; $i++) { 
				$v = $list_episode[$i];
		?>
		<tr>
			<td><a href="index.php?page=view_anime&sub=<?= $_GET['a']?>&judul=<?= e_url($v['eps'].' - '.$v['judul']);?>&link=<?= e_url($v['link']);?>"><?= $v['eps']; ?></a></td>
			<td><a href="index.php?page=view_anime&sub=<?= $_GET['a']?>&judul=<?= e_url($v['eps'].' - '.$v['judul']);?>&link=<?= e_url($v['link']);?>"><?= $v['judul']; ?></a></td>
			<td><?= $v['date']; ?></td>
		</tr>
		<?php
			}
		?>
		
	</tbody>
</table>
<nav>
  	<ul class="pagination">
	    <li>
	      	<a href="index.php?page=anime&a=<?= $_GET['a']; ?>&hal=1" aria-label="Previous">
	        	<span aria-hidden="true">&laquo;</span>
	      	</a>
	    </li>
	    <?php
	    	$link_pagination = "";
	    	if($fr>1){
    			$link_pagination.= '<li><a href="index.php?page=anime&a='.$_GET['a'].'&hal=1">1</a></li>';
    			$link_pagination.= '<li class="disabled"><a href="#">...</a></li>';
    		}
	    	
    		for($i = $fr; $i <= $ls; $i++){
	    		
	    		if($curr_page==$i){
    				$link_pagination.= "<li class='active'><a href='index.php?page=anime&a=$_GET[a]&hal=$i'>$i</a></li>";
	    		}else{
    				$link_pagination.= "<li><a href='index.php?page=anime&a=$_GET[a]&hal=$i'>$i</a></li>";
	    		}
	    		
	    	}
	    	if($ls<$page_count){
    			$link_pagination.= "<li class='disabled'><a href='#'>...</a></li>";
	    		$link_pagination.= "<li><a href='index.php?page=anime&a=$_GET[a]&hal=$page_count'>$page_count</a></li>";
    		}
	    	echo $link_pagination;
	    ?>	    
	    <li>
	      	<a href="index.php?page=anime&a=<?= $_GET['a']; ?>&hal=<?= $page_count; ?>" aria-label="Next">
	        	<span aria-hidden="true">&raquo;</span>
	      	</a>
	    </li>
  	</ul>
</nav>

<?php
	}else{
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
<?php else: ?>
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
		if($ml_current['link']=="kekkaishi"){
			$list_episode = $list_episode;
		}else{
			$list_episode = array_reverse($list_episode);
		}
		$i=0;
		foreach($list_episode as $k => $v): 
		$link  = "index.php?page=view_anime&sub=$_GET[a]&eps=$k";
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
<?php endif; ?>
<script type="text/javascript">
	var table = $('.myTable').DataTable();
	
</script>
<?php
	}
	
?>


