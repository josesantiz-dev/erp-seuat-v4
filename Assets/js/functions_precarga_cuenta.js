let idPlantel = null;
let idPlanEstudios = null;
let nivel = null;
let formEditServicio = document.querySelector("#form_servicio_edit");
let arrDatosNew = [];
let tableServicios;
let tablePrecargaCuenta;

let tableServicioss;
// let rowTable = "";
// let divLoading = document.querySelector("#divLoading");

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

function fnEditServicio(value,id_servicio){
    formEditServicio.reset();
    let nombreServicio = value.getAttribute('n');
    let idServicio = id_servicio;
    let precioUnitario = value.getAttribute('p');
    document.querySelector('#txtNombre_servicio_edit').textContent = nombreServicio;
    document.querySelector('#intId_servicio_edit').value = idServicio;
    document.querySelector('#intPrecio_actual_edit').value = formatoMoneda(precioUnitario);
    document.querySelector('#intId_precio_unitario').value = precioUnitario;
    // console.log(nombreServicio,idServicio);
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
        if(servicios.id_servicio == idServicio){
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
        swal.fire("Atención", "No ha seleccionado servicios, selecciona una carrera para ver los servicios", "warning");
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
            let arr = {'id':element.id_servicio,'precio_nuevo':element.precio_nuevo,'fecha_limite_pago':element.fecha_limite_pago};
            newArrDatos.push(arr);
            console.log(arr);
            num += 1;
        }
    });
    // console.log(arrDatosNew);
    if(arrDatosNew.length == num){
        //console.log(newArrDatos);
        /*let url = `${base_url}/PrecargaCuenta/setPrecarga/${idPlantel}/${nivel}/${grado}/${periodo}/${JSON.stringify(newArrDatos)}/${idPlanEstudios}`;
            fetch(url).then((res) => res.json()).then(resultado =>{
                console.log(resultado);
            }).catch(err => {throw err});*/
        arrDatosNew.forEach(element => {
            let url = `${base_url}/PrecargaCuenta/setPrecarga/${idPlantel}/${idPlanEstudios}/${nivel}/${periodo}/${grado}/${element.id_servicio}/${element.precio_nuevo}/${element.fecha_limite_pago}`;
            fetch(url).then((res) => res.json()).then(resultado =>{
                if(resultado){
                    swal.fire("Atención", "Datos guardados correctamente", "success");
                }
            }).catch(err => {throw err});
        });
        console.log(arrDatosNew);
    }else{
        swal.fire("Atención", "Falta completar la edicion de servicios", "warning");
        return false;
    }

}

