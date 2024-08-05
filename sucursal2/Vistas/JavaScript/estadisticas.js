
function graficar(datos,newLabel=[]){
    console.log(datos);

   const ctx = document.getElementById('Estadistica');

            new Chart(ctx, {
              type: 'bar',
              data: {
                labels: newLabel,
                datasets: [{
                  label: 'Cantidad de ventas',
                  data: datos,
                  backgroundColor: '#d62828',
                  borderWidth: 0,
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
}