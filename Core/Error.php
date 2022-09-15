<?php

namespace Core;

class Error {
    public static function errorHandler($level, $message, $file, $line) {
        if(error_reporting() != 0){
            throw new \ErrorException($message, 0, $level, $file, $line);
        }
    }
    public static function exceptionHandler($exception){
        $code = $exception->getCode();
        if($code != 404 && $code!= 401){
            $code = 500;
        }
        http_response_code($code);
        if(\App\Config::ShowError){
        echo "<h1 style='border-bottom: solid 2px black; margin-top:50px'> Error fatal</h1>";
        echo "<div style='margin-left:100px; margin-top:50px'>";
        echo "<p>Exepción no atrapada: ".get_class($exception)."</p>";
        echo "<p>Mensaje: ". $exception->getMessage()."</p>";
        echo "<p>Stack trace: <pre>".$exception->getTraceAsString()."</pre></p>";
        echo "<p> Lanzado en ".$exception->getFile()." en la linea: ".$exception->getLine(). "</p>";
        echo "</div>";
        }else{
            if( \App\Config::LogError){
            $log = dirname(__DIR__).'/Logs/'.date('Y-m-d').'.txt';
            ini_set('error_log', $log);
            $message = "Excepción no atrapada: '".get_class($exception). "' ";
            $message .= "Con mensaje: '".$exception->getMessage()."' ";
            $message .= "\nStack trace: ".$exception->getTraceAsString();
            $message .= "\nLanzada en ".$exception->getFile(). " en la linea: ".$exception->getLine();

            error_log($message);
            }
            \Core\View::renderTemplate("Errores/$code.html");

        }
    }
}