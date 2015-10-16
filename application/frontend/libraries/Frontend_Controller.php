<?php
class Frontend_Controller extends MY_Controller
{

	function __construct ()
	{
		parent::__construct();
		
        $this->load->model('page_m');
		$this->load->model('system_m');
		$this->load->model('article_m');
		
		$this->data['meta_title'] = ($this->system_m->get_value('web_title')[0]['value']);
        $this->data['navigation'] = $this->system_m->get_navigation();
        $this->data['social_twitter'] = $this->system_m->get_value('social_twitter')[0]['value'];
	}
}