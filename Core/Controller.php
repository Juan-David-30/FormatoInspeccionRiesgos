<?php
namespace Core;

abstract class Controller {

    protected $route_params = [];

    public function __construct($route_params){
        $this->route_params = $route_params;
    }

    public function __call($name, $args)
    {
        if(method_exists($this,$name)){
        $method = $name;

        if($this->before() !== false){
                call_user_func_array([$this, $method], $args);
                $this->after();
            }else{
            throw new \Exception("Usuario no autorizado para acceder a el metodo ".$method. " de la clase ".get_class($this), 401);
            }
        }else{
        $method = $name . 'Action';

        if(method_exists($this, $method)){
            if($this->before() !== false){
            call_user_func_array([$this, $method], $args);
            $this->after();
            }
        }else{
           throw new \Exception("El metodo $method no ha sido encontrado en el controlador ".get_class($this), 404);
        }
    }

    }
    protected function before(){
       return false; 
        
    }
    protected function after() {
        echo ' xd';
    }

}