<?php

/** @property AuteurModel $auteurModel  */
class Auteur extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!in_array($this->session->groupe,array('Admin','Enseignant'))) {
            echo "Vous devez être logué en tant qu'administrateur ou Enseignant pour accéder à cette page";
            exit;
        }
        // on fait référence au modèle dans le controleur
        $this->load->model('auteurModel');
    }

    function index() {
        // prépartion des données à transmettre à la vue
        $data['title']='Les Auteurs';
        $this->load->view('AppHeader',$data);
        // récupération de tous les auteurs
        $data['auteurs']=$this->auteurModel->get_all_auteurs();
        $this->load->view('AuteurIndex',$data);
        $this->load->view('AppFooter');
    }

    function add() {
        // chargement lib de validation
        $this->load->library('form_validation');
        
        // on définit la liste des règles de validation des données
        // provenant du modèle. 
        // Todo A replacer en tant que méthode de controleur
        LoadValidationRules($this->auteurModel, $this->form_validation);

        if ($this->form_validation->run()) {
            $params=array(
                'nom'=>$this->input->post('nom')
            );

            $auteur_id=$this->auteurModel->add_auteur($params);
            redirect('Auteur/index');
        }
        else {
            $data['title']='Créer un auteur';
            $this->load->view('AppHeader',$data);
            $this->load->view('AuteurAdd');
            $this->load->view('AppFooter');
        }
    }

    function edit($id) {
        // verifie que l'auteur existe avant de le modifier
        $auteur=$this->auteurModel->get_auteur($id);
        if (isset($auteur['id'])) {
            // chargement lib de validation
            $this->load->library('form_validation');
            // définition des règles de validation
             LoadValidationRules($this->auteurModel, $this->form_validation);

            if ($this->form_validation->run()) {
                $params=array(
                    'nom'=>$this->input->post('nom'),
                );
                $this->auteurModel->update_auteur($id,$params);
                redirect('Auteur/index');
            }
            else {
                $data['auteur']=$this->auteurModel->get_auteur($id);
                $data['title']='Modifier un Auteur';
                $this->load->view('AppHeader',$data);
                $this->load->view('AuteurEdit',$data);
                $this->load->view('AppFooter');
            }
        }
        else
            show_error("l'auteur que vous essayez de modifier n'existe pas.");
    }

    function remove($id) {
        $auteur=$this->auteurModel->get_auteur($id);
        // vérification que l'auteur existe avant de le supprimer
        if (isset($auteur['id'])) {
            $this->auteurModel->delete_auteur($id);
            redirect('auteur/index');
        }
        else
            show_error("l'auteur que vous essayez de supprimer n'existe pas");
    }

}