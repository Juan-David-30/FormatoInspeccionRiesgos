<?php
namespace App\Controllers;
use \Core\View;
use \App\Models\modelo;

class Home extends \Core\Controller{
    public function index() {
        //Retornando index con información necesaria para los select de la base de datos
        $empresas = modelo::getDataEmpresas();
        $grupoFact = modelo::getDataGrupFact();
        $codigoFact = modelo::getDataCodFact();
        View::renderTemplate('FormatoInspección.twig', 
            [
                'empresas' => $empresas, 
                'grupoFact' => $grupoFact,
                'codigoFact' => $codigoFact
            ]
        ); 
    }
    public function insert(){
        //Insertando cabecera
        $InfoID = modelo::InsertInfo($_POST);
        //Validando cabecera existe
        if($InfoID){
            //Insertando el resto de datos
            modelo::InsertDatos($_POST, $InfoID);
            View::renderTemplate('VisualizacionRegistros.html');
        }
    }
    public function Datos(){
        View::renderTemplate('VisualizacionRegistros.html');
    }
}