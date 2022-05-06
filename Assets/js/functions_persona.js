var tablePersonas;
var formPersonaNueva =  document.querySelector("#formPersonaNuevo");
let divLoading = document.querySelector("#divLoading");
let formImportarProspectos = document.querySelector('#form_importar_prospectos');
let urlFetchUloadProspecto = `${base_url}/Persona/setUploadCsvProspecto/`;

document.addEventListener('DOMContentLoaded', function(){
	tablePersonas = $('#tablePersonas').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": " "+base_url+"/Assets/plugins/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Persona/getPersonas",
            "dataSrc":""
        },
        "columns":[
            {"data":"numeracion"},
            {"data":"alias"},
            {"data":"nombre_persona"},
			{"data":"apellidos"},
            {"data":"email"},
            {"data":"tel_celular"},
            {"data":"direccion"},
            {"data":"nombre_categoria"},
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
$('#tablePersonas').DataTable();


formPersonaNueva.onsubmit = function(e){
    e.preventDefault();
    document.querySelector("#idNuevo").value = 1;

    let txtNombre = document.querySelector('#txtNombreNuevo').value;
    let txtAlias = document.querySelector('#txtAliasNuevo').value;
    let txtSexo = document.querySelector('#listSexoNuevo').value;
    let txtMedioCaptacion = document.querySelector('#listMediosCaptacion').value;
    let txtLocalidad = document.querySelector('#listLocalidadNuevo').value;
    let txtObservacion = document.querySelector('#txtObservacion').value;
    let radioCaptacion = document.getElementsByName('radioMedios_captacion');
    if (txtNombre == '' || txtAlias == '' || txtSexo == '' || txtMedioCaptacion == '' || txtLocalidad == '' || txtObservacion == ''){
        swal.fire("Atención", "Atención todos los campos son obligatorios", "warning");
        return false;
    }
    divLoading.style.display = "flex";
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+'/Persona/setPersona';
    var formData = new FormData(formPersonaNueva);
    request.open("POST",ajaxUrl,true);
    request.send(formData);
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var objData = JSON.parse(request.responseText);
            //console.log(objData)
            if(objData.estatus){
                formPersonaNueva.reset();
                swal.fire("Persona",objData.msg,"success").then((result) =>{
                    $('#dimissModalNuevo').click();
                });
                tablePersonas.api().ajax.reload();
            }else{
                swal.fire("Error",objData.msg,"error");
            }
        }
        divLoading.style.display = "none";
        return false;
    }
}

function estadoSeleccionado(value){
    const selMunicipio = document.querySelector('#listMunicipioNuevo');
    let url = base_url+"/Persona/getMunicipios?idestado="+value;
    fetch(url)
    .then(res => res.json())
    .then((resultado) => {
        selMunicipio.innerHTML = "";
        for (let i = 0; i < resultado.length; i++) {
            opcion = document.createElement('option');
            opcion.text = resultado[i]['nombre'];
            opcion.value = resultado[i]['id'];
            selMunicipio.appendChild(opcion);
            
        }
    })
    .catch(err =>{throw err});
}

function estadoSeleccionado(value){
    const selMunicipio = document.querySelector('#listMunicipioNuevo');
    let url = base_url+"/Persona/getMunicipios?idestado="+value;
    fetch(url)
    .then(res => res.json())
    .then((resultado) => {
        selMunicipio.innerHTML = "";
        for (let i = 0; i < resultado.length; i++) {
            opcion = document.createElement('option');
            opcion.text = resultado[i]['nombre'];
            opcion.value = resultado[i]['id'];
            selMunicipio.appendChild(opcion);
            
        }
    })
    .catch(err =>{throw err});
}
function nivelCarreraInteresSeleccionado(value){
    const selCarreraInteres = document.querySelector('#listCarreraInteres');
    if(value == ''){
        selCarreraInteres.innerHTML = "<option value=''>Seleccionar</option>";
    }else{
        let url = base_url+"/Persona/getCarrerasInteres?idNivel="+value;
        fetch(url)
        .then(res => res.json())
        .then((resultado) => {
            if(resultado.length != 0){
                selCarreraInteres.innerHTML = "<option value=''>Seleccionar</option>";
                for (let i = 0; i < resultado.length; i++) {
                    opcion = document.createElement('option');
                    opcion.text = resultado[i]['nombre_carrera'];
                    opcion.value = resultado[i]['id'];
                    selCarreraInteres.appendChild(opcion);
                    
                }
            }else{
                selCarreraInteres.innerHTML = "<option value=''>Seleccionar</option>";
            }
        })
        .catch(err =>{throw err});
    }
}
function nivelCarreraInteresSeleccionadoEdit(value){
    const selCarreraInteres = document.querySelector('#listCarreraInteresEdit');
    let url = base_url+"/Persona/getCarrerasInteres?idNivel="+value;
    fetch(url)
    .then(res => res.json())
    .then((resultado) => {
        selCarreraInteres.innerHTML = "";
        for (let i = 0; i < resultado.length; i++) {
            opcion = document.createElement('option');
            opcion.text = resultado[i]['nombre_carrera'];
            opcion.value = resultado[i]['id'];
            selCarreraInteres.appendChild(opcion);
            
        }
    })
    .catch(err =>{throw err});
}

