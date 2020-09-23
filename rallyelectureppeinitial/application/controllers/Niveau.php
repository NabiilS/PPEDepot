<?php

class Niveau extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('NiveauModel');
    }

    function index() {
        $data['title']='Les Niveaux scolaires';
        $this->load->view('AppHeader',$data);
        $data['niveaux']=$this->NiveauModel->get_all_niveaux();
        $this->load->view('NiveauIndex',$data);
        $this->load->view('AppFooter');
    }

    function add() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('niveauScolaire','Niveauscolaire','max_length[45]');

        if ($this->form_validation->run()) {
            $params=array(
                'niveauScolaire'=>$this->input->post('niveauScolaire'),
            );
            $niveau_id=$this->NiveauModel->add_niveau($params);
            redirect('Niveau/index');
        }
        else {
            $data['title']='Créer un niveau scolaire';
            $this->load->view('AppHeader',$data);
            $this->load->view('NiveauAdd');
            $this->load->view('AppFooter');
        }
    }

    function edit($id) {
        $niveau=$this->NiveauModel->get_niveau($id);

        if (isset($niveau['id'])) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('niveauScolaire','NiveauScolaire','max_length[45]');

            if ($this->form_validation->run()) {
                $params=array(
                    'niveauscolaire'=>$this->input->post('niveauScolaire'),
                );

                $this->NiveauModel->update_niveau($id,$params);
                redirect('Niveau/index');
            }
            else {
                $data['niveau']=$this->NiveauModel->get_niveau($id);
                $data['title']='Modifier un niveau scolaire';
                $this->load->view('AppHeader',$data);
                $this->load->view('niveauEdit',$data);
                $this->load->view('AppFooter');
            }
        }
        else
            show_error("le niveau que vous essayez de modifier n'existe pas.");
    }

    function remove($id) {
        $niveau=$this->NiveauModel->get_niveau($id);
        if (isset($niveau['id'])) {
            $this->NiveauModel->delete_niveau($id);
            redirect('Niveau/index');
        }
        else
            show_error("Le niveau que vous essayez de supprimer, n'existe pas.");
    }

}