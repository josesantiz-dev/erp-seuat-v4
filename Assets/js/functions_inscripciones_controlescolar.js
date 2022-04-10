var tableInscripciones;
var idPersonaSeleccionada;
var formInscripcionNueva = document.querySelector("#formInscripcionNueva");
var formTutorNuevo = document.querySelector("#formAgregarTutor");
let divCambiarSubcampania = document.querySelector('.cambiarsubcampania');

document.getElementById("btnAnterior").style.display = "none";
document.getElementById("btnAnteriorEdit").style.display = "none";
document.getElementById("btnSiguiente").style.display = "none";
document.getElementById("btnSiguienteEdit").style.display = "none";
document.getElementById("btnActionFormNuevo").style.display = "none";
document.getElementById("btnActionFormEdit").style.display = "none";
document.querySelector('.listCampSubPos').style.display = "none";
var tabActual = 0;
var tabActualEdit = 0;
mostrarTab(tabActual);
mostrarTabEdit(tabActualEdit);

divCambiarSubcampania.style.display = "none";

document.addEventListener('DOMContentLoaded', function(){
	fnPlantelSeleccionadoDatatable(document.querySelector('#listPlantelDatatable').value);
});
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
            "url": " "+base_url+"/Inscripcion/buscarPersonaModal?val="+textoBusqueda,
            "dataSrc":""
        },
        "columns":[
            {"data":"nombre"},
            {"data":"estatus"},
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

//Lista de Inscritos en una Carrera y Mostrar en un MODAL

function fnListaInscritos(answer){
    var idCarrera = answer.id;
    var grado = answer.getAttribute('gr');
    var turno = answer.getAttribute('tr');
    //console.log(answer);
    var url= base_url+"/Inscripcion/getInscritos?idCarrera="+idCarrera+"&grado="+grado+"&turno="+turno;
    fetch(url)
        .then(res => res.json())
        .then((resultado) => {
            document.getElementById('valoresListaInscritos').innerHTML = "";
            var contador = 0;
			resultado.forEach(element => {
                contador += 1;
                document.getElementById('valoresListaInscritos').innerHTML +='<tr><td class="text-center"><input type="checkbox" onclick="fnCheckInputAlumno()" aria-label="check" id="'+element.id+'"></td><td>'+contador+'</td><td>'+element.nombre_persona+'</td><td>'+element.apellidos+'</td><td><button type="button" class="btn btn-outline-secondary btn-secondary btn-sm" onclick=fnBtnDesInscribir('+element.id+')>Cancelar</button></td><td><button type="button" class="btn btn-outline-secondary btn-primary btn-sm icono-color-principal btn-inline" style="display: inline;" onclick="fnImprimirSolInscripcion('+element.id+')"><i class="fas fa-print icono-azul"></i></i><span> Imprimir</span></button></td></tr>'
            });
        })
        .catch(err => { throw err });

}


function seleccionarPersona(answer){
    idPersonaSeleccionada = answer.id;
    let nombrePersona = answer.getAttribute('rl');
    document.querySelector('#txtNombreNuevo').value = nombrePersona;
    document.querySelector('#idPersonaSeleccionada').value = idPersonaSeleccionada; 
    $('#cerrarModalBuscarPersona').click();
}

formInscripcionNueva.onsubmit = function(e){
    e.preventDefault();
    var strNombrePersona = document.querySelector('#txtNombreNuevo').value;
    var intPlantel = document.querySelector('#listPlantelNuevo').value;
    var intCarrera = document.querySelector('#listCarreraNuevo').value;
    var intGrado = document.querySelector('#listGradoNuevo').value;
    var intTurno = document.querySelector('#listTurnoNuevo').value;
    var strNombreTutor = document.querySelector('#txtNombreTutorAgregar').value;
    var strAppPaternoTutor = document.querySelector('#txtAppPaternoTutorAgregar').value;
    var strAppMaternoTutor = document.querySelector('#txtAppMaternoTutorAgregar').value;
    console.log(strNombrePersona);
    if(strNombrePersona == '' || intPlantel == '' || intCarrera == '' || intGrado == '' || intTurno == '' || strNombreTutor == '' || strAppPaternoTutor == ''|| strAppMaternoTutor == '' ){
        swal.fire("Atención","Atención todos los campos son obligatorios","warning");
        return false;
    }
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+'/Inscripcion/setInscripcion';
    var formData = new FormData(formInscripcionNueva);
    request.open("POST",ajaxUrl,true);
    request.send(formData);
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var objData = JSON.parse(request.responseText);
            //console.log(objData);
            if(objData.estatus){
                formInscripcionNueva.reset();
                swal.fire("Inscripcion",objData.msg,"success").then((result) =>{
                    //s$('.close').click();
                    Swal.fire({
                        title: 'Solicitud',
                        text:'Desea imprimir la solicitud de inscripcion?',
                        icon:'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'si, imprimir',
                        cancelButtonText: 'No'
                      }).then((result) => {
                            if(result.isConfirmed){
                                $('.close').click();
                                window.open(base_url+'/Inscripcion/imprimir_solicitud_inscripcion/'+objData.data, '_blank');
                          }else{
                            $('.close').click();
                          }
                      })
                });
                tableInscripciones.api().ajax.reload();
            }else{
                swal.fire("Error",objData.msg,"error");
            }
        }
        return false;
    }
}

