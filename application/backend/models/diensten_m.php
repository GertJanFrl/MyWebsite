<?php
class Diensten_m extends MY_Model {
    protected $_table_name = 'gl_domain_tld';
	protected $_table_name_sub = 'gl_hosting';
	protected $_order_by = 'id DESC';
    public $rules_domain = array(
        'tld' => array(
            'field' => 'tld', 
            'label' => 'TLD', 
            'rules' => 'trim|required|max_length[100]'
        )
    );
    public $rules_hosting = array(
        'title' => array(
            'field' => 'title', 
            'label' => 'Titel', 
            'rules' => 'trim|required|max_length[100]'
        )
    );

    public function get_new () {
        $item = new stdClass();
        $item->tld = '';
        $item->price = '500';
        $item->price_renewal = '1000';
        $item->registration_length = '1';
        $item->popular = '0';
        return $item;
    }

    public function get_new_hosting () {
        $item = new stdClass();
        $item->title = '';
        $item->body = '';
        $item->price = '';
        $item->type = 'web';
        return $item;
    }

	public function delete ($id) {
		$this->db->delete($this->_table_name, array('id' => $id));
	}

	public function get_trash ($id = NULL, $single = FALSE) {
		$this->db->where('active', '0');
		return parent::get($id, $single);
	}

	public function save_thumbnail($thumbnail, $id) {
        $this->db->update($this->_table_name, array('thumbnail' => $thumbnail), "`id` = '" . $id . "'");
	}

    public function getDomainTld() {
        return $this->db->get('gl_domain_tld')->result_array();
    }

    public function getHostingPacket($type) {
        $this->db->where('type', $type);
        return $this->db->get('gl_hosting')->result_array();
    }

    public function getHostingSingle($id) {
        $this->db->where('id', $id);
        return $this->db->get('gl_hosting')->row();
    }
}