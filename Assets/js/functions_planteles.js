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


//Mostrar Lista de Planteles de Datatable
document.addEventListener('DOMContentLoaded', function(){
	tablePlantel = $('#tablePlantel').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": " "+base_url+"/Assets/plugins/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Plantel/getPlanteles",
            "dataSrc":""
        },
        "columns":[
            {"data":"numeracion"},
            {"data":"nombre_plantel"},
			{"data":"estado"},
            {"data":"municipio"},
            {"data":"localidad"},
            {"data":"regimen"},
            {"data":"servicio"},
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

    //Funcion para Guardar Nuevo Plantel
    var formPlantel = document.querySelector("#formNuevoPlantel");
    formPlantel.onsubmit = function(e){
        e.preventDefault();
        document.querySelector("#idPlantelNuevo").value = 1;
        var strNombrePlantel = document.querySelector('#txtNombrePlantelNuevo').value;
        var strAbreviacionPlantel = document.querySelector('#txtAbreviacionPlantelNuevo').value;
        var strNombreSistema = document.querySelector('#txtNombreSistemaNuevo').value;
        var strAbreviacionSistema = document.querySelector('#txtAbreviacionSistemaNuevo').value;
        var strRegimen = document.querySelector('#txtRegimenNuevo').value;
        var strServicio = document.querySelector('#txtServicioNuevo').value;
        var strCategoria = document.querySelector('#txtCategoriaNuevo').value;
        //var intAcuerdoIncorporacion = document.querySelector('#txtAcuerdoIncorporacionNuevo').value;
        var intClaveCentroTrabajo = document.querySelector('#txtClaveCentroTrabajoNuevo').value;
        var intEstado = document.querySelector('#listEstadoNuevo').value;
        var intMunicipio = document.querySelector('#listMunicipioNuevo').value;
        var intLocalidad = document.querySelector('#listLocalidadNuevo').value;
        var strDomicilio = document.querySelector('#txtDomicilioNuevo').value;
        var strColonia = document.querySelector('#txtColoniaNuevo').value;
        var intCodigoPostal = document.querySelector('#txtCodigoPostalNuevo').value;

        if (strNombrePlantel == '' || strAbreviacionPlantel == '' || strNombreSistema == '' || strAbreviacionSistema == '' || strRegimen == '' || 
            strServicio == '' || strCategoria == ''  || intClaveCentroTrabajo == '' || intEstado == '' || intMunicipio == '' || 
            intLocalidad == '' || strDomicilio == '' || strColonia == '' || intCodigoPostal == ''){
                swal.fire("Atención", "Atención todos los campos son obligatorios", "warning");
                return false;
        }
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url+'/Plantel/setPlantel';
        var formData = new FormData(formPlantel);
        request.open("POST",ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function() {
                if(request.readyState == 4 && request.status == 200) {
                    var objData = JSON.parse(request.responseText);
                    if(objData.estatus){
                        $('#ModalFormPlantelNuevo').modal("hide");
                        formPlantel.reset();
                        swal.fire("Planteles", objData.msg, "success").then((result) =>{
                            $('.close').click();
                        });
                        tablePlantel.api().ajax.reload();  
                    }else{
                        swal.fire("Error", objData.msg, "error");
                    }
                }
                return false;
            }
    }
});
$('#tablePlantel').DataTable();



function fnNavTab(numTab){
    tabActual = numTab;
    var x = document.getElementsByClassName("tab");
    for( var i = 0; i<x.length;i++){
      x[i].style.display = "none";
    }
    x[numTab].style.display = "block";
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
    estadoIndicadores(numTab);
  
  }
  function fnNavTabEdit(numTab){
    tabActualEdit = numTab;
    var x = document.getElementsByClassName("tabEdit");
    for( var i = 0; i<x.length;i++){
      x[i].style.display = "none";
    }
    x[numTab].style.display = "block";
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
    //console.log(tabActual);
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
   // console.log(tabActualEdit);

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


//Funcion para obtener el ID del Estado en el Select y obtener lista de Municipios
function estadoSeleccionado(value){
    const $selMunicipio = document.querySelector('#listMunicipioNuevo');
    let url = base_url+"/Plantel/getMunicipios?idestado="+value;
        fetch(url)
            .then(res => res.json())
            .then((resultado) => {
				$selMunicipio.innerHTML = "";
                for (let i = 0; i < resultado.length; i++) {
                    opcion = document.createElement('option');
                    opcion.text = resultado[i]['nombre'];
                    opcion.value = resultado[i]['id'];
                    $selMunicipio.appendChild(opcion);
                }
            })
            .catch(err => { throw err });
}
//Funcion para obtener el ID del Estado en el Select y obtener lista de Municipios
function estadoSeleccionadoEdit(value){
    const $selMunicipio = document.querySelector('#listMunicipioEdit');
    let url = base_url+"/Plantel/getMunicipios?idestado="+value;
        fetch(url)
            .then(res => res.json())
            .then((resultado) => {
				$selMunicipio.innerHTML = "";
                for (let i = 0; i < resultado.length; i++) {
                    opcion = document.createElement('option');
                    opcion.text = resultado[i]['nombre'];
                    opcion.value = resultado[i]['id'];
                    $selMunicipio.appendChild(opcion);
                }
            })
            .catch(err => { throw err });
}
//Funcion para obtener el ID del Municipio en el Select y obtener lista de Localidades
function municipioSeleccionado(value){
    const $selLocalidades = document.querySelector('#listLocalidadNuevo');
    let url = base_url+"/Plantel/getLocalidades?idmunicipio="+value;
        fetch(url)
            .then(res => res.json())
            .then((resultado) => {
				$selLocalidades.innerHTML = "";
                for (let i = 0; i < resultado.length; i++) {
                    opcion = document.createElement('option');
                    opcion.text = resultado[i]['nombre'];
                    opcion.value = resultado[i]['id'];
                    $selLocalidades.appendChild(opcion);
                }
            })
            .catch(err => { throw err });
            
}
//Funcion para obtener el ID del Municipio en el Select y obtener lista de Localidades
function municipioSeleccionadoEdit(value){
    const $selLocalidades = document.querySelector('#listLocalidadEdit');
    let url = base_url+"/Plantel/getLocalidades?idmunicipio="+value;
        fetch(url)
            .then(res => res.json())
            .then((resultado) => {
				$selLocalidades.innerHTML = "";
                for (let i = 0; i < resultado.length; i++) {
                    opcion = document.createElement('option');
                    opcion.text = resultado[i]['nombre'];
                    opcion.value = resultado[i]['id'];
                    $selLocalidades.appendChild(opcion);
                }
            })
            .catch(err => { throw err });
            
}

//Funcion para el boton de Buscar Imagen del Plantel
function buscarImagenPlantel(e){
    document.querySelector('#profileImagePlantel').click();
}
//Funcion para el boton de Buscar Imagen del Plantel Edit
function buscarImagenPlantelEdit(e){
    document.querySelector('#profileImagePlantelEdit').click();
}
//Funcion para mostrar Imagen buscado del Plantel
function displayImagePlantel(e) {
    if (e.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e){
            document.querySelector('#profileDisplayPlantel').setAttribute('src', e.target.result);
            document.getElementById('btnBuscarImagenPlantel').textContent = "Cambiar";
            document.querySelector('#btnBuscarImagenPlantel').classList.replace("btn-primary", "btn-warning");
        }
        reader.readAsDataURL(e.files[0]);
    }
}
//Funcion para mostrar Imagen buscado del Plantel Edit
function displayImagePlantelEdit(e) {
    if (e.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e){
            document.querySelector('#profileDisplayPlantelEdit').setAttribute('src', e.target.result);
        }
        reader.readAsDataURL(e.files[0]);
    }
}
//Funcion para el boton de Buscar Imagen del Sistema
function buscarImagenSistema(f){
    document.querySelector('#profileImageSistema').click();
}
//Funcion para el boton de Buscar Imagen del Sistema Edit
function buscarImagenSistemaEdit(f){
    document.querySelector('#profileImageSistemaEdit').click();
}
//Funcion para mostrar Imagen buscado del Sistema
function displayImageSistema(f) {
    if (f.files[0]) {
        var reader = new FileReader();
        reader.onload = function(f){
            document.querySelector('#profileDisplaySistema').setAttribute('src', f.target.result);
            document.getElementById('btnBuscarImagenSistema').textContent = "Cambiar";
            document.querySelector('#btnBuscarImagenSistema').classList.replace("btn-primary", "btn-warning");
        }
        reader.readAsDataURL(f.files[0]);
    }
}
//Funcion para mostrar Imagen buscado del Sistema Edit
function displayImageSistemaEdit(f) {
    if (f.files[0]) {
        var reader = new FileReader();
        reader.onload = function(f){
            document.querySelector('#profileDisplaySistemaEdit').setAttribute('src', f.target.result);
        }
        reader.readAsDataURL(f.files[0]);
    }
}

