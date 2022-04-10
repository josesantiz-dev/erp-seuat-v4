var tableMaterias;
var formMateriaNueva = document.querySelector("#formMateriaNueva");
var formMateriadit = document.querySelector("#formMateriaEdit");
//Datatable
document.addEventListener('DOMContentLoaded', function(){
	tableMaterias = $('#tableMaterias').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": " "+base_url+"/Assets/plugins/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Materias/getMaterias",
            "dataSrc":""
        },
        "columns":[
            {"data":"numeracion"},
            {"data":"nombre_materia"},
            {"data":"nombre_carrera"},
            {"data":"numero_romano"},
            {"data":"tipo"},
            {"data":"nombre_clasificacion_materia"},
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
$('#tableMaterias').DataTable();

//Nueva Materia
formMateriaNueva.onsubmit = function(e){
    e.preventDefault();
    document.querySelector("#idNuevo").value = 1;
    var strNombre = document.querySelector('#txtNombreNuevo').value;
    var strClave = document.querySelector('#txtClaveNuevo').value;
    var intHoraTeoria = document.querySelector('#txtHorasTeoriaNuevo').value;
    var intHoraPractica = document.querySelector('#txtHorasPracticaNuevo').value;
    var intCreditos = document.querySelector('#txtCreditosNuevo').value;
    var strTipo = document.querySelector('#listTipoNuevo').value;
    var strPlantel = document.querySelector('#listPlantelNuevo').value;
    var intGrado = document.querySelector('#listGradoNuevo').value;
    var intPlanEstudio = document.querySelector('#listPlanEstudioNuevo').value;
    var strClasificacion = document.querySelector('#listClasificacionNuevo').value;
    //var intStatus = document.querySelector('#listEstatusNuevo').value;

    if(strNombre == '' || strClave == '' || intHoraTeoria == '' || intHoraPractica == '' || intCreditos == '' || strTipo == '' || strPlantel == '' || intGrado == '' || intPlanEstudio == '' || strClasificacion == ''){
        swal.fire("Atención","Atención todos los campos son obligatorios","warning");
        return false;
    }
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+'/Materias/setMateria';
    var formData = new FormData(formMateriaNueva);
    request.open("POST",ajaxUrl,true);
    request.send(formData);
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var objData = JSON.parse(request.responseText);
            if(objData.estatus){
                formMateriaNueva.reset();
                swal.fire("Materia",objData.msg,"success").then((result) =>{
                    $('#dimissModalNuevo').click();
                });
                tableMaterias.api().ajax.reload();
                
            }else{
                swal.fire("Error",objData.msg,"error");
            }
        }
        return false;
    }
}

//Funcion para Ver Materia
function fntVerMateria(idMateria){
    var idMateria = idMateria;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl  = base_url+'/Materias/getMateria/'+idMateria;
    request.open("GET",ajaxUrl ,true);
	request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var objData = JSON.parse(request.responseText);
            if(objData){   

                document.querySelector('#titleModalVer').innerHTML = objData.nombre_materia;
                document.querySelector('#txtNombreVer').value = objData.nombre_materia;
                document.querySelector('#txtClaveVer').value = objData.clave;
                document.querySelector('#txtHorasTeoriaVer').value = objData.hrs_teoria;
                document.querySelector('#txtHorasPracticaVer').value = objData.hrs_practicas;
                document.querySelector('#txtCreditosVer').value = objData.creditos;
                document.querySelector('#listTipoVer').innerHTML = "<option selected>"+objData.tipo+"</option>";
                document.querySelector('#listPlantelVer').innerHTML = "<option selected>"+objData.nombre_plantel+" ("+objData.municipio+")"+"</option>";
                document.querySelector('#listGradoVer').innerHTML = "<option selcted>"+objData.nombre_grado+"("+objData.numero_romano+")"+"</option>";
                document.querySelector('#listPlanEstudioVer').innerHTML = "<option selected>"+objData.nombre_carrera+"</option>";

                document.querySelector('#listClasificacionVer').querySelector('option[value="'+objData.id_clasificacion_materia+'"]').selected = true;
                if(objData.estatus == 1){
                    document.querySelector('#listEstatusVer').innerHTML = "<option selected>Activo</option>";
                }else{
                    document.querySelector('#listEstatusVer').innerHTML = "<option selected>Inactivo</option>";
                }
            }else{
                swal.fire("Error", objData.msg , "error");
            }
            
        }
    }
}

