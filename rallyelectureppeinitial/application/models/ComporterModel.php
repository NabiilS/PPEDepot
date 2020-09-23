<?php

/** @property Livremodel $hasOneLivre 
 *  @property Rallyemodel $hasOneRallye
 */
class ComporterModel extends CI_Model {
    public $ValidationRules=array(
        array('field'=>'idLivre','label'=>'id Livre','rules'=>'required|integer'),
        array('field'=>'idRallye','label'=>'id Rallye','rules'=>'required|integer')
    );

    function __construct() {
        parent::__construct();
        $this->load->model('livreModel','hasOneLivre');
        $this->load->model('rallyeModel','hasOneRallye');
    }

    function get_all_comporter_Rallye($idRallye) {
        return $this->db->get_where('comporter',array('idRallye'=>$idRallye))->result_array();
    }

    function get_all_comporter() {
        return $this->db->get('comporter')->result_array();
    }

    function add_comporter($params) {
        $this->db->insert('comporter',$params);
        return $this->db->insert_id();
    }

    function get_comporter($idRallye,$idLivre) {
        return $this->db->get_where('comporter',array('idRallye'=>$idRallye,'idLivre'=>$idLivre))->row_array();
    }

    function delete_comporter($idRallye,$idLivre) {
        $this->db->where(array('idLivre'=>$idLivre,'idRallye'=>$idRallye));
        $this->db->delete('comporter');
    }

    function get_livre($idLivre) {
        return $this->hasOneLivre->get_livre($idLivre);
    }

    function get_rallye($idRallye) {
        return $this->hasOneRallye->get_rallye($idRallye);
    }

}