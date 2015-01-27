<?php echo form_open(); ?>
<?php if(!empty($status) && $status == "success") { ?>
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-success">Uw wijzigen zijn opgeslagen</div>
	</div>
</div>
<?php } ?>
<div class="row">
	<div class="col-md-6">
		<div class="block">
			<h3 class="title">
				<span>Algemene instellingen</span>
			</h3>
			<div class="content">
				<?php echo validation_errors(); ?>
				<div class="form-group">
					<?php echo form_label('Website naam: ', 'web_title'); ?>
					<?php echo form_input('web_title', set_value('web_title', $system['web_title']), 'class="form-control" required'); ?>
				</div>
			</div>
		</div>

		<div class="block">
			<h3 class="title">
				<span>Contact gegevens</span>
			</h3>
			<div class="content">
				<div class="form-group">
					<?php echo form_label('Adres: ', 'contact_address'); ?>
					<?php echo form_input('contact_address', set_value('contact_address', $system['contact_address']), 'class="form-control"'); ?>
				</div>
				<div class="form-group">
					<?php echo form_label('Postcode & woonplaats: ', 'contact_postcode'); ?>
					<?php echo form_input('contact_postcode', set_value('contact_postcode', $system['contact_postcode']), 'class="form-control"'); ?>
				</div>
				<div class="form-group">
					<?php echo form_label('Telefoonnummer: ', 'contact_phone'); ?>
					<?php echo form_input('contact_phone', set_value('contact_phone', $system['contact_phone']), 'class="form-control"'); ?>
				</div>
				<div class="form-group">
					<?php echo form_label('E-mailadres: ', 'contact_email'); ?>
					<?php echo form_input('contact_email', set_value('contact_email', $system['contact_email']), 'class="form-control" required'); ?>
				</div>
			</div>
		</div>

		<?php if($this->session->userdata('id') == '1') { ?>
			<div class="block">
				<h3 class="title">
					<span>Support widget instellingen</span>
				</h3>
				<div class="content">
					<p>
						Deze sectie is alleen zichtbaar voor de administrator van de website, dus de gebruiker met ID = '1'.
					</p>
					<div class="form-group">
						<?php echo form_label('Openingstijden: ', 'supportwidget_openingstijden'); ?>
						<?php echo form_input('supportwidget_openingstijden', set_value('supportwidget_openingstijden', $system['supportwidget_openingstijden']), 'class="form-control"'); ?>
					</div>
					<div class="form-group">
						<?php echo form_label('Telefoonnummer: ', 'supportwidget_phone'); ?>
						<?php echo form_input('supportwidget_phone', set_value('supportwidget_phone', $system['supportwidget_phone']), 'class="form-control"'); ?>
					</div>
					<div class="form-group">
						<?php echo form_label('E-mailadres: ', 'supportwidget_email'); ?>
						<?php echo form_input('supportwidget_email', set_value('supportwidget_email', $system['supportwidget_email']), 'class="form-control"'); ?>
					</div>
					<div class="form-group">
						<?php echo form_label('Website: ', 'supportwidget_website'); ?>
						<?php echo form_input('supportwidget_website', set_value('supportwidget_website', $system['supportwidget_website']), 'class="form-control" required'); ?>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
	<div class="col-md-6">
		<div class="block">
			<h3 class="title">
				<span>Social Media</span>
			</h3>
			<div class="content">
				<div class="form-group">
					<?php echo form_label('Facebook URL: ', 'social_facebook'); ?>
					<?php echo form_input('social_facebook', set_value('social_facebook', $system['social_facebook']), 'class="form-control"'); ?>
				</div>
				<div class="form-group">
					<?php echo form_label('Twitter URL: ', 'social_twitter'); ?>
					<?php echo form_input('social_twitter', set_value('social_twitter', $system['social_twitter']), 'class="form-control"'); ?>
				</div>
				<div class="form-group">
					<?php echo form_label('Google+ URL: ', 'social_googleplus'); ?>
					<?php echo form_input('social_googleplus', set_value('social_googleplus', $system['social_googleplus']), 'class="form-control"'); ?>
				</div>
				<div class="form-group">
					<?php echo form_label('LinkedIn URL: ', 'social_linkedin'); ?>
					<?php echo form_input('social_linkedin', set_value('social_linkedin', $system['social_linkedin']), 'class="form-control"'); ?>
				</div>
			</div>
		</div>

		<div class="block">
			<h3 class="title">
				<span>E-mail instellingen</span>
			</h3>
			<div class="content">
				<div class="form-group">
					<?php echo form_label('SMTP-server: ', 'smtp_server'); ?>
					<?php echo form_input('smtp_server', set_value('smtp_server', $system['smtp_server']), 'class="form-control" required'); ?>
				</div>
				<div class="form-group">
					<?php echo form_label('SMTP-server port: ', 'smtp_port'); ?>
					<?php echo form_input('smtp_port', set_value('smtp_port', $system['smtp_port']), 'class="form-control" required'); ?>
				</div>
				<div class="form-group">
					<?php echo form_label('E-mailadres: ', 'smtp_email'); ?>
					<?php echo form_input('smtp_email', set_value('smtp_email', $system['smtp_email']), 'class="form-control" required'); ?>
				</div>
				<div class="form-group">
					<?php echo form_label('Wachtwoord: ', 'smtp_password'); ?>
					<?php echo form_password('smtp_password', set_value('smtp_password', $system['smtp_password']), 'class="form-control" required'); ?>
				</div>
			</div>
		</div>
		<div class="block">	
			<?php echo form_submit('submit', 'Save', 'class="btn btn-primary form-control"'); ?>
		</div>
	</div>
</div>
<?php echo form_close();?>