//Editar Materias
function fntEditMateria(idMateria){
    var idMateria = idMateria;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl  = base_url+'/Materias/getMateria/'+idMateria;
    request.open("GET",ajaxUrl ,true);
	request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var objData = JSON.parse(request.responseText);
            if(objData){
                document.querySelector("#idEdit").value = objData.id;
                document.querySelector('#txtNombreEdit').value = objData.nombre_materia;
                document.querySelector('#txtClaveEdit').value = objData.clave;
                document.querySelector('#txtHorasTeoriaEdit').value = objData.hrs_teoria;
                document.querySelector('#txtHorasPracticaEdit').value = objData.hrs_practicas;
                document.querySelector('#txtCreditosEdit').value = objData.creditos;

                if(objData.tipo == 'Ordinaria')
                {
                    var optionSelect = '<option value="2" selected class="notBlock">Ordinaria</option>';
                }else{
                    var optionSelect = '<option value="1" selected class="notBlock">Básica</option>';
                }
                var htmlSelect = `${optionSelect}
                                  <option value="1">Básica</option>
                                  <option value="2">Ordinaria</option>
                                `;
                document.querySelector("#listTipoEdit").innerHTML = htmlSelect;

                document.querySelector('#listPlantelEdt').querySelector('option[value="'+objData.idplantel+'"]').selected = true;
                document.querySelector('#listGradoEdit').innerHTML = "<option value='"+objData.id_grado+"' selcted>"+objData.nombre_grado+"("+objData.numero_romano+")"+"</option>";
                const selGrados = document.querySelector('#listGradoEdit');
                let url_grados = base_url+"/Materias/getGrados";
                fetch(url_grados)
                    .then(res => res.json())
                    .then((resultado) => {
                        for (let i = 0; i < resultado.length; i++) {
                            opcion = document.createElement('option');
                            opcion.text = resultado[i]['nombre_grado']+"("+resultado[i]['numero_romano']+")";
                            opcion.value = resultado[i]['id'];
                            selGrados.appendChild(opcion);
                        }
                    })
                    .catch(err => { throw err });
                document.querySelector('#listPlanEstudioEdit').innerHTML = "<option value ='"+objData.id_plan+"'selected>"+objData.nombre_carrera+"</option>";
                const selPlanEstudios = document.querySelector('#listPlanEstudioEdit');
                let url_plan = base_url+"/Materias/getPlanEstudios";
                fetch(url_plan)
                    .then(res => res.json())
                    .then((resultado) => {
                        for (let i = 0; i < resultado.length; i++) {
                            opcion = document.createElement('option');
                            opcion.text = resultado[i]['nombre_carrera'];
                            opcion.value = resultado[i]['id'];
                            selPlanEstudios.appendChild(opcion);
                        }
                    })
                    .catch(err => { throw err });
                    document.querySelector('#listClasificacionEdit').querySelector('option[value="'+objData.id_clasificacion_materia+'"]').selected = true;

                if(objData.estatus == 1)
                {
                    var optionSelect = '<option value="1" selected class="notBlock">Activo</option>';
                }else{
                    var optionSelect = '<option value="2" selected class="notBlock">Inactivo</option>';
                }
                var htmlSelect = `${optionSelect}
                                  <option value="1">Activo</option>
                                  <option value="2">Inactivo</option>
                                `;
                document.querySelector("#listEstatusEdit").innerHTML = htmlSelect;
            }else{
                swal.fire("Error", objData.msg , "error");
            }
            
        }
    }
}
//Enviar datos de Materia Edit
formMateriaEdit.onsubmit = function(e){
    e.preventDefault();
    var strNombre = document.querySelector('#txtNombreEdit').value;
    var strClave = document.querySelector('#txtClaveEdit').value;
    var intHoraTeoria = document.querySelector('#txtHorasTeoriaEdit').value;
    var intHoraPractica = document.querySelector('#txtHorasPracticaEdit').value;
    var intCreditos = document.querySelector('#txtCreditosEdit').value;
    var strTipo = document.querySelector('#listTipoEdit').value;
    var strPlantel = document.querySelector('#listPlantelEdt').value;
    var intGrado = document.querySelector('#listGradoEdit').value;
    var intPlanEstudio = document.querySelector('#listPlanEstudioEdit').value;
    var strClasificacion = document.querySelector('#listClasificacionEdit').value;
    var intStatus = document.querySelector('#listEstatusEdit').value;
    if(strNombre == '' || strClave == '' || intHoraTeoria == '' || intHoraPractica == '' || intCreditos == '' || strTipo == '' || strPlantel == '' || intGrado == '' || intPlanEstudio == '' || strClasificacion == '' || intStatus == ''){
        swal.fire("Atención","Atención todos los campos son obligatorios","warning");
        return false;
    }
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+'/Materias/setMateria';
    var formData = new FormData(formMateriaEdit);
    request.open("POST",ajaxUrl,true);
    request.send(formData);
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var objData = JSON.parse(request.responseText);
            if(objData.estatus){
                formMateriaEdit.reset();
                swal.fire("Materia",objData.msg,"success").then((result) =>{
                    $('#dimissModalEdit').click();
                });
                tableMaterias.api().ajax.reload();
            }else{
                swal.fire("Error",objData.msg,"error");
            }
        }
        return false;
    }
}

