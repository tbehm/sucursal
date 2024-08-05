<?php 
    include 'header_user.php';

    $nombre=filter_input(INPUT_GET,'nom');
    $mesa=filter_input(INPUT_GET,'mesa');
    $accion=filter_input(INPUT_GET,'ac');
    $idPedido=filter_input(INPUT_GET, 'id');
    $sucursal=$_SESSION['Cod_sucursal'];
    $tablaProductos=view_tabla2("productos");
    $tablaStock=view_tabla2("stock WHERE Cod_sucursal='".$sucursal."'");
    $tablaPedido=view_tabla2("pedido WHERE Cod_sucursal='".$sucursal."'");
   
    if ($accion == "nuevo") {//Si es un nuevo pedido
       foreach ($tablaPedido as $key) {//For each obtiene el idPedido
           $idPedido=$key['idPedido'];
       }//For each obtiene el idPedido
       $idPedido++;
    }//Si es un nuevo pedido
    elseif ($accion == "ver") {//si el pedido esta en proceso 
        foreach ($tablaPedido as $key) {//foreach recorre tabla 'pedido' y obtine el cliente y el idPedido
            if ($key['mesa'] == $mesa) {//si para buscar las mesas
                $nombre=$key['cliente'];
                $idPedido=$key['idPedido'];
            }//si para buscar las mesas
        }//foreach recorre tabla 'pedido' y obtine el cliente y el idPedido
    }//si el pedido esta en proceso 

    $tablaPedidoCliente=search_pedido($nombre,$mesa,$idPedido);
    $cantPedido=0;
    $total=0;
    foreach ($tablaPedidoCliente as $key) {//Foreach recorre tabla 'pedido'
        if ($idPedido == $key['idPedido']) {//Si el idPedido coincide
            $cantPedido=$cantPedido+$key['cantidad'];
            foreach ($tablaProductos as $ele) {//Foreach recorre tabla 'producto'
                if ($key['producto']  == $ele['Nombre']) {//si el producto de tabla 'producto' es IGUAL a producto 'pedido' calcule el total
                    for ($i=0; $i < $key['cantidad']; $i++) {//for recorre segun la cantidad del producto
                       $total=$total+$ele['Costo']; 
                    }//for recorre segun la cantidad del producto
                }//si el producto de tabla 'producto' es IGUAL a producto 'pedido' calcule el total
            }//Foreach recorre tabla 'producto'
        }//Si el idPedido coincide
    }//Foreach recorre tabla 'pedido'

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" /> 
    <title>Tomar Pedido</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../styles/style.css">
    <script src="../JavaScript/script.js"></script>
</head>
<body>
    <section class="menu">
        <div class="pedido">
            <div id="carrito" class="carrito">
                    <h2><span class="material-symbols-outlined" style="font-size: 1.7rem;">menu_book</span>Pedido</h2>
                    <p>Cliente: <b><?= $nombre ?></b></p>
                    <p>Cantidad Productos <b><?= $cantPedido ?></b></p>
                    <p>Total: <b>$<?= $total ?></b></p>
                    <button class="buton-carrito-r" onclick="realizar_pedido(<?= $mesa ?>,<?= $idPedido ?>,<?= $sucursal ?> )">   
                        <span class="material-symbols-outlined"  id="buton-ico">check</span>
                        <span class="buton-text">Realizar Pedido</span>
                    </button>
                    <button class="buton-carrito-c" onclick="eliminar_pedido(<?= $idPedido ?>, 'elPedido',<?= $sucursal ?>)">
                        <span class="material-symbols-outlined"  id="buton-ico">close</span>
                        <span class="buton-text">Cancelar Pedido</span>
                    </button>
            </div>

            <div class="pedido-menu">
                <!-- PRODUCTOS DISPONIBLES -->
                <div class="pedido-caja">
                    <h3><span class="material-symbols-outlined">restaurant_menu</span>Productos Disponibles</h3>
                    <table id="table" border="1">
                        <tr>
                            <th>Nombre</th>
                            <th>Descripciòn</th>
                            <th>Precio</th>
                            <th>Agregar</th>
                        </tr>
                    <?php
                        foreach ($tablaProductos as $key) {//Foreach recorre productos de base
                            foreach ($tablaStock as $ele) {//Foreach recorre tabla stock
                                if ($key['Nombre'] == $ele['Nombre'] && $ele['Cantidad']>0) {//SI el producto esta habilitado en la sucursal
                            ?>
                            <tr>
                                <td><?= $key['Nombre'] ?></td>
                                <td><?= $key['Descripcion'] ?></td>
                                <td>$<?= $key['Costo'] ?></td>
                                <td><button class="buton-agregar" onclick="addPedido('<?= $key['Nombre'] ?>',<?= $mesa ?>,<?= $idPedido ?>,'<?= $nombre ?>',<?= $sucursal ?>)"><span class="material-symbols-outlined">add_circle</span></button></td>
                            </tr>                           
                            <?php        
                                }//SI el producto esta habilitado en la sucursal
                            }//Foreach recorre tabla stock
                        }//Foreach recorre productos de base
                    ?>
                    </table>
                </div>
                <!-- PRODUCTOS SELECCIONADOS -->
                <div class="pedido-caja">
                    <h3><span class="material-symbols-outlined">list_alt</span>Pedido</h3>
                    <?php 
                        $tablaPedidoCliente=search_pedido($nombre,$mesa,$idPedido);
                        $val=true;
                        foreach ($tablaPedidoCliente as $ele) {
                            if ($ele['cantidad']>0) {
                                $val=false;
                            }
                        }
                        if (!$val) {//SI ecuentra el pedido meustre el 'pedido'
                            ?>
                            <table id="table" border="1">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Cantidad</th>
                                    <th>Eliminar</th>
                                </tr>
                            <?php
                            foreach ($tablaPedidoCliente as $key) {//Foreaach recoorre tabla 'pedidos'
                                if ($key['cantidad']>0) {
                                ?>
                                <tr>
                                    <td><?= $key['producto'] ?></td>
                                    <td><?= $key['cantidad'] ?></td>
                                    <td>
                                        <button class="buton-agregar" style="background-color: red;" onclick="eliminar_pedidoProducto(<?= $idPedido ?>,'<?= $key['producto'] ?>', 'elProducto')"><span class="material-symbols-outlined">delete</span></button>
                                    </td>
                                </tr>
                                <?php 
                                }  
                            }//Foreaach recoorre tabla 'pedidos' 
                            ?>
                            </table>
                            <?php
                        }//SI ecuentra el pedido meustre el 'pedido'
                        else{
                            echo "<h4>*No se Agrego ningún producto</h4>";
                        }
                     ?>
                </div> 
            </div>
        </div>
    </section>
    
</body>
</html>