<html>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</html>
<?php
	//include'header.php';
	require'../Modelos/consultas.php';
	$cod=filter_input(INPUT_GET, 'codigo');
	if(isset($cod)){
		delete_stock($cod);
	}else{
		header('location:../Vistas/index.php');
	}
	?>
	<script type="text/javascript">
		Swal.fire({
	  		icon: "success",
	 		title: "Realizado...",
	  		text: "Producto eliminado con exito",
	  		showConfirmButton: false,
	  		timer: 1000
		}).then((result) => {
			window.location.href = "../Vistas/infoStock.php"
		});
	</script>

