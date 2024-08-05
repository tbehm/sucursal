<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Pedidos</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">

        function nombre(){
            const contenido=`<form action="pedido.php" method="post">
                Ingrese el nombre del cliente 
                <p>
                <input type="text" name="nombre" placeholder="Ingrese nombre" class="swal2-input" required>
                <p>
                <button type="submit" class="buton-carrito-r">Ingresar</button>
                </form>
                <p style="margin-top:10px;"></p>
                <a href="index.php"><button class="buton-carrito-c">Volver</button></a>`;
            Swal.fire({//MUESTRA UNA VENTANA EMERGENTE PARA INGRESAR NOMBRE
                title: "Pedido",
                html: contenido,
                allowOutsideClick: false,
                showConfirmButton: false,
                footer: "Esta informacion es importante",
            });//MUESTRA UNA VENTANA EMERGENTE PARA INGRESAR NOMBRE
            
        }

        function ingre(array,ubinom) {
            console.log(array);

            let contenido=`<h4>Selecciona los ingredientes</h4>`,p=1;//p es para cambiar nombre a los checkbox
            array.forEach(({nombre,precio,ingredientes})=>{//FOREACH RECORRE JSON
                 if (ubinom == nombre) {//SI EL nombre coincide
                    contenido=contenido+`<form action="pedido.php" method="post">
                    <input type="hidden" name="ing_nom" value="${nombre}">
                    <input type="hidden" name="ing_pre" value="${precio}">
                    <div style="margin:15px 0;">`
                    ingredientes.forEach(elemento =>{//MUESTRA LOS CHECKBOX
                        contenido=contenido+`<label><input type="checkbox" name="in${p}" checked="checked" value="${elemento}">${elemento}</label>     `
                        p++
                    });//MUESTRA LOS CHECKBOX
                    contenido=contenido+`</div><p><button class="buton-producto" name="buton-ingre" type="submit" style="padding:0px 20px;font-size:1rem;height:40px;">Pedir</button></p></form>`
                 }//Si el nombre coincide
            });//FOREACH RECORRE JSON
            Swal.fire({//MUESTRA UNA VENTANA EMERGENTE PARA ELEGIR INGREDIENTES
                title: ubinom,
                html: contenido,
                allowOutsideClick: true,
                showConfirmButton: false,
                showCloseButton: true,
                footer: "Esta informacion es importante",
            });//MUESTRA UNA VENTANA EMERGENTE PARA ELEGIR INGREDIENTES
            
        }
    </script>
</head>
<?php
    include 'header.php';
    $nom=filter_input(INPUT_POST, 'nombre');
    if (isset($nom)) {
        $arn=fopen('nombre.csv','w');
        fwrite($arn,$nom);
        fclose($arn);
    }
    else{
        if (file_exists('nombre.csv')) {//SI EL ARCHIVO EXITE OBTIENE EL NOMBRE
            $arn=fopen('nombre.csv','r');
            $nom=fgets($arn);
            fclose($arn);
        }//SI EL ARCHIVO EXITE OBTIENE EL NOMBRE
        else{//SI EL ARCHIVO NO EXISTE LE HAGA ESCRIBIR EL NOMBRE?>
            <script>nombre();</script>
        <?php
        }//SI EL ARCHIVO NO EXISTE LE HAGA ESCRIBIR EL NOMBRE
        
    }
    $i_nom=filter_input(INPUT_POST, 'ing_nom');
    $i_pre=filter_input(INPUT_POST, 'ing_pre');
    $i_in1=filter_input(INPUT_POST, 'in1');
    $i_in2=filter_input(INPUT_POST, 'in2');
    $i_in3=filter_input(INPUT_POST, 'in3');
    $total=0;
    $cant=0;

    
    if (isset($_POST['buton-ingre'])) {//SI PRESIONA EL BOTON 
        $archi=fopen('pedido.csv', 'a');

        fwrite($archi, $i_nom.",".$i_pre.",".$i_in1." ".$i_in2." ".$i_in3."\n");
        fclose($archi);
    }//SI PRESIONA EL BOTON 

    if (file_exists('pedido.csv')) {//SI pedido.csv EXISTE
        $ar=fopen('pedido.csv', 'r');
        while (!feof($ar)) {//MIENTRAS NO LLEGE AL FINAL DE pedido.csv
            $datos[]=explode(',', fgets($ar));
        }//MIENTRAS NO LLEGE AL FINAL DE pedido.csv

        for ($i=0; $i <= count($datos)-2; $i++) {//FOR CALCULA EL TOTAL y LA CANTIDAD 
            $total=$total+$datos[$i][1];
            $cant=count($datos)-1;
        }//FOR CALCULA EL TOTAL y LA CANTIDAD
        fclose($ar);
    }//SI pedido.csv EXISTE

