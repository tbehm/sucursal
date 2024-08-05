<?php include 'header.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />	
	<link rel="stylesheet" type="text/css" href="./styles/style.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<title>Productos</title>
	<script src="./JavaScript/script.js"></script>
</head>
<body>
	<section>
		<h2>Productos</h2>
		<hr>
		<?php 
			$datos=view_tabla("productos");
			echo"<table id='table'border='1' style='margin:10px ;width:90%'><thead><th>Id Productos</th><th>Nombre</th><th>Descripción</th><th>Precio</th> <th>Editar</th> <th>Eliminar</th></thead>";
			
			foreach($datos as $key){
				if ($key['Id_producto']%2 != 0) {
					echo"<tr>";
				}
				else{
					echo"<tr class='gray'>";
				}
				echo "<td>".$key['Id_producto']."</td><td>".$key['Nombre']."</td><td>".$key['Descripcion']."</td><td>$".$key['Costo']."</td> ";
				echo '<td><a onclick="modifyProducto('.$key['Id_producto'].',`'.$key['Nombre'].'`,`'.$key['Descripcion'].'`,'.$key['Costo'].')" style="background: green;cursor:pointer"<span class="material-symbols-outlined">edit</span></a></td> 
				<td><a onclick="eliminarProducto('.$key['Id_producto'].')" style="background: red;cursor:pointer;"<span class="material-symbols-outlined">delete</span></a></td></tr>';
			}
			echo '<tr><td><a onclick="addProducto()" style="cursor:pointer"><span class="material-symbols-outlined" style="background:green;">add</span></a></td></tr>';
			echo "</table>";
			$tablaProductos=json_encode($datos);
			$fechaD=date('Y-m-d');
		 ?>	
		 <h2 style="border-bottom: 1px solid;">Descuentos</h2>
		 <div class="lista-descuentos">
		 	<button class="boton-descuento" onclick='addDescuento2(<?= $tablaProductos ?>,"<?= $fechaD ?>")'>
		 		<span class="material-symbols-outlined" id="boton-descuento">new_label</span>
		 	</button>
		 	
		 </div>
	</section>
</body>
</html>