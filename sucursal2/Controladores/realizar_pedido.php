<?php 
	require '../Modelos/consultas.php';

	$mesa=filter_input(INPUT_GET, 'ubi'); 
	$idPedido=filter_input(INPUT_GET, 'id');
	$sucursal=filter_input(INPUT_GET, 'suc');
	echo $mesa.$sucursal;

	estado_pedido("en preparacion",$idPedido);
	estado_mesa($sucursal,$mesa,"ocupada");
	header("Location:../Vistas/user/menu_pedidos.php");
 ?>