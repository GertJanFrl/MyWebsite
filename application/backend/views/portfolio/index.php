<div class="row">
	<div class="col-md-12">
		<div class="block">
			<h3 class="title">
                <a href="/_admin/portfolio/edit/">Nieuw portfolio item</a>
				<span>Alle portfolio item's</span>
			</h3>
			<div class="content">
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th width="35%">Titel</th>
							<th width="65%">SEO (Meta informatie)</th>
						</tr>
					</thead>
				<tbody>
				<?php if(count($items)): foreach($items as $item): ?>
					<tr>
						<td>
							<b><a href="/_admin/portfolio/edit/<?php echo $item->id; ?>"><?php echo $item->title; ?></a></b> <br />
							<span><a href="/_admin/portfolio/edit/<?php echo $item->id; ?>">Bewerkt item</a> | <a href="/_admin/portfolio/trash/<?php echo $item->id; ?>"><span style="color: #A00;">Verplaats naar prullenbak</span></a> | <a>Bekijk pagina</a></span>
						</td>
						<td>
							<b>Titel:</b> <?php echo $item->meta_title; ?> <br />
							<b>Omschrijving:</b> <?php echo $item->meta_description; ?>
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