//Funcion para Editar Plantel
function fntEditPlantel(idPlantel){
    var idplantel = idPlantel;
    $('#step1-tabEdit').click();
    tabActualEdit = 0;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl  = base_url+'/Plantel/getPlantel/'+idplantel;
    request.open("GET",ajaxUrl ,true);
	request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var objData = JSON.parse(request.responseText);
            if(objData)
            {   
                document.querySelector("#idPlantelEdit").value = objData.id
                document.querySelector('#txtNombrePlantelEdit').value = objData.nombre_plantel;
                document.querySelector('#txtAbreviacionPlantelEdit').value = objData.abreviacion_plantel;
                document.querySelector('#txtNombreSistemaEdit').value = objData.nombre_sistema;
                document.querySelector('#txtAbreviacionSistemaEdit').value = objData.abreviacion_sistema;
                document.querySelector('#txtRegimenEdit').value = objData.regimen;
                document.querySelector('#txtServicioEdit').value = objData.servicio;
                document.querySelector('#txtCategoriaEdit').value = objData.categoria;
                //document.querySelector('#txtAcuerdoIncorporacionEdit').value = objData.acuerdo_incorporacion;
                document.querySelector('#txtClaveCentroTrabajoEdit').value = objData.cve_centro_trabajo;
                document.querySelector('#txtCedulaFuncionamientoEdit').value = objData.cedula_funcionamiento;
                document.querySelector('#txtClaveInstitucionDGPEdit').value = objData.cve_institucion_dgp;
                //document.querySelector('#txtClaveDGPEdit').value = objData.cve_dgp;
                //document.querySelector('#listEstadoEdit').innerHTML = "<option value='100' selected>"+objData.estado+"</option>"
                //Obtener lista de Estados
                var idEstadoPlantel = "";
                var idMunicipioPlantel = "";
                var idLocalidadPlantel = "";
                document.querySelector('#listMunicipioEdit').innerHTML = "";
                document.querySelector('#listLocalidadEdit').innerHTML = "";
                let url = base_url+"/Plantel/getListEstados";
                fetch(url)
                    .then(res => res.json())
                    .then((resultado) => {
                    for (let i = 0; i < resultado.length; i++) {
                        document.querySelector('#listEstadoEdit').innerHTML += "<option value='"+resultado[i]['id']+"'>"+resultado[i]['nombre']+"</option>"
                        if(resultado[i]['nombre'] == objData.estado){
                            idEstadoPlantel = resultado[i]['id'];
                            select = document.querySelector('#listEstadoEdit');
                            var opt = document.createElement('option');
                            opt.value = resultado[i]['id'];
                            opt.innerHTML = resultado[i]['nombre'];
                            opt.setAttribute("selected","");
                            select.appendChild(opt);
                            let urlMunicipios = base_url+"/Plantel/getMunicipios?idestado="+idEstadoPlantel;
                            fetch(urlMunicipios)
                                .then(res => res.json())
                                .then((resultadoMunicipio) =>{
                                    resultadoMunicipio.forEach(element => {
                                        document.querySelector('#listMunicipioEdit').innerHTML += "<option value='"+element['id']+"'>"+element['nombre']+"</option>"
                                        if(element['nombre'] == objData.municipio){
                                            idMunicipioPlantel = element['id'];
                                            selectMunicipio = document.querySelector('#listMunicipioEdit');
                                            var optMunicipio = document.createElement('option');
                                            optMunicipio.value = element['id'];
                                            optMunicipio.innerHTML = element['nombre'];
                                            optMunicipio.setAttribute("selected","");
                                            selectMunicipio.appendChild(optMunicipio);
                                            let urlLocalidades = base_url+"/Plantel/getLocalidades?idmunicipio="+idMunicipioPlantel;
                                            fetch(urlLocalidades)
                                                .then(res => res.json())
                                                .then((resultadoLocalidad) =>{
                                                    resultadoLocalidad.forEach(element => {
                                                        document.querySelector('#listLocalidadEdit').innerHTML += "<option value='"+element['id']+"'>"+element['nombre']+"</option>"
                                                        if(element['nombre'] == objData.localidad){
                                                            idLocalidadPlantel = element['id'];
                                                            selectLocalidades = document.querySelector('#listLocalidadEdit');
                                                            var optLocalidad = document.createElement('option');
                                                            optLocalidad.value = element['id'];
                                                            optLocalidad.innerHTML = element['nombre'];
                                                            optLocalidad.setAttribute("selected","");
                                                            selectLocalidades.appendChild(optLocalidad);
                                                        }
                                                    });
                                                })
                                                .catch(err => {throw err});
                                        }

                                    });
                                })
                                .catch(err => {throw err});
                        }
                    }
                })
                .catch(err => { throw err });
                document.querySelector('#txtDomicilioEdit').value = objData.domicilio;
                document.querySelector('#txtColoniaEdit').value = objData.colonia;
                document.querySelector('#txtZonaEscolarEdit').value = objData.zona_escolar;
                document.querySelector('#txtCodigoPostalEdit').value = objData.cod_postal;
                document.querySelector('#txtLatitudEdit').value = objData.latitud;
                document.querySelector('#txtLongitudEdit').value = objData.longitud;
                document.querySelector("#profileDisplayPlantelEdit").src = base_url+"/Assets/images/logos/"+objData.logo_plantel;
                document.querySelector("#profileDisplaySistemaEdit").src = base_url+"/Assets/images/logos/"+objData.logo_sistema;
            }else{
                swal.fire("Error", objData.msg , "error");
            }
            
        }
    }
    
}

