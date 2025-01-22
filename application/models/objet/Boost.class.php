<?php
require 'Page.class.php';
class Boost {
    private $_id_boost;
    private $_page;
    private $_user;
    private $_budget;
    private $_nbr_jours;
    private $_statut;
    private $_payee;
    private $_montant_depensee;
    private $_date_debut;
    private $_date_fin;
    private $_tarif_jour;
    private $_photo;
    private $_lien;
    
    function __construct( $_page,  $_user, $_budget, $_nbr_jours, $_statut, $_payee, $_montant_depensee, $_date_debut, $_date_fin, $_tarif_jour, $_photo, $_lien) {
        $this->_page = $_page;
        $this->_user = $_user;
        $this->_budget = $_budget;
        $this->_nbr_jours = $_nbr_jours;
        $this->_statut = $_statut;
        $this->_payee = $_payee;
        $this->_montant_depensee = $_montant_depensee;
        $this->_date_debut = $_date_debut;
        $this->_date_fin = $_date_fin;
        $this->_tarif_jour = $_tarif_jour;
        $this->_photo = $_photo;
        $this->_lien = $_lien;
    }

    function get_id_boost() {
        return $this->_id_boost;
    }

    function get_page() {
        return $this->_page;
    }

    function get_user() {
        return $this->_user;
    }

    function get_budget() {
        return $this->_budget;
    }

    function get_nbr_jours() {
        return $this->_nbr_jours;
    }

    function get_statut() {
        return $this->_statut;
    }

    function get_payee() {
        return $this->_payee;
    }

    function get_montant_depensee() {
        return $this->_montant_depensee;
    }

    function get_date_debut() {
        return $this->_date_debut;
    }

    function get_date_fin() {
        return $this->_date_fin;
    }

    function get_tarif_jour() {
        return $this->_tarif_jour;
    }

    function get_photo() {
        return $this->_photo;
    }

    function get_lien() {
        return $this->_lien;
    }

    function set_id_boost($_id_boost) {
        $this->_id_boost = $_id_boost;
    }

    function set_page( $_page) {
        $this->_page = $_page;
    }

    function set_user( $_user) {
        $this->_user = $_user;
    }

    function set_budget($_budget) {
        $this->_budget = $_budget;
    }

    function set_nbr_jours($_nbr_jours) {
        $this->_nbr_jours = $_nbr_jours;
    }

    function set_statut($_statut) {
        $this->_statut = $_statut;
    }

    function set_payee($_payee) {
        $this->_payee = $_payee;
    }

    function set_montant_depensee($_montant_depensee) {
        $this->_montant_depensee = $_montant_depensee;
    }

    function set_date_debut($_date_debut) {
        $this->_date_debut = $_date_debut;
    }

    function set_date_fin($_date_fin) {
        $this->_date_fin = $_date_fin;
    }

    function set_tarif_jour($_tarif_jour) {
        $this->_tarif_jour = $_tarif_jour;
    }

    function set_photo($_photo) {
        $this->_photo = $_photo;
    }

    function set_lien($_lien) {
        $this->_lien = $_lien;
    }

    function equal(Boost $b){
        return $b->get_budget() == $this->get_budget() && $b->get_date_debut() == $this->get_date_debut()
                && $b->get_date_fin() == $this->get_date_fin() && $b->get_id_boost() == $this->get_id_boost()
                && $b->get_lien() == $this->get_lien() && $b->get_montant_depensee() == $this->get_montant_depensee()
                && $b->get_nbr_jours() == $this->get_nbr_jours() && $b->get_page() == $this->get_page()
                && $b->get_payee() == $this->get_payee() && $b->get_photo() == $this->get_photo()
                && $b->get_statut() == $this->get_statut() && $b->_tarif_jour == $this->get_tarif_jour()
                && $b->get_user() == $this->get_user();
    }
    
}

