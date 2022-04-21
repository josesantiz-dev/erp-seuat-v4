let tableCiclos;
let rowTable = "";
let divLoading = document.querySelector("#divLoading");

//PARA SELECT
window.addEventListener('load', function(){
    fntSelectCiclo();
}, false);

window.addEventListener('load', function(){
    fntSelectEditCiclo();
}, false);

document.addEventListener('DOMContentLoaded', function(){

    tableCiclos = $('#tableCiclos').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": " "+base_url+"/Assets/plugins/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Ciclos/getCiclos",
            "dataSrc":""
        },
        "columns":[
            {"data":"numeracion"},
            {"data":"Nombre"},
            {"data":"Anio"},
            {"data":"Generacion"},
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


    //NUEVO CICLO
    if(document.querySelector("#formCiclos")){
        let formCiclos = document.querySelector("#formCiclos");
        formCiclos.onsubmit = function(e){
            e.preventDefault();
            /* console.log("hola mundo"); */
            let intIdCiclos = document.querySelector('#idCiclos').value;
            let strNombre_Ciclo = document.querySelector('#txtNombre_Ciclo').value;
            let strAnio = document.querySelector('#txtAnio').value;
            let intEstatus = document.querySelector('#listEstatus').value;
            let strFecha_Creacion = document.querySelector('#txtFecha_Creacion').value;
            let strFecha_Actualizacion = document.querySelector('#txtFecha_Actualizacion').value;
            let intId_usuario_creacion = document.querySelector('#txtId_usuario_creacion').value;
            let intId_Usuario_Actualizacion = document.querySelector('#txtId_Usuario_Actualizacion').value;
            let intId_Generacion = document.querySelector('#listIdGeneracionesNuevo').value;

            if ( strNombre_Ciclo == '' || strAnio == '' || intEstatus == '' || strFecha_Creacion == '' || intId_usuario_creacion == '' || intId_Generacion == '')
            {
                swal.fire("Atención", "Atención todos los campos son obligatorios", "warning");
                return false;
            }
            divLoading.getElementsByClassName.display = "flex";
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Ciclos/setCiclo';
            let formData = new FormData(formCiclos);
            request.open("POST", ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function() {

                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.estatus)
                    {
                        $('#ModalFormCiclos').modal("hide");
                        formCiclos.reset();
                        swal.fire("Ciclos de usuario", objData.msg, "success");
                        tableCiclos.api().ajax.reload();

                    }else{
                        swal.fire("Error", objData.msg, "error");
                    }
                }
                divLoading.style.display = "none";
                return false;
            }
        }
    }

    //ACTUALIZAR
    if(document.querySelector('#formCiclosUp')){
        let formCiclosUp = document.querySelector('#formCiclosUp');
        formCiclosUp.onsubmit = function(e){
            e.preventDefault();

            let intIdCiclos = document.querySelector('#idCiclosUp').value;
            let strNombre_Ciclo = document.querySelector('#txtNombre_CicloUp').value;
            let strAnio = document.querySelector('#txtAnioUp').value;
            let intEstatus = document.querySelector('#listEstatusUp').value;
            let strFecha_Actualizacion = document.querySelector('#txtFecha_ActualizacionUp ').value;
            let intId_Usuario_Actualizacion = document.querySelector('#txtId_Usuario_ActualizacionUp').value;
            let intId_Generacion = document.querySelector('#listIdGeneracionesEditar').value;
            
            if(strNombre_Ciclo == '' || strAnio == '' || intEstatus == '' || intId_Generacion == '' ||  intId_Usuario_Actualizacion == '')
            {
                swal.fire("Atención", "Atención todos los campos son obligatorios", "warning");
				return false;
            }

            divLoading.style.display = "flex";
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Ciclos/setCiclos_up';
            let formData = new FormData(formCiclosUp);
            request.open("POST",ajaxUrl,true);
            request.send(formData);

            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){

                    let objData = JSON.parse(request.responseText);
                    if(objData.estatus)
                    {
                        tableCiclos.api().ajax.reload();
                        // if(rowTable == ""){
                        //     tableCiclos.api().ajax.reload();
                        // }else{
                        //     htmlEstatus = intEstatus == 1 ?
                        //     '<span class="badge badge-dark">Activo</span>' :
						// 	'<span class="badge badge-secondary">Inactivo</span>';
						// 	rowTable.cells[1].textContent = strNombre_Ciclo;
						// 	rowTable.cells[2].textContent = strAnio;
						// 	rowTable.cells[3].innerHTML = htmlEstatus;
                        //     rowTable.cells[4].innerHTML = intId_Generacion;
						// 	rowTable = "";
                        // }

                        $('#ModalFormCicloEditar').modal('hide');
                        formCiclosUp.reset();
                        swal.fire("Ciclos ", objData.msg, "success");
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


//SELECT PARA NUEVO
function fntSelectCiclo(){
    if(document.querySelector('#listIdGeneracionesNuevo')){
        /* let nombreGeneracion = document.querySelector('#listIdGeneracionesNuevo').options[document.querySelector('#listIdGeneracionesNuevo').selectedIndex].text; */

        let ajaxUrl = base_url+'/Ciclos/getSelectCiclo';
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET",ajaxUrl,true);
        request.send();
        request.onreadystatechange = function() {
            if(request.readyState == 4 && request.status == 200) {
                document.querySelector('#listIdGeneracionesNuevo').innerHTML = request.responseText;
            }
        }
    }
}


//SELECT PARA EDITAR
function fntSelectEditCiclo(){
    if(document.querySelector('#listIdGeneracionesEditar')){
        let ajaxUrl = base_url+'/Ciclos/getSelectEditCiclo';
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET",ajaxUrl,true);
        request.send();
        request.onreadystatechange = function() {
            if(request.readyState == 4 && request.status == 200) {
                document.querySelector('#listIdGeneracionesEditar').innerHTML = request.responseText;
            }
        }
    }
}


//FUNTION PARA ELIMINAR
function fntDelCiclos(id){
    swal.fire({
        icon: "question",
        title: "Eliminar ciclo",
        text: "¿Realmente quiere eliminar el ciclo seleccionada?",
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
            let ajaxUrl = base_url+'/Ciclos/delCiclos';
            let strData = "IdCiclos="+id;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.estatus)
                    {
                        swal.fire("Eliminar!", objData.msg, "success");
                        tableCiclos.api().ajax.reload();
                    }else{
                        swal.fire("Atención", objData.msg, "error");
                    }
                }
            }
        }
    });
}


