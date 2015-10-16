<?php
class System_M extends MY_Model {
	protected $_table_name = 'gl_system';

	function __construct () {
		parent::__construct();
	}

	public function get_value($key) {
		return $this->db->select('value')->get_where($this->_table_name, array('key' => $key))->result_array();
	}

    public function get_navigation() {
        $query = $this->db->query("SELECT * FROM `gl_pages` WHERE `navigation_visible` = '1' AND `active` = '1' ORDER BY `sort`");
        $return = array(); $i = 0;
        foreach ($query->result() as $row) {
            $return[$i]['title'] = $row->title;
            $return[$i]['url'] = $row->url;

            $query_sub = $this->db->query("SELECT * FROM `gl_pages_sub` WHERE `id_parent` = '" . $row->id . "' ORDER BY `id`");
            if ($query_sub->num_rows() > 0) {
                // $return[$i]['child'][0]['title'] = $row->title;
                // $return[$i]['child'][0]['url'] = $row->url;
                
                $x = 1;
                foreach ($query_sub->result() as $row_sub) {
                    $return[$i]['child'][$x]['title'] = $row_sub->title;
                    $return[$i]['child'][$x]['url'] = $row->url . '/' . $row_sub->url;
                    $x++;
                }
            }
            $i++;
        }
        return $return;
    }
}