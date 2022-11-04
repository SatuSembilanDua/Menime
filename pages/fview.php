

<style>
	.header-main, ol.breadcrumb, .footer, .nav_bottom{
		display:none;
	}
	.body-main{
		padding:0;
		min-height: auto;
	}
	.new_htm{
		position: absolute;
		left: 0;
		top: 0;
		width: 100%;
		height: 99vh;
		font-size: 1.4em;
	}
	.idframe{
		height:100%;
		margin-top: 0;
	}
	
	#nanav{
		position: absolute;
		width: 100%;
		left: 0;
		top: 0;
		z-index: 9997;
		padding: 20px 0;
		/*background: rgba(0, 0, 0, .8);*/
	}
	.rowa{
		display: flex;
		flex-direction: row;
		flex-wrap: nowrap;
		justify-content: space-around;
		align-items: center;
		align-content: flex-start;
	}

	.linav{
		padding:5px;
		text-align: right;
		display: block;
		flex-grow: 0;
		flex-shrink: 1;
		flex-basis: auto;
		align-self: auto;
	}
	
	.nav_anime_txt{
		display: block;
		flex-shrink: 1;
		flex-basis: auto;
		align-self: auto;
	}
	.nav_anime_txt>p{
		color: #FFF;
		margin: 0;
		line-height: 20px;
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap;
		padding: 5px 0;
	}
	#fllscrn{
		padding-right: 20px;
	}
	.menu_bar_container{
		display: none;
	}
	.overlay{
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		z-index: 9998;
		background: rgba(0, 0, 0, .8);
	}
	.menu_bar{
		position: fixed;
		top: 0;
		left: 0;
		/*width: 40%;*/
		width: 0%;
		height: 100%;
		z-index: 9998;
		background: #e50914;
		transition: width .1s ease-in-out;
	}
	.menu_bar_item{
		height: 100%;
		overflow-y: auto;
	}
	.menu_bar_title{
		width: 100%;
		padding: 20px;
		text-align: center;
		color: #FFF;
		background: #222;
		border-bottom: 2px solid #000;
	}
	.menu_bar_title>img{
		width: 50%;
	}
	.bar_menu{
		/*display: flex;
		flex-direction: column;
		flex-wrap: nowrap;
		justify-content: flex-start;
		align-items: stretch;
		align-content: flex-start;*/
		color: #FFF;
	}
	.bar_menu>a{
		color: #FFF;
		font-size: 1em;
	}
	.bar_menu_item{
		padding: 20px 40px;
		background: #e50914;
		transition: background .1s ease-in-out;
	}
	.bar_menu_item>p{
		margin: 0;
		line-height: 20px;
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap;
	}
	.bar_menu_item>p>i{
		margin-right: 20px;
	}
	#bar_episode>a>.bar_menu_item>p>i{
		margin-right: 10px;
	}
	/*.mbi{
		height: auto;
	}*/
	.container_bar_menu{
		display: none;
		width: 95%;
		margin-right: 0;
		/*height: calc(100% - 500px);*/
		height: 500px;
		overflow-y: auto;
	}
	@media only screen and (max-height: 768px){
		#nanav{
			padding: 0;
		}
	}

	.bar_menu>a:hover .bar_menu_item, .eps_active{
		background: #222;
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
	$ls_eps["prev"]["link"] = $ls_eps["prev"]["id"]!=""?base_url("full/$row[link_anime]_".$ls_eps["prev"]["id"]."&src=".e_url($src)):"";  
	$ls_eps["cur"] = base_url("anime/$row[link_anime]");   	
	$ls_eps["next"]["link"] = $ls_eps["next"]["id"]!=""?base_url("full/$row[link_anime]_".$ls_eps["next"]["id"]."&src=".e_url($src)):"";   
	$ls_eps["ini"] = base_url("view/$row[link_anime]_".$num."&src=".e_url($src));
	//$video = "http://192.168.1.7/vid/curl/video.php";
	
?>

<div class="new_htm">
   
	<iframe src="<?= $video; ?>" allowfullscreen="true" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" class="idframe"></iframe>

	<div id="nanav" class="container">
		<div class="rowa">
			<div class="linav">
				<a href="#" class="show_nav">
					<i class="fa fa-bars"></i>
				</a>
			</div> 
			<div class="nav_anime_txt">
				<p class="anime_title" data-show="show" data-text="<?= $anime_txt; ?>"><?= $anime_txt; ?></p>
			</div> 
			<div class="linav">
				<a href="#" id="fllscrn">
					<i class="fa fa-arrows-alt"></i>
				</a>
			</div>
		</div>
	</div>
	<!-- BAR MENU -->
	<div class="menu_bar_container">
		<div class="overlay"></div>
		<div class="menu_bar">
			<div class="menu_bar_item">
				<div class="menu_bar_title">
					<img src="<?= base_url('assets/img/icons.png'); ?>" alt="logo">
					<!-- <h1>Navigasi</h1> -->
				</div>
				<div class="bar_menu" id="main_bar">
					<a href="<?= $ls_eps["ini"]; ?>">
						<div class="bar_menu_item">
							<p>
								<i class="fa fa-arrow-left"></i>
								Kembali ke Normal
							</p>
						</div>
					</a>
					<a href="<?= $ls_eps["prev"]["link"]; ?>">
						<div class="bar_menu_item">
							<p>
								<i class="fa fa-angle-double-left"></i>
								Episode Sebelumnya
							</p>
						</div>
					</a>
					<a href="<?= $ls_eps["next"]["link"]; ?>">
						<div class="bar_menu_item">
							<p>
								<i class="fa fa-angle-double-right"></i>
								Episode Berikutnya
							</p>
						</div>
					</a>
					<a href="#" class="list_episode">
						<div class="bar_menu_item">
							<p>
								<i class="fa fa-list"></i>
								List Episode
							</p>
						</div>
					</a>
				</div>
				<div class="container container_bar_menu" data-show="hide">
					<div class="bar_menu" id="bar_episode">
						<?php 
						for($i=1; $i<=1000; $i++){
							$eppp = 100;
							$act = "";
							$scr = "";
							if($i==$eppp){
								$act = "eps_active";
							}
							if($i==$eppp-9){
								$scr = "id='scrl_eps'";
							}
						}
						?>
						<div class="bar_menu_item eps_active">
							<p>
								<img src="<?= base_url('assets/img/loading.svg'); ?>" alt="loading">
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<pre id="pre_print_error" style="display: none;"></pre>
<script type="text/javascript">
	let ini_scroll = 0;
	$(document).ready(function(){
		//show_nav();
		//get_list_anime();
		$(".show_nav").click(function(e){
			e.preventDefault();
			//console.log("HAHAHA");
			show_nav();
		});
		$(".overlay").click(function(){
			hide_nav();
		});
		$(".list_episode").click(function(e){
			e.preventDefault();
			let show = $(".container_bar_menu").attr("data-show");
			if(show=="hide"){
				$(".container_bar_menu").show(function(){
					//scroll_ke_aktif();
					get_list_anime();
					$(".container_bar_menu").attr("data-show", "show");
				});
			}else{
				$(".container_bar_menu").hide(function(){
					$(".container_bar_menu").attr("data-show", "hide");
				});
			}
		});
		/*$(".anime_title").click(function(){
			show_title();
		});*/
	});

	function show_nav() {
		$(".menu_bar_container").show(function(){
			$(".menu_bar").css("width", "40%");
		});
	}
	function hide_nav() {
		$(".menu_bar_container").hide(function(){
		});
		$(".menu_bar").css("width", "0%");
	}

	function hide_title() {
		$(".anime_title").hide();
	}

	function show_title() {
		let attr = $(".anime_title").attr("data-show");
		let text = $(".anime_title").attr("data-text");
		if(attr=="show"){
			setTimeout(function(){
				$(".anime_title").text("                     ");
				$(".anime_title").attr("data-show", "hide");
			}, 10000);
		}else{
			$(".anime_title").text(text);
		}
	}

	function get_list_anime(){
		console.log("get_list_anime");
		let url_api = "<?= base_url('api/anim/'.$row['link_anime']); ?>";
		let ret = [];
		$.getJSON(url_api, function(response) {
			console.log("laod_done");
			$("#bar_episode").html("");
			
			console.log(response);
			console.log(response["judul_anime"]);
			$.each(response["anime_list"]["data"], function(index, element) {
				let cid = false;
				let cact = false;
				if(element['eps']=="<?= $row['eps']; ?>"){
					cact = true;
					cid = true;
				}

				$("#bar_episode").append(gen_list(element, cid, cact));
		    });
		    scroll_ke_aktif();
		});
		//console.log(ret);
	}

	function gen_list(data, cid, cact) {
		let id = cid?'id="scrl_eps"':'';
		let active = cact?'eps_active':'';
		let ret = '';
		data["link_eps"] = data["link_eps"].replace("view", "full");
		ret += '<a href="'+data["link_eps"]+'" '+id+' >';
			ret += '<div class="bar_menu_item '+active+'">';
				ret += '<p>';
					ret += '<i class="fa fa-list"></i>';
					ret += data["eps"]+' '+data["judul"];
				ret += '</p>';
			ret += '</div>';
		ret += '</a>';
		return ret;
	}

	function scroll_ke_aktif() {
		//alert(screen.height);
		console.log("scroll_ke_aktif");
		/*let text = $(".eps_active").text();
		let top = $(".eps_active").offset();
		console.log(text);
		console.log(top);*/
		//$("#bar_episode").get(0).scrollIntoView();
		/*$('#main_bar').animate({
			scrollTop: $("#bar_episode").offset().top
		}, 1000);*/
		//$('#main_bar').get(0).scrollTo(0, 1500);
		//$('#bar_episode').scrollTop(1500);
		if(ini_scroll==0){
			ini_scroll = $("#scrl_eps").offset().top-(60.4*9);
		}
		$('.menu_bar_item').animate({
			scrollTop: $(".container_bar_menu").offset().top
		}, 1000);
		console.log(ini_scroll);
		$('.container_bar_menu').animate({
			scrollTop: ini_scroll
			//scrollTop: 1500
		}, 1000);

		
		//$(".eps_active").get(0).scrollIntoView({behavior: "smooth"});
		//$(".eps_active").get(0).scrollIntoView();
		//$("#scrl_eps").get(0).scrollIntoView();

	}
</script>
<script type="text/javascript">
	var elem = document.documentElement; 
	var fullscreenElement = document.fullscreenElement || document.mozFullScreenElement || document.webkitFullscreenElement || document.msFullscreenElement;

/* View in fullscreen */
function openFullscreen() {
	if(elem.requestFullscreen) {
		elem.requestFullscreen();
	}else if (elem.webkitRequestFullscreen) {
		/* Safari */
		elem.webkitRequestFullscreen();
	}else if (elem.msRequestFullscreen) { 
		/* IE11 */
		elem.msRequestFullscreen();
	}
} 

/* Close fullscreen */
function closeFullscreen() {
	if(document.exitFullscreen) {
		document.exitFullscreen();
	}else if (document.webkitExitFullscreen){
		/* Safari */
		document.webkitExitFullscreen();
	}else if (document.msExitFullscreen) {
		/* IE11 */
		document.msExitFullscreen();
	}
}

$("#fllscrn").click(function(e){
	e.preventDefault();
	var fullscreenElement = document.fullscreenElement || document.mozFullScreenElement || document.webkitFullscreenElement || document.msFullscreenElement;
	//openFullscreen();
	//console.log(fullscreenElement);
	if (fullscreenElement != null){
		//alert("close full screen")
		closeFullscreen();
	}else{
		
		openFullscreen();
	}
	
});
</script>
<script>
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
				openFullscreen();
			} else { 
				/* up swipe */
			}                                                                 
		}
		/* reset values */
		xDown = null;
		yDown = null;                                             
	};
</script>
<?php endif; ?>
