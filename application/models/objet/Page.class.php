<?php
class Page {
    private $id_page;
    private $_client;
    private $_nom_page;
    private $_lien;
    private $_photo;
    
    function __construct( $_client, $_nom_page, $_lien, $_photo) {
        $this->_client = $_client;
        $this->_nom_page = $_nom_page;
        $this->_lien = $_lien;
        $this->_photo = $_photo;
    }
    
    function getId_page() {
        return $this->id_page;
    }

    function get_client() {
        return $this->_client;
    }

    function get_nom_page() {
        return $this->_nom_page;
    }

    function get_lien() {
        return $this->_lien;
    }

    function get_photo() {
        return $this->_photo;
    }

    function setId_page($id_page) {
        $this->id_page = $id_page;
    }

    function set_client( $_client) {
        $this->_client = $_client;
    }

    function set_nom_page($_nom_page) {
        $this->_nom_page = $_nom_page;
    }

    function set_lien($_lien) {
        $this->_lien = $_lien;
    }

    function set_photo($_photo) {
        $this->_photo = $_photo;
    }

    function equal(Page $p){
        return $p->getId_page() == $this->getId_page() && $p->get_client() == $this->get_client()
                && $p->get_lien() == $this->get_lien() && $p->get_nom_page() == $this->get_nom_page()
                && $p->get_photo() == $this->get_photo();
    }

}
