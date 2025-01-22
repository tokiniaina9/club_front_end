<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function form_creer($id_page) {
         $this->load->model("pages");
        $data["une_page"] = null;
        if ($id_page != 0) {
            $data["une_page"] = $this->pages->trouver($id_page);
        }
        $this->load->view('pages/form_page',$data);
    }

     public function remplirCombo($id_client,$id_pg = 0) {
        $data = '';
        $query = '';
        $this->load->model("pages");
        if ($this->input->post('query')) {
            $query = $this->input->post('query');
        }

        $cls = $this->pages->liste_par_client($id_client);

        if (sizeof($cls) > 0) {
            foreach ($cls as $cl) {
                if($cl->ID_PG == $id_pg && $id_pg != 0){
                    $data = $data .'<option value="'.$cl->ID_PG.'" selected >'.$cl->NOM_PG.'</option>';
                }else{
                    $data = $data .'<option value="'.$cl->ID_PG.'">'.$cl->NOM_PG.'</option>';
                }
                
            }
        } 
        echo $data;
    }
    
      public function listeParClient($id_client) {
        $output = '';
        $query = '';
        $this->load->model("pages");
        if ($this->input->post('query')) {
            $query = $this->input->post('query');
        }

        $data = $this->pages->liste_par_client($id_client);
        if (sizeof($data) > 0) {
            foreach ($data as $pg) {
                $output = $output . '<tr>
                                        <td>'.(($pg->LIEN=="") ? $pg->NOM_PG :' <a href="' . $pg->LIEN . '" target="_blank">' . $pg->NOM_PG) . '</a></td> 
                                    </tr>';
            }
        } else {
            $output .= '<br><div class=" col-xs-8 text-center alert alert-info" style="margin:0 15%;" >'
                    . 'Aucune page trouvée  </div>';
        }
        echo $output;
    }
    
    public function liste() {
        $output = '';
        $query = '';
        $this->load->model("pages");
        if ($this->input->post('query')) {
            $query = $this->input->post('query');
        }

        $data = $this->pages->lister();
        if (sizeof($data) > 0) {
            foreach ($data as $pg) {
                $output = $output . '<tr>
                                        <td>
                                            <strong>
                                                '.(($pg->LIEN=="") ? $pg->NOM_PG :' <a href="' . $pg->LIEN . '" target="_blank">' . $pg->NOM_PG) . '
                                            </strong>
                                            <br>(' . $pg->NOM . ')</a>
                                        </td>
                                        <td class="text-center">
                                            <div class="dropdown">
                                            <button  class="btn btn-default fa fa-ellipsis-h dropdown-toggle" data-toggle="dropdown"></button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                              <li><button id_pg="' . $pg->ID_PG . '" class="btn_modif_pg  btn-block btn btn-default glyphicon glyphicon-pencil"> Modifier</button></li>
                                              <li><button id_pg="' . $pg->ID_PG . '" class="btn_del_pg btn-block btn btn-default glyphicon glyphicon-trash"> Supprimer</button></li>
                                            </ul>
                                          </div>
                                        </td>
                                    </tr>';
            }
        } else {
            $output .= '<br><div class=" col-xs-8 text-center alert alert-info" style="margin:15% 15%;">'
                    . 'Aucune page trouvée </div>';
        }
        echo $output;
    }

     public function sauver($id_page) {
        $this->load->model('pages');

        $this->form_validation->set_rules('nom_page', 'Nom de la page', 'required|encode_php_tags');

        $nom = $this->input->post('nom_page');
        $id_groupe = 1;
        $id_client = $this->input->post('select_client');
        $lien = $this->input->post('lien_page');

        if ($this->form_validation->run()) {
            if ($id_page == 0) {
                $this->pages->ajouter($id_client, $nom, $lien);
            } else {
                $this->pages->modifier($id_page, $id_client, $nom, $lien);
            }

            $output = array('success' => TRUE,
                'statut' => '<br><div id="notif_art" class="alert alert-success text-center alert-dismissable">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            Mise à jour page avec succès!</div>');
        } else {
            $output = array('success' => FALSE,
                'statut' => '<br><div id="notif_art" class="alert alert-danger text-center alert-dismissable">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            Désolé, echec de modification!</div>',
                'nom_error' => form_error('nom_page')
            );
        }

        echo json_encode($output);
    }
}
