<?php

if (!defined('BASEPATH'))
    exit("Pas d'accès direct aux scripts");

/**  @property Aauth $aauth
 *   @property CI_session $session
 */
class Logout extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library("Aauth");
    }

    public function index() {
        $this->load->library('form_validation');
        if ($this->form_validation->run()==false) {
            $data['title']='Déconnectez vous';
            $this->load->view('AppHeader',$data);
            $this->load->view('Logout');
            $this->load->view('AppFooter');
        }
    }

    public function endSession() {
        $this->aauth->logout();
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('login');
        $this->session->unset_userdata('groupe');
        $this->session->unset_userdata('iduser');
        redirect('home');
    }

}