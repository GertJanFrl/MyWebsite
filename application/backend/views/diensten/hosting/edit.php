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
				<span><?php echo empty($item->id) ? 'Nieuw pakket' : 'Bewerk pakket'; ?></span>
			</h3>
			<div class="content">
                <label for="title">Pakket</label> <br />
                <?php echo form_input('title', set_value('title', $item->title), 'class="form-control"'); ?><br />
                <br />
                <label for="price">Prijs per maand</label> (in centen)<br />
                <?php echo form_input('price', set_value('price', $item->price), 'class="form-control"'); ?><br />
                <br />
                <label for="body">Content</label> <br />
                <?php echo form_textarea('body', set_value('body', $item->body), 'class="ckeditor form-control"'); ?><br />
			</div>
		</div>
	</div>
	<div class="col-md-3">
        <div class="block">
            <h3 class="title">
                <span>Pakket soort</span>
            </h3>
            <div class="content">
                <label>Pakket soort</label><br />
                <label style="font-weight: normal;">
                    <?php echo form_radio('type', 'web', ($item->type == 'web' ? '1' : '')); ?>
                    Webhosting pakket
                </label> <br />
                <label style="font-weight: normal;">
                    <?php echo form_radio('type', 'reseller', ($item->type == 'reseller' ? '1' : '')); ?>
                    Reseller pakket
                </label> <br />
                <label style="font-weight: normal;">
                    <?php echo form_radio('type', 'vps', ($item->type == 'vps' ? '1' : '')); ?>
                    VPS Pakket
                </label> <br />
            </div>
        </div>
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