//ABRIR EL MODAL DE BOTÓN NUEVO
$('#tableCiclos').DataTable();

function openModal(){
    document.querySelector('#idCiclos').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo ciclo";
    document.querySelector("#formCiclos").reset();
	$('#ModalFormCiclos').modal('show');
}
window.addEventListener('load', function() {
}, false);


//EDITAR CICLOS 
function fntEditCiclos(element, id){
    rowTable = element.parentNode.parentNode.parentNode.parentNode.parentNode;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Ciclos/getCiclo/'+id;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){

            let objData = JSON.parse(request.responseText);
            if(objData.estatus){
                document.querySelector("#idCiclosUp").value = objData.data.id;
                document.querySelector("#txtNombre_CicloUp").value = objData.data.nombre_ciclo;
                document.querySelector("#txtAnioUp").value = objData.data.anio;
                document.querySelector("#listIdGeneracionesEditar").value = objData.data.id_generacion;
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
                $('#ModalFormCicloEditar').modal('show');
            }else{
                swal.fire("Error", objData.msg , "error");
            }
        }
    }
}



//CERRAR MODAL DE BOTON NUEVO
$('.cerrarModal').click(function(){
    $('#ModalFormCiclos').modal('hide');
});


//CERRAR MODAL DE BOTON EDITAR
$('.cerrarModal').click(function(){
    $('#ModalFormCicloEditar').modal('hide');
});