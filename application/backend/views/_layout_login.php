<?php $this->load->view('components/page_head'); ?>

	<div class="container"> 
		<div class="row">
			<div class="col-md-12">
				<div id="login">
					
					<?php $this->load->view($subview); // Subview is set in controller ?>

				</div>
			</div>
<?php $this->load->view('components/page_tail'); ?>