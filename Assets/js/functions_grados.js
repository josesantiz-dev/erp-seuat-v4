let tableGrados;
let rowTable = "";
let divLoading = document.querySelector("#divLoading");

document.addEventListener('DOMContentLoaded', function(){

    tableGrados = $('#tableGrados').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": " "+base_url+"/Assets/plugins/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Grados/getGrados",
            "dataSrc":""
        },
        "columns":[
            {"data":"IdGrados"},
            {"data":"Nombre"},
            {"data":"Numero_Nat"},
            {"data":"Numero_Rom"},
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


    //NUEVO GRADO
    if(document.querySelector("#formGrados")){
        let formGrados = document.querySelector("#formGrados");
        formGrados.onsubmit = function(e){
            e.preventDefault();
            /* console.log("hola mundo"); */
            let intIdGrados = document.querySelector('#idGrados').value;
            let strNombre_Grado = document.querySelector('#txtNombre_Grado').value;
            let strNumero_Natural = document.querySelector('#txtNumero_Natural').value;
            let strNumero_Romano = document.querySelector('#txtNumero_Romano').value;
            let intEstatus = document.querySelector('#listEstatus').value;
            let strFecha_Creacion = document.querySelector('#txtFecha_Creacion').value;
            let strFecha_Actualizacion = document.querySelector('#txtFecha_Actualizacion').value;
            let intId_usuario_creacion = document.querySelector('#txtId_usuario_creacion').value;
            let intId_Usuario_Actualizacion = document.querySelector('#txtId_Usuario_Actualizacion').value;

            if ( strNombre_Grado == '' || strNumero_Natural == '' || strNumero_Romano == '' || intEstatus == '' || strFecha_Creacion == '' || intId_usuario_creacion == '')
            {
                swal.fire("Atención", "Atención todos los campos son obligatorios", "warning");
                return false;
            }
            divLoading.getElementsByClassName.display = "flex";
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Grados/setGrado';
            let formData = new FormData(formGrados);
            request.open("POST", ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function() {

                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.estatus)
                    {
                        $('#ModalFormGrados').modal("hide");
                        formGrados.reset();
                        swal.fire("Ciclos de usuario", objData.msg, "success");
                        tableGrados.api().ajax.reload();

                    }else{
                        swal.fire("Error", objData.msg, "error");
                    }
                }
                divLoading.style.display = "none";
                return false;
            }
        }
    }


    //ACTUALIZAR GRADO
    if(document.querySelector('#formGradosUp')){
        let formGradosUp = document.querySelector('#formGradosUp');
        formGradosUp.onsubmit = function(e){
            e.preventDefault();

            let intIdGrados = document.querySelector('#idGradosUp').value;
            let strNombre_Grado = document.querySelector('#txtNombre_GradoUp').value;
            let strNumero_Natural = document.querySelector('#txtNumero_NaturalUp').value;
            let strNumero_Romano = document.querySelector('#txtNumero_RomanoUp').value;
            let intEstatus = document.querySelector('#listEstatusUp').value;
            let strFecha_Actualizacion = document.querySelector('#txtFecha_ActualizacionUp ').value;
            let intId_Usuario_Actualizacion = document.querySelector('#txtId_Usuario_ActualizacionUp').value;
            
            if(strNombre_Grado == '' || strNumero_Natural == '' || strNumero_Romano == '' || intEstatus == '' || intId_Usuario_Actualizacion == '')
            {
                swal.fire("Atención", "Atención todos los campos son obligatorios", "warning");
				return false;
            }

            divLoading.style.display = "flex";
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Grados/setGrados_up';
            let formData = new FormData(formGradosUp);
            request.open("POST",ajaxUrl,true);
            request.send(formData);

            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){

                    let objData = JSON.parse(request.responseText);
                    if(objData.estatus)
                    {
                        if(rowTable == ""){
                            tableGrados.api().ajax.reload();
                        }else{
                            htmlEstatus = intEstatus == 1 ?
                            '<span class="badge badge-dark">Activo</span>' :
							'<span class="badge badge-secondary">Inactivo</span>';
							rowTable.cells[1].textContent = strNombre_Grado;
							rowTable.cells[2].textContent = strNumero_Natural;
                            rowTable.cells[3].textContent = strNumero_Romano;
							rowTable.cells[4].innerHTML = htmlEstatus;
							rowTable = "";
                        }

                        $('#ModalFormGradoEditar').modal('hide');
                        formGradosUp.reset();
                        swal.fire("Grados ", objData.msg, "success");
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


//FUNTION PARA ELIMINAR
function fntDelGrados(id){
    swal.fire({
        icon: "question",
        title: "Eliminar grado",
        text: "¿Realmente quiere eliminar el grado seleccionada?",
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
            let ajaxUrl = base_url+'/Grados/delGrados';
            let strData = "idGrados="+id;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.estatus)
                    {
                        swal.fire("Eliminar!", objData.msg, "success");
                        tableGrados.api().ajax.reload();
                    }else{
                        swal.fire("Atención", objData.msg, "error");
                    }
                }
            }
        }
    });
}


//ABRIR EL MODAL DE BOTÓN NUEVO
$('#tableGrados').DataTable();

function openModal(){
    document.querySelector('#idGrados').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo grado";
    document.querySelector("#formGrados").reset();
	$('#ModalFormGrados').modal('show');
}
window.addEventListener('load', function() {
}, false);



//EDITAR GRADOS
function fntEditGrados(element, id){
    rowTable = element.parentNode.parentNode.parentNode.parentNode.parentNode;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Grados/getGrado/'+id;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){

            let objData = JSON.parse(request.responseText);
            if(objData.estatus){
                document.querySelector("#idGradosUp").value = objData.data.id;
                document.querySelector("#txtNombre_GradoUp").value = objData.data.nombre_grado;
                document.querySelector("#txtNumero_NaturalUp").value = objData.data.numero_natural;
                document.querySelector("#txtNumero_RomanoUp").value = objData.data.numero_romano;
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
                $('#ModalFormGradoEditar').modal('show');
            }else{
                swal.fire("Error", objData.msg , "error");
            }
        }
    }
}



//CERRAR MODAL DE BOTON NUEVO y EDITTAR
$('.cerrarModal').click(function(){
    $('#ModalFormGrados').modal('hide');
    $('#ModalFormGradoEditar').modal('hide');
});