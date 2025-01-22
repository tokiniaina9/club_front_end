<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Outils extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function form_suppr($cible, $ref_cl) {
        $data["cible"] = $cible;
        $data["objet"] = $ref_cl;
        $this->load->view('notif/suppr', $data);
    }

    public function supprimer() {
        $output = null;
        if ($this->session->mon_id == null) {
            $output = array("success" => FALSE,
                        "statut" => "page non supprimée");
           // redirect(base_url());
        } else {
            $cible = $this->input->post('cbl');
            $objet = $this->input->post('obj');
            switch ($cible) {
                case '0':
                    $this->load->model("boosts");
                    $this->boosts->supprimer($objet);
                    $output = array("success" => TRUE,
                        "statut" => "Boost supprimé");
                    break;
                case '1':
                    $this->load->model("clients");
                    $this->clients->supprimer($objet);
                    $output = array("success" => TRUE,
                        "statut" => "client supprimé");
                    break;
                case '2':
                    $this->load->model("pages");
                    $this->pages->supprimer($objet);
                    $output = array("success" => TRUE,
                        "statut" => "page supprimée");
                    break;
            }
        }
        echo json_encode($output);
    }

}
