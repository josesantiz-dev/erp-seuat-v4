//TABS
var tabActual = 0;
mostrarTab(tabActual);

function mostrarTab(tabActual) {
    var tab = document.getElementsByClassName("tab");
    tab[tabActual].style.display = "block";
}
function fnNavTab(numTab){
    tabActual = numTab;
    var x = document.getElementsByClassName("tab");
    for( var i = 0; i<x.length;i++){
      x[i].style.display = "none";
    }
    x[numTab].style.display = "block";  
}

//Modal buscar Persona
function buscarPersona(){
    var textoBusqueda = $("input#busquedaPersona").val();
    var tablePersonas;
    tablePersonas = $('#tablePersonas').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            //url:"<?php echo media(); ?>/plugins/Spanish.json"
            "url": " "+base_url+"/Assets/plugins/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Reinscripcion/buscarPersonaModal?val="+textoBusqueda,
            "dataSrc":""
        },
        "columns":[
            {"data":"nombre_persona"},
            {"data":"apellidos"},
            {"data":"nombre_carrera"},
            {"data":"grado"},
            {"data":"nombre_grupo"},
            {"data":"options"}
        ],
        "responsive": true,
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": false,
        "autoWidth": false,
        "scrollY": '42vh',
        "scrollCollapse": true,
        "bDestroy": true,
        "order": [[ 0, "desc" ]],
        "iDisplayLength": 5
    });
    $('#tablePersonas').DataTable();
}
function seleccionarPersona(value){
    let nombre = value.getAttribute('rl');
    let id = value.id;
    let url = `${base_url}/Reinscripcion/getDatosAlumno/${id}`;
    document.getElementById('nombreAlumno').value = nombre;
    fetch(url)
    .then(res => res.json())
    .then((resultado) =>{
        document.querySelector('#divDatosAlumno').style.display = "block";
        document.querySelector('#divDatosReinscripcion').style.display = "block";

        document.querySelector('#nombrePersona').textContent = `${resultado.nombre_persona} ${resultado.ap_paterno} ${resultado.ap_materno}`;
        document.querySelector('#categoriaPersona').textContent = `${resultado.nombre_categoria}`;
        document.querySelector('#nombrePlantel').textContent = `${resultado.nombre_plantel}`;
        document.querySelector('#nombreCarrera').textContent = `${resultado.nombre_carrera}`;
        document.querySelector('#nombreGeneracion').textContent = resultado.nombre_generacion;
        document.querySelector('#nombreCiclo').textContent = resultado.nombre_ciclo;
        document.querySelector('#nombrePeriodo').textContent = resultado.nombre_periodo;
        document.querySelector('#carreraGrupo').textContent = `${resultado.grado} ${resultado.nombre_salon}`;
        document.querySelector('#estatus').innerHTML = resultado.estatus;

        document.querySelector('#txtNombrePlantel').value = `${resultado.nombre_plantel}`;
        document.querySelector('#txtNombreCarrera').value = `${resultado.nombre_carrera}`;
        document.querySelector('#txtNombreGeneracion').value = resultado.nombre_generacion;
    }).catch(err => {throw err});
    if(nombre != ""){
        document.querySelector('#alertBuscar').style.display = "none";
    }
    $('.close').click();
}

function fnReinscribir(){
     
}