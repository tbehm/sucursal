<?php
	require'../Modelos/consultas.php';
	$id = filter_input(INPUT_POST, 'ubi');
	$Cantidad = filter_input(INPUT_POST, 'cantidad');
	$Sucursal=filter_input(INPUT_POST, 'sucursal');
	update_stock($id,$Cantidad,$Sucursal);
	header('location:../Vistas/infoStock.php');
?>