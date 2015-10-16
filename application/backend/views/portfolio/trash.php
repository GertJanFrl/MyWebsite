<div class="row">
	<div class="col-md-12">
		<div class="block">
			<h3 class="title">
				<span>Portfolio item's in prullenbak</span>
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
							<b><?php echo anchor('/_admin/portfolio/edit/' . $item->id, $item->title); ?></b> <br />
							<span>
								- <a href="/_admin/portfolio/index/restore/<?php echo $item->id; ?>/">Pagina herstellen</a><br />
								- <a href="/_admin/portfolio/trash/<?php echo $item->id; ?>/page/"><span style="color: #A00;">Permanent verwijderen <small>(Inclusief sub-pagina's)</small></span></a>
							</span>
						</td>
						<td>
							<b>Titel:</b> <?php echo $item->meta_title; ?> <br />
							<b>Omschrijving:</b> <?php echo $item->meta_description; ?>
						</td>
					</tr>
					<?php
					foreach ($items_sub as $key => $item_sub) {
						if($item_sub->id_parent == $item->id) {
							?>
							<tr class="child">
								<td style="padding-left: 25px;">
									<?php echo anchor('/_admin/portfolio/sub/' . $item_sub->id . '/', '— ' . $item_sub->title); ?> <br />
									<span><?php echo btn_delete('/_admin/portfolio/trash/' . $item_sub->id . '/sub/'); ?></span>
								</td>
								<td>
									<b>Titel:</b> <?php echo $item_sub->meta_title; ?> <br />
									<b>Omschrijving:</b> <?php echo $item_sub->meta_description; ?>
								</td>
							</tr>
							<?php
						}
					}
					?>
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