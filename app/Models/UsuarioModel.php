<?php 

require_once 'Model.php';

class UsuarioModel extends Model{
    
    function __construct(){
        parent::__construct();
        parent::getInstance();
    }
    
    public function traerUsuario($usuario, $clave){
        try{
            $stmt = self::prepare("select * from usuarios where usuario=:value1 and clave=:value2");
            $stmt->bindParam(":value1", $usuario);
            $stmt->bindParam(":value2", $clave);
            $stmt->execute();
            $stmt = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $array = limpiarArray($stmt);

            return $usuario = new Usuario(
                $array["usuario"], 
                $array["clave"], 
                $array["nombre_usuario"], 
                $array["apellidos_usuario"], 
                $array["fecha_nacimiento"], 
                $array["bio"],
                $array["foto_perfil"], 
                $array["id_permiso"]);      
           
        }catch (Exception $e){
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logExceptio.txt");
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
        }
    }
    
    public function comprobarUsuario($usuario, $clave){
        try {
            $consulta = "select * from usuarios where user=:valor1 and clave=:valor2 ;";
            $stmt= self::prepare("select * from usuarios where usuario=:valor1 and clave=:valor2");
            $stmt->bindParam(":valor1", $usuario);
            $stmt->bindParam(":valor2", $clave);
            $stmt->execute();
            
            if ($stmt->rowCount() == 1) {
                $valor = $stmt->fetch();
                if($valor["usuario"] == $usuario && $valor["clave"] == $clave){
                    return true;
                }else {
                    return false;
                }
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

?>