function fnPlantelSeleccionado(answer){
    const selCarreras = document.querySelector('#listCarreraNuevo');
    let url = base_url+"/Inscripcion/getCarreras?iplantel="+answer;
    fetch(url)
        .then(res => res.json())
        .then((resultado) => {
			selCarreras.innerHTML = "";
            for (let i = 0; i < resultado.length; i++) {
                opcion = document.createElement('option');
                opcion.text = resultado[i]['nombre_carrera'];
                opcion.value = resultado[i]['id'];
                selCarreras.appendChild(opcion);
            }
        })
        .catch(err => { throw err });
}

function fnPlantelSeleccionadoEdit(answer){
    const selCarreras = document.querySelector('#listCarreraEdit');
    let url = base_url+"/Inscripcion/getCarreras?iplantel="+answer;
    fetch(url)
        .then(res => res.json())
        .then((resultado) => {
			selCarreras.innerHTML = "";
            for (let i = 0; i < resultado.length; i++) {
                opcion = document.createElement('option');
                opcion.text = resultado[i]['nombre_carrera'];
                opcion.value = resultado[i]['id'];
                selCarreras.appendChild(opcion);
            }
        })
        .catch(err => { throw err });
}

function fnNavTab(numTab){
    var x = document.getElementsByClassName("tab");
    for(var i = 0; i<x.length;i++){
        x[i].style.display = "none";
    }
    x[numTab].style.display = "block";
    estadoIndicadores(numTab);
}
function fnNavTabEddit(numTab){
    //console.log(numTab);    
    var x = document.getElementsByClassName("tabEdit");
    for(var i = 0; i<x.length;i++){
        x[i].style.display = "none";
    }
    x[numTab].style.display = "block";
    estadoIndicadoresEdit(numTab);
}
function mostrarTab(tabActual){
    //console.log(tabActual);
    var tab = document.getElementsByClassName("tab");
    tab[tabActual].style.display = "block";
    if(tabActual == 0){
        document.getElementById("btnSiguiente").style.display = "inline";
        document.getElementById("btnAnterior").style.display = "none";
    }else{
        document.getElementById("btnAnterior").style.display = "inline";
    }
    if(tabActual == (tab.length - 1)){
        document.getElementById("btnSiguiente").style.display = "none";
        document.getElementById("btnActionFormNuevo").style.display = "inline";
    }else{
        document.getElementById("btnSiguiente").style.display = "inline";
        document.getElementById("btnActionFormNuevo").style.display = "none";
    }
    estadoIndicadores(tabActual);
}
function mostrarTabEdit(tabActualEdit){
    var tab = document.getElementsByClassName("tabEdit");
    //console.log(tab);
    tab[tabActualEdit].style.display = "block";
    if (tabActualEdit == 0) {
      document.getElementById("btnSiguienteEdit").style.display = "inline";
      document.getElementById("btnAnteriorEdit").style.display = "none";
    } else {
      document.getElementById("btnAnteriorEdit").style.display = "inline";
    }
    if (tabActualEdit == (tab.length - 1)) {
      document.getElementById("btnSiguienteEdit").style.display = "none";
      document.getElementById("btnActionFormEdit").style.display = "inline";
    } else {
      document.getElementById("btnSiguienteEdit").style.display = "inline";
      document.getElementById("btnActionFormEdit").style.display = "none";
    }
    estadoIndicadoresEdit(tabActualEdit)
} 
function pasarTab(n) {
    var x = document.getElementsByClassName("tab");
    //n = 1 : siguiente; n = -1 : anterior
    x[tabActual].style.display = "none";
    tabActual = tabActual + n;
    if (tabActual >= x.length) {
      //var jos = document.getElementById("formPlanEstudiosNueva").submit();
      //console.log(jos);
    }
    mostrarTab(tabActual);
    
  }
   function pasarTabEdit(n) {
    var x = document.getElementsByClassName("tabEdit");
    //n = 1 : siguiente; n = -1 : anterior
    x[tabActualEdit].style.display = "none";
    tabActualEdit = tabActualEdit + n;
    if (tabActualEdit >= x.length) {
      //var jos = document.getElementById("formPlanEstudiosNueva").submit();
      //console.log(jos);
    }
    mostrarTabEdit(tabActualEdit);
    
  } 
  function estadoIndicadores(tabActual) {
    var posStep, step = document.getElementsByClassName("step");
    var posTab, tab = document.getElementsByClassName("tab-nav");
    for (posStep = 0; posStep < step.length; posStep++) {
      step[posStep].className = step[posStep].className.replace(" active", "");
  
    }
    step[tabActual].className += " active";
    for (posTab = 0; posTab < tab.length; posTab++) {
      tab[posTab].className = tab[posTab].className.replace(" active", "");
    }
    tab[tabActual].className += " active";

    if(tabActual == 0){
        document.getElementById("btnSiguiente").style.display = "inline";
        document.getElementById("btnAnterior").style.display = "none";
    }else{
        document.getElementById("btnAnterior").style.display = "inline";
    }
    if(tabActual == (tab.length - 1)){
        document.getElementById("btnSiguiente").style.display = "none";
        document.getElementById("btnActionFormNuevo").style.display = "inline";
    }else{
        document.getElementById("btnSiguiente").style.display = "inline";
        document.getElementById("btnActionFormNuevo").style.display = "none";
    }
  }
   function estadoIndicadoresEdit(tabActualEdit) {
    var posStep, step = document.getElementsByClassName("stepEdit");
    var posTab, tab = document.getElementsByClassName("tab-navEdit");
    for (posStep = 0; posStep < step.length; posStep++) {
      step[posStep].className = step[posStep].className.replace(" active", "");
  
    }
    step[tabActualEdit].className += " active";
    for (posTab = 0; posTab < tab.length; posTab++) {
      tab[posTab].className = tab[posTab].className.replace(" active", "");
    }
    tab[tabActualEdit].className += " active";

    if(tabActualEdit == 0){
        document.getElementById("btnSiguienteEdit").style.display = "inline";
        document.getElementById("btnAnteriorEdit").style.display = "none";
    }else{
        document.getElementById("btnAnteriorEdit").style.display = "inline";
    }
    if(tabActualEdit == (tab.length - 1)){
        document.getElementById("btnSiguienteEdit").style.display = "none";
        document.getElementById("btnActionFormEdit").style.display = "inline";
    }else{
        document.getElementById("btnSiguienteEdit").style.display = "inline";
        document.getElementById("btnActionFormEdit").style.display = "none";
    } 
  } 

 function fnChkAlumnoTutor(){
    if(document.querySelector('#chk-alumno-tutor').checked == true){
        let url = base_url+"/Inscripcion/getPersona?id="+idPersonaSeleccionada;
        fetch(url)
            .then(res => res.json())
            .then((resultado) => {
                console.log(resultado);
                document.querySelector('#txtNombreTutorAgregar').value = resultado['nombre_persona'];
                document.querySelector('#txtAppPaternoTutorAgregar').value = resultado['ap_paterno'];
                document.querySelector('#txtAppMaternoTutorAgregar').value = resultado['ap_materno'];
                document.querySelector('#txtTelCelularTutorAgregar').value = resultado['tel_celular'];
                document.querySelector('#txtTelFijoTutorAgregar').value = resultado['tel_fijo'];
                document.querySelector('#txtEmailTutorAgregar').value = resultado['email'];
                document.querySelector('#txtDireccionNuevo').value = resultado['direccion'] + ', '+ resultado['colonia'];
            })
            .catch(err => { throw err });
     }else{

     }
 }

 function fntDocumentacionInscripcion(id){
    let url = base_url+"/Inscripcion/getDocumentos?id_alumno="+id;
    fetch(url)
        .then(res => res.json())
        .then((resultado) => {
            var contador = 0;
            var opciones = `<td><div class='custom-control custom-switch custom-switch-off-danger custom-switch-on-success'>
                            <input type='checkbox' aria-label='Checkbox for following text input'></div></td><td>
                            <div class='custom-control custom-switch custom-switch-off-danger custom-switch-on-success'>
                            <input type='checkbox' aria-label='Checkbox for following text input'></div></td><td>
                            <div class='custom-control custom-switch custom-switch-off-danger custom-switch-on-success'>
                            <input type='checkbox' aria-label='Checkbox for following text input'></div></td>`;
                            
            document.querySelector('#tbDocumentacionIns').innerHTML = "";
            resultado.forEach(element => {
                contador +=  1;
                document.querySelector('#tbDocumentacionIns').innerHTML += '<tr><th>'+contador+'</th><td>'+element['tipo_documento']+'</td>'+opciones+'</tr>';

            });
/* ocument.querySelector('#txtNombreTutorAgregar').value = resultado['nombre_persona'];
            document.querySelector('#txtAppPaternoTutorAgregar').value = resultado['ap_paterno'];
            document.querySelector('#txtAppMaternoTutorAgregar').value = resultado['ap_materno'];
            document.querySelector('#txtTelCelularTutorAgregar').value = resultado['tel_celular'];
            document.querySelector('#txtTelFijoTutorAgregar').value = resultado['tel_fijo'];
            document.querySelector('#txtEmailTutorAgregar').value = resultado['email']; */
        })
        .catch(err => { throw err });
 }
 function fntEditInscripcion(idInscripcion){
    var idInscripcion = idInscripcion;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl  = base_url+'/Inscripcion/getInscripcion/'+idInscripcion;
    request.open("GET",ajaxUrl ,true);
	request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var objData = JSON.parse(request.responseText);
            console.log(objData);
            if(objData){   
                document.querySelector("#txtNombreEdit").value = objData[0].nombre_persona+" "+objData[0].ap_paterno+" "+objData[0].ap_materno;
                document.querySelector('#listPlantelEdit').querySelector('option[value="'+objData[0].id_plantel+'"]').selected = true;
                document.querySelector('#listCarreraEdit').innerHTML = "<option value='"+objData[0].id_carrera+"' selected>"+objData[0].nombre_carrera+"</option>";

            }else{
                swal.fire("Error", objData.msg , "error");
            }
        }
    }
}
function fnPlantelSeleccionadoDatatable(value){
    var idPlantel = value;
    var nombrePlantel = document.querySelector('#listPlantelDatatable');
    var text= nombrePlantel.options[nombrePlantel.selectedIndex].text;
    document.querySelector('#nombrePlantelDatatable').innerHTML = text;
    tableInscripciones = $('#tableInscripciones').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": " "+base_url+"/Assets/plugins/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Inscripcion/getInscripcionesControlEscolar?idplantel="+idPlantel,
            "dataSrc":""
        },
        "columns":[
            {"data":"numeracion"},
            {"data":"nombre_carrera"},
            {"data":"nombre_nivel_educativo"},
            {"data":"grado"},
            {"data":"nombre_plan"},
            {"data":"nombre_turno"},
            {"data":"nombre_grupo"},
            {"data":"total"},
            {"data":'options'}

        ],
        "responsive": true,
	    "paging": true,
	    "lengthChange": true,
	    "searching": true,
	    "ordering": true,
	    "info": true,
	    "autoWidth": false,
	    "scrollY": '42vh',
	    "scrollCollapse": true,
	    "bDestroy": true,
	    "order": [[ 0, "asc" ]],
	    "iDisplayLength": 25
    });
}$('#tableInscripciones').DataTable();

