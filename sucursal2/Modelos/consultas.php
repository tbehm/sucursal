<?php
/*********************************************
*
*	AGREGADO CAJA
*
********************************************* */
define("URL", "C:/xampp/htdocs/sucursalV10/sucursaltizi/sucursal-main/sucursal/Modelos/conexion.php");
if (session_status() == PHP_SESSION_NONE) {
    session_start(); 
}
function getIngredientes($name){
		require '../Modelos/conexion.php';
		$change=$conexion->prepare("SELECT ingredientes FROM productos WHERE Nombre LIKE '%".$name."%'");
	    $change->execute();
	    return $change->fetchAll(PDO::FETCH_ASSOC);
	}
function getColors(){
	require 'conexion.php';
		$consulta=$conexion->prepare("SELECT * FROM infosucursal");
		$consulta->execute();
		return $consulta->fetchAll(PDO::FETCH_ASSOC);
}
function updateColors($bg, $th, $head, $font, $btn, $aside, $aside_btn){
	require '../Modelos/conexion.php';
	$change=$conexion->prepare("UPDATE infosucursal SET bg_color='$bg', table_color='$th', header_color='$head', font='$font', btn='$btn', aside= '$aside', aside_btn= '$aside_btn'");
    $change->execute();
}
function cerrarCaja(){
		require '../Modelos/conexion.php';
		date_default_timezone_set("AMerica/Argentina/Buenos_Aires");
		$fecha = date("Y-m-d");
		$cie=0;
		$change=$conexion->prepare("UPDATE caja SET cierre=$cie WHERE fecha LIKE '%".$fecha."%'");
	    $change->execute();
	}
	function cajaCerrada(){
		require 'conexion.php';
		date_default_timezone_set("AMerica/Argentina/Buenos_Aires");
		$fecha = date("Y-m-d");
		$consulta=$conexion->prepare("SELECT cierre FROM caja WHERE fecha LIKE '%".$fecha."%'");
		$consulta->execute();
		$datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
		foreach($datos as $caja){
			$cierre = $datos[0];
		}
		if(!empty($cierre['cierre'])){
			return true;
		}
		else{
			return false;
		}
	}
	function getCaja($fecha){
		require URL;
		$suc=intval($_SESSION['Cod_sucursal']);
		$consulta=$conexion->prepare("SELECT actual FROM caja WHERE Cod_sucursal=$suc AND fecha LIKE '%".$fecha."%'");
		$consulta->execute();
		return $consulta->fetchAll(PDO::FETCH_ASSOC);
	}
	function getId(){
		require URL;
		date_default_timezone_set("AMerica/Argentina/Buenos_Aires");
			$fecha = date("Y-m-d");
		$suc=$_SESSION['Cod_sucursal'];
		$consulta=$conexion->prepare("SELECT fecha FROM caja WHERE Cod_sucursal=$suc AND fecha LIKE '%".$fecha."%'");
		$consulta->execute();
			return $consulta->fetchAll(PDO::FETCH_ASSOC);
		}
function getGastos($fecha){
	require '../Modelos/conexion.php';
	$consulta=$conexion->prepare("SELECT * FROM gastos WHERE id_caja LIKE '%".$fecha."%'");
	$consulta->execute();
	return $consulta->fetchAll(PDO::FETCH_ASSOC);
}
function getDescGasto($fecha){
	require '../Modelos/conexion.php';
	$consulta=$conexion->prepare("SELECT * FROM gastos WHERE id_caja LIKE '%".$fecha."%'");
	$consulta->execute();
	return $consulta->fetchAll(PDO::FETCH_ASSOC);
	
}
function postGasto($monto, $desc,$id_caja,$hora,$fecha){
		require '../Modelos/conexion.php';
		$consulta= $conexion->prepare("INSERT INTO `gastos` (`id_caja`,`hora`,`descripcion`,`monto`) VALUES(:id, :hora, :des, :mon)");
		$consulta->bindParam(':id',$id_caja);
		$consulta->bindParam(':hora',$hora);
		$consulta->bindParam(':des', $desc);
		$consulta->bindParam(':mon',$monto);
		$consulta->execute();
		updateCaja($monto,"-");
	}
	function updateCaja($monto,$ope){

		require '../Modelos/conexion.php';
		date_default_timezone_set("AMerica/Argentina/Buenos_Aires");
		$fecha = date("Y-m-d");
		$caja = getCaja($fecha);
		switch ($ope) {
			case '-':
				foreach($caja as $valor){
					$actual=$valor['actual']-$monto;
				}
				break;
			
			case '+':
				foreach($caja as $valor){
					$actual=$valor['actual']+$monto;
				}
				break;
		}
		
		var_dump($actual);
		//var_dump($fecha);
		$change=$conexion->prepare("UPDATE caja SET actual=:act WHERE fecha LIKE '%".$fecha."%'");
	    $change->bindParam(':act',$actual);
	    $change->execute();

	}
