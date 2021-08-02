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
    .link_txt{
		width: 300px;
		text-overflow: ellipsis;
	    white-space: nowrap;
	    overflow: hidden;
	}
	.preload{
		position: fixed;
		width: 100%;
		height: 100%;
		top: 0;
		left: 0;
		background: rgba(0,0,0, 0.6);
		z-index: 9999;
	}
	.tab-pane{
		min-height: 400px;
	}
	@media (min-width: 320px) and (max-width: 480px) {
    	.link_txt{
    		width: 100px;
    	}
   	}
    </style>
</head>
<body>
<div class="preload"></div>
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
?>
	<pre>
Server Time : <b id="txt_date"><?= date("d-m-Y H:i:s"); ?></b></pre>
	<hr>
	<div class="container-fluid well">
		<canvas id="myChart"></canvas>
	</div>
	<hr>
<pre>
Today's Traffic  	: <b id="t_visit">0</b>
Today's Visitor 	: <b id="ut_visit">0</b>
All Traffic		: <b id="all_visit">0</b>
All Visitor 		: <b id="u_visit">0</b>
</pre>
	<hr>
	<div>

	  	<!-- Nav tabs -->
	  	<ul class="nav nav-tabs" role="tablist">
		    <li role="presentation" class="active"><a href="#traffic" aria-controls="traffic" role="tab" data-toggle="tab">Traffic</a></li>
		    <li role="presentation"><a href="#user" aria-controls="user" role="tab" data-toggle="tab">User</a></li>
		    <li role="presentation"><a href="#pages" aria-controls="pages" role="tab" data-toggle="tab">Pages</a></li>
		</ul>
	  	<div class="tab-content">
    		<div role="tabpanel" class="tab-pane active" id="traffic">
    			<br>
				<table class="table table-striped table-list myTable">
					<thead>
						<tr>
							<th>User</th>
							<th>Date</th>
							<th>Visit</th>
						</tr>
					</thead>
					<tbody>
						
					</tbody>
				</table>
			</div>

    		<div role="tabpanel" class="tab-pane" id="user">
    			<br>
    			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  				<?php
  					$panel = [
  								"myTable_alluser" => ["judul" => "All User", "th" => ["User", "Visit"], "type" => 1, "var" => "all" ],
  								"myTable_alluserperdate" => ["judul" => "All User per Date", "th" => ["User", "Date", "Visit"], "type" => 2, "var" => "all" ],
  								"myTable_ipuser" => ["judul" => "User by IP", "th" => ["User", "Visit"], "type" => 1, "var" => "ip" ],
  								"myTable_ipuserperdate" => ["judul" => "User by IP per Date", "th" => ["User", "Date", "Visit"], "type" => 2, "var" => "ip" ],
  								"myTable_broweruser" => ["judul" => "User by Browser", "th" => ["User", "Visit"], "type" => 1, "var" => "browser" ],
  								"myTable_broweruserperdate" => ["judul" => "User by Browser per Date", "th" => ["User", "Date", "Visit"], "type" => 2, "var" => "browser" ],
  								"myTable_osuser" => ["judul" => "User by OS", "th" => ["User", "Visit"], "type" => 1, "var" => "os" ],
  								"myTable_osuserperdate" => ["judul" => "User by OS per Date", "th" => ["User", "Date", "Visit"], "type" => 2, "var" => "os" ],
  								];

  					$k = 1;
  					foreach ($panel as $key => $v) {
  				?>
  					<div class="panel panel-primary">
    					<div class="panel-heading" role="tab" id="heading<?= $k; ?>">
      						<h4 class="panel-title">
						        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $k; ?>" aria-expanded="true" aria-controls="collapse<?= $k; ?>">
						          	<?= $v["judul"]; ?>
						        </a>
      						</h4>
    					</div>
					    <div id="collapse<?= $k; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?= $k; ?>">
					      	<div class="panel-body">
					        	<table class="table table-striped table-list <?= $key; ?>">
									<thead>
										<tr>
											<th><?= join("</th><th>", $v["th"]); ?></th>
										</tr>
									</thead>
									<tbody></tbody>
								</table>
					        </div>
					    </div>
  					</div>
  				<?php
  					$k++;
  					}
  				?>
  				<script type="text/javascript">
  					var panel = [
  								"myTable_alluser", "myTable_alluserperdate",
  								"myTable_ipuser", "myTable_ipuserperdate",
  								];
  				</script>
  				</div>
			</div>
			<div role="tabpanel" class="tab-pane" id="pages">
    			<br>
    			<table class="table table-striped table-list myTable_pages">
					<thead>
						<tr>
							<th>Pages</th>
							<th>Visit</th>
						</tr>
					</thead>
					<tbody>
						
					</tbody>
				</table>
    		</div>
		</div>
	</div>
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
	<script src="https://cdn.jsdelivr.net/npm/hammerjs@2.0.8"></script>
	<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom@1.0.1/dist/chartjs-plugin-zoom.min.js"></script>

	<script type="text/javascript">
		var all_data = [];
		var sudah_user = false;
		var sudah_pages = false;

		$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		  	/*e.target; // newly activated tab
		  	e.relatedTarget; // previous active tab*/
		  	if($(e.target).text() == "User"){
		  		if(sudah_user==false){
		  			data_data_data(all_data);
		  			sudah_user=true;
		  		}
		  	}else if($(e.target).text() == "Pages"){
		  		if(sudah_pages==false){
		  			data_data_pages(all_data);
		  			sudah_pages=true;
		  		}
		  	}
		});

		var setting_tabel = {
			"lengthMenu": [[100, 200, 300, -1], [100, 200, 300, "All"]],
			"order": [[ 1, "desc" ]],
			"responsive": true
		};
		var table = $('.myTable').DataTable(setting_tabel);
		<?php
			foreach ($panel as $key => $v) {
				$tbl = explode("_", $key)[1];
				echo "var table_$tbl = \$('.$key').DataTable(setting_tabel);";
			}
		?>
		var table_pages = $(".myTable_pages").DataTable(setting_tabel);

		var data_chart = [];
		var ctx = document.getElementById('myChart').getContext('2d');
		var myChart = new Chart(ctx, {
		    type: 'line',
		    data: {
		    	datasets:[{
		    		label: "Traffic",
		    		backgroundColor: 'rgb(255, 99, 132)',
					borderColor: 'rgb(255, 99, 132)',
		    		data: data_chart
		    	}]
		    },
		   	options: {
		   	 	plugins: {
		      		title: {
		        		text: 'Traffic per days',
		        		display: true
		      		},
				    zoom: {
				        zoom: {
				          	wheel: {
				            	enabled: true,
				          	},
				          	pinch: {
				            	enabled: true
				          	},
				          	mode: 'x',
				        }
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
		/*setInterval(function(){
			$("#txt_date").load("config/config.php?get_time");
		},3000);*/

		var is_loaded = false;
		var _0x3241=['myvisitore','895914dKalOU','7GOEbRO','1328705DTzAWG','13612BAZZKA','502768GRnCVY','AIzaSyC1vSXlOJuIMTtRNeXe_wLjytyGhyT7bQA','605136510766','ref','myvisitore.firebaseapp.com','tvisiter','39znhJMj','1fnlXaX','1:605136510766:web:eaf33b045e52ec975264bf','myvisitore.appspot.com','138626mpFziK','6301yEIhQZ','initializeApp','17NiWJzF','41146nmZKHv','database','1pcAYOj'];var _0x1301=function(_0x457e2b,_0x433122){_0x457e2b=_0x457e2b-0xe0;var _0x324148=_0x3241[_0x457e2b];return _0x324148;};var _0x5175f2=_0x1301;(function(_0x254549,_0x652459){var _0x32ca4f=_0x1301;while(!![]){try{var _0x3422f5=parseInt(_0x32ca4f(0xed))+-parseInt(_0x32ca4f(0xe0))*-parseInt(_0x32ca4f(0xf1))+-parseInt(_0x32ca4f(0xe9))*-parseInt(_0x32ca4f(0xee))+-parseInt(_0x32ca4f(0xf0))*-parseInt(_0x32ca4f(0xe2))+parseInt(_0x32ca4f(0xf3))*-parseInt(_0x32ca4f(0xf5))+parseInt(_0x32ca4f(0xea))*parseInt(_0x32ca4f(0xe1))+-parseInt(_0x32ca4f(0xe3));if(_0x3422f5===_0x652459)break;else _0x254549['push'](_0x254549['shift']());}catch(_0x330a81){_0x254549['push'](_0x254549['shift']());}}}(_0x3241,0xcb916));var firebaseConfig={'apiKey':_0x5175f2(0xe4),'authDomain':_0x5175f2(0xe7),'databaseURL':'https://myvisitore-default-rtdb.firebaseio.com','projectId':_0x5175f2(0xf4),'storageBucket':_0x5175f2(0xec),'messagingSenderId':_0x5175f2(0xe5),'appId':_0x5175f2(0xeb)};firebase[_0x5175f2(0xef)](firebaseConfig);var db,VisitRef;db=firebase[_0x5175f2(0xf2)](),VisitRef=db[_0x5175f2(0xe6)](_0x5175f2(0xe8));
		
		if(!is_loaded){
			VisitRef.on("value", function(snapshot) {
				console.log("load data");
				var tmp_data = [];
				snapshot.forEach(function(childSnapshot) {
			      	var childData = childSnapshot.val();
			      	tmp_data.push(childData);
			    });
			    data_data(tmp_data);
				console.log("done load data");
			}, function (errorObject) {
		  		console.log("The read failed: " + errorObject.code);
			});
		}
		

		function dataGagal(err) {
			console.log(err);
		}
		function dataBerubah(){
			console.log("Data Berhasil disimpan!");
		}
		
		/*$.getJSON("data.json", function(result){
			var td = [];
			$.each(result, function(i, field){
				td.push(field);
			});
			data_data(td);
		});*/


		function data_data(data){
			is_loaded = true;
			console.log("show data");
			var row = [];
			var tmp_data_chart = [];
			
			data.forEach(function(childData, i) {
				row.push(
							[
			      				childData.ip+"<br>"+childData.browser+"<br>"+childData.os,
			      				childData.date,
			      				childData.title+"<br><p class='link_txt' data-text='1' onclick='view_link(this)'>"+childData.link+'</p>'
			      			]
			      		);
				/* FOR CHART */
				var da = childData.date.split(" ")[0];
				if(tmp_data_chart[da] == undefined){
		      		tmp_data_chart[da] = 1;
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
			  	if (keyA < keyB) return -1;
			  	if (keyA > keyB) return 1;
			  	return 0;
			});
			myChart.data.datasets = [{
		    		label: "Traffic",
		    		backgroundColor: 'rgb(255, 99, 132)',
					borderColor: 'rgb(255, 99, 132)',
		    		data: data_chart
		    	}];
			table.rows.add(row).draw();
		    myChart.update();
		    var t_visit = tmp_data_chart['<?= date("Y-m-d"); ?>']==undefined?0:tmp_data_chart['<?= date("Y-m-d"); ?>'];
			$("#t_visit").html(t_visit);
			$(".preload").hide();
			//data_data_data(data);
			all_data = data;
		}

		function data_data_data(data){
			var tau_visit = [];
			<?php
				foreach ($panel as $key => $v) {
					$tbl = explode("_", $key)[1]."_visit";
					echo "var $tbl = [];";
				}
			?>
			data.forEach(function(childData, i) {
				var da = childData.date.split(" ")[0];
				<?php
					foreach ($panel as $key => $v) {
						if($v["var"]=="all" && $v["type"]==1){
							$tbl = explode("_", $key)[1];
							echo "var indx_$tbl = childData.ip+\"<br>\"+childData.browser+\"<br>\"+childData.os;";
						}else if($v["var"]!="all" && $v["type"]==1){
							$tbl = explode("_", $key)[1];
							echo "var indx_$tbl = childData.$v[var]; ";
						}
						if($v["type"]==1){
							$damar = explode("_", $key)[1];
							$arr_var = $damar."_visit";
							echo "var damar_$damar = dalam_array2d(indx_$tbl, $arr_var, 0); ";
							echo "if(damar_$damar == -1){ ";
							echo "$arr_var.push([indx_$tbl, 1]);";
							echo "}else{";
							echo "$arr_var"."[damar_$damar][1] += 1;";
							echo "}";
						}else{
							$damar = explode("_", $key)[1];
							$arr_var = $damar."_visit";
							echo "var damar_$damar = dalam_array2d_special([indx_$tbl, da], $arr_var); ";
							echo "if(damar_$damar == -1){ ";
							echo "$arr_var.push([indx_$tbl, da, 1]);";
							echo "}else{";
							echo "$arr_var"."[damar_$damar][2] += 1;";
							echo "}";
							echo "";
						}
					}
				?>

				/* FOR VISITOR TODAT */
				if(da == "<?= date('Y-m-d'); ?>"){
					if(jQuery.inArray(childData.ip+"."+childData.browser+"."+childData.os,tau_visit) == -1){
						tau_visit.push(childData.ip+"."+childData.browser+"."+childData.os);
					}
				}
			});
			<?php
				foreach ($panel as $key => $v) {
					$tbl = explode("_", $key)[1];
					$var = explode("_", $key)[1]."_visit";
					echo "table_$tbl.rows.add($var).draw();";
				}
			?>
			$("#all_visit").html(data.length);
			$("#u_visit").html(alluser_visit.length);
			$("#ut_visit").html(tau_visit.length);
		}


		function data_data_pages(data){
			//console.log(data);
			var tmpt = [];
			data.forEach(function(childData, i) {
				var title = childData.title;
				var pa = title.split(" | ");
				var tt = "";
				if(pa[1]!=undefined){
					var ttt = pa[1].split(" - ");
					//console.log(ttt[0]);
					var tttt = ttt[0].split(" Episode ");
					if(tttt[0].trim()==""){
						tt = "Home";
					}else{
						var avt = tttt[0].substring(0, 6);
						if (avt == "Avatar"){
							var tavt = tttt[0].split(" Book ");
							tt = tavt[0];
						}else{
							tt = tttt[0].trim();
						}
					}
				}else{
					tt = "Home";
				}

				if(tmpt[tt]==undefined){
					tmpt[tt]=1;
				}else{
					tmpt[tt]++;
				}
			});
			var data_tab = [];
			for (var key in tmpt) {
				data_tab.push([key, tmpt[key]]);
			}
			table_pages.rows.add(data_tab).draw();
		}

		function dalam_array2d(val, arr, prop){
			var ret = -1;
			arr.some(function(da, i){
				if(val == da[prop]){
					ret = i;
					return true;
				}
			});
			return ret;
		}


		function dalam_array2d_special(val, arr){
			var ret = -1;
			arr.some(function(da, i){
				if(val[0] == da[0] && val[1] == da[1]){
					ret = i;
					return true;
				}
			});
			return ret;
		}

		function view_link(ini){
			if($(ini).attr("data-text")==1){
				$(ini).attr("data-text",2);
				var text = $(ini).text();
				var input = document.createElement("input");
				input.type = "text";
				input.className = "form-control";
				input.value = text;
				$(ini).html(input);
				input.focus();
				input.onfocusout = function(){
					$(ini).attr("data-text",1);
					var val = input.value;
					$(ini).html(val);
				};
			}
		}

	</script>
</body>
</html>
