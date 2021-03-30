<?php
date_default_timezone_set("Asia/Jakarta");
$user_agent = $_SERVER['HTTP_USER_AGENT'];
/*echo "IP anda adalah : ". get_client_ip()."<br>";
echo "Browser : ".getBrowser()."<br>";
echo "Sistem Operasi : ".getOS()."<br>";
echo "Browser : ".$_SERVER['HTTP_USER_AGENT']."<br>";*/
$ip = get_client_ip();
$browser = getBrowser();
$os = getOS();
$id = $ip.$browser.$os;
$id = md5($id);
$info = array(
				"id" => $id,
				"IP" => $ip,
				"browser" => $browser,
				"os" => $os,
				"date" => date("Y-m-d H:i:s"),
				"link" => "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]",
				"title" => $title,
				);
/*echo "<pre>";
print_r($info);
echo "</pre>";*/

function get_client_ip() {
	$ipaddress = '';
	if (getenv('HTTP_CLIENT_IP'))
		$ipaddress = getenv('HTTP_CLIENT_IP');
	else if(getenv('HTTP_X_FORWARDED_FOR'))
		$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	else if(getenv('HTTP_X_FORWARDED'))
		$ipaddress = getenv('HTTP_X_FORWARDED');
	else if(getenv('HTTP_FORWARDED_FOR'))
		$ipaddress = getenv('HTTP_FORWARDED_FOR');
	else if(getenv('HTTP_FORWARDED'))
	   $ipaddress = getenv('HTTP_FORWARDED');
	else if(getenv('REMOTE_ADDR'))
		$ipaddress = getenv('REMOTE_ADDR');
	else
		$ipaddress = 'IP tidak dikenali';
	return $ipaddress;
}
function get_client_ip_2() {
	$ipaddress = '';
	if (isset($_SERVER['HTTP_CLIENT_IP']))
		$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
	else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
		$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
	else if(isset($_SERVER['HTTP_X_FORWARDED']))
		$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
	else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
		$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
	else if(isset($_SERVER['HTTP_FORWARDED']))
		$ipaddress = $_SERVER['HTTP_FORWARDED'];
	else if(isset($_SERVER['REMOTE_ADDR']))
		$ipaddress = $_SERVER['REMOTE_ADDR'];
	else
		$ipaddress = 'IP tidak dikenali';
	return $ipaddress;
}
function get_client_browser() {
	$browser = '';
	if(strpos($_SERVER['HTTP_USER_AGENT'], 'Netscape'))
		$browser = 'Netscape';
	else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox'))
		$browser = 'Firefox';
	else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome'))
		$browser = 'Chrome';
	else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Opera'))
		$browser = 'Opera';
	else if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE'))
		$browser = 'Internet Explorer';
	else
		$browser = 'Other';
	return $browser;
}
function getOS() { 
	global $user_agent;
	$os_platform  = "Unknown OS Platform";
	$os_array     = array(
						  '/windows nt 10/i'      =>  'Windows 10',
						  '/windows nt 6.3/i'     =>  'Windows 8.1',
						  '/windows nt 6.2/i'     =>  'Windows 8',
						  '/windows nt 6.1/i'     =>  'Windows 7',
						  '/windows nt 6.0/i'     =>  'Windows Vista',
						  '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
						  '/windows nt 5.1/i'     =>  'Windows XP',
						  '/windows xp/i'         =>  'Windows XP',
						  '/windows nt 5.0/i'     =>  'Windows 2000',
						  '/windows me/i'         =>  'Windows ME',
						  '/win98/i'              =>  'Windows 98',
						  '/win95/i'              =>  'Windows 95',
						  '/win16/i'              =>  'Windows 3.11',
						  '/macintosh|mac os x/i' =>  'Mac OS X',
						  '/mac_powerpc/i'        =>  'Mac OS 9',
						  '/linux/i'              =>  'Linux',
						  '/ubuntu/i'             =>  'Ubuntu',
						  '/iphone/i'             =>  'iPhone',
						  '/ipod/i'               =>  'iPod',
						  '/ipad/i'               =>  'iPad',
						  '/android/i'            =>  'Android',
						  '/blackberry/i'         =>  'BlackBerry',
						  '/webos/i'              =>  'Mobile'
					);

	foreach ($os_array as $regex => $value)
		if (preg_match($regex, $user_agent)){
			$os_platform = $value;
			if($value=="Android"){
				preg_match('/android ([0-9.]+)/i', $user_agent, $oa);
				$os_platform .= " ".$oa[1];
			}

		}

	return $os_platform;
}
function getBrowser() {
	global $user_agent;
	$browser        = "Unknown Browser";
	$browser_array = array(
							'/msie/i'      => 'Internet Explorer',
							'/firefox/i'   => 'Firefox',
							'/safari/i'    => 'Safari',
							'/chrome/i'    => 'Chrome',
							'/edge/i'      => 'Edge',
							'/opera/i'     => 'Opera',
							'/netscape/i'  => 'Netscape',
							'/maxthon/i'   => 'Maxthon',
							'/konqueror/i' => 'Konqueror',
							'/mobile/i'    => 'Handheld Browser',
							'/edg/i'    => 'Edge',
							'/samsungbrowser/i'    => 'Samsung Browser',
					 );

	foreach ($browser_array as $regex => $value)
		if (preg_match($regex, $user_agent))
			$browser = $value;

	return $browser;
}

