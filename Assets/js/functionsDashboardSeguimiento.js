let nomPlan = document.querySelector('.plt')
let titPlt = document.querySelector('.tit-plt')
let prosSeg = document.querySelector('.prospect_segui')
let totalPros = document.querySelector('.total_prospect')
let noAtendido = document.querySelector('.agn')

document.addEventListener('DOMContentLoaded', function(){
    let plantel = "all"
    fnObtenerTotales(plantel)
})

function plataformaSeleccionada(value)
{
    let nombrePlantel = document.querySelector('#listPlataforma').options[document.querySelector('#listPlataforma').selectedIndex].text
    //nomPlan.innerHTML = nombrePlantel
    let plantel = value
    fnObtenerTotales(value)
}

function fnObtenerTotales(plantel)
{
    
    let url = `${base_url}/DashboardSeguimiento/getTotales/${plantel}`
    console.log(url)
    fetch(url)
    .then(response => response.json())
    .then(data =>{
        if(data.tipo == "all")     
        {
            titPlt.textContent = "Número de plateles"
            nomPlan.innerHTML = data.planteles
            prosSeg.innerHTML = data.totalProspectosSeguimiento
            totalPros.innerHTML = data.totalProspec
            noAtendido.innerHTML = data.no_atendidos

        }   
        else
        {
            prosSeg.innerHTML = data.prospecto_plantel
            totalPros.innerHTML = data.prospecto
            noAtendido.innerHTML = "0"
            titPlt.textContent = "Nombre de plantel"
            nomPlan.innerHTML = data.nomPlantel
        }
        console.log(data)
    })
    // .catch(function (err){
    //     console.log('Error ',err)
    // })
}