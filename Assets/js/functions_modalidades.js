var tableModalidad;
var formModalidad = document.querySelector("#formModalidad");
var formModalidadEdit = document.querySelector("#formModalidadEdit");

//Funcion para Datatable de Mostrar todas las Modalidades
document.addEventListener('DOMContentLoaded', function(){
	tableModalidad = $('#tableModalidad').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": " "+base_url+"/Assets/plugins/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Modalidades/getModalidades",
            "dataSrc":""
        },
        "columns":[
            {"data":"numeracion"},
            {"data":"nombre_modalidad"},
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
$('#tableModalidad').DataTable();


//Nueva Modalidad
formModalidad.onsubmit = function(e){
    e.preventDefault();
    document.querySelector("#idModalidadNueva").value = 1;
    var strNombre = document.querySelector('#txtModalidadNueva').value;
    //var intEstatus = document.querySelector('#listEstatusNueva').value;
    if(strNombre == ''){
        swal.fire("Atención","Atención todos los campos son obligatorios","warning");
        return false;
    }
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+'/Modalidades/setModalidad';
    var formData = new FormData(formModalidad);
    request.open("POST",ajaxUrl,true);
    request.send(formData);
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var objData = JSON.parse(request.responseText);
            console.log(objData);
            if(objData.estatus){
                formModalidad.reset();
                swal.fire("Modalidades",objData.msg,"success").then((result) =>{
                    $('#dimissModalNueva').click();
                });
                tableModalidad.api().ajax.reload();
            }else{
                swal.fire("Error",objData.msg,"error");
            }
        }
        return false;
    }
}

//Editar Modalidad
function fntEditModalidad(idModalidad){
    var idModalidad = idModalidad;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl  = base_url+'/Modalidades/getModalidad/'+idModalidad;
    request.open("GET",ajaxUrl ,true);
	request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var objData = JSON.parse(request.responseText);
            if(objData){   
                document.querySelector("#idModalidadEdit").value = objData.id;
                document.querySelector("#txtModalidadEdit").value = objData.nombre_modalidad;
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
//Guardar Nueva Modalidad
formModalidadEdit.onsubmit = function(e){
    e.preventDefault();
    var strNombre = document.querySelector('#txtModalidadEdit').value;
    //var intEstatus = document.querySelector('#listEstatusEdit').value;
    if(strNombre == ''){
        swal.fire("Atención","Atención todos los campos son obligatorios","warning");
        return false;
    }
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+'/Modalidades/setModalidad';
    var formData = new FormData(formModalidadEdit);
    request.open("POST",ajaxUrl,true);
    request.send(formData);
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var objData = JSON.parse(request.responseText);
            if(objData.estatus){
                formModalidadEdit.reset();
                swal.fire("Modalidades",objData.msg,"success").then((result) =>{
                    $('#dimissModalEdit').click();
                });
                tableModalidad.api().ajax.reload();
            }else{
                swal.fire("Error",objData.msg,"error");
            }
        }
        return false;
    }
}

//Funcion para Eliminar Modalidades
function fntDelModalidad(id) {
    swal.fire({
        icon: "question",
        title: "Eliminar modalidad",
        text: "¿Realmente quiere eliminar la modalidad?",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33', 
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!"
    }). then((result) => {
        if (result.isConfirmed) 
        {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url+'/Modalidades/delModalidad'; 
            var strData = "idModalidad="+id;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    var objData = JSON.parse(request.responseText);
                    if(objData.estatus)
                    {
                        swal.fire("Eliminado!", objData.msg , "success");
                        tableModalidad.api().ajax.reload();

                    } else {
                        swal.fire("Atención!", objData.msg , "error");
                    }
                }
            }
        }
    });
}