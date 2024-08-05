<?php
    include 'header.php';
    if (!isset($_SESSION['sucursal'])) {
        header("Location:select.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js" integrity="sha512-L0Shl7nXXzIlBSUUPpxrokqq4ojqgZFQczTYlGjzONGTDAcLremjwaWv5A+EDLnxhQzY5xUZPWLOLqYRkY0Cbw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/style.css">
    <title>Stock</title>
    <style type="text/css">
        .content-stock,.grafico{
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
            margin: 10px 0;
            padding: 20px;
            width: 100%;
        }
    </style>
</head>
<body>
    <section>
        <?php 
            $sucursal=$_SESSION['Cod_sucursal']; 

            $tablaStock=view_tabla("stock WHERE Cod_sucursal='$sucursal'");
         ?>
        <!---------------------------------------------- 
            
                TABLA STOCK 

        ------------------------------------------------>
       
        <!---------------------------------------------- 
            
                GRAFICO STOCK 

        ------------------------------------------------>
        <?php 
            if(empty($tablaStock)){//SI la tabla stock esta vacia muestre un mensaje de si quiere agregar un producto
                echo'<script type="text/javascript">
                            Swal.fire({
                                icon: "question",
                                title: "No hay Productos registrados",
                                text: "Desea ingresar uno?",
                                footer: "",
                            }).then((result) => {
                            if (result.isConfirmed) {
                                add('.$sucursal.','.$tablaProductos.')
                            }});
                        </script>';
            }//SI la tabla stock esta vacia muestre un mensaje de si quiere agregar un producto
            else{//SI La tabla stock no esta vacia muestre el grafico
                ?>
        <div class="grafico">
            <h2>Grafico de Stock</h2>
            <div style="width: 70%;"><canvas id="GraficoStock" style="margin: 10px"></canvas></div>
            <?php
                $dataStock=[];
                $nombreStock=[];
                $stockColor=[];
                foreach($tablaStock as $db){
                    $dataStock[] = $db['Cantidad'];
                    $nombreStock[] = $db['Nombre'];
                }
                $dataStock=json_encode($dataStock);
                $nombreStock=json_encode($nombreStock);
            ?>
            <script src="./JavaScript/infoStock.js"></script>
            <script>graficar(<?=$dataStock?>,<?=$nombreStock?>,"Cantidad","GraficoStock")</script>
        </div>
         <div class="content-stock">
            <h2>Tabla de Stock</h2>
            <table id="table" border="1" width="100%">
                <tr>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Eliminar</th>
                </tr>
                <?php
                    $n=1;
                    $sql="WHERE";
                    foreach($tablaStock as $db){
                        $color = ($n%2)!=0 ? ' ' : 'class="gray"';
                        echo '<tr '.$color.'>
                            <td>'.$db['Nombre'].'</td> 
                            <td>'.$db['Cantidad'].' '.$db['unidad_medicion'].'</td>
                           
                            <td>
                                <a onclick="deleteS('.$db['Cod_producto'].')" style="background: red;cursor:pointer;"<span class="material-symbols-outlined">delete</span></a>
                            </td>
                        </tr>';
                        $sql.=" Nombre != '".$db['Nombre']."' AND";
                        $n++;
                    }  
                    $sql.="1";
                    $sql= str_replace('AND1', " ", $sql);
                    
                    $tablaProductos=json_encode(view_tabla("productos ".$sql));
                ?>     
                <tr>
                    <td>
                        <a style="cursor: pointer;" onclick='add()'>
                            <span class="material-symbols-outlined"  style="background:green;">add</span>
                        </a>
                    </td>
                </tr>  
            </table>
            <h4>Nota: solo los productos que se contabilizan como unidades se descuentan automaticamente, los demas deben ser actualizados manualmente</h4>
        </div> 
        <?php 
            }//SI La tabla stock no esta vacia muestre el grafico
        ?>
            
    </section>
</body>
</html>