<?php
class System_M extends MY_Model {
	protected $_table_name = 'gl_system';
	protected $_table_name_modules = 'gl_system_modules';

	function __construct () {
		parent::__construct();
	}

	public function get_value($key) {
		return $this->db->select('value')->get_where($this->_table_name, array('key' => $key))->result_array();
	}

	public function update_value_system($web_title) {
        $this->db->update($this->_table_name, array('value' 		=> $web_title), 		"`key` = 'web_title'");
		return true;
	}
	public function update_value_social($social_facebook, $social_twitter, $social_googleplus, $social_linkedin) {
        $this->db->update($this->_table_name, array('value' 		=> $social_facebook), 	"`key` = 'social_facebook'");
        $this->db->update($this->_table_name, array('value' 		=> $social_twitter), 	"`key` = 'social_twitter'");
        $this->db->update($this->_table_name, array('value' 		=> $social_googleplus), "`key` = 'social_googleplus'");
        $this->db->update($this->_table_name, array('value' 		=> $social_linkedin), 	"`key` = 'social_linkedin'");
		return true;
	}
	public function update_value_contact($contact_address, $contact_postcode, $contact_phone, $contact_email) {
        $this->db->update($this->_table_name, array('value' 		=> $contact_address), 	"`key` = 'contact_address'");
        $this->db->update($this->_table_name, array('value' 		=> $contact_postcode), 	"`key` = 'contact_postcode'");
        $this->db->update($this->_table_name, array('value' 		=> $contact_phone), 	"`key` = 'contact_phone'");
        $this->db->update($this->_table_name, array('value' 		=> $contact_email), 	"`key` = 'contact_email'");
		return true;
	}
	public function update_value_smtp($smtp_server, $smtp_port, $smtp_email, $smtp_password) {
        $this->db->update($this->_table_name, array('value' 		=> $smtp_server), 		"`key` = 'smtp_server'");
        $this->db->update($this->_table_name, array('value' 		=> $smtp_port), 		"`key` = 'smtp_port'");
        $this->db->update($this->_table_name, array('value' 		=> $smtp_email), 		"`key` = 'smtp_email'");
        $this->db->update($this->_table_name, array('value' 		=> $smtp_password), 	"`key` = 'smtp_password'");
		return true;
	}
	public function update_value_supportwidget($openingstijden, $phone, $email, $website) {
        $this->db->update($this->_table_name, array('value' 		=> $openingstijden), 	"`key` = 'supportwidget_openingstijden'");
        $this->db->update($this->_table_name, array('value' 		=> $phone), 			"`key` = 'supportwidget_phone'");
        $this->db->update($this->_table_name, array('value' 		=> $email), 			"`key` = 'supportwidget_email'");
        $this->db->update($this->_table_name, array('value' 		=> $website), 			"`key` = 'supportwidget_website'");
		return true;
	}

	public function update_modules($name, $status) {
        $this->db->update($this->_table_name_modules, array('status' => $status), "`name` = '" . $name . "'");
        return true;
	}
}