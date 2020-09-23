<?php

class ReponseModel extends CI_Model {
    public $ValidationRules=array(
        array('field'=>'idParticiperRallye','label'=>'id Rallye de Participer','rules'=>'require|integer'),
        array('field'=>'idParticiperEleve','label'=>'id Elève de Participer','rules'=>'require|integer'),
        array('field'=>'idQuestion','label'=>'Question','rules'=>'require|integer'),
        array('field'=>'idProposition','label'=>'Proposition','rules'=>'require|integer')
    );

    function __construct() {
        parent::__construct();
    }

    function get_reponse($idparticiperrallye) {
        return $this->db->get_where('reponse',array('idparticiperrallye'=>$idparticiperrallye))->row_array();
    }

    function get_all_reponses() {
        return $this->db->get('reponse')->result_array();
    }

    function add_reponse($params) {
        $this->db->insert('reponse',$params);
        return $this->db->insert_id();
    }

    function update_reponse($idRallye,$idEleve,$idQuestion, $idProposition) {
        $this->db->where();
        $this->db->update('reponse',$params);
    }

    function delete_reponse($idRallye,$idEleve,$idQuestion, $idProposition) {
        $this->db->delete('reponse',array('idparticiperrallye'=>$idparticiperrallye));
    }

}