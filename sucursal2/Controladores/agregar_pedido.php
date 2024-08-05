<?php 
	require '../Modelos/consultas.php';

	$nombre=filter_input(INPUT_GET,'nom');
	$producto=filter_input(INPUT_GET,'pro');
	$mesa=filter_input(INPUT_GET,'mesa');
	$idPedido=filter_input(INPUT_GET,'id');
	$sucursal=filter_input(INPUT_GET, 'suc');//LA sucursal a la que pertenece del pedido

	$val=true;
	$tablaPedido=view_tabla("pedido WHERE idPedido='".$idPedido."'");
	foreach ($tablaPedido as $key) {//Foreach recorre tabla 'pedido'
		if ($producto == $key['producto']) {//Si el producto se repite sume la cantidad
			update_pedido($key['Cod_pedido'],$key['idPedido'],$key['producto'],$key['cantidad']+1);
			$val=false;
		}//Si el producto se repite sume la cantidad
	}//Foreach recorre tabla 'pedido'

	if ($val) {
		agregar_pedido($producto,$nombre,'1',$mesa,$idPedido,'tomando..',$sucursal);
		estado_mesa($sucursal,$mesa,"en proceso"); 
	}

	$tablaStock=view_tabla("stock WHERE Cod_sucursal='".$sucursal."'");	
	///CIclo para restar el sotck del producto
	$datos = view_tabla("productos");
	foreach ($tablaPedido as $pedido) {//Foreach recorre tabla 'stock'
		foreach($datos as $prod){
			if($prod['Nombre']==$pedido['producto']){
				$ingredientes=explode(",",$prod['ingredientes']);
				for($ingredientes as $ing){
					desc_stock($ing);
				}
			}

		}
	}//Foreach recorre tabla 'stock'
	header("Location:../Vistas/user/tomar_pedido.php?nom=$nombre&mesa=$mesa&id=$idPedido");
 ?>