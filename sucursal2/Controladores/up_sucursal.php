<!DOCTYPE html>
<html>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</html>
<?php
	//include'header.php';
	require'../Modelos/consultas.php';
	$direccion = filter_input(INPUT_POST, 'dir');
	$capacidad = filter_input(INPUT_POST, 'cap');
	postSucursal($direccion,$capacidad);
	$datos = getIdSucursales();
	foreach($datos as $ele){
		$id = $ele['Cod_sucursal'];
	}
	newSucursalStock($id);
?>

<script type="text/javascript">
	Swal.fire({
  		icon: "success",
 		title: "Excelente...",
  		text: "Nueva sucursal ingresada con exito",
  		footer: "",
	});
	window.location.href = "../Vistas/view_sucursales.php"
</script>
