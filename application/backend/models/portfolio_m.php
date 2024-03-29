<?php
class Portfolio_m extends MY_Model {
	protected $_table_name = 'gl_portfolio';
	protected $_table_name_sub = 'gl_portfolio_categories';
	protected $_table_name_gallery = 'gl_portfolio_images';
	protected $_order_by = 'id DESC';
	public $rules = array(
		'title' => array(
			'field' => 'title', 
			'label' => 'Title', 
			'rules' => 'trim|required|max_length[100]'
		), 
		'body' => array(
			'field' => 'body', 
			'label' => 'Body', 
			'rules' => 'trim'
		)
	);

	public function get_new () {
		$item = new stdClass();
		$item->title = '';
		$item->url = '';
		$item->body = '';
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

	public function getCategories() {
		return $this->db->select(array('id', 'title'))->get($this->_table_name_sub)->result_array();
	}

	public function getImages ($id = NULL) {
		return $this->db->get_where($this->_table_name_gallery, array('id_portfolio' => $id))->result_array();
	}
}