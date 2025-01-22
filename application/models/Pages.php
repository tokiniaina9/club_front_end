<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Model {

    private $_table = "pg";
    private $_id_groupe = 2;

    function get_id_groupe() {
        return $this->_id_groupe;
    }

    function get_table() {
        return $this->_table;
    }

    public function __construct() {
        $this->load->database();
        $this->load->model("clients");
        $this->_id_groupe = $this->session->mon_groupe;
    }

    public function ajouter($id_client, $nom, $lien_fb) {
        $this->db->set('ID_CLIENT', $id_client);

        $this->db->set('NOM_PG', $nom);

        $this->db->set('LIEN', $lien_fb);

        return $this->db->insert($this->_table);
    }

    public function modifier($id, $id_client, $nom, $lien_fb) {
        $this->db->set('ID_CLIENT', $id_client);

        $this->db->set('NOM_PG', $nom);

        $this->db->set('LIEN', $lien_fb);

        $this->db->where('ID_PG', (int) $id);

        return $this->db->update($this->_table);
    }

    public function supprimer($id_personne) {
        return $this->db->where('ID_PG', (int) $id_personne)->delete($this->_table);
    }

    public function lister() {

        return $this->db->select('*')
                        ->from($this->_table . ' pg')
                        ->join($this->clients->get_table() . ' cl', 'cl.ID_CLIENT = pg.ID_CLIENT')
                        ->where('cl.ID_GROUPE', (int) $this->_id_groupe)
                        ->order_by('NOM_PG', 'acs')
                        ->get()->result();
    }

    public function trouver($id_page) {

        $rep = $this->db->select('*')
                        ->from($this->_table . ' pg')
                        ->join($this->clients->get_table() . ' cl', 'cl.ID_CLIENT = pg.ID_CLIENT')
                        ->where('cl.ID_GROUPE', (int) $this->_id_groupe)
                        ->where('pg.ID_PG', (int) $id_page)
                        ->get()->result();

        $res = null;
        foreach ($rep as $ps) {

            $res = $ps;
        }

        return $res;
    }

    public function liste($filtre) {

        return $this->db->select('*')
                        ->from($this->_table)
                        ->where('NOM_PG', $filtre)
                        ->order_by('NOM_PG', 'acs')
                        ->get()->result();
    }

    public function liste_par_client($id_cli) {

        return $this->db->select('*')
                        ->from($this->_table . ' pg')
                        ->join($this->clients->get_table() . ' cl', 'cl.ID_CLIENT = pg.ID_CLIENT')
                        ->where('cl.ID_GROUPE', (int) $this->_id_groupe)
                        ->where('cl.ID_CLIENT', $id_cli)
                        ->order_by('NOM_PG', 'acs')
                        ->get()->result();
    }

}
