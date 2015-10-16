<div class="row">
	<div class="col-md-12">
		<div class="block">
			<h3 class="title">
				<span>Pagina's in prullenbak</span>
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
				<?php if(count($pages)): foreach($pages as $page): ?>
					<tr>
						<td>
							<b><?php echo anchor('/page/edit/' . $page->id, $page->title); ?></b> <br />
							<span>
								- <a href="/_admin/page/index/restore/<?php echo $page->id; ?>/">Pagina herstellen</a><br />
								- <a href="/_admin/page/trash/<?php echo $page->id; ?>/page/"><span style="color: #A00;">Permanent verwijderen <small>(Inclusief sub-pagina's)</small></span></a>
							</span>
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
								<td style="padding-left: 25px;">
									<?php echo anchor('/page/sub/' . $page_sub->id . '/', '— ' . $page_sub->title); ?> <br />
									<span><?php echo btn_delete('/page/trash/' . $page_sub->id . '/sub/'); ?></span>
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