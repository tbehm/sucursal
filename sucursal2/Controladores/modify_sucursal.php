<?php
	require'../Modelos/consultas.php';

	$direccion = filter_input(INPUT_POST, 'direccion');
	$capacidad = filter_input(INPUT_POST, 'capacidad');
	$cod_supervisor = filter_input(INPUT_POST, 'supervisor');
	$fecha = filter_input(INPUT_POST, 'fecha');
	$codigo = $_GET['cod'];
	$tablaSucursal=getSucursales("WHERE `Cod_sucursal` = '$codigo'");

	//var_dump($tablaSucursal);
	if ($capacidad > $tablaSucursal[0]['Capacidad']) {//SI quire agregar mesas
		$cant=$capacidad-$tablaSucursal[0]['Capacidad'];
		insert_mesa($cant,$codigo);
	}//SI quire agregar mesas
	elseif ($capacidad < $tablaSucursal[0]['Capacidad']) {//SI quire restar mesas
		$cant=$tablaSucursal[0]['Capacidad']-$capacidad;
		delete_mesa($cant,$codigo);
	}//SI quire restar mesas
 
	echo($direccion.$capacidad.$cod_supervisor.$fecha.$codigo);
	updateSucursal($direccion,$capacidad,$cod_supervisor,$fecha,$codigo);

	header('location:../Vistas/view_sucursales.php')
?>