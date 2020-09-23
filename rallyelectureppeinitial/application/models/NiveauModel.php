<?php

class NiveauModel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_niveau($id) {
        return $this->db->get_where('niveau',array('id'=>$id))->row_array();
    }

    function get_all_niveaux() {
        return $this->db->get('niveau')->result_array();
    }

    function add_niveau($params) {
        $this->db->insert('niveau',$params);
        return $this->db->insert_id();
    }

    function update_niveau($id,$params) {
        $this->db->where('id',$id);
        $this->db->update('niveau',$params);
    }

    function delete_niveau($id) {
        $this->db->delete('niveau',array('id'=>$id));
    }

}