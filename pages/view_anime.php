
<style>
	.nav_anime_txt{
		min-height: 30px;
	}
	.nav_anime_txt>p{
		color: #FFF;
		margin: 0;
	    line-height: 20px;
	    overflow: hidden;
	    text-overflow: ellipsis;
	    white-space: nowrap;
	}
</style>
<?php

if(isset($_GET["id"])):
 	$id_anime = $row["id_anime"];
 	$id_eps = (int)$row["id_eps"];
	$video = $row["vid"];
	if($src==3){$thumb = $row["thumb"];}

	$ls_eps = ${$tbl}->get_naveps($id_anime, $id_eps);

	$ls_part = "";

	$ideps_sepcial = ["ME0013", "ME0014"];
	if(in_array($id_anime, $ideps_sepcial)){
		$qb = $tb_episode->get_query("SELECT * FROM episodes WHERE id_anime = '$id_anime' AND eps = '$row[eps]' ");
		$pa = 1;
		while ($rowb = $tb_episode->fetch_assoc($qb)) {
			if($pa==1){
				$ls_eps = ${$tbl}->get_naveps($id_anime, (int)$rowb["id_eps"]);
			}
			$idb = e_url($rowb["id_episode"]);
			$dis = $row['id_episode'] == $rowb["id_episode"]?"disabled":''; 
			$ls_part .= "<a href=\"".base_url("index.php?page=view_anime&id=$idb&src=".e_url($src))."\" class=\"btn btn-success\" $dis>Part $pa</a>&nbsp;";
			$pa++;
		}
		$ls_part = $pa>2?$ls_part:'';
	}
	
	

	/*
	$ls_eps["prev"]["link"] = $ls_eps["prev"]["id"]!=""?"index.php?page=view_anime&id=".e_url($ls_eps["prev"]["id"])."&src=".e_url($src):"";  
	$ls_eps["cur"] = "index.php?page=anime&a=".e_url($id_anime);  
	$ls_eps["next"]["link"] = $ls_eps["next"]["id"]!=""?"index.php?page=view_anime&id=".e_url($ls_eps["next"]["id"])."&src=".e_url($src):"";  	
	*/	
	//$ls_eps["prev"]["link"] = $ls_eps["prev"]["id"]!=""?"index.php?page=view_anime&id=".e_url($ls_eps["prev"]["id"])."&src=".e_url($src):"";  
	$ls_eps["prev"]["link"] = $ls_eps["prev"]["id"]!=""?base_url("view/$row[link_anime]_".$ls_eps["prev"]["id"]."&src=".e_url($src)):"";  
	$ls_eps["cur"] = base_url("anime/$row[link_anime]");   	
	$ls_eps["next"]["link"] = $ls_eps["next"]["id"]!=""?base_url("view/$row[link_anime]_".$ls_eps["next"]["id"]."&src=".e_url($src)):"";  
	$ls_eps["ini"] = base_url("full/$row[link_anime]_".$num."&src=".e_url($src));
	
?>
<h2><?= $anime_txt; ?></h2>
<br><br>
<div id="container">
	<?php
		if($row['src']==4){
			echo "<style>.idframe {height: 600px;}</style>";
		}
	?>
	<iframe src="<?= $video; ?>" allowfullscreen="true" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" class="idframe"></iframe>
</div>
<br>
<?php if($ls_part != ""): ?>
<div class="container nav_bottom">
	<?= $ls_part; ?>
	<!-- <a href="#" class="btn btn-success" disabled="disabled">Part 1</a>
	<a href="#" class="btn btn-success">Part 2</a>
	<a href="#" class="btn btn-success">Part 3</a> -->
</div>
<?php endif; ?>
<br>
<?php if(isset($ls_eps)): ?>
	<div class="container nav_bottom">
		<div class="col-xs-4">
			<a href="<?= $ls_eps["prev"]["link"]; ?>" class="btn btn-danger2 btn-nav-bottom btn-seb <?= $ls_eps["prev"]["dis"]==1?'disabled':''; ?>">	
				<i class="fa fa-angle-double-left"></i> Episode Sebelumnya
			</a>
		</div>
		<div class="col-xs-4">
			<a href="<?= $ls_eps["cur"]; ?>" class="btn btn-danger btn-nav-bottom btn-lis">List Episode</a>
		</div>
		<div class="col-xs-4">
			<a href="<?= $ls_eps["next"]["link"]; ?>" class="btn btn-danger2 btn-nav-bottom btn-nex <?= $ls_eps["next"]["dis"]==1?'disabled':''; ?>">
				Episode Berikutnya <i class="fa fa-angle-double-right"></i> 
			</a>
		</div>
	</div>
	<br><br>
