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
				<span><?php echo empty($item->id) ? 'Nieuw portfolio item' : 'Bewerk portfolio item'; ?></span>
			</h3>
			<div class="content">
				<label for="title">Titel</label> <br />
				<?php echo form_input('title', set_value('title', $item->title), 'class="form-control"'); ?><br />
				<br />
				<label for="body">Content</label> <br />
				<?php echo form_textarea('body', $item->body, 'class="ckeditor form-control"'); ?>
			</div>
		</div>

		<?php if(in_multiarray('portfolio-cat', $this->data['modules_enabled'])): ?><div class="block">
			<h3 class="title">
				<span>Categorie</span>
			</h3>
			<div class="content">
				<label for="categorie">Categorie</label> <br />
				<select name="categorie" class="form-control simple_select1">
					<?php
					foreach ($categories as $value) {
						echo '<option value="' . $value['id'] . '"' . ($item->categorie == $value['id'] ? ' selected' : '') . '>' . $value['title'] . '</option>';
					}
					?>
				</select>
			</div>
		</div><?php endif; ?>

		<div class="block">
			<h3 class="title"><span>Gallerij</span></h3>
			<div class="content">
				<div class="row">
				<?php
				foreach($item->images as $image) {
					echo '
                            <div class="col-md-3 col-sm-6">
                                <div class="block">
                                    <a class="fancybox" href="/img/uploads/portfolio/gallery/' . $image['image'] . '" data-fancybox-group="gallery" title="' .  $item->title . ': ' . $image['title'] . '">
                                        <img src="/resize/340x240/uploads/portfolio/gallery/' . $image['image'] . '" alt="' . $item->title . ': ' . $image['title'] . '" class="img-responsive">
                                        <h3 class="title">' . $image['title'] . '</h3>
                                    </a>
                                </div>
                            </div>';
				}
				?>
				</div>
			</div>
			<div class="content">
				<p>Upload nieuwe gallerij foto's</p>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="block">
			<h3 class="title">
				<span>Thumbnail</span>
			</h3>
			<div class="content">
				<img id="thumbnail-img"<?php echo (!empty($item->thumbnail) ? ' src="/img/uploads/portfolio/' . $item->thumbnail . '"' : ''); ?> class="img-responsive"<?php echo (!empty($item->thumbnail) ? ' style="margin-bottom: 15px"' : ' style="display: none; margin-bottom: 15px"'); ?>>
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
				<?php echo form_input('meta_title', set_value('meta_title', (!empty($item->meta_title) ? $item->meta_title : '')), 'class="form-control"'); ?><br />
				<br />
				<label for="meta_description">Meta omschrijving</label> <br />
				<?php echo form_input('meta_description', set_value('meta_description', (!empty($item->meta_description) ? $item->meta_description : '')), 'class="form-control"'); ?><br />
				<br />
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