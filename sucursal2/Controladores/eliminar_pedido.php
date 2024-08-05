<?php 
	require '../Modelos/consultas.php';
	session_start();

	$idPedido=filter_input(INPUT_GET,'id');
	$accion=filter_input(INPUT_GET,'ac');
	$producto=filter_input(INPUT_GET, 'pro');
	$sucursal=$_SESSION['Cod_sucursal'];
	$tablaPedido=view_tabla("pedido WHERE idPedido='".$idPedido."'");
	
	$tablaStock=view_tabla("stock WHERE Cod_sucursal='".$sucursal."'");	

	if ($accion == "elProducto") {
		///CIclo para restaurar el sotck del producto
		foreach ($tablaStock as $ele) {//Foreach recorre tabla 'stock'
			if ($producto==$ele['Nombre']) {
				update_stock($ele['Cod_producto'],$ele['Nombre'],$ele['Cantidad']+1);
			}
		}//Foreach recorre tabla 'stock'

		foreach ($tablaPedido as $key) {//Foreach recorre tabla 'pedido'
			if ($producto == $key['producto']) {//Si el producto se repite sume la cantidad
				if ($key['cantidad']==1) {//si la cantidad del producto es 1 lo borre
					update_pedido($key['Cod_pedido'],$key['idPedido'],$key['producto'],0);
					header("Location:../Vistas/user/tomar_pedido.php?nom=".$key['cliente']."&mesa=".$key['mesa']."&id=".$key['idPedido']."");	
				}//si la cantidad del producto es 1 lo borre
				else{////si la cantidad del producto mayor 1 que lo reste
					update_pedido($key['Cod_pedido'],$key['idPedido'],$key['producto'],$key['cantidad']-1);
					header("Location:../Vistas/user/tomar_pedido.php?nom=".$key['cliente']."&mesa=".$key['mesa']."&id=".$key['idPedido']."");	
				}////si la cantidad del producto mayor 1 que lo reste
			}//Si el producto se repite sume la cantidad
		}//Foreach recorre tabla 'pedido'
	}
	elseif ($accion == "elPedido") {//Si quiere eliminar el pedido
		foreach ($tablaPedido as $key) {//FOREACH recorre tabla 'pedido'
			foreach ($tablaStock as $ele) {//Foreach recorre tabla 'stock'
				if ($key['producto'] == $ele['Nombre']) {
					update_stock($ele['Cod_producto'],$ele['Nombre'],$ele['Cantidad']+$key['cantidad']);
				}
			}//Foreach recorre tabla 'stock'
			$mesa=$key['mesa'];
		}//FOREACH recorre tabla 'pedido'
		delete_pedido($idPedido,"d","eliminarPed"); 
		estado_mesa($sucursal,$mesa,"libre");//Para modificar el estado de la mesa
		header("Location:../Vistas/user/menu_pedidos.php");
	}//Si quiere eliminar el pedido
	
 ?>