var formPlanEstudiosNuevo = document.querySelector("#formPlanEstudiosNueva");
document.getElementById("btnAnterior").style.display = "none";
document.getElementById("btnAnteriorEdit").style.display = "none";
document.getElementById("btnSiguiente").style.display = "none";
document.getElementById("btnSiguienteEdit").style.display = "none";
document.getElementById("btnActionFormNuevo").style.display = "none";
document.getElementById("btnActionFormEdit").style.display = "none";
var tabActual = 0;
var tabActualEdit = 0;
mostrarTab(tabActual);
mostrarTabEdit(tabActualEdit);
var tablePlanEstudios;
let arrClasificacion = [];

//Datatable
document.addEventListener('DOMContentLoaded', function(){
	tablePlanEstudios = $('#tablePlanEstudios').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": " "+base_url+"/Assets/plugins/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/PlanEstudios/getPlanEstudios",
            "dataSrc":""
        },
        "columns":[
            {"data":"numeracion"},
            {"data":"nombre_carrera"},
            {"data":"nombre_categoria_carrera"},
			      {"data":"nombre_plantel"},
			      {"data":"rvoe"},
			      {"data":"fecha_vigencia"},
			      {"data":"estatus"},
            {"data":"options"}

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
});
$('#tablePlanEstudios').DataTable();


function fnNavTab(numTab){
  tabActual = numTab;
  var x = document.getElementsByClassName("tab");
  for( var i = 0; i<x.length;i++){
    x[i].style.display = "none";
  }
  if (numTab == 0) {
    document.getElementById("btnSiguiente").style.display = "inline";
    document.getElementById("btnAnterior").style.display = "none";
  } else {
    document.getElementById("btnAnterior").style.display = "inline";
  }
  if (numTab == (x.length - 1)) {
    document.getElementById("btnSiguiente").style.display = "none";
    document.getElementById("btnActionFormNuevo").style.display = "inline";
  } else {
    document.getElementById("btnSiguiente").style.display = "inline";
    document.getElementById("btnActionFormNuevo").style.display = "none";
  }
  x[numTab].style.display = "block";
  estadoIndicadores(numTab);

}
function fnNavTabEdit(numTab){
  tabActualEdit = numTab;
    var x = document.getElementsByClassName("tabEdit");
    for( var i = 0; i<x.length;i++){
      x[i].style.display = "none";
    }
    if (numTab == 0) {
      document.getElementById("btnSiguienteEdit").style.display = "inline";
      document.getElementById("btnAnteriorEdit").style.display = "none";
    } else {
      document.getElementById("btnAnteriorEdit").style.display = "inline";
    }
    if (numTab == (x.length - 1)) {
      document.getElementById("btnSiguienteEdit").style.display = "none";
      document.getElementById("btnActionFormEdit").style.display = "inline";
    } else {
      document.getElementById("btnSiguienteEdit").style.display = "inline";
      document.getElementById("btnActionFormEdit").style.display = "none";
    }
    x[numTab].style.display = "block";
    estadoIndicadoresEdit(numTab);
  }

function mostrarTab(tabActual) {
  var tab = document.getElementsByClassName("tab");
  tab[tabActual].style.display = "block";
  if (tabActual == 0) {
    document.getElementById("btnSiguiente").style.display = "inline";
    document.getElementById("btnAnterior").style.display = "none";
  } else {
    document.getElementById("btnAnterior").style.display = "inline";
  }
  if (tabActual == (tab.length - 1)) {
    document.getElementById("btnSiguiente").style.display = "none";
    document.getElementById("btnActionFormNuevo").style.display = "inline";
  } else {
    document.getElementById("btnSiguiente").style.display = "inline";
    document.getElementById("btnActionFormNuevo").style.display = "none";
  }
  estadoIndicadores(tabActual)
}
function mostrarTabEdit(tabActualEdit) {
    var tab = document.getElementsByClassName("tabEdit");
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
  }


