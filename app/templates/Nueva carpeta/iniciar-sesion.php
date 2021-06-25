<?php  ob_start()?>

<div class="row iniciar-sesion mb-3">
	<div class="col-1 col-md-3 col-lg-3"></div>
	<div class="col-10 col-md-6 col-lg-6">
		<h2 class="mb-3">Iniciar sesión</h2>
		<div class="row">
			<form action="" method="post" class="p-3">
				<div class="mb-3">
					<label for="usuario" class="form-label"><img
						src="img/iconos/usuario.svg" alt=""> Usuario</label> <input
						type="text" class="form-control" name="usuario">
				</div>
				<div class="mb-3">
					<label for="clave" class="form-label"><img
						src="img/iconos/contraseña.svg" alt=""> Contraseña</label>
					<input type="text" class="form-control" name="clave">
				</div>
				<?php if (isset($parametros["error"])) :?><p><span class="error"><?php echo $parametros["error"]?></span></p><?php endif;?>
				<input type="submit" value="Iniciar Sesión" name="iniciar-sesion"
					id="iniciar-sesion" class="btn btn-primary">
			</form>
		</div>
	</div>
	<div class="col-1 col-md-3 col-lg-3">
		<img src="img/iconos/usuario-borde.svg" alt="">
	</div>
</div>

<?php $contenido = ob_get_clean()?>
<?php include 'layout.php';?>