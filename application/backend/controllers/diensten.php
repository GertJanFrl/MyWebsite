<?php
class Diensten extends Admin_Controller
{

	public function __construct () {
		parent::__construct();
		$this->load->model('diensten_m');
		$this->data['currentpage'] = 'diensten';
	}

	public function index () {
		if(in_multiarray('diensten', $this->data['modules_enabled'])) {
			$this->data['currentsubpage'] = 'domein';
			$this->data['pagetitle'] = 'Alle domein TLD\'s';

			// Fetch all pages
			$this->data['domain_tld'] = $this->diensten_m->getDomainTld();
			
			// Load view
			$this->data['subview'] = 'diensten/domein/index';
			$this->load->view('_layout_main', $this->data); 
		} else {
			$this->data['pagetitle'] = 'Module uitgeschakeld';
			$this->data['subview'] = 'components/disabled';
			$this->load->view('_layout_main', $this->data); 
		}
	}

	public function domein_edit ($id = NULL) {
        $this->data['currentsubpage'] = 'domein';

		// Fetch a page or set a new one
		if ($id) {
			$this->data['item'] = $this->diensten_m->get($id, '');
			count($this->data['item']) || $this->data['errors'][] = 'TLD niet gevonden';
			$this->data['pagetitle'] = '.' . $this->data['item']->tld . ' - bewerk TLD';
			if(isset($status)) {
                $this->session->set_flashdata('success', 'success');
			}
		} else {
			$this->data['item'] = $this->diensten_m->get_new();
			$this->data['pagetitle'] = 'Nieuwe TLD';
		}
		
		// Set up the form
		$rules = $this->diensten_m->rules_domain;
		$this->form_validation->set_rules($rules);
		
		// Process the form
		if ($this->form_validation->run() == TRUE) {
			$data = $this->diensten_m->array_from_post(array(
                'tld', 
                'price', 
                'price_renewal', 
                'registration_length', 
				'popular', 
			));
			$id = $this->diensten_m->save($data, $id);

			redirect('diensten/domein/edit/' . $id . '/success');
		}
		
		// Load the view
		$this->data['subview'] = 'diensten/domein/edit';
		$this->load->view('_layout_main', $this->data);
	}
    
    public function hosting_web_index () {
        $this->data['currentsubpage'] = 'hosting_web';
        $this->data['pagetitle'] = 'Alle webhosting pakketten';
        $this->data['pageurl'] = 'web';

        // Fetch all pages
        $this->data['hosting'] = $this->diensten_m->getHostingPacket('web');
        
        // Load view
        $this->data['subview'] = 'diensten/hosting/index';
        $this->load->view('_layout_main', $this->data);
    }
	public function hosting_web_edit ($id = NULL) {
        $this->data['currentsubpage'] = 'hosting_web';
        $this->data['pageurl'] = 'web';

		// Fetch a page or set a new one
		if ($id) {
			$this->data['item'] = $this->diensten_m->getHostingSingle($id, '');
            count($this->data['item']) || $this->data['errors'][] = 'pakket niet gevonden';
            $this->data['pagetitle'] = $this->data['item']->title . ' - bewerk webhosting pakket';
            if(isset($status)) {
                $this->session->set_flashdata('success', 'success');
            }
        } else {
            $this->data['item'] = $this->diensten_m->get_new_hosting();
            $this->data['pagetitle'] = 'Nieuw webhosting pakket';
		}
		
		// Set up the form
        $rules = $this->diensten_m->rules_hosting;
		$this->form_validation->set_rules($rules);
		
		// Process the form
		if ($this->form_validation->run() == TRUE) {
			$data = $this->diensten_m->array_from_post(array(
                'title', 
                'body', 
                'price', 
                'type', 
			));
            $id = $this->diensten_m->save($data, $id, 'hosting');


			redirect('diensten/hosting/web/edit/' . $id . '/success');
		}
		
		// Load the view
		$this->data['subview'] = 'diensten/hosting/edit';
		$this->load->view('_layout_main', $this->data);
	}
    
    public function hosting_reseller_index () {
        $this->data['currentsubpage'] = 'hosting_reseller';
        $this->data['pagetitle'] = 'Alle reseller pakketten';
        $this->data['pageurl'] = 'reseller';

        // Fetch all pages
        $this->data['hosting'] = $this->diensten_m->getHostingPacket('reseller');
        
        // Load view
        $this->data['subview'] = 'diensten/hosting/index';
        $this->load->view('_layout_main', $this->data);
    }
	public function hosting_reseller_edit ($id = NULL) {
        $this->data['currentsubpage'] = 'hosting_reseller';
        $this->data['pageurl'] = 'reseller';

		
        // Fetch a page or set a new one
		if ($id) {
			$this->data['item'] = $this->diensten_m->getHostingSingle($id, '');
            count($this->data['item']) || $this->data['errors'][] = 'pakket niet gevonden';
            $this->data['pagetitle'] = $this->data['item']->title . ' - bewerk reseller pakket';
            if(isset($status)) {
                $this->session->set_flashdata('success', 'success');
            }
        } else {
            $this->data['item'] = $this->diensten_m->get_new_hosting();
            $this->data['pagetitle'] = 'Nieuw reseller pakket';
		}
		
		// Set up the form
		$rules = $this->diensten_m->rules_hosting;
		$this->form_validation->set_rules($rules);
		
		// Process the form
		if ($this->form_validation->run() == TRUE) {
			$data = $this->diensten_m->array_from_post(array(
                'title', 
                'body', 
                'price', 
                'type', 
			));
            $id = $this->diensten_m->save($data, $id, 'hosting');


			redirect('diensten/hosting/reseller/edit/' . $id . '/success');
		}
		
		// Load the view
		$this->data['subview'] = 'diensten/hosting/edit';
		$this->load->view('_layout_main', $this->data);
	}
    
    public function hosting_vps_index () {
        $this->data['currentsubpage'] = 'hosting_vps';
        $this->data['pagetitle'] = 'Alle vps pakketten';
        $this->data['pageurl'] = 'vps';

        // Fetch all pages
        $this->data['hosting'] = $this->diensten_m->getHostingPacket('vps');
        
        // Load view
        $this->data['subview'] = 'diensten/hosting/index';
        $this->load->view('_layout_main', $this->data);
    }
	public function hosting_vps_edit ($id = NULL) {
        $this->data['currentsubpage'] = 'hosting_vps';
        $this->data['pageurl'] = 'vps';

		// Fetch a page or set a new one
		if ($id) {
			$this->data['item'] = $this->diensten_m->getHostingSingle($id, '');
			count($this->data['item']) || $this->data['errors'][] = 'pakket niet gevonden';
            $this->data['pagetitle'] = $this->data['item']->title . ' - bewerk vps pakket';
			if(isset($status)) {
                $this->session->set_flashdata('success', 'success');
			}
		} else {
			$this->data['item'] = $this->diensten_m->get_new_hosting();
			$this->data['pagetitle'] = 'Nieuw VPS pakket';
		}
		
		// Set up the form
        $rules = $this->diensten_m->rules_hosting;
		$this->form_validation->set_rules($rules);
		
		// Process the form
		if ($this->form_validation->run() == TRUE) {
			$data = $this->diensten_m->array_from_post(array(
                'title', 
                'body', 
                'price', 
                'type', 
			));
            $id = $this->diensten_m->save($data, $id, 'hosting');

			redirect('diensten/hosting/vps/edit/' . $id . '/success');
		}
		
		// Load the view
		$this->data['subview'] = 'diensten/hosting/edit';
		$this->load->view('_layout_main', $this->data);
	}
}