<?php endif; ?>
<?php if(check_local()): ?>
<div class="col-xs-4">
	<a href="<?= $ls_eps["ini"]; ?>" class="btn btn-primary">Full Screen Mode (beta)</a>
</div>
<?php endif; ?>
<pre id="pre_print_error" style="display: none;"></pre>
<script type="text/javascript">
	document.addEventListener('touchstart', handleTouchStart, false);        
	document.addEventListener('touchmove', handleTouchMove, false);

	var xDown = null;                                                        
	var yDown = null;

	function getTouches(evt) {
	  return evt.touches ||             // browser API
	         evt.originalEvent.touches; // jQuery
	}                                                     
	                                                                         
	function handleTouchStart(evt) {
	    const firstTouch = getTouches(evt)[0];                                      
	    xDown = firstTouch.clientX;                                      
	    yDown = firstTouch.clientY;                                      
	};                                                
	                                                                         
	function handleTouchMove(evt) {
	    if ( ! xDown || ! yDown ) {
	        return;
	    }

	    var xUp = evt.touches[0].clientX;                                    
	    var yUp = evt.touches[0].clientY;

	    var xDiff = xDown - xUp;
	    var yDiff = yDown - yUp;
	                                                                         
	    if ( Math.abs( xDiff ) > Math.abs( yDiff ) ) {/*most significant*/
	        if ( xDiff > 0 ) {
	            /* right swipe */ 
	            console.log("swiped-right");
	            //alert("swiped-right");
	            document.location = "<?= $ls_eps["next"]["link"]; ?>";
	        } else {
	            /* left swipe */
	            console.log("swiped-left");
	            //alert("swiped-left");
	            document.location = "<?= $ls_eps["prev"]["link"]; ?>";
	        }                       
	    } else {
	        if ( yDiff > 0 ) {
	            /* down swipe */ 
	        } else { 
	            /* up swipe */
	        }                                                                 
	    }
	    /* reset values */
	    xDown = null;
	    yDown = null;                                             
	};
</script>
<script type="text/javascript">
	$(document).ready(function(){

		$(".before_player").click(function(){
			var lnk = $(this).attr("data-href");
			<?php if(isset($list_anime['video'])): ?>
				$(".before_player").hide();
	    		$(".idframe").attr("src", "<?= $list_anime['video']; ?>");
	    		$(".idframe").show();
			<?php else: ?>
			$(".before_player").html('<img src="assets/img/loading.svg" alt="loading">');
			var url = "anime_load.php?vid&link="+lnk;
			<?php
				$in_arr = [5,6,7,11];
				if(isset($_GET['sub']) && in_array($_GET['sub'], $in_arr) ){
					$sub = $_GET['sub'];
					$id = isset($_GET['eps'])?$_GET['eps']:'';
					echo "url += \"&sub=$sub&eps=$id\";";
				}
			?>
			$.ajax({
				url: url, 
				success: function(res){
    				var result = JSON.parse(res);

    				if(result.error != []){
    					console.log(result.error);
    					$("#pre_print_error").show();
    					$("#pre_print_error").html(JSON.stringify(result.error, null, 2));
    					swal("Error!", "FIle Not Found!", "error");
    					//$(".idframe").attr("src", '404.php');
	    				$(".before_player").hide();
	    				$(".idframe").show();
    				}else{
	    				$(".before_player").hide();
	    				//$(".load_video_box").html('<iframe src="'+result.video+'" allowfullscreen="true" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" class="idframe"></iframe>');
	    				$(".idframe").attr("src", result.video);
	    				$(".idframe").show();
    				}
  				},
  				error: function(xhr,status,error){
  					console.log(xhr);
  					console.log(status);
  					console.log(error);
  					$("#pre_print_error").show();
  					$("#pre_print_error").append(xhr);
  					$("#pre_print_error").append(status);
  					$("#pre_print_error").append(error);
  				}
  			});
			<?php endif; ?>
		});
	});
</script>
<?php if(!empty($list_anime['error'])): ?>
<pre>
--- debug
<?php
echo "\n";
print_r($list_anime['error']);
?>
</pre>
<?php endif; ?>

<script src="<?= base_url('assets/js/media_session.js'); ?>"></script>
<?php endif; ?>
