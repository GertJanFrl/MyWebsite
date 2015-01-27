<?php echo form_open(); ?>
<?php if(!empty($status) && $status == "success") { ?>
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-success">Uw wijzigen zijn opgeslagen</div>
	</div>
</div>
<?php } ?>
<div class="row">
	<div class="col-md-12">
		<div class="block">
			<h3 class="title">
				<span>Informatie</span>
			</h3>
			<div class="content">
				<p>
					Op deze pagina kunnen administratoren aangeven welke modules ingeschakeld en uitgeschakeld moeten worden.
				</p>
			</div>
		</div>

		<div class="block">
			<h3 class="title">
				<span>Modules</span>
			</h3>
			<div class="content no-select">
				<ul>
					<?php
					foreach ($modules as $key => $value) {
						echo '<li>';
						echo '<label>';
						echo form_checkbox($key, '1', $value[1]);
						echo ' ' . $value[0] . ' inschakelen';
						echo '</label>';
						echo '</li>';
					}
					?>
				</ul>
			</div>
		</div>

		<div class="block">	
			<?php echo form_submit('submit', 'Save', 'class="btn btn-primary form-control"'); ?>
		</div>
	</div>
</div>
<?php echo form_close();?>