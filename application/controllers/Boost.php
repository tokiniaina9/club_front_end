<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Boost extends CI_Controller {

    
    
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function form_creer($id_boost) {
        $this->load->model("boosts");
        $this->load->model("pages");
        $this->load->model("clients");
        $data["un_boost"] = null;
        $data["un_page"] = null;
        $data["client"] = $this->clients->first_client();
        if ($id_boost != 0) {
            $data["un_boost"] = $this->boosts->trouver($id_boost);
            $data["un_page"] = $this->pages->trouver($data["un_boost"]->ID_PG);
        }
        $this->load->view('boost/form_boost', $data);
    }

    public function liste() {
        $output = '';
        $query = '';
        $this->load->model("boosts");
        if ($this->input->post('query')) {
            $query = $this->input->post('query');
        }

        $statut = $this->input->post('statut');
        $order = $this->input->post('group');
        $date = $this->input->post('date');
        $paye = $this->input->post('paye');
        $mes_boost = $this->input->post('mes_boosts');
        
        
        $data = $this->boosts->lister('', $statut, $order, $paye, $date,$mes_boost);
        if (sizeof($data) > 0) {
            
            foreach ($data as $bt) {
                $output = $output . '<tr class="lignes">
                                        <td>
                                            '.(($bt->LIEN=="") ? "" :' <a href="' . $bt->LIEN . '" target="_blank">').'
                                            <strong>' . substr($bt->NOM_PG, 0, 35)  . '</strong>
                                            <br>(' . substr($bt->NOM,0,35). ')
                                                '.(($bt->LIEN=="") ? "" :' </a>').'
                                        </td>
                                        <td class="text-center">
                                        Mt:<strong>' . $bt->TARIF_JOUR * $bt->BUDGET . 'Ar</strong>'
                                        . '<br>(' . $bt->BUDGET . '' . $bt->DEVISE . '/' . $bt->JOURS . 'j)</td>
                                        <td class="text-center"' . 
                                        (( $bt->STATUT == 0 ) ?"  style='color: blue'>En creation" : 
                                        (( $bt->STATUT == 2 ) ?"  style='color: green'>Activé" : 
                                        (($bt->STATUT == 1) ?   "style='color: orange'>en cours d'examen" :
                                        (($bt->STATUT == 4) ? "style='color: red'>bloqué" :
                                        (($bt->STATUT == 3) ? "style='color: black'>en pause" :
                                        (($bt->STATUT == 5) ? "style='color: red'>Rejeté" :
                                        (($bt->STATUT == 6) ? "style='color: black'>Terminé" :
                                        ""))))))) . '
                                        <br>' . ( ($bt->PAYEE == 0) ? '<Strong class="text-center" style="color:red">(Non payé)' : '<strong class="text-center" style="color: green;">(Payé)' ) . '</strong></td>
                                        <td class="text-center">
                                            ' . $bt->DATE_DEBUT . '
                                        <br><strong>(' . $bt->DATE_FIN . ')</strong>
                                        </td>
                                        <td class="text-center">
                                            <div class="dropdown">
                                            <button  class="btn btn-default fa fa-ellipsis-h dropdown-toggle" data-toggle="dropdown"></button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                              <li><button id_bt="' . $bt->ID_PROMOTE . '" class="btn_modif_bt btn-block btn btn-default glyphicon glyphicon-pencil"> Modifier</button></li>
                                              <li><button id_bt="' . $bt->ID_PROMOTE . '" class="btn_del_bt btn-block btn btn-default glyphicon glyphicon-trash"> Supprimer</button></li>
                                            </ul>
                                          </div>
                                        </td>
                                    </tr>';
            }
        } else {
            $output .= '<br><div class=" col-xs-8 text-center alert alert-info" style="margin:15% 15%;">'
                    . 'Aucun boost trouvé </div>';
        }
        echo $output;
    }

    public function sauver($id_article) {
        $this->load->model('boosts');

        $this->form_validation->set_rules('select_client', 'client', 'required|encode_php_tags');
        $this->form_validation->set_rules('select_page', 'page du client', 'required|encode_php_tags');
        $this->form_validation->set_rules('budget', 'budget', 'required|encode_php_tags');
        $this->form_validation->set_rules('jours', 'nombre de jour', 'required|encode_php_tags');
        $this->form_validation->set_rules('date_debut', 'date debut', 'required|encode_php_tags');
        $this->form_validation->set_rules('diffusion', 'diffusion', 'required|encode_php_tags');
        $this->form_validation->set_rules('devise', 'devise', 'required|encode_php_tags');

        $this->form_validation->set_rules('lien', 'lien sur facebook', 'encode_php_tags');
        $this->form_validation->set_rules('tarif', 'tarif', 'required|encode_php_tags');
        $this->form_validation->set_rules('paiement', 'paiement', 'encode_php_tags');
        $this->form_validation->set_rules('depense', 'depense', 'encode_php_tags');

        $select_page = $this->input->post('select_page');
        $lien_fb = $this->input->post('lien');
        $tarif = $this->input->post('tarif');
        $paye = $this->input->post('paiement');
        $budget = $this->input->post('budget');
        $jours = $this->input->post('jours');
        $depense = $this->input->post('depense');
        $date_debut = $this->input->post('date_debut');
        $diffusion = $this->input->post('diffusion');
        $devise = $this->input->post('devise');


        if ($this->form_validation->run()) {
            if ($id_article == 0) {
                $this->boosts->ajouter($select_page, $this->session->mon_id , $budget, $jours, $diffusion, $paye, $depense, $date_debut
                        , $tarif, $devise, $lien_fb);
            } else {
                $this->boosts->modifier($id_article, $select_page, $budget, $jours, $diffusion, $paye, $depense, $date_debut
                        , $tarif, $devise, $lien_fb);
            }

            $output = array('success' => TRUE,
                'statut' => '<br><div id="notif_art" class="alert alert-success text-center alert-dismissable">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            Mise à jour boost avec succès!</div>');
        } else {
            $output = array('success' => FALSE,
                'statut' => '<br><div id="notif_art" class="alert alert-danger text-center alert-dismissable">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            Désolé, echec de modification!</div>',
                'select_client_error' => form_error('select_client'),
                'select_page_error' => form_error('select_page'),
                'budget_error' => form_error('budget'),
                'jours_error' => form_error('jours'),
                'date_debut_error' => form_error('date_debut'),
                'diffusion_error' => form_error('diffusion'),
                'devise_error' => form_error('devise'),
                'tarif_error' => form_error('tarif')
            );
        }

        echo json_encode($output);
    }

}
