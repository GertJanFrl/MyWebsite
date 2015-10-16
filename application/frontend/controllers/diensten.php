<?php

class Diensten extends Frontend_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('diensten_m');
        $this->load->model('page_m');
        $this->load->library('pagination');
        require_once $_SERVER['DOCUMENT_ROOT'] . '/system/transip/DomainService.php';
        // $this->output->cache(10);
    }

    public function index() {
        // Fetch the page template 
        $this->data['page'] = $this->page_m->get_by(array('url' => (string) $this->uri->segment(1)), TRUE);
        if(count($this->data['page']) > 0) {

            $this->data['subview'] = 'diensten/index';

            add_meta_title((!empty($this->data['page']->meta_title) ? $this->data['page']->meta_title : $this->data['page']->title), $this->data['subview']);
            add_meta_description((!empty($this->data['page']->meta_description) ? $this->data['page']->meta_description : substr(strip_tags($this->data['page']->body), 0, 160)));

            ($this->data['page']->url == '' ? $this->data['portfolio'] = $this->portfolio_m->getLast(4) : '');

            $this->data['page']->templatepath = $_SERVER['DOCUMENT_ROOT'] . '/application/frontend/views/templates/' . $this->data['subview'] . '.php';
            if (!file_exists($this->data['page']->templatepath)) {
                $this->data['subview'] = 'page';
            }

            $this->data['diensten'] = $this->diensten_m->getSubPages();

            $this->load->view('_main_layout', $this->data);
        } else {
            $this->output->set_status_header('404');

            add_meta_title('Pagina niet gevonden', '');
            add_meta_description('Pagina niet gevonden');
            
            $this->data['subview'] = 'error/404';
            $this->load->view('_main_layout', $this->data);
        }
    }

    public function domeinnaam() {
        // Fetch the page template 
        $this->data['page'] = $this->page_m->get_by(array('url' => (string) $this->uri->segment(2)), TRUE, TRUE);
        if(count($this->data['page']) > 0) {

            $this->data['subview'] = 'diensten/domeinnaam';

            add_meta_title((!empty($this->data['page']->meta_title) ? $this->data['page']->meta_title : $this->data['page']->title), $this->data['subview']);
            add_meta_description((!empty($this->data['page']->meta_description) ? $this->data['page']->meta_description : substr(strip_tags($this->data['page']->body), 0, 160)));

            // $this->data['domeinen'] = Transip_DomainService::getAllTldInfos();
            // $this->data['domeinen'] = $this->diensten_m->getDomainTld();


            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $config                         = array();
            $config['cur_page']             = $page;
            $config['base_url']             = '/diensten/domeinnaam';
            $config['total_rows']           = $this->diensten_m->getAllCount();
            $config['per_page']             = 12;
            $config['uri_segment']          = 3;
            $config['display_pages']        = TRUE;

            $config['full_tag_open']        = '<nav class="row"><div class="col-md-12"><ul class="pagination">';
            $config['full_tag_close']       = '</ul></div></nav>';
            $config['prev_tag_open']        = '<li>';
            $config['prev_link']            = ' <span aria-hidden="true">&laquo;</span>';
            $config['prev_tag_close']       = '</li>';
            $config['next_tag_open']        = '<li>';
            $config['next_link']            = ' <span aria-hidden="true">&raquo;</span>';
            $config['next_tag_close']       = '</li>';
            $config['cur_tag_open']         = '<li class="active"><a href="#">';
            $config['cur_tag_close']        = ' <span class="sr-only">(current)</span></a></li>';
            $config['num_tag_open']         = '<li>';
            $config['num_tag_close']        = '</li>';
            $config['first_url']            = '/diensten/domeinnaam/0';
            
            $this->pagination->initialize($config);

            $this->data['domeinen'] = $this->diensten_m->getDomainTld($config['per_page'], $page);
            $this->data['links'] = str_replace('&amp;per_page=', '/', $this->pagination->create_links());

            $this->data['domeinen_popular'] = $this->diensten_m->getDomainTldPopular();

            $this->data['page']->templatepath = $_SERVER['DOCUMENT_ROOT'] . '/application/frontend/views/templates/' . $this->data['subview'] . '.php';
            if (!file_exists($this->data['page']->templatepath)) {
                $this->data['subview'] = 'page';
            }
            $this->load->view('_main_layout', $this->data);
        } else {
            $this->output->set_status_header('404');

            add_meta_title('Pagina niet gevonden', '');
            add_meta_description('Pagina niet gevonden');
            
            $this->data['subview'] = 'error/404';
            $this->load->view('_main_layout', $this->data);
        }
    }
}