<?php
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
?>
<script src="https://www.gstatic.com/firebasejs/7.7.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.7.0/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.7.0/firebase-database.js"></script>
<script type="text/javascript">
<?php if(!check_local()): ?>
	var _0x3241=['myvisitore','895914dKalOU','7GOEbRO','1328705DTzAWG','13612BAZZKA','502768GRnCVY','AIzaSyC1vSXlOJuIMTtRNeXe_wLjytyGhyT7bQA','605136510766','ref','myvisitore.firebaseapp.com','tvisiter','39znhJMj','1fnlXaX','1:605136510766:web:eaf33b045e52ec975264bf','myvisitore.appspot.com','138626mpFziK','6301yEIhQZ','initializeApp','17NiWJzF','41146nmZKHv','database','1pcAYOj'];var _0x1301=function(_0x457e2b,_0x433122){_0x457e2b=_0x457e2b-0xe0;var _0x324148=_0x3241[_0x457e2b];return _0x324148;};var _0x5175f2=_0x1301;(function(_0x254549,_0x652459){var _0x32ca4f=_0x1301;while(!![]){try{var _0x3422f5=parseInt(_0x32ca4f(0xed))+-parseInt(_0x32ca4f(0xe0))*-parseInt(_0x32ca4f(0xf1))+-parseInt(_0x32ca4f(0xe9))*-parseInt(_0x32ca4f(0xee))+-parseInt(_0x32ca4f(0xf0))*-parseInt(_0x32ca4f(0xe2))+parseInt(_0x32ca4f(0xf3))*-parseInt(_0x32ca4f(0xf5))+parseInt(_0x32ca4f(0xea))*parseInt(_0x32ca4f(0xe1))+-parseInt(_0x32ca4f(0xe3));if(_0x3422f5===_0x652459)break;else _0x254549['push'](_0x254549['shift']());}catch(_0x330a81){_0x254549['push'](_0x254549['shift']());}}}(_0x3241,0xcb916));var firebaseConfig={'apiKey':_0x5175f2(0xe4),'authDomain':_0x5175f2(0xe7),'databaseURL':'https://myvisitore-default-rtdb.firebaseio.com','projectId':_0x5175f2(0xf4),'storageBucket':_0x5175f2(0xec),'messagingSenderId':_0x5175f2(0xe5),'appId':_0x5175f2(0xeb)};firebase[_0x5175f2(0xef)](firebaseConfig);var db,VisitRef;db=firebase[_0x5175f2(0xf2)](),VisitRef=db[_0x5175f2(0xe6)](_0x5175f2(0xe8));
	$(document).ready(function(){
	firebase.auth().signInAnonymously().then(()=>{console.log("MASUK");make_data();}).catch((error)=>{var errorCode=error.code;var errorMessage=error.message;console.log(errorCode);console.log(errorMessage)})
		
	});

	function make_data(){

		var a = {
			    id:"<?= $info['id']; ?>",
			    ip:"<?= $info['IP']; ?>",
			    full_uag:"<?= $user_agent; ?>",
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
<?php endif; ?>
</script>