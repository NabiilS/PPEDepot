<?php

/** @property RallyeModel $rallyeModel 
 *  @property LivreModel $livreModel
 *  @property ComporterModel $comporterModel 
 */
class Comporter extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('comporterModel');
        $this->load->model('livreModel');
        $this->load->model('rallyeModel');
    }

    function index() {
        $data['title']='Les Livres associés aux rallyes';
        $this->load->view('AppHeader',$data);
        $data['all_comporter']=$this->comporterModel->get_all_comporter();
        $this->load->view('ComporterIndex',$data);
        $this->load->view('AppFooter');
    }

    function add() {
        $this->load->library('form_validation');
        LoadValidationRules($this->comporterModel,$this->form_validation);

        if ($this->form_validation->run()) {
            $params=array(
                'idLivre'=>$this->input->post('idLivre'),
                'idRallye'=>$this->input->post('idRallye')
            );
            $comporter_id=$this->comporterModel->add_comporter($params);
            redirect('Comporter/Index');
        }
        else {
            $data['title']='Associer un livre à un rallye';
            // chargement de la comboBox Livre
            $all_livres=$this->livreModel->get_all_livres();
            $cbProperties=array(
                'selectName'=>'idLivre',
                'selectedAttributName'=>'id',
                'selectedValue'=>$this->input->post('idLivre'),
                'optionAttributesNames'=>array('titre'),
                'options'=>$all_livres,
                'selectMessage'=>'sélectionnez un livre',
                'emptyMessage'=>'aucun livre à sélectionner'
            );
            $this->load->library('ComboBox',$cbProperties,'cbLivre');
            $data['comboBoxLivre']=$this->cbLivre;
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
            $this->load->view('ComporterAdd');
            $this->load->view('AppFooter');
        }
    }

    function remove($idRallye,$idLivre) {
        $comporter=$this->comporterModel->get_comporter($idRallye,$idLivre);
        if (isset($comporter['idRallye'])) {
            $this->comporterModel->delete_comporter($idRallye,$idLivre);
            redirect('comporter/index');
        }
        else
            show_error("L'association entre l'élève et le rallye que vous essayez de supprimer n'existe pas.");
    }

}