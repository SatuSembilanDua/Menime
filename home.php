<h2>LIST ANIME</h2>
<table class="table table-list">
	<pre>
	<?php
		echo "\n";
		/*
		print_r($menime_list);
		echo "\$tmp = [\n";
		foreach ($menime_list as $k => $v) {
			echo "\tarray(\n";
			echo "\t\t\"judul\" => \"$v[judul]\", \n";
			echo "\t\t\"link\" => \"$v[link]\", \n";
			echo "\t\t\"origin\" => \"$v[origin]\", \n";
			echo "\t\t\"sts\" => \"$v[sts]\", \n";
			echo "\t\t\"src\" => \"1\", \n";
			echo "\t),\n";
		}
		echo "];";*/

		//print_r($tmp);

		/*$myfile = fopen("data/menime.json", "w") or die("Unable to open file!");
		fwrite($myfile, json_encode($tmp));
		fclose($myfile);*/
		/*array(
			"link" => "",
			"eps" => "",
			"judul" => "",
			"date" => "",
		);*/

		/*$e = json_decode(file_get_contents("data/naruto.json") ,true);
		print_r($e);*/
		/*$ep = list_episode2("https://anoboy.mobi/anime/avatar-the-legend-of-aang/");
		//print_r($ep);
		echo "\$tmp = [\n";
		foreach ($ep as $k => $v) {
			$judul = trim($v['judul']);
			echo "\tarray(\n";
			echo "\t\t\"link\" => \"https://anoboy.mobi$v[link]\", \n";
			echo "\t\t\"book\" => \"Book 1\", \n";
			echo "\t\t\"eps\" => \"Episode $judul\", \n";
			echo "\t\t\"judul\" => \"$judul\", \n";
			echo "\t\t\"date\" => \"".date("M d, Y")."\", \n";
			echo "\t),\n";
		}
		echo "];";*/

		$tmp = [
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-01/", 
				"book" => "Book 1 Water", 
				"eps" => "Episode 01", 
				"judul" => "01", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-02/", 
				"book" => "Book 1 Water", 
				"eps" => "Episode 02", 
				"judul" => "02", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-03/", 
				"book" => "Book 1 Water", 
				"eps" => "Episode 03", 
				"judul" => "03", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-04/", 
				"book" => "Book 1 Water", 
				"eps" => "Episode 04", 
				"judul" => "04", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-05/", 
				"book" => "Book 1 Water", 
				"eps" => "Episode 05", 
				"judul" => "05", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-06/", 
				"book" => "Book 1 Water", 
				"eps" => "Episode 06", 
				"judul" => "06", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-07/", 
				"book" => "Book 1 Water", 
				"eps" => "Episode 07", 
				"judul" => "07", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-08/", 
				"book" => "Book 1 Water", 
				"eps" => "Episode 08", 
				"judul" => "08", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-09/", 
				"book" => "Book 1 Water", 
				"eps" => "Episode 09", 
				"judul" => "09", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-10/", 
				"book" => "Book 1 Water", 
				"eps" => "Episode 10", 
				"judul" => "10", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-11/", 
				"book" => "Book 1 Water", 
				"eps" => "Episode 11", 
				"judul" => "11", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-12/", 
				"book" => "Book 1 Water", 
				"eps" => "Episode 12", 
				"judul" => "12", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-13/", 
				"book" => "Book 1 Water", 
				"eps" => "Episode 13", 
				"judul" => "13", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-14/", 
				"book" => "Book 1 Water", 
				"eps" => "Episode 14", 
				"judul" => "14", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-15/", 
				"book" => "Book 1 Water", 
				"eps" => "Episode 15", 
				"judul" => "15", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-16/", 
				"book" => "Book 1 Water", 
				"eps" => "Episode 16", 
				"judul" => "16", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-17/", 
				"book" => "Book 1 Water", 
				"eps" => "Episode 17", 
				"judul" => "17", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-18/", 
				"book" => "Book 1 Water", 
				"eps" => "Episode 18", 
				"judul" => "18", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-19/", 
				"book" => "Book 1 Water", 
				"eps" => "Episode 19", 
				"judul" => "19", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-20/", 
				"book" => "Book 1 Water", 
				"eps" => "Episode 20", 
				"judul" => "20", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-21/", 
				"book" => "Book 1", 
				"eps" => "Episode 21", 
				"judul" => "21", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-22/", 
				"book" => "Book 1", 
				"eps" => "Episode 22", 
				"judul" => "22", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-23/", 
				"book" => "Book 1", 
				"eps" => "Episode 23", 
				"judul" => "23", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-24/", 
				"book" => "Book 1", 
				"eps" => "Episode 24", 
				"judul" => "24", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-25/", 
				"book" => "Book 1", 
				"eps" => "Episode 25", 
				"judul" => "25", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-26/", 
				"book" => "Book 1", 
				"eps" => "Episode 26", 
				"judul" => "26", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-27/", 
				"book" => "Book 1", 
				"eps" => "Episode 27", 
				"judul" => "27", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-28/", 
				"book" => "Book 1", 
				"eps" => "Episode 28", 
				"judul" => "28", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-29/", 
				"book" => "Book 1", 
				"eps" => "Episode 29", 
				"judul" => "29", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-30/", 
				"book" => "Book 1", 
				"eps" => "Episode 30", 
				"judul" => "30", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-31/", 
				"book" => "Book 1", 
				"eps" => "Episode 31", 
				"judul" => "31", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-32/", 
				"book" => "Book 1", 
				"eps" => "Episode 32", 
				"judul" => "32", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-33/", 
				"book" => "Book 1", 
				"eps" => "Episode 33", 
				"judul" => "33", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-34/", 
				"book" => "Book 1", 
				"eps" => "Episode 34", 
				"judul" => "34", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-35/", 
				"book" => "Book 1", 
				"eps" => "Episode 35", 
				"judul" => "35", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-36/", 
				"book" => "Book 1", 
				"eps" => "Episode 36", 
				"judul" => "36", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-37/", 
				"book" => "Book 1", 
				"eps" => "Episode 37", 
				"judul" => "37", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-38/", 
				"book" => "Book 1", 
				"eps" => "Episode 38", 
				"judul" => "38", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-39/", 
				"book" => "Book 1", 
				"eps" => "Episode 39", 
				"judul" => "39", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-40/", 
				"book" => "Book 1", 
				"eps" => "Episode 40", 
				"judul" => "40", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-41/", 
				"book" => "Book 1", 
				"eps" => "Episode 41", 
				"judul" => "41", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-42/", 
				"book" => "Book 1", 
				"eps" => "Episode 42", 
				"judul" => "42", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-43/", 
				"book" => "Book 1", 
				"eps" => "Episode 43", 
				"judul" => "43", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-44/", 
				"book" => "Book 1", 
				"eps" => "Episode 44", 
				"judul" => "44", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-45/", 
				"book" => "Book 1", 
				"eps" => "Episode 45", 
				"judul" => "45", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-46/", 
				"book" => "Book 1", 
				"eps" => "Episode 46", 
				"judul" => "46", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-47/", 
				"book" => "Book 1", 
				"eps" => "Episode 47", 
				"judul" => "47", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-48/", 
				"book" => "Book 1", 
				"eps" => "Episode 48", 
				"judul" => "48", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-49/", 
				"book" => "Book 1", 
				"eps" => "Episode 49", 
				"judul" => "49", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-50/", 
				"book" => "Book 1", 
				"eps" => "Episode 50", 
				"judul" => "50", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-51/", 
				"book" => "Book 1", 
				"eps" => "Episode 51", 
				"judul" => "51", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-52/", 
				"book" => "Book 1", 
				"eps" => "Episode 52", 
				"judul" => "52", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-53/", 
				"book" => "Book 1", 
				"eps" => "Episode 53", 
				"judul" => "53", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-54/", 
				"book" => "Book 1", 
				"eps" => "Episode 54", 
				"judul" => "54", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-55/", 
				"book" => "Book 1", 
				"eps" => "Episode 55", 
				"judul" => "55", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-56/", 
				"book" => "Book 1", 
				"eps" => "Episode 56", 
				"judul" => "56", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-57/", 
				"book" => "Book 1", 
				"eps" => "Episode 57", 
				"judul" => "57", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-58/", 
				"book" => "Book 1", 
				"eps" => "Episode 58", 
				"judul" => "58", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-59/", 
				"book" => "Book 1", 
				"eps" => "Episode 59", 
				"judul" => "59", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-60/", 
				"book" => "Book 1", 
				"eps" => "Episode 60", 
				"judul" => "60", 
				"date" => "Jun 15, 2020", 
			),
			array(
				"link" => "https://anoboy.mobi/avatar-the-legend-of-aang-episode-61-tamat/", 
				"book" => "Book 1", 
				"eps" => "Episode 61", 
				"judul" => "61", 
				"date" => "Jun 15, 2020", 
			),
		];

		$eps = 1;
		foreach ($tmp as $k => $v) {
			if($k>0 && $k<=19){
				$tmp[$k]["book"] = "Book 1 Water";
			}else if($k>19 && $k<=39){
				$tmp[$k]["book"] = "Book 2 Earth";
			}else if($k>39 && $k<=61){
				$tmp[$k]["book"] = "Book 3 Fire";
			}

			if($k==20){
				$eps = 1;
			}else if($k==40){
				$eps = 1;
			}
			$e = "0".$eps;
			$episode = substr($e, strlen($e) - 2, strlen($e));
			$tmp[$k]["eps"] = "Episode $episode";
			$eps++;
		}

		$file = fopen("avatar.csv","r");
		$i = 0;
		while(! feof($file)){
			$f = fgetcsv($file);
			//print_r($f);
			$tmp[$i]["id_eps"] = $i;
			$tmp[$i]["judul"] = $f[2];
			$tmp[$i]["date"] = $f[3];
			$i++;
		}

		fclose($file);
		unset($tmp[61]);

		/*$tttmp = [];
		foreach ($tmp as $k => $v) {
			$book = str_replace(" ", "_", strtolower($v['book']));
			$tttmp[$book][] = $v;
		}*/
		//print_r($tttmp);
		
		//print_r($tmp);
		/*$myfile = fopen("data/avatar_the_legend_of_aang.json", "w") or die("Unable to open file!");
		fwrite($myfile, json_encode($tmp));
		fclose($myfile);
*/


		//print_r(anime_info2("https://anoboy.mobi/anime/avatar-the-legend-of-aang/"));
	?>
	</pre>
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