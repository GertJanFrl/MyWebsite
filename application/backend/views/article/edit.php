<?php echo form_open_multipart(); ?>
<?php echo validation_errors(); ?>
<div class="row">
	<div class="col-md-9">
		<?php
        if($this->session->flashdata('success') !== FALSE) {
			echo '<div class="alert alert-success">Uw wijzigen zijn opgeslagen</div>';
		}
		?>
		<div class="block">
			<h3 class="title">
				<span><?php echo empty($article->id) ? 'Nieuw blogbericht' : 'Bewerk blogbericht'; ?></span>
			</h3>
			<div class="content">
				<label for="title">Titel</label> <br />
				<?php echo form_input('title', set_value('title', $article->title), 'class="form-control"'); ?><br />
				<br />
				<label for="body">Content</label> <br />
				<?php echo form_textarea('body', set_value('body', $article->body), 'class="ckeditor form-control"'); ?>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="block">
			<h3 class="title">
				<span>Publiceren</span>
			</h3>
			<div class="content">
				<label for="pubdate">Publicatie datum</label> <br />
				<?php echo form_input('pubdate', set_value('pubdate', $article->pubdate), 'class="form-control datetimepicker"'); ?> <br />
				<br />
				<label for="author">Auteur</label> <br />
                <select name="author" class="form-control simple_select1">
    				<?php
                    foreach ($authors as $value) {
                        echo '<option value="' . $value['id'] . '">' . $value['name'] . '</option>';
                    }
                    ?>
                </select>
				<?php //echo form_dropdown('author', $authors, set_value('author', (!empty($article->author) ? $article->author : '')), 'class="form-control simple_select1"'); ?> <br />
				<br />
				<?php echo form_submit('submit', 'Opslaan', 'class="btn btn-primary form-control"'); ?>
			</div>
		</div>

		<div class="block">
			<h3 class="title">
				<span>Thumbnail</span>
			</h3>
			<div class="content">
				<img id="thumbnail-img"<?php echo (!empty($article->thumbnail) ? ' src="/img/uploads/blog/' . $article->thumbnail . '"' : ''); ?> class="img-responsive"<?php echo (!empty($article->thumbnail) ? '' : ' style="display: none;"'); ?>> <br />
				<div class="d">
					<span>Upload thumbnail</span>
					<input id="thumbnail" name="thumbnail" type="file" accept="image/*"/>
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo form_close();?>