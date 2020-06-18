<h2>LIST ANIME</h2>

<pre>
<?php
	$data = json_decode(file_get_contents("data/avatar_the_legend_of_aang.json") ,true);
	
	/*foreach ($data as $k => $v) {
		if($k==15){
			$tmp_15 = $v['link'];
		}
		if($k==16){
			$tmp_16 = $v['link'];
		}
		if($k==17){
			$tmp_17 = $v['link'];
		}
		if($k==18){
			$tmp_18 = $v['link'];
		}
	}
	echo $tmp_15;
	echo "<br>";
	echo $tmp_16;
	$data[15]["link"] = $tmp_16;
	$data[16]["link"] = $tmp_15;*/

	$array  = ["Naruchiha_Avatar_Dub_Indo_01_HD.mp4" => "1rDdZjYH6B4DQArkPmlO1GCEss3QxjArw",
"Naruchiha_Avatar_Dub_Indo_02_HD.mp4" => "1oIQYgDN9vsCRgmx0TRIeDYsHD04eBjdZ",
"Naruchiha_Avatar_Dub_Indo_03_HD.mp4" => "1E4Eu_OP-_7i18m38mAF4uEpaHfkIbOEQ",
"Naruchiha_Avatar_Dub_Indo_09_HD.mp4" => "1K91oC7UnGp-bqCnXeNKO0zQ2E3Kw6419",
"Naruchiha_Avatar_Dub_Indo_08_HD.mp4" => "1EMxBDtbJWeElkYYGPBScdo9dK_bZrbPd",
"Naruchiha_Avatar_Dub_Indo_05_HD.mp4" => "1AcbHJBSa43K8vBTj47EkA0uSFTdpssDs",
"Naruchiha_Avatar_Dub_Indo_04_HD.mp4" => "1OY_tpDY3KJ2KL1pytmKc8-39oU6EqNJh",
"Naruchiha_Avatar_Dub_Indo_06_HD.mp4" => "1cQKuaJbWRzbtwsWHX_7LV9_7MkB8Oj_E",
"Naruchiha_Avatar_Dub_Indo_07_HD.mp4" => "197dNt7hDD1cTjJy034FwtWn6L_yHNEjh",
"Naruchiha_Avatar_Dub_Indo_10_HD.mp4" => "14-XUyYe1BOvcTOHDVCED94gYuPJvTzOi",
"Naruchiha_Avatar_Dub_Indo_11_HD.mp4" => "16i477A07fGkDBfx-Rf73VtV8hJSWVqsk",
"Naruchiha_Avatar_Dub_Indo_13_HD.mp4" => "11dmlO_Xk8iMn1SgluNa8Sc0lNZo21mYD",
"Naruchiha_Avatar_Dub_Indo_12_HD.mp4" => "1LgutNpGElpIz7BZvOxsoCaVrZyWvVV9q",
"Naruchiha_Avatar_Dub_Indo_14_HD.mp4" => "1_tTlsZ7cuNTfbTorHG2m_YAGgAcFnGIU",
"Naruchiha_Avatar_Dub_Indo_15_HD.mp4" => "1NEo_1QipCtxJC_Duk77BWberzv3_KFvo",
"Naruchiha_Avatar_Dub_Indo_17_HD.mp4" => "17hq8s_5yhhG7ixze4hKzReNpyfPF7S2i",
"Naruchiha_Avatar_Dub_Indo_16_HD.mp4" => "1i8VFet7Dgcjds5rtdAl7go4yC2tUaFYG",
"Naruchiha_Avatar_Dub_Indo_19_HD.mp4" => "19Ex0pd5nJolWfMgvyPhGgfWzcUisO2QI",
"Naruchiha_Avatar_Dub_Indo_18_HD.mp4" => "1KE0sovHzLvNLIjJq9T0qPOMJ6eu7f2Gk",
"Naruchiha_Avatar_Dub_Indo_21_HD.mp4" => "1RAi4HbWPKs_gcuKKmwO-dDbVHMinLhbR",
"Naruchiha_Avatar_Dub_Indo_31_HD.mp4" => "1xyGpEJNQyrD_H3bPoB4N_izYQCojlaCC",
"Naruchiha_Avatar_Dub_Indo_30_HD.mp4" => "13dHKVNSSo2qlDUSBCMV0JKKe_1F2SZHi",
"Naruchiha_Avatar_Dub_Indo_29_HD.mp4" => "1gfPZzX16yOtvux7jIlW3Lk9Dy2nhzF1D",
"Naruchiha_Avatar_Dub_Indo_28_HD.mp4" => "1rs-E3jywwDpLkI3qLpQvtO8EwmUqZGWM",
"Naruchiha_Avatar_Dub_Indo_27_HD.mp4" => "109iDkZ_JHaO7Ft2jr3TTirxtxfCmo263",
"Naruchiha_Avatar_Dub_Indo_25_HD.mp4" => "1NEeKgYcZ9Z384pr9ZiP-LTHPdTKAGqtd",
"Naruchiha_Avatar_Dub_Indo_24_HD.mp4" => "1rOJ4VZ9qe1pSGFJdz6a0hcCgzgXYGTew",
"Naruchiha_Avatar_Dub_Indo_23_HD.mp4" => "1BP2isdtzSxViXWQhgSrmFTUco1gJh8T5",
"Naruchiha_Avatar_Dub_Indo_22_HD.mp4" => "12eXTm0BmD9xoMxZwH1fhb-vMmBqP3QvA",
"Naruchiha_Avatar_Dub_Indo_20_HD.mp4" => "1W5EvJMmqQPcv93VGHo9PMyILYpkXlK2r",
"Naruchiha_Avatar_Dub_Indo_49_HD.mp4" => "1q-d_09nJLC-upcSOJWtHSW90RxQb2ncv",
"Naruchiha_Avatar_Dub_Indo_46_HD.mp4" => "1HYIQWr3dlD97FAaDpPVWThlu1G-WDFhp",
"Naruchiha_Avatar_Dub_Indo_44_HD.mp4" => "17yXJQ4hhHZSuzj1_YQuA2w365CsovGVA",
"Naruchiha_Avatar_Dub_Indo_43_HD.mp4" => "1pvg1o2N0R56qdRqGmjgZ_XMqcBSn3mT0",
"Naruchiha_Avatar_Dub_Indo_42_HD.mp4" => "1SjaxhEmwk22sAy5xPujlOFjqf8yUiTW6",
"Naruchiha_Avatar_Dub_Indo_41_HD.mp4" => "1ZnaT9lMQzz50wUEZtg3E0obGLlZHNGeB",
"Naruchiha_Avatar_Dub_Indo_40_HD.mp4" => "1g2U35KCsu04-1HGpZ1qCDq7qKgXsTKIi",
"Naruchiha_Avatar_Dub_Indo_39_HD.mp4" => "15ttYtp891hEomWq9TrcfDKbYDGD-8CRs",
"Naruchiha_Avatar_Dub_Indo_38_HD.mp4" => "1ndEthqWRVzMV87-4bPORlx8OPhfAfoL1",
"Naruchiha_Avatar_Dub_Indo_37_HD.mp4" => "1ohoMdW_7OQgEWO25Emm7S_KBJkAmKOR-",
"Naruchiha_Avatar_Dub_Indo_36_HD.mp4" => "11FQ9jm0MC525bQTveOzzj8KVxHFfSG8a",
"Naruchiha_Avatar_Dub_Indo_35_HD.mp4" => "1b9ozxm54qRlpkPid8cJ1OmEXmEi8iB6k",
"Naruchiha_Avatar_Dub_Indo_34_HD.mp4" => "14iChpu6tZFKB2NNYyRC498SjJPHC4JYW",
"Naruchiha_Avatar_Dub_Indo_33_HD.mp4" => "17-LPI_7gMB9DAMReOdILuLImGFlQao6b",
"Naruchiha_Avatar_Dub_Indo_32_HD.mp4" => "1X6hwPHNso-pJpp0wfQnkvLdQ5qZCx5zH",
"Naruchiha_Avatar_Dub_Indo_60_HD.mp4" => "1A5sgOuClSZKbv4lUwTjOEWFoj_elhrpC",
"Naruchiha_Avatar_Dub_Indo_59_HD.mp4" => "1FbSo-LW9-HCfkZCLOu3-6DlaU77WZvm3",
"Naruchiha_Avatar_Dub_Indo_58_HD.mp4" => "1NwRXOR8E96YBaCvfPYuXe5G-ejx-TZj6",
"Naruchiha_Avatar_Dub_Indo_57_HD.mp4" => "1AF2qCgo5GskF22kbFUqYe5aKUetF4lV2",
"Naruchiha_Avatar_Dub_Indo_56_HD.mp4" => "14-Nhb9VIVbX0PsPgz6NjFGMIiFkgcAvc",
"Naruchiha_Avatar_Dub_Indo_55_HD.mp4" => "12yzJlKErVl_i1Xrlu0GwWB4MtWGOYXu0",
"Naruchiha_Avatar_Dub_Indo_54_HD.mp4" => "1ThXVC5LijcOhyXNKu2F5sC-ZhkrAM09t",
"Naruchiha_Avatar_Dub_Indo_53_HD.mp4" => "1wcFaDmSAfQ7yvaaDgiciX9G2mucpe9xA",
"Naruchiha_Avatar_Dub_Indo_52_HD.mp4" => "1r9xyDGe9fRx2-ZWJAyIwwd-NoQLlSOgd",
"Naruchiha_Avatar_Dub_Indo_51_HD.mp4" => "1cU4d3QPhrDWSchAPuoUnZXY2IpTN7yBY",
"Naruchiha_Avatar_Dub_Indo_50_HD.mp4" => "1OPRl2JJwhR3OvB0uXs5IUAHk6kk-JFSB",
"Naruchiha_Avatar_Dub_Indo_48_HD.mp4" => "1-I7smPq3wIg5bpngarGC40_mgQ-rNrOW",
"Naruchiha_Avatar_Dub_Indo_47_HD.mp4" => "1GQDj_cllzDuYi760xZK_NDuz5Aana1YO",
"Naruchiha_Avatar_Dub_Indo_45_HD.mp4" => "1UDXOr_3Z97uvgIl5De7jAMxb_o1fZyKf",
"Naruchiha_Avatar_Dub_Indo_61_HD.mp4" => "1V-Yz6IFkm65ZJL865nTGekIYfL_g14A_",
"Naruchiha_Avatar_Dub_Indo_26_HD.mp4" => "1nKyJIC5qJUkOMN-YbJ0tp-q_ORJrLGh-"];
	//print_r($array);
	
	//print_r($data);

	foreach ($data as $k => $v) {
		$eps = $v["id_eps"]+1;
		$tmp = "00".$eps;
		$eps = substr($tmp, strlen($tmp)-2, strlen($tmp));
		foreach ($array as $a => $b) {
			$ke = explode("_", $a)[4];
			if($ke == $eps){
				$data[$k]["link"] = "https://drive.google.com/uc?export=download&id=".$b;
			}
		}
	}
/*
	print_r($data);
	$myfile = fopen("data/avatar_the_legend_of_aang.json", "w") or die("Unable to open file!");
	fwrite($myfile, json_encode($data));
	fclose($myfile);
	*/
?>
</pre>

<!-- <video controls="controls">
        Safari
    <source src="https://drive.google.com/uc?export=download&id=1rDdZjYH6B4DQArkPmlO1GCEss3QxjArw" type='video/mp4'/>
    Chrome and FF
    <source src="https://drive.google.com/uc?export=download&id=1rDdZjYH6B4DQArkPmlO1GCEss3QxjArw" type='video/webm'/>
</video> -->

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