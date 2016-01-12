<?php
class User_M extends MY_Model {
	protected $_table_name = 'gl_users';
	protected $_order_by = 'name';
	public $rules = array(
		'email' => array(
			'field' => 'email', 
			'label' => 'Email', 
			'rules' => 'trim|required|valid_email'
		), 
		'password' => array(
			'field' => 'password', 
			'label' => 'Password', 
			'rules' => 'trim|required'
		)
	);
	public $rules_admin = array(
		'name' => array(
			'field' => 'name', 
			'label' => 'Name', 
			'rules' => 'trim|required'
		), 
		'email' => array(
			'field' => 'email', 
			'label' => 'Email', 
			'rules' => 'trim|required|valid_email|callback__unique_email'
		), 
		'password' => array(
			'field' => 'password', 
			'label' => 'Password', 
			'rules' => 'trim|matches[password_confirm]'
		),
		'password_confirm' => array(
			'field' => 'password_confirm', 
			'label' => 'Confirm password', 
			'rules' => 'trim|matches[password]'
		),
	);

	function __construct () {
		parent::__construct();
	}

	public function login () {
        $password = $this->hash($this->input->post('password'));
		$user = $this->get_by(array(
			'email' => $this->input->post('email'),
			'password' => $password,
		), TRUE);
		
		if (count($user)) {
			// Log in user
			$data = array(
				'name' => $user->name,
				'email' => $user->email,
				'id' => $user->id,
				'loggedin' => TRUE,
				'rights' => $user->rights,
			);
			$this->session->set_userdata($data);
		}
	}

	public function logout () {
		$this->session->sess_destroy();
	}

	public function loggedin () {
		return (bool) $this->session->userdata('loggedin');
	}
	
	public function get_new() {
		$user = new stdClass();
		$user->name = '';
		$user->email = '';
		$user->password = '';
		return $user;
	}

	public function hash ($string = '') {
		return hash('sha512', $string);
	}

	public function get_all_users() {
		return $this->db->select(array('id', 'name'))->get($this->_table_name)->result_array();
	}

	public function get_user($id) {
		return $this->db->select('name')->get_where($this->_table_name, array('id' => $id))->result_array();
	}
}