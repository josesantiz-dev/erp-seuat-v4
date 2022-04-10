let tableSalonesCompuestos;
let rowTable = "";
let divLoading = document.querySelector("#divLoading");

//SELECT PARA NUEVO
window.addEventListener('load', function(){
    fntSelectSalonComPerio();
    fntSelectSalonComGrado();
    fntSelectSalonComGrupo();
    fntSelectSalonComPlantel();
    fntSelectSalonComTurno();
    fntSelectSalonComSalon();
}, false);

//SELECT PARA EDITAR
window.addEventListener('load', function(){
    fntSelectEditSalonComPerio();
    fntSelectEditSalonComGrado();
    fntSelectEditSalonComGrupo();
    fntSelectEditSalonComPlantel();
    fntSelectEditSalonComTurno();
    fntSelectEditSalonComSalon();
}, false);


document.addEventListener('DOMContentLoaded', function(){

    tableSalonesCompuestos = $('#tableSalonesCompuestos').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": " "+base_url+"/Assets/plugins/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Salones_compuestos/getSalonesCompuest",
            "dataSrc":""
        },
        "columns":[
            {"data":"IdSalonCom"},
            {"data":"NomSalCom"},
            {"data":"NomPerio"},
            {"data":"NomGrad"},
            {"data":"NomGrup"},
            {"data":"NomPlant"},
            {"data":"NomTurn"},
            {"data":"NomSal"},
            {"data":"Est"},
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


    //NUEVO SALON COMPUESTO
    if(document.querySelector("#formSalonesCompuestos")){
        let formSalonesCompuestos = document.querySelector("#formSalonesCompuestos");
        formSalonesCompuestos.onsubmit = function(e){
            e.preventDefault();
            /* console.log("hola mundo"); */
            let intIdSalonesCompuestos = document.querySelector('#idSalonesCompuestos').value;
            let strNombre_SalonCompuesto = document.querySelector('#txtNombre_SalonCompuesto').value;
            let strFecha_Creacion = document.querySelector('#txtFecha_Creacion').value;
            let strFecha_Actualizacion = document.querySelector('#txtFecha_Actualizacion').value;
            let intId_usuario_creacion = document.querySelector('#txtId_usuario_creacion').value;
            let intId_Usuario_Actualizacion = document.querySelector('#txtId_Usuario_Actualizacion').value;
            let intId_Periodos = document.querySelector('#listIdPeriodosNuevo').value;
            let intId_Grados = document.querySelector('#listIdGradosNuevo').value;
            let intId_Grupos = document.querySelector('#listIdGruposNuevo').value;
            let intId_Planteles = document.querySelector('#listIdPlantelesNuevo').value;
            let intId_Turnos = document.querySelector('#listIdTurnosNuevo').value;
            let intId_Salones = document.querySelector('#listIdSalonesNuevo').value;
            let intEstatus = document.querySelector('#listEstatus').value;

            if ( strNombre_SalonCompuesto == '' || strFecha_Creacion == '' || intId_usuario_creacion == '' || intId_Periodos == '' || intId_Grados == '' || intId_Grupos == '' || intId_Planteles == '' || intId_Turnos == '' || intId_Salones == '' || intEstatus == '')
            {
                swal.fire("Atención", "Atención todos los campos son obligatorios", "warning");
                return false;
            }
            divLoading.getElementsByClassName.display = "flex";
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Salones_compuestos/setSalonCompuesto';
            let formData = new FormData(formSalonesCompuestos);
            request.open("POST", ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function() {

                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.estatus)
                    {
                        $('#ModalFormSalonesCompuestos').modal("hide");
                        formSalonesCompuestos.reset();
                        swal.fire("Salones compuesto de usuario", objData.msg, "success");
                        tableSalonesCompuestos.api().ajax.reload();

                    }else{
                        swal.fire("Error", objData.msg, "error");
                    }
                }
                divLoading.style.display = "none";
                return false;
            }
        }
    }


    //ACTUALIZAR salones compuestos
    if(document.querySelector('#formSalonesCompuestosUp')){
        let formSalonesCompuestosUp = document.querySelector('#formSalonesCompuestosUp');
        formSalonesCompuestosUp.onsubmit = function(e){
            e.preventDefault();

            let intIdSalonesCompuestos = document.querySelector('#idSalonesCompuestosUp').value;
            let strNombre_SalonCompuesto = document.querySelector('#txtNombre_SalonCompuestoUp').value;
            let strFecha_Actualizacion = document.querySelector('#txtFecha_ActualizacionUp ').value;
            let intId_Usuario_Actualizacion = document.querySelector('#txtId_Usuario_ActualizacionUp').value;
            let intId_Periodos = document.querySelector('#listIdPeriodosEditar').value;
            let intId_Grados = document.querySelector('#listIdGradosEditar').value;
            let intId_Grupos = document.querySelector('#listIdGruposEditar').value;
            let intId_Planteles = document.querySelector('#listIdPlantelesEditar').value;
            let intId_Turnos = document.querySelector('#listIdTurnosEditar').value;
            let intId_Salones = document.querySelector('#listIdSalonesEditar').value;
            let intEstatus = document.querySelector('#listEstatusUp').value;
            
            if(strNombre_SalonCompuesto == '' || intEstatus == '' || intId_Periodos == '' || intId_Grados == '' || intId_Grupos == '' || intId_Planteles == '' || intId_Turnos == '' || intId_Salones == '' ||  intId_Usuario_Actualizacion == '')
            {
                swal.fire("Atención", "Atención todos los campos son obligatorios", "warning");
				return false;
            }

            divLoading.style.display = "flex";
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Salones_compuestos/setSalonesCompuestos_up';
            let formData = new FormData(formSalonesCompuestosUp);
            request.open("POST",ajaxUrl,true);
            request.send(formData);

            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){

                    let objData = JSON.parse(request.responseText);
                    if(objData.estatus)
                    {
                        if(rowTable == ""){
                            tableCiclos.api().ajax.reload();
                        }else{
                            htmlEstatus = intEstatus == 1 ?
                            '<span class="badge badge-dark">Activo</span>' :
							'<span class="badge badge-secondary">Inactivo</span>';
							rowTable.cells[1].textContent = strNombre_SalonCompuesto;
                            rowTable.cells[2].innerHTML = intId_Periodos;
                            rowTable.cells[3].innerHTML = intId_Grados;
                            rowTable.cells[4].innerHTML = intId_Grupos;
                            rowTable.cells[5].innerHTML = intId_Planteles;
                            rowTable.cells[6].innerHTML = intId_Turnos;
                            rowTable.cells[7].innerHTML = intId_Salones;
                            rowTable.cells[8].innerHTML = htmlEstatus;
							rowTable = "";
                        }

                        $('#ModalFormSalonCompEditar').modal('hide');
                        formSalonesCompuestosUp.reset();
                        swal.fire("Salón compuesto ", objData.msg, "success");
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




//EDITAR SALONES COMPUESTOS 
function fntEditSalonesComp(element, id){
    rowTable = element.parentNode.parentNode.parentNode.parentNode.parentNode;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Salones_compuestos/getSalonComp/'+id;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){

            let objData = JSON.parse(request.responseText);
            if(objData.estatus){
                document.querySelector("#idSalonesCompuestosUp").value = objData.data.id;
                document.querySelector("#txtNombre_SalonCompuestoUp").value = objData.data.nombre_salon_compuesto;
                document.querySelector("#listIdPeriodosEditar").value = objData.data.id_periodo;
                document.querySelector("#listIdGradosEditar").value = objData.data.id_grado;
                document.querySelector("#listIdGruposEditar").value = objData.data.id_grupo;
                document.querySelector("#listIdPlantelesEditar").value = objData.data.id_plantel;
                document.querySelector("#listIdTurnosEditar").value = objData.data.id_turnos;
                document.querySelector("#listIdSalonesEditar").value = objData.data.id_salon;
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
                $('#ModalFormSalonCompEditar').modal('show');
            }else{
                swal.fire("Error", objData.msg , "error");
            }
        }
    }
}


//FUNTION PARA ELIMINAR SALONES COMPUESTOS
function fntDelSalonesComp(id){
    swal.fire({
        icon: "question",
        title: "Eliminar salón compuesto",
        text: "¿Realmente quiere eliminar el salón compuesto seleccionada?",
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
            let ajaxUrl = base_url+'/Salones_compuestos/delSalonesCompuest';
            let strData = "IdSalonCom="+id;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.estatus)
                    {
                        swal.fire("Eliminar!", objData.msg, "success");
                        tableSalonesCompuestos.api().ajax.reload();
                    }else{
                        swal.fire("Atención", objData.msg, "error");
                    }
                }
            }
        }
    });
}





