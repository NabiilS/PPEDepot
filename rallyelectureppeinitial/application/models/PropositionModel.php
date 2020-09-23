<?php

/** @property QuestionModel $hasOneQuestion 
 * 
 */
class PropositionModel extends CI_Model {
    public $ValidationRules=array(
        array('field'=>'idQuestion','label'=>'id Question','rules'=>'required|integer'),
        array('field'=>'proposition','label'=>'Proposition','rules'=>'required|max_length[255]'),
        array('field'=>'solution','label'=>'Solution','rules'=>'required|integer')
    );

    function __construct() {
        parent::__construct();
        $this->load->model('QuestionModel','hasOneQuestion');
    }

    function get_proposition($id) {
        return $this->db->get_where('proposition',array('id'=>$id))->row_array();
    }

    function get_all_propositions() {
        return $this->db->get('proposition')->result_array();
    }

    function add_proposition($params) {
        $this->db->insert('proposition',$params);
        return $this->db->insert_id();
    }

    function update_proposition($id,$params) {
        $this->db->where('id',$id);
        $this->db->update('proposition',$params);
    }

    function delete_proposition($id) {
        $this->db->delete('proposition',array('id'=>$id));
    }

    function get_question($idProposition) {
        return $this->hasOneQuestion->get_question($this->get_proposition($idProposition)['$idQuestion']);
    }

}