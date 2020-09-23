<?php

/** @property EnseignantModel $hasOneEnseignant 
 *  @property NiveauModel $hasOneNiveau 
 *  
 */
class ClasseModel extends CI_Model {
    public $ValidationRules=array(
        array('field'=>'idEnseignant','label'=>'Enseignant','rules'=>'required|integer'),
        array('field'=>'anneeScolaire','label'=>'Annee scolaire','rules'=>'max_length[45]'),
        array('field'=>'idNiveau','label'=>'Niveau','rules'=>'required|integer')
    );

    function __construct() {
        parent::__construct();
        $this->load->model('EnseignantModel','hasOneEnseignant');
        $this->load->model('NiveauModel','hasOneNiveau');
    }

    function get_classe($id) {
        return $this->db->get_where('classe',array('id'=>$id))->row_array();
    }

    function get_all_classes() {
        $this->db->select('classe.id,classe.idEnseignant,classe.anneeScolaire,classe.idNiveau,niveau.niveauScolaire');
        $this->db->from('classe');
        $this->db->join('niveau','classe.idNiveau=niveau.id');
        return $this->db->get()->result_array();
    }

    function add_classe($params) {
        $this->db->insert('classe',$params);
        return $this->db->insert_id();
    }

    function update_classe($id,$params) {
        $this->db->where('id',$id);
        $this->db->update('classe',$params);
    }

    function delete_classe($id) {
        $this->db->delete('classe',array('id'=>$id));
    }

    function get_where($attribut,$value) {
        return $this->db->get_where('classe',array($attribut=>$value))->result_array();
    }

    function get_Enseignant($id) {
        return $this->hasOneEnseignant->get_enseignant($this->get_classe($id)['idEnseignant']);
    }

    function get_Niveau($id) {
        return $this->hasOneNiveau->get_niveau($this->get_classe($id)['idNiveau']);
    }

}