/* -----------------------------SELECT PARA NUEVO---------------------------------------------- */
function fntSelectSalonComPerio(){
    if(document.querySelector('#listIdPeriodosNuevo')){
        /* let nombreGeneracion = document.querySelector('#listIdGeneracionesNuevo').options[document.querySelector('#listIdGeneracionesNuevo').selectedIndex].text; */

        let ajaxUrl = base_url+'/Salones_compuestos/getSelectSalonComPerio';
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET",ajaxUrl,true);
        request.send();
        request.onreadystatechange = function() {
            if(request.readyState == 4 && request.status == 200) {
                document.querySelector('#listIdPeriodosNuevo').innerHTML = request.responseText;
            }
        }
    }
}

function fntSelectSalonComGrado(){
    if(document.querySelector('#listIdGradosNuevo')){
        /* let nombreGeneracion = document.querySelector('#listIdGeneracionesNuevo').options[document.querySelector('#listIdGeneracionesNuevo').selectedIndex].text; */

        let ajaxUrl = base_url+'/Salones_compuestos/getSelectSalonComGrado';
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET",ajaxUrl,true);
        request.send();
        request.onreadystatechange = function() {
            if(request.readyState == 4 && request.status == 200) {
                document.querySelector('#listIdGradosNuevo').innerHTML = request.responseText;
            }
        }
    }
}

