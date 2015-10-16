<?php
class Admin_Controller extends MY_Controller {

	function __construct () {
		parent::__construct();
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('user_m');
		$this->load->model('system_m');
		$this->data['meta_title'] = ($this->system_m->get_value('web_title')[0]['value']) . ' &#8212; MyWebsite';
		$this->data['modules_enabled'] = ($this->db->select('name')->get_where('gl_system_modules', array('status' => '1'))->result_array());

		// Login check
		$exception_uris = array(
			'user/login', 
			'user/logout'
		);
		if (in_array(uri_string(), $exception_uris) == FALSE) {
			if ($this->user_m->loggedin() == FALSE) {
				redirect('user/login');
			}
		}
	}
}