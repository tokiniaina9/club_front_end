<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Clients extends CI_Model {

    private $_table = "client";
    private $_id_groupe = 2;

    function get_table() {
        return $this->_table;
    }

    function get_id_groupe() {
        return $this->_id_groupe;
    }

    public function __construct() {
        $this->load->database();
        $this->_id_groupe = $this->session->mon_groupe;
    }

    public function ajouter($id_groupe, $nom, $phone, $lien_fb) {
        $this->db->set('ID_GROUPE', $id_groupe);

        $this->db->set('NOM', $nom);

        $this->db->set('PHONE', $phone);

        $this->db->set('LIEN_FB', $lien_fb);
        return $this->db->insert($this->_table);
    }

    public function modifier($id, $id_groupe, $nom, $phone, $lien_fb) {
        $this->db->set('ID_GROUPE', $id_groupe);
        $this->db->set('NOM', $nom);
        $this->db->set('PHONE', $phone);
        $this->db->set('LIEN_FB', $lien_fb);
        $this->db->where('ID_CLIENT', (int) $id);
        return $this->db->update($this->_table);
    }

    public function supprimer($id_personne) {
        return $this->db->where('ID_CLIENT', (int) $id_personne)->delete($this->_table);
    }

    public function trouver($id_personne) {
        $res = NULL;
        $rep = $this->db->select('*')
                        ->from($this->_table)
                        ->where('ID_CLIENT', (int) $id_personne)
                        ->where('ID_GROUPE', (int) $this->_id_groupe)
                        ->get()->result();

        foreach ($rep as $ps) {

            $res = $ps;
        }

        return $res;
    }

    public function first_client() {
        $res = NULL;
        $rep = $this->db->select('*')
                        ->from($this->_table)
                        ->where('ID_GROUPE', (int) $this->_id_groupe)
                        ->limit(1)
                        ->order_by('NOM', 'acs')
                        ->get()->result();

        foreach ($rep as $ps) {

            $res = $ps;
        }

        return $res;
    }

    public function lister() {

        return $this->db->select('*')
                        ->from($this->_table)
                        ->where('ID_GROUPE', (int) $this->_id_groupe)
                        ->order_by('NOM', 'acs')
                        ->get()->result();
    }

    public function liste($filtre) {

        return $this->db->select('*')
                        ->from($this->_table)
                        ->where('NOM', $filtre)
                        ->where('ID_GROUPE', (int) $this->_id_groupe)
                        ->order_by('NOM', 'acs')
                        ->get()->result();
    }

}
