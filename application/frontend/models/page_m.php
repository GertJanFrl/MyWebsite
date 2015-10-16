<?php
class Page_m extends MY_Model {
    protected $_table_name = 'gl_pages';
    protected $_table_name_sub = 'gl_pages_sub';
    protected $_order_by = 'sort ASC';
	public $rules = array(
		'parent_id' => array(
			'field' => 'parent_id', 
			'label' => 'Parent', 
			'rules' => 'trim|intval'
		), 
		'template' => array(
			'field' => 'template', 
			'label' => 'Template', 
			'rules' => 'trim|required|xss_clean'
		), 
		'title' => array(
			'field' => 'title', 
			'label' => 'Title', 
			'rules' => 'trim|required|max_length[100]|xss_clean'
		), 
		'body' => array(
			'field' => 'body', 
			'label' => 'Body', 
			'rules' => 'trim|required'
		)
	);

	public function get_new ()
	{
		$page = new stdClass();
        $page->title = '';
		$page->url = '';
        $page->body = '';
		$page->body_sidebar = '';
		$page->parent_id = 0;
		$page->template = 'page';
		return $page;
	}

	public function get_archive_link(){
		$page = parent::get_by(array('url' => 'archive'), TRUE);
		return isset($page->url) ? $page->url : '';
	}

	public function get_nested ()
	{
		$this->db->order_by($this->_order_by);
		$pages = $this->db->get('gl_pages')->result_array();
		
		$array = array();
		foreach ($pages as $page) {
			// if (! $page['parent_id']) {
				// This page has no parent
				$array[$page['id']] = $page;
			// }
			// else {
				// This is a child page
				// $array[$page['parent_id']]['children'][] = $page;
			// }
		}
        // print_r($array);
		return $array;
	}

    public function get_with_parent ($id = NULL, $single = FALSE) {
        $this->db->where('active', '1');
        return parent::get($id, $single);
    }

    function pageChilderen() {
        return $this->db->get_where($this->_table_name_sub, array('active' => '1'))->result();
    }

	public function get_no_parents ()
	{
		// Fetch pages without parents
		$this->db->select('id, title');
		$this->db->where('parent_id', 0);
		$pages = parent::get();
		
		// Return key => value pair array
		$array = array(
			0 => 'No parent'
		);
		if (count($pages)) {
			foreach ($pages as $page) {
				$array[$page->id] = $page->title;
			}
		}
		
		return $array;
	}
}