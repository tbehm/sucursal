<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js" integrity="sha512-L0Shl7nXXzIlBSUUPpxrokqq4ojqgZFQczTYlGjzONGTDAcLremjwaWv5A+EDLnxhQzY5xUZPWLOLqYRkY0Cbw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <link rel="stylesheet" href="../styles/style.css">
    <title>Stock</title>
    <style>
        .content-stock,.grafico{
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
            margin: 10px 0;
            margin-left: 100px;
            padding: 20px;
            width: 85%;
        }
    </style>
</head>
<body>
    <?php 
        include 'header_user.php'; 
        $sucursal=$_SESSION['Cod_sucursal'];
        $tablaStock=view_tabla2("stock WHERE Cod_sucursal='".$sucursal."'");
    ?>
    <section>
        <?php 
            $bajoStock=[];
            foreach($tablaStock as $db){
                if($db['Cantidad']<100) { 
                    array_push($bajoStock, $db['Nombre']);
                }
            }//SI el stock es bajo gurader los nombres
           
            
         ?>
        
        
         <!---------------------------------------------- 
            
                GRAFICO STOCK 

        ------------------------------------------------>
       
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
                $bajoStock=json_encode($bajoStock);     
            ?>
            <script src="../JavaScript/infoStock.js"></script>
            <script>alertStock(<?= $bajoStock ?>)</script>
            <script>graficar(<?=$dataStock?>,<?=$nombreStock?>,"Cantidad","GraficoStock")</script>
        </div>
         <!---------------------------------------------- 
            
                TABLA STOCK 

        ------------------------------------------------>
        <div class="content-stock">
            <h2>Tabla de Stock</h2>
            <table id="table" border="1" width="100%">
                <tr>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Agregar</th>
                </tr>
                <?php
                    $n=1;
                    $bajoStock=[];
                    foreach($tablaStock as $db){
                        if($db['Cantidad']<$db['aviso']) { 
                            array_push($bajoStock, $db['Nombre']);
                        }//SI el stock es bajo gurader los nombres
                        $color = ($n%2)!=0 ? ' ' : 'class="gray"';
                        echo '<tr '.$color.'>
                            <td>'.$db['Nombre'].'</td> 
                            <td>'.$db['Cantidad'].' '.$db['unidad_medicion'].'</td>
                            <td>
                        <a style="cursor: pointer;" onclick="modifyStock('.$db['Cod_producto'].','.$db['Cod_sucursal'].')">
                            <span class="material-symbols-outlined"  style="background:green;">add</span>
                        </a>
                    </td>
                        </tr>';
                        $n++;
                    }
                ?>  
            </table>
        </div> 
    </section>
</body>
</html>