<?php

/** @property RallyeModel $rallyeModel 
 * 
 */
class Rallye extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('rallyeModel');
    }

    function index() {
        $data['title']='Les rallyes lecture';
        $this->load->view('AppHeader',$data);
        $data['rallyes']=$this->rallyeModel->get_all_rallyes();
        $this->load->view('RallyeIndex',$data);
        $this->load->view('AppFooter',$data);
    }

    function add() {
        $this->load->library('form_validation');
        LoadValidationRules($this->rallyeModel,$this->form_validation);

        if ($this->form_validation->run()) {
            $params=array(
                'dateDebut'=>$this->input->post('dateDebut'),
                'duree'=>$this->input->post('duree'),
                'theme'=>$this->input->post('theme'),
            );

            $rallye_id=$this->rallyeModel->add_rallye($params);
            redirect('rallye/index');
        }
        else {
            $data['title']='Créer un rallye';
            $this->load->view('AppHeader',$data);
            $this->load->view('RallyeAdd');
            $this->load->view('AppFooter');
        }
    }

    function edit($id) {
        $rallye=$this->rallyeModel->get_rallye($id);
        if (isset($rallye['id'])) {
            $this->load->library('form_validation');
            LoadValidationRules($this->rallyeModel,$this->form_validation);
            if ($this->form_validation->run()) {
                $params=array(
                    'dateDebut'=>$this->input->post('dateDebut'),
                    'duree'=>$this->input->post('duree'),
                    'theme'=>$this->input->post('theme'),
                );
                $this->rallyeModel->update_rallye($id,$params);
                redirect('rallye/index');
            }
            else {
                $data['rallye']=$rallye;
                $data['title']='Modifier un rallye';
                $this->load->view('AppHeader',$data);
                $this->load->view('RallyeEdit');
                $this->load->view('AppFooter');
            }
        }
        else
            show_error("Le rallye que vous voulez modifier n'existe pas.");
    }

    function remove($id) {
        $rallye=$this->rallyeModel->get_rallye($id);

        // check if the rallye exists before trying to delete it
        if (isset($rallye['id'])) {
            $this->rallyeModel->delete_rallye($id);
            redirect('rallye/index');
        }
        else
            show_error("Le rallye que vous essayez de supprimer n'existe pas.");
    }

}