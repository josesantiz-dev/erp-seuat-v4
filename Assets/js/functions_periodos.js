let tablePeriodos
let rowTable = "";
let divLoading = document.querySelector("#divLoading");

//PARA SELECT
window.addEventListener('load', function(){
    fntSelectPeriodoOrganizacion();
}, false);

window.addEventListener('load', function(){
    fntSelectPeriodoCiclos();
}, false);

window.addEventListener('load', function(){
    fntSelectEditPerioPlan();
}, false);

window.addEventListener('load', function(){
    fntSelectEditPerioCiclo();
}, false);

document.addEventListener('DOMContentLoaded', function(){

    tablePeriodos = $('#tablePeriodos').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": " "+base_url+"/Assets/plugins/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Periodos/getPeriodos",
            "dataSrc":""
        },
        "columns":[
            {"data":"IdPeriodos"},
            {"data":"Nombre"},
            {"data":"Fecha_inicio"},
            {"data":"Fecha_fin"},
            {"data":"Plan"},
            {"data":"Nombre_ciclo"},
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
	    "scrollY": '44vh',
	    "scrollCollapse": true,
	    "bDestroy": true,
	    "order": [[ 0, "desc" ]],
	    "iDisplayLength": 25
    }); 


    //NUEVO PERIODO
    if(document.querySelector('#formPeriodos')){
        let formPeriodos = document.querySelector('#formPeriodos');
        formPeriodos.onsubmit = function(e){
            e.preventDefault();
            //console.log("Guardado");
            let intIdPeriodos =document.querySelector('#idPeriodos').value;
            let strNombre_Periodo =document.querySelector('#txtNombre_Periodo').value;
            let strFecha_inicio = document.querySelector('#txtFecha_inicio').value;
			let strFecha_fin = document.querySelector('#txtFecha_fin').value;
            let intEstatus =document.querySelector('#listEstatus').value;
            let strFecha_Creacion =document.querySelector('#txtFecha_Creacion').value;
            let strFecha_Actualizacion =document.querySelector('#txtFecha_Actualizacion').value;
            let intId_usuario_creacion =document.querySelector('#txtId_usuario_creacion').value;
            let intId_Usuario_Actualizacion =document.querySelector('#txtId_Usuario_Actualizacion').value;
            let intId_Organizacion_planes =document.querySelector('#listIdOrganizacionesNuevo').value;
            let intId_ciclo =document.querySelector('#listIdCiclosNuevo').value;

            if ( strNombre_Periodo == '' || strFecha_inicio == '' || strFecha_fin == '' || intEstatus == '' || strFecha_Creacion == '' || intId_usuario_creacion == '' || intId_Organizacion_planes == '' || intId_ciclo == '')
            {
                swal.fire("Atención", "Atención todos los campos son obligatorios", "warning");
                return false;
            }
            divLoading.getElementsByClassName.display = "flex";
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Periodos/setPeriodo';
            let formData = new FormData(formPeriodos);
            request.open("POST", ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function() {

                if ( request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.estatus)
                    {
                        $('#ModalFormPeriodos').modal("hide");
                        formPeriodos.reset();
                        swal.fire("Periodos", objData.msg, "success");
                        tablePeriodos.api().ajax.reload();

                    }else{
                        swal.fire("Error", objData.msg, "error");
                    }
                }
                divLoading.getElementsByClassName.display = "none";
                return false;
            }
        }
    }


    //ACTUALIZAR PERIODO
    if(document.querySelector('#formPeriodosUp')){
        let formPeriodosUp = document.querySelector('#formPeriodosUp');
        formPeriodosUp.onsubmit = function(e){
            e.preventDefault();

            let intIdPeriodos = document.querySelector('#idPeriodosUp').value;
            let strNombre_Periodo = document.querySelector('#txtNombre_PeriodoUp').value;
            let strFecha_inicio = document.querySelector('#txtFecha_inicioUp').value;
            let strFecha_fin = document.querySelector('#txtFecha_finUp').value;
            let intEstatus = document.querySelector('#listEstatusUp').value;
            let strFecha_Actualizacion = document.querySelector('#txtFecha_ActualizacionUp ').value;
            let intId_Usuario_Actualizacion = document.querySelector('#txtId_Usuario_ActualizacionUp').value;
            let intId_Organizacion_planes = document.querySelector('#listIdOrganizacionesEditar').value;
            let intId_Ciclo = document.querySelector('#listIdCiclosEditar').value;
            
            if(strNombre_Periodo == '' || strFecha_inicio == '' || strFecha_fin == '' || intEstatus == '' || intId_Organizacion_planes == '' || intId_Ciclo == '' ||  intId_Usuario_Actualizacion == '')
            {
                swal.fire("Atención", "Atención todos los campos son obligatorios", "warning");
				return false;
            }

            divLoading.style.display = "flex";
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Periodos/setPeriodos_up';
            let formData = new FormData(formPeriodosUp);
            request.open("POST",ajaxUrl,true);
            request.send(formData);

            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){

                    let objData = JSON.parse(request.responseText);
                    if(objData.estatus)
                    {
                        if(rowTable == ""){
                            tablePeriodos.api().ajax.reload();
                        }else{
                            htmlEstatus = intEstatus == 1 ?
                            '<span class="badge badge-dark">Activo</span>' :
							'<span class="badge badge-secondary">Inactivo</span>';
							rowTable.cells[1].textContent = strNombre_Periodo;
							rowTable.cells[2].textContent = strFecha_inicio;
                            rowTable.cells[3].textContent = strFecha_fin;
                            rowTable.cells[4].innerHTML = intId_Organizacion_planes;
                            rowTable.cells[5].innerHTML = intId_Ciclo;
                            rowTable.cells[6].innerHTML = htmlEstatus;
							rowTable = "";
                        }

                        $('#ModalFormPeriodoEditar').modal('hide');
                        formPeriodosUp.reset();
                        swal.fire("Periodos ", objData.msg, "success");
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


/* --------------SELECT PARA NUEVO------------------ */
//SELECT PARA NUEVO PERIOD ORGANIZACION PLAN
function fntSelectPeriodoOrganizacion(){
    if(document.querySelector('#listIdOrganizacionesNuevo')){
        let ajaxUrl = base_url+'/Periodos/getSelectPeriodoOrganiz';
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET",ajaxUrl,true);
        request.send();
        request.onreadystatechange = function() {
            if(request.readyState == 4 && request.status == 200) {
                document.querySelector('#listIdOrganizacionesNuevo').innerHTML = request.responseText;
            }
        }
    }
}

//SELECT PARA NUEVO PERIOD SELECCION DE CICLO
function fntSelectPeriodoCiclos(){
    if(document.querySelector('#listIdCiclosNuevo')){
        let ajaxUrl = base_url+'/Periodos/getSelectPeriodoCiclo';
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET",ajaxUrl,true);
        request.send();
        request.onreadystatechange = function() {
            if(request.readyState == 4 && request.status == 200) {
                document.querySelector('#listIdCiclosNuevo').innerHTML = request.responseText;
            }
        }
    }
}
/* ------------------------------- */

/* -------------SELECT PARA EDITAR------------------- */
//SELECT PARA EDITAR plan
function fntSelectEditPerioPlan(){
    if(document.querySelector('#listIdOrganizacionesEditar')){
        let ajaxUrl = base_url+'/Periodos/getSelectEditPerioPlan';
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET",ajaxUrl,true);
        request.send();
        request.onreadystatechange = function() {
            if(request.readyState == 4 && request.status == 200) {
                document.querySelector('#listIdOrganizacionesEditar').innerHTML = request.responseText;
            }
        }
    }
}

//SELECT PARA EDITAR CICLO
function fntSelectEditPerioCiclo(){
    if(document.querySelector('#listIdCiclosEditar')){
        let ajaxUrl = base_url+'/Periodos/getSelectEditPerioCiclo';
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET",ajaxUrl,true);
        request.send();
        request.onreadystatechange = function() {
            if(request.readyState == 4 && request.status == 200) {
                document.querySelector('#listIdCiclosEditar').innerHTML = request.responseText;
            }
        }
    }
}
/* ------------------------------------------------- */


//FUNTION PARA ELIMINAR PERIODO
function fntDelPeriodos(id){
    swal.fire({
        icon: "question",
        title: "Eliminar periodo",
        text: "¿Realmente quiere eliminar el periodo seleccionada?",
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
            let ajaxUrl = base_url+'/Periodos/delPeriodos';
            let strData = "idPeriodos="+id;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.estatus)
                    {
                        swal.fire("Eliminar!", objData.msg, "success");
                        tablePeriodos.api().ajax.reload();
                    }else{
                        swal.fire("Atención", objData.msg, "error");
                    }
                }
            }
        }
    });
}


