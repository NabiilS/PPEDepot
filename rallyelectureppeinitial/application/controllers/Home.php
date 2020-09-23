<?php

/** @property Menu $Menu
 *  @property CI_Session $session
 */
class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Menu');
    }

    public function Index() {
        // par défaut toute personne accédant au site fait partie du groupe visiteur
        // on teste si la variable de session existe
        if ($this->session->groupe) {
            $groupe=$this->session->groupe;
        }
        else {
            $groupe='Visiteur';
            $this->session->groupe=$groupe;
        }
        // on charge 'ente et la page d'accueil
        $data['title']='rallye lecture';
        $this->load->view('AppHeader',$data);
        // le menu est conditionné par le groupe.
        $data['options']=$this->Menu->GetOptions($groupe);
        $this->load->view('Menu',$data);
        $this->load->view('AppFooter');
    }

    public function NotFound() {
        header("HTTP/1.1 404 Not Found");
        $data['heading']='Error';
        $data['message']='404 not found';
        $this->load->view('error_404',$data);
    }

}