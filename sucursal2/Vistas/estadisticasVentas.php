<?php
    require "header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="widtd=device-widtd, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js" integrity="sha512-L0Shl7nXXzIlBSUUPpxrokqq4ojqgZFQczTYlGjzONGTDAcLremjwaWv5A+EDLnxhQzY5xUZPWLOLqYRkY0Cbw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Estadisticas de ventas</title>
    <style>
        table{
            width: 95%;
            position: relative;
            top: 25px;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 10px;
        }
        tr{
            height: 30px;
        }
        td{
            border-radius: 5px;
        }
        .tablaInicio{
            background-color: gold;
        }

    </style>
</head>
<body>
<h1>Estadisticas de Ventas</h1>
    <div class="estadistica">
        <canvas id="Estadistica" height=50px></canvas>
        <?php
        $producto=[1];
        $cantidad=[];
        foreach(getVentas() as $elemento){
            $productoExistente=true;
            for ($i=0; $i < count($producto); $i++) { 
                if ($elemento['producto'] == $producto[$i]) {
                    $productoExistente=false;
                }
            }
            if ($producto[0] == 1) {
                array_shift($producto);
            }
            if ($productoExistente) {
                array_push($producto, $elemento['producto']);
                array_push($cantidad, intval($elemento['cantidad']));
            }else {
                $casilla = array_search($elemento['producto'],$producto);
                $cantidad[$casilla]=$cantidad[$casilla]+intval($elemento['cantidad']);
            }
        }
        $producto=json_encode($producto);
        $cantidad=json_encode($cantidad);
        
        ?>
        <script>
            let producto = <?php echo $producto; ?>;
            let cantidad = <?php echo $cantidad; ?>;

        function generarLetra(){
            var letras = ["a","b","c","d","e","f","0","1","2","3","4","5","6","7","8","9"];
            var numero = (Math.random()*15).toFixed(0);
            return letras[numero];
        }
            
        function colorHEX(){
            var codColor = "";
            for(var i=0;i<6;i++){
                codColor = codColor + generarLetra() ;
            }
            return "#" + codColor;
        }
        color = []
            for (let x = 0; x < cantidad.length; x++) {
                color.push(colorHEX())
            }

            const ctx = document.getElementById('Estadistica');

            new Chart(ctx, {
              type: 'bar',
              data: {
                labels: producto,
                datasets: [{
                  label: 'Cantidad de ventas',
                  data: cantidad,
                  backgroundColor: color,
                  borderWidth: 1
                }]
              },
              options: {
                scales: {
                  y: {
                    beginAtZero: true
                  }
                }
              }
            });
        </script>
    </div>
    <h2>Linea de ventas</h2>
    <div class="lineaVenta">
        <canvas id="EstadisticaVenta" height=50px></canvas>
        <?php
        $ganancia=[];
        $gananciaPedidos=[];
        $contGanancia=0;
        foreach(getVentas() as $elemento){
            $gananciaExistente=false;
            if ($elemento['fecha'] != end($ganancia)) {
                $gananciaExistente=true;
                array_push($gananciaPedidos,$elemento['cantidad']);
            }else{
                $gananciaPedidos[$contGanancia]=$elemento['cantidad']+$gananciaPedidos[$contGanancia];
            }
            if ($gananciaExistente) {
                array_push($ganancia, $elemento['fecha']);
            }
        }
        $ganancia=json_encode($ganancia);
        $gananciaPedidos=json_encode($gananciaPedidos);
        ?>
        <script>
            const ctxVenta = document.getElementById('EstadisticaVenta');

            const ganancia = <?php echo $ganancia; ?>

            const gananciaCantidad = <?php echo $gananciaPedidos; ?>

            new Chart(ctxVenta, {
              type: 'line',
              data: {
                labels: ganancia,
                datasets: [{ 
                  label: 'Cantidad de ventas',
                  data: gananciaCantidad,
                  backgroundColor: 'gold',
                  borderWidth: 1,
                  fill: true,
                  borderColor: 'rgb(75, 192, 192)',
                  tension: 0.1
                }]
              },
              options: {
                scales: {
                  y: {
                    beginAtZero: true
                  }
                }
              }
            });
        </script>
    </div>
    <h2>Tabla de pedido</h2>
    <?php
        echo '<table border=1>
            <tr class="tablaInicio">
                <td>Id del pedido</td>
                <td>Producto</td>
                <td>Cantidad</td>
                <td>Fecha</td>
                <td>Cliente</td>
            </tr>';
        foreach(getVentas() as $elemento){
        	echo '<tr>
                <td>'.$elemento['idPedido'].'</td>
                <td>'.$elemento['producto'].'</td>
                <td>'.$elemento['cantidad'].'</td>
                <td>'.$elemento['fecha'].'</td>
                <td>'.$elemento['cliente'].'</td>
            </tr>';
        }
    ?>
</body>
</html>