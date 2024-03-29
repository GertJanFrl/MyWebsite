<?php
class User extends Admin_Controller {

	public function __construct () {
		parent::__construct();
	}

	public function index () {
        if($this->session->userdata('rights') >= 2) {
			$this->data['users'] = $this->user_m->get();
			
			$this->data['subview'] = 'user/index';
		} else {
            $this->data['pagetitle'] = 'Geen toegang';
            $this->data['subview'] = 'components/rights';
        }
		$this->load->view('_layout_main', $this->data);
	}

	public function edit ($id = NULL) {
        if($this->session->userdata('rights') >= 2) {
			if ($id) {
				$this->data['user'] = $this->user_m->get($id);
				count($this->data['user']) || $this->data['errors'][] = 'Gebruiker niet gevonden';
			}
			else {
				$this->data['user'] = $this->user_m->get_new();
			}
			
			// Set up the form
	        $this->form_validation->set_rules('name', 'Naam', 'trim|required');
	        $this->form_validation->set_rules('email', 'E-mailadres', 'trim|required|valid_email');
	        $this->form_validation->set_rules('tel', 'Telefoonnummer', 'trim|required');
	        $this->form_validation->set_rules('password', 'Wachtwoord', 'trim');
			
			// Process the form
			if ($this->form_validation->run() == TRUE) {
				if($this->session->userdata('id') == $id)
				{
					if(!empty($_POST['password']))
					{
						$data = $this->user_m->array_from_post(array('name', 'email', 'tel', 'password'));
						$data['password'] = $this->user_m->hash($data['password']);
					}
					else
					{
						$data = $this->user_m->array_from_post(array('name', 'email', 'tel'));
					}
				}
				else if(!empty($_POST['password']))
				{
					$data = $this->user_m->array_from_post(array('name', 'email', 'tel', 'password', 'rights'));
					$data['password'] = $this->user_m->hash($data['password']);
				}
				else
				{
					$data = $this->user_m->array_from_post(array('name', 'email', 'tel', 'rights'));
				}
				$save = $this->user_m->saveUser($data, $id);
                $this->session->set_flashdata('success', 'success');

				if ($id)
					$this->system_m->log_event('user', $id, 'edit');
				else
					$this->system_m->log_event('user', $save, 'add');

				redirect('user');
			}
			
			// Load the view
			$this->data['subview'] = 'user/edit';
		} else {
            $this->data['pagetitle'] = 'Geen toegang';
            $this->data['subview'] = 'components/rights';
        }
		$this->load->view('_layout_main', $this->data);
	}

	public function delete ($id) {
        if($this->session->userdata('rights') >= 2) {
			$this->user_m->delete($id);
			$this->system_m->log_event('user', $id, 'delete');
			redirect('user');
		} else {
            $this->data['pagetitle'] = 'Geen toegang';
            $this->data['subview'] = 'components/rights';
			$this->load->view('_layout_main', $this->data);
        }
	}

	public function login () {
		// Redirect a user if he's already logged in
		$this->user_m->loggedin() == FALSE || ($this->system_m->log_event('login', 0, 'login') && redirect('dashboard'));
		
		// Set form
		$rules = $this->user_m->rules;
		$this->form_validation->set_rules($rules);
		
		// Process form
		if ($this->form_validation->run() == TRUE) {
			// We can login and redirect
			if ($this->user_m->login() == TRUE) {
				$this->system_m->log_event('login', 0, 'login');
				redirect('dashboard');
			} else {
				$this->session->set_flashdata('error', 'Verkeerde gegevens ingevuld');
				redirect('user/login', 'refresh');
			}
		}
        
		// Load view
		$this->data['subview'] = 'user/login';
		$this->load->view('_layout_login', $this->data);
	}

	public function logout () {
		$this->system_m->log_event('login', 0, 'logout');
		$this->user_m->logout();
		redirect('user/login');
	}

	// public function _unique_email ($str) {
	// 	// Do NOT validate if email already exists
	// 	// UNLESS it's the email for the current user
		
	// 	$id = $this->uri->segment(4);
	// 	$this->db->where('email', $this->input->post('email'));
	// 	!$id || $this->db->where('id !=', $id);
	// 	$user = $this->user_m->get();
		
	// 	if (count($user)) {
	// 		$this->form_validation->set_message('_unique_email', '%s should be unique');
	// 		return FALSE;
	// 	}
		
	// 	return TRUE;
	// }
}