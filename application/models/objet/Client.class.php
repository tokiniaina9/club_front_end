<?php

class Client {
    private $_id_client;
    private $_groupe;
    private $_nom;
    private $_phone;
    private $_lien_fb;
    private $_photo;
    
    function __construct($_groupe, $_nom, $_phone, $_lien_fb, $_photo) {
        $this->_groupe = $_groupe;
        $this->_nom = $_nom;
        $this->_phone = $_phone;
        $this->_lien_fb = $_lien_fb;
        $this->_photo = $_photo;
    }

    function get_id_client() {
        return $this->_id_client;
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

    function get_lien_fb() {
        return $this->_lien_fb;
    }

    function get_photo() {
        return $this->_photo;
    }

    function set_id_client($_id_client) {
        $this->_id_client = $_id_client;
    }

    function set_groupe($_groupe) {
        $this->_groupe = $_groupe;
    }

    function set_nom($_nom) {
        $this->_nom = $_nom;
    }

    function set_phone($_phone) {
        $this->_phone = $_phone;
    }

    function set_lien_fb($_lien_fb) {
        $this->_lien_fb = $_lien_fb;
    }

    function set_photo($_photo) {
        $this->_photo = $_photo;
    }
    public function equal(Client $c){
        return $c->get_groupe() == $this->get_groupe() && $c->get_id_client() == $this->get_id_client()
                && $c->get_lien_fb() == $this->get_lien_fb() && $c->get_nom() == $this->get_nom()
                && $c->get_phone() == $this->get_phone() && $c->get_photo() == $this->get_photo();
    }

}

