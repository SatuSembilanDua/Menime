<?php

require('simplehtmldom/simple_html_dom.php');

function e_url( $s ) {
	return rtrim(strtr(base64_encode($s), '+/', '-_'), '='); 
}
 
function d_url($s) {
	return base64_decode(str_pad(strtr($s, '-_', '+/'), strlen($s) % 4, '=', STR_PAD_RIGHT));
}

function isMobile() {
    return true;
    //return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

function _filter_($arr){
	$ret = [];
	foreach ($arr as $k => $v) {
		if(strpos($v, 'lowongan') || strpos($v, 'iklan') || strpos($v, 'OneMangaDay')){
			//echo "$v <br>";
		}else{
			array_push($ret, $v);
		}
	}
	//print_r($ret) ;
	return $ret;
}


function _filter2($arr){
	$ret = [];
	foreach ($arr as $k => $v) {
		if(strpos($v, 'result')){
			array_push($ret, $v);
		}
	}
	if(sizeof($ret)==0){
		foreach ($arr as $k => $v) {
			if(strpos($v, 'creadit') || strpos($v, 'komen') || strpos($v, 'manga.png')){
			}else{
				array_push($ret, $v);
			}
		}	
	}
	//print_r($ret) ;
	return $ret;
}



/*
*
*
*
* //////////////////////////// ANIME AREA ///////////////////////////////////////
*
*
*
*
*/

function list_episode($url){
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	curl_setopt($ch, CURLOPT_PROXY, null);

	$data = curl_exec($ch);
	$info = curl_getinfo($ch);
	$error = curl_error($ch);

	curl_close($ch);
	$dom = new simple_html_dom(null, true, true, DEFAULT_TARGET_CHARSET, true, DEFAULT_BR_TEXT, DEFAULT_SPAN_TEXT);

	//$html = file_get_html($url);
	$html = $dom->load($data, true, true);
	$list_episode = array();

	foreach ($html->find(".episodelist") as $div) {
		foreach ($div->find("li") as $li) {
			$eps = $li->find(".leftoff",0);
			$judul = $li->find(".lefttitle",0);
			$dt = $li->find(".rightoff",0);
			array_push($list_episode, array(
											'link'	=> $eps->find("a",0)->href,
											'eps'	=> $eps->plaintext,
											'judul'	=> $judul->plaintext,
											'date'	=> $dt->plaintext
											));
		}
	}
	return $list_episode;
}


function list_episode_page($url){
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	//curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36");
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.87 Safari/537.36");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	curl_setopt($ch, CURLOPT_PROXY, null);

	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLINFO_HEADER_OUT, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER,
    array(
        "Upgrade-Insecure-Requests: 1",
        "User-Agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.87 Safari/537.36",
        "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3",
        "Accept-Language: en-US,en;q=0.9",
        "cookie: __cfduid=da5a43c33c765d8c5ecc8757d17acbaa21573400863; cf_clearance=dbdc95a38f52919ba3c14d5e8473195aa022b0e3-1573400868-0-150; _ga=GA1.2.1782458.1573400868; _gid=GA1.2.1987219291.1573400868; HstCfa4135177=1573400875080; HstCmu4135177=1573400875080; HstCnv4135177=1; HstCns4135177=1; __dtsu=1EE704453831C85D33301B0402D15797; __atuvc=3%7C46; __atuvs=5dc8312478a5a8d9002; HstCla4135177=1573401070454; HstPn4135177=3; HstPt4135177=3"
    ));

	$data = curl_exec($ch);
	$info = curl_getinfo($ch);
	$error = curl_error($ch);

	curl_close($ch);
	$dom = new simple_html_dom(null, true, true, DEFAULT_TARGET_CHARSET, true, DEFAULT_BR_TEXT, DEFAULT_SPAN_TEXT);

	//$html = file_get_html($url);
	$html = $dom->load($data, true, true);
	$list_episode = array();
	//echo $html;
	//echo htmlentities($html);
	foreach ($html->find(".episodelist") as $div) {
		$i=0;
		foreach ($div->find("li") as $li) {

			$eps = $li->find(".leftoff",0);
			$judul = $li->find(".lefttitle",0);
			$dt = $li->find(".rightoff",0);
			array_push($list_episode, array(
											'link'	=> $eps->find("a",0)->href,
											'eps'	=> $eps->plaintext,
											'judul'	=> $judul->plaintext,
											'date'	=> $dt->plaintext
											));

			if($i==10){
				return $list_episode;
			}
			$i++;
		}
	}
}


