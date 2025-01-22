<?php

class Utilisateur {
    private $_id_user;
    private $_groupe;
    private $_nom;
    private $_phone;
    private $_mdp;
    private $_login;
    private $_email;
    private $_photo;
    
    function __construct( $_groupe, $_nom, $_phone, $_mdp, $_login, $_email, $_photo) {
        $this->_groupe = $_groupe;
        $this->_nom = $_nom;
        $this->_phone = $_phone;
        $this->_mdp = $_mdp;
        $this->_login = $_login;
        $this->_email = $_email;
        $this->_photo = $_photo;
    }
    
    function get_id_user() {
        return $this->_id_user;
    }

    function get_groupe() {
        return $this->_groupe;
    }

    function get_nom() {
        return $this->_nom;
    }

    function get_phone() {
        return $this->_phone;
    }

    function get_mdp() {
        return $this->_mdp;
    }

    function get_login() {
        return $this->_login;
    }

    function get_email() {
        return $this->_email;
    }

    function get_photo() {
        return $this->_photo;
    }

    function set_id_user($_id_user) {
        $this->_id_user = $_id_user;
    }

    function set_groupe( $_groupe) {
        $this->_groupe = $_groupe;
    }

    function set_nom($_nom) {
        $this->_nom = $_nom;
    }

    function set_phone($_phone) {
        $this->_phone = $_phone;
    }

    function set_mdp($_mdp) {
        $this->_mdp = $_mdp;
    }

    function set_login($_login) {
        $this->_login = $_login;
    }

    function set_email($_email) {
        $this->_email = $_email;
    }

    function set_photo($_photo) {
        $this->_photo = $_photo;
    }


    function equal(Utilisateur $u){
        return $u->get_email() == $this->get_email() && $u->get_groupe() == $this->get_groupe()
                && $u->get_id_user() == $this->get_id_user() && $u->get_login() == $this->get_login()
                && $u->get_mdp() == $this->get_mdp() && $u->get_nom() == $this->get_nom() 
                && $u->get_phone() == $this->get_phone() && $u->get_photo() == $this->get_photo();
    }
}
