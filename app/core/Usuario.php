<?php

class Usuario{
    private $usuario;
    private $clave;
    private $nombre_usuario;
    private $apellidos_usuario;
    private $fecha_nacimiento;
    private $edad;
    private $bio;
    private $foto_perfil;
    private $permiso_usuario;
    
    function __construct($usuario, $clave, $nombre_usuario, $apellidos_usuario, $fecha_nacimiento, $bio, $foto_perfil, $permiso_usuario){
        $this->usuario = $usuario;
        $this->clave = $clave;
        $this->nombre_usuario = $nombre_usuario;
        $this->apellidos_usuario = $apellidos_usuario;
        $this->fecha_nacimiento = $fecha_nacimiento;
        $this->edad = $this->calcularEdad($fecha_nacimiento);
        $this->bio = $bio;
        $this->foto_perfil = $foto_perfil;
        $this->permiso_usuario = $permiso_usuario;
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
    
    // GUARDAR USUARIO EN LA BASE DE DATOS
    
    public function guardar(){
        try{
            $db = new UsuarioModel();
            $stmt = $db->prepare("insert into usuarios(usuario, clave, nombre_usuario, apellidos_usuario, fecha_nacimiento, bio, foto_perfil, id_permiso) values(?,?,?,?,?,?,?,?)");
            $stmt->bindParam(1, $this->usuario);
            $stmt->bindParam(2, $this->clave);
            $stmt->bindParam(3, $this->nombre_usuario);
            $stmt->bindParam(4, $this->apellidos_usuario);
            $stmt->bindParam(5, $this->fecha_nacimiento);
            $stmt->bindParam(6, $this->bio);
            $stmt->bindParam(7, $this->foto_perfil);
            $stmt->bindParam(8, $this->permiso_usuario);
            return $stmt->execute();
        }catch (Exception $e) {
            // error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logExceptio.txt");
            echo "Exception";
        } catch (Error $e) {
            echo "$e";
            // error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
        }
    }
    
    // CALCULAR EDAD
    
    public function calcularEdad($fecha_nacimiento){
        $fecha_actual = date("d-m-Y");
        $fecha_nacimiento = $fecha_nacimiento;
        
        if(explode("-", $fecha_actual)[1] <= explode("-", $fecha_nacimiento)[1]){
            if(explode("-", $fecha_nacimiento)[2] <= explode("-", $fecha_actual)[0]){
                $edad = explode("-", $fecha_actual)[2] - explode("-", $fecha_nacimiento)[0];
            }else{
                $edad = (explode("-", $fecha_actual)[2] - explode("-", $fecha_nacimiento)[0])-1;
            }
        }else{
            $edad = explode("-", $fecha_actual)[2] - explode("-", $fecha_nacimiento)[0];
        }
        
        return $edad;
        
    }
    
    public function mandarJSON(){
        $array= [];
        foreach ($this as $propiedad => $contenido){
            $array[$propiedad]=$contenido;
        }
        
        echo json_encode($array, JSON_UNESCAPED_UNICODE);
        
    }
  
}

?>