//Imprimir solicitud inscripcion en la lista Inscritos 
function fnImprimirSolInscripcion(value){
    var idInscripcion = value;
    window.open(base_url+'/Inscripcion/imprimir_solicitud_inscripcion/'+idInscripcion, '_blank');
}

function fnCambiarCamSubcampania(){
    divCambiarSubcampania.style.display = "flex";
}
function fnQuitCambiarSubCampania(){
    divCambiarSubcampania.style.display = "none";
}

function campaniaSeleccionada(value){
    if(value != ''){
        let idSubCampania = value;
        let str = document.querySelector('.listCampSub').options[document.querySelector('.listCampSub').selectedIndex].text;
        document.querySelector('.nombrecampania').textContent = str;
        document.querySelector('#idSubcampaniaNuevo').value =idSubCampania;
    }
}
function fnCheckAllInscritos(){
    let check = document.querySelector('#tableListaInscritos');
    let arrInput = check.getElementsByTagName("input");
    if(document.querySelector('#checkAllInscritos').checked == true){
        arrInput.forEach(element => {
            element.checked = true;
        });
        document.querySelector('#listAccionesUsSel').disabled = false;
        document.querySelector('.listCampSubPos').style.display = "none";
    }else{
        arrInput.forEach(element => {
            element.checked = false;
        }); 
        document.querySelector('#listAccionesUsSel').disabled = true;
        document.querySelector('.listCampSubPos').style.display = "none";
    }
}
function fnCheckInputAlumno(){
    if(sizeCheckInput() != 0){
        document.querySelector('#listAccionesUsSel').disabled = false;
        document.querySelector('.listCampSubPos').style.display = "none";
    }else{
        document.querySelector('#listAccionesUsSel').disabled = true;
        document.querySelector('.listCampSubPos').style.display = "none";
    }
}
function fnBtnDesInscribir(value){
    Swal.fire({
        title: 'Des-inscribir',
        text: "¿Realmente desea des-inscribir al usuario 'Alumno' (Previamente inscrito)?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, des-inscribir',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            let url = `${base_url}/Inscripcion/des_inscribir/${value}`;
            fetch(url)
            .then(res => res.json())
            .then((resultado) => {
                if(resultado.estatus){
                    tableInscripciones.api().ajax.reload();
                    $('#cerrarModalListaInscritos').click();
                    Swal.fire(
                        'Exito!',
                        resultado.msg,
                        'success'
                    )
                }
            })
            .catch(err => { throw err });
        }
    })
}
function accionesUsuariosSeleccionados(value){
    if(value != ''){
        //Desinscribir usuarios seleccionados
        if(value == 0){
            if(sizeCheckInput() > 0){
                Swal.fire({
                    title: 'Des-inscribir',
                    text: "¿Realmente desea des-inscribir al los usuarios 'Alumnos' (Previamente inscritos)?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, des-inscribir',
                    cancelButtonText: 'No'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let url = `${base_url}/Inscripcion/des_inscribir_usuarios/${jsonToString(arrCkeckedInputTrue())}`;
                        fetch(url)
                        .then(res => res.json())
                        .then((resultado) => {
                            if(resultado.estatus){
                                tableInscripciones.api().ajax.reload();
                                $('#cerrarModalListaInscritos').click();
                                Swal.fire('Exito!',resultado.msg,'success')
                            }else{
                                Swal.fire('Error!',resultado.msg,'error');
                            }
                        }).catch(err => {throw err});
                    }
                })
            }
            document.querySelector('.listCampSubPos').style.display = "none";
        }else if(value == 1){
            document.querySelector('.listCampSubPos').style.display = "inline";
        }
    }
}
function campSubPosSeleccionada(value){
    let arrData = {'datos':arrCkeckedInputTrue(),'idSubcampania':value};
    let url = `${base_url}/Inscripcion/posponer_usuarios/${jsonToString(arrData)}`;
    if(value != ''){
        Swal.fire({
            title: 'Posponer',
            text: "¿Realmente desea posponer al los usuarios 'Alumnos' (Previamente inscritos)?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, posponer',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(url)
                .then(res => res.json())
                .then((resultado) => {
                    if(resultado.estatus){
                        tableInscripciones.api().ajax.reload();
                        $('#cerrarModalListaInscritos').click();
                        Swal.fire('Exito!',resultado.msg,'success')
                    }else{
                        Swal.fire('Error!',resultado.msg,'error');
                    }
                }).catch(err => {throw err});
            }
        })
    }
}
//Retorna todos los input check TRUE
function arrCkeckedInputTrue(){
    let check = document.querySelector('#tableListaInscritos');
    let arrInput = check.getElementsByTagName("input");
    let arrCheck = [];
    arrInput.forEach(element => {
        if(parseInt(element.id) && element.checked == true){
            let arr = {'id_inscripcion':parseInt(element.id),'estatus_check':element.checked}
            arrCheck.push(arr);
        }
    });
    return arrCheck;
}
//Retorna todos los input con true o false del checked
function arrCkeckedInput(){
    let check = document.querySelector('#tableListaInscritos');
    let arrInput = check.getElementsByTagName("input");
    let arrCheck = [];
    arrInput.forEach(element => {
        if(parseInt(element.id)){
            let arr = {'id_inscripcion':parseInt(element.id),'estatus_check':element.checked}
            arrCheck.push(arr);
        }
    });
    return arrCheck;
}
//Retornar numero de cheked en la tabla
function sizeCheckInput(){
    let check = document.querySelector('#tableListaInscritos');
    let arrInput = check.getElementsByTagName("input");
    let size = 0;
    arrInput.forEach(element => {
        if(parseInt(element.id) && element.checked == true){
            size += 1;
        }
    });
    return size;
}
//console.log(arrCkeckedInput);
//Funcion para convertir json a String
function jsonToString(json){
    return JSON.stringify(json);
}