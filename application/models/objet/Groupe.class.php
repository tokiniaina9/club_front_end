<?php

class Groupe {
    private $_id_groupe;
    private $_nom_groupe;
    private $_photo;
    
    function get_id_groupe() {
        return $this->_id_groupe;
    }

    function get_nom_groupe() {
        return $this->_nom_groupe;
    }

    function get_photo() {
        return $this->_photo;
    }

    function set_id_groupe($_id_groupe) {
        $this->_id_groupe = $_id_groupe;
    }

    function set_nom_groupe($_nom_groupe) {
        $this->_nom_groupe = $_nom_groupe;
    }

    function set_photo($_photo) {
        $this->_photo = $_photo;
    }

    function __construct($_id_groupe, $_nom_groupe, $_photo) {
        $this->_id_groupe = $_id_groupe;
        $this->_nom_groupe = $_nom_groupe;
        $this->_photo = $_photo;
    }
    
    function equal( Groupe $groupe){
        return $groupe->get_nom_groupe() == $this->get_nom_groupe() && $groupe->get_photo()== $this->get_photo();
    }
}
