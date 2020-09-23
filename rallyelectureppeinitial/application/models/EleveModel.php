<?php

/** @property ClasseModel $hasOneClasse
 */
class EleveModel extends CI_Model {
    public $ValidationRules=array(
        array('field'=>'idClasse','label'=>'id Classe','rules'=>'required|integer'),
        array('field'=>'nom','label'=>'Nom','rules'=>'required|max_length[45]'),
        array('field'=>'prenom','label'=>'Prenom','rules'=>'required|max_length[45]'),
        array('field'=>'login','label'=>'Login','rules'=>'required|max_length[100]|valid_email')
    );

    function __construct() {
        parent::__construct();
        $this->load->model('classeModel','hasOneClasse');
    }

    function get_eleve($id) {
        return $this->db->get_where('eleve',array('id'=>$id))->row_array();
    }

    function get_all_eleves() {
        return $this->db->get('eleve')->result_array();
    }

    function add_eleve($params) {
        $this->db->insert('eleve',$params);
        return $this->db->insert_id();
    }

    function update_eleve($id,$params) {
        $this->db->where('id',$id);
        $this->db->update('eleve',$params);
    }

    function delete_eleve($id) {
        $this->db->delete('eleve',array('id'=>$id));
    }

    function get_where($attribut,$value) {
        return $this->db->get_where('eleve',array($attribut=>$value))->result_array();
    }

    function get_classe($id) {
        return $this->hasOneClasse->get_classe($this->get_eleve($id)['idClasse']);
    }

}