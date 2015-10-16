<?php
class Diensten_m extends MY_Model {
    public function getSubPages() {
        $query = $this->db->query("SELECT id FROM `gl_pages` WHERE `active` = '1' AND `url` = 'diensten' LIMIT 1");
        if ($query->num_rows() > 0) {
            $row = $query->result();

            // return $row[0]->id;

            $query_sub = $this->db->query("SELECT * FROM `gl_pages_sub` WHERE `id_parent` = '" . $row[0]->id . "' ORDER BY `id`");
            if ($query_sub->num_rows() > 0) {
                $return = '';
                foreach ($query_sub->result() as $row_sub) {
                    $return[] = $row_sub;
                }
                return $return;
            }
        }
    }
 
    public function getAllCount () {
        return $this->db->count_all('gl_domain_tld');
    }

    public function getDomainTld ($limit = '12', $start = '0') {
        if($limit != 0 && $start != 0)
            $this->db->limit($limit, $start);
        $this->db->order_by('id ASC');
        $query = $this->db->get('gl_domain_tld');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }

        return false;
    }

    // public function getDomainTld() {
    //     return $this->db->get('gl_domain_tld')->result_array();
    // }

    public function getDomainTldPopular() {
        return $this->db->get_where('gl_domain_tld', array('popular' => '1'))->result_array();
    }
}