<?php 
	require '../Modelos/consultas.php';

	$ubica=filter_input(INPUT_GET,'ubi_Id');
	$nombre=filter_input(INPUT_GET, 'nuev_nombre');
	$descri=filter_input(INPUT_GET, 'nuev_descrip');
	$precio=filter_input(INPUT_GET, 'nuev_precio');		

	update_producto($ubica,$nombre,$descri,$precio);
	header("Location:../Vistas/view_productos.php");
 ?>