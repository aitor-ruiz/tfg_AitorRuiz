<?php  ob_start()?>
<div class="row registrar-usuario">
	<div class="col-lg-3"></div>
	<!--COLUMNAS-->
	<div class="col-sm-12 col-lg-6">
		<h2 class="mb-3">Registrar usuario</h2>
		<div class="row">
			<form action="" method="post">
				<div class="row mb-3">
					<!--USUARIO Y CONTRASEÑA-->
					<div class="col-6">
						<label for="usuario" class="form-label"><img
							src="../../web/img/iconos/usuario.svg" alt=""> Usuario</label> <input
							type="text" class="form-control" name="usuario">
					</div>
					<div class="col-6">
						<label for="clave" class="form-label"><img
							src="../../web/img/iconos/contraseña.svg" alt=""> Contraseña</label>
						<input type="text" class="form-control" name="clave">
					</div>
				</div>

				<!--NOMBRE Y APELLIDOS-->
				<div class="row mb-3">
					<div class="col-6">
						<label for="nombre" class="form-label"><img
							src="../../web/img/iconos/nombre.svg" alt=""> Nombre</label> <input
							type="text" class="form-control" name="nombre-usuario">
					</div>
					<div class="col-6">
						<label for="apellidos" class="form-label">Apellidos</label> <input
							type="text" class="form-control" name="apellidos-usuario">
					</div>
				</div>

				<!--FECHA DE NACIMIENTO-->
				<div class="row mb-3">
					<div class="col-6">
						<label for="fecha-nacimiento" class="form-label"><img
							src="../../web/img/iconos/fecha-nacimiento.svg" alt=""> Fecha de
							nacimiento</label> <input type="date" class="form-control"
							name="fecha-nacimiento">
					</div>
				</div>

				<!--BIO Y FOTO-->
				<div class="row mb-3">
					<div class="col-6">
						<div class="mb-3">
							<label for="bio" class="form-label">Biografía</label>
							<textarea class="form-control" id="exampleFormControlTextarea1"
								name="bio" rows="3"></textarea>
						</div>
					</div>
					<div class="col-6">
						<div class="mb-3">
							<label for="formFile" class="form-label">Selecciona imagen de
								perfil</label> <input class="form-control" type="file"
								id="formFile">
						</div>
					</div>
				</div>

				<!--PERMISO-->
				<div class="row mb-3">
					<div class="col-6">
						<label for="bio" class="form-label">Tipo de usuario</label>
					<?php foreach ($parametros["permisos"] as $indice=>$array): ?>
						<div class="form-check">
							<input class="form-check-input" 
							type="radio" 
							name="id_permiso" 
							value="<?php echo $parametros["permisos"][$indice]['id_permiso'] ?>" <?php if ($parametros["permisos"][$indice]['id_permiso'] == 3): echo "checked"; endif;?>>
							
							<label 
							class="form-check-label" 
							for="<?php echo $parametros["permisos"][$indice]['id_permiso'] ?>"><?php echo $parametros["permisos"][$indice]['tipo_permiso'] ?></label>
						</div>
					<?php endforeach;?></div>
					<div class="col-6">
					
					</div>
				</div>


				<input type="submit" value="Registrar Usuario"
					name="registrar-usuario" class="btn btn-primary">
			</form>
		</div>
	</div>
	<div class="col-lg-3"></div>
	<!--COLUMNAS-->
</div>

<?php $contenido = ob_get_clean()?>
<?php include 'layout.php';?>