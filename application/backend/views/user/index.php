<div class="row">
	<div class="col-md-12">
		<div class="block">
			<h3 class="title">
				<?php echo anchor('/user/edit', 'Nieuwe gebruiker'); ?>
				<span>Alle gebruikers</span>
			</h3>
			<div class="content">
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>Naam</th>
							<th>E-mailadres</th>
							<th>Bewerken</th>
						</tr>
					</thead>
				<tbody>
				<?php if(count($users)): foreach($users as $user): ?>	
						<tr>
							<td><?php echo $user->name; ?></td>
							<td><?php echo $user->email; ?></td>
							<td><?php echo ($user->id != 1 || $this->session->userdata('id') == 1 ? anchor('/user/edit/' . $user->id, 'Bewerk ' . $user->name) : ''); ?></td>
						</tr>
				<?php endforeach; ?>
				<?php endif; ?>	
				</tbody>
				</table>
			</div>
		</div>
	</div>
</div>