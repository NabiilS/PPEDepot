<?php

/** @property RallyeModel $rallyeModel 
 *  @property EleveModel $eleveModel
 *  @property ParticiperModel $participerModel 
 */
class Participer extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('participerModel');
        $this->load->model('eleveModel');
        $this->load->model('rallyeModel');
    }

    function index() {
        $data['title']='Les élèves qui suivent des rallyes';
        $this->load->view('AppHeader',$data);
        $data['all_participer']=$this->participerModel->get_all_participer();
        $this->load->view('ParticiperIndex',$data);
        $this->load->view('AppFooter');
    }

    function add() {
        $this->load->library('form_validation');
        LoadValidationRules($this->participerModel,$this->form_validation);

        if ($this->form_validation->run()) {
            $params=array(
                'idEleve'=>$this->input->post('idEleve'),
                'idRallye'=>$this->input->post('idRallye')
            );
            $participer_id=$this->participerModel->add_participer($params);
            redirect('Participer/Index');
        }
        else {
            $data['title']='Associer un élève à un rallye';
            // chargement de la comboBox Eleve
            $all_eleves=$this->eleveModel->get_all_eleves();
            $cbProperties=array(
                'selectName'=>'idEleve',
                'selectedAttributName'=>'id',
                'selectedValue'=>$this->input->post('idEleve'),
                'optionAttributesNames'=>array('nom','prenom','login'),
                'options'=>$all_eleves,
                'selectMessage'=>'sélectionnez un élève',
                'emptyMessage'=>'aucun élève à sélectionner'
            );
            $this->load->library('ComboBox',$cbProperties,'cbEleve');
            $data['comboBoxEleve']=$this->cbEleve;
            
            // Combo box rallye
            $all_rallyes=$this->rallyeModel->get_all_rallyes();
            $cbProperties=array(
                'selectName'=>'idRallye',
                'selectedAttributName'=>'id',
                'selectedValue'=>$this->input->post('idRallye'),
                'optionAttributesNames'=>array('theme','dateDebut'),
                'options'=>$all_rallyes,
                'selectMessage'=>'sélectionnez un rallye',
                'emptyMessage'=>'aucun rallye à sélectionner'
            );
            $this->load->library('ComboBox',$cbProperties,'cbRallye');
            $data['comboBoxRallye']=$this->cbRallye;

            $this->load->view('AppHeader',$data);
            $this->load->view('ParticiperAdd');
            $this->load->view('AppFooter');
        }
    }

    function remove($idRallye,$idEleve) {
        $participer=$this->participerModel->get_participer($idRallye,$idEleve);
        if (isset($participer['idRallye'])) {
            $this->participerModel->delete_participer($idRallye,$idEleve);
            redirect('participer/index');
        }
        else
            show_error("La participation que vous essayez de supprimer n'existe pas.");
    }

}