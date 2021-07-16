<?php
//controlador por defecto(config.php)

class Welcome{
    //método por defecto(config.php)
    public function index(){
        //carga la vista de portada
        include Find::view('general/portada'); //Carga la vista de portada
    }
}