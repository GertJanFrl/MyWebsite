<div class="row">
	<div class="col-md-12">
		<div class="block">
			<h3 class="title">
				<?php echo anchor('/_admin/article/edit', 'Nieuw bericht'); ?>
				<span>Blogberichten</span>
			</h3>
			<div class="content">
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>Titel</th>
							<th>Auteur</th>
							<th>Datum</th>
						</tr>
					</thead>
				<tbody>
				<?php if(count($articles)): foreach($articles as $article): ?>
					<tr>
						<td>
							<b><?php echo anchor('/_admin/article/edit/' . $article->id, $article->title); ?></b> <br />
							<span><?php echo btn_edit('/_admin/article/edit/' . $article->id); ?> | <?php echo btn_delete('/_admin/article/delete/' . $article->id); ?> | <a>Bekijk bericht</a></span>
						</td>
						<td><?php echo $this->user_m->get_user($article->author)[0]['name']; ?></td>
						<td><?php echo strftime("%d %B %Y", strtotime($article->pubdate)); ?></td>
					</tr>
				<?php endforeach; ?>
				<?php else: ?>
					<tr>
						<td colspan="3">Geen resultaten gevonden.</td>
					</tr>
				<?php endif; ?>	
				</tbody>
				</table>
			</div>
		</div>
	</div>
</div>