function estadoSeleccionadoEdit(value){
    const selMunicipio = document.querySelector('#listMunicipioEdit');
    let url = base_url+"/Persona/getMunicipios?idestado="+value;
    fetch(url)
    .then(res => res.json())
    .then((resultado) => {
        selMunicipio.innerHTML = "";
        for (let i = 0; i < resultado.length; i++) {
            opcion = document.createElement('option');
            opcion.text = resultado[i]['nombre'];
            opcion.value = resultado[i]['id'];
            selMunicipio.appendChild(opcion);
            
        }
    })
    .catch(err =>{throw err});  
}
function municipioSeleccionado(value){
    const selLocalidades = document.querySelector('#listLocalidadNuevo');
    let url = base_url+"/Persona/getLocalidades?idmunicipio="+value;
    fetch(url)
        .then(res => res.json())
        .then((resultado) => {
            selLocalidades.innerHTML ="";
            for (let i = 0; i < resultado.length; i++) {
                opcion = document.createElement('option');
                opcion.text = resultado[i]['nombre'];
                opcion.value = resultado[i]['id'];
                selLocalidades.appendChild(opcion);
            }
        })
        .catch(err => {throw err});
}

function municipioSeleccionadoEdit(value){
    const selLocalidades = document.querySelector('#listLocalidadEdit');
    let url = base_url+"/Persona/getLocalidades?idmunicipio="+value;
    fetch(url)
        .then(res => res.json())
        .then((resultado) => {
            selLocalidades.innerHTML ="";
            for (let i = 0; i < resultado.length; i++) {
                opcion = document.createElement('option');
                opcion.text = resultado[i]['nombre'];
                opcion.value = resultado[i]['id'];
                selLocalidades.appendChild(opcion);
            }
        })
        .catch(err => {throw err});
}