?>
<body>

<!-- CARRITO -->
<section id="carrito" class="carrito">
    <div class="caja-pedido">
        <h2><svg width="24" height="24" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="8" y="4" width="32" height="40" rx="2" fill="none" stroke="#333" stroke-width="4" stroke-linejoin="round"/><path d="M21 14H33" stroke="#333" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><path d="M21 24H33" stroke="#333" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><path d="M21 34H33" stroke="#333" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><path fill-rule="evenodd" clip-rule="evenodd" d="M15 16C16.1046 16 17 15.1046 17 14C17 12.8954 16.1046 12 15 12C13.8954 12 13 12.8954 13 14C13 15.1046 13.8954 16 15 16Z" fill="#333"/><path fill-rule="evenodd" clip-rule="evenodd" d="M15 26C16.1046 26 17 25.1046 17 24C17 22.8954 16.1046 22 15 22C13.8954 22 13 22.8954 13 24C13 25.1046 13.8954 26 15 26Z" fill="#333"/><path fill-rule="evenodd" clip-rule="evenodd" d="M15 36C16.1046 36 17 35.1046 17 34C17 32.8954 16.1046 32 15 32C13.8954 32 13 32.8954 13 34C13 35.1046 13.8954 36 15 36Z" fill="#333"/></svg>Pedido</h2>
        <p>De:<b><?php echo $nom ?></b></p>
        <p>Cantidad Platos <b><?php echo $cant; ?></b></p>
        <p>Total: <b>$<?php echo $total; ?></b></p>
        <a href="ver_pedido.php"><button class="buton-carrito-v">Ver Pedido</button></a>
    </div>
</section>

<!-- PLATOS -->
<section class="menu-productos">
    <h1 style="text-align: center;"><svg width="24" height="24" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14 4V44" stroke="#333" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><path d="M8 5V15C8 20 14 20 14 20C14 20 20 20 20 15V5" stroke="#333" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><path d="M37 4L40 44" stroke="#333" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><path d="M31 4L28 44" stroke="#333" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/></svg>  Hamburguesas Disponibles</h1>
    <div class="productos-container">

        <?php
            $productos_json = file_get_contents("productos.json");
            $productos = json_decode($productos_json, true);
            
            foreach ($productos as $producto) {
                echo "<div class='producto' >";
                echo "<img src=".$producto['imagen']." width='150' height='100' >";
                echo "<div class='producto-contenido'>";
                echo "<h3>" . $producto['nombre'] . "</h3>";
                echo "<p>Precio: $" . $producto['precio'] . "</p>";
                echo "</div>";
                echo "<button class='buton-producto' onclick='ingre(".$productos_json.",`".$producto['nombre']."`)'>";  
        ?>
        <svg width="24" height="24" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M39 32H13L8 12H44L39 32Z" fill="none"/><path d="M3 6H6.5L8 12M8 12L13 32H39L44 12H8Z" stroke="#fff" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><circle cx="13" cy="39" r="3" stroke="#fff" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><circle cx="39" cy="39" r="3" stroke="#fff" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><path d="M22 22H30" stroke="#fff" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><path d="M26 26V18" stroke="#fff" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/></svg>
        <?php
                echo "</button>"; 
                echo "</div>";
            } 
        ?>
    </div>

</section>
</body>
</html>