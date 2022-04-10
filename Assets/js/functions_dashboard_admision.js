var $salesChart = $('#sales-chart');
document.addEventListener('DOMContentLoaded', function(){
    let plantel = "all";
    fnTotalesCard(plantel);
    prospectosInscritosbyPlantel(plantel);
    document.querySelector('.divnomplant').style.display = "none";
});
function plataformaSeleccionada(value){
    let nombrePlantel = document.querySelector('#listPlataformas').options[document.querySelector('#listPlataformas').selectedIndex].text;
    document.querySelector('.plntuno').innerHTML = nombrePlantel;
    var plantel = value;
    fnTotalesCard(plantel);

}
function fnTotalesCard(plantel){
    let url = base_url+"/DashboardAdmision/getTotalesCard/"+plantel;
    fetch(url).then(res => res.json()).then((resultado) => {
        if(resultado.tipo == "all"){
            prospectosInscritosbyPlantel(plantel);
            document.querySelector('.divnomplant').style.display = "none";
            document.querySelector('.divplant').style.display = "block";
            document.querySelector('.divchar').style.display = "flex";
            document.querySelector('.divcharPlantel').style.display = "none";
            document.querySelector('.plnt').innerHTML=resultado.planteles;
            document.querySelector('.pros').innerHTML=resultado.prospectos;
            document.querySelector('.ins').innerHTML=resultado.inscritos;
        }else{
            //fnMostrarGraficaPie();
            prospectosInscritosbyPlantel(plantel);
            document.querySelector('.divnomplant').style.display = "block";
            document.querySelector('.divchar').style.display = "none";
            document.querySelector('.divcharPlantel').style.display = "flex";
            document.querySelector('.divplant').style.display = "none";
            document.querySelector('.pros').innerHTML=resultado.prospectos;
            document.querySelector('.ins').innerHTML=resultado.inscritos;
        }
        }).catch(err => { throw err });
}
function prospectosInscritosbyPlantel(plantel){
    let url = base_url+"/DashboardAdmision/getProspectosInscritosbyPlantel/"+plantel;
    fetch(url).then(res => res.json()).then((resultado) => {
        let arrPlanteles = [];
        let arrProspectos = [];
        let arrInscritos = [];
        let arrPie = [];
        for ( const [key,value] of Object.entries( resultado ) ) {
            arrPlanteles.push(value.abreviacion_plantel+'('+value.municipio+')');
            arrProspectos.push(value.prospectos);
            arrInscritos.push(value.inscritos);
            let arr = [];
            let arrPro = [];
            let arrIns = [];
            arr.push("Task");
            arr.push("Value");
            arrPro.push("prospectos");
            arrPro.push(parseInt(value.prospectos));
            arrIns.push("Inscritos");
            arrIns.push(parseInt(value.inscritos));
            arrPie.push(arr);
            arrPie.push(arrPro);
            arrPie.push(arrIns);
        }
        if(plantel == "all"){
            fnMostrarGrafica(arrPlanteles,arrProspectos,arrInscritos);
        }else{
            fnMostrarGraficaPie(arrPie);
        }
        }).catch(err => { throw err });
}
function fnMostrarGrafica(arrPlanteles,arrProspectos,arrInscritos){
    var ticksStyle = {
        fontColor: '#495057',
        fontStyle: 'bold'
      }
    var mode = 'index'
    var intersect = true
    // eslint-disable-next-line no-unused-vars
    var salesChart = new Chart($salesChart, {
      type: 'bar',
      data: {
        labels: arrPlanteles,
        datasets: [
          {
            backgroundColor: '#007bff',
            borderColor: '#007bff',
            data: arrProspectos
          },
          {
            backgroundColor: '#ced4da',
            borderColor: '#ced4da',
            data: arrInscritos
          }
        ]
      },
      options: {
        maintainAspectRatio: false,
        tooltips: {
          mode: mode,
          intersect: intersect
        },
        hover: {
          mode: mode,
          intersect: intersect
        },
        legend: {
          display: false
        },
        scales: {
          yAxes: [{
            // display: false,
            gridLines: {
              display: true,
              lineWidth: '4px',
              color: 'rgba(0, 0, 0, .2)',
              zeroLineColor: 'transparent'
            },
          }],
          xAxes: [{
            display: true,
            gridLines: {
              display: false
            },
            ticks: ticksStyle
          }]
        }
      }
    })
}
function fnMostrarGraficaPie(arr){
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable(arr);
        var options = {
            'legend':'top',
            'width':400,
            'height':300
          }
        var chart = new google.visualization.PieChart(document.getElementById('oilChartGral'));
        chart.draw(data, options);
    }
}