function fntSelectSalonComGrupo(){
    if(document.querySelector('#listIdGruposNuevo')){
        /* let nombreGeneracion = document.querySelector('#listIdGeneracionesNuevo').options[document.querySelector('#listIdGeneracionesNuevo').selectedIndex].text; */

        let ajaxUrl = base_url+'/Salones_compuestos/getSelectSalonComGrupo';
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET",ajaxUrl,true);
        request.send();
        request.onreadystatechange = function() {
            if(request.readyState == 4 && request.status == 200) {
                document.querySelector('#listIdGruposNuevo').innerHTML = request.responseText;
            }
        }
    }
}

function fntSelectSalonComPlantel(){
    if(document.querySelector('#listIdPlantelesNuevo')){
        /* let nombreGeneracion = document.querySelector('#listIdGeneracionesNuevo').options[document.querySelector('#listIdGeneracionesNuevo').selectedIndex].text; */

        let ajaxUrl = base_url+'/Salones_compuestos/getSelectSalonComPlantel';
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET",ajaxUrl,true);
        request.send();
        request.onreadystatechange = function() {
            if(request.readyState == 4 && request.status == 200) {
                document.querySelector('#listIdPlantelesNuevo').innerHTML = request.responseText;
            }
        }
    }
}

function fntSelectSalonComTurno(){
    if(document.querySelector('#listIdTurnosNuevo')){
        /* let nombreGeneracion = document.querySelector('#listIdGeneracionesNuevo').options[document.querySelector('#listIdGeneracionesNuevo').selectedIndex].text; */

        let ajaxUrl = base_url+'/Salones_compuestos/getSelectSalonComHorar';
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET",ajaxUrl,true);
        request.send();
        request.onreadystatechange = function() {
            if(request.readyState == 4 && request.status == 200) {
                document.querySelector('#listIdTurnosNuevo').innerHTML = request.responseText;
            }
        }
    }
}

