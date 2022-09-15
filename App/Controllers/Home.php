<?php
namespace App\Controllers;
use \Core\View;
use \App\Models\modelo;

class Home extends \Core\Controller{
    public function index() {
        View::renderTemplate('FormatoInspección.html'); 
    }
    public function insert(){
        //var_dump(modelo::InsertInfo($_POST));
        $InfoID = modelo::InsertInfo($_POST);
        if($InfoID){
            session_start();
            $_SESSION['InfoID'] = $InfoID;
            View::renderTemplate('InsercionCorrecta.html');
            modelo::InsertFuente($_POST);
        }
    }
}