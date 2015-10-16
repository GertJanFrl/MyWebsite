<?php

class Page extends Frontend_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('page_m');
        $this->load->model('portfolio_m');
        $this->load->model('zoeken_m');
        $this->load->model('system_m');
        $this->load->library('session');
        // $this->output->cache(10);
    }

    public function index() {
        if(isset($_GET['q']) && !empty($_GET['q']))
            redirect(base_url() . 'zoeken/' . strtolower($_GET['q']));

        // Fetch the page template 
        $this->data['page'] = ($this->uri->segment(1) == 'zoeken' ? 'zoeken' : $this->page_m->get_by(array('url' => (string) $this->uri->segment(1)), TRUE));
    	if(count($this->data['page']) > 0) {

            if($this->data['page'] == 'zoeken') {
                if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['q']))
                    redirect(base_url() . 'zoeken/' . $_POST['q'] . '/', 'refresh');

                $this->data['page'] = new stdClass;
                $this->data['subview'] = new stdClass;

                $this->data['subview'] = 'zoeken';

                $this->data['page']->title = 'Zoekresultaten';
                $this->data['page']->body = 'U dient een zoekterm op te geven.';

                add_meta_title((!empty($this->data['page']->meta_title) ? $this->data['page']->meta_title : $this->data['page']->title), $this->data['subview']);
                add_meta_description((!empty($this->data['page']->meta_description) ? $this->data['page']->meta_description : substr(strip_tags($this->data['page']->body), 0, 160)));

                $this->data['page']->url = '';
            } else {
                $this->data['subview'] = ($this->data['page']->url == '' ? 'home' : $this->data['page']->url);

                add_meta_title((!empty($this->data['page']->meta_title) ? $this->data['page']->meta_title : $this->data['page']->title), $this->data['subview']);
                add_meta_description((!empty($this->data['page']->meta_description) ? $this->data['page']->meta_description : substr(strip_tags($this->data['page']->body), 0, 160)));
            }

            ($this->data['page']->url == '' ? $this->data['portfolio'] = $this->portfolio_m->getLast(4) : '');

            $this->data['page']->templatepath = $_SERVER['DOCUMENT_ROOT'] . '/application/frontend/views/templates/' . $this->data['subview'] . '.php';
            if (!file_exists($this->data['page']->templatepath)) {
                $this->data['subview'] = 'page';
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if($this->uri->segment(1) == 'contact') {
                    if(empty($_POST['contactNaam'])) {
                        $this->data['post_return'] = 'U bent u naam vergeten in te vullen.';
                    }

                    if(empty($_POST['contactEmailadres']) || !filter_var($_POST['contactEmailadres'], FILTER_VALIDATE_EMAIL)) {
                        $this->data['post_return'] = 'Uw e-mailadres is incorrect.';
                    }

                    if(empty($_POST['contactMessage'])) {
                        $this->data['post_return'] = 'Vul alstublieft een vraag of opmerking in.';
                    }

                    $request = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Le6NwATAAAAACLcTXddagowsCv37FpRKL6x9KLU&response=" . $_POST['g-recaptcha-response'] . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
                    if(strstr($request, "false")) {
                        $this->data['post_return'] = 'Uw recaptcha klopt niet, probeer het opnieuw alstublieft.';
                    }

                    if(!isset($this->data['post_return']) || empty($this->data['post_return'])) {
                        $from['name'] = $this->system_m->get_value('web_title')[0]['value'];
                        $from['email'] = $this->system_m->get_value('contact_email')[0]['value'];

                        $smtp['server'] = $this->system_m->get_value('smtp_server')[0]['value'];
                        $smtp['port'] = $this->system_m->get_value('smtp_port')[0]['value'];
                        $smtp['email'] = $this->system_m->get_value('smtp_email')[0]['value'];
                        $smtp['password'] = $this->system_m->get_value('smtp_password')[0]['value'];

                        $content  = '<p>';
                        $content .= '   <b>Naam:</b><br />';
                        $content .=     $_POST['contactNaam'] . '<br /><br />';
                        $content .= '   <b>E-mailadres:</b><br />';
                        $content .=     $_POST['contactEmailadres'] . '<br /><br />';
                        $content .= (!empty($_POST['contactTelefoon']) ? '  <b>Telefoonnummer:</b><br /> ' . $_POST['contactTelefoon'] . '<br /><br />' : '');
                        $content .= '   <b>Bericht:</b><br />';
                        $content .=     nl2br($_POST['contactMessage']);
                        $content .= '</p>';

                        $this->data['postdata'] = sendMail($from, (!empty($_POST['contactSubject']) ? $_POST['contactSubject'] : 'Contact formulier op ' . $_SERVER['HTTP_HOST']), $content, $smtp);
                        if($this->data['postdata'] == 'true') {
                            $this->session->set_flashdata('success', 'success');
                            redirect(base_url() . $this->uri->segment(1));
                        } else {
                            $this->data['post_return'] = 'Door een technische storing is uw email niet verzonden, probeer het over een aantal minuten opnieuw alstublieft.';
                        }
                    }
                }
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

    public function subpage() {
        // Fetch the page template 
        $this->data['page'] = ($this->uri->segment(1) == 'zoeken' ? 'zoeken' : $this->page_m->get_by(array('url' => (string) $this->uri->segment(2)), TRUE, TRUE));
        // print_r($this->uri->segment(2));
        // die();
        if(count($this->data['page']) > 0) {

            if($this->data['page'] == 'zoeken') {
                $this->data['page'] = new stdClass;
                $this->data['subview'] = new stdClass;

                $this->data['subview'] = 'zoeken';

                $this->data['articles'] = $this->zoeken_m->getArticles($this->uri->segment(2));
                $this->data['pages'] = $this->zoeken_m->getPages($this->uri->segment(2));
                $this->data['pages_sub'] = $this->zoeken_m->getPagesSub($this->uri->segment(2));
                $this->data['portfolio'] = $this->zoeken_m->getPortfolio($this->uri->segment(2));

                $this->data['results'] = $this->zoeken_m->totalResults();

                $this->data['page']->title = 'Zoekresultaten';
                $this->data['page']->body = '<p>Wij hebben ' . $this->data['results'] . ' resultaten gevonden voor: <strong>' . $this->uri->segment(2) . '</strong>.</p><p>Hopelijk staat de pagina die u zocht hieronder, indien uw pagina hier niet bij staat kunt u opnieuw zoeken naar de gewenste pagina.</p>';

                add_meta_title($this->uri->segment(2) . ' leverde ' . $this->data['results'] . ' zoekresultaten op', $this->data['subview']);
                add_meta_description(substr(strip_tags($this->data['page']->body), 0, 160));
            } else {
                $this->data['subview'] = ($this->data['page']->url == '' ? 'home' : $this->data['page']->url);

                add_meta_title((!empty($this->data['page']->meta_title) ? $this->data['page']->meta_title : $this->data['page']->title), $this->data['subview']);
                add_meta_description((!empty($this->data['page']->meta_description) ? $this->data['page']->meta_description : substr(strip_tags($this->data['page']->body), 0, 160)));
            }

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

    public function error() {
        $this->output->set_status_header('404');
        // if($this->uri->segment(1) != '404')
        //     redirect('404');

        add_meta_title('Pagina niet gevonden', '');
        add_meta_description('Pagina niet gevonden');
        
        $this->data['subview'] = 'error/404';
        $this->load->view('_main_layout', $this->data);
    }

    public function sitemap() {
        $this->data['page'] = $this->page_m->get_by(array('url' => (string) $this->uri->segment(1)), TRUE);

        if(count($this->data['page']) > 0) {
            $this->data['subview'] = ($this->data['page']->url == '' ? 'home' : $this->data['page']->url);

            add_meta_title((!empty($this->data['page']->meta_title) ? $this->data['page']->meta_title : $this->data['page']->title), $this->data['subview']);
            add_meta_description((!empty($this->data['page']->meta_description) ? $this->data['page']->meta_description : substr(strip_tags($this->data['page']->body), 0, 160)));

            $this->data['pages'] = $this->page_m->get_with_parent();
            $this->data['pages_sub'] = $this->page_m->pageChilderen();

            $this->data['portfolio'] = $this->portfolio_m->getAll(0, 0);

            $this->data['subview'] = 'sitemap';
            $this->load->view('_main_layout', $this->data);
        } else {
            $this->output->set_status_header('404');

            add_meta_title('Pagina niet gevonden', '');
            add_meta_description('Pagina niet gevonden');
            
            $this->data['subview'] = 'error/404';
            $this->load->view('_main_layout', $this->data);
        }
    }

    public function sitemap_xml() {
        $this->data['pages'] = $this->page_m->get_with_parent();
        $this->data['pages_sub'] = $this->page_m->pageChilderen();

        $this->data['portfolio'] = $this->portfolio_m->getAll(0, 0);
        // $this->data['portfolio']->images = $this->portfolio_m->getImages($this->data['item']->id);

        $this->data['subview'] = 'sitemap_xml';
        $this->load->view('_main_extra', $this->data);
    }

    public function robots() {
        $this->data['subview'] = 'robots';
        $this->load->view('_main_extra', $this->data);
    }
}