<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function login1() {
        $this->load->model('Utilisateur');

        $this->form_validation->set_rules('login', 'Champ login', 'required|encode_php_tags');
        $this->form_validation->set_rules('mdp', 'Mot de passe', 'required|encode_php_tags');

        $login = $this->input->post('login');
        $mdp = $this->input->post('mdp');

        if ($this->form_validation->run()) {
            $moi = $this->Utilisateur->authentifier($login, $mdp);
            if ($moi != null) {
                $output = array('success' => TRUE,
                    'statut' => '<br><div id="notif_art" class="alert alert-success text-center alert-dismissable">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            Bienvenue!</div>');
                $this->load->view('login');
                $this->load->view('work_space');
            } else {
                $output = array('success' => FALSE,
                    'statut' => '<br><div id="notif_art" class="alert alert-danger text-center alert-dismissable">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            Désolé, accès refusé!</div>'
                );
            }
        } else {
            $output = array('success' => FALSE,
                'statut' => '<br><div id="notif_art" class="alert alert-danger text-center alert-dismissable">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            Verifier les champs!</div>',
                'login_error' => form_error('login'),
                'mdp_error' => form_error('mdp')
            );
        }

        echo json_encode($output);
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect(base_url());
    }

    public function login() {
        if ($this->session->mon_id == '') {

            $this->load->model('Utilisateur');

            $this->form_validation->set_rules('login', 'Champ login', 'required|encode_php_tags');
            $this->form_validation->set_rules('mdp', 'Mot de passe', 'required|encode_php_tags');

            $login = $this->input->post('login');
            $mdp = $this->input->post('mdp');

            if ($this->form_validation->run()) {
                $moi = $this->Utilisateur->authentifier($login, $mdp);
                if ($moi != null) {
                    $this->session->set_userdata('mon_id', $moi->ID_USER);
                    $this->session->set_userdata('mon_groupe', $moi->ID_GROUPE);
                    $this->session->set_userdata('mon_nom', $moi->NOM);
                    $this->session->set_userdata('mon_login', $moi->LOGIN);
                    $this->session->set_userdata('mdp', $moi->MDP);

                    redirect(base_url());
                } else {

                    $this->load->view('entete');
                    $data = array("err_login" => "", "err_mdp" => "",
                        "notif" => '<br><div id="notif_art" class="alert alert-danger text-center alert-dismissable">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            Désolé, accès refusé!</div>');
                    $this->load->view('utilisateurs/login', $data);
                }
            } else {
                $this->load->view('entete');
                $data = array("err_login" => form_error('login'), "err_mdp" => form_error('mdp'),
                    "notif" => '<br><div id="notif_art" class="alert alert-danger text-center alert-dismissable">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            Verifier les champs!</div>');
                $this->load->view('utilisateurs/login', $data);
            }
        } else {
            redirect(base_url());
        }
    }
    
    public function mes_info() {
        $this->load->model('utilisateur');
        $output["moi"] = $this->utilisateur->trouver( $this->session->mon_id);
        echo json_encode($output);
    }

}
