<?php include 'header_user.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="./JavaScript/script.js"></script>
    <link rel="stylesheet" href="../styles/style.css">
    <script src="../JavaScript/script.js"></script>
    <title>Mesas</title>
</head>
<body>
    <section class="menu">
        <h2>Realizar Pedido</h2>
        <ul style="list-style:none;line-height:25px;display: flex;gap:10px;">
            <li>
                <span style="margin-right: 10px;background-color: red;padding: 0px 5px;border: 1px solid black;border-radius: 5px;"> </span>Mesa ocupada
            </li>
            <li>
                <span style="margin-right: 10px;background-color: yellow;padding: 0px 5px;border: 1px solid black;border-radius: 5px;"> </span>Mesa tomando pedido
            </li>
            <li>
                <span style="margin-right: 10px;padding: 0px 5px;border: 1px solid black;border-radius: 5px;"> </span>Mesa Libre
            </li> 
        </ul>
        <div class="local-mesas">
        <?php
            $tablaPedido= view_tabla2("pedido");
            $tablaMesas=view_tabla2("mesas");
            $idSucursal=$_SESSION['Cod_sucursal']; 
            foreach ($tablaMesas as $key) {//foreach recorre tabla 'sucursales'
                if ($key['Cod_sucursal'] == $idSucursal) {//si para saber que sucursal pertenece
                       if ($key['estado'] == 'ocupada') {//si la mesa esta ocupada
                            $estadoMesa="background-color: red;";
                            $accion="ver_pedido(".$key['mesa'].",'finalizado')";
                       }//si la mesa esta ocupada
                       else if ($key['estado'] == "en proceso") {//Si a la mesa le entan tomando el pedido
                            $estadoMesa="background-color: yellow;";
                            $accion="ver_pedido(".$key['mesa'].",'proceso')";
                       }//Si a la mesa le entan tomando el pedido
                       else{//si la mesa esta libre
                            $estadoMesa="background-color: white;";
                            $accion="nombre(".$key['mesa'].")";
                       }//si la mesa esta libre  
                       ?>
                        <div class="mesas" onclick="<?= $accion?>" style="<?= $estadoMesa ?>cursor:pointer;">
                            Mesa <?= $key['mesa'] ?>
                        </div>
                       <?php
                    }//Muestra enm pantalla las mesas        
                }//si para saber que sucursal pertenece      
        ?>
        </div>
        <h4 style="color: grey;">*A la hora de hacer el pedido se debe ingresar un producto para poder tomar el pedido</h4>
    </section>
</body>
</html>