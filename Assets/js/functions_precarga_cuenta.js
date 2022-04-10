let idPlantel = null;
let idPlanEstudios = null;
let nivel = null;
let formEditServicio = document.querySelector("#form_servicio_edit");
let arrDatosNew = [];
let tableServicios;

document.addEventListener('DOMContentLoaded', function(){
    let selectPlantel = document.querySelector('#listPlantelDatatable');
    if(selectPlantel){
        nivel = null;
        fnPlantelSeleccionadoDatatable(selectPlantel.value, nivel);
    }
    document.querySelector('.div_datos_precarga').style.display = "none";
});

function fnPlantelSeleccionadoDatatable(value,nivel){
    idPlantel = value;
    let url = `${base_url}/PrecargaCuenta/getPlanEstudios/${idPlantel}/${nivel}`;
    let tablePlanEstudios = $('#tablePlanEstudios').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": " "+base_url+"/Assets/plugins/Spanish.json"
        },
        "ajax":{
            "url": url,
            "dataSrc":""
        },
        "columns":[
            {"data":"numeracion"},
            {"data":"nombre_plantel"},
            {"data":"nombre_carrera"},
            {"data":"nombre_nivel_educativo"},
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
	    "iDisplayLength": 5
    });
    $('#tablePlanEstudios').DataTable();
    fnListNiveles(idPlantel,nivel);
}
function fnSeleccionarPlanEstudios(plantel,planestudios){
    idPlanEstudios = planestudios;
    idPlantel = plantel;
    $('html,body').animate({scrollTop: $(".div_precarga").offset().top},'slow');
    if(idPlantel > 0){
        document.querySelector('.div_datos_precarga').style.display = "flex";
        //console.log(arrDatosNew);
        document.querySelector('.div_alert_precarga').style.display = "none";
    }
    //let url = `${base_url}/PrecargaCuenta/getServicios/${idPlantel}`;
/*     fetch(url).then((res) => res.json()).then(resultado =>{
        if(resultado.length > 0){
            arrDatosNew = resultado;
            mostrarServiciosTabla();
 
        }else{
            document.querySelector('#tableServicios').innerHTML = "<tr><td colspan='7'><div class='alert alert-danger text-center' role='alert'>No hay datos.</div></td></tr>";
            
        }
    }).catch(err => {throw err}); */
}
function fnListNiveles(idPlantel,nivel){
    let url = `${base_url}/PrecargaCuenta/getNivelesByPlantel/${idPlantel}`;
    fetch(url).then((res) => res.json()).then(resultado =>{
        document.querySelector('#listNivelDatatable').innerHTML = "<option>Todos</option>";
        resultado.forEach(nivel => {
            document.querySelector('#listNivelDatatable').innerHTML += '<option value="'+nivel.id+'">'+nivel.nombre_nivel_educativo+'</option>';
        });
        if(nivel > 0){
            document.querySelector('#listNivelDatatable').querySelector('option[value="'+nivel+'"]').selected = true;
        }
    }).catch(err => {throw err});
}
function fnNivelSeleccionadoDatatable(value){
    nivel = value;
    fnPlantelSeleccionadoDatatable(idPlantel, nivel);
}

function fnEditServicio(value,id){
    formEditServicio.reset();
    let nombreServicio = value.getAttribute('n');
    let idServicio = id;
    let precioUnitario = value.getAttribute('p');
    document.querySelector('#txtNombre_servicio_edit').textContent = nombreServicio;
    document.querySelector('#intId_servicio_edit').value = idServicio;
    document.querySelector('#intPrecio_actual_edit').value = formatoMoneda(precioUnitario);
    document.querySelector('#intId_precio_unitario').value = precioUnitario;
}


formEditServicio.onsubmit = function(e){
    e.preventDefault();
    let nombreServicio = document.querySelector('#txtNombre_servicio_edit').textContent;
    
    let idServicio = document.querySelector('#intId_servicio_edit').value;
    let nuevoPrecio = document.querySelector('#intNuevo_precio_edit').value;
    let fechaLimitePago = document.querySelector('#txtFecha_limite_pago').value;
    let intPrecioActual = document.querySelector('#intId_precio_unitario').value;
    if (idServicio == '' || nuevoPrecio == '' || fechaLimitePago == '' || intPrecioActual == ''){
        swal.fire("Atención", "Atención todos los campos son obligatorios", "warning");
        return false;
    }
    document.querySelector('#np-'+idServicio).textContent = formatoMoneda(parseInt(nuevoPrecio).toFixed(2));
    arrDatosNew.forEach(servicios => {
        if(servicios.id == idServicio){
            servicios.precio_nuevo = parseInt(nuevoPrecio).toFixed(2);
            servicios.fecha_limite_pago = fechaLimitePago;
        }
    });
    $(".close").click();

}

