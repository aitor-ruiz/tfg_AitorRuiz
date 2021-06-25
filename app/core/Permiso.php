<?php 

class Permiso{
    private $id_permiso; 
    private $tipo_permiso;
    
    function __construct($id_permiso, $tipo_permiso){
        $this->id_permiso = $id_permiso;
        $this->tipo_permiso = $tipo_permiso;
    }
    
    // FUNCIONES GET, SET, STRING
    
    public function __set($var, $valor){
        if(property_exists(__CLASS__, $var)){
            $this->$var = $valor;
        }
    }
    
    public function __get($var){
        if(property_exists(__CLASS__, $var)){
            return $this->$var;
        }else{
            return null;
        }
    }
    
    public function __toString(){
        return $this->nombre.','.$this->apellidos.','.$this->usuario;
    }
    
}

?>