function mostrarServiciosTabla(){
    let contador = 0;
    document.querySelector('#tableServicioss').innerHTML = "";
    arrDatosNew.forEach(element => {
        contador += 1;
        document.querySelector('#tableServicioss').innerHTML += '<tr><th><input type="checkbox" aria-label="Checkbox for following text input"></th><th scope="row">'+contador+'</th><td>'+element.codigo+'</td><td>'+element.nombre_servicio+'</td><td>'+formatoMoneda(element.precio_unitario)+'</td><td id="np-'+element.id_servicio+'">$0.00</td><td><a type="button" n="'+element.nombre_servicio+'" p="'+element.precio_unitario+'" onclick="fnEditServicio(this,'+element.id_servicio+')" data-toggle="modal" data-target="#modal_editar_servicio"><i class="fas fa-pencil-alt"></i></a><a type="button" data-toggle="modal" data-target="#exampleModal"><i class="far fa-eye ml-3"></i></a><a type="button" onclick="fnDelServicio(this,'+element.id_servicio+')" data-toggle="modal" data-target="#exampleModal"><i class="far fa-trash-alt ml-3"></i></a></td></tr>';
    });
    // console.log(arrDatosNew);
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
    let arrValue = {'id_servicio':idServicio,'codigo':codigoServicio,'nombre_servicio':nombreServicio,'precio_unitario':precioUnitario,'nuevo_precio':null,'fecha_limite_pago':null};
    arrDatosNew.push(arrValue);
    // console.log(idServicio);
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

//ELIMINAR SERVICIO
// function fnDelServicio(){

// }


//TABLA PRECARGA CUENTA
document.addEventListener('DOMContentLoaded', function(){

    tablePrecargaCuenta = $('#tablePrecargaCuenta').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": " "+base_url+"/Assets/plugins/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/PrecargaCuenta/getPrecargas",
            "dataSrc":""
        },
        "columns":[
            {"data":"numeracion"},
            {"data":"cTotal"},
            {"data":"limCobro"},
            {"data":"nomSer"},
            {"data":"nomCarre"},
            {"data":"nomPer"},
            {"data":"nomGra"},
            {"data":"est"},
            {"data":"options"}
        ],
        "responsive": true,
	    "paging": true,
	    "lengthChange": true,
	    "searching": true,
	    "ordering": true,
	    "info": true,
	    "autoWidth": false,
	    "scrollY": '44vh',
	    "scrollCollapse": true,
	    "bDestroy": true,
	    "order": [[ 0, "desc" ]],
	    "iDisplayLength": 25
    });


    //ACTUALIZAR PRECARGA
    if(document.querySelector('#form_precarga_edit')){
        let form_precarga_edit = document.querySelector('#form_precarga_edit');
        form_precarga_edit.onsubmit = function(e){
            e.preventDefault();

            let intIdPrecargaCuenta = document.querySelector('#intId_precarga_edit').value;
            // let strPrecioActual = document.querySelector('#intPrecio_actual_precarg_edit').value;
            let intNuevoPrecio = document.querySelector('#intNuevo_precio_precarg_edit').value;
            let strFechaLimCobro = document.querySelector('#txtFecha_limite_pago_pre_edit').value;
            let strFecha_Actualizacion = document.querySelector('#txtFecha_ActualizacionUp ').value;
            let intId_Usuario_Actualizacion = document.querySelector('#txtId_Usuario_ActualizacionUp').value;
            let intEstatus = document.querySelector('#listEstatusUp').value;
            
            if(intNuevoPrecio == '' || strFechaLimCobro == '' || intEstatus == '' || intId_Usuario_Actualizacion == '')
            {
                swal.fire("Atención", "Atención todos los campos son obligatorios", "warning");
				return false;
            }

            divLoading.style.display = "flex";
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/PrecargaCuenta/setPrecargaCuentas_up';
            let formData = new FormData(form_precarga_edit);
            request.open("POST",ajaxUrl,true);
            request.send(formData);

            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){

                    let objData = JSON.parse(request.responseText);
                    if(objData.estatus)
                    {
                        tablePrecargaCuenta.api().ajax.reload();

                        $('#modal_editar_precarga').modal('hide');
                        form_precarga_edit.reset();
                        swal.fire("Precarga cuenta ", objData.msg, "success");
                    }else{
                        swal.fire("Error", objData.msg , "error");
                    }
                }
                divLoading.style.display = "none";
				return false;
            }
        }
    }

}, false);


//EDITAR PRECARGA 
function fntEditPrecargaCuentas(element, id){
    rowTable = element.parentNode.parentNode.parentNode.parentNode.parentNode;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/PrecargaCuenta/getPrecargaCuenta/'+id;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){

            let objData = JSON.parse(request.responseText);
            if(objData.estatus){
                document.querySelector("#intId_precarga_edit").value = objData.data.id;
                // document.querySelector("#intPrecio_actual_precarg_edit").value = objData.data.cobro_total;
                document.querySelector("#intNuevo_precio_precarg_edit").value = objData.data.cobro_total;
                document.querySelector("#txtFecha_limite_pago_pre_edit").value = objData.data.fecha_limite_cobro;
                document.querySelector("#txtId_Usuario_ActualizacionUp").value = 1;

                if(objData.data.estatus == 1)
                {
                    var optionSelect = '<option value="1" selected class="notBlock">Activo</option>';
                }else{
                    var optionSelect = '<option value="2" selected class="notBlock">Inactivo</option>';
                }
                var htmlSelect = `${optionSelect}
                                        <option value="1">Activo</option>
                                        <option value="2">Inactivo</option>
                                    `;
                document.querySelector("#listEstatusUp").innerHTML = htmlSelect;
                $('#modal_editar_precarga').modal('show');
            }else{
                swal.fire("Error", objData.msg , "error");
            }
        }
    }
}


//FUNTION PARA ELIMINAR PRECARGA
function fntDelPrecargaCuentas(id){
    swal.fire({
        icon: "question",
        title: "Eliminar precarga cuenta",
        text: "¿Realmente quiere eliminar la precarga seleccionada?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#045FB4',
		cancelButtonColor: '#d33',
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!"
    }). then((result) =>{

        if(result.isConfirmed)
        {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/PrecargaCuenta/delPrecargaCuenta';
            let strData = "idPre="+id;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.estatus)
                    {
                        swal.fire("Eliminar!", objData.msg, "success");
                        tablePrecargaCuenta.api().ajax.reload();
                    }else{
                        swal.fire("Atención", objData.msg, "error");
                    }
                }
            }
        }
    });
}

//CERRAR MODAL DE BOTON NUEVO Y EDITAR
$('.cerrarModal').click(function(){
    $('#modal_editar_precarga').modal('hide');
});