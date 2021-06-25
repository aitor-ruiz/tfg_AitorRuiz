<?php

require_once __DIR__.'\..\app\Controller.php';
require_once __DIR__.'\..\app\Models\Model.php';
require_once __DIR__.'\..\app\Config.php';

if(!isset($_SESSION))
{
    ini_set("session.cookie_lifetime", 600);
    session_start();
}

if(!isset($_SESSION["permiso"])){
    $_SESSION["permiso"] = 0; // DE MOMENTO
}

$mapeo = array(
    'inicio' => array('controller' => 'Controller', 'action' => 'inicio', 'nivel' => 0),
    'mi-perfil' => array('controller' => 'Controller', 'action' => 'mi_perfil', 'nivel' => 1),
    'iniciar-sesion' => array('controller' => 'Controller', 'action' => 'iniciar_sesion', 'nivel' => 0),
    'registrar-usuario' => array('controller' => 'Controller', 'action' => 'registrar_usuario', 'nivel' => 3),
    'cerrar-sesion' => array('controller' => 'Controller', 'action' => 'cerrar_sesion', 'nivel' => 1), 
    'publicar-post' => array('controller' => 'Controller', 'action' => 'publicar_post', 'nivel' => 1), 
    'publicaciones' => array('controller' => 'Controller', 'action' => 'publicaciones', 'nivel' => 0)
);

if(isset($_GET['ctl'])){ // si en la url ?ctl=algo  
    if(isset($mapeo[$_GET['ctl']])){ //si existe mapeo["algo"]
        $ruta = $_GET['ctl'];
    }else{
        echo "No existe el apartado ".$_GET['ctl'];
    }
}else{ 
    $ruta = 'inicio';
}

$controlador = $mapeo[$ruta]; // mete el contenido de mapeo["algo"] -> nuevo array 'controller'=>'Controlador';

if(method_exists($controlador['controller'], $controlador['action'])){
        call_user_func(array(new $controlador['controller'], $controlador['action']));
}else{
    echo "No se encuentra";
    echo $controlador['action'];
   // header("location: index.php?ctl=error");
}



?>
