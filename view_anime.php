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
<h2><?= $anime_txt; ?></h2>
<br>
<div id="container">
	<?php if(isMobile()): ?>
		<?php if(isset($ls_eps)): ?>
		<div class="row" style="padding-top:20px">
			<div class="col-xs-2 col-md-2" style="padding-right: 0;">
				<div class="btn-fs" id="btnFS">Fullscreen</div>
			</div>
			<div class="pre_nav" style="display: none">
				<div class="col-xs-8 col-md-2 nav_anime_txt">
					<p><?= $anime_txt; ?></p>
				</div>
				<div class="col-xs-2 col-md-2 flex-container">
					<a id="btnfullnext" href="index.php?page=view_anime&sub=<?= $_GET['sub']; ?>&eps=<?= $nex; ?>">
						<div class="btn-fs">Next</div>
					</a>&nbsp;
					<a id="btnfullprev" href="index.php?page=view_anime&sub=<?= $_GET['sub']; ?>&eps=<?= $seb; ?>">
						<div class="btn-fs">Prev</div>
					</a>
				</div>
			</div>
		</div>
		<?php endif; ?>
	<?php endif; ?>

<?php if($ml_current['src']==1 || $ml_current['src']==5): ?>
	<!-- <iframe src="<?= '';//$list_anime['video']; ?>" allowfullscreen="true" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" class="idframe"></iframe> -->
	
	<iframe style="display: none;" src="" allowfullscreen="true" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" class="idframe"></iframe>
	
	<div class="load_video_box"></div>
	<!-- h:500px -->
	<div class="before_player" data-href="<?= e_url($curr_le['link']); ?>">
		
		<h1>
			<i class="fa fa-play"></i>
		</h1>
		<!-- 
		<img src="assets/img/loading.svg" alt="loading">
		 -->
	</div>
<?php else: ?>
	<video controls class="idframe" poster="<?= $list_anime['thumb']; ?>">
		<source src="<?= $list_anime['video']; ?>" type='video/mp4'/>
	    <source src="<?= $list_anime['video']; ?>" type='video/webm'/>
	</video>
<?php endif; ?>
</div>
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
<pre id="pre_print_error" style="display: none;"></pre>
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
			$.ajax({
				url: url, 
				success: function(res){
    				var result = JSON.parse(res);

    				if(result.error != []){
    					console.log(result.error);
    					$("#pre_print_error").show();
    					$("#pre_print_error").html(JSON.stringify(result.error, null, 2));
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

<script src="assets/js/media_session.js"></script>
<?php if(isMobile()): ?>
<script type="text/javascript">
var fs = document.getElementById('btnFS');

fs.addEventListener('click', goFullScreen);

function goFullScreen() {
	var fullscreenElement = document.fullscreenElement || document.mozFullScreenElement ||
	document.webkitFullscreenElement || document.msFullscreenElement;
	var ne = $("#btnfullnext").attr("href");
	var pe = $("#btnfullprev").attr("href");
	if(fullscreenElement){
		$("#btnfullnext").attr("href", ne.replace("&sc=ld", ""));
  		$("#btnfullprev").attr("href", pe.replace("&sc=ld", ""));
		$(".pre_nav").hide();
  		exitFullscreen();
  	}else {
		$(".pre_nav").show();
  		$("#btnfullnext").attr("href", ne+"&sc=ld");
  		$("#btnfullprev").attr("href", pe+"&sc=ld");
  		launchIntoFullscreen(document.getElementById('container'));
  	}
}


<?php if(isset($_GET['sc'])): ?>
$(".pre_nav").show();
var ne = $("#btnfullnext").attr("href");
var pe = $("#btnfullprev").attr("href");
$("#btnfullnext").attr("href", ne+"&sc=ld");
$("#btnfullprev").attr("href", pe+"&sc=ld");
setTimeout(function(){
	launchIntoFullscreen(document.getElementById('container'));
}, 1000);
	//launchIntoFullscreen(document.getElementById('container'));
<?php endif; ?>

// From https://davidwalsh.name/fullscreen
// Find the right method, call on correct element
function launchIntoFullscreen(element) {
	if (element.requestFullscreen) {
    	element.requestFullscreen();
  	} else if (element.mozRequestFullScreen) {
    	element.mozRequestFullScreen();
  	} else if (element.webkitRequestFullscreen) {
    	element.webkitRequestFullscreen();
  	} else if (element.msRequestFullscreen) {
    	element.msRequestFullscreen();
  	}
  	/*var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
  	if(isMobile){
  	}*/
  	screen.orientation.lock("landscape");
}

// Whack fullscreen
function exitFullscreen() {
  	if (document.exitFullscreen) {
    	document.exitFullscreen();
  	} else if (document.mozCancelFullScreen) {
    	document.mozCancelFullScreen();
  	} else if (document.webkitExitFullscreen) {
    	document.webkitExitFullscreen();
  	}
  	/*var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
  	if(isMobile){
  		screen.orientation.unlock();
  	}*/
}

</script>
<?php endif; ?>
