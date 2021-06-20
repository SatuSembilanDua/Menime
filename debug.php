<?php

require "config/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Menime Debug</title>
	<link rel="shortcut icon" href="assets/img/logo.png" type="image/x-icon"/>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/font-awesome.css">
	
	<link rel="stylesheet" href="assets/css/dataTables.bootstrap.min.css">

    <script src="assets/js/jquery.min.js"></script>
</head>
<body>
<br>
<div class="container-fluid">
<?php
	$ipaddress = "<b>CLIENT IP</b><br>";
	$ipaddress .= "HTTP_CLIENT_IP ".gen_tab(2)." : <b>".getenv('HTTP_CLIENT_IP')."</b><br>";
	$ipaddress .= "HTTP_X_FORWARDED_FOR ".gen_tab(1)." : <b>".getenv('HTTP_X_FORWARDED_FOR')."</b><br>";
	$ipaddress .= "HTTP_X_FORWARDED ".gen_tab(1)." : <b>".getenv('HTTP_X_FORWARDED')."</b><br>";
	$ipaddress .= "HTTP_FORWARDED_FOR ".gen_tab(1)." : <b>".getenv('HTTP_FORWARDED_FOR')."</b><br>";
	$ipaddress .= "HTTP_FORWARDED ".gen_tab(2)." : <b>".getenv('HTTP_FORWARDED')."</b><br>";
	$ipaddress .= "REMOTE_ADDR ".gen_tab(2)." : <b>".getenv('REMOTE_ADDR')."</b><br>";
	pre($ipaddress);

	$uag =  "<b>USER AGENT</b><br>";
	$uag .= "HTTP_USER_AGENT ".gen_tab(1)." : <b>".$_SERVER['HTTP_USER_AGENT']."</b><br>";  
	$uag .= "BROWSER ".gen_tab(2)." : <b>".getBrowser()."</b><br>";
	$uag .= "OS ".gen_tab(3)." : <b>".getOS()."</b><br>";
	pre($uag);


/*	$info = array(
		"id" => $id,
		"IP" => $ip,
		"browser" => $browser,
		"os" => $os,
		"date" => date("Y-m-d H:i:s"),
		"link" => "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]",
		"title" => $title,
	);*/
?>
	<hr>
	<table class="table table-list myTable">
		<thead>
			<tr>
				<th>User</th>
				<th>Visit</th>
				<th>Date</th>
			</tr>
		</thead>
		<tbody>
			
		</tbody>
	</table>
</div>


	<script src="assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="assets/js/dataTables.bootstrap.min.js"></script>
	<script src="https://www.gstatic.com/firebasejs/7.7.0/firebase-app.js"></script>
	<script src="https://www.gstatic.com/firebasejs/7.7.0/firebase-auth.js"></script>
	<script src="https://www.gstatic.com/firebasejs/7.7.0/firebase-database.js"></script>
	<script type="text/javascript">
		var table = $('.myTable').DataTable({
			"lengthMenu": [[100, 200, 300, -1], [100, 200, 300, "All"]]
		});

		var _0x3241=['myvisitore','895914dKalOU','7GOEbRO','1328705DTzAWG','13612BAZZKA','502768GRnCVY','AIzaSyC1vSXlOJuIMTtRNeXe_wLjytyGhyT7bQA','605136510766','ref','myvisitore.firebaseapp.com','tvisit2','39znhJMj','1fnlXaX','1:605136510766:web:eaf33b045e52ec975264bf','myvisitore.appspot.com','138626mpFziK','6301yEIhQZ','initializeApp','17NiWJzF','41146nmZKHv','database','1pcAYOj'];var _0x1301=function(_0x457e2b,_0x433122){_0x457e2b=_0x457e2b-0xe0;var _0x324148=_0x3241[_0x457e2b];return _0x324148;};var _0x5175f2=_0x1301;(function(_0x254549,_0x652459){var _0x32ca4f=_0x1301;while(!![]){try{var _0x3422f5=parseInt(_0x32ca4f(0xed))+-parseInt(_0x32ca4f(0xe0))*-parseInt(_0x32ca4f(0xf1))+-parseInt(_0x32ca4f(0xe9))*-parseInt(_0x32ca4f(0xee))+-parseInt(_0x32ca4f(0xf0))*-parseInt(_0x32ca4f(0xe2))+parseInt(_0x32ca4f(0xf3))*-parseInt(_0x32ca4f(0xf5))+parseInt(_0x32ca4f(0xea))*parseInt(_0x32ca4f(0xe1))+-parseInt(_0x32ca4f(0xe3));if(_0x3422f5===_0x652459)break;else _0x254549['push'](_0x254549['shift']());}catch(_0x330a81){_0x254549['push'](_0x254549['shift']());}}}(_0x3241,0xcb916));var firebaseConfig={'apiKey':_0x5175f2(0xe4),'authDomain':_0x5175f2(0xe7),'databaseURL':'https://myvisitore-default-rtdb.firebaseio.com','projectId':_0x5175f2(0xf4),'storageBucket':_0x5175f2(0xec),'messagingSenderId':_0x5175f2(0xe5),'appId':_0x5175f2(0xeb)};firebase[_0x5175f2(0xef)](firebaseConfig);var db,VisitRef;db=firebase[_0x5175f2(0xf2)](),VisitRef=db[_0x5175f2(0xe6)](_0x5175f2(0xe8));

		VisitRef.on("value", function(snapshot) {
			var dada = [];
			var i=1;
			snapshot.forEach(function(childSnapshot) {
		      	var childData = childSnapshot.val();
		      	dada[i] = {
			      				no:i,
			      				id:childData.id,
			      				user:childData.IP+"<br>"+childData.browser+"<br>"+childData.os,
			      				visit:childData.title+"<br>"+childData.link,
			      				date:childData.date
		      				};
		      	var a = [
		      				/*i,
		      				childData.id,*/
		      				childData.ip+"<br>"+childData.browser+"<br>"+childData.os,
		      				childData.title+"<br>"+childData.link,
		      				childData.date
		      			];
		      	table.rows.add([a]).draw();
		      	i++;
		    });
		}, function (errorObject) {
	  		console.log("The read failed: " + errorObject.code);
		});
		

		function dataGagal(err) {
			console.log(err);
		}
		function dataBerubah(){
			console.log("Data Berhasil disimpan!");
		}
	</script>
</body>
</html>
