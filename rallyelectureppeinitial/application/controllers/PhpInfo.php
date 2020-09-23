<?php

class PhpInfo extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function Index() {
        $this->load->view('AppHeader');
        $this->load->view('PhpInfo');
        $this->load->view('AppFooter');
    }

}