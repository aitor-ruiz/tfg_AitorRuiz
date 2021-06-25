<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css\style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<title>Bienvenido a miRed</title>
</head>
<body>
	<div class="container-fluid">
		<div class="row" id="cabecera">
			<!--CABECERA DE LA WEB-->
			<header class="row" >
				<nav class="navbar navbar-expand-lg navbar-light p-3">
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
					<div class="collapse navbar-collapse" id="navbarNav">
						

						<ul class="navbar-nav me-auto">
							<a class="navbar-brand" href="#">Mi Red</a>
						</ul>
						
					</div>
				</nav>
			</header>
		</div>

		<main>
			<div class="row">
				<!--Contenido Principal menuIzq + contenido-->
				
				<!--MENÚ IZQUIERDA-->
				<?php if($_SESSION['permiso']==0) : ?>
				<div class="d-none d-md-block d-lg-block col-4 p-3" id="menu-izquierda">
				<ul class="nav flex-column">
				<div class="row mt-3">
					<h2 class="titulos mb-3">Bienvenidos a miRed</h2>
    				<ul class="nav justify-content-center">
    					<?php if ($_SESSION["permiso"]==0) :?><li class="nav-item"><a class="nav-link boton-normal" href="index.php?ctl=iniciar-sesion">Iniciar Sesión</a></li><?php endif;?>	
    					<?php if ($_SESSION["permiso"]==0) :?><li class="nav-item"><a class="nav-link boton-normal" href="index.php?ctl=publicaciones">Publicaciones</a></li><?php endif;?>			
    				</ul>
				</div>
				</ul>
				</div>
				<?php endif;?>
				
				<?php if($_SESSION['permiso']>=1) : ?>
				<div class="d-none d-md-block d-lg-block col-4 p-3" id="menu-izquierda">
					<h2 class="titulos">Hola <?php echo $_SESSION['usuario']->usuario ?>!</h2>
					<ul class="nav flex-column">
						<li class="nav-item">
							<div class="row mb-3">
								<div class="col-4">
									<img src="<?php echo $_SESSION['usuario']->foto_perfil ?>" id="imagen-perfil">
								</div>
								<div class="col-8">
									<ul class="list-group list-group-flush">
										<li class="list-group-item"><?php echo $_SESSION['usuario']->nombre_usuario.' '.$_SESSION['usuario']->apellidos_usuario ?></li>
										<li class="list-group-item"><?php echo $_SESSION['usuario']->fecha_nacimiento ?></li>
										<li class="list-group-item"><?php echo $_SESSION['usuario']->edad.' años' ?></li>
										<li class="list-group-item"><?php echo $_SESSION['usuario']->bio ?></li>
									</ul>
								</div>
							</div>
						</li>
						
						<div class="row">
							<?php if ($_SESSION["permiso"]>=1) :?><li class="nav-item"><a class="nav-link" href="index.php?ctl=mi-perfil">Mi perfil</a></li><?php endif;?>
							<?php if ($_SESSION["permiso"]>=1) :?><li class="nav-item"><a class="nav-link" href="#">Mis Compañeros</a></li><?php endif;?>
							<?php if ($_SESSION["permiso"]>=1) :?><li class="nav-item"><a class="nav-link" href="index.php?ctl=publicaciones">Publicaciones</a></li><?php endif;?>
							<?php if ($_SESSION["permiso"]>=2) :?><li class="nav-item"><a class="nav-link" href="index.php?ctl=registrar-usuario">Registrar usuario</a></li><?php endif;?>
							<ul class="nav justify-content-center">
								<?php if ($_SESSION["permiso"]>=1) :?><li class="nav-item"><a class="nav-link boton-normal" href="index.php?ctl=publicar-post">Subir publicación</a></li><?php endif;?>
								<?php if ($_SESSION["permiso"]>=1) :?><li class="nav-item"><a class="nav-link" id="boton-cerrar" href="index.php?ctl=cerrar-sesion">Cerrar Sesión</a></li><?php endif;?>
							</ul>
							
						</div>
					</ul>
				</div>
				
				<?php endif;?>
				<div class="col-12 col-md-8 col-lg-8 p-3" id="contenido">
					<!--Aquí añadimos el contenido-->
            		<?php echo $contenido; ?>
				</div>
			</div>
		</main>
	
		<div class="row">
          <div class="d-sm-block d-md-none col-12 mt-3">
            <ul class="nav justify-content-center">
              	<?php if ($_SESSION["permiso"]>=1) :?><li class="nav-item"><a class="nav-link boton-normal-movil" href="#">Mi perfil</a></li><?php endif;?>
              	<?php if ($_SESSION["permiso"]>=1) :?><li class="nav-item"><a class="nav-link boton-normal-movil" href="#">Mis Compañeros</a></li><?php endif;?>
				<?php if ($_SESSION["permiso"]>=1) :?><li class="nav-item"><a class="nav-link boton-normal-movil" href="#">Publicaciones</a></li><?php endif;?>
				<?php if ($_SESSION["permiso"]>=2) :?><li class="nav-item"><a class="nav-link boton-normal-movil" href="index.php?ctl=registrar-usuario">Registrar usuario</a></li><?php endif;?>
              	<?php if ($_SESSION["permiso"]>=1) :?><li class="nav-item"><a class="nav-link boton-normal-movil" href="index.php?ctl=publicar-post">Subir publicación</a></li><?php endif;?>
				<?php if ($_SESSION["permiso"]>=1) :?><li class="nav-item"><a class="nav-link" id="boton-cerrar" href="index.php?ctl=cerrar-sesion">Cerrar Sesión</a></li><?php endif;?>
							
            </ul>
        </div>
      </div>
	
	</div>

</body>
</html>