<?php include 'header_user.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos</title>
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" /> 
</head>
<body>
    <section class="menu">
        <div class="estado-pedidos">
            <div class="estado-pedidos-div">
                <h3>
                    <span class="material-symbols-outlined">order_play</span>
                    En preparación 
                </h3>
                <div id="pedido-no-preparado">
                <?php 
                    $tablaPedidos=view_tabla2("pedido");
                    $tablaMesas=view_tabla2("mesas");
                    $val=true;

                    foreach ($tablaMesas as $key) {//FOREACH a tabla 'mesas'
                        if ($key['estado'] == "ocupada") {//SI la mesa ya ordeno su pedido
                            foreach ($tablaPedidos as $ele) {//FOREACH a tabla 'pedidos'
                                if ($key['mesa'] == $ele['mesa']) {//SI la mesa ocupado coincide en la tabla pedido
                                    if ($ele['estado']=="en preparacion") {//Si el pedido esta en preparacion muetre el nombre y mesa del cliente
                                    ?>
                                    <div style="background-color: lightgoldenrodyellow;border-color: yellow;cursor: move;" data-id="<?=$ele['idPedido']?>">
                                        Cliente: <?= $ele['cliente'] ?><br>
                                        Mesa: <?= $ele['mesa'] ?>
                                    </div>
                                    <?php 
                                    break;
                                    }//Si el pedido esta en preparacion muetre el nombre y mesa del cliente
                                    
                                }//SI la mesa ocupado coincide en la tabla pedido
                            }//FOREACH a tabla 'pedidos'
                        }//SI la mesa ya ordeno su pedido
                        
                    }//FOREACH a tabla 'mesas'
                 ?>	
                </div>
            </div>
            <div class="estado-pedidos-div">
                <h3>
                    <span class="material-symbols-outlined">order_approve</span>
                    Preparada    
                </h3>
               	<div id="pedido-preparado">
	               	<?php 

                    foreach ($tablaMesas as $key) {//FOREACH a tabla 'mesas'
                        if ($key['estado'] == "ocupada") {//SI la mesa ya ordeno su pedido
                            foreach ($tablaPedidos as $ele) {//FOREACH a tabla 'pedidos'
                                if ($key['mesa'] == $ele['mesa']) {//SI la mesa ocupado coincide en la tabla pedido
                                    if ($ele['estado']=="preparado") {//Si el pedido esta preparado muetre el nombre y mesa del cliente
                                    ?>
                                    <div style="background-color: palegreen;border-color: green;cursor:move;" data-id="<?=$ele['idPedido']?>">
                                        Cliente: <?= $ele['cliente'] ?><br>
                                        Mesa: <?= $ele['mesa'] ?>
                                    </div>
                                    <?php
                                    break;  
                                    }//Si el pedido esta preparado muetre el nombre y mesa del cliente
                                }//SI la mesa ocupado coincide en la tabla pedido
                            }//FOREACH a tabla 'pedidos'
                        }//SI la mesa ya ordeno su pedido
                        
                    }//FOREACH a tabla 'mesas'
                 ?>	
               	</div>
            </div>
        </div>
    </section>
	<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../JavaScript/pedido.js"></script>
</body>
</html>