//Nuevo Plan Estudios
formPlanEstudiosNuevo.onsubmit = function(e) {
  let arr = JSON.stringify(arrClasificacion);
  e.preventDefault();
  document.querySelector("#idNuevo").value = 1;
  var strNuevo = document.querySelector('#idNuevo').value;
  var strNombre = document.querySelector('#txtNombreNuevo').value;
  var strNombreCorto = document.querySelector('#txtNombrecortoNuevo').value;
  var strPlantel = document.querySelector('#listPlantelNuevo').value;
  var strNivelEd = document.querySelector('#listNivelEdNuevo').value;
  var strCat = document.querySelector('#listCategoriaNuevo').value;
  var strDuracion = document.querySelector('#txtDuracionNuevo').value;
  var strMattotal = document.querySelector('#txtMatTotalesNuevo').value;
  var strTotalHrs = document.querySelector('#txtTotalHrsNuevo').value;
  var strCalMin = document.querySelector('#txtCalMinNuevo').value;
  var strModalidad = document.querySelector('#listModalidadNuevo').value;
  //var strEstatus = document.querySelector('#listEstatusNuevo').value;
  var strTotalCreditos = document.querySelector('#listTotalCreditosNuevo').value;
  var strPlan = document.querySelector('#listPlanNuevo').value;
  //var strEstatusa = document.querySelector('#listEstatusNuevo').value;
  //var strClaveProf = document.querySelector('#txtClaveProfNuevo').value;
  var strTipoRVOE = document.querySelector('#listTipoRvoeNuevo').value;
  var strRVOE = document.querySelector('#txtRvoeNuevo').value;
  var strVigencia = document.querySelector('#txtFechaVigenciaNuevo').value;
  var strFechaOtor = document.querySelector('#txtFechaOtorgamientoNuevo').value;
  var strFechaActualizacion = document.querySelector('#txtFechaActualizacionNuevo').value;
  var strPErfilIng = document.querySelector('#txtPerfilIngresoNuevo').value;
  var strPerfilEgr = document.querySelector('#txtPerfilEgresoNuevo').value;
  var strCampLab = document.querySelector('#txtCampoLaboralNuevo').value;
  if (strNombre == '' || strNombreCorto == '' || strPlantel == '' || strCampLab == '' || strNivelEd == '' || strCat == '' || strDuracion == '' || strMattotal == '' ||
  strTotalHrs == '' || strCalMin == '' || strModalidad == '' || strTotalCreditos == '' || strPlan == '' ||
  strTipoRVOE == '' || strRVOE == '' || strVigencia == '' || strFechaOtor == '' || strFechaActualizacion == '' || strPErfilIng == '' || strPerfilEgr == '')
  {
    swal.fire("Atención", "Atención todos los campos son obligatorios", "warning");
    return false;
  }
  let isCredito = false;
  arrClasificacion.forEach(element => {
    if(element.creditos == 0){
      isCredito = true;
    }
  });
  if(isCredito){
    swal.fire("Atención", "Uno de las clasificaciones tiene valor cero", "warning");
    return false;
  }
  var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
  var ajaxUrl = base_url+'/PlanEstudios/setPlanEstudios/'+arr;
  var formData = new FormData(formPlanEstudiosNuevo);
  request.open("POST",ajaxUrl,true);
  request.send(formData);
  request.onreadystatechange = function() {
    if(request.readyState == 4 && request.status == 200) {
      var objData = JSON.parse(request.responseText);
      if(objData.estatus)
      {
        $('#ModalFormNuevoPlanEstudios').modal("hide");
        formPlanEstudiosNuevo.reset();	
        swal.fire("Plan de estudios", objData.msg, "success").then((result) =>{
          $('.close').click();
        });
        tablePlanEstudios.api().ajax.reload()
        arrClasificacion = [];          
      }else{
        swal.fire("Error", objData.msg, "error");
      }
    }
    return false;
  }
}

