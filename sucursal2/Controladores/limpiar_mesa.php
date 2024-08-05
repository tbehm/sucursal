<?php 
	require '../Modelos/consultas.php';

	$mesa=filter_input(INPUT_GET, 'ubi');
	$idP=filter_input(INPUT_GET,'id');
	$sucursal=filter_input(INPUT_GET, 'suc');
	echo $mesa."-".$idP;

	estado_mesa($sucursal,$mesa,"libre");
	estado_pedido("finalizado",$idP);
	header("Location:../Vistas/user/menu_pedidos.php");
 ?>