function fntSelectSalonComSalon(){
    if(document.querySelector('#listIdSalonesNuevo')){
        /* let nombreGeneracion = document.querySelector('#listIdGeneracionesNuevo').options[document.querySelector('#listIdGeneracionesNuevo').selectedIndex].text; */

        let ajaxUrl = base_url+'/Salones_compuestos/getSelectSalonComSalon';
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET",ajaxUrl,true);
        request.send();
        request.onreadystatechange = function() {
            if(request.readyState == 4 && request.status == 200) {
                document.querySelector('#listIdSalonesNuevo').innerHTML = request.responseText;
            }
        }
    }
}
/* ------------------------------------------------------------------------------------------------ */


/* -----------------------------SELECT PARA EDITAR---------------------------------------------- */

function fntSelectEditSalonComPerio(){
    if(document.querySelector('#listIdPeriodosEditar')){
        let ajaxUrl = base_url+'/Salones_compuestos/getSelectEditSalonComPerio';
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET",ajaxUrl,true);
        request.send();
        request.onreadystatechange = function() {
            if(request.readyState == 4 && request.status == 200) {
                document.querySelector('#listIdPeriodosEditar').innerHTML = request.responseText;
            }
        }
    }
}

function fntSelectEditSalonComGrado(){
    if(document.querySelector('#listIdGradosEditar')){
        let ajaxUrl = base_url+'/Salones_compuestos/getSelectEditSalonComGrado';
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET",ajaxUrl,true);
        request.send();
        request.onreadystatechange = function() {
            if(request.readyState == 4 && request.status == 200) {
                document.querySelector('#listIdGradosEditar').innerHTML = request.responseText;
            }
        }
    }
}

function fntSelectEditSalonComGrupo(){
    if(document.querySelector('#listIdGruposEditar')){
        let ajaxUrl = base_url+'/Salones_compuestos/getSelectEditSalonComGrupo';
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET",ajaxUrl,true);
        request.send();
        request.onreadystatechange = function() {
            if(request.readyState == 4 && request.status == 200) {
                document.querySelector('#listIdGruposEditar').innerHTML = request.responseText;
            }
        }
    }
}

function fntSelectEditSalonComPlantel(){
    if(document.querySelector('#listIdPlantelesEditar')){
        let ajaxUrl = base_url+'/Salones_compuestos/getSelectEditSalonComPlantel';
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET",ajaxUrl,true);
        request.send();
        request.onreadystatechange = function() {
            if(request.readyState == 4 && request.status == 200) {
                document.querySelector('#listIdPlantelesEditar').innerHTML = request.responseText;
            }
        }
    }
}

function fntSelectEditSalonComTurno(){
    if(document.querySelector('#listIdTurnosEditar')){
        let ajaxUrl = base_url+'/Salones_compuestos/getSelectEditSalonComHorar';
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET",ajaxUrl,true);
        request.send();
        request.onreadystatechange = function() {
            if(request.readyState == 4 && request.status == 200) {
                document.querySelector('#listIdTurnosEditar').innerHTML = request.responseText;
            }
        }
    }
}

function fntSelectEditSalonComSalon(){
    if(document.querySelector('#listIdSalonesEditar')){
        let ajaxUrl = base_url+'/Salones_compuestos/getSelectEditSalonComSalon';
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET",ajaxUrl,true);
        request.send();
        request.onreadystatechange = function() {
            if(request.readyState == 4 && request.status == 200) {
                document.querySelector('#listIdSalonesEditar').innerHTML = request.responseText;
            }
        }
    }
}
/* -------------------------------------------------------------------------------------------- */



//ABRIR EL MODAL DE BOTÓN NUEVO
$('#tableSalonesCompuestos').DataTable();

function openModal(){
    document.querySelector('#idSalonesCompuestos').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo salón compuesto";
    document.querySelector("#formSalonesCompuestos").reset();
	$('#ModalFormSalonesCompuestos').modal('show');
}
window.addEventListener('load', function() {
}, false);




//CERRAR MODAL DE BOTON NUEVO Y EDITAR
$('.cerrarModal').click(function(){
    $('#ModalFormSalonesCompuestos').modal('hide');
    $('#ModalFormSalonCompEditar').modal('hide');
});