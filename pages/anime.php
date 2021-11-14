<?php

if(isset($_GET['a'])):
	
	
	$ml_current["img"] = $row['img'];
	$ml_current["link"] = $row['link_anime'];
	$ml_current["desc"] = html_entity_decode($row['desc_anime']);
	$infox = array(
									"Status" => $row["sts"]==1?"Complete":"Ongoing",
									"Studio" => $row["studio"]==""?"":"<a href=\"".base_url("index.php?page=cari&studio=".e_url($row["studio"]))."\" >".$row["studio"]."</a>",
									"Dirilis pada tahun" => $row["dirilis_pada_tahun"],
									"Durasi" => $row["durasi"],
									"Season" => $row["season"]==""?"":"<a href=\"".base_url("index.php?page=cari&season=".e_url($row["season"]))."\" >".$row["season"]."</a>",
									"Tipe" => $row["tipe"],
									"Episodes" => $row["episodes"],
									"Dirilis pada" => $row["dirilis_pada"],
								);
	$tags = explode(";", $row["tags"]);
	$ml_current["info"] = gen_info($infox, $tags);
	$status_table = $row["ket_sts"];
		//$_src_ = $row["src"];
	

?>
<h2>NONTON <?= strtoupper($anime_txt); ?></h2>
<div class="row">
	<div class="col-xs-4 col-md-2">
		<img src="<?= $ml_current['img']; ?>" alt="anime" class="img-res">
	</div>
	<div class="col-xs-8 col-md-10 anime-desk">
		<?= $ml_current['desc']==""?$ml_current['info']:$ml_current['desc']; ?>
	</div>
</div>
<hr>
<div class="anime-infoni">
<?= $ml_current['desc']==""?"":$ml_current['info']; ?>
</div>


<!-- LIST ANIME -->
<h2>LIST ANIME <?= strtoupper($anime_txt); ?></h2>
<br>
<?php if($status_table==1 || $status_table==2 || $status_table==4): ?>
	<table class="table table table-list myTable">
		<thead>
			<tr>
				<th>No</th>
				<th width="100px">Eps</th>
				<th>Judul</th>
				<th width="100px">Date</th>
			</tr>
		</thead>
		<tbody>
		<?php
			$i=0;
			if($status_table==2){
				$q = $tb_onepiece->get_all("WHERE anime.id_anime = '$id_anime' ORDER BY id_eps DESC ");
			}else if($status_table==4){
				$q = $tb_boruto->get_all("WHERE anime.id_anime = '$id_anime' ORDER BY id_eps DESC ");
			}else{
				$ideps_sepcial = ["ME0013", "ME0014"]; /* IF videos is parted */
				if(in_array($id_anime, $ideps_sepcial)){
					$q = $tb_episode->get_qwhere("anime.id_anime = '$id_anime' GROUP BY episodes.eps ORDER BY id_eps ASC");
				}else{
					$q = $tb_episode->get_byfk($id_anime);
				}
			}
			while($row = $tb_menime->fetch_assoc($q)){
				$link_lama = "index.php?page=view_anime&id=".e_url($row["id_episode"])."&src=".e_url($status_table);
				$lkeps = explode(" ", $row["eps"])[1];
				$link = base_url("view/$row[link_anime]_$lkeps&src=".e_url($status_table));
		?>
			<tr>
				<td><a href="<?= $link; ?>"><?= ++$i; ?></a></td>
				<td><a href="<?= $link; ?>"><?= $row['eps']; ?></a></td>
				<td><a href="<?= $link; ?>"><?= $row['judul']; ?></a></td>
				<td><a href="<?= $link; ?>"><?= $row['date']; ?></a></td>
			</tr>
		<?php
			}
		?>
		</tbody>
	</table>
<?php elseif($status_table==3): /*  IF EPISODE SEASONED */ ?>
<?php
	if($id_anime!="ME0021"){
		$q = $tb_avatar->get_byfk($id_anime);
	}else{
		$q = $tb_spongebob->get_byfk($id_anime);
	}
	$avatar = [];
	while($row = $tb_menime->fetch_assoc($q)){
		$avatar[$row["book"]][] = $row;
	}
?>
	<ul class="nav nav-tabs" role="tablist">
		<?php
			
			$i=0;
			foreach ($avatar as $k => $v):
				$book = ucwords(str_replace(" ", "_", $k));
				$ac = $i==0?'class="active"':"";
		?>
		<li role="presentation" <?= $ac; ?> > 
			<a href="#<?= $book; ?>" aria-controls="<?= $book; ?>" role="tab" data-toggle="tab"><?= $k; ?></a>
		</li>
		<?php
			$i++;
			endforeach;
		?>
	</ul>

	<div class="tab-content">
	<?php		
		$i=0;
		foreach ($avatar as $k => $a):
			$book = ucwords(str_replace(" ", "_", $k));
			$ac = $i==0?'active':"";
	?>
		<div role="tabpanel" class="tab-pane <?= $ac; ?>" id="<?= $book; ?>">
			<br>
			<table class="table table-list">
				<thead>
					<tr>
						<th>No</th>
						<th>Book</th>
						<th>Episode</th>
						<th>Judul</th>
						<th>Date</th>
					</tr>
				</thead>
				<tbody>
				<?php 
					$j=0;
					foreach($a as $b => $v): 
					$link_lama = "index.php?page=view_anime&id=".e_url($v["id_episode"])."&src=".e_url($status_table);
					$link = base_url("view/$v[link_anime]_$v[id_eps]&src=".e_url(($id_anime!='ME0021')?$status_table:$status_table+2));
				?>
					<tr>
						<td><?= ++$j; ?></td>
						<td>
							<a href="<?= $link; ?>"><?= $v["book"]; ?></a>
						</td>
						<td>
							<a href="<?= $link; ?>"><?= $v['eps']; ?></a>
						</td>
						<td>
							<a href="<?= $link; ?>"><?= $v['judul']; ?></a>
						</td>
						<td><?= $v['date']; ?></td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	<?php $i++; endforeach; ?>
	</div>
<?php endif; ?>

<script type="text/javascript">

</script>
<?php endif; ?>


