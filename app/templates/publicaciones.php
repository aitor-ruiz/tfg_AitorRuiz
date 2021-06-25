<?php  ob_start()?>

<div class="row">

<?php foreach($parametros['posts'] as $fila=>$columna): ?>
		<div class="col-12 col-md-4 mb-3 p-3"><a href="index.php?ctl=perfil&usuario" class="posts">
		<img src="<?php echo $columna['imagen_post']?>" class="img-fluid">
		<ul class="list-group list-group-flush">
			<li class="list-group-item usuario"><?php echo $columna['usuario']?></li>
			<li class="list-group-item"><?php echo $columna['titulo_post'] ?></li>
			<li class="list-group-item"><?php echo (strlen($columna['texto_post'])>= 300) ? substr($columna['texto_post'],0,300 ).' ...' : $columna['texto_post'] ?></li>
			<li class="list-group-item"><?php echo $columna['fecha_post'] ?></li>
		</ul>
	</a></div>
	<?php endforeach;?>
	</div>
<?php //Array ( [id_post] => 1 [titulo_post] => Esta es mi segunda p [texto_post] => Ay qué nervios por ver el resultado final. [imagen_post] => [fecha_post] => 2021-05-24  ?>








	<?php $contenido = ob_get_clean()?>
<?php include 'layout.php';?>