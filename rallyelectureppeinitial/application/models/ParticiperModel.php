<?php

/** @property EleveModel $hasOneEleve 
 *  @property Rallyemodel $hasOneRallye
 */
class ParticiperModel extends CI_Model {
    public $ValidationRules=array(
        array('field'=>'idEleve','label'=>'id Eleve','rules'=>'required|integer'),
        array('field'=>'idRallye','label'=>'id Rallye','rules'=>'required|integer')
    );

    function __construct() {
        parent::__construct();
        $this->load->model('eleveModel','hasOneEleve');
        $this->load->model('rallyeModel','hasOneRallye');
    }

    function get_all_participer() {
        return $this->db->get('participer')->result_array();
    }

    function add_participer($params) {
        $this->db->insert('participer',$params);
        return $this->db->insert_id();
    }

    function get_participer($idRallye,$idEleve) {
        return $this->db->get_where('participer',array('idRallye'=>$idRallye,'idEleve'=>$idEleve))->row_array();
    }

    function delete_participer($idRallye,$idEleve) {
        $this->db->delete('participer',array('idRallye'=>$idRallye,'idEleve'=>$idEleve));
    }

    function get_eleve($idEleve) {
        return $this->hasOneEleve->get_eleve($idEleve);
    }

    function get_rallye($idRallye) {
        return $this->hasOneRallye->get_rallye($idRallye);
    }

}