//Funcion para Ver Plan Estudios
function fntVerPlanEstudios(idPlanEstudio){
    var idPlanEstudio = idPlanEstudio;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl  = base_url+'/PlanEstudios/getPlanEstudio/'+idPlanEstudio;
    request.open("GET",ajaxUrl ,true);
	request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var objData = JSON.parse(request.responseText);
            if(objData)
            {   
                document.querySelector('#txtNombreVer').value = objData.plan_estudio.nombre_carrera;
                document.querySelector('#txtNombrecortoVer').value = objData.plan_estudio.nombre_carrera_corto;
                document.querySelector('#listPlantelVer').innerHTML = '<option>'+objData.plan_estudio.nombre_plantel+' ('+objData.plan_estudio.municipio+')'+'</option>';
                document.querySelector('#listNivelEdVer').innerHTML = '<option selected>'+objData.plan_estudio.nombre_nivel_educativo+'</option>';
                document.querySelector('#listCategoriaVer').innerHTML = '<option selected>'+objData.plan_estudio.nombre_categoria_carrera+'</option>';
                document.querySelector('#txtDuracionVer').value = objData.plan_estudio.duracion_carrera;
                document.querySelector('#txtMatTotalesVer').value = objData.plan_estudio.materias_totales;
                document.querySelector('#txtTotalHrsVer').value = objData.plan_estudio.total_horas;
                document.querySelector('#txtCalMinVer').value = objData.plan_estudio.calificacion_minima;
                document.querySelector('#listModalidadVer').innerHTML = '<option selected>'+objData.plan_estudio.nombre_modalidad+'</option>';
                document.querySelector('#listEstatusVer').value = objData.plan_estudio.nombre_carrera;
                document.querySelector('#listTotalCreditosVer').value = objData.plan_estudio.total_creditos;
                document.querySelector('#listPlanVer').innerHTML = '<option selected>'+objData.plan_estudio.nombre_plan+'</option>';
                if(objData.plan_estudio.estatus == 1){
                    document.querySelector('#listEstatusVer').innerHTML = '<option selected>Activo</option>';
                }else{
                    document.querySelector('#listEstatusVer').innerHTML = '<option selected>Inactivo</option>';
                }
                document.querySelector('#txtClaveProfVer').value = objData.plan_estudio.clave_profesiones;
                document.querySelector('#listTipoRvoeVer').innerHTML = '<option selected>'+objData.plan_estudio.tipo_rvoe+'</option>';
                document.querySelector('#txtRvoeVer').value = objData.plan_estudio.rvoe;
                document.querySelector('#txtFechaVigenciaVer').value = objData.plan_estudio.fecha_vigencia;
                document.querySelector('#txtFechaOtorgamientoVer').value = objData.plan_estudio.fecha_otorgamiento;
                document.querySelector('#txtFechaActualizacionVer').value = objData.plan_estudio.fecha_actualizacion_rvoe;
                document.querySelector('#listTunoRvoeVer').querySelector('option[value="'+objData.plan_estudio.turno+'"]').selected = true;
                let x = "";
                objData.clasificaciones.forEach(element => {
                  x += '<span class="badge badge-secondary mr-2">'+element.nombre_clasificacion_materia+'</span>';
                });
                document.querySelector('#clasificacionesVer').innerHTML = x;
                document.querySelector('#txtPerfilIngresoVer').value = objData.plan_estudio.perfil_ingreso;
                document.querySelector('#txtPerfilEgresoVer').value = objData.plan_estudio.perfil_egreso;
                document.querySelector('#txtCampoLaboralVer').value = objData.plan_estudio.campo_laboral;

            }else{
                swal.fire("Error", objData.msg , "error");
            }
        }
    }
}

