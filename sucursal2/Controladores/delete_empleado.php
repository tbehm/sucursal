<html>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</html>
<?php
	//include'header.php';
	require'../Modelos/consultas.php';
	$cod=filter_input(INPUT_GET, 'codigo');
	if(isset($cod)){
		deleteEmpleado($cod);
	}else{
		header('location:../Vistas/index.php');
	}
	?>
	<script type="text/javascript">
		Swal.fire({
	  		icon: "success",
	 		title: "Realizado...",
	  		text: "Empleado eliminado con exito",
	  		footer: "",
		}).then((result) => {
    if (result.isConfirmed) {
    	console.log("view")
		window.location.href = "../Vistas/view_empleados.php"
	}});
	</script>

