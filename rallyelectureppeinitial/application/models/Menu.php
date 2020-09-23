<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function GetOptions($group) {
        switch ($group) {
            // en fonction du groupe on retourn le menu correspondant
            // structure {'Controleur','méthode','libellé)
            case 'Admin':
                return array(
                    array('Auteur','Index','Auteur'),
                    array('Editeur','Index','Editeur'),
                    array('Livre','Index','Livre'),
                    array('','','#'),
                    array('Enseignant','Index','Enseignant'),
                    array('Niveau','Index','Niveau'),
                    array('Classe','Index','Classe'),
                    array('Eleve','Index','Eleve'),
                    array('','','#'),
                    array('Rallye','Index','Rallye'),
                    array('Participer','Index','Participer'),
                    array('Comporter','Index','Comporter'),
                    array('','','#'),
                    array('Question','Index','Question'),
                    array('Proposition','Index','Proposition'),
                    array('Reponse','Index','Reponse'),
                    array('','','#'),
                    array('Login','Index','Login'),
                    array('Logout','Index','Logout'),
                    array('PhpInfo','Index','PhpInfo')
                );
            case 'Enseignant':
                return array(
                    array('EnseignantClasse','Index','Mes Classes'),
                    array('EnseignantLivre','Index','La Bibliothèque'),
                    array('EnseignantRallye','Index','Les Rallyes'),
                    array('TableauBord','Index','Tableau de Bord'),
                    array('Login','Index','Login'),
                    array('Logout','Index','Logout')
                );
            case 'Elève':
                return array(
                    array('RallyeEleve','Index','Tes Rallyes'),
                    array('Login','Index','Login'),
                    array('Logout','Index','Logout')
                );
            default: // Visiteur (la plus restrictive) 
                return array(
                    array('Login','Index','Login')
                );
        }
    }

}