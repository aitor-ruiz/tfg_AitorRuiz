<?php  ob_start()?>

<h2>Bienvenido <?php echo $_SESSION['usuario']->nombre_usuario?></h2>
<div>

</div>

<?php $contenido = ob_get_clean()?>
<?php include 'layout.php';?>