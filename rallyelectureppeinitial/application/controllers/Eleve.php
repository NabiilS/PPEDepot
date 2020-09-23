<?php

/** @property EleveModel $eleveModel 
 *  @property ClasseModel $classeModel 
 *  @property Aauth $aauth 
 */
class Eleve extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('eleveModel');
        $this->load->model('classeModel');
        $this->load->library('aauth');
    }

    function index() {
        $data['eleves']=$this->eleveModel->get_all_eleves();
        $data['title']='Les Eleves';
        $this->load->view('AppHeader',$data);
        $this->load->view('EleveIndex',$data);
        $this->load->view('AppFooter',$data);
    }

    function add() {
        $this->load->library('form_validation');
        LoadValidationRules($this->eleveModel,$this->form_validation);
        $this->form_validation->set_rules('password','Password','required');
        // $this->form_validation->set_rules('password','Password','callback_check_aAuthCreation');

        if ($this->form_validation->run()) {
            $password=$this->input->post('password');
            $email=$this->input->post('login');
            // créer le aauth_user à ajouter au controle de validation
            $idAauthUser=$this->aauth->create_user($email,$password);
            $this->aauth->unban_user($idAauthUser);
            $params=array(
                'idClasse'=>$this->input->post('idClasse'),
                'nom'=>$this->input->post('nom'),
                'prenom'=>$this->input->post('prenom'),
                'login'=>$email,
                'idAuth'=>$idAauthUser
            );
            // on crée l'élève
            $eleve_id=$this->eleveModel->add_eleve($params);
            // on l'affecte au groupe Elève
            $this->aauth->add_member($idAauthUser,'Elève');
            redirect('Eleve/index');
        }
        else {
            // chargement de la combo box classe
            $all_classes=$this->classeModel->get_all_classes();
            $cbProperties=array(
                'selectName'=>'idClasse',
                'selectedAttributName'=>'id',
                'selectedValue'=>$this->input->post('idClasse'),
                'optionAttributesNames'=>array('niveauScolaire','anneeScolaire'),
                'options'=>$all_classes,
                'selectMessage'=>'sélectionnez une classe',
                'emptyMessage'=>'aucune classe à sélectionner'
            );
            $this->load->library('ComboBox',$cbProperties,'cbClasse');
            $data['comboBoxClasse']=$this->cbClasse;
            $data['title']="Création d'un élève";
            $this->load->view('AppHeader',$data);
            $this->load->view('EleveAdd',$data);
            $this->load->view('AppFooter');
        }
    }

    function check_aAuthCreation($password) {
        return true;
    }

    function edit($id) {
        $eleve=$this->eleveModel->get_eleve($id);
        if (isset($eleve['id'])) {
            $userAuth=$this->aauth->get_user($eleve['idAuth']);
            $data['eleve']=$eleve;
            $data['user']=$userAuth;
            $this->load->library('form_validation');
            LoadValidationRules($this->eleveModel,$this->form_validation);
            // ajout validation rule sur password
            $this->form_validation->set_rules('password','Password','required');
            if ($this->form_validation->run()) {
                $params=array(
                    'idClasse'=>$this->input->post('idClasse'),
                    'nom'=>$this->input->post('nom'),
                    'prenom'=>$this->input->post('prenom'),
                    'login'=>$this->input->post('login'),
                    'idAuth'=>$eleve['idAuth']
                );
                $password=$this->input->post('password');
                $this->aauth->update_user($eleve['idAuth'],$params['login'],$password);
                $this->eleveModel->update_eleve($id,$params);
                redirect('Eleve/Index');
            }
            else {
                // chargement de la combo box classe
                $all_classes=$this->classeModel->get_all_classes();
                $cbProperties=array(
                    'selectName'=>'idClasse',
                    'selectedAttributName'=>'id',
                    'selectedValue'=>$eleve['idClasse'],
                    'optionAttributesNames'=>array('niveauScolaire','anneeScolaire'),
                    'options'=>$all_classes,
                    'selectMessage'=>'sélectionnez une classe',
                    'emptyMessage'=>'aucune classe à sélectionner'
                );
                $this->load->library('ComboBox',$cbProperties,'cbClasse');
                $data['comboBoxClasse']=$this->cbClasse;
                $data['title']="Modification d'un élève";
                $this->load->view('AppHeader',$data);
                $this->load->view('EleveEdit',$data);
                $this->load->view('AppFooter');
            }
        }
        else
            show_error("L'élève que vous essayez de modifier n'existe pas.");
    }

    function remove($id) {
        $eleve=$this->eleveModel->get_eleve($id);
        if (isset($eleve['id'])) {
            // $user=$this->aauth->get_user($this->aauth->get_user_id($eleve['login']));
            $this->eleveModel->delete_eleve($id);
            // supprime le aauth_users et de aauth_users_to_groups
            $this->aauth->delete_user($eleve['idAuth']);
            redirect('Eleve/Index');
        }
        else
            show_error("L'élève que vous essayez de supprimer n'existe pas.");
    }

}