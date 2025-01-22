<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Boosts extends CI_Model {

    private $_table = "promote";
    private $_id_groupe = 2;

    function get_id_groupe() {
        return $this->_id_groupe;
    }

    public function __construct() {
        $this->load->database();
        $this->load->model("pages");
        $this->load->model("clients");
        $this->_id_groupe = $this->session->mon_groupe;
    }

    private function ajoutdate($date, $jour) {
        $rep = $this->db->select('DATE_ADD(DATE_FORMAT( "' . $date . '", "%Y-%m-%dT%H:%i"), INTERVAL ' . $jour . ' DAY) DATE_FIN')
                        ->get()->result();
        return $rep[0];
    }

    private function verifierBoostTermier() {
        $this->db->set('STATUT', 6)->where(' DATE_FIN <= NOW() AND STATUT < 4 ');
        return $this->db->update($this->_table);
    }

    public function ajouter($id_page, $id_user, $budget, $jours, $statu, $paye, $depense, $date_debut
    , $tarif, $devise, $lien_fb) {

        $daty = $this->ajoutdate($date_debut, $jours)->DATE_FIN;

        $this->db->set('ID_PG', $id_page);
        $this->db->set('ID_USER', $id_user);
        $this->db->set('BUDGET', $budget);
        $this->db->set('JOURS', $jours);
        $this->db->set('LIEN', $lien_fb);
        $this->db->set('STATUT', $statu);
        $this->db->set('PAYEE', $paye);
        $this->db->set('MONTANT_DEPENSE', $depense);
        $this->db->set('DATE_DEBUT', $date_debut);
        $this->db->set('DATE_FIN', $daty);
        $this->db->set('TARIF_JOUR', $tarif);
        $this->db->set('DEVISE', $devise);

        return $this->db->insert($this->_table);
    }

    public function modifier($id, $id_page, $budget, $jours, $statu, $paye, $depense, $date_debut
    , $tarif, $devise, $lien_fb) {
        $daty = $this->ajoutdate($date_debut, $jours)->DATE_FIN;
        $this->db->set('ID_PG', $id_page);
        //$this->db->set('ID_USER', $id_user);
        $this->db->set('BUDGET', $budget);
        $this->db->set('JOURS', $jours);
        $this->db->set('LIEN', $lien_fb);
        $this->db->set('STATUT', $statu);
        $this->db->set('PAYEE', $paye);
        $this->db->set('MONTANT_DEPENSE', $depense);
        $this->db->set('DATE_DEBUT', $date_debut);
        $this->db->set('DATE_FIN', $daty);
        $this->db->set('TARIF_JOUR', $tarif);
        $this->db->set('DEVISE', $devise);
        $this->db->where('ID_PROMOTE', (int) $id);

        return $this->db->update($this->_table);
    }

    public function supprimer($id_boost) {
        return $this->db->where('ID_PROMOTE', (int) $id_boost)->delete($this->_table);
    }

    public function afficheUnePersonne($id_boost) {
        $res = NULL;
        $rep = $this->db->select('*')
                        ->from($this->_table . ' bt')
                        ->join($this->clients->get_table() . ' cl', 'cl.ID_CLIENT = bt.ID_CLIENT')
                        ->where('cl.ID_GROUPE', (int) $this->_id_groupe)
                        ->where('bt.ID_PROMOTE', (int) $id_boost)
                        ->get()->result();

        foreach ($rep as $ps) {

            $res = $ps;
        }

        return $res;
    }

    public function trouver($id_boost) {
        $res = NULL;
        $rep = $this->db->select('pg.*,cl.*,bst.ID_PROMOTE,  bst.ID_PG,  bst.ID_USER,  bst.BUDGET,  bst.JOURS,  '
                                . 'bst.STATUT,  bst.PAYEE,  bst.MONTANT_DEPENSE, DATE_FORMAT(bst.DATE_FIN, "%d/%m/%Y à %H:%i") DATE_FIN,  bst.TARIF_JOUR,'
                                . 'bst.PHOTO, bst.LIEN,  bst.DEVISE, DATE_FORMAT(DATE_DEBUT, "%Y-%m-%dT%H:%i") DATE_DEBUT')
                        ->from($this->_table . ' bst')
                        ->join($this->pages->get_table() . ' pg', 'pg.ID_PG = bst.ID_PG')
                        ->join($this->clients->get_table() . ' cl', 'cl.ID_CLIENT = pg.ID_CLIENT')
                        ->where('ID_PROMOTE', (int) $id_boost)
                        ->where('cl.ID_GROUPE', (int) $this->_id_groupe)
                        ->get()->result();

        foreach ($rep as $ps) {

            $res = $ps;
        }

        return $res;
    }

    public function lister1() {
//yyyy-MM-ddThh:mm

        return $this->db->select('pg.*,cl.*,bst.ID_PROMOTE,  bst.ID_PG,  bst.ID_USER,  bst.BUDGET,  bst.JOURS,  '
                                . 'bst.STATUT,  bst.PAYEE,  bst.MONTANT_DEPENSE, DATE_FORMAT(bst.DATE_FIN, "%d/%m/%Y à %H:%i") DATE_FIN,  bst.TARIF_JOUR,'
                                . 'bst.PHOTO, bst.LIEN,  bst.DEVISE, DATE_FORMAT(bst.DATE_DEBUT, "%d/%m/%Y à %H:%i") DATE_DEBUT')
                        ->from($this->_table . ' bst')
                        ->join($this->pages->get_table() . ' pg', 'pg.ID_PG = bst.ID_PG')
                        ->join($this->clients->get_table() . ' cl', 'cl.ID_CLIENT = pg.ID_CLIENT')
                        ->where('cl.ID_GROUPE', (int) $this->_id_groupe)
                        ->get()->result();
    }

//teste fonction    
    public function lister($query, $statut, $order, $paye, $date,$mes_boosts=null) {

        $this->verifierBoostTermier();
        
        $this->db->select('pg.*,cl.*,bst.ID_PROMOTE,  bst.ID_PG,  bst.ID_USER,  bst.BUDGET,  bst.JOURS, bst.DATE_DEBUT daty1,  '
                        . 'bst.STATUT,  bst.PAYEE,  bst.MONTANT_DEPENSE, DATE_FORMAT(bst.DATE_FIN, "%d/%m/%Y à %H:%i") DATE_FIN,  bst.TARIF_JOUR,'
                        . 'bst.PHOTO, bst.LIEN,  bst.DEVISE, DATE_FORMAT(bst.DATE_DEBUT, "%d/%m/%Y à %H:%i") DATE_DEBUT')
                ->from($this->_table . ' bst')
                ->join($this->pages->get_table() . ' pg', 'pg.ID_PG = bst.ID_PG')
                ->join($this->clients->get_table() . ' cl', 'cl.ID_CLIENT = pg.ID_CLIENT')
                ->where('cl.ID_GROUPE', (int) $this->_id_groupe);
        if ($query != '') {
            $this->db->where('CIBLE', $query);
        }
        if ($statut < 7) {
            $this->db->where('STATUT', $statut);
        }
        if (!empty($date)) {
            $this->db->like('DATE_DEBUT', substr($date, 0, 10));
        }
        if ($paye < 2) {
            $this->db->where('PAYEE', $paye);
        }
        if ($mes_boosts != null) {
            $this->db->where('ID_USER', $mes_boosts);
        }
        if ($order != 'TOUT') {
            $this->db->order_by($order, 'DESC');
        }else{
            $this->db->order_by('daty1', 'DESC');
        }
        return $this->db->get()->result();
    }

    public function liste($filtre) {

        return $this->db->select('*')
                        ->from($this->_table)
                        ->where('BUDGET', $filtre)
                        ->get()->result();
    }

}
