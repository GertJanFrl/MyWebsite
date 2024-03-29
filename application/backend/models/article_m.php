<?php
class Article_m extends MY_Model {
	protected $_table_name = 'gl_articles';
	protected $_order_by = 'pubdate desc, id desc';
	protected $_timestamps = TRUE;
	public $rules = array(
		'pubdate' => array(
			'field' => 'pubdate', 
			'label' => 'Publicatie datum', 
			'rules' => 'trim|required'
		), 
		'title' => array(
			'field' => 'title', 
			'label' => 'Titel', 
			'rules' => 'trim|required|max_length[100]'
		)
	);

	public function get_new () {
		$article = new stdClass();
		$article->title = '';
		$article->url = '';
		$article->body = '';
		$article->pubdate = date('Y-m-d H:i');
		return $article;
	}
	
	public function set_published() {
		$this->db->where('pubdate <=', date('Y-m-d H:i'));
	}

	public function get_trash ($id = NULL, $single = FALSE) {
		$this->db->where('active', '0');
		return parent::get($id, $single);
	}

	public function get_active ($id = NULL, $single = FALSE) {
		$this->db->where('active', '1');
		return parent::get($id, $single);
	}
	
	public function get_recent($limit = 3) {
		$limit = (int) $limit;
		$this->set_published();
		$this->db->limit($limit);
		return parent::get();
	}

	public function save_thumbnail($thumbnail, $id) {
        $this->db->update($this->_table_name, array('thumbnail' => $thumbnail), "`id` = '" . $id . "'");
	}
}