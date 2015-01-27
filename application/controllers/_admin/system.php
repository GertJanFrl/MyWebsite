<?php
class System extends Admin_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('system_m');
        $this->data['currentpage'] = 'system';
        $this->data['pagetitle'] = 'Voorkeuren';
    }

    public function index($status = NULL) {
        if($this->session->userdata('rights') >= 3) {
            $this->data['currentsubpage'] = 'general';
            // Status if saved and updated
            if(isset($status)) {
                $this->data['status'] = 'success';
            }

            // Data into variables
            $this->data['system']['web_title']                      = $this->system_m->get_value('web_title')[0]['value'];
            $this->data['system']['social_facebook']                = $this->system_m->get_value('social_facebook')[0]['value'];
            $this->data['system']['social_twitter']                 = $this->system_m->get_value('social_twitter')[0]['value'];
            $this->data['system']['social_googleplus']              = $this->system_m->get_value('social_googleplus')[0]['value'];
            $this->data['system']['social_linkedin']                = $this->system_m->get_value('social_linkedin')[0]['value'];
            $this->data['system']['contact_address']                = $this->system_m->get_value('contact_address')[0]['value'];
            $this->data['system']['contact_postcode']               = $this->system_m->get_value('contact_postcode')[0]['value'];
            $this->data['system']['contact_phone']                  = $this->system_m->get_value('contact_phone')[0]['value'];
            $this->data['system']['contact_email']                  = $this->system_m->get_value('contact_email')[0]['value'];
            $this->data['system']['smtp_server']                    = $this->system_m->get_value('smtp_server')[0]['value'];
            $this->data['system']['smtp_port']                      = $this->system_m->get_value('smtp_port')[0]['value'];
            $this->data['system']['smtp_email']                     = $this->system_m->get_value('smtp_email')[0]['value'];
            $this->data['system']['smtp_password']                  = $this->system_m->get_value('smtp_password')[0]['value'];
            $this->data['system']['supportwidget_openingstijden']   = $this->system_m->get_value('supportwidget_openingstijden')[0]['value'];
            $this->data['system']['supportwidget_phone']            = $this->system_m->get_value('supportwidget_phone')[0]['value'];
            $this->data['system']['supportwidget_email']            = $this->system_m->get_value('supportwidget_email')[0]['value'];
            $this->data['system']['supportwidget_website']          = $this->system_m->get_value('supportwidget_website')[0]['value'];
            
            // Set form rules
            $this->form_validation->set_rules('web_title',          'Website naam',     'required');
            $this->form_validation->set_rules('contact_email',      'E-mailadres',      'required');
            $this->form_validation->set_rules('smtp_server',        'SMTP-server',      'required');
            $this->form_validation->set_rules('smtp_port',          'SMTP-server port', 'required');
            $this->form_validation->set_rules('smtp_email',         'E-mailadres',      'required');

            // Process the form
            if ($this->form_validation->run() == TRUE) {
                $this->system_m->update_value_system($_POST['web_title']);
                $this->system_m->update_value_social($_POST['social_facebook'], $_POST['social_twitter'], $_POST['social_googleplus'], $_POST['social_linkedin']);
                $this->system_m->update_value_contact($_POST['contact_address'], $_POST['contact_postcode'], $_POST['contact_phone'], $_POST['contact_email']);
                $this->system_m->update_value_smtp($_POST['smtp_server'], $_POST['smtp_port'], $_POST['smtp_email'], $_POST['smtp_password']);
                $this->system_m->update_value_supportwidget($_POST['supportwidget_openingstijden'], $_POST['supportwidget_phone'], $_POST['supportwidget_email'], $_POST['supportwidget_website']);
                redirect('_admin/system/index/success');
            }
        	
            // Load the page view
            $this->data['subview'] = '_admin/system/index';
        } else {
            $this->data['pagetitle'] = 'Geen toegang';
        	$this->data['subview'] = '_admin/components/rights';
        }
    	$this->load->view('_admin/_layout_main', $this->data);
    }

    public function modules($status = NULL) {
        if($this->session->userdata('rights') >= 3) {
            $this->data['currentsubpage'] = 'modules';
            if(isset($status)) {
                $this->data['status'] = 'success';
            }

            $this->data['article_checked'] = (in_multiarray('article', $this->data['modules_enabled']) ? 'TRUE' : '');
            $this->data['page_checked'] = (in_multiarray('page', $this->data['modules_enabled']) ? 'TRUE' : '');
            $this->data['media_checked'] = (in_multiarray('media', $this->data['modules_enabled']) ? 'TRUE' : '');
            $this->data['slideshow_checked'] = (in_multiarray('slideshow', $this->data['modules_enabled']) ? 'TRUE' : '');
            $this->data['portfolio_checked'] = (in_multiarray('portfolio', $this->data['modules_enabled']) ? 'TRUE' : '');
            
            $this->data['modules'] = array( 'article' => array('Blog', $this->data['article_checked'])
                                            , 'page' => array('Pagina\'s', $this->data['page_checked'])
                                            // , 'media' => array('Media bibliotheek', $this->data['media_checked'])
                                            , 'slideshow' => array('Slideshow', $this->data['slideshow_checked'])
                                            , 'portfolio' => array('Portfolio', $this->data['portfolio_checked'])
                                           );

            foreach ($this->data['modules'] as $key => $empty) {
                if($this->input->post($key)) {
                   $this->form_validation->set_rules($key . '[]', $key, 'required');
                }
            }

            if ($this->form_validation->run() == TRUE) {
                foreach ($this->data['modules'] as $key => $empty) {
                    $this->system_m->update_modules($key, (!isset($_POST[$key]) ? '0' : '1'));
                }
                redirect('_admin/system/modules/success/');
            }

            // Load the page view
            $this->data['subview'] = '_admin/system/modules';
        } else {
            $this->data['pagetitle'] = 'Geen toegang';
            $this->data['subview'] = '_admin/components/rights';
        }
        $this->load->view('_admin/_layout_main', $this->data);
    }
}