<?php

function limpiarArray($array){
    $array_devolver= [];
    foreach ($array as $indice => $array_interior){
        foreach ($array_interior as $titulo => $contenido){
            $array_devolver[$titulo] = $contenido;
        }
    }
    
    return $array_devolver;
}


//RECOGER DATOS

function quitarEspacios($contenido){
    $resultado = trim(preg_replace("/ +/", " ", $contenido)); //Elimina de delante y de atrás espacios de (sustituye cuando haya más de un espacio por solo un espacio)
    return $resultado;
}

function recoge($name){
    if(isset($_REQUEST[$name])){
        $tmp = strip_tags(quitarEspacios($_REQUEST[$name]));
        return $tmp;
    }else{
        return $tmp="";
    }
}

function recogeArray($name){
    if(isset($_REQUEST[$name])){
        $tmp = $_REQUEST[$name];
        return $tmp;
    }else{
        return $tmp = "";
    }
}

// VALIDAR

function quitarTildes($contenido){
    $tildes= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","à","è","ì","ò","ù","À","È","Ì","Ò","Ù");
    $sintildes= array ("a","e","i","o","u","A","E","I","O","U","a","e","i","o","u","A","E","I","O","U");
    return str_replace($tildes, $sintildes ,$contenido);
}

function cUsuario($usuario){
    $validar = preg_match("/^[\+\/\\a-z0-9$&*_-][\+\/\\a-z0-9$&*_-]{0,19}$/i", quitarTildes($usuario)); 
    return $validar;
}

function cClave($clave){
    $validar = preg_match("/^[\+\/\\a-z0-9$&*_-][\+\/\\a-z0-9$&*_-]{0,14}$/i", $clave);
    return $validar;
}

function cNombre($nombre){
    $validar = preg_match("/^[\+\/\\a-z0-9$&*_-][\+\/\\a-z0-9$&*_-]{0,29}$/i", quitarTildes($nombre)); 
    return $validar;
}

function cApellidos($apellidos){
    $validar = preg_match("/^[a-z][a-z ]{0,49}$/i", quitarTildes($apellidos));
    return $validar;
}


