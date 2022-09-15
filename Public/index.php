<?php 
//llamando el autoload de composer
require dirname(__DIR__).'/Vendor/autoload.php';
//Manejo de errores y excepciones
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');
//llamando router; 
$router = new Core\Router();
//requiriendo las rutas
require dirname(__DIR__).'/Core/Routes.php';
//llamando la función de dispatch del router
$router->dispatch($_SERVER['QUERY_STRING']);