function fntEditPersona(idPersona){
    var idPersona = idPersona;
    divLoading.style.display = "flex";
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+'/Persona/getPersonaEdit/'+idPersona;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var objData = JSON.parse(request.responseText);
            if(objData){
                document.querySelector("#idEdit").value = objData.id;
                document.querySelector("#txtNombreEdit").value = objData.nombre_persona;    
                document.querySelector("#txtAliasEdit").value = objData.alias;    
                document.querySelector("#txtApellidoPaEdit").value = objData.ap_paterno;
                document.querySelector("#txtApellidoMaEdit").value = objData.ap_materno;
                document.querySelector("#txtDireccionEdit").value = objData.direccion;
                document.querySelector("#txtEdadEdit").value = objData.edad;
                document.querySelector('#listSexoEdit').querySelector('option[value="'+objData.sexo+'"]').selected = true;
                document.querySelector("#txtCPEdit").value = objData.cp;
                document.querySelector("#txtColoniaEdit").value = objData.colonia;
                document.querySelector("#txtTelCelEdit").value = objData.tel_celular;
                document.querySelector("#txtTelFiEdit").value = objData.tel_fijo;
                document.querySelector("#txtEmailEdit").value = objData.email;
                if(objData.edo_civil == null){
                    document.querySelector('#listEstadoCivilEdit').querySelector('option[value=""]').selected = true;
                }else{
                    document.querySelector('#listEstadoCivilEdit').querySelector('option[value="'+objData.edo_civil+'"]').selected = true;
                }
                document.querySelector("#txtOcupacionEdit").value = objData.ocupacion;
                if(objData.id_escolaridad == null){
                    document.querySelector('#listEscolaridadEdit').querySelector('option[value=""]').selected = true;
                }else{
                    document.querySelector('#listEscolaridadEdit').querySelector('option[value="'+objData.id_escolaridad+'"]').selected = true;
                }
                if(objData.id_plantel_interes == null){
                    document.querySelector('#listPlantelInteresEdit').querySelector('option[value=""]').selected = true;
                }else{
                    document.querySelector('#listPlantelInteresEdit').querySelector('option[value="'+objData.id_plantel_interes+'"]').selected = true;
                }
                document.querySelector('#txtMedioCaptacionEdit').value = objData.medio_captacion;
                document.querySelector('#txtNombreEscuelaProcEdit').value = objData.escuela_procedencia;
                document.querySelector("#txtFechaNacimientoEdit").value = objData.fecha_nacimiento;
                if(objData.id_nivel_carrera_interes == null){
                    document.querySelector('#listNivelCarreraInteresEdit').querySelector('option[value=""]').selected = true;
                }else{
                    document.querySelector('#listNivelCarreraInteresEdit').querySelector('option[value="'+objData.id_nivel_carrera_interes+'"]').selected = true;
                }
                let urlCarreraInteres = base_url+"/Persona/getCarrerasInteres?idNivel="+objData.id_nivel_carrera_interes;
                fetch(urlCarreraInteres)
                .then(res => res.json())
                .then((resultadoCarreraInteres) =>{
                    resultadoCarreraInteres.forEach(element => {
                        document.querySelector('#listCarreraInteresEdit').innerHTML += "<option value='"+element['id']+"'>"+element['nombre_carrera']+"</option>"
                        if(element['id'] == objData.id_carrera_interes){
                            document.querySelector('#listCarreraInteresEdit').querySelector('option[value="'+objData.id_carrera_interes+'"]').selected = true;

                        }
                    });
                })
                .catch(err => {throw err});
                document.querySelector("#txtCURPEdit").value = objData.curp;
                var idEstadoPersona = "";
                var idMunicipioPersona = "";
                var idLocalidadPersona = "";
                document.querySelector('#listMunicipioEdit').innerHTML = "";
                document.querySelector('#listLocalidadEdit').innerHTML = "";
                let url = base_url+"/Plantel/getListEstados";
                fetch(url)
                    .then(res => res.json())
                    .then((resultado) => {
                    for (let i = 0; i < resultado.length; i++) {
                        document.querySelector('#listEstadoEdit').innerHTML += "<option value='"+resultado[i]['id']+"'>"+resultado[i]['nombre']+"</option>"
                        if(resultado[i]['id'] == objData.idest){
                            idEstadoPersona = resultado[i]['id'];
                            select = document.querySelector('#listEstadoEdit');
                            var opt = document.createElement('option');
                            opt.value = resultado[i]['id'];
                            opt.innerHTML = resultado[i]['nombre'];
                            opt.setAttribute("selected","");
                            select.appendChild(opt);
                            let urlMunicipios = base_url+"/Plantel/getMunicipios?idestado="+idEstadoPersona;
                            fetch(urlMunicipios)
                                .then(res => res.json())
                                .then((resultadoMunicipio) =>{
                                    resultadoMunicipio.forEach(element => {
                                        document.querySelector('#listMunicipioEdit').innerHTML += "<option value='"+element['id']+"'>"+element['nombre']+"</option>"
                                        if(element['id'] == objData.idmun){
                                            idMunicipioPersona = element['id'];
                                            selectMunicipio = document.querySelector('#listMunicipioEdit');
                                            var optMunicipio = document.createElement('option');
                                            optMunicipio.value = element['id'];
                                            optMunicipio.innerHTML = element['nombre'];
                                            optMunicipio.setAttribute("selected","");
                                            selectMunicipio.appendChild(optMunicipio);
                                            let urlLocalidades = base_url+"/Plantel/getLocalidades?idmunicipio="+idMunicipioPersona;
                                            fetch(urlLocalidades)
                                                .then(res => res.json())
                                                .then((resultadoLocalidad) =>{
                                                    resultadoLocalidad.forEach(element => {
                                                        document.querySelector('#listLocalidadEdit').innerHTML += "<option value='"+element['id']+"'>"+element['nombre']+"</option>"
                                                        if(element['id'] == objData.id_localidad){
                                                            idLocalidadPersona = element['id'];
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
                document.querySelector('#listCategoriaEdit').querySelector('option[value="'+objData.id_categoria_persona+'"]').selected = true;
                document.querySelector('#txtObservacionEdit').value = objData.observacion;
                //document.querySelector('#listEstatusEdit').querySelector('option[value="'+objData.estatus+'"]').selected = true;


            }
        }
        divLoading.style.display = "none";
        return false;
    }
}

var formEditPersona = document.querySelector("#formPersonaEdit");
    formEditPersona.onsubmit = function(e){
        e.preventDefault();
        var intId = document.querySelector("#idEdit").value;
        var strNombre = document.querySelector("#txtNombreEdit").value;
        var strAlias = document.querySelector("#txtAliasEdit").value;
        var strObservaciones = document.querySelector("#txtObservacionEdit").value;

        if (intId == '' || strNombre == '' || strAlias == '' || strObservaciones == ''){
            swal.fire("Atención", "Atención todos los campos son obligatorios", "warning");
            return false;
        }
        divLoading.style.display = "flex";
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url+'/Persona/setPersona';
        var formData = new FormData(formEditPersona);
        request.open("POST",ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function() {
                if(request.readyState == 4 && request.status == 200) {
                    var objData = JSON.parse(request.responseText);
                    if(objData.estatus){
                        $('#formPersonaEdit').modal("hide");
                        formEditPersona.reset();
                        swal.fire("Persona", objData.msg, "success").then((result) =>{
                            $('#dimissModalEdit').click();
                        });
                        tablePersonas.api().ajax.reload();  
                    }else{
                        swal.fire("Error", "error", "error");
                    }
                }
                divLoading.style.display = "none";
                return false;
            }
}

function fntVerPersona(idPersona){
    var idPersona = idPersona;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+'/Persona/getPersonaEdit/'+idPersona;
    divLoading.style.display = "flex";
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var objData = JSON.parse(request.responseText);
            if(objData){
                document.querySelector("#idVer").value = objData.id;
                document.querySelector("#txtNombreVer").value = objData.nombre_persona;    
                document.querySelector("#txtAliasVer").value = objData.alias;    
                document.querySelector("#txtApellidoPaVer").value = objData.ap_paterno;
                document.querySelector("#txtApellidoMaVer").value = objData.ap_materno;
                document.querySelector("#txtDireccionVer").value = objData.direccion;
                document.querySelector("#txtObservacionVer").value = objData.observacion;
                document.querySelector("#txtEdadVer").value = objData.edad;
                document.querySelector('#listSexoVer').innerHTML = "<option>"+objData.sexo+"</option>";
                document.querySelector("#txtCPVer").value = objData.cp;
                document.querySelector("#txtColoniaVer").value = objData.colonia;
                document.querySelector("#txtTelCelVer").value = objData.tel_celular;
                document.querySelector("#txtTelFiVer").value = objData.tel_fijo;
                document.querySelector("#txtEmailVer").value = objData.email;
                document.querySelector('#listEstadoCivilVer').innerHTML = "<option>"+objData.edo_civil+"</option>";
                document.querySelector("#txtOcupacionVer").value = objData.ocupacion;
                document.querySelector('#listEscolaridadVer').innerHTML = "<option>"+objData.nombre_escolaridad+"</option>";
                document.querySelector('#txtPlantelInteresVer').value = objData.plantel_interes;
                document.querySelector('#listEstadoVer').innerHTML = "<option>"+objData.nomestado+"</option>";
                document.querySelector('#listMunicipioVer').innerHTML = "<option>"+objData.nommunicipio+"</option>";
                document.querySelector('#listLocalidadVer').innerHTML = "<option>"+objData.nomlocalidad+"</option>";
                document.querySelector('#listCategoriaVer').innerHTML = "<option>"+objData.edo_civil+"</option>";
                document.querySelector('#txtFechaNacimientOVer').value = objData.fecha_nacimiento;
                document.querySelector('#txtCURPVer').value = objData.curp;
                document.querySelector('#listNivelCarreraInteresVer').innerHTML = "<option>"+objData.nivel_carrera_interes+"</option>";
                let carreraInteres = `${base_url}/Persona/getCarrerasInteres?idNivel=${objData.id_nivel_carrera_interes}`;
                fetch(carreraInteres).then((res) => res.json()).then(resultado =>{
                    resultado.forEach(element => {
                        if(element.id == objData.id_carrera_interes){
                            document.querySelector('#listCarreraInteresVer').innerHTML = "<option>"+element.nombre_carrera+"</option>";
                        }
                    });
                }).catch(err => {throw err});

                document.querySelector('#txtMedioCaptacionVer').value = objData.medio_captacion;
                document.querySelector('#txtNombreEscuelaProcVer').value = objData.escuela_procedencia;
                if(objData.estatus == 1){
                    document.querySelector('#listEstatusVer').innerHTML = "<option>Activo</option>";
                }else{
                    document.querySelector('#listEstatusVer').innerHTML = "<option>Inactivo</option>";
                }
            }
        }
        divLoading.style.display = "none";
        return false;
    }
}


//Funcion para Eliminar Persona
function fntDelPersona(id) {
    swal.fire({
        icon: "question",
        title: "Eliminar Persona?",
        text: "¿Realmente quiere eliminar la Persona?",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33', 
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!"
    }). then((result) => {
        if (result.isConfirmed) 
        {
            divLoading.style.display = "flex";
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url+'/Persona/delPersona'; 
            var strData = "idPersona="+id;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    var objData = JSON.parse(request.responseText);
                    if(objData.estatus)
                    {
                        swal.fire("Eliminado!", objData.msg , "success");
                        tablePersonas.api().ajax.reload();

                    } else {
                        swal.fire("Atención!", objData.msg , "error");
                    }
                }
                divLoading.style.display = "none";
                return false;
            }
        }
    });
}
function convCSVToArray(str, delimiter = ","){
    const headers = str.slice(0, str.indexOf("\n")).split(delimiter);
    const rows = str.slice(str.indexOf("\n")+1).split("\n");
    const arr = rows.map(function (row){
        const values = row.split(delimiter);
        const e1 = headers.reduce(function (objetc, header, index){
            objetc[header] = values[index];
            return objetc;
        }, {});
        return e1;
    });
    return arr;
}

formImportarProspectos.addEventListener("submit", function(e){
    e.preventDefault();
    const fileInput = document.querySelector('#file_csv_importar_prospectos').files[0];
    const reader = new FileReader();
    reader.onload = function(e){
        const text = e.target.result;
        const data = convCSVToArray(text);
        fetch(urlFetchUloadProspecto+JSON.stringify(data))
        .then((res) => res.json())
        .then(resultado =>{
            if(resultado.estatus){
                $('#modal_importar_prospectos').modal("hide");
                formImportarProspectos.reset();
                swal.fire("Persona", resultado.msg, "success").then((result) =>{
                    $('.close').click();
                });
                tablePersonas.api().ajax.reload(); 
            }else{
                swal.fire("Error", resultado.msg, "error");
            }
        }).catch(err => {throw err});
    };
    reader.readAsText(fileInput);
});

//Cuando se agregar un archivo csv
$('#file_csv_importar_prospectos').on('change',function(e){
    //var fileName = $(this).val();
    $(this).next('#label_input_csv').html(e.target.files[0].name);
    const fileInput = document.querySelector('#file_csv_importar_prospectos').files[0];
    //Vista previa
    const reader = new FileReader();
    reader.onload = function(e){
        const text = e.target.result;
        const data = convCSVToArray(text);
        let table = document.querySelector('#table_personas_modal_preview');
        let numeracion = 0;
        table.innerHTML = "<tr><th>#</th><th>Alias</th><th>Nombres</th><th>Apellido paterno</th><th>Apellido materno</th><th>Email</th><th>Telefono celular</th><th>Dirección</th></tr>";
        data.forEach(element => {
            if(element.id != ''){
                numeracion += 1;
                table.innerHTML += `<tr><td>${numeracion}</td><td>${element.alias}</td><td>${element.nombre_persona}</td><td>${element.ap_paterno}</td><td>${element.ap_materno}</td><td>${element.email}</td><td>${element.tel_celular}</td><td>${element.direccion}</td></tr>`;
            }
        });
    };
    reader.readAsText(fileInput);
})

function fnBtnImportarProspectos(){
    formImportarProspectos.reset();
    document.querySelector('#label_input_csv').textContent = "Seleccione un archivo csv...";
    document.querySelector('#table_personas_modal_preview').innerHTML = "";
}

//Funcion para Aceptar solo Numeros en un Input
function validarNumeroInput(event){
    if(event.charCode >= 48 && event.charCode <= 57){
        return true;
    }
    return false;
  }