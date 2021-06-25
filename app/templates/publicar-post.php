<?php  ob_start()?>

<h2>Publica tu trabajo</h2>
<form action="" method="post" enctype="multipart/form-data">
	<div class="row">
      <div class="mb-3 col-12 col-md-6">
        <label for="titulo_post" class="form-label">Título del proyecto</label>
        <input type="text" class="form-control" id="titulo_post" name="titulo_post">
      </div>
      <div class="mb-3 col-12 col-md-6"></div>
  </div>

	<div class="row">
		<div class="mb-3 col-12 col-md-8">
			<label for="texto_post" class="form-label">Describe tu trabajo</label>
			<textarea class="form-control" name="texto_post" id="texto_post" rows="6" placeholder="Describe tu trabajo"></textarea>
		</div>
		<div class="mb-3 col-12 col-md-4"></div>
	</div>

	<div class="row">
		<div class="mb-3 col-12 col-md-6">
			<label for="imagen_post" class="form-label">Sube una imagen de tu trabajo</label>
			<input class="form-control" type="file" id="imagen_post" name="imagen_post">
		</div>
		<div class="col-12 col-md-6"></div>
	</div>
	
	<input type="submit" name="crear-post" value="Crear post" class="btn btn-primary boton-publicar">
	
</form>

<?php $contenido = ob_get_clean()?>
<?php include 'layout.php';?>