<?php include_once 'header.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Sucursales</title>
</head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="styles/style.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
	<script src="JavaScript/view_sucursales.js
"></script>
<body>
	<section>
		<h2 style="border-bottom: 1px solid black">Sucursales</h2>
		<?php
			echo"<table id='table'border='1' style='margin:10px ;width:90%'><thead><th>Cod. Sucursal</th><th>Dirección</th><th>Mesas</th><th>Fecha de alta</th><th>Empleado a cargo</th><th>Modificar</th><th>Eliminar</th></thead><tbody>";
			if(isset($_GET['mod'])){#SI DESEA MODIFICAR
				$cod = $_GET['codigo'];
				$datos=getSucursales("WHERE `Cod_sucursal` = '$cod'");
				$a="";
				foreach ($datos as $elemento) {
					$a=$elemento['Cod_sucursal'];
					$a=$a.",".'"'.$elemento['Direccion'].'"';
					$a=$a.",".$elemento['Capacidad'];
					$a=$a.",".'"'.$elemento['Cod_supervisor'].'"';
					$a=$a.",".'"'.$elemento['Fecha'].'"';
				}
				echo"<script>modificar(".$a.")</script>";		
			}
				$datos=getSucursales();
				if(empty($datos)){ #SI NO HAY SUCURSALES CARGADAS
					echo'<tr><td><a><span class="material-symbols-outlined" onclick="add()">add</span></a></td></tr>';
					echo'<script type="text/javascript">
							Swal.fire({
			  					icon: "question",
			 					title: "No hay sucursales registradas",
			  					text: "Desea ingresar una?",
			  					footer: "",
							}).then((result) => {
		    				if (result.isConfirmed) {
								add()
							}});
						</script>';
				}
				else{#SI HAY SUCURSALES
				
				$c=0;
				foreach($datos as $elemento){
					$c++;
					if($c%2==0){
						echo"<tr class='gray'>";
					}
					else{
						echo"<tr class='white'>";

					}
					echo"<td>".$elemento['Cod_sucursal']."</td><td>".$elemento['Direccion']."</td><td>".$elemento['Capacidad']."</td><td>".$elemento['Fecha']."</td><td>".$elemento['Cod_supervisor']."</td>";
					echo'<td><a href="view_sucursales.php?mod=true&codigo='.$elemento['Cod_sucursal'].'"><span class="material-symbols-outlined" >edit</span></a></td>
		                <td><span onclick="eliminar('.$elemento['Cod_sucursal'].')" class="material-symbols-outlined" style="background-color: #F33627">delete</span></td></tr>';
		            
				}
				echo'<tr><td><a><span class="material-symbols-outlined" onclick="add()">add</span></a></td></tr></tbody></table>';
				}
			
		?>		
	</section>
</body>
</html>