function updateGasto($id){
	require'../Modelos/conexion.php';
	date_default_timezone_set("AMerica/Argentina/Buenos_Aires");
	$fecha = date("Y-m-d");
	$datos = getDescGasto($fecha);
	foreach($datos as $gasto){
		if($gasto['hora']==$id){
			$desc="(canceled)".$gasto['descripcion'];
		}
	}
	$change=$conexion->prepare("UPDATE gastos SET descripcion=:des WHERE hora= :id ");
	$change->bindParam(':id',$id);
	$change->bindParam(':des',$desc);
	$change->execute();
}

function postOpen($importe,$encargado){

	require URL;
	$consulta=$conexion->prepare("INSERT INTO `caja` (`apertura`,`actual`,`encargado`,`Cod_sucursal`) VALUES(:ap, :ac, :enc, :suc)");
	$consulta->bindParam(':ap',$importe);
	$consulta->bindParam(':ac',$importe);
	$consulta->bindParam(':enc',$encargado);
	$consulta->bindParam(':suc',$_SESSION['Cod_sucursal']);


}

/*********************************************
*
*	CRUD SUCURSAL
*
********************************************* */

	function deleteSucursal($cod){
		require'../Modelos/conexion.php';
		$consulta=$conexion->prepare("DELETE FROM sucursales WHERE Cod_sucursal=:cod");
		$consulta->bindParam(":cod",$cod);
		$consulta->execute();
	}
	function getSucursales($one=" "){
		require'../Modelos/conexion.php';
		$consulta = $conexion->prepare("SELECT * FROM sucursales $one");
		$consulta->execute();
		$datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
		return $datos;
	}

	function updateSucursal($dire,$capa,$co,$fecha,$cod){
		require'../Modelos/conexion.php';
		$change=$conexion->prepare("UPDATE sucursales SET Direccion=:dir, Capacidad=:cap, Cod_supervisor=:cod_s, Fecha=:fec WHERE sucursales.Cod_sucursal= :code ");
	    $change->bindParam(':dir',$dire);
	    $change->bindParam(':cap',$capa);
	    $change->bindParam(':cod_s',$co);
	    $change->bindParam(':fec',$fecha);
	    $change->bindParam(':code',$cod);
	    $change->execute();
	}

	function postSucursal($dir,$cap){
		require'../Modelos/conexion.php';
        date_default_timezone_set("AMerica/Argentina/Buenos_Aires");
		$fecha = date("Y-m-d");
		$insert = $conexion->prepare("INSERT INTO `sucursales` (`Direccion`,`Capacidad`,`Cod_supervisor`,`Fecha`) VALUES (:dir, :cap, '1', :fec)");
		$insert->bindParam(':dir',$dir);
		$insert->bindParam(':cap',$cap);
		$insert->bindParam(':fec',$fecha);
		if ($insert->execute()) {//SI se agrego la sucursal agrege las mesas
			$tablaSucursales=getSucursales();
			foreach ($tablaSucursales as $key) {
				$cod=$key['Cod_sucursal'];
			}
			insert_mesa($cap,$cod);
		}//SI se agrego la sucursal agrege las mesas
		return $insert;
	}

	function getSucursalByDireccion($dir){
		require '../Modelos/conexion.php';
		$consulta = $conexion->prepare("SELECT * FROM sucursales WHERE Direccion LIKE '%".$dir."%'");
		$consulta->execute();
		$datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
		return $datos;
	}

