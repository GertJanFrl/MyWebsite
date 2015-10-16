<div class="row">
	<div class="col-md-12">
		<div class="block">
			<h3 class="title">
                <a href="/_admin/diensten/hosting/<?php echo $pageurl; ?>/edit/">Nieuw pakket</a>
				<span>Alle pakketten</span>
			</h3>
			<div class="content">
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th width="20%">Pakket</th>
                            <th width="60%">Korte omschrijving</th>
                            <th width="20%">Prijs</th>
						</tr>
					</thead>
				<tbody>
				<?php if(count($hosting)): foreach($hosting as $pakket): ?>
					<tr>
						<td>
							<b><a href="/_admin/diensten/hosting/<?php echo $pageurl; ?>/edit/<?php echo $pakket['id']; ?>"><?php echo $pakket['title']; ?></a></b> <br />
							<span><a href="/_admin/diensten/hosting/<?php echo $pageurl; ?>/edit/<?php echo $pakket['id']; ?>">Bewerkt pakket</a> | <a href="/_admin/diensten/hosting/<?php echo $pageurl; ?>/trash/<?php echo $pakket['id']; ?>"><span style="color: #A00;">Verwijder pakket</span></a></span>
						</td>
                        <td><p><?php echo substr(strip_tags($pakket['body']), 0, 470); ?></p></td>
                        <td>&euro; <?php echo number_format(($pakket['price']/100), 2, ',', ' '); ?></td>
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