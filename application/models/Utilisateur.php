<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Utilisateur extends CI_Model {

    private $_table = "user";
    private $_id_groupe = 1;

    function get_table() {
        return $this->_table;
    }

    public function __construct() {
        $this->load->database();
        $this->_id_groupe = $this->session->mon_groupe;
    }

    private function encriptMdp($mdp) {
        $rep = $this->db->select('MD5("Gestion_publicite_facebook_v_1.0#mot_de_passe##' . $mdp . '##amuser$$vous$$bien!!!") MDP')
                        ->get()->result();
        return $rep[0];
    }

    public function estConnectee() {
        if (!empty($this->session->mon_id)) {
            $izaho = $this->trouver($this->session->mon_id);
            return ($izaho->MDP == $this->session->mdp && $izaho->ID_USER == $this->session->mon_id);
        } else {
            return false;
        }
    }

    public function authentifier($login, $mdp) {
        $pwd = $this->encriptMdp($mdp)->MDP;
        $res = null;
        $rep = $this->db->select('ID_USER,  ID_GROUPE, NOM,MDP, PHONE, LOGIN,  EMAIL, PHOTO')
                        ->from($this->_table)
                        ->where('LOGIN', $login)
                        ->where('MDP', $pwd)
                        ->get()->result();

        foreach ($rep as $ps) {

            $res = $ps;
        }

        return $res;
    }

    public function trouver($id_personne) {

        $res = null;
        $rep = $this->db->select('*')
                        ->from($this->_table)
                        ->where('ID_USER', (int) $id_personne)
                        ->where('ID_GROUPE', (int) $this->_id_groupe)
                        ->get()->result();

        foreach ($rep as $ps) {

            $res = $ps;
        }

        return $res;
    }

}
