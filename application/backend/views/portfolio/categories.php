<div class="row">
	<div class="col-md-12">
		<div class="block">
			<h3 class="title">
				<?php echo anchor('/portfolio/categories_edit/', 'Nieuwe categorie'); ?>
				<span>Portfolio categorieën</span>
			</h3>
			<div class="content">
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th width="35%">Titel</th>
						</tr>
					</thead>
				<tbody>
				<?php if(count($items)): foreach($items as $item): ?>
					<tr>
						<td>
							<b><?php echo anchor('/portfolio/categories_edit/' . $item['id'], $item['title']); ?></b> <br />
							<span><a href="/_admin/portfolio/categories_edit/<?php echo $item['id']; ?>">Bewerkt item</a>
						</td>
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