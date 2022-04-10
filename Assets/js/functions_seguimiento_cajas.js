let urlGraphMultiLine = `${base_url}/SeguimientoCajas/selectVentasAll`;
let arrDias = [];
let time = false;
document.addEventListener('DOMContentLoaded', function(){
    function load(){
        arrDias = [];
        fetch(urlGraphMultiLine)
        .then(res => res.json())
        .then((resultado) => {
            for(const [key, value] of Object.entries(resultado.dias)){
                arrDias.push(value);
            }
            fnGraficar(arrDias,resultado.datos);
            mostrarCards(resultado.datos);
        }).catch(err => {throw err});
    }
    //setInterval(load,1000);
    load();
})
function fnGraficar(arrDias,datos){
    new Chart(document.getElementById("myChart"), {
      type: "line",
      data: {
        labels: arrDias,
        datasets: datos
      },
      options: {
        legend: {display: true},
        title: {
            display: true,
            text: 'Graficación de ventas'
          }
      }
    
    });
}
function mostrarCards(arr){
    arr.forEach(element => {
        const venta = element.data[element.data.length-1];
        let card = '<div class="card"><div class="card-body"><div class="row"><div class="col mt-0"><h5 class="card-title">'+element.label+'</h5></div><div class="col-auto"><div class="avatar"><div class="avatar-title rounded-circle bg-primary-light"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg></div></div></div></div><h1 class="mt-1 mb-3 plnt">'+formatoMoneda(venta.toFixed(2))+'<!-- <i class="fas fa-arrow-alt-circle-up" style="color:#20c997"></i>--></h1><div class="mb-0"><span class="text-muted">Click aquí para </span><a class="btn" href="http://10.10.2.185/erp-seuat-v2/Plantel" role="button"><span class="badge badge-primary"> <i class="mdi mdi-arrow-bottom-right"></i> ver más </span></a></div></div></div>';
        document.querySelector('.cards-planteles').innerHTML += card;
    });
}

//Function para dar formato un numero a Moneda
function formatoMoneda(numero){
    let str = numero.toString().split(".");
    str[0] = str[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return "$"+str.join(".");
}