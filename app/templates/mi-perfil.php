<?php  ob_start()?>

<div class="row">

	<div class="row">
		<div class="row mb-3">
			<div class="col-4">
				<img src="<?php echo $_SESSION['usuario']->foto_perfil ?>"
					id="imagen-miperfil">
			</div>
			<div class="col-5">
			<h2 class="titulos mb-3">Mi perfil personal</h2>
				<ul class="list-group list-group-flush">
					<li class="list-group-item"><?php echo $_SESSION['usuario']->nombre_usuario.' '.$_SESSION['usuario']->apellidos_usuario ?></li>
					<li class="list-group-item"><?php echo $_SESSION['usuario']->fecha_nacimiento ?></li>
					<li class="list-group-item"><?php echo $_SESSION['usuario']->edad.' años' ?></li>
					<li class="list-group-item"><?php echo $_SESSION['usuario']->bio ?></li>
				</ul>
				<ul class="nav mt-3">
								<?php if ($_SESSION["permiso"]>=1) :?><li class="nav-item"><a
						class="nav-link boton-editar" href="index.php?ctl=publicar-post">Editar perfil</a></li><?php endif;?>
							</ul>
			</div>
			<div class="col-3"></div>
		</div>
	</div>

	<?php foreach($parametros['publicaciones'] as $fila=>$columna): ?>
		<div class="col-12 col-md-4 mb-3 p-3">
		<img src="<?php echo $columna['imagen_post']?>" class="img-fluid">
		<ul class="list-group list-group-flush">
			<li class="list-group-item usuario"><?php echo $columna['usuario']?></li>
			<li class="list-group-item"><?php echo $columna['titulo_post'] ?></li>
			<li class="list-group-item"><?php echo (strlen($columna['texto_post'])>= 300) ? substr($columna['texto_post'],0,300 ).' ...' : $columna['texto_post'] ?></li>
			<li class="list-group-item"><?php echo $columna['fecha_post'] ?></li>
		</ul>
	</div>
	<?php endforeach;?>
	</div>
<?php //Array ( [id_post] => 1 [titulo_post] => Esta es mi segunda p [texto_post] => Ay qué nervios por ver el resultado final. [imagen_post] => [fecha_post] => 2021-05-24  ?>








	<?php $contenido = ob_get_clean()?>
<?php include 'layout.php';?>