function fnGuardarPrecarga(){
    let grado = document.querySelector('#selectGrado').value;
    let periodo = document.querySelector('#selectPeriodo').value;
    let datos = convStrToBase64(JSON.stringify(arrDatosNew));
    let data = {'id_plantel':idPlantel,'datos':datos};
    if(idPlantel == 'Todos' || idPlantel == "" || idPlantel == undefined){
        swal.fire("Atención", "Selecciona un plantel", "warning");
        return false;
    }
    if(nivel == 'Todos' || nivel == "" || nivel == undefined){
        swal.fire("Atención", "Selecciona un nivel", "warning");
        return false;
    }
    if(arrDatosNew.length == 0){
        swal.fire("Atención", "No ha seleccionaro servicios, selecciona una carrera para ver los servicios", "warning");
        return false; 
    }
    if(periodo == 0){
        swal.fire("Atención", "Selecciona un periodo", "warning");
        return false;
    }
    if(grado == 0){
        swal.fire("Atención", "Selecciona un grado", "warning");
        return false;
    }
    let estatus = false;
    let num = 0;
    let newArrDatos = [];
    arrDatosNew.forEach(element => {
        if(element.hasOwnProperty('precio_nuevo') || element.hasOwnProperty('fecha_limite_pago')){
            let arr = {'id':element.id,'precio_nuevo':element.precio_nuevo,'fecha_limite_pago':element.fecha_limite_pago};
            newArrDatos.push(arr);
            num += 1;
        }
    });
    if(arrDatosNew.length == num){
        //console.log(newArrDatos);
        /*let url = `${base_url}/PrecargaCuenta/setPrecarga/${idPlantel}/${nivel}/${grado}/${periodo}/${JSON.stringify(newArrDatos)}/${idPlanEstudios}`;
            fetch(url).then((res) => res.json()).then(resultado =>{
                console.log(resultado);
            }).catch(err => {throw err});*/
        arrDatosNew.forEach(element => {
            let url = `${base_url}/PrecargaCuenta/setPrecarga/${idPlantel}/${nivel}/${grado}/${periodo}/${element.id}/${element.precio_nuevo}/${element.fecha_limite_pago}/${idPlanEstudios}`;
            fetch(url).then((res) => res.json()).then(resultado =>{
                if(resultado){
                    swal.fire("Atención", "Datos guardados correctamente", "success");
                }
            }).catch(err => {throw err});
        });
    }else{
        swal.fire("Atención", "Falta completar la edicion de servicios", "warning");
        return false;
    }

}

function mostrarServiciosTabla(){
    let contador = 0;
    //document.querySelector('#tableServicios').innerHTML = "";
    arrDatosNew.forEach(element => {
        contador += 1;
        document.querySelector('#tableServicios').innerHTML += 'sjdiisdjisidjisjijsij';
        console.log(contador);
    });
}

function buscarServicio(){
    let value = document.querySelector('#busquedaServicio').value;
    let url = `${base_url}/PrecargaCuenta/getServiciosByInput/${value}`;
    fetch(url).then((res) => res.json()).then(resultado =>{
            tableServicios = $('#tableServicios').dataTable( {
            "aProcessing":true,
            "aServerSide":true,
            "language": {
                "url": " "+base_url+"/Assets/plugins/Spanish.json"
            },
            "ajax":{
                "url": url,
                "dataSrc":""
            },
            "columns":[
                {"data":"numeracion"},
                {"data":"nombre_servicio"},
                {"data":"codigo_servicio"},
                {"data":"subcodigo_servicio"},
                {"data":"precio"},
                {"data":"anio_fiscal"},
                {"data":"options"}
            ],
            "responsive": true,
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            //"scrollY": '42vh',
            "scrollCollapse": true,
            "bDestroy": true,
            "order": [[ 0, "asc" ]],
            "iDisplayLength": 5
        });
        $('#tableServicios').DataTable();
    }).catch(err => {throw err});
}

function fnSeleccionarServicio(value,id,precio){
    document.querySelector('#busquedaServicio').value = "";
    $('.cerrarModalEdit').click();
    buscarServicio();
    let nombreServicio = value.getAttribute('n');
    let codigoServicio = value.getAttribute('c');
    let idServicio = id;
    let precioUnitario = precio;
    document.querySelector('#txtNombre_servicio').value = nombreServicio;
    let arrValue = {'id_servicio':idServicio,'nombre_servicio':nombreServicio,'codigo':codigoServicio,'precio_unitario':precioUnitario,'nuevo_precio':null,'fecha_limite_pago':null};
    arrDatosNew.push(arrValue);
    //console.log(arrDatosNew);
    mostrarServiciosTabla();
}
//Function para dar formato un numero a Moneda
function formatoMoneda(numero){
    let str = numero.toString().split(".");
    str[0] = str[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return "$"+str.join(".");
}
//Function para convertir un string  a  Formato Base64
function convStrToBase64(str){
    return window.btoa(unescape(encodeURIComponent( str ))); 
}