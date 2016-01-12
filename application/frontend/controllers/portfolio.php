<?php

class Portfolio extends Frontend_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('portfolio_m');
        $this->load->model('page_m');
        $this->load->library('pagination');
        // $this->output->cache(10);
    }

    public function index() {
        $this->data['page'] = $this->page_m->get_by(array('url' => (string) 'portfolio'), TRUE);
    	if(count($this->data['page']) > 0) {
            $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

            $config                         = array();
            $config['cur_page']             = $page;
            $config['base_url']             = '/portfolio';
            $config['total_rows']           = $this->portfolio_m->GetAllCount();
            $config['num_links']            = $this->portfolio_m->GetAllCount();
            $config['per_page']             = $config['total_rows']; // Bijv. 4 per pagina
            $config['uri_segment']          = 2;
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
            $config['first_url']            = '/portfolio/1';
            
            $this->pagination->initialize($config);

            $this->data['portfolio'] = $this->portfolio_m->getAll($config['per_page'], $page);
            $this->data['links'] = str_replace('&amp;per_page=', '/', $this->pagination->create_links());

            $this->data['subview'] = 'portfolio/index';

            add_meta_title((!empty($this->data['page']->meta_title) ? $this->data['page']->meta_title : $this->data['page']->title), $this->data['subview']);
            add_meta_description((!empty($this->data['page']->meta_description) ? $this->data['page']->meta_description : substr(strip_tags($this->data['page']->body), 0, 160)));

            $this->load->view('_main_layout', $this->data);
        } else {
            $this->output->set_status_header('404');

            // Sidebar nieuwsberichten
            $this->db->limit(5);
            $this->db->order_by('id', 'DESC');
            $this->db->where('active', '1');
            $this->data['articles'] = $this->article_m->get();

            add_meta_title('Pagina niet gevonden', '');
            add_meta_description('Pagina niet gevonden');
            
            $this->data['subview'] = 'error/404';
            $this->load->view('_main_layout', $this->data);
        }
    }

    public function item() {
        $this->data['item'] = $this->portfolio_m->get_by(array('url' => (string) $this->uri->segment(2)), TRUE);
        if(count($this->data['item']) > 0) {
            $this->data['subview'] = 'portfolio/item';

            add_meta_title((!empty($this->data['item']->meta_title) ? $this->data['item']->meta_title : $this->data['item']->title), $this->data['subview']);
            add_meta_description((!empty($this->data['item']->meta_description) ? $this->data['item']->meta_description : substr(strip_tags($this->data['item']->body), 0, 160)));

            $this->data['portfolio'] = $this->portfolio_m->getLast(4, $this->data['item']->id);

            $this->data['item']->images = $this->portfolio_m->getImages($this->data['item']->id);

            $this->data['meta_image'] = 'resize/200x200/uploads/portfolio/' . $this->data['item']->thumbnail;

            $this->load->view('_main_layout', $this->data);
        } else {
            $this->output->set_status_header('404');

            // Sidebar nieuwsberichten
            $this->db->limit(5);
            $this->db->order_by('id', 'DESC');
            $this->db->where('active', '1');
            $this->data['articles'] = $this->article_m->get();

            add_meta_title('Pagina niet gevonden', '');
            add_meta_description('Pagina niet gevonden');
            
            $this->data['subview'] = 'error/404';
            $this->load->view('_main_layout', $this->data);
        }
    }
}