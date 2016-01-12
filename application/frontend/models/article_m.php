<?php
class Article_m extends MY_Model
{
	protected $_table_name = 'gl_articles';
	protected $_order_by = 'pubdate desc, id desc';
	protected $_timestamps = TRUE;
	public $rules = array(
		'pubdate' => array(
			'field' => 'pubdate', 
			'label' => 'Publication date', 
			'rules' => 'trim|required|exact_length[10]|xss_clean'
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
		$article = new stdClass();
		$article->title = '';
		$article->slug = '';
		$article->body = '';
		$article->pubdate = date('Y-m-d');
		return $article;
	}

	public function GetAllCount () {
		$this->db->where('active', '1');
		return $this->db->count_all('gl_articles');
	}

	public function getAll ($limit = '5', $start = '0') {
		$this->db->where('active', '1');
		if($limit != 0 && $start != 0)
			$this->db->limit($limit, $start);
		$this->db->order_by('id DESC');
		$query = $this->db->get('gl_articles');
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}

		return false;
	}
	
	public function set_published(){
		$this->db->where('pubdate <=', date('Y-m-d'));
	}
	
	public function get_recent($limit = 3){
		
		// Fetch a limited number of recent articles
		$limit = (int) $limit;
		$this->set_published();
		$this->db->where('active', '1');
		$this->db->limit($limit);
		return parent::get();
	}

}