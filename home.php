<h2>LIST ANIME</h2>
<pre>
	
<?php
	/*$data = json_decode(file_get_contents("data/menime.json"), true);
	//print_r($data);

	$desk = '<p>Setelah berakhirnya Perang Seratus Tahun, Aang dan Zuko mengumpulkan orang-orang dari keempat negara bersama-sama dan mendirikan Republik Persatuan Bangsa-Bangsa, dengan ibukotanya, Kota Republik, sebuah kota metropolis raksasa yang berteknologi tinggi seperti mobil dan sepeda motor. Aang dan Katara dikaruniai tiga orang anak, yang termuda dari yang lainnya, Tenzin, satu-satunya pengendali udara dari tiga bersaudara. Sementara itu, Toph Beifong melakukan perjalanan secara ekstensif untuk mengajar metalbending. Setelah kematian Aang yang terjadi 53 tahun setelah petualangan di masa mudanya, lahirlah Avatar berikutnya, Korra, lahir di Suku Air Selatan.</p>';
	$info = '<div class="listinfo"><ul><li><b>Judul Asli</b>: Avatar: The Legend of Korra</li><li><b>Tipe</b>: TV</li><li><b>Episode</b>: 52 (Book 1 : 12, Book 2 : 14, Book 3 : 13, Book 4 : 13)</li><li><b>Status</b>: Completed</li><li><b>Disiarkan</b>:   Apr 14, 2012</li><li><b>Produser</b>:  Nickelodeon Animation Studio</li><li><b>Skor</b>:   -</li><li><b>Genres</b>: <a href="https://gokunime.com/genre/action/" rel="tag">Action</a>, <a href="https://gokunime.com/genre/adventure/" rel="tag">Adventure</a>, <a href="https://gokunime.com/genre/drama/" rel="tag">Drama</a>, <a href="https://gokunime.com/genre/slice-of-life/" rel="tag">Slice of Life</a></li><li><b>Durasi</b>:  - </li></ul></div>';
	$korra = array(
					"judul" => 'Avatar: The Legend of Korra',
					"link" => 'avatar_the_legend_of_korra',
					"origin" => 'https://gokunime.com/anime/avatar-the-legend-of-korra-book-1/',
					"sts" => 1,
		            "src" => 4,
		            "img" => "https://gokunime.com/wp-content/uploads/2019/12/Avatar-The-Legend-of-Korra-Book-1.jpg",
		            "desc" => htmlentities($desk),
		            "info" => htmlentities($info),
					);
	$tmp = array_slice($data,1);
	//print_r($tmp);
	foreach ($data as $k => $v) {
		if($k==1){
			$data[$k] = $korra;
		}
		if($k>1){
			$data[$k] = $tmp[$k-2];
		}
	}
	$data[10] = $tmp[8];
	print_r($data);
	$myfile = fopen("data/menime.json", "w") or die("Unable to open file!");
	fwrite($myfile, json_encode($data));
	fclose($myfile);*/
	//print_r($data);
	//print_r($korra);

	/*
		https://gokunime.com/anime/avatar-the-legend-of-korra-book-1/
		https://gokunime.com/anime/avatar-the-legend-of-korra-book-2/
		https://gokunime.com/anime/avatar-the-legend-of-korra-book-3/
		https://gokunime.com/anime/avatar-the-legend-of-korra-book-4/
	*/
	/*$avt = json_decode(file_get_contents("data/avatar_the_legend_of_aang.json"), true);
	//print_r($avt);
	$tbl = file_get_contents("tbl.php");
	$dom = new simple_html_dom(null, true, true, DEFAULT_TARGET_CHARSET, true, DEFAULT_BR_TEXT, DEFAULT_SPAN_TEXT);
	$html = $dom->load($tbl, true, true);
	$book = 1;
	$data = [];
	$ba = ["", "Air", "Spirits", "Change", "Balance"];
	foreach ($html->find(".episode") as $tbl) {
		foreach ($tbl->find(".episode-kolom") as $td) {
			$a = $td->find("a", 0);
			$data[$book][] = array(
							"link" => $a->href,
							"book" => "Book ".$book." ".$ba[$book],
							"eps" => trim($a->plaintext),
							);
		}
		//echo htmlentities($tbl);
		//echo "<br>"; 
		$book++;

	}
	foreach ($data as $key => $value) {
		$tmp = array_reverse($data[$key]);
		$data[$key] = $tmp;
	}
	$tmp =[];
	foreach ($data as $key => $value) {
		
		foreach ($value as $a => $b) {
			$tmp[] = $b;
		}
	}*/
	//print_r($tmp);
	//echo json_encode($tmp);
	//echo "<br>";
	/*$ko = '[{"link":"https:\/\/gokunime.com\/avatar-the-legend-of-korra-book-1-episode-1-sub-indo\/","book":"Book 1 Air","eps":"Episode 01 Subtitle Indonesia"},{"link":"https:\/\/gokunime.com\/avatar-the-legend-of-korra-book-1-episode-2-sub-indo\/","book":"Book 1 Air","eps":"Episode 02 Subtitle Indonesia"},{"link":"https:\/\/gokunime.com\/avatar-the-legend-of-korra-book-1-episode-3-sub-indo\/","book":"Book 1 Air","eps":"Episode 03 Subtitle Indonesia"},{"link":"https:\/\/gokunime.com\/avatar-the-legend-of-korra-book-1-episode-4-sub-indo\/","book":"Book 1 Air","eps":"Episode 04 Subtitle Indonesia"},{"link":"https:\/\/gokunime.com\/avatar-the-legend-of-korra-book-1-episode-5-sub-indo\/","book":"Book 1 Air","eps":"Episode 05 Subtitle Indonesia"},{"link":"https:\/\/gokunime.com\/avatar-the-legend-of-korra-book-1-episode-6-sub-indo\/","book":"Book 1 Air","eps":"Episode 06 Subtitle Indonesia"},{"link":"https:\/\/gokunime.com\/avatar-the-legend-of-korra-book-1-episode-7-sub-indo\/","book":"Book 1 Air","eps":"Episode 07 Subtitle Indonesia"},{"link":"https:\/\/gokunime.com\/avatar-the-legend-of-korra-book-1-episode-8-sub-indo\/","book":"Book 1 Air","eps":"Episode 08 Subtitle Indonesia"},{"link":"https:\/\/gokunime.com\/avatar-the-legend-of-korra-book-1-episode-9-sub-indo\/","book":"Book 1 Air","eps":"Episode 09 Subtitle Indonesia"},{"link":"https:\/\/gokunime.com\/avatar-the-legend-of-korra-book-1-episode-10-sub-indo\/","book":"Book 1 Air","eps":"Episode 10 Subtitle Indonesia"},{"link":"https:\/\/gokunime.com\/avatar-the-legend-of-korra-book-1-episode-11-12-end-sub-indo\/","book":"Book 1 Air","eps":"Episode 11-12 Subtitle Indonesia"},{"link":"https:\/\/gokunime.com\/avatar-the-legend-of-korra-book-2-episode-1-2-sub-indo\/","book":"Book 2 Spirits","eps":"Episode 01-02 Subtitle Indonesia"},{"link":"https:\/\/gokunime.com\/avatar-the-legend-of-korra-book-2-episode-3-sub-indo\/","book":"Book 2 Spirits","eps":"Episode 03 Subtitle Indonesia"},{"link":"https:\/\/gokunime.com\/avatar-the-legend-of-korra-book-2-episode-4-sub-indo\/","book":"Book 2 Spirits","eps":"Episode 04 Subtitle Indonesia"},{"link":"https:\/\/gokunime.com\/avatar-the-legend-of-korra-book-2-episode-5-sub-indo\/","book":"Book 2 Spirits","eps":"Episode 05 Subtitle Indonesia"},{"link":"https:\/\/gokunime.com\/avatar-the-legend-of-korra-book-2-episode-6-sub-indo\/","book":"Book 2 Spirits","eps":"Episode 06 Subtitle Indonesia"},{"link":"https:\/\/gokunime.com\/avatar-the-legend-of-korra-book-2-episode-7-sub-indo\/","book":"Book 2 Spirits","eps":"Episode 07 Subtitle Indonesia"},{"link":"https:\/\/gokunime.com\/avatar-the-legend-of-korra-book-2-episode-8-sub-indo\/","book":"Book 2 Spirits","eps":"Episode 08 Subtitle Indonesia"},{"link":"https:\/\/gokunime.com\/avatar-the-legend-of-korra-book-2-episode-9-sub-indo\/","book":"Book 2 Spirits","eps":"Episode 09 Subtitle Indonesia"},{"link":"https:\/\/gokunime.com\/avatar-the-legend-of-korra-book-2-episode-10-sub-indo\/","book":"Book 2 Spirits","eps":"Episode 10 Subtitle Indonesia"},{"link":"https:\/\/gokunime.com\/avatar-the-legend-of-korra-book-2-episode-11-12-sub-indo\/","book":"Book 2 Spirits","eps":"Episode 11-12 Subtitle Indonesia"},{"link":"https:\/\/gokunime.com\/avatar-the-legend-of-korra-book-2-episode-13-sub-indo\/","book":"Book 2 Spirits","eps":"Episode 13 Subtitle Indonesia"},{"link":"https:\/\/gokunime.com\/avatar-the-legend-of-korra-book-2-episode-14-end-sub-indo\/","book":"Book 2 Spirits","eps":"Episode 14 Subtitle Indonesia"},{"link":"https:\/\/gokunime.com\/avatar-the-legend-of-korra-book-3-episode-1-2-sub-indo\/","book":"Book 3 Change","eps":"Episode 01-02 Subtitle Indonesia"},{"link":"https:\/\/gokunime.com\/avatar-the-legend-of-korra-book-3-episode-3-sub-indo\/","book":"Book 3 Change","eps":"Episode 03 Subtitle Indonesia"},{"link":"https:\/\/gokunime.com\/avatar-the-legend-of-korra-book-3-episode-4-sub-indo\/","book":"Book 3 Change","eps":"Episode 04 Subtitle Indonesia"},{"link":"https:\/\/gokunime.com\/avatar-the-legend-of-korra-book-3-episode-5-sub-indo\/","book":"Book 3 Change","eps":"Episode 05 Subtitle Indonesia"},{"link":"https:\/\/gokunime.com\/avatar-the-legend-of-korra-book-3-episode-6-sub-indo\/","book":"Book 3 Change","eps":"Episode 06 Subtitle Indonesia"},{"link":"https:\/\/gokunime.com\/avatar-the-legend-of-korra-book-3-episode-7-sub-indo\/","book":"Book 3 Change","eps":"Episode 07 Subtitle Indonesia"},{"link":"https:\/\/gokunime.com\/avatar-the-legend-of-korra-book-3-episode-8-sub-indo\/","book":"Book 3 Change","eps":"Episode 08 Subtitle Indonesia"},{"link":"https:\/\/gokunime.com\/avatar-the-legend-of-korra-book-3-episode-9-sub-indo\/","book":"Book 3 Change","eps":"Episode 09 Subtitle Indonesia"},{"link":"https:\/\/gokunime.com\/avatar-the-legend-of-korra-book-3-episode-10-sub-indo\/","book":"Book 3 Change","eps":"Episode 10 Subtitle Indonesia"},{"link":"https:\/\/gokunime.com\/avatar-the-legend-of-korra-book-3-episode-11-sub-indo\/","book":"Book 3 Change","eps":"Episode 11 Subtitle Indonesia"},{"link":"https:\/\/gokunime.com\/avatar-the-legend-of-korra-book-3-episode-12-sub-indo\/","book":"Book 3 Change","eps":"Episode 12 Subtitle Indonesia"},{"link":"https:\/\/gokunime.com\/avatar-the-legend-of-korra-book-3-episode-13-end-sub-indo\/","book":"Book 3 Change","eps":"Episode 13 Subtitle Indonesia"},{"link":"https:\/\/gokunime.com\/avatar-the-legend-of-korra-book-4-episode-1-sub-indo\/","book":"Book 4 Balance","eps":"Episode 01 Subtitle Indonesia"},{"link":"https:\/\/gokunime.com\/avatar-the-legend-of-korra-book-4-episode-2-sub-indo\/","book":"Book 4 Balance","eps":"Episode 02 Subtitle Indonesia"},{"link":"https:\/\/gokunime.com\/avatar-the-legend-of-korra-book-4-episode-3-sub-indo\/","book":"Book 4 Balance","eps":"Episode 03 Subtitle Indonesia"},{"link":"https:\/\/gokunime.com\/avatar-the-legend-of-korra-book-4-episode-4-sub-indo\/","book":"Book 4 Balance","eps":"Episode 04 Subtitle Indonesia"},{"link":"https:\/\/gokunime.com\/avatar-the-legend-of-korra-book-4-episode-5-sub-indo\/","book":"Book 4 Balance","eps":"Episode 05 Subtitle Indonesia"},{"link":"https:\/\/gokunime.com\/avatar-the-legend-of-korra-book-4-episode-6-sub-indo\/","book":"Book 4 Balance","eps":"Episode 06 Subtitle Indonesia"},{"link":"https:\/\/gokunime.com\/avatar-the-legend-of-korra-book-4-episode-7-sub-indo\/","book":"Book 4 Balance","eps":"Episode 07 Subtitle Indonesia"},{"link":"https:\/\/gokunime.com\/avatar-the-legend-of-korra-book-4-episode-8-sub-indo\/","book":"Book 4 Balance","eps":"Episode 08 Subtitle Indonesia"},{"link":"https:\/\/gokunime.com\/avatar-the-legend-of-korra-book-4-episode-9-sub-indo\/","book":"Book 4 Balance","eps":"Episode 09 Subtitle Indonesia"},{"link":"https:\/\/gokunime.com\/avatar-the-legend-of-korra-book-4-episode-10-sub-indo\/","book":"Book 4 Balance","eps":"Episode 10 Subtitle Indonesia"},{"link":"https:\/\/gokunime.com\/avatar-the-legend-of-korra-book-4-episode-11-sub-indo\/","book":"Book 4 Balance","eps":"Episode 11 Subtitle Indonesia"},{"link":"https:\/\/gokunime.com\/avatar-the-legend-of-korra-book-4-episode-12-13-sub-indo\/","book":"Book 4 Balance","eps":"Episode 12-13 Subtitle Indonesia"}]';
	$data = json_decode($ko, true);
	//print_r($data);
	foreach ($data as $k => $v) {
		$data[$k]['link'] = korak($v['link']);
	}
	//print_r($data);
	echo json_encode($data);*/
	//$koo = '[{"link":"https:\/\/uservideo.xyz\/file\/nanime.org.korra.book1.e01.sub.indo.480p.mp4?embed=true","book":"Book 1 Air","eps":"Episode 01 Subtitle Indonesia"},{"link":"https:\/\/uservideo.xyz\/file\/nanime.org.korra.book1.e02.sub.indo.480p.mp4?embed=true","book":"Book 1 Air","eps":"Episode 02 Subtitle Indonesia"},{"link":"https:\/\/uservideo.xyz\/file\/nanime.org.korra.book1.e03.sub.indo.480p.mp4?embed=true","book":"Book 1 Air","eps":"Episode 03 Subtitle Indonesia"},{"link":"https:\/\/uservideo.xyz\/file\/nanime.org.korra.book1.e04.sub.indo.480p.mp4?embed=true","book":"Book 1 Air","eps":"Episode 04 Subtitle Indonesia"},{"link":"https:\/\/uservideo.xyz\/file\/nanime.org.korra.book1.e05.sub.indo.480p.mp4?embed=true","book":"Book 1 Air","eps":"Episode 05 Subtitle Indonesia"},{"link":"https:\/\/uservideo.xyz\/file\/nanime.org.korra.book1.e06.sub.indo.480p.mp4?embed=true","book":"Book 1 Air","eps":"Episode 06 Subtitle Indonesia"},{"link":"https:\/\/uservideo.xyz\/file\/nanime.org.korra.book1.e07.sub.indo.480p.mp4?embed=true","book":"Book 1 Air","eps":"Episode 07 Subtitle Indonesia"},{"link":"https:\/\/uservideo.xyz\/file\/nanime.org.korra.book1.e08.sub.indo.480p.mp4?embed=true","book":"Book 1 Air","eps":"Episode 08 Subtitle Indonesia"},{"link":"https:\/\/uservideo.xyz\/file\/nanime.org.korra.book1.e09.sub.indo.480p.mp4?embed=true","book":"Book 1 Air","eps":"Episode 09 Subtitle Indonesia"},{"link":"https:\/\/uservideo.xyz\/file\/nanime.org.korra.book1.e10.sub.indo.480p.mp4?embed=true","book":"Book 1 Air","eps":"Episode 10 Subtitle Indonesia"},{"link":"https:\/\/uservideo.xyz\/file\/nanime.avatar.the.legend.of.korra.book.s1.e11-12.sub.indo.360p.mp4?embed=true","book":"Book 1 Air","eps":"Episode 11-12 Subtitle Indonesia"},{"link":"https:\/\/uservideo.xyz\/file\/nanime.org.avatar.legend.of.korra.book.2.01.mp4?embed=true","book":"Book 2 Spirits","eps":"Episode 01-02 Subtitle Indonesia"},{"link":"https:\/\/uservideo.xyz\/file\/nanime.org.avatar.legend.of.korra.book.2.03.mp4?embed=true","book":"Book 2 Spirits","eps":"Episode 03 Subtitle Indonesia"},{"link":"https:\/\/uservideo.xyz\/file\/nanime.org.avatar.legend.of.korra.book.2.04.mp4?embed=true","book":"Book 2 Spirits","eps":"Episode 04 Subtitle Indonesia"},{"link":"https:\/\/uservideo.xyz\/file\/nanime.org.avatar.legend.of.korra.book.2.05.mp4?embed=true","book":"Book 2 Spirits","eps":"Episode 05 Subtitle Indonesia"},{"link":"https:\/\/uservideo.xyz\/file\/nanime.org.avatar.legend.of.korra.book.2.06.mp4?embed=true","book":"Book 2 Spirits","eps":"Episode 06 Subtitle Indonesia"},{"link":"https:\/\/uservideo.xyz\/file\/nanime.org.avatar.legend.of.korra.book.2.07.mp4?embed=true","book":"Book 2 Spirits","eps":"Episode 07 Subtitle Indonesia"},{"link":"https:\/\/uservideo.xyz\/file\/nanime.org.avatar.legend.of.korra.book.2.08.mp4?embed=true","book":"Book 2 Spirits","eps":"Episode 08 Subtitle Indonesia"},{"link":"https:\/\/uservideo.xyz\/file\/nanime.org.avatar.legend.of.korra.book.2.09.mp4?embed=true","book":"Book 2 Spirits","eps":"Episode 09 Subtitle Indonesia"},{"link":"https:\/\/uservideo.xyz\/file\/nanime.org.avatar.legend.of.korra.book.2.10.mp4?embed=true","book":"Book 2 Spirits","eps":"Episode 10 Subtitle Indonesia"},{"link":"https:\/\/uservideo.xyz\/file\/nanime.org.avatar.the.legend.of.korra.book2.e11.12.sub.indo.360p.mp4?embed=true","book":"Book 2 Spirits","eps":"Episode 11-12 Subtitle Indonesia"},{"link":"https:\/\/uservideo.xyz\/file\/nanime.org.avatar.legend.of.korra.book.2.13.mp4?embed=true","book":"Book 2 Spirits","eps":"Episode 13 Subtitle Indonesia"},{"link":"https:\/\/uservideo.xyz\/file\/nanime.org.avatar.legend.of.korra.book.2.14.mp4?embed=true","book":"Book 2 Spirits","eps":"Episode 14 Subtitle Indonesia"},{"link":"https:\/\/uservideo.xyz\/file\/nanime.org.avatar.legend.of.korra.book.3.01.mp4?embed=true","book":"Book 3 Change","eps":"Episode 01-02 Subtitle Indonesia"},{"link":"https:\/\/uservideo.xyz\/file\/nanime.org.avatar.legend.of.korra.book.3.03.mp4?embed=true","book":"Book 3 Change","eps":"Episode 03 Subtitle Indonesia"},{"link":"https:\/\/uservideo.xyz\/file\/nanime.org.avatar.legend.of.korra.book.3.04.mp4?embed=true","book":"Book 3 Change","eps":"Episode 04 Subtitle Indonesia"},{"link":"https:\/\/uservideo.xyz\/file\/nanime.org.avatar.legend.of.korra.book.3.05.mp4?embed=true","book":"Book 3 Change","eps":"Episode 05 Subtitle Indonesia"},{"link":"https:\/\/uservideo.xyz\/file\/nanime.org.avatar.legend.of.korra.book.3.06.mp4?embed=true","book":"Book 3 Change","eps":"Episode 06 Subtitle Indonesia"},{"link":"https:\/\/uservideo.xyz\/file\/nanime.org.avatar.legend.of.korra.book.3.07.mp4?embed=true","book":"Book 3 Change","eps":"Episode 07 Subtitle Indonesia"},{"link":"https:\/\/uservideo.xyz\/file\/nanime.org.avatar.legend.of.korra.book.3.08.mp4?embed=true","book":"Book 3 Change","eps":"Episode 08 Subtitle Indonesia"},{"link":"https:\/\/uservideo.xyz\/file\/nanime.org.avatar.legend.of.korra.book.3.09.mp4?embed=true","book":"Book 3 Change","eps":"Episode 09 Subtitle Indonesia"},{"link":"https:\/\/uservideo.xyz\/file\/nanime.org.avatar.legend.of.korra.book.3.10.mp4?embed=true","book":"Book 3 Change","eps":"Episode 10 Subtitle Indonesia"},{"link":"https:\/\/uservideo.xyz\/file\/nanime.org.avatar.legend.of.korra.book.3.11.mp4?embed=true","book":"Book 3 Change","eps":"Episode 11 Subtitle Indonesia"},{"link":"https:\/\/uservideo.xyz\/file\/nanime.org.avatar.the.legend.of.korra.book.3.e12.sub.indo.480p.mp4?embed=true","book":"Book 3 Change","eps":"Episode 12 Subtitle Indonesia"},{"link":"https:\/\/uservideo.xyz\/file\/nanime.org.avatar.legend.of.korra.book.3.13.mp4?embed=true","book":"Book 3 Change","eps":"Episode 13 Subtitle Indonesia"},{"link":"https:\/\/uservideo.xyz\/file\/nanime.org.avatar.legend.of.korra.book.4.01.mp4?embed=true","book":"Book 4 Balance","eps":"Episode 01 Subtitle Indonesia"},{"link":"https:\/\/uservideo.xyz\/file\/nanime.org.avatar.legend.of.korra.book.4.02.mp4?embed=true","book":"Book 4 Balance","eps":"Episode 02 Subtitle Indonesia"},{"link":"https:\/\/uservideo.xyz\/file\/nanime.org.avatar.legend.of.korra.book.4.03.mp4?embed=true","book":"Book 4 Balance","eps":"Episode 03 Subtitle Indonesia"},{"link":"https:\/\/uservideo.xyz\/file\/nanime.org.avatar.legend.of.korra.book.4.04.mp4?embed=true","book":"Book 4 Balance","eps":"Episode 04 Subtitle Indonesia"},{"link":"https:\/\/uservideo.xyz\/file\/nanime.org.avatar.legend.of.korra.book.4.05.mp4?embed=true","book":"Book 4 Balance","eps":"Episode 05 Subtitle Indonesia"},{"link":"https:\/\/uservideo.xyz\/file\/nanime.org.avatar.legend.of.korra.book.4.06.mp4?embed=true","book":"Book 4 Balance","eps":"Episode 06 Subtitle Indonesia"},{"link":"https:\/\/uservideo.xyz\/file\/nanime.org.avatar.legend.of.korra.book.4.07.mp4?embed=true","book":"Book 4 Balance","eps":"Episode 07 Subtitle Indonesia"},{"link":"https:\/\/uservideo.xyz\/file\/nanime.org.avatar.legend.of.korra.book.4.08.mp4?embed=true","book":"Book 4 Balance","eps":"Episode 08 Subtitle Indonesia"},{"link":"https:\/\/uservideo.xyz\/file\/nanime.org.avatar.legend.of.korra.book.4.09.mp4?embed=true","book":"Book 4 Balance","eps":"Episode 09 Subtitle Indonesia"},{"link":"https:\/\/uservideo.xyz\/file\/nanime.org.avatar.legend.of.korra.book.4.10.mp4?embed=true","book":"Book 4 Balance","eps":"Episode 10 Subtitle Indonesia"},{"link":"https:\/\/uservideo.xyz\/file\/nanime.org.avatar.legend.of.korra.book.4.11.mp4?embed=true","book":"Book 4 Balance","eps":"Episode 11 Subtitle Indonesia"},{"link":"https:\/\/gdriveplayer.me\/embed2.php?link=nXY7puoZhTgzLWAKHs2ZZAkYXnQTw5k4i3rHevzQZOxYQyYS4ko9p0t1orjlpidxLIjEAXF6Ku2uBtQl26JwMDvWqswDWvyDGbE16rKSAWfdu1i26bXrnVkA9hvrquFrmhXfJO%252FjCC8AEhe7rRiD9OQdN1oOx9mExCa2IZHYmrSgd4nm2i4iWyjToXnOHq5JA7JVPlBjw8JDgZzKLpx2EC","book":"Book 4 Balance","eps":"Episode 12-13 Subtitle Indonesia"}]';
	//$url = "https://gokunime.com/avatar-the-legend-of-korra-book-1-episode-2-sub-indo/";
	//$url = "https://uservideo.xyz/file/nanime.org.korra.book1.e02.sub.indo.480p.mp4?embed=true";
	//$koo = json_decode($koo, true);
	//print_r($data);
	//echo korak($url);
	/*foreach ($data as $k => $v) {
		$data[$k]['link'] = korak_vid($v['link']);
	}*/
	/*echo "<br>";
	$myfile = fopen("data/avatar_the_legend_of_korra.json", "w") or die("Unable to open file!");
	fwrite($myfile, json_encode($data));
	fclose($myfile);
*/
	///$data = json_decode(file_get_contents("data/avatar_the_legend_of_korra.json"), true);
	//print_r($koo);
	/*$judul = [ ["Welcome to Republic City",	"April 14, 2012"], ["A Leaf in the Wind",	"April 14, 2012"], ["The Revelation",	"April 21, 2012"], ["The Voice in the Night",	"April 28, 2012"], ["The Spirit of Competition",	"May 5, 2012"], ["And the Winner Is...",	"May 12, 2012"], ["The Aftermath",	"May 19, 2012"], ["When Extremes Meet",	"June 2, 2012"], ["Out of the Past",	"June 9, 2012"], ["Turning the Tides",	"June 16, 2012"], ["Skeletons in the Closet & Endgame",	"June 23, 2012"], ["Rebel Spirit & The Southern Lights",	"September 13, 2013"], ["Civil Wars, Part 1",	"September 20, 2013"], ["Civil Wars, Part 2",	"September 27, 2013"], ["Peacekeepers",	"October 4, 2013"], ["The Sting",	"October 11, 2013"], ["Beginnings, Part 1",	"October 18, 2013"], ["Beginnings, Part 2",	"October 18, 2013"], ["The Guide",	"November 1, 2013"], ["A New Spiritual Age",	"November 8, 2013"], ["Night of a Thousand Stars & Harmonic Convergence",	"November 15, 2013"], ["Darkness Falls",	"November 22, 2013"], ["Light in the Dark",	"November 22, 2013"], ["A Breath of Fresh Air & Rebirth",	"June 27, 2014"], ["The Earth Queen",	"June 27, 2014"], ["In Harm's Way",	"July 11, 2014"], ["The Metal Clan",	"July 11, 2014"], ["Old Wounds",	"July 18, 2014"], ["Original Airbenders",	"July 18, 2014"], ["The Terror Within",	"July 25, 2014"], ["The Stakeout",	"August 1, 2014"], ["Long Live the Queen",	"August 8, 2014"], ["The Ultimatum",	"August 15, 2014"], ["Enter the Void",	"August 22, 2014"], ["Venom of the Red Lotus",	"August 22, 2014"], ["After All These Years",	"October 3, 2014"], ["Korra Alone",	"October 10, 2014"], ["The Coronation",	"October 17, 2014"], ["The Calling",	"October 24, 2014"], ["Enemy at the Gates",	"October 31, 2014"], ["The Battle of Zaofu",	"November 7, 2014"], ["Reunion",	"November 14, 2014"], ["Remembrances",	"November 21, 2014"], ["Beyond the Wilds",	"November 28, 2014"], ["Operation Beifong",	"December 5, 2014"], ["Kuvira's Gambit",	"December 12, 2014"], ["Day of the Colossus & The Last Stand",	"December 19, 2014"] ];
	foreach ($koo as $k => $v) {
		$bb = explode(" ", $v['book'])[1];
		$eps = explode(" ", $v['eps']);
		$koo[$k] = array(
							"link" => $v["link"],
							"book" => $v['book'],
							"eps" => $eps[0]." ".$eps[1],
				            "judul" => $judul[$k][0],
				            "date" => $judul[$k][1],
				            "id_eps" => $k,
				            "thumb" => "https://gokunime.com/wp-content/uploads/2019/12/Avatar-The-Legend-of-Korra-Book-$bb.jpg"
							);

	}*/
	/*print_r($koo);
	$myfile = fopen("data/avatar_the_legend_of_korra.json", "w") or die("Unable to open file!");
	fwrite($myfile, json_encode($koo));
	fclose($myfile);*/
	$data = json_decode(file_get_contents("data/avatar_the_legend_of_korra.json"), true);
	//print_r($data[45]);
	$link = $data[46]['link'];
	//$data[46]['link'] = 'https://naniplay.nanime.in/file/nanime.avatar.korra.book.4.e12.13.480p.sub.indo.mp4?embed=true';
	//$lk = 'https://gdriveplayer.me/embed2.php?link=nXY7puoZhTgzLWAKHs2ZZAkYXnQTw5k4i3rHevzQZOxYQyYS4ko9p0t1orjlpidxLIjEAXF6Ku2uBtQl26JwMDvWqswDWvyDGbE16rKSAWfdu1i26bXrnVkA9hvrquFrmhXfJO%252FjCC8AEhe7rRiD9OQdN1oOx9mExCa2IZHYmrSgd4nm2i4iWyjToXnOHq5JA7JVPlBjw8JDgZzKLpx2EC';
	//$data[46]['link'] = $lk;
	//echo korak_vid2($lk);
	echo $link;

function korak_vid2($url){
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_PROXY, null);
	

	$data = curl_exec($ch);
	$info = curl_getinfo($ch);
	$error = curl_error($ch);

	//echo htmlentities($data);
	print_r($error);
	curl_close($ch);
/*	$dom = new simple_html_dom(null, true, true, DEFAULT_TARGET_CHARSET, true, DEFAULT_BR_TEXT, DEFAULT_SPAN_TEXT);
	
	$html = $dom->load($data, true, true);
		echo htmlentities($html);
	foreach ($html->find(".jw-video") as $vid) {
		echo htmlentities($vid);
		///return $vid->attr["src"]; 
		
	}*/
}
/*function korak($url){
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

	foreach ($html->find("#pembed") as $em) {
		foreach ($em->find("iframe") as $iframe) {
			$src = $iframe->attr['src'];
			return $src;
		}
	}
}

function korak_vid($url){
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
}*/

//
?>

</pre>
<iframe src="<?= $lk; ?>" allowfullscreen="true" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" class="idframe"></iframe>
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