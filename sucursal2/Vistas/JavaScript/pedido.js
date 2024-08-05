const pedidoPre = document.getElementById('pedido-preparado')
const pedidoNoPre = document.getElementById('pedido-no-preparado')

Sortable.create(pedidoNoPre, {
    group: 'shared', // set both lists to same group
    animation: 150,
    store:{
    	//´Guarda el orden del pedido
    	set: (sortable)=>{
    		const order = sortable.toArray()
    		//console.log(order);
    	}
    }
});

Sortable.create(pedidoPre, {
    group: 'shared', // set both lists to same group
    animation: 150,
    store:{
    	//´Guarda el orden del pedido
    	set: (sortable)=>{
    		const order = sortable.toArray()
    		//console.log(order);
            window.location.assign(`../../Controladores/estado_pedidos.php?id=${order}`);
    	}
    }
});