function list_anime($url){
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	curl_setopt($ch, CURLOPT_PROXY, null);

	$data = curl_exec($ch);
	$info = curl_getinfo($ch);
	$error = curl_error($ch);

	curl_close($ch);
	$dom = new simple_html_dom(null, true, true, DEFAULT_TARGET_CHARSET, true, DEFAULT_BR_TEXT, DEFAULT_SPAN_TEXT);

	//$html = file_get_html($url);
	$html = $dom->load($data, true, true);
	$list_anime = array();
	foreach ($html->find('.idframe') as $vid) {
		$list_anime['error'] = $error;
		$list_anime['video'] = $vid->attr["src"];
	}
	
	
	return $list_anime;

}

/*$anime = list_anime("https://www.oploverz.in/samurai-x-episode-01-subtitle-indonesia/");
echo '<pre>';
print_r($anime);
echo '</pre>';*/

if(isset($_GET['test'])){
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: x-access-header, Authorization, Origin, X-Requested-With, Content-Type, Accept");

	$anime = anime_info_bc("https://samehadaku.vip/anime/one-piece/");
	//$anime = anime_info("https://www.oploverz.in");
	//print_r($anime);
	echo json_encode($anime);
}

function anime_info_py($url){
	$url = e_url($url);
	// https://apimenime.herokuapp.com/
	$a = file_get_contents("https://apimenime.herokuapp.com/anime_info/$url");
	$b = json_decode($a, true);
	$i = file_get_contents($b['img']);
	$src =  base64_encode($i);
	return array(
					"desc" => $b['desc'],
					"info" => $b['info'],
					"img" => $src,
					);
}

function anime_info($url){
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	
	//curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.87 Safari/537.36");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	curl_setopt($ch, CURLOPT_PROXY, null);

	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLINFO_HEADER_OUT, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

    $headers = [
	    'X-Apple-Tz: 0',
	    'X-Apple-Store-Front: 143444,12',
	    'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
	    //'Accept-Encoding: gzip, deflate, br',
	    'Accept-Language: id-ID,id;q=0.9',
	    'Cache-Control: max-age=0',
	    'Content-Type: application/x-www-form-urlencoded; charset=utf-8',
	    'Host: www.oploverz.in',
	    'Referer: https://www.oploverz.in/series/one-piece-sub-indo/', 
	    'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.66 Safari/537.36',
	    //'X-MicrosoftAjax: Delta=true'
	    "Upgrade-Insecure-Requests: 1",
	    "Connection: keep-alive",
	    "cookie: __cfduid=d463c2c74b8cb4ad701c41487ef15ba271592223878; PHPSESSID=cq1245ofoi0qab5gun4lqfj365; _ga=GA1.2.205899321.1592223880; _gid=GA1.2.1323666345.1592223880; HstCfa4237846=1592223880537; HstCmu4237846=1592223880537; c_ref_4237846=https%3A%2F%2Fwww.google.com%2F; __dtsu=1040159222388239E79CA78CAA0D19A1; HstCnv4237846=2; _gat_gtag_UA_126097535_3=1; HstCla4237846=1592234566756; HstPn4237846=6; HstPt4237846=14; HstCns4237846=3"
	];

	//curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$data = curl_exec($ch);
	$info = curl_getinfo($ch);
	$error = curl_error($ch);

	/*echo "<pre>";
	print_r($info);
	echo "<hr>";
	print_r($error);
	echo "</pre>";
	echo htmlentities($data);*/
	//echo $data;

	curl_close($ch);
	$dom = new simple_html_dom(null, true, true, DEFAULT_TARGET_CHARSET, true, DEFAULT_BR_TEXT, DEFAULT_SPAN_TEXT);

	//$html = file_get_html($url);
	$html = $dom->load($data, true, true);
	$info_anime = array();
	foreach ($html->find('.desc') as $con) {
		$info_anime['desc'] = htmlentities($con);
	}
	foreach ($html->find('.listinfo') as $con) {
		$info_anime['info'] = htmlentities($con);
	}
	foreach ($html->find('.imgdesc') as $con) {
		foreach ($con->find('img') as $im) {
			//echo $im->src;
			$a = file_get_contents($im->src);
			$src =  base64_encode($a);
			$info_anime['img'] = $src;
			//echo '<img src="data:image/gif;base64,'.$src.'"> ';
		}
	}
	return $info_anime;
	return [];

}


