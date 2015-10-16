<?php echo validation_errors(); ?>
<?php echo form_open_multipart(); ?>
<div class="row">
	<div class="col-md-9">
		<?php
        if($this->session->flashdata('success') !== FALSE) {
			echo '<div class="alert alert-success">Uw wijzigen zijn opgeslagen</div>';
		}
		?>
		<div class="block">
			<h3 class="title">
				<span><?php echo empty($item->id) ? 'Nieuwe TLD' : 'Bewerk TLD'; ?></span>
			</h3>
			<div class="content">
                <label for="tld">TLD</label> <br />
                <?php echo form_input('tld', set_value('tld', $item->tld), 'class="form-control"'); ?><br />
                <br />
                <label for="price">Prijs eerste jaar</label> (in centen)<br />
                <?php echo form_input('price', set_value('price', $item->price), 'class="form-control"'); ?><br />
                <br />
                <label for="price_renewal">Normale prijs</label> (in centen)<br />
                <?php echo form_input('price_renewal', set_value('price_renewal', $item->price_renewal), 'class="form-control"'); ?><br />
                <br />
                <label for="registration_length">Registratie lengte</label> (in jaren) <br />
                <?php echo form_input('registration_length', set_value('registration_length', $item->registration_length), 'class="form-control"'); ?><br />
                <br />
                <label>
                    <?php echo form_checkbox('popular', 1, $item->popular); ?>
                    Populaire TLD?
                </label> <br />
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="block">
			<h3 class="title">
				<span>Publiceren</span>
			</h3>
			<div class="content">
				<?php echo form_submit('submit', 'Opslaan', 'class="btn btn-primary form-control"'); ?>
			</div>
		</div>
	</div>
</div>
<?php echo form_close();?>