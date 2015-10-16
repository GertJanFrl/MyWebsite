<div class="row">
	<div class="col-md-12">
		<div class="block">
			<h3 class="title">
				<?php echo anchor('/page/edit', 'Nieuwe pagina'); ?>
				<span>Alle pagina's</span>
			</h3>
			<div class="content">
                <p id="sortState" class="enabled"><a><i class="fa fa-sort"></i> Sorteren inschakelen</a></p>
				<table class="table table-striped table-hover table-sort">
					<thead>
						<tr>
							<th width="35%" colspan="2">Titel</th>
							<th width="65%">SEO (Meta informatie)</th>
						</tr>
					</thead>
				<tbody class="disabled sortable">
				<?php if(count($pages)): foreach($pages as $page): ?>
					<tr data-id="<?php echo $page->id; ?>">
                        <td class="icon-sort"><i class="fa fa-sort"></i></td>
						<td>
							<b><?php echo anchor('/page/edit/' . $page->id, $page->title); ?></b> <br />
							<span><?php echo btn_edit('/page/edit/' . $page->id); ?> | <a href="/_admin/page/trash/<?php echo $page->id; ?>"><span style="color: #A00;">Verplaats naar prullenbak</span></a> | <a href="/<?php echo $page->url; ?>/">Bekijk pagina</a></span>
						</td>
						<td>
							<b>Titel:</b> <?php echo $page->meta_title; ?> <br />
							<b>Omschrijving:</b> <?php echo $page->meta_description; ?>
						</td>
					</tr>
					<?php
					foreach ($pages_sub as $key => $page_sub) {
						if($page_sub->id_parent == $page->id) {
							?>
							<tr class="child">
                                <td></td>
								<td style="padding-left: 25px;">
									<?php echo anchor('/page/sub/' . $page_sub->id . '/', '— ' . $page_sub->title); ?> <br />
									<span><?php echo btn_edit('/page/sub/' . $page_sub->id . '/'); ?> | <a href="/_admin/page/trash/<?php echo $page_sub->id; ?>/sub"><span style="color: #A00">Verwijderen</span></a> | <a>Bekijk pagina</a></span>
								</td>
								<td>
									<b>Titel:</b> <?php echo $page_sub->meta_title; ?> <br />
									<b>Omschrijving:</b> <?php echo $page_sub->meta_description; ?>
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