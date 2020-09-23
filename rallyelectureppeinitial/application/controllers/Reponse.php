<?php

class Reponse extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('ReponseModel');
    }

    function index() {
        $data['reponses']=$this->ReponseModel->get_all_reponses();

        $data['title']='Les réponses aux quizz';
        $this->load->view('AppHeader',$data);
        $this->load->view('ReponseIndex',$data);
        $this->load->view('AppFooter',$data);
    }

    function add() {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('idproposition','Idproposition','integer');

        if ($this->form_validation->run()) {
            $params=array(
                'idproposition'=>$this->input->post('idproposition'),
            );

            $reponse_id=$this->ReponseModel->add_reponse($params);
            redirect('reponse/index');
        }
        else {

            $this->load->model('Propositionmodel');
            $data['all_propositions']=$this->Propositionmodel->get_all_propositions();

            $this->load->view('reponse/add',$data);
        }
    }

    /*
     * Deleting reponse
     */

    function remove($idparticiperrallye) {
        $reponse=$this->ReponseModel->get_reponse($idparticiperrallye);

        // check if the reponse exists before trying to delete it
        if (isset($reponse['idparticiperrallye'])) {
            $this->ReponseModel->delete_reponse($idparticiperrallye);
            redirect('reponse/index');
        }
        else
            show_error('The reponse you are trying to delete does not exist.');
    }

}