//ABRIR EL MODAL DE BOTON NUEVO
$('#tablePeriodos').DataTable();

function openModal(){
    document.querySelector('#idPeriodos').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo periodo";
    document.querySelector("#formPeriodos").reset();
	$('#ModalFormPeriodos').modal('show');
}
window.addEventListener('load', function(){
}, false);


//EDITAR PERIODOS 
function fntEditPeriodos(element, id){
    rowTable = element.parentNode.parentNode.parentNode.parentNode.parentNode;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Periodos/getPeriodo/'+id;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){

            let objData = JSON.parse(request.responseText);
            if(objData.estatus){
                document.querySelector("#idPeriodosUp").value = objData.data.id;
                document.querySelector("#txtNombre_PeriodoUp").value = objData.data.nombre_periodo;
                document.querySelector("#txtFecha_inicioUp").value = objData.data.fecha_inicio_periodo;
                document.querySelector("#txtFecha_finUp").value = objData.data.fecha_fin_periodo;
                document.querySelector("#listIdOrganizacionesEditar").value = objData.data.id_organizacion_planes;
                document.querySelector("#listIdCiclosEditar").value = objData.data.id_ciclo;
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
                $('#ModalFormPeriodoEditar').modal('show');
            }else{
                swal.fire("Error", objData.msg , "error");
            }
        }
    }
}




//CERRAR MODAL DE BOTON NUEVO
$('.cerrarModal').click(function(){
    $('#ModalFormPeriodos').modal('hide');
    $('#ModalFormPeriodoEditar').modal('hide');
})