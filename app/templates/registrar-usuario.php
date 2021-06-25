<?php  ob_start()?>

<div>
	<form form action="" method="post" enctype="multipart/form-data">
            <label for="usuario">*Usuario</label>
            <input type="text" name="usuario" id="usuario" value="<?php echo (isset($parametros["usuario"])) ? $parametros["usuario"] : "" ?>" placeholder="Usuario">
            <p>El nombre del usuario no puede tener más de 20 caracteres.</p>

            <label for="clave">*Contraseña</label>
            <input type="text" name="clave" id="clave" value="<?php echo (isset($parametros['clave'])) ? $parametros['clave'] : "" ?>" placeholder="Contraseña"><br>

            <label for="nombre_usuario">*Nombre</label>
            <input type="text" name="nombre_usuario" id="nombre_usuario" value="<?php echo (isset($parametros['nombre_usuario'])) ? $parametros['nombre_usuario'] : "" ?>" placeholder="Nombre"><br>

            <label for="apellidos_usuario">*Apellidos</label>
            <input type="text" name="apellidos_usuario" id="apellidos_usuario" value="<?php echo (isset($parametros['apellidos_usuario'])) ? $parametros['apellidos_usuario'] : "" ?>" placeholder="Apellidos"><br>

            <label for="fecha_nacimiento">*Fecha de nacimiento</label>
            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="<?php echo (isset($parametros['fecha_nacimiento'])) ? $parametros['fecha_nacimiento'] : "" ?>"><br>

            <label for="bio">Biografía</label>
            <textarea name="bio" id="bio" cols="30" rows="10" value="<?php echo (isset($parametros['bio'])) ? $parametros['bio'] : "" ?>"  placeholder="Descríbete"></textarea><br>

            <label for="foto_perfil">*Foto de usuario</label>
            <input type="file" name="foto_perfil"><br>
            
            <!--  PERMISOS  -->
            <?php foreach ($parametros['permisos'] as $fila=>$columna) : ?>

            <label for="<?php echo $columna['tipo_permiso']; ?>"><?php echo $columna['tipo_permiso']; ?></label>
            <input type="radio" name="permiso" id="<?php echo $columna['tipo_permiso']; ?>" value="<?php echo $columna['id_permiso']?>" <?php echo ($columna['id_permiso'] ==3) ? "checked" : "" ?>><br>
            
            <?php endforeach;?>
            <input type="submit" value="Registrar" name="registrar_usuario">
    </form>
</div>

<div>
<?php
if (isset($validaciones->mensaje)) {
    foreach ($validaciones->mensaje as $mensaje => $i) {
        echo $validaciones->mensaje[$mensaje][0] . '<br>';
    }
}

if(isset($parametros['errores'])){
print_r($parametros['errores']);
}
?>
</div>

<?php $contenido = ob_get_clean()?>
<?php include 'layout.php';?>