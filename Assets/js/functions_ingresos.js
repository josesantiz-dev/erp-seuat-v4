var tableIngresos;
let arrServicios = [];
let idPersonaSeleccionada;
let alertSinEdoCta = document.querySelector('#alertSinEdoCta');
let listServicios = document.querySelector('.listServicios');
let listPromociones = document.querySelector('.listPromociones');
let btnAgregarServicio = document.querySelector('#btnAgregarServicio');
let listTipoCobro = document.querySelector('#listTipoCobro');
let listGrado = document.querySelector('.listGrado');
alertSinEdoCta.style.display = "none";
listServicios.style.display = "none";
listPromociones.style.display = "none";
listGrado.style.display = "none";
btnAgregarServicio.disabled = true;
listTipoCobro.disabled = true;
let tipoCobroSeleccionado;
let gradoSeleccionado;
var formGenerarEdoCuenta = document.querySelector("#formGenerarEdoCuenta");

document.addEventListener('DOMContentLoaded', function(){
    $('.select2').select2(); //Inicializar Select 2 en el input promociones
    let url = new URLSearchParams(location.search);
    let i= url.get('d');
    if(i != null){
        let b64 = atob(i);
        let datos = JSON.parse(b64);
        if(datos){
           insertDatosAlServ(datos.id,datos.id_alumno,datos.nombre_completo,datos.nombre_servicio,datos.pu,datos.tipo,datos.precarga,datos.id_precarga);
        }
    }
});
//Mostrar lista de servicios dependiendo del tipo de cobro a realizar   
function fnServicios(grado,tipoCobro){
    let url;
    if(grado != null || tipoCobro != null){
        url = `${base_url}/Ingresos/getServicios/${grado}/${tipoCobro}/${idPersonaSeleccionada}`;
        fetch(url).then(res => res.json()).then((resultado) => {
            arrServiciosTodos = resultado.data;
            document.querySelector("#listServicios").innerHTML = "<option value=''>Selecciona un servicio</option>";
            if(resultado.tipo == "COL"){
                resultado.data.forEach(colegiatura => {
                    let estatus = (colegiatura.pagado == 1)?'/Pagado':'';
                    document.querySelector("#listServicios").innerHTML += `<option pu='${colegiatura.precio_unitario}' ec='1' es='${estatus}' t='col' value='${colegiatura.id_edo_cta}' idprecarga='${colegiatura.id_precarga}'>${colegiatura.nombre_servicio}${estatus}</option>`;
                    
                });
            }else{
                resultado.data.forEach(servicio => {
                    if(servicio.id_edo_cta){
                        document.querySelector("#listServicios").innerHTML += `<option pu='${servicio.precio_unitario}' ec='1' t="serv" value='${servicio.id_edo_cta}' idprecarga='${servicio.id_precarga}'>${servicio.nombre_servicio}---Si---</option>`;
                    }else{
                        document.querySelector("#listServicios").innerHTML += `<option pu='${servicio.precio_unitario}' ec='${servicio.aplica_edo_cuenta}' t="serv" value='${servicio.id}'>${servicio.nombre_servicio}${(servicio.aplica_edo_cuenta == 1)?'(----si----)':''}</option>`;
                    }
                });
            }
        }).catch(err => { throw err });
    }
}
//Lista de Promociones del Servicio seleccionado
function fnServicioSeleccionado(value){
    if(value != ""){
        let url = `${base_url}/Ingresos/getPromociones/${value}`;
        document.querySelector("#listPromociones").innerHTML = "<option value=''>Selecciona una promocion</option>";
        fetch(url).then(res => res.json()).then((resultado) => {
            if(resultado.length == 0){
                $('#listPromociones').val(null).trigger('change');
            }else{
                resultado.forEach(promocion => {
                    let nombrePromocion = `${promocion.nombre_promocion} (${promocion.porcentaje_descuento}%)`;
                    document.querySelector("#listPromociones").innerHTML += `<option des='${promocion.porcentaje_descuento}'value='${promocion.id}'>${nombrePromocion}</option>`;
                });
            }
        }).catch(err => { throw err });
        document.querySelector('#listPromociones').focus();
    }else{

    }
}
//Buscar persona por Modal
function fnInputBuscarPersona(){
    var textoBusqueda = $("input#inputBusquedaPersona").val();
    var tablePersonas;
    tablePersonas = $('#tablePersonas').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": ` ${base_url}/Assets/plugins/Spanish.json`
        },
        "ajax":{
            "url": ` ${base_url}/Ingresos/buscarPersonaModal?val=${textoBusqueda}`,
            "dataSrc":""
        },
        "columns":[
            {"data":"numeracion"},
            {"data":"nombre"},
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
        "order": [[ 0, "asc" ]],
        "iDisplayLength": 5
    });
    $('#tablePersonas').DataTable();
}
//Seleccionar una persona en el modal
function seleccionarPersona(answer){
    idPersonaSeleccionada = answer.id;
    let nombrePersona = answer.getAttribute('rl');
    document.querySelector('#txtNombreNuevo').value = nombrePersona;
    $('#cerrarModalBuscarPersona').click();
    let url = `${base_url}/Ingresos/getEstatusEstadoCuenta/${idPersonaSeleccionada}`;
    fetch(url).then(res => res.json()).then((resultado) => {
        if(resultado == true){ //true = tiene estado de cuenta
            alertSinEdoCta.style.display = "none";
            btnAgregarServicio.disabled = false;
            listTipoCobro.disabled = false;
            
        }else{
            btnAgregarServicio.disabled = true;
            alertSinEdoCta.style.display = "flex";
            listTipoCobro.disabled = true;
        }
    }).catch(err => { throw err });
    document.querySelector('#alertAgregarAlumno').style.display = "none";
}
//Agregar datos del servicio seleccionado en la Tabla
function fnBtnAgregarServicioTabla(){
    let servicio = document.querySelector('#listServicios');
    let cantidad = 1;
    let idServicio = servicio.value;
    let nombreServicio = servicio.options[servicio.selectedIndex].text;
    let precioUnitarioServicioSel = servicio.options[servicio.selectedIndex].getAttribute('pu');
    let estatus = servicio.options[servicio.selectedIndex].getAttribute('es');
    let tipo = servicio.options[servicio.selectedIndex].getAttribute('t');
    let edocta = servicio.options[servicio.selectedIndex].getAttribute('ec');
    let precarga = servicio.options[servicio.selectedIndex].getAttribute('idprecarga');
    if(tipo == 'col'){
        if(estatus != '' && idServicio != ''){
            swal.fire("Atención","El servicio seleccionado ya ha sido pagado","warning");
            return false;
        }
    }
    let subtotal = precioUnitarioServicioSel*cantidad;
    let acciones = `<td style='text-align:center'><a class='btn' onclick='fnBorrarServicioTabla(${idServicio})'><i class='fas fa-trash text-danger'></i></a></td>`;
    let arrServicio = {id_servicio:idServicio,nombre_servicio:nombreServicio,tipo_servicio:tipo,edo_cta:edocta,precarga:precarga,cantidad:cantidad,precio_unitario:precioUnitarioServicioSel,subtotal:subtotal,acciones:acciones,promociones:obtenerPromSeleccionados('listPromociones')};
    if(idServicio == "" || cantidad == ""){
        swal.fire("Atención","Atención todos los campos son obligatorios","warning");
        return false;
    }
    let isExist = false;
    let isTipo = [];
    arrServicios.forEach(servicio => {
        if(servicio.id_servicio == idServicio){
            isExist = true;
            document.querySelector(`#cantidad${idServicio}`).focus();
        }
        if(servicio.tipo_servicio == 'col' && tipo == 'col'){
            isTipo['is'] = true;
            //isTipo['msg'] = 'Solo se puede cobrar una sola colegiatura';
        }
        if(servicio.tipo_servicio == 'col' && tipo == 'serv'){
            isTipo['is'] = true;
            //isTipo['msg'] = 'No puedes cobrar colegiaturas con servicios';
        }
        if(servicio.tipo_servicio == 'serv' && tipo == 'serv'){
            isTipo['is'] = false;
            //isTipo['msg'] = '';
        }
        if(servicio.tipo_servicio == 'serv' && tipo == 'col'){
            isTipo['is'] = true;
            //isTipo['msg'] = 'No puedes cobrar servicios con colegiaturas';
        }
    });
    
        /* if(isTipo['is']){
            swal.fire("Atención",isTipo['msg'],"warning");
            return false;
        } */
    if(isExist){
        swal.fire("Atención","Ya existe el servicio, modifica la cantidad en la tabla","warning").then((result) =>{
            if(result.isConfirmed){
                fnServicios(gradoSeleccionado,tipoCobroSeleccionado);   //Error
                document.querySelector('#listPromociones').innerHTML = "";
            }
        });
    }else{
        Swal.fire({
            title: 'Agregar?',
            text: "Agregar el nuevo servicio",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si',
            cancelButtonText: 'No'
          }).then((result) => {
            if (result.isConfirmed) {
                document.querySelector("#tableServicios").innerHTML ="";
                document.querySelector('#listPromociones').innerHTML = "";
                arrServicios.push(arrServicio);
                mostrarServiciosTabla();
                fnServicios(gradoSeleccionado,tipoCobroSeleccionado);
                document.querySelector('#listPromociones').innerHTML ="<option value=''>Selecciona una promocion</option>";
                mostrarTotalCuentaServicios();
                listPromociones.style.display = "none";
                listServicios.style.display = "none";
                listTipoCobro.querySelector('option[value=""]').selected = true;
            }
          })
    }
}
//Funcion para el boton de borrar un servicio agregado en la Tabla  
function fnBorrarServicioTabla(value){
    let arrServicioNew = [];
    arrServicios.forEach(servicio => {
        if(servicio.id_servicio != value){
            let arrServicio = {id_servicio:servicio.id_servicio,nombre_servicio:servicio.nombre_servicio,tipo_servicio:servicio.tipo_servicio,edo_cta:servicio.edo_cta,precarga:servicio.precarga,promociones:servicio.promociones,cantidad:servicio.cantidad,precio_unitario:servicio.precio_unitario,subtotal:servicio.subtotal,acciones:servicio.acciones};
            arrServicioNew.push(arrServicio);
        }
    });
    arrServicios = arrServicioNew;
    mostrarServiciosTabla();
} 
//Mostrar los servicios en la Tabla
function mostrarServiciosTabla(){
    document.querySelector("#tableServicios").innerHTML ="";
    let totalServicios = 0;
    arrServicios.forEach(servicio => {
        totalServicios += 1;
        let descuentoPorc = 0;
        servicio.promociones.forEach(promocion => {
            if(promocion.descuento == null){
                descuentoPorc += 0;
            }else{
                let descuento = parseFloat(promocion.descuento);
                descuentoPorc += descuento;
            }
        });
        if(servicio['tipo_servicio'] == 'col'){
            document.querySelector("#tableServicios").innerHTML += `<tr><td>${totalServicios}</td><td>${servicio.nombre_servicio}</td><td>${formatoMoneda(servicio.precio_unitario)}</td><td><input id='cantidad${servicio.id_servicio}' type='number' style='width: 6em;' value='${servicio.cantidad}' min='0' onkeyup='modCantidadServ(this)' onchange='modCantidadServ(this)' disabled></td><td>${descuentoPorc}%</td><td>${formatoMoneda(servicio.subtotal.toFixed(2))}</td>${servicio.acciones}</tr>`
        }else{
            document.querySelector("#tableServicios").innerHTML += `<tr><td>${totalServicios}</td><td>${servicio.nombre_servicio}</td><td>${formatoMoneda(servicio.precio_unitario)}</td><td><input id='cantidad${servicio.id_servicio}' type='number' style='width: 6em;' value='${servicio.cantidad}' min='0' onkeyup='modCantidadServ(this)' onchange='modCantidadServ(this)'></td><td>${descuentoPorc}%</td><td>${formatoMoneda(servicio.subtotal.toFixed(2))}</td>${servicio.acciones}</tr>`
        }
    });
    mostrarTotalCuentaServicios();
}
//funcion para mostrar Totales 
function mostrarTotalCuentaServicios(){
    let total = 0;
    let descuentoPorc = 0;
    let totalDesc = 0;
    arrServicios.forEach(servicio => {
        let subtotal = parseFloat(servicio.subtotal);
        servicio.promociones.forEach(promocion => {
            if(promocion.descuento != null){
                let descuento = parseFloat(promocion.descuento);
                descuentoPorc += descuento;
            }else{
                descuentoPorc += 0;
            }
        });
        total += subtotal;
    });

    totalDesc = total - (total * (descuentoPorc/100));
    document.querySelector('#txtSubtotal').innerHTML = `${formatoMoneda(total)}`;
    document.querySelector('#txtDescuento').innerHTML = `${descuentoPorc}%`;
    document.querySelector('#txtTotal').innerHTML = `${formatoMoneda(totalDesc.toFixed(2))}`;
}
//function para cambiar cantidad de los servicios en Tabla
function modCantidadServ(val){
    console.log(val);
    let cantidad = val.value;
    let idServicio = val.id.split('cantidad')[1];
    if(val.value.length >= 11){
        swal.fire("Atención","La cantidad debe ser menor de 11 dígitos","warning");
        return false;
    }
    arrServicios.forEach(servicio => {
        if(servicio.id_servicio == idServicio){
            servicio.cantidad = cantidad;
            servicio.subtotal = servicio.precio_unitario*cantidad;
        }
    });
    if(cantidad != 0){
        mostrarServiciosTabla();
    }
}
//Generar estado de cuenta de la persona seleccionada
function fnGenerarEstadoCuenta(){
    Swal.fire({
        title: 'Estado de cuenta',
        text: "Generar un estado de cuenta para el Alumno?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            let url = `${base_url}/Ingresos/generarEdoCuenta/${idPersonaSeleccionada}`;
            Swal.fire({
                title:'Generando estado de cuenta',
                html: "<div class='overlay'><i class='fas fa-3x fa-sync-alt fa-spin'></i><div class='text-bold pt-2'>espere...</div></div>",
                icon:'question',
                showConfirmButton:false,
                didOpen: () =>{
                    fetch(url).then(res => res.json()).then((resultado) => {
                        if(resultado.estatus){
                            swal.fire("Estado de cuenta","Estado de cuenta generado correctamente!","success").then((result) =>{
                            btnAgregarServicio.disabled = false;
                            alertSinEdoCta.style.display = "none";
                            listTipoCobro.disabled = false;
                            });
                        }else{
                            swal.fire("Estado de cuenta",resultado.msg,"warning");
                        }
                    }).catch(err => { throw err });
                }
            })  
        }
    })
}
//Function para el boton de Cobrar
function fnButtonCobrar(){
    let total = 0;
    let descuentoPorc = 0;
    let totalDesc = 0;
    arrServicios.forEach(servicio => {
        let subtotal = parseFloat(servicio.subtotal);
        servicio.promociones.forEach(promocion => {
            if(promocion.descuento != null){
                let descuento = parseFloat(promocion.descuento);
                descuentoPorc += descuento;
            }else{
                descuentoPorc += 0;
            }
        });
        total += subtotal;
    });
    totalDesc = total - (total * (descuentoPorc/100));
    if(arrServicios.length == 0){
        document.querySelector('#alertSinServicio').style.display = "inline";
        document.querySelector('#cobro').style.display = "none";
    }else{
        document.querySelector('#alertSinServicio').style.display = "none";
        document.querySelector('#cobro').style.display = "inline";
        //document.querySelector('#txtSubtotalModal').innerHTML= formatoMoneda(total.toFixed(2));
        //document.querySelector('#txtDescuentoModal').innerHTML= `${descuentoPorc} %`;
        document.querySelector('#txtTotalModal').innerHTML= formatoMoneda(totalDesc.toFixed(2));
    }
}
//Function para obtener un array de las promociones seleccionados en Multiselect
function obtenerPromSeleccionados(param){
    let idList = param;
    var values = Array.prototype.slice.call(document.querySelectorAll(`#${idList} option:checked`),0).map(function(v,i,a,) { 
        return {id_promocion:v.value,descuento:v.getAttribute('des'),nombre_promocion:v.text};
    });
    return values;
}
//Function para dar formato un numero a Moneda
function formatoMoneda(numero){
    let str = numero.toString().split(".");
    str[0] = str[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return "$"+str.join(".");
}
//Function para los tipos de Cobro
function fnTiposCobro(value){
    if(value != ""){
        tipoCobroSeleccionado = value;
        $('#listPromociones').val(null).trigger('change');
        document.querySelector("#listPromociones").innerHTML = "<option value=''>Selecciona una promocion</option>";
        if(value == 1){
            listServicios.style.display = "inline";
            listPromociones.style.display = "inline";
            listGrado.style.display = "inline";
                
        }else{
            listServicios.style.display = "block";
            listPromociones.style.display = "inline";
            listGrado.style.display = "inline";
        }
    }else{
        listPromociones.style.display = "none";
        listServicios.style.display = "none";
        listGrado.style.display ="none";
    }
}
function fnChangeGrado(value){
    gradoSeleccionado = value;
   if(value != ""){
       fnServicios(gradoSeleccionado,tipoCobroSeleccionado);
   }else{
        document.querySelector("#listServicios").innerHTML = "<option value=''>Selecciona un servicio</option>";    
   }
}
//Function para efectuar el Cobro /mostrar cambio y mandar a imprimir Recibo
function btnCobrarCmbio(){
    let metodoPago = document.querySelector('#metodos_pago').value
    let total = 0;
    let descuentoPorc = 0;
    let totalDesc = 0;
    arrServicios.forEach(servicio => {
        let subtotal = parseFloat(servicio.subtotal);
        servicio.promociones.forEach(promocion => {
            if(promocion.descuento != null){
                let descuento = parseFloat(promocion.descuento);
                descuentoPorc += descuento;
            }else{
                descuentoPorc += 0;
            }
        });
        total += subtotal;
    });
    totalDesc = total - (total * (descuentoPorc/100));

    let intEfectivo = document.querySelector('#txtEfectivo').value;

    if(intEfectivo == ''){
        swal.fire("Atención","Inserte la cantidad de efectivo","warning");
        return false;
    }else if(parseInt(intEfectivo) < total){
        swal.fire("Atención","La cantidad insertada es menor que el total","warning");
        return false;
    }else{  
        let tipoComprobante = (document.querySelector('#listTipoComprobante').value == 1)?'recibo':'factura'
        let observaciones = document.querySelector('#txtObservaciones').value;
        let url = ` ${base_url}/Ingresos/setIngresos?idP=${idPersonaSeleccionada}&tipoP=${metodoPago}&tipoCom=${tipoComprobante}&observacion=${observaciones}&date=${jsonToString(arrServicios)}`

        fetch(url).then(res => res.json()).then((resultado) => {
            console.log(resultado);
            if(resultado.estatus){
                let cambio = intEfectivo-total;
                swal.fire("Exito",`${resultado.msg}<br>Su cambio es de:<h1><b>${formatoMoneda(cambio.toFixed(2))}</b></h1>`,"success").then((result) =>{
                    if(result.isConfirmed){
                        window.open(`${base_url}/Ingresos/imprimir_comprobante_venta/${convStrToBase64(resultado.id)}`,'_blank');
                        $('#cerrarModalCobrar').click();
                        arrServicios = [];
                        mostrarServiciosTabla();
                    }
                });
           }else{
            swal.fire("Error",`${resultado.msg}`,"warning").then((result) =>{
                $('#cerrarModalCobrar').click();
            })
           }
        }).catch(err => { throw err });
    }
}
//Function para convertir un string  a  Formato Base64
function convStrToBase64(str){
    return window.btoa(unescape(encodeURIComponent( str ))); 
}
//Funcion para convertir json a String
function jsonToString(json){
    return JSON.stringify(json);
}
//Funcion para Aceptar solo Numeros en un Input
function validarNumeroInput(event){
    if(event.charCode >= 48 && event.charCode <= 57){
        return true;
    }
    return false;
}
function insertDatosAlServ(id,id_alumno,nombre_completo,nombre_servicio,precio_unitario,tipo,precarga,id_precarga){
    console.log(id_precarga)
    idPersonaSeleccionada = id_alumno;
    document.querySelector('#txtNombreNuevo').value = nombre_completo;
    document.querySelector('#listTipoCobro').disabled = false;
    document.querySelector('#btnAgregarServicio').disabled = false;
    document.querySelector('#alertAgregarAlumno').style.display = "none";
    let edocta = true;
    let cantidad = 1;
    let subtotal = parseInt(precio_unitario.replace('$',''));
    let acciones = `<td style='text-align:center'><a class='btn' onclick='fnBorrarServicioTabla(${id})'><i class='fas fa-trash text-danger'></i></a></td>`;
    let arrServicio = {id_servicio:id,nombre_servicio:nombre_servicio,tipo_servicio:tipo,edo_cta:edocta,precarga:id_precarga,cantidad:cantidad,precio_unitario:subtotal,subtotal:subtotal,acciones:acciones,promociones:obtenerPromSeleccionados('listPromociones')};
    Swal.fire({
        title: 'Agregar?',
        text: "Agregar el nuevo servicio",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {
            document.querySelector("#tableServicios").innerHTML ="";
            document.querySelector('#listPromociones').innerHTML = "";
            arrServicios.push(arrServicio);
            mostrarServiciosTabla();
            fnServicios(gradoSeleccionado,tipoCobroSeleccionado);
            document.querySelector('#listPromociones').innerHTML ="<option value=''>Selecciona una promocion</option>";
            mostrarTotalCuentaServicios();
            listPromociones.style.display = "none";
            listServicios.style.display = "none";
            listTipoCobro.querySelector('option[value=""]').selected = true;
        }
      })
    
}
function fnAperturarCaja(idcaja){
    Swal.fire({
        title: 'Aperturar?',
        input: 'number',
        text:'Para aperturar, ingrese el monto total de apertura',
        icon:'question',
        inputValue: '',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aperturar',
        cancelButtonText:'Cancelar',
        inputValidator: (value) => {
            if (!value) {
                return 'Ingrese una cantidad!'
            }else if(value.length > 6){
                return 'Solo se aceptan 6 digitos!'
            }else if(value < 0){
                return 'No se aceptan números negativos'
            }else{
                let url = `${base_url}/Ingresos/aperturarCaja/${idcaja}/${value}`;
                fetch(url)
                .then(res => res.json())
                .then((resultado) =>{
                    if(resultado){
                        Swal.fire('Exito!',resultado.msg,'success'
                        ).then((result) =>{
                            window.open(`${base_url}/Ingresos/`);
                        })
                    }else{
                        Swal.fire('Error!',resultado.msg,'warning')
                    }
                }).catch(err => { throw err });
            }
        }
    })
}