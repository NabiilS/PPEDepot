<?php

/** @property CI_Model $enseignantModel 
 *  @property Aauth $aauth 
 */
class Enseignant extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('enseignantModel');
        $this->load->library('aauth');
    }

    function Index() {
        $data['enseignants']=$this->enseignantModel->get_all_enseignants();
        $data['title']='Les Enseignants';
        $this->load->view('AppHeader',$data);
        $this->load->view('EnseignantIndex',$data);
        $this->load->view('AppFooter');
    }

    function add() {
        $this->load->library('form_validation');
        LoadValidationRules($this->enseignantModel,$this->form_validation);
        if ($this->form_validation->run()) {
            $password=$this->input->post('password');
            $email=$this->input->post('login');
            // créer le aauth_user à ajouter au controle de validation
            $idAauthUser=$this->aauth->create_user($email,$password);
            $params=array(
                'nom'=>$this->input->post('nom'),
                'prenom'=>$this->input->post('prenom'),
                'login'=>$email,
                'idAuth'=>$idAauthUser
            );
            // on crée l'enseignant
            $enseignant_id=$this->enseignantModel->add_enseignant($params);
            // on l'affecte au groupe Enseignant
            $this->aauth->add_member($idAauthUser,'Enseignant');
            redirect('Enseignant/Index');
        }
        else {
            $data['title']='Ajouter un Enseignant';
            $this->load->view('AppHeader',$data);
            $this->load->view('EnseignantAdd');
            $this->load->view('AppFooter');
        }
    }

    function edit($id) {
        $enseignant=$this->enseignantModel->get_enseignant($id);
        if (isset($enseignant['id'])) {
            $userAuth=$this->aauth->get_user($enseignant['idAuth']);
            $data['enseignant']=$enseignant;
            $data['user']=$userAuth;
            $this->load->library('form_validation');
            LoadValidationRules($this->enseignantModel,$this->form_validation);
            // ajout validation rule sur password
            $this->form_validation->set_rules('password','Password','required');
            if ($this->form_validation->run()) {
                $params=array(
                    'nom'=>$this->input->post('nom'),
                    'prenom'=>$this->input->post('prenom'),
                    'login'=>$this->input->post('login'),
                    'idAuth'=>$enseignant['idAuth']
                );
                $password=$this->input->post('password');
                $this->aauth->update_user($enseignant['idAuth'],$params['login'],$password);
                $this->enseignantModel->update_enseignant($id,$params);
                redirect('Enseignant/Index');
            }
            else {
                $data['enseignant']=$this->enseignantModel->get_enseignant($id);
                $data['title']="Modification d'un enseignant";
                $this->load->view('AppHeader',$data);
                $this->load->view('EnseignantEdit',$data);
                $this->load->view('AppFooter');
            }
        }
        else {
            show_error("L'enseignant que vous essayez de modifier n'existe pas");
        }
    }

    function remove($id) {
        $enseignant=$this->enseignantModel->get_enseignant($id);
        if (isset($enseignant['id'])) {
            $this->aauth->delete_user($enseignant['idAuth']);
            $this->enseignantModel->delete_enseignant($id);
            redirect('Enseignant/Index');
        }
        else {
            show_error("L'enseignant que vous essayez de supprimer n'existe pas");
        }
    }
}