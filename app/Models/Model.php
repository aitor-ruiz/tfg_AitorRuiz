<?php

class Model extends PDO{
    private static $instance = null;
    public function __construct(){
        parent::__construct('mysql:host='.Config::$hostname.';dbname='.Config::$nombre.'',Config::$usuario, Config::$clave);
        parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        parent::exec("set names utf8");
    }
    
    public static function getInstance(){
        if(self::$instance == null){
            self::$instance = new self();
        }
        
        return self::$instance;
    }
}


?>