<div class="row">
	<div class="col-md-12">
		<div class="block">
			<h3 class="title">
                <a href="/_admin/diensten/domein/edit/">Nieuwe TLD</a>
				<span>Alle TLD's</span>
			</h3>
			<div class="content">
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th width="40%">TLD</th>
                            <th width="30%">Prijs eerste jaar</th>
                            <th width="30%">Prijs normaal</th>
						</tr>
					</thead>
				<tbody>
				<?php if(count($domain_tld)): foreach($domain_tld as $tld): ?>
					<tr>
						<td>
							<b>.<a href="/_admin/diensten/domein/edit/<?php echo $tld['id']; ?>"><?php echo $tld['tld']; ?></a></b> <br />
							<span><a href="/_admin/diensten/domein/edit/<?php echo $tld['id']; ?>">Bewerkt domein TLD</a> | <a href="/_admin/diensten/domein/trash/<?php echo $tld['id']; ?>"><span style="color: #A00;">Verwijder TLD</span></a></span>
						</td>
                        <td>
                            &euro; <?php echo number_format(($tld['price']/100), 2, ',', ' '); ?>
                        </td>
						<td>
                            &euro; <?php echo number_format(($tld['price_renewal']/100), 2, ',', ' '); ?>
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