function cFecha($nacimiento){
    $fecha = preg_replace("/[\/\\- ]+/", "/", $nacimiento);
    $arrayFecha = explode("/", $fecha);
    if(count($arrayFecha)>1){
        $dia = $arrayFecha[2];
        $mes = $arrayFecha[1];
        $anio = $arrayFecha[0];
        
        if((count($arrayFecha)==3)&&(checkdate($mes, $dia, $anio))){
            $fecha = mktime(0,0,0,$mes,$dia,$anio);
            
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
    
    
}

function cBio($bio){
    $validar = preg_match("/^[\+\/\\a-zñ0-9.,@$&*_-]+$/i", quitarTildes($bio));
    return $validar;
}

function cTitulo($texto){
    $validar = preg_match("/^[\+\/\\a-zñ0-9.,@$&*_-][\+\/\\a-zñ0-9.,@$&*_-]{0,19}$/i", quitarTildes($texto));
    return $validar;
}

function cTexto($texto){
    $validar = preg_match("/^[\+\/\\a-zñ0-9.,@$&*_-]+$/i", quitarTildes($texto));
    return $validar;
}

function cFile($imagen, $usuario, $ruta_destino, &$ruta, &$errores) // MODIFICADO EL SIZE
{
    //POR SI HAY ERRORES EN LA IMAGEN
    if ($_FILES[$imagen]['error'] != 0) {
        switch ($_FILES[$imagen]['error']) {
            case 1:
                $errores[] = "UPLOAD_ERR_INI_SIZE";
                $errores[] = "Fichero demasiado grande";
                break;
            case 2:
                $errores[] = "UPLOAD_ERR_FORM_SIZE";
                $errores[] = 'El fichero es demasiado grande';
                break;
            case 3:
                $errores[] = "UPLOAD_ERR_PARTIAL";
                $errores[] = 'El fichero no se ha podido subir entero';
                break;
            case 4:
                $errores[] = "UPLOAD_ERR_NO_FILE";
                $errores[] = 'No se ha podido subir el fichero';
                break;
            case 6:
                $errores[] = "UPLOAD_ERR_NO_TMP_DIR";
                $errores[] = "Falta carpeta temporal";
                break;
            case 7:
                $errores[] = "UPLOAD_ERR_CANT_WRITE";
                $errores[] = "No se ha podido escribir en el disco";
                break;
                
            default:
                $errores[] = 'Error indeterminado.';
        }
        return false;
    } else {
        
        //PROCESO DE GUARDAR IMAGEN
        
        $nombre_imagen = $usuario; //Como queramos que se guarde. 
        $directorio_temporal = $_FILES[$imagen]['tmp_name'];
        $extension = $_FILES[$imagen]['type'];
        
        if (! in_array($extension, Config::$extensiones_imagenes)) {
            $errores[] = "La extensión del archivo no es válida o no se ha subido ningún archivo";
            return false;
        }
        
        if($_FILES[$imagen]["size"]>3302254){
            $errores[] = "Imagen demasiado grande";
            return false;
        }
        
        $partes_ruta = pathinfo($_FILES[$imagen]['name']);
        
        $extension=$partes_ruta['extension'];
        
        if (move_uploaded_file($directorio_temporal, $ruta_destino . $nombre_imagen.'.'.$extension)) {
            $ruta = $ruta_destino . $nombre_imagen . '.'.$extension; //es una variable externa para luego guardar en la base de datos
            return true;
        } else {
            $errores[] = "Error: No se puede mover el fichero a su destino";
            return false;
        }
        
    }
}

function crearDirectorio($usuario, &$error){
    if(!is_dir(Config::$ruta_posts.$usuario."/")){
        if(mkdir(Config::$ruta_posts.$usuario."/")){
            return true;
        }else{
            $error[]="No se ha podido crear el usuario";
            return false;
        };
    }else{
        $error[]="La carpeta del usuario ya existe.";
    }
    
}

function cPost($imagen, $usuario, $ruta_destino, &$ruta, &$errores) // MODIFICADO EL SIZE
{
    //POR SI HAY ERRORES EN LA IMAGEN
    if ($_FILES[$imagen]['error'] != 0) {
        switch ($_FILES[$imagen]['error']) {
            case 1:
                $errores[] = "UPLOAD_ERR_INI_SIZE";
                $errores[] = "Fichero demasiado grande";
                break;
            case 2:
                $errores[] = "UPLOAD_ERR_FORM_SIZE";
                $errores[] = 'El fichero es demasiado grande';
                break;
            case 3:
                $errores[] = "UPLOAD_ERR_PARTIAL";
                $errores[] = 'El fichero no se ha podido subir entero';
                break;
            case 4:
                $errores[] = "UPLOAD_ERR_NO_FILE";
                $errores[] = 'No se ha podido subir el fichero';
                break;
            case 6:
                $errores[] = "UPLOAD_ERR_NO_TMP_DIR";
                $errores[] = "Falta carpeta temporal";
                break;
            case 7:
                $errores[] = "UPLOAD_ERR_CANT_WRITE";
                $errores[] = "No se ha podido escribir en el disco";
                break;
                
            default:
                $errores[] = 'Error indeterminado.';
        }
        return false;
    } else {
        
        //PROCESO DE GUARDAR IMAGEN
        
        $nombre_imagen = $usuario.mktime(); //Como queramos que se guarde.
        $directorio_temporal = $_FILES[$imagen]['tmp_name'];
        $extension = $_FILES[$imagen]['type'];
        
        if (! in_array($extension, Config::$extensiones_imagenes)) {
            $errores[] = "La extensión del archivo no es válida o no se ha subido ningún archivo";
            return false;
        }
        
        if($_FILES[$imagen]["size"]>3302254){
            $errores[] = "Imagen demasiado grande";
            return false;
        }
        
        $partes_ruta = pathinfo($_FILES[$imagen]['name']);
        
        $extension=$partes_ruta['extension'];
        
        if (move_uploaded_file($directorio_temporal, $ruta_destino . $nombre_imagen.'.'.$extension)) {
            $ruta = $ruta_destino . $nombre_imagen .'.'.$extension; //es una variable externa para luego guardar en la base de datos
            return true;
        } else {
            $errores[] = "Error: No se puede mover el fichero a su destino";
            return false;
        }
        
    }
}