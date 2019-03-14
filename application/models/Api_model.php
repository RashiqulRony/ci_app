<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Api_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_product_list(){
        $this->db->select('*');
        $this->db->from('products');
        // $this->db->where('id', $id);
        // $this->db->limit(10000);
        $query = $this->db->get()->result_array();

        return $query;
    }


}
