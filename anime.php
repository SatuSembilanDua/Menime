

<?php
	$url = "https://www.oploverz.in/series/one-piece-episode-special/";
	if($_GET['a']=="naruto"){
		$url = "https://www.oploverz.in/series/naruto/";
	}else if($_GET['a']=="one_piece_special"){
		$url = "https://www.oploverz.in/series/one-piece-episode-special/";
	}else if($_GET['a']=="naruto_shippuuden"){
		$url = "https://www.oploverz.in/series/naruto-shippuuden/";
	}else if($_GET['a']=="death_note"){
		$url = "https://www.oploverz.in/series/death-note/";
	}else if($_GET['a']=="one_piece_movie"){
		$url = "https://www.oploverz.in/series/one-piece-movie/";
	}else if($_GET['a']=="one_piece_ova"){
		$url = "https://www.oploverz.in/series/one-piece-ova/";
	}else if($_GET['a']=="samurai_x_rurouni_kenshin_meiji_kenkaku_romantan"){
		$url = "https://www.oploverz.in/series/samurai-x-rurouni-kenshin-meiji-kenkaku-romantan/";
	}else if($_GET['a']=="boruto_naruto_next_generations"){
		$url = "https://www.oploverz.in/series/boruto-naruto-next-generations/";
	}

	$anime = anime_info($url);
	$list_episode = list_episode($url);
	$per_page = 10;
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

<h2>NONTON <?= strtoupper($anime_txt); ?></h2>
<div class="row">
	<div class="col-xs-4 col-md-2">
		<img src="data:image/gif;base64,<?= $anime['img']; ?>" alt="anime" class="img-res">
	</div>
	<div class="col-xs-8 col-md-10">
		<?= html_entity_decode($anime['desc']); ?>
	</div>
</div>
<hr>
<?= html_entity_decode($anime['info']); ?>

<h2>LIST ANIME <?= strtoupper($anime_txt); ?></h2>
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
<hr>
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