<?php echo validation_errors(); ?>
<?php echo form_open_multipart(); ?>
<div class="row">
	<div class="col-md-9">
		<?php
        if($this->session->flashdata('success')) {
			echo '<div class="alert alert-success">Uw wijzigen zijn opgeslagen</div>';
		}
		?>
		<div class="block">
			<h3 class="title">
				<span><?php echo empty($page->id) ? 'Nieuwe pagina' : 'Bewerk pagina'; ?></span>
			</h3>
			<div class="content">
				<label for="title">Titel</label> <br />
				<?php echo form_input('title', set_value('title', $page->title), 'class="form-control"'); ?><br />
                <br />
                <label for="body">Content</label> <br />
                <?php echo form_textarea('body', $page->body, 'class="ckeditor form-control"'); ?><br />
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<?php if(empty($page->id)) { ?>
		<div class="block">
			<h3 class="title">
				<span>Hoofd-pagina</span>
			</h3>
			<div class="content">
				<?php echo form_dropdown('id_parent', $pages_no_parents, (!empty($page->id_parent) ? $page->id_parent : '0'), 'class="form-control simple_select1"'); ?>
			</div>
		</div>
		<?php } ?>
		<div class="block">
			<h3 class="title">
				<span>Thumbnail</span>
			</h3>
			<div class="content">
				<img id="thumbnail-img"<?php echo (!empty($page->thumbnail) ? ' src="/img/uploads/page/' . $page->thumbnail . '"' : ''); ?> class="img-responsive"<?php echo (!empty($page->thumbnail) ? ' style="margin-bottom: 15px"' : ' style="display: none; margin-bottom: 15px"'); ?>>
				<div class="upload btn btn-primary">
					<span>Upload thumbnail</span>
					<input id="thumbnail" name="thumbnail" type="file" accept="image/*"/>
				</div>
			</div>
		</div>
		<div class="block">
			<h3 class="title">
				<span>Zoekmachine optimalisatie</span>
			</h3>
			<div class="content">
				<label for="meta_title">Meta titel</label> <br />
				<?php echo form_input('meta_title', set_value('meta_title', (!empty($page->meta_title) ? $page->meta_title : '')), 'class="form-control"'); ?><br />
				<br />
				<label for="meta_description">Meta omschrijving</label> <br />
				<?php echo form_input('meta_description', set_value('meta_description', (!empty($page->meta_description) ? $page->meta_description : '')), 'class="form-control"'); ?><br />
				<br />
			</div>
		</div>
		
		<div class="block">
			<h3 class="title">
				<span>Publiceren</span>
			</h3>
			<div class="content">
                <?php if(!isset($page->id_parent)) { ?><label><?php echo form_checkbox('navigation_visible', '1', (!empty($page->navigation_visible) ? 'TRUE' : '')); ?> Zichtbaar in menu</label><br /><?php } ?>
				<?php echo form_submit('submit', 'Opslaan', 'class="btn btn-primary form-control"'); ?>
			</div>
		</div>
	</div>
</div>
<?php echo form_close();?>