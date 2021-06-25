<?php 

class Post{
    private $usuario; 
    private $id_post; 
    private $titulo_post; 
    private $texto_post; 
    private $imagen_post; 
    private $fecha_post; 
    
    function __construct($usuario, $titulo_post, $texto_post, $imagen_post, $fecha_post,$id_post = null){
        $this->usuario = $usuario;
        $this->id_post = $id_post;
        $this->titulo_post = $titulo_post;
        $this->texto_post = $texto_post;
        $this->imagen_post = $imagen_post;
        $this->fecha_post = $fecha_post;
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
            $db = new PostModel();
            $stmt = $db->prepare("insert into posts(usuario, titulo_post, texto_post, imagen_post, fecha_post) values(?,?,?,?,?)");
            $stmt->bindParam(1, $this->usuario->usuario);
            $stmt->bindParam(2, $this->titulo_post);
            $stmt->bindParam(3, $this->texto_post);
            $stmt->bindParam(4, $this->imagen_post);
            $stmt->bindParam(5, $this->fecha_post);
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
    
    
    public function mandarJSON(){
        $array= [];
        foreach ($this as $propiedad => $contenido){
            $array[$propiedad]=$contenido;
        }
        
        echo json_encode($array, JSON_UNESCAPED_UNICODE);
        
    }
    
}
?>