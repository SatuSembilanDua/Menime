<h2>LIST ANIME</h2>
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