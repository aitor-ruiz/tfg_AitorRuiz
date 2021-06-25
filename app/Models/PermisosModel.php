<?php

// Solo nos sirve para traer permisos
// include '../Config.php'; Solo para hacer pruebas en la página. 
// include '../core/Permiso.php';  Solo para hacer pruebas en la página. 

require_once 'Model.php';

class PermisosModel extends Model{
    
    function __construct(){
        parent::__construct();
        parent::getInstance();
    }
    
    public function allPermisos(){
        try{
            $stmt = self::prepare("SELECT * FROM permisos order by id_permiso DESC" );
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        }catch (Exception $e){
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logExceptio.txt");
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
        }
    }
    
    public function traerPermiso($id_permiso){
        try{
            $stmt = self::prepare("SELECT * FROM permisos where id_permiso=:valor1" );
            $stmt->bindParam(":valor1", $id_permiso);
            $stmt->execute();
            
            if ($stmt->rowCount() == 1){ //Tiene que devolver una columna
                return $stmt->fetch(PDO::FETCH_ASSOC); // Devuelve = Array ( [id_permiso] => x [tipo_permiso] => x )
            }else{
                return false;
            }
            
            
        }catch (Exception $e){
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logExceptio.txt");
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
        }
    }  
}

/*  EJEMPLO TRAER TODOS LOS PERMISOS

$modelo = new PermisosModel();

$modelos = $modelo->traerPermisos();

foreach ($modelos as $indice => $arrayInterno){
    echo $modelos[$indice]['id_permiso'].'<br>';
    echo $modelos[$indice]['tipo_permiso'].'<br>';
}

*/

/* EJEMPLO PRÁCTICO PARA CREAR UN PERMISO


if($permiso = $modelo->traerPermiso(5)){
    $permiso1 = new Permiso($permiso['id_permiso'], $permiso['tipo_permiso']);
    print_r($permiso1);
}else{
    echo "No encontrado";
}

*/
?>