//Funcion para Eliminar Materia
function fntDelMateria(id) {
    swal.fire({
        icon: "question",
        title: "Eliminar materia?",
        text: "¿Realmente quiere eliminar la materia?",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33', 
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!"
    }). then((result) => {
        if (result.isConfirmed) 
        {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url+'/Materias/delMateria'; 
            var strData = "idMateria="+id;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    var objData = JSON.parse(request.responseText);
                    if(objData.estatus)
                    {
                        swal.fire("Eliminado!", objData.msg , "success");
                        tableMaterias.api().ajax.reload();

                    } else {
                        swal.fire("Atención!", objData.msg , "error");
                    }
                }
            }
        }
    });
}
function plantelSeleccionado(id){
    const selLocalidades = document.querySelector('#listPlanEstudioNuevo');
    let url_plan = base_url+"/Materias/getPlanEstudiosNuevo?id="+id;
    fetch(url_plan)
        .then(res => res.json())
        .then((resultado) => {
            document.querySelector('#listPlanEstudioNuevo').innerHTML = "<option value=''>Selecciona un Plan de Estudio</option>";
            for (let i = 0; i < resultado.length; i++) {
                opcion = document.createElement('option');
                opcion.text = resultado[i]['nombre_carrera']+' ('+resultado[i]['rvoe']+')'+' ('+resultado[i]['fecha_vigencia']+')';
                opcion.value = resultado[i]['id'];
                selLocalidades.appendChild(opcion);
            }
        })
        .catch(err => { throw err });
}

function plantelSeleccionadoEdit(id){
    const selLocalidades = document.querySelector('#listPlanEstudioEdit');
    let url_plan = base_url+"/Materias/getPlanEstudiosNuevo?id="+id;
    fetch(url_plan)
        .then(res => res.json())
        .then((resultado) => {
            document.querySelector('#listPlanEstudioEdit').innerHTML = "<option value=''>Selecciona un Plan de Estudio</option>";
            for (let i = 0; i < resultado.length; i++) {
                opcion = document.createElement('option');
                opcion.text = resultado[i]['nombre_carrera']+' ('+resultado[i]['revoe']+')'+' ('+resultado[i]['vigencia_revoe']+')';
                opcion.value = resultado[i]['id'];
                selLocalidades.appendChild(opcion);
            }
        })
        .catch(err => { throw err });
}
//Funcion para Aceptar solo Numeros en un Input
function validarNumeroInput(event){
    if(event.charCode >= 48 && event.charCode <= 57){
        return true;
    }
    return false;
}