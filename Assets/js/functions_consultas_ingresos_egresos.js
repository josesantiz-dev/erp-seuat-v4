let buscar = document.querySelector("#btnBuscar");
let verEdoCta = document.querySelector("#btnVerEdoCta");
let buscarAlumno = document.querySelector("#btnBuscarAlumno");
let cardsEdoCta = document.querySelector('.card_dato_cta');
let dataTableEdoCta = document.querySelector('#tableEstadoCuenta');
let matriculaRFAlumno = "";
let idAlumnoSeleccionado;
cardsEdoCta.style.display = "none";
dataTableEdoCta.style.display = "row";

//click en boton buscar alumno
buscar.addEventListener('click',function() {
    matriculaRFAlumno = document.querySelector('#txtNombrealumno').value;
    idAlumnoSeleccionado = null;
    if(matriculaRFAlumno == ''){
        swal.fire("Atención","Campo vacio de Matricula o RFC","warning");
        cardsEdoCta.style.display = "none";
        return false;
    }else{
        fnGetDatosAlumno(matriculaRFAlumno,idAlumnoSeleccionado);  //Ejecutar funcion
    }
})
//Selecciionar persona en el Modal Buscar persona
function seleccionarPersona(value){
    $('#cerrarModalBuscarPersona').click();
    let matricula = value.getAttribute('m');
    let rfc = value.getAttribute('r');
    let id = value.getAttribute('id');
    idAlumnoSeleccionado = id;
    if(matricula == '' && rfc == ''){
        matriculaRFAlumno = null;
    }else if(matricula == '' && rfc != ''){
        matriculaRFAlumno = rfc;
    }else if(matricula != '' && rfc == ''){
        matriculaRFAlumno = matricula;
    }else if(matricula != '' && rfc != ''){
        matriculaRFAlumno = matricula;
    }
    fnGetDatosAlumno(matriculaRFAlumno,idAlumnoSeleccionado); //Ejecutar funcion
}

//click en el boton ver estado de cuenta
verEdoCta.addEventListener('click',function() {
    fnGetEstadoCuentaAlumno(matriculaRFAlumno,idAlumnoSeleccionado);   
})

//Consultar estado de cuenta y mostrar en Datatable
function fnGetEstadoCuentaAlumno(matriculaRFAlumno,idAlumno){ 
/*     let url = `${base_url}/ConsultasIngresosEgresos/getEstadoCuenta/${matriculaRFAlumno}/${idAlumno}`;
    fetch(url).then(res => res.json()).then((resultado) => {
        console.log(resultado);
    }).catch(err => { throw err }); */
    dataTableEdoCta = $('#tableEstadoCuenta').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": ` ${base_url}/Assets/plugin/Spanish.json`
        },
        "ajax":{
            "url": ` ${base_url}/ConsultasIngresosEgresos/getEstadoCuenta/${matriculaRFAlumno}/${idAlumno}`,
            "dataSrc":""
        },
        "columns":[
            {"data":"numeracion"},
            {"data":"fecha"},
            {"data":"concepto"},
            {"data":"nombre_servicio"},
            {"data":"nombre_servicio"},
            {"data":"cargo"},
            {"data":"abono"},
            {"data":"precio_unitario"},
            {"data":"fecha_pago"},
            {"data":"referencia"},
            {"data":"tipo_comprobante"},
            {"data":"options"},
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
        "iDisplayLength": 20
    });
    $('#tableEstadoCuenta').DataTable();
}

//Imprimir estado de cuenta al hacer click en  por matriculaRFC o ID
btnImprimirEdoCta.addEventListener('click',function(){
    let url = `${base_url}/ConsultasIngresosEgresos/imprimir_edo_cta/${convStrToBase64(matriculaRFAlumno)}/${convStrToBase64(idAlumnoSeleccionado)}`;
    window.open(url,'_blank');
})

//Mostrar resultado en Datatable en Modal de Buscar persona
function buscarPersona(){
    let textoBusqueda = $("input#busquedaPersona").val();
    var tablePersonas;
    tablePersonas = $('#tablePersonas').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": ` ${base_url}/Assets/plugin/Spanish.json`
        },
        "ajax":{
            "url": ` ${base_url}/ConsultasIngresosEgresos/buscarPersonaModal?val=${textoBusqueda}`,
            "dataSrc":""
        },
        "columns":[
            {"data":"nombre"},
            {"data":"rfc"},
            {"data":"matricula_interna"},
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

//Obtener datos Personales y Estado de cuenta del Alumno por matricula/RFC o ID
function fnGetDatosAlumno(matriculaRFAlumno,idAlumno){
    let url = `${base_url}/ConsultasIngresosEgresos/getDatosAlumno/${matriculaRFAlumno}/${idAlumno}`;
    fetch(url).then(res => res.json()).then((resultado) => {
        if(resultado.estatus){
            cardsEdoCta.style.display = "block";
            var table = $('#tableEstadoCuenta').DataTable();
            table.clear().draw();
            let nomCompleto = resultado.datos.nombre_persona+' '+resultado.datos.ap_paterno+' '+resultado.datos.ap_materno;
            document.querySelector('#nomAlumEdoCta').innerHTML = nomCompleto;
            document.querySelector('#totalSaldo').innerHTML = formatoMoneda(resultado.totalSaldo.toFixed(2));
            document.querySelector('#telCelAlumno').innerHTML = " "+resultado.datos.tel_celular;
            document.querySelector('#emailAlumno').innerHTML = " "+resultado.datos.email;
            document.querySelector('#domicilioAlumno').innerHTML = " "+resultado.datos.domicilio;
            document.querySelector('#carreraAlumno').innerHTML = " "+resultado.datos.nombre_carrera;
            document.querySelector('#nombreSalon').innerHTML = " "+resultado.datos.nombre_salon;
            document.querySelector('#saldoColegiaturas').innerHTML = formatoMoneda(resultado.saldoColegiaturas.toFixed(2));
            document.querySelector('#saldoServicios').innerHTML = formatoMoneda(resultado.saldoServicios.toFixed(2));
        }else{
            swal.fire("Atención",resultado.msg,"warning");
            return false; 
        }
    }).catch(err => { throw err });
}

//Funcion para Facturar
function fnFacturarVenta(value){
    Swal.fire({
        title: 'Facturar?',
        text: "Desea facturar al folio " +value.id+ " ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, facturar!',
        cancelButtonText: 'No',
    })
}

//Reimpsirmir comprobante
function fnReimprimirComprobante(value){
    Swal.fire({
        title: 'Reimprimir?',
        text: "Desea reimprimir el comprobante del folio " +value.id+ " ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, reimprimir!',
        cancelButtonText: 'No',
    }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Exito!',
            'Comprobante generado correctamente.',
            'success'
          )
            let url = `${base_url}/Ingresos/imprimir_comprobante_venta/${convStrToBase64(value.id)}`;
            window.open(url,'_blank');

        }
      })
}

//Funcion para cancelar una Venta
function fnCancelarVenta(value){
    Swal.fire({
        title: 'Cancelar?',
        text: "Desea cancelar al folio " +value.id+ " ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No',
    })
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