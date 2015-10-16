<?php
class Zoeken_m extends MY_Model {
    public $results = 0;

    public function getArticles($q) {
        $this->db->where('active', '1');
        $this->db->where('MATCH (title, body) AGAINST ("' . $q . '")', NULL, FALSE);
        $query = $this->db->get('gl_articles');
        $this->results = $this->results + $query->num_rows;
        return $query->result();
    }

    public function getPages($q) {
        $this->db->where('active', '1');
        $this->db->where('url !=', 'algemene-voorwaarden');
        $this->db->where('MATCH (title, body, body_sidebar) AGAINST ("' . $q . '")', NULL, FALSE);
        $query = $this->db->get('gl_pages');
        $this->results = $this->results + $query->num_rows;
        return $query->result();
    }

    public function getPagesSub($q) {
        $this->db->where('active', '1');
        $this->db->where('MATCH (title, body, body_sidebar) AGAINST ("' . $q . '")', NULL, FALSE);
        $query = $this->db->get('gl_pages_sub');
        $this->results = $this->results + $query->num_rows;
        return $query->result();
    }

    public function getPortfolio($q) {
        $this->db->where('active', '1');
        $this->db->where('MATCH (title, body) AGAINST ("' . $q . '")', NULL, FALSE);
        $query = $this->db->get('gl_portfolio');
        $this->results = $this->results + $query->num_rows;
        return $query->result();
    }

    public function totalResults() {
        return $this->results;
    }
}