//Funcion para Eliminar Plantel
function fntDelPlantel(id) {
    swal.fire({
        icon: "question",
        title: "Eliminar plantel",
        text: "¿Realmente quiere eliminar el plantel?",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33', 
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!"
    }). then((result) => {
        if (result.isConfirmed) 
        {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url+'/Plantel/delPlantel'; 
            var strData = "idPlantel="+id;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    var objData = JSON.parse(request.responseText);
                    if(objData.estatus)
                    {
                        swal.fire("Eliminar!", objData.msg , "success");
                        tablePlantel.api().ajax.reload();

                    } else {
                        swal.fire("Atención!", objData.msg , "error");
                    }
                }
            }
        }
    });
}

//Funcion para Ver Plantel
//Funcion para Editar Plantel
function fntVerPlantel(idPlantel){
    var idplantel = idPlantel;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl  = base_url+'/Plantel/getPlantel/'+idplantel;
    request.open("GET",ajaxUrl ,true);
	request.send();
    request.onreadystatechange = function(){

        if(request.readyState == 4 && request.status == 200){
            var objData = JSON.parse(request.responseText);
            if(objData)
            {   
                document.querySelector('#titModal').innerHTML = objData.nombre_plantel;
                document.querySelector('#txtNombrePlantelVer').value = objData.nombre_plantel;
                document.querySelector('#txtAbreviacionPlantelVer').value = objData.abreviacion_plantel;
                document.querySelector('#txtNombreSistemaVer').value = objData.nombre_sistema;
                document.querySelector('#txtAbreviacionsistemaVer').value = objData.abreviacion_sistema;
                document.querySelector('#txtRegimenVer').value = objData.regimen;
                document.querySelector('#txtServicioVer').value = objData.servicio;
                document.querySelector('#txtCategoriaVer').value = objData.categoria;
                //document.querySelector('#txtAcuerdoIncorporacionVer').value = objData.acuerdo_incorporacion;
                document.querySelector('#txtClaveCentroTrabajoVer').value = objData.cve_centro_trabajo;
                document.querySelector('#txtCedulaFuncionamientoVer').value = objData.cedula_funcionamiento;
                document.querySelector('#txtClaveInstitucionDGPVer').value = objData.cve_institucion_dgp;
                //document.querySelector('#txtClaveDGPVer').value = objData.cve_dgp;
                document.querySelector('#txtEstadoVer').innerHTML = "<option selected>"+objData.estado+"</option>"
                document.querySelector('#txtMunicipioVer').innerHTML = "<option selected>"+objData.municipio+"</option>"
                document.querySelector('#txtLocalidadVer').innerHTML = "<option selected>"+objData.localidad+"</option>";
                document.querySelector('#txtDomicilioVer').value = objData.domicilio;
                document.querySelector('#txtColoniaVer').value = objData.colonia;
                document.querySelector('#txtZonaEscolarVer').value = objData.zona_escolar;
                document.querySelector('#txtCodigoPostalVer').value = objData.cod_postal;
                document.querySelector('#txtLatitudVer').value = objData.latitud;
                document.querySelector('#txtLongitudVer').value = objData.longitud;
                document.querySelector("#profilePlantelVer").src = base_url+"/Assets/images/logos/"+objData.logo_plantel;
                document.querySelector("#profileSistemaVer").src = base_url+"/Assets/images/logos/"+objData.logo_sistema;

            }else{
                swal.fire("Error", objData.msg , "error");
            }
            
        }
    }
}
//Funcion para guardar datos del Plantel Editado
var formEditPlantel = document.querySelector("#formEditPlantel");
    formEditPlantel.onsubmit = function(e){
        e.preventDefault();
        var strNombrePlantel = document.querySelector('#txtNombrePlantelEdit').value;
        var strAbreviacionPlantel = document.querySelector('#txtAbreviacionPlantelEdit').value;
        var strNombreSistema = document.querySelector('#txtNombreSistemaEdit').value;
        var strAbreviacionSistema = document.querySelector('#txtAbreviacionSistemaEdit').value;
        var strRegimen = document.querySelector('#txtRegimenEdit').value;
        var strServicio = document.querySelector('#txtServicioEdit').value;
        var strCategoria = document.querySelector('#txtCategoriaEdit').value;
        //var intAcuerdoIncorporacion = document.querySelector('#txtAcuerdoIncorporacionEdit').value;
        var intClaveCentroTrabajo = document.querySelector('#txtClaveCentroTrabajoEdit').value;
        var intEstado = document.querySelector('#listEstadoEdit').value;
        var intMunicipio = document.querySelector('#listMunicipioEdit').value;
        var intLocalidad = document.querySelector('#listLocalidadEdit').value;
        var strDomicilio = document.querySelector('#txtDomicilioEdit').value;
        var strColonia = document.querySelector('#txtColoniaEdit').value;
        var intCodigoPostal = document.querySelector('#txtCodigoPostalEdit').value;
        
        if (strNombrePlantel == '' || strAbreviacionPlantel == '' || strNombreSistema == '' || strAbreviacionSistema == '' || strRegimen == '' || strServicio == '' || strCategoria == '' || intClaveCentroTrabajo == '' || intEstado == '' || intMunicipio == '' || intLocalidad == '' || strDomicilio == '' || strColonia == '' || intCodigoPostal == ''){
            swal.fire("Atención", "Atención todos los campos son obligatorios", "warning");
            return false;
        }
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url+'/Plantel/setPlantel';
        var formData = new FormData(formEditPlantel);
        request.open("POST",ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function() {
                if(request.readyState == 4 && request.status == 200) {
                    var objData = JSON.parse(request.responseText);
                     if(objData.estatus){
                        $('#ModalFormPlantelEdit').modal("hide");
                        formEditPlantel.reset();
                        swal.fire("Planteles", objData.msg, "success").then((result) =>{
                            $('.close').click();
                        });
                        tablePlantel.api().ajax.reload();  
                    }else{
                        swal.fire("Error",objData.msg, "error");
                    }
                }
                return false;
            }
    }

//Funcion para Aceptar solo Numeros en un Input
function validarNumeroInput(event){
    if(event.charCode >= 48 && event.charCode <= 57){
        return true;
    }
    return false;
}
function btnNuevoPlantel(){
    $('#step1-tab').click();
    tabActual = 0;
}