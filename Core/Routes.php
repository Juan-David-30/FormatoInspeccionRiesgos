<?php
namespace Core;

//definiendo rutas
$router->add('',['controller'=>'Home', 'action' => 'index']);
$router->add('Insert',['controller'=>'Home', 'action' => 'insert']);
$router->add('Datos',['controller'=>'Home', 'action' => 'Datos']);