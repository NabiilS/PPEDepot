<?php

if (!defined('BASEPATH'))
    exit("Pas d'accès direct aux scripts");

/** @property EleveModel $eleveModel
 *  @property EnseignantModel $enseignantModel
 *  @property Aauth $aauth
 *  @property CI_session $session
 */
class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('aauth');
        $this->load->model('eleveModel');
        $this->load->model('enseignantModel');
        $this->create();
    }

    public function index() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('login', 'Login', 'trim|required|xss_clean|max_length[100]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_password');

        if ($this->form_validation->run()) {
            $userAuth = $this->aauth->get_user();
            $groupe = $this->getGroupe();
            $user = $this->getUser($groupe, $userAuth->id);
            $this->session->login = $userAuth->email;
            $this->session->groupe = $groupe;
            $this->session->iduser = $user['id'];
            $this->session->username = $user['prenom'] . ' ' . $user['nom'];
            redirect('Home');
        }
        else {
            $data['title'] = 'Connectez vous';
            $this->load->view('AppHeader', $data);
            $this->load->view('Login');
            $this->load->view('AppFooter');
        }
    }

    private function create() {
        $this->aauth->create_user('admin@sio.jjr.fr', 'siojjr');
        $this->aauth->add_member($this->aauth->get_user_id('admin@sio.jjr.fr'), 'Admin');
        $this->aauth->create_group('Elève');
        $this->aauth->create_group('Enseignant');
        // création enseignant pour tests
        $idEnseignant = $this->aauth->create_user('enseignant@sio.jjr.fr', 'siojjr');
        $this->aauth->add_member($idEnseignant, 'Enseignant');
        if ($this->enseignantModel->get_where('login', 'enseignant@sio.jjr.fr') == NULL) {
            $params = array(
                'nom' => 'enseignant test',
                'prenom' => 'test',
                'login' => 'enseignant@sio.jjr.fr',
                'idAuth' => $idEnseignant
            );
            $this->enseignantModel->add_enseignant($params);
        }
        // foreach ($this->aauth->list_groups() as $g) {
        //    echo $g->name;
        //    echo $g->definition."<br>";
        // }
    }

    function check_password($password) {
        $ok = FALSE;
        //on récupére le user
        $login = $this->input->post('login');
        if ($this->aauth->login($login, $password, true)) {
            $ok = TRUE;
        }
        else {
            $this->form_validation->set_message('check_password', 'login ou mot de passe invalides');
            $ok = FALSE;
        }
        return $ok;
    }

    private function getGroupe() {
        // pour notre application un user ne peut appartenir qu'à un seul groupe : {'admin','élève','enseignant','visiteur'}
        if ($this->aauth->is_member('Elève')) {
            $groupe = 'Elève';
        }
        else {
            if ($this->aauth->is_member('Enseignant')) {
                $groupe = 'Enseignant';
            }
            else {
                if ($this->aauth->is_member('Admin')) {
                    $groupe = 'Admin';
                }
                else {
                    $groupe = 'Visiteur';
                }
            }
        }
        return $groupe;
    }

    private function getUser($groupe, $idAuth) {
        switch ($groupe) {
            case 'Enseignant':
                $row = $this->enseignantModel->get_Where('idAuth', $idAuth);
                $user = array(
                    'id' => $row[0]['id'],
                    'nom' => $row[0]['nom'],
                    'prenom' => $row[0]['prenom']
                );
                break;
            case 'Elève':
                $row = $this->eleveModel->get_Where('idAuth', $idAuth);
                $user = array(
                    'id' => $row[0]['id'],
                    'nom' => $row[0]['nom'],
                    'prenom' => $row[0]['prenom']
                );
                break;
            default:
                $user = NULL;
                break;
        }
        return $user;
    }

}