?>
<script src="https://www.gstatic.com/firebasejs/7.7.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.7.0/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.7.0/firebase-database.js"></script>
<script type="text/javascript">

	var _0x3241=['myvisitore','895914dKalOU','7GOEbRO','1328705DTzAWG','13612BAZZKA','502768GRnCVY','AIzaSyC1vSXlOJuIMTtRNeXe_wLjytyGhyT7bQA','605136510766','ref','myvisitore.firebaseapp.com','tvisit','39znhJMj','1fnlXaX','1:605136510766:web:eaf33b045e52ec975264bf','myvisitore.appspot.com','138626mpFziK','6301yEIhQZ','initializeApp','17NiWJzF','41146nmZKHv','database','1pcAYOj'];var _0x1301=function(_0x457e2b,_0x433122){_0x457e2b=_0x457e2b-0xe0;var _0x324148=_0x3241[_0x457e2b];return _0x324148;};var _0x5175f2=_0x1301;(function(_0x254549,_0x652459){var _0x32ca4f=_0x1301;while(!![]){try{var _0x3422f5=parseInt(_0x32ca4f(0xed))+-parseInt(_0x32ca4f(0xe0))*-parseInt(_0x32ca4f(0xf1))+-parseInt(_0x32ca4f(0xe9))*-parseInt(_0x32ca4f(0xee))+-parseInt(_0x32ca4f(0xf0))*-parseInt(_0x32ca4f(0xe2))+parseInt(_0x32ca4f(0xf3))*-parseInt(_0x32ca4f(0xf5))+parseInt(_0x32ca4f(0xea))*parseInt(_0x32ca4f(0xe1))+-parseInt(_0x32ca4f(0xe3));if(_0x3422f5===_0x652459)break;else _0x254549['push'](_0x254549['shift']());}catch(_0x330a81){_0x254549['push'](_0x254549['shift']());}}}(_0x3241,0xcb916));var firebaseConfig={'apiKey':_0x5175f2(0xe4),'authDomain':_0x5175f2(0xe7),'databaseURL':'https://myvisitore-default-rtdb.firebaseio.com','projectId':_0x5175f2(0xf4),'storageBucket':_0x5175f2(0xec),'messagingSenderId':_0x5175f2(0xe5),'appId':_0x5175f2(0xeb)};firebase[_0x5175f2(0xef)](firebaseConfig);var db,VisitRef;db=firebase[_0x5175f2(0xf2)](),VisitRef=db[_0x5175f2(0xe6)](_0x5175f2(0xe8));


	make_data();
	function make_data(){

		var a = {
			    id:"<?= $info['id']; ?>",
			    ip:"<?= $info['IP']; ?>",
			    browser:"<?= $info['browser']; ?>",
			    os:"<?= $info['os']; ?>",
			    date:"<?= $info['date']; ?>",
			    link:"<?= $info['link']; ?>",
			    title:"<?= $info['title']; ?>"
		};
		//console.log(a);
		VisitRef.push(a);
		VisitRef.on('child_changed' , dataBerubah , dataGagal);
	}

	function dataGagal(err) {
		console.log(err);
	}
	function dataBerubah(){
		console.log("Data Berhasil disimpan!");
	}
</script>