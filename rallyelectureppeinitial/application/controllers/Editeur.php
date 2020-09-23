<?php

/** @property Editeurmodel $editeurModel */
class Editeur extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!in_array($this->session->groupe,array('Admin','Enseignant'))) {
            echo "Vous devez être logué en tant qu'administrateur ou Enseignant pour accéder à cette page";
            exit;
        }
        $this->load->model('editeurModel');
    }

    function index() {
        $data['editeurs']=$this->editeurModel->get_all_editeurs();
        $data['title']='Les éditeurs';
        $this->load->view('AppHeader',$data);
        $this->load->view('EditeurIndex',$data);
        $this->load->view('AppFooter',$data);
    }

    function add() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules($this->editeurModel->validationRules);

        if ($this->form_validation->run()) {
            $params=array(
                'nom'=>$this->input->post('nom'),
            );

            $editeur_id=$this->editeurModel->add_editeur($params);
            redirect('editeur/index');
        }
        else {
            $data['title']="Création d'un éditeur";
            $this->load->view('AppHeader',$data);
            $this->load->view('EditeurAdd');
            $this->load->view('AppFooter',$data);
        }
    }

    function edit($id) {
        $editeur=$this->editeurModel->get_editeur($id);
        if (isset($editeur['id'])) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules($this->editeurModel->validationRules);

            if ($this->form_validation->run()) {
                $params=array(
                    'nom'=>$this->input->post('nom'),
                );
                $this->editeurModel->update_editeur($id,$params);
                redirect('Editeur/Index');
            }
            else {
                $data['editeur']=$this->editeurModel->get_editeur($id);
                $data['title']="Modification d'un éditeur";
                $this->load->view('AppHeader',$data);
                $this->load->view('EditeurEdit',$data);
                $this->load->view('AppFooter');
            }
        }
        else
            show_error("L'éditeur que vous essayez de modifier n'existe pas.");
    }

    function remove($id) {
        $editeur=$this->editeurModel->get_editeur($id);

        if (isset($editeur['id'])) {
            $this->editeurModel->delete_editeur($id);
            redirect('editeur/index');
        }
        else
            show_error("L'éditeur que vous essayez de supprimer n'existes pas.");
    }

}