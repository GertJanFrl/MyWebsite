<?php
class Dashboard extends Admin_Controller {

    public function __construct(){
        parent::__construct();
        $this->data['currentpage'] = 'dashboard';
    }

    public function index() {
        $this->data['pagetitle'] = 'Dashboard';

        $this->load->model('article_m');
        $this->load->model('page_m');
        $this->load->model('user_m');
        $this->load->model('system_m');

        $this->data['count_articles'] = $this->article_m->get();
        $this->data['count_pages'] = $this->page_m->get();
        $this->data['count_pages_sub'] = $this->page_m->get('', '', true);
    	$this->data['count_users'] = $this->user_m->get();

        $this->db->limit(5);
        $this->data['articles'] = $this->article_m->get();
        $this->data['system']['supportwidget_openingstijden']   = $this->system_m->get_value('supportwidget_openingstijden')[0]['value'];
        $this->data['system']['supportwidget_phone']            = $this->system_m->get_value('supportwidget_phone')[0]['value'];
        $this->data['system']['supportwidget_email']            = $this->system_m->get_value('supportwidget_email')[0]['value'];
        $this->data['system']['supportwidget_website']          = $this->system_m->get_value('supportwidget_website')[0]['value'];
        
        $this->data['subview'] = 'dashboard/index';
    	$this->load->view('_layout_main', $this->data);
    }
    
    public function modal() {
    	$this->load->view('_layout_login', $this->data);
    }
}