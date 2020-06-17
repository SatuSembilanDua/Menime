<h2>LIST ANIME</h2>
<pre>
<?php
	
	$tab = file_get_contents("tblavatar.php");
	$dom = new simple_html_dom(null, true, true, DEFAULT_TARGET_CHARSET, true, DEFAULT_BR_TEXT, DEFAULT_SPAN_TEXT);
	
	$html = $dom->load($tab, true, true);

	$ls_eps = [];
	$i=0;
	foreach ($html->find("tr") as $div) {
		if($i>0){
			$a =  $div->find("a", 0);
			$index = explode("_", $a->plaintext)[4];
			$link = explode("/", $a->href)[2];
			/*echo $index;
			echo " - ";
			echo $a->href;
			echo "<br>";*/
			$ls_eps[] = array(
							"idx" => $index,
							"link" => "https://narudrive.com/stream/".$link,
							);
		}
		$i++;
	}
	//print_r($ls_eps);
	
	$data = json_decode(file_get_contents("data/avatar_the_legend_of_aang.json"), true);
	//print_r($data);
	foreach ($data as $k => $v) {
		$jd = explode(" ", $v["eps"])[1];
		foreach ($ls_eps as $a => $b) {
			if($jd == $b["idx"]){
				//echo $b['link']."<br>";
				$data[$k]['link'] = $b['link']; 
			}
		}
	}
	/*print_r($data);
	$myfile = fopen("data/avatar_the_legend_of_aang.json", "w") or die("Unable to open file!");
	fwrite($myfile, json_encode($data));
	fclose($myfile);*/




	/*
	foreach ($html->find(".ep") as $div) {
		foreach ($div->find("a") as $a) {
			$ls_eps[] = array(
								"judul" => $a->plaintext, 
								"link" => $a->attr["href"], 
								);
		}
	}
*/
	//https://narudrive.com/stream/94151069
?>
</pre>
<!-- <iframe style="width:100%; height:500px;" src="https://narudrive.com/stream/94151069" allowfullscreen="true" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" class="idframe"></iframe>
<br><br> -->
<table class="table table-list">
	<tbody>
		<?php
			foreach ($menime_list as $k => $v):
		?>
		<tr>
			<td>
				<a href="index.php?page=anime&a=<?= $k;?>">
				<?= $v['judul']; ?>
				</a>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>