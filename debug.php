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
    <style>

	@media (min-width: 320px) and (max-width: 480px) {
    	.link_txt{
    		width: 100px;
    		text-overflow: ellipsis;
		    white-space: nowrap;
		    overflow: hidden;
    	}
   	}
    </style>
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
	<pre>
Server Time : <b id="txt_date"><?= date("d-m-Y H:i:s"); ?></b></pre>
	<hr>
	<div class="container-fluid well">
		<canvas id="myChart"></canvas>
	</div>
	<hr>
	<table class="table table-striped table-list myTable">
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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js" integrity="sha512-VCHVc5miKoln972iJPvkQrUYYq7XpxXzvqNfiul1H4aZDwGBGC0lq373KNleaB2LpnC2a/iNfE5zoRYmB4TRDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdn.jsdelivr.net/npm/moment@2.27.0"></script>
	<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-moment@0.1.1"></script>
	<script type="text/javascript">
		var table = $('.myTable').DataTable({
			"lengthMenu": [[100, 200, 300, -1], [100, 200, 300, "All"]],
			"order": [[ 2, "desc" ]],
			"responsive": true
		});
		var data_chart = [];
		var ctx = document.getElementById('myChart').getContext('2d');
		var myChart = new Chart(ctx, {
		    type: 'line',
		    data: {
		    	datasets:[{
		    		label: "Visitor",
		    		backgroundColor: 'rgb(255, 99, 132)',
					borderColor: 'rgb(255, 99, 132)',
		    		data: data_chart
		    	}]
		    },
		   	options: {
		   	 	plugins: {
		      		title: {
		        		text: 'Visitor per days',
		        		display: true
		      		}
		    	},
			    scales: {
			      	x: {
			        	type: 'time',
			        	time: {
			          		unit: 'month'
			        	},
			        	title: {
			          		display: true,
			          		text: 'Date'
			        	}
			      	},
			      	y: {
			        	title: {
			          		display: true,
			          		text: 'value'
			        	}
			      	}
			    },
			}
		});


		/*$.getJSON("data.json", function(result){
			var tmp_data_chart = [];
			$.each(result, function(i, field){
				var a = [
		      				field.ip+"<br>"+field.browser+"<br>"+field.os,
		      				field.title+"<br><p class='link_txt'>"+field.link+'</p>',
		      				field.date
		      			];
		      	table.rows.add([a]).draw();
				var da = field.date.split(" ")[0];
				if(tmp_data_chart[da] == undefined){
		      		tmp_data_chart[da] = 0;
				}else{
		      		tmp_data_chart[da] += 1;
				}
			});
			var data_chart = [];
			for (var key in tmp_data_chart) {
				data_chart.push({"x":key, "y":tmp_data_chart[key]})
			}
			
		});*/

		
		setInterval(function(){
			$("#txt_date").load("config/config.php?get_time");
		},3000);

		
		var _0x3241=['myvisitore','895914dKalOU','7GOEbRO','1328705DTzAWG','13612BAZZKA','502768GRnCVY','AIzaSyC1vSXlOJuIMTtRNeXe_wLjytyGhyT7bQA','605136510766','ref','myvisitore.firebaseapp.com','tvisiter','39znhJMj','1fnlXaX','1:605136510766:web:eaf33b045e52ec975264bf','myvisitore.appspot.com','138626mpFziK','6301yEIhQZ','initializeApp','17NiWJzF','41146nmZKHv','database','1pcAYOj'];var _0x1301=function(_0x457e2b,_0x433122){_0x457e2b=_0x457e2b-0xe0;var _0x324148=_0x3241[_0x457e2b];return _0x324148;};var _0x5175f2=_0x1301;(function(_0x254549,_0x652459){var _0x32ca4f=_0x1301;while(!![]){try{var _0x3422f5=parseInt(_0x32ca4f(0xed))+-parseInt(_0x32ca4f(0xe0))*-parseInt(_0x32ca4f(0xf1))+-parseInt(_0x32ca4f(0xe9))*-parseInt(_0x32ca4f(0xee))+-parseInt(_0x32ca4f(0xf0))*-parseInt(_0x32ca4f(0xe2))+parseInt(_0x32ca4f(0xf3))*-parseInt(_0x32ca4f(0xf5))+parseInt(_0x32ca4f(0xea))*parseInt(_0x32ca4f(0xe1))+-parseInt(_0x32ca4f(0xe3));if(_0x3422f5===_0x652459)break;else _0x254549['push'](_0x254549['shift']());}catch(_0x330a81){_0x254549['push'](_0x254549['shift']());}}}(_0x3241,0xcb916));var firebaseConfig={'apiKey':_0x5175f2(0xe4),'authDomain':_0x5175f2(0xe7),'databaseURL':'https://myvisitore-default-rtdb.firebaseio.com','projectId':_0x5175f2(0xf4),'storageBucket':_0x5175f2(0xec),'messagingSenderId':_0x5175f2(0xe5),'appId':_0x5175f2(0xeb)};firebase[_0x5175f2(0xef)](firebaseConfig);var db,VisitRef;db=firebase[_0x5175f2(0xf2)](),VisitRef=db[_0x5175f2(0xe6)](_0x5175f2(0xe8));
		
		VisitRef.on("value", function(snapshot) {

			var tmp_data_chart = [];
			snapshot.forEach(function(childSnapshot) {
		      	var childData = childSnapshot.val();
		      	var a = [
		      				childData.ip+"<br>"+childData.browser+"<br>"+childData.os,
		      				childData.title+"<br><p class='link_txt'>"+childData.link+'</p>',
		      				childData.date
		      			];
		      	table.rows.add([a]).draw();
		      	var da = childData.date.split(" ")[0];
				if(tmp_data_chart[da] == undefined){
		      		tmp_data_chart[da] = 0;
				}else{
		      		tmp_data_chart[da] += 1;
				}
		    });
			for (var key in tmp_data_chart) {
				data_chart.push({"x":key, "y":tmp_data_chart[key]})
			}
			data_chart.sort(function(a, b) {
			  	var keyA = new Date(a.x),
			    keyB = new Date(b.x);
			  	// Compare the 2 dates
			  	if (keyA < keyB) return -1;
			  	if (keyA > keyB) return 1;
			  	return 0;
			});
			myChart.data.datasets = [{
		    		label: "Visitor",
		    		backgroundColor: 'rgb(255, 99, 132)',
					borderColor: 'rgb(255, 99, 132)',
		    		data: data_chart
		    	}];
		    myChart.update();

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
