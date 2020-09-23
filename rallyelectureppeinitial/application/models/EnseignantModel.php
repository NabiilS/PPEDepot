<?php

/** @property ClasseModel $hasManyClasse
 * 
 */
class EnseignantModel extends CI_Model {
    public $ValidationRules=array(
        array('field'=>'nom','label'=>'Nom','rules'=>'required|max_length[45]'),
        array('field'=>'prenom','label'=>'Prenom','rules'=>'required|max_length[45]'),
        array('field'=>'login','label'=>'Login','rules'=>'required|max_length[100]')
    );

    function __construct() {
        parent::__construct();
        $this->load->model('classeModel','hasManyClasses');
    }

    function get_enseignant($id) {
        return $this->db->get_where('enseignant',array('id'=>$id))->row_array();
    }

    function get_all_enseignants() {
        return $this->db->get('enseignant')->result_array();
    }

    function add_enseignant($params) {
        $this->db->insert('enseignant',$params);
        return $this->db->insert_id();
    }

    function update_enseignant($id,$params) {
        $this->db->where('id',$id);
        $this->db->update('enseignant',$params);
    }

    function delete_enseignant($id) {
        $this->db->delete('enseignant',array('id'=>$id));
    }

    function get_where($attribut,$value) {
        return $this->db->get_where('enseignant',array($attribut=>$value))->result_array();
    }

    function get_Classes($id) {
        $this->hasManyClasses->get_where('idEnseignant',$id);
    }

}