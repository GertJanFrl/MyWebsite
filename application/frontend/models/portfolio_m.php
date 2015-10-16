<?php
class Portfolio_m extends MY_Model {
    protected $_table_name = 'gl_portfolio';
    protected $_table_name_sub = 'gl_portfolio_images';
    protected $_order_by = 'id DESC';
	public $rules = array(
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

	public function get_new () {
		$page = new stdClass();
        $page->title = '';
		$page->url = '';
        $page->body = '';
		return $page;
	}
 
    public function GetAllCount () {
        $this->db->where('active', '1');
        return $this->db->count_all('gl_portfolio');
    }

    public function getAll ($limit = '5', $start = '0') {
        $this->db->where('active', '1');
        if($limit != 0 && $start != 0)
            $this->db->limit($limit, $start);
        $this->db->order_by('id DESC');
        $query = $this->db->get('gl_portfolio');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }

        return false;
    }

    public function getLast ($limit = 0, $id = NULL) {
        $this->db->where('active', '1');
        (!empty($id) ? $this->db->where('id !=', $id) : '');
        $this->db->limit($limit);
        return parent::get();
    }

    public function getImages ($id = NULL) {
        $this->db->where('id_portfolio', $id);
        return parent::get(NULL, FALSE, true);
    }
}