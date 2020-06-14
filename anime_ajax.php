<?php
$file = $_GET['data'];
$list_episode = json_decode(file_get_contents("data/".$file.".json") ,true);

/*---------- cari -----------------*/
if(isset($_GET['cari'])){
	$needle = $_GET['cari'];
	foreach($list_episode as $k=>$v){
	   if(stristr($v['eps'],$needle) || stristr($v['judul'],$needle))
	   $output[$k]=$v;
	}
	echo "<pre>";
	print_r($output);
	echo "</pre>";
	// /$list_episode = $output;
}
/*---------- cari -----------------*/

$per_page = $_GET['per_page'];

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
				$link  = "index.php?page=view_anime&sub=$_GET[a]&eps=$i";
				/*
				index.php?page=view_anime&sub=<?= $_GET['a']?>&judul=<?= e_url($v['eps'].' - '.$v['judul']);?>&link=<?= e_url($v['link']);?>
				index.php?page=view_anime&sub=<?= $_GET['a']?>&judul=<?= e_url($v['eps'].' - '.$v['judul']);?>&link=<?= e_url($v['link']);?>
				*/
		?>
		<tr>
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