//Funcion para Ver Plan Estudios
function fntEditPlanEstudios(idPlanEstudio){
    $('#step1-tabEdit').click();
   tabActualEdit = 0;
    var idPlanEstudio = idPlanEstudio;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl  = base_url+'/PlanEstudios/getPlanEstudioEdit/'+idPlanEstudio;
    request.open("GET",ajaxUrl ,true);
	request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var objData = JSON.parse(request.responseText);
            if(objData)
            {   
                document.querySelector("#idEdit").value = objData.plan_estudio.id;
                document.querySelector('#txtNombreEdit').value = objData.plan_estudio.nombre_carrera;
                document.querySelector('#txtNombrecortoEdit').value = objData.plan_estudio.nombre_carrera_corto;
                document.querySelector('#listPlantelEdit').querySelector('option[value="'+objData.plan_estudio.id_plantel+'"]').selected = true;
                document.querySelector('#listNivelEdEdit').querySelector('option[value="'+objData.plan_estudio.id_nivel_educativo+'"]').selected = true;
                document.querySelector('#listCategoriaEdit').querySelector('option[value="'+objData.plan_estudio.id_categoria_carrera+'"]').selected = true;
                document.querySelector('#txtDuracionEdit').value = objData.plan_estudio.duracion_carrera;
                document.querySelector('#txtMatTotalesEdit').value = objData.plan_estudio.materias_totales;
                document.querySelector('#txtTotalHrsEdit').value = objData.plan_estudio.total_horas;
                document.querySelector('#txtCalMinEdit').value = objData.plan_estudio.calificacion_minima;
                document.querySelector('#listModalidadEdit').querySelector('option[value="'+objData.plan_estudio.id_modalidad+'"]').selected = true;
                document.querySelector('#listEstatusEdit').value = objData.plan_estudio.nombre_carrera;
                document.querySelector('#listTotalCreditosEdit').value = objData.plan_estudio.total_creditos;
                document.querySelector('#listPlanEdit').querySelector('option[value="'+objData.plan_estudio.id_plan+'"]').selected = true;
                document.querySelector('#listEstatusEdit').querySelector('option[value="'+objData.plan_estudio.estatus+'"]').selected = true;
                document.querySelector('#txtClaveProfEdit').value = objData.plan_estudio.clave_profesiones;
                document.querySelector('#listTipoRvoeEdit').querySelector('option[value="'+objData.plan_estudio.tipo_rvoe+'"]').selected = true;
                document.querySelector('#txtRvoeEdit').value = objData.plan_estudio.rvoe;
                document.querySelector('#txtFechaVigenciaEdit').value = objData.plan_estudio.fecha_vigencia;
                document.querySelector('#txtFechaOtorgamientoEdit').value = objData.plan_estudio.fecha_otorgamiento;
                document.querySelector('#txtFechaActualizacionEdit').value = objData.plan_estudio.fecha_actualizacion_rvoe;
                document.querySelector('#listTunoRvoeEdit').querySelector('option[value="'+objData.plan_estudio.turno+'"]').selected = true;
                let classf = document.querySelector('#clasificacionesEdit').innerHTML = "";
                arrClasificacion = [];
                objData.clasificaciones.forEach(element => {
                  arrClasf = {id:element.id,id_clasificacion:element.id_clasificacion_materias,creditos:element.total_creditos,nombre_clasificacion:element.nombre_clasificacion_materia,estatus:element.estatus};
                  let classf = document.querySelector('#clasificacionesEdit');
                  let nuevoclassf = document.createElement('div');
                  nuevoclassf.setAttribute('class','row');
                  nuevoclassf.innerHTML = "<div class='alert alert-light col-md-12 row' role='alert'><div class='col-md-5 row'><div class='alert-icon'><i class='fas fa-fw fa-bookmark'></i></div><div class='alert-message'> "+element.nombre_clasificacion_materia+"</div></div><div class='col-md-2'><div class='alert-message'><input type='number' id='numCredEdit"+element.id_clasificacion_materias+"' class='form-control form-control-sm' placeholder='creditos' value='"+element.total_creditos+"' min='0' onkeyup='fnCambiarCreditosEdit("+element.id_clasificacion_materias+")' ></div></div><div class='col-md-5 d-flex flex-row-reverse'><a class='btn' onclick='elminarClasificacionEdit("+element.id_clasificacion_materias+")'><i class='fas fa-trash text-danger'></i></a></div></div>";
                  classf.appendChild(nuevoclassf);
                  arrClasificacion.push(arrClasf); 
                });
                document.querySelector('#txtPerfilIngresoEdit').value = objData.plan_estudio.perfil_ingreso;
                document.querySelector('#txtPerfilEgresoEdit').value = objData.plan_estudio.perfil_egreso;
                document.querySelector('#txtCampoLaboralEdit').value = objData.plan_estudio.campo_laboral;
                
            }else{
                swal.fire("Error", objData.msg , "error");
            }
        }
    }
}
var formEditPlanEstudios = document.querySelector("#formPlanEstudiosEdit");
formEditPlanEstudios.onsubmit = function(e){
        let arr = JSON.stringify(arrClasificacion);
        e.preventDefault();
        var strNombre = document.querySelector('#txtNombreEdit').value;
        var strNombreCorto = document.querySelector('#txtNombrecortoEdit').value;
        var strPlantel = document.querySelector('#listPlantelEdit').value;
        var strNivelEd = document.querySelector('#listNivelEdEdit').value;
        var strCat = document.querySelector('#listCategoriaEdit').value;
        var strDuracion = document.querySelector('#txtDuracionEdit').value;
        var strMattotal = document.querySelector('#txtMatTotalesEdit').value;
        var strTotalHrs = document.querySelector('#txtTotalHrsEdit').value;
        var strCalMin = document.querySelector('#txtCalMinEdit').value;
        var strModalidad = document.querySelector('#listModalidadEdit').value;
        var strEstatus = document.querySelector('#listEstatusEdit').value;
        var strTotalCreditos = document.querySelector('#listTotalCreditosEdit').value;
        var strPlan = document.querySelector('#listPlanEdit').value;
        //var strClaveProf = document.querySelector('#txtClaveProfEdit').value;
        var strTipoRVOE = document.querySelector('#listTipoRvoeEdit').value;
        var strRVOE = document.querySelector('#txtRvoeEdit').value;
        var strVigencia = document.querySelector('#txtFechaVigenciaEdit').value;
        var strFechaOtor = document.querySelector('#txtFechaOtorgamientoEdit').value;
        var strFechaEstTermino = document.querySelector('#txtFechaActualizacionEdit').value;
        var turnoRVOE = document.querySelector('#listTunoRvoeEdit').value;
        var strPErfilIng = document.querySelector('#txtPerfilIngresoEdit').value;
        var strPerfilEgr = document.querySelector('#txtPerfilEgresoEdit').value;
        var strCampLab = document.querySelector('#txtCampoLaboralEdit').value;
        
        if (strNombre == '' || strNombreCorto == '' || strPlantel == '' || strCampLab == '' || strNivelEd == '' || strCat == '' || strDuracion == '' || strMattotal == '' ||
            strTotalHrs == '' || strCalMin == '' || strModalidad == '' || strEstatus == '' || strTotalCreditos == '' || strPlan == '' ||
            strTipoRVOE == '' || strRVOE == '' || strVigencia == '' || strFechaOtor == '' || strFechaEstTermino == '' || turnoRVOE == '' || strPErfilIng == '' || strPerfilEgr == ''){
                swal.fire("Atención", "Atención todos los campos son obligatorios", "warning");
                return false;
        }
        let isCredito = false;
        arrClasificacion.forEach(element => {
          if(element.creditos == 0){
            isCredito = true;
          }
        });
        if(isCredito){
          swal.fire("Atención", "Uno de las clasificaciones tiene valor cero", "warning");
          return false;
        }
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url+'/PlanEstudios/setPlanEstudios/'+arr;
        var formData = new FormData(formEditPlanEstudios);
        request.open("POST",ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function() {
                if(request.readyState == 4 && request.status == 200) {
                    var objData = JSON.parse(request.responseText);
                      if(objData.estatus){
                        $('#ModalFormEditPlanEstudios').modal("hide");
                        formEditPlanEstudios.reset();
                        swal.fire("Plan de estudios", objData.msg, "success").then((result) =>{
                            $('.close').click();
                        });
                        tablePlanEstudios.api().ajax.reload();  
                    }else{
                        swal.fire("Error", "error", "error");
                    }
                }
                return false;
            }
    }


//Funcion para Eliminar Plan de Estudios
function fntDelPlanEstudios(id) {
    swal.fire({
        icon: "question",
        title: "Eliminar plan de estudios?",
        text: "¿Realmente quiere eliminar el plan de estudios?",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33', 
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!"
    }). then((result) => {
        if (result.isConfirmed) 
        {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url+'/PlanEstudios/delPlanEstudio'; 
            var strData = "idPlanEstudio="+id;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    var objData = JSON.parse(request.responseText);
                   if(objData.estatus)
                    {
                        swal.fire("Eliminado!", objData.msg , "success");
                        tablePlanEstudios.api().ajax.reload();

                    } else {
                        swal.fire("Atención!", objData.msg , "error");
                    }
                }
            }
        }
    });
}
function fnAgregarClasificacion(){
  let arrClasf;
  let clasificacion = document.querySelector('#listAgClasificacionNuevo');
  let idClasificacion = clasificacion.value;
  let strClasificacion = clasificacion.options[clasificacion.selectedIndex].text;
  if(idClasificacion == ""){
    swal.fire("Atención","Seleccione una clasificacion para agregar","warning").then((result) =>{
    });
  }else{
    arrClasf = {id:0,id_clasificacion:idClasificacion,creditos:0,nombre_clasificacion:strClasificacion,estatus:1};
    let v = false;
    arrClasificacion.forEach(element => {
      if(element.id_clasificacion == idClasificacion) {
        v = true;
      }
    });
    if(v == false){
      arrClasificacion.push(arrClasf);
    }else{
      swal.fire("Atención","Ya agregaste esa clasificación","warning").then((result) =>{
      });
    }
    mostrarClasificaciones();
  }
}
function fnAgregarClasificacionEdit(){
  let arrClasf;
  let clasificacion = document.querySelector('#listAgClasificacionEdit');
  let idClasificacion = clasificacion.value;
  let strClasificacion = clasificacion.options[clasificacion.selectedIndex].text;
  if(idClasificacion == ""){
    swal.fire("Atención","Seleccione una clasificacion para agregar","warning").then((result) =>{
    });
  }else{
    arrClasf = {id:0,id_clasificacion:idClasificacion,creditos:0,nombre_clasificacion:strClasificacion,estatus:1};
    let v = false;
    arrClasificacion.forEach(element => {
      if(element.id_clasificacion == idClasificacion) {
        v = true;
      }
    });
    if(v == false){
      arrClasificacion.push(arrClasf);
    }else{
      swal.fire("Atención","Ya agregaste esa clasificación","warning").then((result) =>{
      });
    }
    mostrarClasificacionesEdit();
  } 
}
function elminarClasificacion(value){
  document.querySelector('#clasificaciones').innerHTML = "";
  let nuevoArr = [];
  arrClasificacion.forEach(clasificacion => {
    let arrClasf;
    if(clasificacion.id_clasificacion != value){
      arrClasf = {id:0,id_clasificacion:clasificacion.id_clasificacion,creditos:clasificacion.creditos,nombre_clasificacion:clasificacion.nombre_clasificacion,estatus:1};
      nuevoArr.push(arrClasf);
    }
  });
  arrClasificacion = nuevoArr;
  mostrarClasificaciones();
}
function elminarClasificacionEdit(value){
  document.querySelector('#clasificacionesEdit').innerHTML = "";
  let nuevoArr = [];
  Swal.fire({
    title: 'Eliminar?',
    text: "seguro desea eliminar la clasificacion?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si!',
    cancelButtonText:'No'
  }).then((result) => {
    if (result.isConfirmed) {
      arrClasificacion.forEach(clasificacion => {
        let arrClasf;
        if(clasificacion.id_clasificacion != value){
          if(clasificacion.id!= 0){
            arrClasf = {id:clasificacion.id,id_clasificacion:clasificacion.id_clasificacion,creditos:clasificacion.creditos,nombre_clasificacion:clasificacion.nombre_clasificacion,estatus:clasificacion.estatus};
            nuevoArr.push(arrClasf);
          }else{
            arrClasf = {id:0,id_clasificacion:clasificacion.id_clasificacion,creditos:clasificacion.creditos,nombre_clasificacion:clasificacion.nombre_clasificacion,estatus:clasificacion.estatus};
            nuevoArr.push(arrClasf);
          }
        }else{
          if(clasificacion.id != 0){
            arrClasf = {id:clasificacion.id,id_clasificacion:clasificacion.id_clasificacion,creditos:clasificacion.creditos,nombre_clasificacion:clasificacion.nombre_clasificacion,estatus:0};
            nuevoArr.push(arrClasf);
          }
        }
      });  
    arrClasificacion = nuevoArr;
    mostrarClasificacionesEdit();
}
  })
}
function mostrarClasificaciones(){
  document.querySelector('#clasificaciones').innerHTML = "";
  arrClasificacion.forEach(element => {
    let classf = document.querySelector('#clasificaciones');
    let nuevoclassf = document.createElement('div');
    nuevoclassf.setAttribute('class','row');
    nuevoclassf.innerHTML = "<div class='alert alert-light col-md-12 row' role='alert'><div class='col-md-5 row'><div class='alert-icon'><i class='fas fa-fw fa-bookmark'></i></div><div class='alert-message'> "+element.nombre_clasificacion+"</div></div><div class='col-md-2'><div class='alert-message'><input type='number' id='numCred"+element.id_clasificacion+"' class='form-control form-control-sm' placeholder='creditos' value='"+element.creditos+"' min='0' onkeyup='fnCambiarCreditos("+element.id_clasificacion+")' ></div></div><div class='col-md-5 d-flex flex-row-reverse'><a class='btn' onclick='elminarClasificacion("+element.id_clasificacion+")'><i class='fas fa-trash text-danger'></i></a></div></div>";
    classf.appendChild(nuevoclassf);
  });
}
function mostrarClasificacionesEdit(){
    document.querySelector('#clasificacionesEdit').innerHTML = "";
    arrClasificacion.forEach(element => {
      if(element.estatus != 0){
        let classf = document.querySelector('#clasificacionesEdit');
        let nuevoclassf = document.createElement('div');
        nuevoclassf.setAttribute('class','row');
        nuevoclassf.innerHTML = "<div class='alert alert-light col-md-12 row' role='alert'><div class='col-md-5 row'><div class='alert-icon'><i class='fas fa-fw fa-bookmark'></i></div><div class='alert-message'> "+element.nombre_clasificacion+"</div></div><div class='col-md-2'><div class='alert-message'><input type='number' id='numCredEdit"+element.id_clasificacion+"' class='form-control form-control-sm' placeholder='creditos' value='"+element.creditos+"' min='0' onkeyup='fnCambiarCreditosEdit("+element.id_clasificacion+")' ></div></div><div class='col-md-5 d-flex flex-row-reverse'><a class='btn' onclick='elminarClasificacionEdit("+element.id_clasificacion+")'><i class='fas fa-trash text-danger'></i></a></div></div>";
        classf.appendChild(nuevoclassf);
      }
  });
}

function fnCambiarCreditos(value){
  let x = "numCred"+value;
  let v = document.getElementById(x).value;
  arrClasificacion.forEach(element => {
    if(element.id_clasificacion == value){
      element.creditos = v;
    }
  });
}
function fnCambiarCreditosEdit(value){
  let x = "numCredEdit"+value;
  let v = document.getElementById(x).value;
  arrClasificacion.forEach(element => {
    if(element.id_clasificacion == value){
      element.creditos = v;
    }
  });
}

//Funcion para Aceptar solo Numeros en un Input
function validarNumeroInput(event){
  if(event.charCode >= 48 && event.charCode <= 57){
      return true;
  }
  return false;
}


function btnPlanEstudioNuevo(){
  arrClasificacion = [];
  document.querySelector('#clasificaciones').innerHTML = "";
  $('#step1-tab').click();
  tabActual = 0;
}