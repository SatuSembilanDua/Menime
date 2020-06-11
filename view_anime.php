<?php
$link = d_url($_GET['link']);
$list_anime = list_anime($link);
?>
<h2><?= $anime_txt; ?></h2>
<br><br>
<iframe style="width:100%; height:500px;" src="<?= $list_anime['video']; ?>" allowfullscreen="true" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" class="idframe" __idm_frm__="1931"></iframe>
<br><br>