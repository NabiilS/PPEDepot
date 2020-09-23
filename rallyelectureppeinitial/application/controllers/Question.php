<?php

/** @property QuestionModel $questionModel 
 * 
 */
class Question extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('questionModel');
    }

    function index() {
        $data['questions']=$this->questionModel->get_all_questions();
        $data['title']='Les Questions';
        $this->load->view('AppHeader',$data);
        $this->load->view('QuestionIndex',$data);
        $this->load->view('AppFooter');
    }

    function add() {
        $this->load->library('form_validation');
        LoadValidationRules($this->questionModel,$this->form_validation);
        if ($this->form_validation->run()) {
            $params=array(
                'question'=>$this->input->post('question'),
                'points'=>$this->input->post('points'),
                'idLivre'=>$this->input->post('idLivre'),
            );

            $question_id=$this->questionModel->add_question($params);
            redirect('Question/Index');
        }
        else {
            $data['title']='Ajouter une question';
            $this->load->view('AppHeader',$data);
            $this->load->view('QuestionAdd',$data);
            $this->load->view('AppFooter');
        }
    }

    function edit($id) {
        $question=$this->questionModel->get_question($id);
        if (isset($question['id'])) {
            $this->load->library('form_validation');
            LoadValidationRules($this->questionModel,$this->form_validation);
            if ($this->form_validation->run()) {
                $params=array(
                    'question'=>$this->input->post('question'),
                    'points'=>$this->input->post('points'),
                    'idLivre'=>$this->input->post('idLivre'),
                );

                $this->questionModel->update_question($id,$params);
                redirect('question/index');
            }
            else {
                $data['question']=$question;
                $data['title']='Modifier une Question';
                $this->load->view('AppHeader',$data);
                $this->load->view('QuestionEdit',$data);
                $this->load->view('AppFooter');
            }
        }
        else
            show_error("La question que vous essayez de modifier n'existe pas.");
    }

    function remove($id) {
        $question=$this->questionModel->get_question($id);
        if (isset($question['id'])) {
            $this->questionModel->delete_question($id);
            redirect('Question/Index');
        }
        else
            show_error("La question que vous essayez de supprimer n'existe pas.");
    }

}