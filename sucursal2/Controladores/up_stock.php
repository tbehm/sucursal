<!DOCTYPE html>
<html>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</html>
<?php
	//include'header.php';
	require'../Modelos/consultas.php';
	$Nombre = filter_input(INPUT_POST, 'nom');
	$un = filter_input(INPUT_POST, 'unidad');
	$av = filter_input(INPUT_POST, 'aviso');

	insert_stock($Nombre,$un,$av);
		
?>

<script type="text/javascript">
	Swal.fire({
  		icon: "success",
 		title: "Excelente...",
  		text: "Producto ingresado con exito",
  		showConfirmButton: false,
  		timer: 1000
	}).then((result) => {
		window.location.href = "../Vistas/infoStock.php"
	});
</script>
