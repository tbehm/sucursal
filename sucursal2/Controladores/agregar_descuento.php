<?php 
	require '../Modelos/consultas.php';
	$nombre=filter_input(INPUT_POST, 'nombre');
	$descuento=filter_input(INPUT_POST, 'descuento');
	$tablaProductos=view_tabla('productos');
	$fechaD=filter_input(INPUT_POST, 'fecha');
	$productos=[];

	//var_dump($_POST);
	foreach ($tablaProductos as $key) {
		$pro=filter_input(INPUT_POST, 'pro'.$key['Id_producto']);
		if(!empty($pro)){
			//echo $pro;
			array_push($productos,$pro);
		}
	}
	$productos=json_encode($productos );
	insert_descuento($nombre,$descuento,$productos,$fechaD);
 ?>