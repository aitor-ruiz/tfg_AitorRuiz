<?php  ob_start()?>

<div class="row iniciar-sesion mb-3">
	<p>Esto es el inicio</p>
</div>

<?php $contenido = ob_get_clean()?>
<?php include 'layout.php';?>