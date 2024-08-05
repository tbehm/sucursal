<?php 
	require '../Modelos/consultas.php';
	
	$nombre=filter_input(INPUT_GET, 'ing_nom');
	$descri=filter_input(INPUT_GET, 'ing_des');
	$precio=filter_input(INPUT_GET, 'ing_pre');
	
	$res_consul = insert_producto($nombre,$descri,$precio);

	echo $res_consul;
	if ($res_consul) {
		echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<script>Swal.fire({
			title: "Se agrego el producto!", 
			icon: "success",
			showConfirmButton: false,
			timer: 1000,
		}).then((res)=>{
			if (res) {//UNA VEZ LO ACEPTE LO REDIRECCIONE A UNA PAGINA
				window.location.assign("../Vistas/view_productos.php");
			}//UNA VEZ LO ACEPTE LO REDIRECCIONE A UNA PAGINA
		});</script>';
	}
	else{
		echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<script>Swal.fire({
			title: "No se pudo agregar el producto!", 
			icon: "error",
			showConfirmButton: false,
			timer: 1000,
		}).then((res)=>{
			if (res) {//UNA VEZ LO ACEPTE LO REDIRECCIONE A UNA PAGINA
				window.location.assign("../Vistas/view_productos.php");
			}//UNA VEZ LO ACEPTE LO REDIRECCIONE A UNA PAGINA
		});</script>';
	}
	//echo $conexion->lastlnsertld();
 ?>