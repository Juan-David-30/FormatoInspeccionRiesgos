<?php 
namespace Core; 
use PDO; 
use App\Config;

abstract class Model {
    protected static function getDB() {
        $db = null; 
        if ($db === null){
            
            $DB_conect = 'mysql:host='.Config::DB_Host.';dbname='.Config::DB_Name;
            $db = new PDO($DB_conect,Config::DB_User,Config::DB_Password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;

        }
    }
}