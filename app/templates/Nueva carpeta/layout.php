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
		<div class="row">
			<!--CABECERA DE LA WEB-->
			<header class="row mb-3">
				<nav class="navbar navbar-expand-lg navbar-light p-3">
					<!--Podemos añadir el atributo fixed-top/button sticky-top || Antes teníamos bg-light que es el un fondo de color-->
					<!--<a class="navbar-brand" href="#">Mi Red</a> *1 (mira abajo)-->
					<!-- Podemos sustituir el texto por una imagen <img src="/docs/4.0/assets/brand/bootstrap-solid.svg" width="30" height="30" alt="">-->
					<!-- Y añadir a continuación el título de la pagina ej: [imagen]Texto -->
					<button class="navbar-toggler" type="button"
						data-bs-toggle="collapse" data-bs-target="#navbarNav"
						aria-controls="navbarNav" aria-expanded="false"
						aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarNav">
						<!--*1 si añadimos aquí el icono de la página cuando se haga pequeño el icono del menú aparecerá a la izquierda, buena idea-->
						<a class="navbar-brand" href="index.php?ctl=inicio"">Mi Red</a>
						<ul class="navbar-nav me-auto">
							<?php if ($_SESSION["permiso"]<=2) :?><li class="nav-item"><a class="nav-link" href="index.php?ctl=mi-perfil">Mi Perfil</a></li><?php endif;?>
							<?php if ($_SESSION["permiso"]<=2) :?><li class="nav-item"><a class="nav-link" href="index.php?ctl=inicio">Mis Compañeros</a></li><?php endif;?>
						</ul>
						<ul class="navbar-nav d-flex">
							<?php if ($_SESSION["permiso"]<=1) :?><li class="nav-item"><a class="nav-link" href="index.php?ctl=registrar-usuario">Registrar Usuario</a></li><?php endif;?>
							<?php if ($_SESSION["permiso"]==3) :?><li class="nav-item"><a class="nav-link" href="index.php?ctl=iniciar-sesion">Iniciar Sesión</a></li><?php endif;?>
							<?php if ($_SESSION["permiso"]<=2) :?><li class="nav-item"><a class="nav-link" href="index.php?ctl=cerrar-sesion">Cerrar Sesión</a></li><?php endif;?>
							
						</ul>
					</div>
				</nav>
			</header>
		</div>

		<main>
			<!--Aquí añadimos el contenido-->
            <?php echo $contenido; ?>
      	</main>
	</div>

</body>
</html>