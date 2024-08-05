<?php 
	require '../Modelos/consultas.php';
	$idPedido=filter_input(INPUT_GET, 'id');
	
	$ids=explode(',', $idPedido);
	$tablaMesas=view_tabla("mesas");
	$tablaPedido=view_tabla("pedido");

	foreach ($tablaMesas as $mesa) {
		if($mesa['estado'] == "ocupada"){//Si la mesa esta ocupada
			foreach ($tablaPedido as $pedido) {
				if($mesa['mesa'] == $pedido['mesa'] && $pedido['estado']!="finalizado"){
					estado_pedido("en preparacion",$pedido['idPedido']);
					//echo "fd";
				}
			}
		}//Si la mesa esta ocupada
	}
    if(!empty($idPedido)){//Si envie los ids
        echo "aa";
        for ($i=0; $i < count($ids); $i++) { //For para modificar el estado del pedido a 'preparado'
    		estado_pedido("preparado",$ids[$i]);
    	}//For para modificar el estado del pedido a 'preparado'    
    }//Si envie los ids
		


	header("Location:../Vistas/user/cola_pedidos.php");
 ?>