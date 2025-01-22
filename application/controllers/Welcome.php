<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model("utilisateur");
    }

    public function index() {
        //$this->load->view('welcome_message');
        //if ($this->session->mon_id == '') {
        if(!$this->utilisateur->estConnectee()){
            $this->load->view('entete');
            $data = array("err_login" => "", "err_mdp" => "", "notif" => "");
            $this->load->view('utilisateurs/login', $data);
        } else {
            $this->load->model('utilisateur');
            $output["moi"] = $this->utilisateur->trouver($this->session->mon_id);
            $this->load->view('entete');
            $this->load->view('work_space',$output);
        }
    }

    public function loged() {
        //if ($this->session->mon_id == '') {
        if($this->utilisateur->estConnectee()){
            $this->load->view('entete');
            $this->load->view('work_space');
            //$this->load->view('utilisateurs/login');
        }
    }

}