function anime_info2($url){
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	curl_setopt($ch, CURLOPT_PROXY, null);

	$data = curl_exec($ch);
	$info = curl_getinfo($ch);
	$error = curl_error($ch);

	curl_close($ch);
	$dom = new simple_html_dom(null, true, true, DEFAULT_TARGET_CHARSET, true, DEFAULT_BR_TEXT, DEFAULT_SPAN_TEXT);

	$html = $dom->load($data, true, true);
	$info_anime = array();
	
	foreach ($html->find('.imgdesc') as $con) {
		foreach ($con->find('img') as $im) {
			$a = file_get_contents($im->src);
			$src =  base64_encode($a);
			$info_anime['img'] = $src;
		}
	}
	return $info_anime;
}
/*$anime = anime_info("https://www.oploverz.in/series/boruto-naruto-next-generations/");
echo '<pre>';
print_r($anime);
echo '</pre>';*/

if(isset($_GET['debug_tes'])){
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: x-access-header, Authorization, Origin, X-Requested-With, Content-Type, Accept");

?>
<iframe src="https://www.oploverz.in/" frameborder="0" width="100%"></iframe>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
  <meta name="robots" content="noindex, nofollow" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Just a moment...</title>
  <style type="text/css">
    html, body {width: 100%; height: 100%; margin: 0; padding: 0;}
    body {background-color: #ffffff; color: #000000; font-family:-apple-system, system-ui, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, "Helvetica Neue",Arial, sans-serif; font-size: 16px; line-height: 1.7em;-webkit-font-smoothing: antialiased;}
    h1 { text-align: center; font-weight:700; margin: 16px 0; font-size: 32px; color:#000000; line-height: 1.25;}
    p {font-size: 20px; font-weight: 400; margin: 8px 0;}
    p, .attribution, {text-align: center;}
    #spinner {margin: 0 auto 30px auto; display: block;}
    .attribution {margin-top: 32px;}
    @keyframes fader     { 0% {opacity: 0.2;} 50% {opacity: 1.0;} 100% {opacity: 0.2;} }
    @-webkit-keyframes fader { 0% {opacity: 0.2;} 50% {opacity: 1.0;} 100% {opacity: 0.2;} }
    #cf-bubbles > .bubbles { animation: fader 1.6s infinite;}
    #cf-bubbles > .bubbles:nth-child(2) { animation-delay: .2s;}
    #cf-bubbles > .bubbles:nth-child(3) { animation-delay: .4s;}
    .bubbles { background-color: #f58220; width:20px; height: 20px; margin:2px; border-radius:100%; display:inline-block; }
    a { color: #2c7cb0; text-decoration: none; -moz-transition: color 0.15s ease; -o-transition: color 0.15s ease; -webkit-transition: color 0.15s ease; transition: color 0.15s ease; }
    a:hover{color: #f4a15d}
    .attribution{font-size: 16px; line-height: 1.5;}
    .ray_id{display: block; margin-top: 8px;}
    #cf-wrapper #challenge-form { padding-top:25px; padding-bottom:25px; }
    #cf-hcaptcha-container { text-align:center;}
    #cf-hcaptcha-container iframe { display: inline-block;}
  </style>

      <meta http-equiv="refresh" content="12">
  <script type="text/javascript">
    //<![CDATA[
    (function(){
      
      window._cf_chl_opt={
        cvId: "2",
        cType: "non-interactive",
        cNounce: "51479",
        cRay: "61c485ec6ddc3805",
        cHash: "742cdb4d572f5a5",
        cFPWv: "g",
        cRq: {
          ru: "aHR0cHM6Ly93d3cub3Bsb3ZlcnouaW4v",
          ra: "TW96aWxsYS81LjAgKFdpbmRvd3MgTlQgNi4zOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvNzguMC4zOTA0Ljg3IFNhZmFyaS81MzcuMzY=",
          rm: "R0VU",
          d: "xBMnc1rRA+ZWeNoR6/LBv601ZYnw1jXFEqI3IWNntdlUu0+otQuF+FfGWdt0V2JN4L+KxpsMGtDrw3I8/cUByM/IB8wWtaDwKVnDN8g90Gv31ggYwvh3hZCunPz9Q/s/C9RFy20KroEIuLDTDeR57jf14fLUp3qmwm5pPxlFg9xKkCi69tcFSE0ZfNkyHJ0nczVaBChJTYJMBpAfAay78a3FkCDLc8jsLK/XcG2NDO1IV3dOUnhaLNuZRO8UrSzlP5eK2EirBIY81BAnJqxOuwuhxbzuGqJBCfucDAySW9OPAX3l+Iu0QchbXuFhKDOi0l5P1ebBX336MhTyOXmc090bO60wWIwSl/L+vWVS+x3ZhBC4WmK2+wIyBLi7RH4iqIEAwHKD5ix7etwISMR62iEziuui+ffpJidExvNhs0BkOLjroHUMDlielIyXPrsKvWDRBbJRyBoMjC29auMHRykpx7Z/kfM/X1HXWwvWaT+aNON3QjDllLJ19gy6G6SwUKwh3ndmvzEF6P5X0QVLWpPX6GqdHaR079xx17GBnEnC+8oepq9v08Y5Gj47zIMz5xmZXYAIC6EAD61QXC78jupDKGbfMiezE86Y0IFT4gjd0beurF4rZBXDxQPwyqG4qtAwUxMdzETLz4m8KifCnuvo1lVfNynhZdTiZRXqGvstrx/Pl9KRShHYPKMRqssfRuiehPYOB4VqKYKO1Hgjq8yfk/VlKlmofQwz5RVpic0J/4PJyZbmCkzuRy7g1rWyFX/b/8J69/qwoeAFe8ItSg==",
          t: "MTYxMjQ0MzA4Ni43OTgwMDA=",
          m: "a3tRXXv+JGuFc4MCSHG0x+UMMvdehviGU5DNXQR+eAk=",
          i1: "/ek6KC84ZzuCHFkNUjNNDQ==",
          i2: "lTCH4OrW1XcJAXjNUgmotA==",
          uh: "4qITBfMvi8MO+MWFIuEn15AhL/oB73HBpNsKh3l4hUU=",
          hh: "O0g2CJo9qH1DPRWuN9H7s1Bh0b1SaqsVjSmF0nwwaCc=",
        }
      }
      window._cf_chl_enter = function(){window._cf_chl_opt.p=1};
      
    })();
    //]]>
  </script>
  

</head>
<body>
  <table width="100%" height="100%" cellpadding="20">
    <tr>
      <td align="center" valign="middle">
          <div class="cf-browser-verification cf-im-under-attack">
  <noscript>
    <h1 data-translate="turn_on_js" style="color:#bd2426;">Please turn JavaScript on and reload the page.</h1>
  </noscript>
  <div id="cf-content" style="display:none">
    
    <div id="cf-bubbles">
      <div class="bubbles"></div>
      <div class="bubbles"></div>
      <div class="bubbles"></div>
    </div>
    <h1><span data-translate="checking_browser">Checking your browser before accessing</span> oploverz.in.</h1>
    
    <div id="no-cookie-warning" class="cookie-warning" data-translate="turn_on_cookies" style="display:none">
      <p data-translate="turn_on_cookies" style="color:#bd2426;">Please enable Cookies and reload the page.</p>
    </div>
    <p data-translate="process_is_automatic">This process is automatic. Your browser will redirect to your requested content shortly.</p>
    <p data-translate="allow_5_secs">Please allow up to 5 seconds&hellip;</p>
  </div>
   
  <form class="challenge-form" id="challenge-form" action="/?__cf_chl_jschl_tk__=3bc24498d4b00de89d25fd64359c31cd2e09f049-1612443086-0-ATHV9nDaxWI5-rMZGk9j2nxiGAHP9OFVOtIdUEpkmVnirCcsXaQrEZOHtDBUXKwn5d0jReXnoQ2KKYhOVhh_EaBc3I7xkbSByXPK5utq8pEdg6V5G-KVXRrlu4xr6cLDb3UOTJIIhWkl-RP1LHulY18VLSUwySoNkFIgTeO8pw4hXxFQfPl1CK96ZGd32PQXit35e37sI8jhMNRpPqNO_kXYYI8uWVMnnlmYanc7QtqUfaZITeZboCm03qqjCz2EXwXPx98H5TOY7zhJiuGfFghYG5FHJtMz459PUiGa2LjmQhHS6v7g9nyyTSitc2uyJg" method="POST" enctype="application/x-www-form-urlencoded">
    <input type="hidden" name="r" value="248a3fd59d27e85c72ad7170ff3a4210940643c7-1612443086-0-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"/>
    <input type="hidden" value="4525e65a453eec60631d3e2f62c64164" id="jschl-vc" name="jschl_vc"/>
    <!-- <input type="hidden" value="" id="jschl-vc" name="jschl_vc"/> -->
    <input type="hidden" name="pass" value="1612443090.798-FLIB73j4LE"/>
    <input type="hidden" id="jschl-answer" name="jschl_answer"/>
  </form>
     
    <script type="text/javascript">
      //<![CDATA[
      (function(){
          var a = document.getElementById('cf-content');
          a.style.display = 'block';
          var isIE = /(MSIE|Trident\/|Edge\/)/i.test(window.navigator.userAgent);
          var trkjs = isIE ? new Image() : document.createElement('img');
          trkjs.setAttribute("src", "/cdn-cgi/images/trace/jschal/js/transparent.gif?ray=61c485ec6ddc3805");
          trkjs.id = "trk_jschal_js";
          trkjs.setAttribute("alt", "");
          document.body.appendChild(trkjs);
          var cpo=document.createElement('script');
          cpo.type='text/javascript';
          cpo.src="/cdn-cgi/challenge-platform/h/g/orchestrate/jsch/v1";
          document.getElementsByTagName('head')[0].appendChild(cpo);
        }());
      //]]>
    </script>
  

  
  <div id="trk_jschal_nojs" style="background-image:url('/cdn-cgi/images/trace/jschal/nojs/transparent.gif?ray=61c485ec6ddc3805')"> </div>
</div>

          <!-- <a href="https://premedic.info/sixpenny.php?showtopic=669">table</a> -->
          <div class="attribution">
            DDoS protection by <a rel="noopener noreferrer" href="https://www.cloudflare.com/5xx-error-landing/" target="_blank">Cloudflare</a>
            <br />
            <span class="ray_id">Ray ID: <code>61c485ec6ddc3805</code></span>
          </div>
      </td>
     
    </tr>
  </table>
</body>
</html>
<?php
	$url = "https://www.oploverz.in/"; 
	$a = file_get_contents($url);
	echo $a;
	echo "<hr><hr><hr><hr><hr><hr><hr><hr><hr>";
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	curl_setopt($ch, CURLOPT_PROXY, null);
	curl_setopt($ch, CURLOPT_HTTPHEADER,
	    array(
	        "Upgrade-Insecure-Requests: 1",
	        "User-Agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.87 Safari/537.36",
	        "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3",
	        "Accept-Language: en-US,en;q=0.9",
	        "cookie: __cfduid=d7cad488d51ee8439553a4021c9592dba1612441264; _ga=GA1.2.543937370.1612441267; _gid=GA1.2.2075059068.1612441267; __cf_bm=d95bf8d638e749e5a8248b84d1f19069c2ee89bc-1612441267-1800-AYAwP17Q503w9oTlzW8OsQ4AormFg2F49z3MGWToBUmie7zKLh35MlMbTqI3/E8OwuQI+8DoZZTBT2z8z4PgGHfT3rTdQnRIpHvpNmp7ARDJ+5KAwffeIbHbvULbWdEOEw==; PHPSESSID=r126hve7fjgf6l7ovufg26gfg4; _gat=1; __atuvc=2%7C5; __atuvs=601be6b2cc538daf001"
	    ));

	$data = curl_exec($ch);
	$info = curl_getinfo($ch);
	$error = curl_error($ch);
	echo "<pre>";
	print_r($info);
	echo "<hr>";
	print_r($error);
	echo "<hr>";
	echo $data;
	echo "</pre>";

	curl_close($ch);

}

function list_anime2($url){
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	curl_setopt($ch, CURLOPT_PROXY, null);
	curl_setopt($ch, CURLOPT_HTTPHEADER,
	    array(
	        "Upgrade-Insecure-Requests: 1",
	        "User-Agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.87 Safari/537.36",
	        "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3",
	        "Accept-Language: en-US,en;q=0.9",
	        "cookie: __cfduid=d463c2c74b8cb4ad701c41487ef15ba271592223878; PHPSESSID=cq1245ofoi0qab5gun4lqfj365; _ga=GA1.2.205899321.1592223880; _gid=GA1.2.1323666345.1592223880; HstCfa4237846=1592223880537; HstCmu4237846=1592223880537; c_ref_4237846=https%3A%2F%2Fwww.google.com%2F; __dtsu=1040159222388239E79CA78CAA0D19A1; HstCnv4237846=2; _gat_gtag_UA_126097535_3=1; HstCla4237846=1592234566756; HstPn4237846=6; HstPt4237846=14; HstCns4237846=3"
	    ));

	$data = curl_exec($ch);
	$info = curl_getinfo($ch);
	$error = curl_error($ch);

	curl_close($ch);
	$dom = new simple_html_dom(null, true, true, DEFAULT_TARGET_CHARSET, true, DEFAULT_BR_TEXT, DEFAULT_SPAN_TEXT);
	
	$html = $dom->load($data, true, true);
	$a = array();
	$a["html"] = htmlentities($html);
	foreach ($html->find("#tontonin") as $div) {
		/*echo "<pre>";
		echo htmlentities($div);
		echo "</pre>";*/
		//return array("video" => e_url("http://".$div->attr["src"]));
		$a["video"] = e_url($div->attr["src"]);
	}
	return $a;
	
}


/*$url = "https://anoboy.mobi/avatar-the-legend-of-aang-episode-01/";
//$url = "https://animenine.com/nonton-avatar-the-legend-of-aang-sub-indo/episode-60";
//$url = "https://www.oploverz.in/series/boruto-naruto-next-generations/";
$vid = list_anime2($url);
*/
function list_episode2($url){
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_PROXY, null);
	

	$data = curl_exec($ch);
	$info = curl_getinfo($ch);
	$error = curl_error($ch);

	curl_close($ch);
	$dom = new simple_html_dom(null, true, true, DEFAULT_TARGET_CHARSET, true, DEFAULT_BR_TEXT, DEFAULT_SPAN_TEXT);
	
	$html = $dom->load($data, true, true);
	$ls_eps = [];
	foreach ($html->find(".ep") as $div) {
		foreach ($div->find("a") as $a) {
			//echo $a->plaintext;
			$ls_eps[] = array(
								"judul" => $a->plaintext, 
								"link" => $a->attr["href"], 
								);
		}
	}
	return $ls_eps;
}

function get_kekkaishi($url){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$headers = [
	    'X-Apple-Tz: 0',
	    'X-Apple-Store-Front: 143444,12',
	    'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
	    'Accept-Encoding: gzip, deflate',
	    'Accept-Language: en-US,en;q=0.5',
	    'Cache-Control: no-cache',
	    'Content-Type: application/x-www-form-urlencoded; charset=utf-8',
	    'Host: www3.animeseries.info',
	    'Referer: http://www3.animeseries.info/tvseries/kekkaishi/', 
	    'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:28.0) Gecko/20100101 Firefox/28.0',
	    'X-MicrosoftAjax: Delta=true'
	];

	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$data = curl_exec($ch);
	$info = curl_getinfo($ch);
	$error = curl_error($ch);
	return $info['redirect_url'];
}



function get_dragonball($url){
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url.'/');
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	curl_setopt($ch, CURLOPT_PROXY, null);

	$data = curl_exec($ch);
	$info = curl_getinfo($ch);
	$error = curl_error($ch);
	$dom = new simple_html_dom(null, true, true, DEFAULT_TARGET_CHARSET, true, DEFAULT_BR_TEXT, DEFAULT_SPAN_TEXT);

	//$html = file_get_html($url);
	$html = $dom->load($data, true, true);
	$list_episode = array();

	foreach ($html->find(".playeriframe") as $iframe) {
		return $iframe->src;
	}
}

function korra_vid($url){
	$vid = korak_vid1($url);
	if($vid!=''){
		return $vid; 
	}else{
		return 'embed';
	}
}

function korak_vid1($url){
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_PROXY, null);
	

	$data = curl_exec($ch);
	$info = curl_getinfo($ch);
	$error = curl_error($ch);

	curl_close($ch);
	$dom = new simple_html_dom(null, true, true, DEFAULT_TARGET_CHARSET, true, DEFAULT_BR_TEXT, DEFAULT_SPAN_TEXT);
	
	$html = $dom->load($data, true, true);
	foreach ($html->find(".video-js") as $vid) {
		foreach ($vid->find("source") as $src) {
			return $src->attr['src'];
		}
	}
}


function cek_update_anime($list_episode, $origin){
	$le = list_episode_page($origin);
	unset($le[0]);
	$le = array_values($le);
	$eps_lama = (int)explode(" ", $list_episode[0]['eps'])[1];
	$eps_baru_arr = explode(" ", $le[0]['eps']);
	$eps_baru = $eps_lama;
	foreach ($eps_baru_arr as $k => $v) {
		if(is_numeric($v)){
			$eps_baru = (int)$v;
		}
	}
	$kur = 0;
	$new = [];
	if($eps_baru>$eps_lama){
		$kur = $eps_baru-$eps_lama;
		$new = array_splice($le, 0, $kur);
		foreach ($new as $k => $v) {
			$eps = preg_replace('/\s+/', ' ', trim($v['eps']));
			$judul = trim($v['judul']);
			$new[$k]['eps'] = $eps;
			$new[$k]['judul'] = $judul;
			$new[$k]['sts'] = '1';
			$new[$k]['div'] = $kur;
		}
		$list_episode = array_merge($new, $list_episode);
	}
	return $list_episode;
}

/*
$url = "https://anoboy.mobi/anime/avatar-the-legend-of-aang/";
$vid = list_episode2($url);*/


?>
