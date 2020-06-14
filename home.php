<h2>LIST ANIME</h2>
<pre>
<?php
	
	/*$menime_list = [
			array(
				"judul" => "Boruto Naruto Next Generations", 
				"link" => "boruto_naruto_next_generations", 
				"origin" => "https://www.oploverz.in/series/boruto-naruto-next-generations/", 
				"sts" => 0, 
			),
			array(
				"judul" => "Death Note", 
				"link" => "death_note", 
				"origin" => "https://www.oploverz.in/series/death-note/", 
				"sts" => 1, 
			),
			array(
				"judul" => "Naruto", 
				"link" => "naruto", 
				"origin" => "https://www.oploverz.in/series/naruto/", 
				"sts" => 1, 
			),
			array(
				"judul" => "Naruto Shippuuden", 
				"link" => "naruto_shippuuden", 
				"origin" => "https://www.oploverz.in/series/naruto-shippuuden/", 
				"sts" => 1, 
			),
			array(
				"judul" => "One Piece Special", 
				"link" => "one_piece_special", 
				"origin" => "https://www.oploverz.in/series/one-piece-special/", 
				"sts" => 1, 
			),
			array(
				"judul" => "One Piece Movie", 
				"link" => "one_piece_movie", 
				"origin" => "https://www.oploverz.in/series/one-piece-movie/", 
				"sts" => 1, 
			),
			array(
				"judul" => "One Piece Ova", 
				"link" => "one_piece_ova", 
				"origin" => "https://www.oploverz.in/series/one-piece-ova/", 
				"sts" => 1, 
			),
			array(
				"judul" => "Samurai X Rurouni Kenshin Meiji Kenkaku Romantan", 
				"link" => "samurai_x_rurouni_kenshin_meiji_kenkaku_romantan", 
				"origin" => "https://www.oploverz.in/series/samurai-x-rurouni-kenshin-meiji-kenkaku-romantan/", 
				"sts" => 1, 
			),
	];
	$myfile = fopen("data/menime.json", "w") or die("Unable to open file!");
	fwrite($myfile, json_encode($menime_list));
	fclose($myfile);*/
	/*$menime_list = json_decode(file_get_contents("data/menime.json") ,true);
	foreach ($menime_list as $k => $v) {
		if($v['sts']==1){
			$list_anime = list_episode($v['origin']);
			foreach ($list_anime as $a => $b) {
				$list_vid = list_anime($b['link']);
				print_r($list_vid);
			}
			//print_r($list_anime);
			/*$myfile = fopen("data/$v[link].json", "w") or die("Unable to open file!");
			fwrite($myfile, json_encode($list_anime));
			fclose($myfile);
		}
	}*/
	/*$list_anime = list_episode("https://www.oploverz.in/series/one-piece-episode-special/");
	$myfile = fopen("data/one_piece_special.json", "w") or die("Unable to open file!");
		fwrite($myfile, json_encode($list_anime));
		fclose($myfile);*/
	//$mml = json_decode(file_get_contents("data/naruto_shippuuden.json") ,true);
	
	/*$needle = "naruto";
	foreach($mml as $k=>$v)
	{
	   if(stristr($v['eps'],$needle) || stristr($v['judul'],$needle))
	   $output[$k]=$v;
	}
	print_r($output);*/
?>
</pre>
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
		<!-- <tr>
			<td>
				<a href="index.php?page=anime&a=death_note">
				Death Note		
				</a>
			</td>
		</tr>
		<tr>
			<td>
				<a href="index.php?page=anime&a=naruto">
				Naruto		
				</a>
			</td>
		</tr>
		<tr>
			<td>
				<a href="index.php?page=anime&a=naruto_shippuuden">
				Naruto Shippuuden		
				</a>
			</td>
		</tr>
		<tr>
			<td>
				<a href="index.php?page=anime&a=one_piece_special">
				One Pice Spesial		
				</a>
			</td>
		</tr>
		<tr>
			<td>
				<a href="index.php?page=anime&a=one_piece_movie">
				One Piece Movie	
				</a>
			</td>
		</tr>
		<tr>
			<td>
				<a href="index.php?page=anime&a=one_piece_ova">
				One Piece Ova	
				</a>
			</td>
		</tr>
		<tr>
			<td>
				<a href="index.php?page=anime&a=samurai_x_rurouni_kenshin_meiji_kenkaku_romantan">
				Samurai X : Rurouni Kenshin Meiji Kenkaku Romantan
				</a>
			</td>
		</tr> -->


	</tbody>
</table>