function eliminar(cod){
    Swal.fire({
		title: "Realmente desea eliminar este empleado?",
		text: "",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Sí, Eliminar!"
    }).then((result) => {
    if (result.isConfirmed) {
    	window.location.href = `../Controladores/delete_empleado.php?codigo=${cod}`

    	}
    });
   
}

function modificar(a, b, c, d, e, f, g, h, i, j){
    const contenido= `<form action='../Controladores/modify_empleado.php?cod=${a}' method="post">
        DNI:
        <p>
        <input type="number" name="dni" placeholder="${b}" value="${b}" min="0" class="swal2-input">
        <p>
        Clave:
        <p>
        <input type="varchar" name="clave" placeholder="${j}" value="${j}" class="swal2-input">
        <p>
        Nombre:
        <p>
        <input type="text" name="nombre" placeholder="${c}" value="${c}" class="swal2-input">
        <p>
        Apellido:
        <p>
         <input type="text" name="apellido" placeholder="${d}" value="${d}" class="swal2-input">
        <p>
        Teléfono
        <p>
         <input type="number" name="telefono" placeholder="${e}" value="${e}" min="0" class="swal2-input" >
        <p>
        Dirección
        <p>
        <input type="varchar" name="direccion" placeholder="${f}" value="${f}" class="swal2-input">
        <p>
        Fecha de nacimiento:
        <p>
        <input type="date" name="fecha" placeholder="${g}" value="${g}" class="swal2-input">
        <p>
        Puesto
        <p>
         <input type="text" name="puesto" placeholder="${h}" value="${h}" class="swal2-input">
        <p>
        Sueldo
        <p>
         <input type="number" name="sueldo" placeholder="${i}" value="${i}" min="0" class="swal2-input">
        <p> 
        <button type="submit" class="buton-carrito-r">Modificar</button>
        </form>
        <p style="margin-top:10px;">
        <br>
        <a href="view_empleados.php"><button class="buton-carrito-c">Volver</button></a></p>`;
    Swal.fire({
        title: "Modificar",
        html: contenido,
        allowOutsideClick: true,
        showConfirmButton: false,
        footer: "",
    });
    
}

function add(cod){
    const contenido= `<form action='../Controladores/up_empleado.php' method="post">
        
        DNI:
        <p>
        <input type="number" name="dni" min="0"  class="swal2-input" required>
        <p>
        Clave:
        <p>
        <input type="varchar" name="clave" class="swal2-input" required>
        <p>
        Nombre:
        <p>
         <input type="text" name="nom"  class="swal2-input" required>
        <p>
        Apellido:
        <p>
         <input type="text" name="ape" class="swal2-input" required>
        <p>
        Teléfono:
        <p>
         <input type="number" name="tel" min="0" class="swal2-input" required>
        <p>
         Dirección:
        <p>
         <input type="text" name="dir" class="swal2-input" required>
        <p>
         Fecha de nacimiento:
        <p>
         <input type="date" name="fec" class="swal2-input" required>
        <p>
         Puesto:
        <p>
         <input type="text" name="puesto" class="swal2-input" required>
        <p>
         Sueldo:
        <p>
         <input type="number" name="sueldo" min="0" class="swal2-input" required>
        <p>
        <input type="hidden" name="sucursal" value="${cod}">
        <button type="submit" class="buton-carrito-r">Ingresar</button>
        </form>
        <p style="margin-top:10px;">
        <br>
        <a href="view_empleados.php"><button class="buton-carrito-c">Volver</button></a></p>`;
    Swal.fire({
        title: "Nuevo empleado",
        html: contenido,
        allowOutsideClick: true,
        showConfirmButton: false,
        footer:"",
    });
    
}