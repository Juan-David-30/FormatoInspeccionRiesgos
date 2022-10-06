<?php
namespace App\Models;

use PDO; 

class modelo extends \Core\Model{
/* 
----
-----
------Read o obteniendo información 
-----
----
*/
    public static function getDataEmpresas(){
        $db = static::getDB();
        //Consiguiendo datos necesarios para el select de empresas
        try {
            $consulta = $db->prepare("SELECT * FROM Empresa");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $th) {
            echo $th->getMessage();
        }
    }
    public static function getDataGrupFact(){
        $db = static::getDB();
        //Consiguiendo datos necesarios para el select de empresas
        try {
            $consulta = $db->prepare("SELECT * FROM GrupoFact");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $th) {
            echo $th->getMessage();
        }
    }
    public static function getDataCodFact(){
        $db = static::getDB();
        try {
            $consulta = $db->prepare("SELECT * FROM CodFact");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $th) {
            echo $th->getMessage();
        }
    }
    public static function getRegistros(){
        $db = static::getDB();
        try {
            //Consiguiendo todos los registros de la base de datos
            $consulta = $db->prepare("SELECT GF.Nombre GrupoFact, cod.Nombre CodFact, Fu.Descripcion, sec.NombreSec, PuestAf.Nombre, PuestAf.NumExp, PuestAf.P, PuestAf.E, PuestAf.C, PuestAf.Resultado, MI.Descripcion MiDescripcion, MI.Tipo MiTipo ,MR.Descripcion MrDescripcion, MR.Tipo MrTipo, Info.Empresa FROM Fuente Fu LEFT JOIN CodFact Cod ON cod.id_CF = Fu.id_CF LEFT JOIN GrupoFact GF ON GF.id_GF = Cod.id_GF INNER JOIN Informacion Info ON FU.id_Info = info.id LEFT JOIN Seccion sec ON Sec.id_Fuen = Fu.id_Fuen LEFT JOIN PuestosAfect PuestAf ON PuestAf.id_Puest = sec.id_Sec LEFT JOIN MetodoRecomendado MR ON MR.id_Puest = PuestAf.id_Puest LEFT JOIN MetodoInstalado MI ON MI.id_Puest = PuestAf.id_Puest;");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);

        } catch (\PDOException $th) {
            echo $th->getMessage();
        }
    }

/* 
----
-----
------Insert o Insertando información 
-----
----
*/
    public static function InsertInfo($Datos){
        extract($Datos);
        try {
            $db = static::getDB();

            //Validando existencia cabecera

            $consulta = $db->prepare("SELECT id FROM Informacion WHERE `Elaborado` = '$Elaborado' AND `Empresa` = '$Empresa' AND `Fecha` = '$fecha' limit 1");
            $consulta->execute();
            $resultado = $consulta->fetchAll();
            if(!isset($resultado[0])){
                //Si no existe insertamos una nueva 
                $sql = $db->prepare("INSERT INTO `Informacion` (`id`, `Elaborado`, `Empresa`,   `Area`, `Fecha`) VALUES (NULL, '$Elaborado', '$Empresa', '$Area', '$fecha');"); 

                if($sql->execute()){
                    //Si se ha insertado correctamente conseguimos su id

                    $consulta = $db->prepare("SELECT id FROM Informacion WHERE `Elaborado` = '$Elaborado' AND `Empresa` = '$Empresa' AND `Fecha` = '$fecha' limit 1");
                    $consulta->execute();
                    $resultado = $consulta->fetchAll();
                }
            //Retornamos el id
            return $resultado[0]["id"]; 

            }else{
                return $resultado[0]["id"]; 
            }
        } catch (\PDOException $th) {
            echo $th->getMessage().' Insert info';
        }
    }
    public static function InsertDatos($Datos, $idInfo){
        extract($Datos);
        $db = static::getDB();
        try {
            //Insertando fuente
            $fuente = $db->prepare("INSERT INTO `Fuente` (`id_Fuen`, `id_CF`, `Descripcion`, `id_Info`) VALUES (NULL, '$CodRiesgo', '$FuentRiesgo',  $idInfo );"); 
            $fuente->execute();

            //Consiguiendo Id de insersión
            $fuente = $db->prepare("SELECT id_Fuen FROM Fuente WHERE id_Fuen = (SELECT MAX(id_Fuen) FROM Fuente)"); 
            $fuente->execute();
            $idFuente = $fuente->fetchAll(PDO::FETCH_ASSOC);
            $idFuente = $idFuente[0]['id_Fuen'];

            //Insertando sección
            $seccion = $db->prepare("INSERT INTO Seccion VALUES (NULL, '$idFuente', '$SeccionAfect');");
            $seccion->execute();

            //Consiguiendo Id de insersión
            $seccion = $db->prepare("SELECT id_sec FROM Seccion WHERE id_Sec = (SELECT MAX(id_Sec) FROM Seccion)");
            $seccion->execute();
            $idSeccion = $seccion->fetchAll(PDO::FETCH_ASSOC);
            $idSeccion = $idSeccion[0]['id_sec'];

            //Insertando puestosAfect
            $Puestos = $db->prepare("INSERT INTO PuestosAfect VALUES (NULL, '$idSeccion', '$PuestAfect', '$NumExp', '$Probabilidad', '$Exposicion', '$Consecuencia', '$Resultado');");
            $Puestos->execute();

            //Consiguiendo Id de insersión
            $Puestos = $db->prepare("SELECT id_Puest FROM PuestosAfect WHERE id_Puest = (SELECT MAX(id_Puest) FROM PuestosAfect);");
            $Puestos->execute();
            $idpuest = $Puestos->fetchAll(PDO::FETCH_ASSOC);
            $idpuest = $idpuest[0]['id_Puest'];

            //Insertando método de control instalado
            $MetodoInst = $db->prepare("INSERT INTO `MetodoInstalado` (`idMetodo`, `Descripcion`, `Tipo`, `id_Puest`) VALUES (NULL, '$DescripcionMetodo', '$tipoMetodo', '$idpuest');");
            $MetodoInst->execute();

            //Insertando método de control recomendado
            $MetodoRec = $db->prepare("INSERT INTO `MetodoRecomendado` (`idMetodo`, `Descripcion`, `Tipo`, `id_Puest`) VALUES (NULL, '$DescripcionMetodoRec', '$tipoMetodoRec', '$idpuest');");
            $MetodoRec->execute();



        } catch (\PDOException $th) {
            $th->getMessage().' Error Insert';
        }
    }
}