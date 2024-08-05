<!DOCTYPE html>
<html>
<head>
	<title>Tabla</title>
</head>
<body>
	<table border="1" style="border-collapse: collapse;width: 100%;">
		<tr>
			<th>codPedido</th>
			<th>idPEdido</th>
			<th>Producto</th>
			<th>cantidad</th>
			<th>fecha</th>
			<th>cliente</th>
			<th>mesa</th>
		</tr>
	<?php 
		require '../../Modelos/consultas.php';

		$tabla=view_tabla2("pedido");
		foreach ($tabla as $key) {
			?>
			<tr>
				<td><?= $key['Cod_pedido'] ?></td>
				<td><?= $key['idPedido'] ?></td>
				<td><?= $key['producto'] ?></td>
				<td><?= $key['cantidad'] ?></td>
				<td><?= $key['fecha'] ?></td>
				<td><?= $key['cliente'] ?></td>
				<td><?= $key['mesa'] ?></td>
			</tr>	
			<?php
		}
	 ?>
	 </table>
</body>
</html>