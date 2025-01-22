<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function form_creer($ref_cl) {
        $this->load->model("clients");
        $data["un_client"] = null;
        if ($ref_cl != 0) {
            $data["un_client"] = $this->clients->trouver($ref_cl);
        }
        $this->load->view('client/form_client', $data);
    }

    public function listJson() {
        $data = array();
        $query = '';
        $this->load->model("clients");
        if ($this->input->post('query')) {
            $query = $this->input->post('query');
        }

        $cls = $this->clients->lister();

        if (sizeof($cls) > 0) {
            foreach ($cls as $cl) {
                array_push($data, array("id_client" => $cl->ID_CLIENT,
                    "nom_client" => $cl->NOM));
            }
        }
        echo json_encode($data);
    }

    public function remplirCombo($ref_cl) {
        $data = '';
        $query = '';
        $this->load->model("clients");
        if ($this->input->post('query')) {
            $query = $this->input->post('query');
        }

        $cls = $this->clients->lister();

        if (sizeof($cls) > 0) {
            foreach ($cls as $cl) {

                if ($ref_cl == $cl->ID_CLIENT && $ref_cl != 0) {
                    $data = $data . '<option value="' . $cl->ID_CLIENT . '" pr="'.$cl->PRIX.'" selected >' . $cl->NOM . '</option>';
                } else {
                    $data = $data . '<option value="' . $cl->ID_CLIENT . '" pr="'.$cl->PRIX.'" >' . $cl->NOM . '</option>';
                }
            }
        }
        echo $data;
    }

    public function liste() {
        $output = '';
        $query = '';
        $this->load->model("clients");
        if ($this->input->post('query')) {
            $query = $this->input->post('query');
        }

        $data = $this->clients->lister();
        if (sizeof($data) > 0) {
            foreach ($data as $cl) {
                $output = $output . '<tr>
                                        <td><strong>' . $cl->NOM . '</strong><br> (' . $cl->PHONE . ')</td>
                                      
                                        <td class="text-center">
                                            <div class="dropdown">
                                            <button  class="btn btn-default fa fa-ellipsis-h dropdown-toggle" data-toggle="dropdown"></button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                              <li><button id_cl="' . $cl->ID_CLIENT . '" class="btn_modif_cl  btn-block btn btn-default glyphicon glyphicon-pencil"> Modifier</button></li>
                                              <li><button id_cl="' . $cl->ID_CLIENT . '" class="btn_del_cl btn-block btn btn-default glyphicon glyphicon-trash"> Supprimer</button></li>
                                            </ul>
                                          </div>
                                        </td>
                                    </tr>';
            }
        } else {
            $output .= '<br><div class=" col-xs-8 text-center alert alert-info" style="margin:15% 15%;">'
                    . 'Aucun client trouvé </div>';
        }
        echo $output;
    }

    public function sauver($id_article) {
        $this->load->model('clients');

        $this->form_validation->set_rules('nom', 'Nom du client', 'required|encode_php_tags');
        $this->form_validation->set_rules('phone', 'Téléphone du client', 'numeric|max_length[10]|min_length[9]|encode_php_tags');

        $nom = $this->input->post('nom');
        $id_groupe = $this->session->mon_groupe;
        $phone = $this->input->post('phone');
        $lien = $this->input->post('lien');

        if ($this->form_validation->run()) {
            if ($id_article == 0) {
                $this->clients->ajouter($id_groupe, $nom, $phone, $lien);
            } else {
                $this->clients->modifier($id_article, $id_groupe, $nom, $phone, $lien);
            }

            $output = array('success' => TRUE,
                'statut' => '<br><div id="notif_art" class="alert alert-success text-center alert-dismissable">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            Mise à jour client avec succès!</div>');
        } else {
            $output = array('success' => FALSE,
                'statut' => '<br><div id="notif_art" class="alert alert-danger text-center alert-dismissable">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            Désolé, echec de modification!</div>',
                'nom_error' => form_error('nom'),
                'phone_error' => form_error('phone')
            );
        }

        echo json_encode($output);
    }

}
