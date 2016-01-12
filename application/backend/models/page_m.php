<?php
class Page_m extends MY_Model {
	protected $_table_name = 'gl_pages';
	protected $_table_name_sub = 'gl_pages_sub';
	protected $_order_by = 'sort ASC';
	public $rules = array(
		'id_parent' => array(
			'field' => 'id_parent', 
			'label' => 'Parent', 
			'rules' => 'trim|intval'
		), 
		'title' => array(
			'field' => 'title', 
			'label' => 'Title', 
			'rules' => 'trim|required|max_length[100]'
		), 
		'body' => array(
			'field' => 'body', 
			'label' => 'Body', 
			'rules' => ''
		)
	);

	public function get_new () {
		$page = new stdClass();
		$page->title = '';
		$page->url = '';
		$page->body = '';
		return $page;
	}

	public function delete ($id, $sub = NULL) {
		if($sub) {
			$this->db->delete($this->_table_name_sub, array('id' => $id));
		} else {
			$this->db->delete($this->_table_name, array('id' => $id));
			$this->db->delete($this->_table_name_sub, array('id_parent' => $id));
			// $this->db->set(array('id_parent' => 0))->where('id_parent', $id)->update($this->_table_name_sub);
		}
	}

    public function save_ajax ($order_page) {
        $pages = explode(',', $order_page);
        if (count($pages)) {
            foreach ($pages as $order => $page) {
                $this->db->set('sort', $order)->where('id', $page)->update($this->_table_name);
            }
        }
    }

	public function get_nested () {
		$this->db->order_by($this->_order_by);
		$pages = $this->db->get($this->_table_name)->result_array();
		
		$array = array();
		foreach ($pages as $page) {
			// if (! $page['id_parent']) {
				// This page has no parent
				$array[$page['id']] = $page;
			// }
			// else {
			// 	// This is a child page
			// 	$array[$page['id_parent']]['children'][] = $page;
			// }
		}
		return $array;
	}

	public function get_trash ($id = NULL, $single = FALSE) {
		$this->db->where('active', '0');
		return parent::get($id, $single);
	}

	public function get_with_parent ($id = NULL, $single = FALSE) {
		$this->db->where('active', '1');
		return parent::get($id, $single);
	}

	public function get_no_parents () {
		// Fetch pages without parents
		$this->db->select('id, title');
		// $this->db->where('active', 1);
		$pages = parent::get();
		
		// Return key => value pair array
		$array = array(
			0 => 'Geen bovenliggende pagina'
		);
		if (count($pages)) {
			foreach ($pages as $page) {
				$array[$page->id] = $page->title;
			}
		}
		
		return $array;
	}

	function pageChilderen() {
		return $this->db->get_where($this->_table_name_sub, array('active' => '1'))->result();
	}

	public function save_thumbnail($thumbnail, $id, $sub = '') {
        $this->db->update((!empty($sub) ? $this->_table_name_sub : $this->_table_name), array('thumbnail' => $thumbnail), "`id` = '" . $id . "'");
	}
}