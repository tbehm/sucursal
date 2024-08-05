/***************************************************
*
*   FUNCIONES PARA GENERAR COLORES ALEATORIOS
*
********************************************************/

function generarLetra(){
    var letras = ["a","b","c","d","e","f","0","1","2","3","4","5","6","7","8","9"];
    var numero = (Math.random()*15).toFixed(0);
    return letras[numero];
}
                    
function colorHEX(cantidad){
    var codColor = "#";
    //console.log(cantidad)
    var colores=[];
    for (var a = 0; a < cantidad; a++) {
        for(var i=0;i<6;i++){
            codColor = codColor + generarLetra() ;
        } 
        //console.log(codColor);
        colores.push(codColor);
        codColor="#"   
    }
    return colores;
}

function colorTransp(colores,opac){
    return colores.map(color => `${color+opac}`)
}

function add(){
   
    let contenido= `
        <form action='../Controladores/up_stock.php' method="post">
            Nombre:
            <p>
            <input type="text" name="nom" min="1" class="swal2-input" required>
            <p>
            Unidad de medicion:
            <p>
            <select id='newProd' name="unidad">
                <option value="kg">Kg</option>
                <option value="unidades">Unidades</option>
                <option value="bolsas">Bolsas</option>
                <option value="cajas">Cajas</option>
            </select>
            <p>
            Dar aviso a cierta cantidad:
            <p>
            <input type="number" name="aviso" placeholder="ingrese una cantidad" min="1" class="swal2-input" required>
            <p>
            <p>
            <p>
            <button type="submit" class="buton-carrito-r" style="margin-top:10px">Ingresar</button>
            </form>`;  
        titulo="Nuevo producto"
    Swal.fire({
        title: titulo,
        html: contenido,
        allowOutsideClick: true,
        showConfirmButton: false,
        footer:"",
    });
}

function deleteS(cod){
    Swal.fire({
        title: "Realmente desea eliminar este Producto?",
        text: "",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, Eliminarlo!"
    }).then((result) => {
    if (result.isConfirmed) {
        window.location.href = `../Controladores/delete_stock.php?codigo=${cod}`

        }
    });
}

function modifyStock(id,sucursal) {
    const contenido=`
    <form action="../../Controladores/modify_stock.php" method="post" style="display:inline-grid">
        <input type="hidden" name="ubi" value="${id}">
        <input type="hidden" name="sucursal" value="${sucursal}">
        <span>Cantidad<p><input type="number" name="cantidad" min="1" placeholder="ingresaron X cantidad" class="swal2-input" required><p></span>
        <button type="submit" class="buton-carrito-r" style="margin:10px 0;">Editar</button>
    </form>`
    Swal.fire({
        title:"Ingreso de mercaderia",
        html: contenido,
        showConfirmButton: false,
        showCloseButton: true,
    })
}

function alertStock(contenido) {
    if (contenido.length>0) {
        Swal.fire({
            title:"Stock Bajo",
            icon: 'warning',
            html: `Se solicita Stock de ${contenido.map(item=>item)}.`,
        })    
    }
    
}

/*********************************************
*
*       FUNCION PARA GRAFICAR
*
**********************************************/

function graficar(dataStock,nombreStock,contLabel,id) {
    bcolor = colorHEX(nombreStock.length);//COlor del border
    color = colorTransp(bcolor,10);//Color transparente

    const ctx = document.getElementById(id);
    new Chart(ctx, {
        type: "bar",
        data: {
            labels: nombreStock,
            datasets: [{
                label:contLabel,
                backgroundColor: color,
                borderColor: bcolor,
                borderWidth: 2,
                data: dataStock,
            }]
        },
        options: {
            plugins:{
                legend: {display: false},
            }
        }
    });

}