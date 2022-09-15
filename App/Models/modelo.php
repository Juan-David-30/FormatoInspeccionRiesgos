<?php
namespace App\Models;

use PDO; 

class modelo extends \Core\Model{
    public static function InsertInfo($Datos){
        extract($Datos);
        try {
            $db = static::getDB();

            //Validando existencia cabecera

            $consulta = $db->prepare("SELECT id FROM Informacion WHERE `Elaborado` = '$Elaborado' AND `Empresa` = '$Empresa' AND `Fecha` = '$fecha' limit 1");
            $consulta->execute();
            $resultado = $consulta->fetchAll();
            if(!$resultado){

            $sql = "INSERT INTO `Informacion` (`id`, `Elaborado`, `Empresa`, `Area`, `Fecha`) VALUES (NULL, '$Elaborado', '$Empresa', '$Area', '$fecha');"; 

            if($db->exec($sql)){

                $consulta = $db->prepare("SELECT id FROM Informacion WHERE `Elaborado` = '$Elaborado' AND `Empresa` = '$Empresa' AND `Fecha` = '$fecha' limit 1");
                $consulta->execute();
                $resultado = $consulta->fetchAll();
            } 
            return $resultado[0]["id"]; 
            }else{
                return $resultado[0]["id"]; 
            }
        } catch (\PDOException $th) {
            echo $th->getMessage();
        }
    }
    public static function InsertFuente($Datos){
        extract($Datos);
        $db = static::getDB();
        try {

            $idInfo = $_SESSION['InfoID']; 
            
            $sql = "INSERT INTO `Fuente` (`id_Fuen`, `id_CF`, `Descripcion`, `id_Info`) VALUES (NULL, '$CodRiesgo', '$FuentRiesgo',  $idInfo );"; 

            $db->exec($sql); 

            return true; 
        } catch (\PDOException $th) {
            echo $th->getMessage();
        }
    }
}