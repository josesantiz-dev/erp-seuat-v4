let card_info_alumno = document.querySelector('.card-info-alumno');
card_info_alumno.style.display = "none";

document.addEventListener('DOMContentLoaded', function(){
    var tableEstudiantes = $('#tableAlumnos').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": " "+base_url+"/Assets/plugins/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/HistorialPagosAlumno/getEstudiantes",
            "dataSrc":""
        },
        "columns":[
            {"data":"numeracion"},
            {"data":"nombre_persona"},
            {"data":"apellidos"},
            {"data":"nombre_plantel"},
            {"data":"nombre_carrera"},
            {"data":"grado_grupo"},
            {"data":"options"}
        ],
        "responsive": true,
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        //"scrollY": '42vh',
        "scrollCollapse": true,
        "bDestroy": true,
        "order": [[ 0, "asc" ]],
        "iDisplayLength": 10
    });
});
$('#tableAlumnos').DataTable();

function seleccionarPersona(value){
    card_info_alumno.style.display = "inline";
    let url = `${base_url}/HistorialPagosAlumno/getDetallesEstudiante/${value}`;
    fetch(url)
    .then(res => res.json())
    .then((resultado) =>{
        document.querySelector(".name").textContent = `${resultado.nombre_persona} ${resultado.ap_paterno} ${resultado.ap_materno}`;
        document.querySelector('.img_user').src = `${base_url}/Assets/images/img/user.jpg`;
        document.querySelector(".tel").textContent = resultado.tel_celular;
        document.querySelector('.email').textContent = resultado.email;
        document.querySelector('.direccion').textContent = resultado.direccion;
        document.querySelector('.estatus').innerHTML = (resultado.estatus == 1)?'<span class="badge bg-success">Activo</span>':'<span class="badge bg-danger">Innactivo</span>';
        if(resultado){
            fnMostrarUltimosMovimientos(value);
        }
    }).catch(err =>{throw err});
}


function fnMostrarUltimosMovimientos(id){
    let url = `${base_url}/HistorialPagosAlumno/getUltimosMovimientosAlumno/${id}`;
    fetch(url)
    .then(res => res.json())
    .then((resultado) =>{
        document.querySelector('.ultimos_movimientos').innerHTML = "";
        if(resultado){
            resultado.forEach(element => {
                document.querySelector('.ultimos_movimientos').innerHTML += '<li class="timeline-item ml-4"><strong>Pago de un servicio con folio '+element.folio+'</strong><span class="float-end text-muted text-sm"> Hace '+element.segundos+'</span><p><i>Observaciones: '+element.observaciones+'</i></p></li>'
            });
            document.getElementById('ver_mas_detalles_alumno').setAttribute('onClick', 'fnVerMas('+id+');' );
        }

    }).catch(err => {throw err}); 
}

function fnVerMas(id){
    let url = `${base_url}/HistorialPagosAlumno/getDetallesEstudiante/${id}`;
    fetch(url)
    .then(res => res.json())
    .then((resultado) =>{
        if(resultado){
            document.querySelector('.nombre_alumno').textContent = `${resultado.nombre_persona} ${resultado.ap_paterno} ${resultado.ap_materno}`;
            fnMostrarTodosMovimientos(id);
        }
    }).catch(err => {throw err});
}
function fnMostrarTodosMovimientos(id){
    let url = `${base_url}/HistorialPagosAlumno/getTodosMovimientosAlumno/${id}`;
    fetch(url)
    .then(res => res.json())
    .then((resultado) =>{
        document.querySelector('#valoresMovientosAlumnoDet').innerHTML = "";
        if(resultado){
            let contador = 0;
            resultado.forEach(element => {
                contador += 1;
                let nombreServicio = (element.nombre_servicio == null)?element.nombre_servicio_precarga:element.nombre_servicio;
                let nombrePersona = `${element.nombre_persona} ${element.ap_paterno} ${element.ap_materno}`;
                document.querySelector('#valoresMovientosAlumnoDet').innerHTML += `<tr><td>${contador}</td><td>${element.folio}</td><td>${element.fecha}</td><td>${nombreServicio}</td><td>${formatoMoneda(element.cargo)}</td><td>${nombrePersona}</td></tr>`
            });
        }
    }).catch(err => {throw err}); 
}

//Function para dar formato un numero a Moneda
function formatoMoneda(numero){
    let str = numero.toString().split(".");
    str[0] = str[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return "$"+str.join(".");
}