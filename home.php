<h2>LIST ANIME</h2>
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