<?php
class System_M extends MY_Model {
	protected $_table_name = 'gl_system';
	protected $_table_name_modules = 'gl_system_modules';

	function __construct ()
	{
		parent::__construct();
	}

	public function web_url() {
		return $this->data['website'] = str_replace('_admin/', '', base_url());
	}

	public function get_value($key)
	{
		return $this->db->select('value')->get_where($this->_table_name, array('key' => $key))->result_array();
	}

	public function update_value_system($web_title, $web_title_slogan)
	{
		$this->db->update($this->_table_name, array('value' 		=> $web_title), 		"`key` = 'web_title'");
		$this->db->update($this->_table_name, array('value' 		=> $web_title_slogan), 	"`key` = 'web_title_slogan'");
		return true;
	}
	public function update_value_social($social_facebook, $social_twitter, $social_googleplus, $social_linkedin) {

        $this->db->update($this->_table_name, array('value' 		=> $social_facebook), 	"`key` = 'social_facebook'");
        $this->db->update($this->_table_name, array('value' 		=> $social_twitter), 	"`key` = 'social_twitter'");
        $this->db->update($this->_table_name, array('value' 		=> $social_googleplus), "`key` = 'social_googleplus'");
        $this->db->update($this->_table_name, array('value' 		=> $social_linkedin), 	"`key` = 'social_linkedin'");
		return true;
	}
	public function update_value_contact($contact_address, $contact_postcode, $contact_phone, $contact_email)
	{
        $this->db->update($this->_table_name, array('value' 		=> $contact_address), 	"`key` = 'contact_address'");
        $this->db->update($this->_table_name, array('value' 		=> $contact_postcode), 	"`key` = 'contact_postcode'");
        $this->db->update($this->_table_name, array('value' 		=> $contact_phone), 	"`key` = 'contact_phone'");
        $this->db->update($this->_table_name, array('value' 		=> $contact_email), 	"`key` = 'contact_email'");
		return true;
	}
	public function update_value_smtp($smtp_server, $smtp_port, $smtp_email, $smtp_password)
	{
        $this->db->update($this->_table_name, array('value' 		=> $smtp_server), 		"`key` = 'smtp_server'");
        $this->db->update($this->_table_name, array('value' 		=> $smtp_port), 		"`key` = 'smtp_port'");
        $this->db->update($this->_table_name, array('value' 		=> $smtp_email), 		"`key` = 'smtp_email'");
        $this->db->update($this->_table_name, array('value' 		=> $smtp_password), 	"`key` = 'smtp_password'");
		return true;
	}
	public function update_value_supportwidget($openingstijden, $phone, $email, $website)
	{
        $this->db->update($this->_table_name, array('value' 		=> $openingstijden), 	"`key` = 'supportwidget_openingstijden'");
        $this->db->update($this->_table_name, array('value' 		=> $phone), 			"`key` = 'supportwidget_phone'");
        $this->db->update($this->_table_name, array('value' 		=> $email), 			"`key` = 'supportwidget_email'");
        $this->db->update($this->_table_name, array('value' 		=> $website), 			"`key` = 'supportwidget_website'");
		return true;
	}

	public function update_modules($name, $status)
	{
		if ($name == 'article')
			$this->db->truncate($this->_table_name_modules);

//		print_r($this->db->update($this->_table_name_modules, array('status' => $status), "`name` = '" . $name . "'"));
//
//		print_r($this->db->affected_rows());
//
//		if ($this->db->affected_rows() > 0) {
			$this->db->insert($this->_table_name_modules, array('name' => $name, 'status' => $status));
//		}
//
//		print_r($this->db->affected_rows());
//		echo '<pre>';
//		echo $this->db->last_query();
//		echo '</pre>';
//		die();
//
//		die();

        return true;
	}

	public function log_event($action, $action_id, $action_event)
	{
		$data = array(
			'user_id' => $this->session->userdata('id')
			, 'action' => $action
			, 'action_id' => $action_id
			, 'action_event' => $action_event
			, 'timestamp' => date('Y-m-d H:i:s')
			, 'ip' => $_SERVER['REMOTE_ADDR']
		);
		$this->db->insert('gl_system_logs', $data);
		return true;
	}

	public function get_logs($action)
	{
		$this->db->limit(25);
		return $this->db->order_by('timestamp', 'DESC')->get_where('gl_system_logs', array('action' => $action))->result();
	}

	public function parse_log_event($event)
	{
		switch ($event)
		{
			case 'edit':
				$return = 'Wijzigingen';
				break;

			case 'add':
				$return = 'Toegevoegd';
				break;

			case 'trash':
				$return = 'Prullenbak';
				break;

			case 'delete':
				$return = 'Verwijderd';
				break;

			case 'restore':
				$return = 'Hersteld';
				break;

			case 'login':
				$return = 'Ingelogd';
				break;

			case 'logout':
				$return = 'Uitgelogd';
				break;

			default:
				$return = '';
				break;
		}
		return $return;
	}

	public function parse_log_id($action, $id)
	{
		switch ($action)
		{
			case 'system':
				switch ($id)
				{
					case '0':
						$return = 'Instellingen';
						break;

					case '1':
						$return = 'Modules';
						break;
				}
				break;

			case 'article':
				$select = $this->db->select('title, id')->get_where('gl_articles', array('id' => $id))->result_array();
				$return = (!empty($select) ? '<a href="/_admin/article/edit/' . $select[0]['id'] . '" title="' . $select[0]['title'] . '"">' . $select[0]['title'] . '</a>' : 'Blog niet gevonden');
				break;

			case 'page':
				$select = $this->db->select('title, id')->get_where('gl_pages', array('id' => $id))->result_array();
				$return = (!empty($select) ? '<a href="/_admin/page/edit/' . $select[0]['id'] . '" title="' . $select[0]['title'] . '"">' . $select[0]['title'] . '</a>' : 'Pagina niet gevonden');
				break;


			case 'portfolio':
				$select = $this->db->select('title, id')->get_where('gl_portfolio', array('id' => $id))->result_array();
				$return = (!empty($select) ? '<a href="/_admin/portfolio/edit/' . $select[0]['id'] . '" title="' . $select[0]['title'] . '"">' . $select[0]['title'] . '</a>' : 'Item niet gevonden');
				break;

			case 'user':
				$select = $this->db->select('id, name')->get_where('gl_users', array('id' => $id))->result_array();
				$return = (!empty($select) ? '<a href="/_admin/user/edit/' . $select[0]['id'] . '" title="' . $select[0]['name'] . '"">' . $select[0]['name'] . '</a>' : 'Gebruiker niet gevonden');
				break;

			default:
				$return = '';
				break;
		}
		return $return;
	}
}