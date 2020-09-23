<?php

/** @property ClasseModel $classeModel
 *  @property EnseignantModel $enseignantModel
 *  @property NiveauModel $niveauModel
 */
class Classe extends CI_Controller {

    function __construct() {
        parent::__construct();
        if ($this->session->groupe!='Admin') {
            echo "Vous devez être logué en tant qu'administrateur pour accéder à cette page";
            exit;
        }
        $this->load->model('classeModel');
        $this->load->model('enseignantModel');
        $this->load->model('niveauModel');
    }

    function index() {
        $data['classes']=$this->classeModel->get_all_classes();
        $data['title']='Les Classes';
        $data['controller']='Classe';
        $this->load->view('AppHeader',$data);
        $this->load->view('ClasseIndex',$data);
        $this->load->view('AppFooter',$data);
    }

    function add() {
        $this->load->library('form_validation');
        LoadValidationRules($this->classeModel,$this->form_validation);
        if ($this->form_validation->run()) {
            $params=array(
                'idEnseignant'=>$this->input->post('idEnseignant'),
                'anneeScolaire'=>$this->input->post('anneeScolaire'),
                'idNiveau'=>$this->input->post('idNiveau'),
            );
            $classe_id=$this->classeModel->add_classe($params);
            redirect('Classe/Index');
        }
        else {
            // chargement de la combo box enseignant
            $all_enseignants=$this->enseignantModel->get_all_enseignants();
            $cbProperties=array(
                'selectName'=>'idEnseignant',
                'selectedAttributName'=>'id',
                'selectedValue'=>$this->input->post('idEnseignant'),
                'optionAttributesNames'=>array('nom','prenom'),
                'options'=>$all_enseignants,
                'selectMessage'=>'sélectionnez un enseignant',
                'emptyMessage'=>'aucun enseignant à sélectionner'
            );
            $this->load->library('ComboBox',$cbProperties,'cbEnseignant');
            $data['comboBoxEnseignant']=$this->cbEnseignant;
            // Combo box niveau
            $all_niveaux=$this->niveauModel->get_all_niveaux();
            $cbProperties=array(
                'selectName'=>'idNiveau',
                'selectedAttributName'=>'id',
                'selectedValue'=>$this->input->post('idNiveau'),
                'optionAttributesNames'=>array('niveauScolaire'),
                'options'=>$all_niveaux,
                'selectMessage'=>'sélectionnez un niveau',
                'emptyMessage'=>'aucun niveau à sélectionner'
            );
            $this->load->library('ComboBox',$cbProperties,'cbNiveau');
            $data['comboBoxNiveau']=$this->cbNiveau;
            $data['controller']='Classe';
            $data['title']='Ajouter une classe';
            $this->load->view('AppHeader',$data);
            $this->load->view('ClasseAdd',$data);
            $this->load->view('AppFooter');
        }
    }

    function edit($id) {
        $classe=$this->classeModel->get_classe($id);
        if (isset($classe['id'])) {
            $this->load->library('form_validation');
            LoadValidationRules($this->classeModel,$this->form_validation);
            if ($this->form_validation->run()) {
                $params=array(
                    'idenseignant'=>$this->input->post('idEnseignant'),
                    'anneescolaire'=>$this->input->post('anneeScolaire'),
                    'idniveau'=>$this->input->post('idNiveau'),
                );

                $this->classeModel->update_classe($id,$params);
                redirect('classe/index');
            }
            else {
                $data['classe']=$classe;
                // chargement de la combo box enseignant
                $all_enseignants=$this->enseignantModel->get_all_enseignants();
                $cbProperties=array(
                    'selectName'=>'idEnseignant',
                    'selectedAttributName'=>'id',
                    'selectedValue'=>$classe['idEnseignant'],
                    'optionAttributesNames'=>array('nom','prenom'),
                    'options'=>$all_enseignants,
                    'selectMessage'=>'sélectionnez un enseignant',
                    'emptyMessage'=>'aucun enseignant à sélectionner'
                );
                $this->load->library('ComboBox',$cbProperties,'cbEnseignant');
                $data['comboBoxEnseignant']=$this->cbEnseignant;
                // Combo box niveau
                $all_niveaux=$this->niveauModel->get_all_niveaux();
                $cbProperties=array(
                    'selectName'=>'idNiveau',
                    'selectedAttributName'=>'id',
                    'selectedValue'=>$classe['idNiveau'],
                    'optionAttributesNames'=>array('niveauScolaire'),
                    'options'=>$all_niveaux,
                    'selectMessage'=>'sélectionnez un niveau',
                    'emptyMessage'=>'aucun niveau à sélectionner'
                );
                $this->load->library('ComboBox',$cbProperties,'cbNiveau');
                $data['comboBoxNiveau']=$this->cbNiveau;
                // fin chargement des combo

                $data['title']='Modifier une classe';
                $data['controller']='Classe';
                $this->load->view('AppHeader',$data);
                $this->load->view('ClasseEdit',$data);
                $this->load->view('AppFooter');
            }
        }
        else {
            show_error("La classe que vous essayez de modifier n'existe pas.");
        }
    }

    function remove($id) {
        $classe=$this->classeModel->get_classe($id);

        // check if the classe exists before trying to delete it
        if (isset($classe['id'])) {
            $this->classeModel->delete_classe($id);
            redirect('classe/index');
        }
        else {
            show_error("La classe que vous essayez de supprimer n'existe pas.");
        }
    }

}