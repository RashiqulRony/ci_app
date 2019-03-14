<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Common_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_info($table) {
        $query = $this->db->get($table);
        $ret = $query->result_array();
        return $ret;

        /*$this->db->select('*');
        $this->db->from($table);
        $query =  $this->db->get();
        return $query->row();*/
    }

    public function get_info_id($table,$id) {
        $query = $this->db->get($table);
        $this->db->where('id', $id);
        $ret = $query->result_array();
        return $ret;

    }

    /*public function save($table, $data) {


        if ($this->db->insert($table, $data)) {
            return true;
        } else {
            return false;
        }
    }*/

    public function edit($table, $id, $field, $data) {
        $this->db->where($field, $id);
        if ($this->db->update($table, $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function exists($table, $field, $item ) {
        $this->db->from($table);
        $this->db->where($field, $item);
        $query = $this->db->get();

        return ($query->num_rows() >= 1);
    }

    public function saved($table, $data) {
        if ($this->db->insert($table, $data)) {
            return true;
        }else{
            return false;
        }
    }

    public function get_dropdown($table, $field, $id){
        $data[''] = '-- Select One --';
        $this->db->select("$id, $field");
        $this->db->from($table);
        $this->db->order_by($id, 'DESC');
        $query = $this->db->get();

        foreach ($query->result_array() AS $rows) {
            $data[$rows[$id]] = $rows[$field];
        }

        return $data;
    }

    public function get_join_query(){
        $data[] = '';
        $this->db->select('p.id,p.name,pi.product_info');
        $this->db->from('products p');
        $this->db->join('product_details pi', 'p.id = pi.product_id','RIGHT');
        //$this->db->where('p.id', 2);
        $query = $this->db->get();
        $data = $query->result_array();
        pr( $data);
        return $data;

    }

    public function delete($table, $field, $id) {
        $this->db->where($field, $id);
        $this->db->delete($table);
        return TRUE;
    }

}
