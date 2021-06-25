<?php
include __DIR__.'\core\Usuario.php';
include __DIR__.'\core\Post.php';
include __DIR__.'\Models\UsuarioModel.php';
include __DIR__.'\Models\PermisosModel.php';
include __DIR__.'\Models\PostModel.php';
include __DIR__.'\libs\Validar.php';
include __DIR__.'\libs\utiles.php';

session_start();


class Controller
{

    // INICIO
    
    public function inicio(){
        
        
        require __DIR__ . '/templates/inicio.php';
    }
    
    // INICIAR SESIÓN
    
    public function iniciar_sesion()
    {
        $usuarioModel = new UsuarioModel();
        $validacion = new Validar();
        $parametros = [];
        
        if(isset($_REQUEST["iniciar-sesion"])){
            $parametros['usuario'] = recoge("usuario");
            $parametros['clave'] = recoge("clave");
            
            $validar = array(
                array('name' => 'usuario', 'regla' => 'no-empty, usuario'), 
                array('name' => 'clave', 'regla' => 'no-empty, clave')
            ); 
            
            $validaciones = $validacion->rules($validar, $parametros);
            
            if(!isset($validacion->mensaje)){
                if($usuarioModel->comprobarUsuario($parametros['usuario'], $parametros['clave'])){
                    $_SESSION["usuario"] = $usuarioModel->traerUsuario($parametros['usuario'], $parametros['clave']);
                    $_SESSION["permiso"] = $_SESSION["usuario"]->permiso_usuario;
                    
                    header("location:index.php?ctl=mi-perfil");
                }else {
                    $parametros["error"] = "Usuario y contraseña no válidos.";
                }
            }else{
                
                $parametros["error"] = "Usuario y contraseña mal introducidos.";
            }
            
        }

        require __DIR__ . '/templates/iniciar-sesion.php';
    }
    
    public function registrar_usuario()
    {
        
        $parametros = [];
        $permisosModel = new PermisosModel();
        $parametros["permisos"] = $permisosModel->allPermisos();
        $validacion = new Validar();
        
        if(isset($_REQUEST["registrar_usuario"])){
            // SANITIZAR 
            $parametros["usuario"] = recoge("usuario");
            $parametros["clave"] = recoge("clave");
            $parametros["nombre_usuario"] = recoge("nombre_usuario");
            $parametros["apellidos_usuario"] = recoge("apellidos_usuario");
            $parametros["fecha_nacimiento"] = recoge("fecha_nacimiento");
            $parametros["bio"] = recoge("bio");
            $parametros['foto_perfil'] = $_FILES["foto_perfil"];
            $parametros["permiso"] = recoge("permiso");
            
            $ruta = "";
            
            //VALIDAR
            
            $validar = array(
                array('name' => 'usuario', 'regla' => 'no-empty, usuario'),
                array('name' => 'clave', 'regla' => 'no-empty, clave'),
                array('name' => 'nombre_usuario', 'regla' => 'no-empty, nombreUsuario'),
                array('name' => 'apellidos_usuario', 'regla' => 'no-empty, apellidosUsuario'),
                array('name' => 'fecha_nacimiento', 'regla' => 'no-empty, fecha'),
                array('name' => 'bio', 'regla' => 'no-empty, bio'),
                array('name' => 'permiso', 'regla' => 'no-empty, permiso')
            ); 
            
            $validaciones = $validacion->rules($validar, $parametros);
            
            if(!isset($validacion->mensaje)){
                ($parametros["foto_perfil"]['size'] != 0) ? cFile("foto_perfil", $parametros["usuario"], Config::$ruta_usuario, $ruta, $parametros["errores"]) : "";
                
                if(!isset($parametros['errores'])){
                    $usuario = new Usuario(
                        $parametros["usuario"], 
                        $parametros["clave"], 
                        $parametros["nombre_usuario"], 
                        $parametros["apellidos_usuario"], 
                        $parametros["fecha_nacimiento"], 
                        $parametros["bio"], 
                        $ruta , 
                        $parametros["permiso"]);
                    echo $ruta;
                    print_r($usuario);
                    
                    crearDirectorio($parametros["usuario"], $parametros['errores']) && $usuario->guardar() ? header("location:index.php?ctl=inicio") : "" ;  
                }
            }
            
            

        }
        
        require __DIR__ . '/templates/registrar-usuario.php';
    }
    
    public function mi_perfil(){
        $parametros = [];
        $postModel = new PostModel();
        $usuario = $_SESSION['usuario'];
        $parametros['publicaciones'] = $postModel->traerPostsUsuario($usuario->usuario);     
        
        require __DIR__ . '/templates/mi-perfil.php';
    }
    
    public function publicaciones(){
        $posts = new PostModel();
        $parametros = [];
        $parametros['posts'] = $posts->allPosts();
        
        if(isset($_GET['id'])){
            echo "ID";
        }
        require __DIR__ . '/templates/publicaciones.php';
    }
    
    public function publicar_post(){
        $parametros = [];
        $validacion = new Validar();
        $ruta = "";
        
        if(isset($_REQUEST['crear-post'])){
            $parametros['titulo_post'] = recoge('titulo_post');
            $parametros['texto_post'] = recoge('texto_post');
            $parametros['imagen_post'] = $_FILES["imagen_post"];
            $parametros['fecha_post'] = date('Y-m-d');
            
            $validar = array(
                array('name' => 'titulo_post', 'regla' => 'no-empty, titulo'),
                array('name' => 'texto_post', 'regla' => 'no-empty, texto'),
                array('name' => 'fecha_post', 'regla' => 'no-empty, fecha'));
            
            $validaciones = $validacion->rules($validar, $parametros);
            
            if(!isset($validacion->mensaje)){
                ($parametros["imagen_post"]['size'] != 0) ? cPost("imagen_post", $_SESSION['usuario']->usuario, Config::$ruta_posts, $ruta, $parametros["errores"]) : "";
                 
                if(!isset($parametros['errores'])){
                    $post = new Post($_SESSION['usuario'], $parametros['titulo_post'], $parametros['texto_post'], $ruta, $parametros['fecha_post']);
                    $post->guardar();
                    header("location:index.php?ctl=inicio");
                }else{
                    print_r($parametros['errores']);
                }
            }
            
            print_r($validaciones);
            
        }
        require __DIR__ . '/templates/publicar-post.php';
    }
    
    public function cerrar_sesion(){
        session_unset();
        session_destroy();
        header("location:index.php?ctl=iniciar-sesion");
    }
}

?>