/*********************************************
*
*	CRUD EMPLEADOS
*
********************************************* */
	function deleteEmpleado($cod){
		require'../Modelos/conexion.php';
		$consulta=$conexion->prepare("DELETE FROM empleados WHERE id_empleado=:id");
	    $consulta->bindParam(":id",$cod);
	    $consulta->execute();
	}
	function getEmpleados($one=" "){
		require'../Modelos/conexion.php';
		$consulta = $conexion->prepare("SELECT * FROM empleados $one");
		$consulta->execute();
		$datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
		return $datos;
	}

	function updateEmpleado($id,$dni,$clave,$name,$ape,$tel,$dir,$fn,$puesto,$sueldo){
		require'../Modelos/conexion.php';
		$change=$conexion->prepare("UPDATE empleados SET Nombre=:name, Apellido=:ape, Telefono=:tel, Direccion=:dir, Fnac=:fn, Puesto=:puesto, Sueldo=:sueldo, DNI=:dni, Clave=:cla WHERE empleados.id_empleado= :id ");
	    $change->bindParam(':id',$id);
	    $change->bindParam(':dni',$dni);
	    $change->bindParam(':cla',$clave);
	    $change->bindParam(':name',$name);
	    $change->bindParam(':ape',$ape);
	    $change->bindParam(':tel',$tel);
	    $change->bindParam(':dir',$dir);
	   	$change->bindParam(':fn',$fn);
	    $change->bindParam(':puesto',$puesto);
	    $change->bindParam(':sueldo',$sueldo);
	    $change->execute();
	}
	

	function postEmpleado($dni,$clave,$name,$ape,$tel,$dir,$fn,$puesto,$sueldo,$sucursal){
		require'../Modelos/conexion.php';
        date_default_timezone_set("AMerica/Argentina/Buenos_Aires");
		$fecha = date("Y-m-d");
		#id_empleado	DNI	Nombre	Apellido	Telefono	Direccion	Ingreso	Fnac	Puesto	Sueldo	

		$insert = $conexion->prepare("INSERT INTO `empleados` (`DNI`,`Clave`,`Nombre`,`Apellido`,`Telefono`,`Direccion`,`Ingreso`,`Fnac`,`Puesto`,`Sueldo`,`Cod_sucursal`) VALUES (:dni, :cla, :nom, :ape, :tel, :dir, :ing, :fec, :pst, :sld, :cod)");
		$insert->bindParam(':dni',$dni);
		$insert->bindParam(':cla',$clave);
	    $insert->bindParam(':nom',$name);
	    $insert->bindParam(':ape',$ape);
	    $insert->bindParam(':tel',$tel);
	    $insert->bindParam(':dir',$dir);
	    $insert->bindParam(':ing',$fecha);
	   	$insert->bindParam(':fec',$fn);
	    $insert->bindParam(':pst',$puesto);
	    $insert->bindParam(':sld',$sueldo);
	    $insert->bindParam(':cod',$sucursal);
		$insert->execute();
	}

	/****************************************
	*
	*	FUNCIONES ESTADISTICAS VENTAS
	*
	**********************************/
	function getVentas(){
		require'../Modelos/conexion.php';
		$consulta = $conexion->prepare("SELECT * FROM pedido");
		$consulta->execute();
        	$datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
		return $datos;
	}

	function getPedidosEstadisticas($sql){
		require '../Modelos/conexion.php';
		$consulta=$conexion->prepare($sql);
		$consulta->execute();
		$datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
		return count($datos);
	}	

	function getProductos(){
		require '../Modelos/conexion.php';
		$consulta=$conexion->prepare("SELECT Nombre FROM productos");
		$consulta->execute();
		return $consulta->fetchAll(PDO::FETCH_ASSOC);
	}
	/****************************************
	*
	*	FUNCIONES LOGIN
	*
	**********************************/
	function userExists($DNI, $Clave) {
		require '../Modelos/conexion.php';
		$consulta = $conexion->prepare("SELECT empleados.Nombre, empleados.DNI, sucursales.Direccion, sucursales.Cod_sucursal FROM empleados JOIN sucursales ON empleados.Cod_sucursal=sucursales.Cod_sucursal WHERE empleados.DNI='$DNI' AND empleados.Clave='$Clave'");
		$consulta->execute();
		$datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
		return $datos;
   }

   /****************************************
	*
	*	FUNCIONES PRODUCTOS
	*
	**********************************/
	function delete_producto($cod){
		require'../Modelos/conexion.php';
		$consulta=$conexion->prepare("DELETE FROM productos WHERE Id_producto=:cod");
	    $consulta->bindParam(":cod",$cod);
	    $consulta->execute();
	}

	function view_tabla($nombre){
		require'../Modelos/conexion.php';
		$consulta = $conexion->prepare("SELECT * FROM $nombre");
		$consulta->execute();
		$datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
		return $datos;
	}
	
	function view_tabla2($nombre){
		require'../../Modelos/conexion.php';
		$consulta = $conexion->prepare("SELECT * FROM $nombre");
		$consulta->execute();
		$datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
		return $datos;
	}

	//FUNCIONES PRODUCTOS
	function update_producto($id,$nombre,$descri,$precio){
		require'../Modelos/conexion.php';
		$consulta=$conexion->prepare(" UPDATE productos SET Nombre=:nom, Descripcion=:des, Costo=:pre WHERE productos.Id_producto=:id;");	    
		$consulta->bindParam(':nom',$nombre);
		$consulta->bindParam(':des',$descri);
	    $consulta->bindParam(':pre',$precio);
	    $consulta->bindParam(':id',$id);
	    $consulta->execute();
	}

	function insert_producto($nombre,$descri,$precio){
		require'../Modelos/conexion.php';
		$consulta = $conexion->prepare("SELECT Id_producto FROM productos");
		$consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        $nump_id=0;
        foreach($datos as $elemento){
        	if ($elemento['Id_producto'] > $nump_id) {
        		$nump_id = $elemento['Id_producto'];
        	}
        }
        $nump_id++;
        //echo $nump_id;
        $consulta=$conexion-> prepare("INSERT INTO `productos` (`Nombre`, `Id_producto`, `Descripcion`, `Costo`) VALUES (:nom, :id, :des, :pre);");
		$consulta->bindParam(':nom',$nombre);//el bindParam vincula la variable 'nroHistoria' con otra nueva(:nroHist)
		$consulta->bindParam(':des',$descri);
	    $consulta->bindParam(':pre',$precio);
	    $consulta->bindParam(':id',$nump_id);
	    return $consulta->execute();
	}

	/****************************************
	*
	*	FUNCIONES CRUD PEDIDOS
	*
	**********************************/
	function search_pedido($nombre,$mesa,$id){
		require'../../Modelos/conexion.php';
		$consulta = $conexion->prepare("SELECT * FROM pedido WHERE `idPedido` = '$id' AND `cliente` = '$nombre' AND `mesa` = '$mesa' ");
		$consulta->execute();
		$datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
		return $datos;
	}

	function agregar_pedido($producto,$nombre,$cant,$mesa,$id,$estado,$sucursal){
		require'../Modelos/conexion.php';
		$consulta = $conexion->prepare("SELECT Cod_pedido FROM pedido");
		$consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        $nump_id=0;
        foreach($datos as $elemento){
        	if ($elemento['Cod_pedido']>$nump_id) {
        		$nump_id = $elemento['Cod_pedido'];
        	}
        }
        $nump_id++;
		date_default_timezone_set("AMerica/Argentina/Buenos_Aires");

        //echo $nump_id;
        $fecha=date("Y-m-d");
		$hora=date("H:i:s");
        $consulta=$conexion-> prepare("INSERT INTO `pedido` (`Cod_pedido`, `idPedido`, `producto`, `cantidad`, `fecha`, `cliente`, `mesa`, `estado`,`Cod_sucursal`,`hora`) VALUES (:cod, :id, :pro, :cant, :fec, :nom, :mesa, :est, :suc, :hor);");
        $consulta->bindParam(':mesa',$mesa);
		$consulta->bindParam(':nom',$nombre);//el bindParam vincula la variable 'nroHistoria' con otra nueva(:nroHist)
		$consulta->bindParam(':fec',$fecha);
	    $consulta->bindParam(':cant',$cant);
	    $consulta->bindParam(':pro',$producto);
	    $consulta->bindParam(':id',$id);
	    $consulta->bindParam(':est',$estado);
	    $consulta->bindParam(':cod',$nump_id);
	    $consulta->bindParam(':suc',$sucursal);
		$consulta->bindParam(':hor',$hora);
	    return $consulta->execute();
	}

	function update_pedido($cod,$id,$producto,$cant){
		require'../Modelos/conexion.php';
		$consulta=$conexion->prepare(" UPDATE pedido SET idPedido=:id, producto=:pro, cantidad=:cant WHERE pedido.Cod_pedido=:cod;");
	    $consulta->bindParam(':cant',$cant);
	    $consulta->bindParam(':pro',$producto);
	    $consulta->bindParam(':id',$id);
	    $consulta->bindParam(':cod',$cod);
	    $consulta->execute();
	}

	function delete_pedido($id,$producto,$accion){
		require'../Modelos/conexion.php';
		if ($accion == "eliminarPro") {//Si eliminar el producto del pedido
			$consulta=$conexion->prepare("DELETE FROM pedido WHERE idPedido=:id AND producto=:pro");
			$consulta->bindParam(":pro",$producto);
		}//Si eliminar el producto del pedido
		else if ($accion == "eliminarPed") {//Si eliminar el pedido
			$consulta=$conexion->prepare("DELETE FROM pedido WHERE idPedido=:id");
		}//Si eliminar el pedido
	    $consulta->bindParam(":id",$id);
	    $consulta->execute();
	}

	function estado_pedido($estado,$id){
		require '../Modelos/conexion.php';
		$consulta=$conexion->prepare(" UPDATE pedido SET estado=:est WHERE pedido.idPedido=:id;");
	    $consulta->bindParam(':est',$estado);
	    $consulta->bindParam(':id',$id);
	    $consulta->execute();
	}

	/*******************************
	*
	*	FUNCIONES DE MESAS
	*
	*************************************/
	function insert_mesa($cant,$codS){
		require '../Modelos/conexion.php';
		$consulta = $conexion->prepare("SELECT * FROM mesas");
		$consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        $id=0;
        $mesa=0;
        foreach($datos as $elemento){
        	$id = $elemento['cod_mesa'];
        	if ($elemento['Cod_sucursal'] == $codS) {
        		$mesa=$elemento['mesa'];
        	}
        }
        $id++;
        $mesa++;
		for ($i=1; $i <= $cant; $i++) {
			$insert = $conexion->prepare("INSERT INTO `mesas` (`cod_mesa`,`Cod_sucursal`,`mesa`,`estado`) VALUES (:id, :cods, :mes, 'libre')");
			$insert->bindParam(':id',$id);
			$insert->bindParam(':cods',$codS);
			$insert->bindParam(':mes',$mesa);
			$insert->execute();
			$id++;
			$mesa++;
		}
	}

	function delete_mesa($cant,$codS){
		require '../Modelos/conexion.php';
		if ($cant>0) {//SI elimina algunas mesas
			$consulta = $conexion->prepare("SELECT * FROM mesas WHERE Cod_sucursal='$codS'");
			$consulta->execute();
	        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);

	        for ($i=count($datos)-1; $i > ((count($datos)-1)-$cant) ; $i--) { 
	        	$consulta = $conexion->prepare("DELETE FROM mesas WHERE cod_mesa='".$datos[$i]['cod_mesa']."'");
				$consulta->execute();
	        }

		}//SI elimina algunas mesas
		else{//SI elimina todas las mesas
			$consulta = $conexion->prepare("DELETE FROM mesas WHERE Cod_sucursal='$codS'");
			$consulta->execute();
		}//SI elimina todas las mesas
	}

	function estado_mesa($cod,$mesa,$estado){
		require'../Modelos/conexion.php';
		$consulta=$conexion->prepare(" UPDATE mesas SET estado=:est WHERE mesas.cod_sucursal=:cod AND mesas.mesa=:mesa;");
		$consulta->bindParam(':est',$estado);
	    $consulta->bindParam(':mesa',$mesa);
	    $consulta->bindParam(':cod',$cod);
	    $consulta->execute();
	}
	/****************************************
	*
	*	FUNCIONES EDITAR LOGO Y TITULO
	*
	**********************************/
	function editLocal($nombre,$logo){
		require '../Modelos/conexion.php';
		$consulta=$conexion->prepare(" UPDATE infosucursal SET nombre=:tit, logo=:log WHERE infosucursal.id='1';");
		$consulta->bindParam(':tit',$nombre);
	    $consulta->bindParam(':log',$logo);
	    $consulta->execute();
	}
	/****************************************
	*
	*	FUNCIONES CRUD STOCK
	*
	**********************************/
	function getIdSucursales(){
		require'../Modelos/conexion.php';
		$consulta = $conexion->prepare("SELECT Cod_sucursal FROM sucursales");
		$consulta->execute();
		return $consulta->fetchAll(PDO::FETCH_ASSOC);
	}

	function getProds(){
		require'../Modelos/conexion.php';
		$consulta = $conexion->prepare("SELECT * FROM stock WHERE Cod_sucursal=2");
		$consulta->execute();
		return $consulta->fetchAll(PDO::FETCH_ASSOC);
	}
	function newSucursalStock($id){
		require'../Modelos/conexion.php';
		$cant = getProds();
        foreach($cant as $prod){
        	$cod = $prod['Cod_producto'];
        	$nom= $prod['Nombre'];
        	$un = $prod['unidad_medicion'];
        	$av = $prod['aviso'];
        	var_dump($id);
 			$consulta=$conexion->prepare("INSERT INTO `stock` (`Cod_producto`, `Nombre`, `Cantidad`, `Cod_sucursal`, `unidad_medicion`, `aviso`) VALUES ('$cod', '$nom', '--', '$id', '$un', '$av')");        	
	    	$consulta->execute();
	    }
	}
	function insert_stock($nombre, $un, $av){
		require'../Modelos/conexion.php';
		$cant = getProds();
		$cant = count($cant)+1;
		$sucursales = getIdSucursales();
        foreach($sucursales as $elemento){
        	$suc = $elemento['Cod_sucursal'];
 			$consulta=$conexion->prepare("INSERT INTO `stock` (`Cod_producto`, `Nombre`, `Cantidad`,`Cod_sucursal`, `unidad_medicion`, `aviso`) VALUES ('$cant', '$nombre', '--', '$suc', '$un', '$av')");        	
	    	$consulta->execute();
	    }
	}
	function delete_stock($cod){
		require'../Modelos/conexion.php';
		$consulta=$conexion->prepare("DELETE FROM stock WHERE Cod_producto=:cod");
	    $consulta->bindParam(":cod",$cod);
	    $consulta->execute();
	}
	function desc_stock($name){
		require'../Modelos/conexion.php';
		$consulta=$conexion->prepare(" UPDATE stock SET cantidad=cantidad-1 WHERE Nombre=:nam AND Cod_sucursal=:sucursal;");
	    $consulta->bindParam(':nam',$name);
	    $suc = $_SESSION['Cod_sucursal'];
	   	$consulta->bindParam(':sucursal',$suc);
	    $consulta->execute();
	}

	function update_stock($cod,$cant,$suc){
		require'../Modelos/conexion.php';
		$consulta=$conexion->prepare(" UPDATE stock SET cantidad=cantidad+:cant WHERE stock.Cod_producto=:cod and Cod_sucursal=:sucursal;");
	    $consulta->bindParam(':cant',$cant);
	    $consulta->bindParam(':cod',$cod);
	   	$consulta->bindParam(':sucursal',$suc);
	    $consulta->execute();
	}

	/*****************************************
	 * 
	 * 		FUNCIONES DESCUENTOS
	 * 
	 ****************************************/

	 function insert_descuento($nombre,$descuento,$productos,$fecha) {
		var_dump($productos);
		require'../Modelos/conexion.php';
		$consulta = $conexion->prepare("SELECT * FROM promociones");
		$consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        $nump_id=0;
        foreach($datos as $elemento){
        	if ($elemento['id_promo']>$nump_id) {
        		$nump_id = $elemento['id_promo'];
        	}
        }
        $nump_id++;
        //echo $nump_id;
        $consulta=$conexion-> prepare("INSERT INTO `promociones` (`id_promo`, `nombre`, `productos`, `precio`,`fechaDuracion`) VALUES (:cod, :nom, :pro,:de,:fec);");
		$consulta->bindParam(':nom',$nombre);//el bindParam vincula la variable 'nroHistoria' con otra nueva(:nroHist)
	    $consulta->bindParam(':pro',$productos);
	    $consulta->bindParam(':cod',$nump_id);
	    $consulta->bindParam(':de',$descuento);
		$consulta->bindParam(':fec',$fecha);
	    $consulta->execute();
	 }
?>