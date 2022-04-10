var tablePlanes;
var formPlanNuevo = document.querySelector("#formPlanNuevo");
var formPlanEdit = document.querySelector("#formPlanEdit");

//Datatable
document.addEventListener('DOMContentLoaded', function(){
	tablePlanes = $('#tablePlanes').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": " "+base_url+"/Assets/plugins/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Plan/getPlanes",
            "dataSrc":""
        },
        "columns":[
            {"data":"numeracion"},
            {"data":"nombre_plan"},
            {"data":"abreviatura"},
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
$('#tablePlanes').DataTable();

//Nuevo Plan
formPlanNuevo.onsubmit = function(e){
    e.preventDefault();
    document.querySelector("#idNuevo").value = 1;
    var strNombre = document.querySelector('#txtNombreNuevo').value;
    var strAbreviatura = document.querySelector('#txtAbreviaturaNuevo').value;
    //var intEstatus = document.querySelector('#listEstatusNuevo').value;
    if(strNombre == '' || strAbreviatura == ''){
        swal.fire("Atención","Atención todos los campos son obligatorios","warning");
        return false;
    }
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+'/Plan/setPlan';
    var formData = new FormData(formPlanNuevo);
    request.open("POST",ajaxUrl,true);
    request.send(formData);
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var objData = JSON.parse(request.responseText);
            if(objData.estatus){
                formPlanNuevo.reset();
                swal.fire("Plan",objData.msg,"success").then((result) =>{
                    $('#dimissModalNuevo').click();
                });
                tablePlanes.api().ajax.reload();
            }else{
                swal.fire("Error",objData.msg,"error");
            }
        }
        return false;
    }
}

//Editar Plan
function fntEditPlan(idPlan){
    var idPlan = idPlan;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl  = base_url+'/Plan/getPlan/'+idPlan;
    request.open("GET",ajaxUrl ,true);
	request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var objData = JSON.parse(request.responseText);
            if(objData){   
                document.querySelector("#idEdit").value = objData.id;
                document.querySelector("#txtNombreEdit").value = objData.nombre_plan;
                document.querySelector("#txtAbreviaturaEdit").value = objData.abreviatura;
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
//Form Plan Edit
formPlanEdit.onsubmit = function(e){
    e.preventDefault();
    var strNombre = document.querySelector('#txtNombreEdit').value;
    var strAbreviatura = document.querySelector('#txtAbreviaturaEdit').value;
    //var intEstatus = document.querySelector('#listEstatusEdit').value;
    if(strNombre == '' || strAbreviatura == ''){
        swal.fire("Atención","Atención todos los campos son obligatorios","warning");
        return false;
    }
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+'/Plan/setPlan';
    var formData = new FormData(formPlanEdit);
    request.open("POST",ajaxUrl,true);
    request.send(formData);
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var objData = JSON.parse(request.responseText);
            if(objData.estatus){
                formPlanEdit.reset();
                swal.fire("Plan",objData.msg,"success").then((result) =>{
                    $('#dimissModalEdit').click();
                });
                tablePlanes.api().ajax.reload();
            }else{
                swal.fire("Error",objData.msg,"error");
            }
        }
        return false;
    }
}

//Funcion para Eliminar Plan
function fntDelPlan(id) {
    swal.fire({
        icon: "question",
        title: "Eliminar plan?",
        text: "¿Realmente quiere eliminar el plan?",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33', 
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!"
    }). then((result) => {
        if (result.isConfirmed) 
        {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url+'/Plan/delPlan'; 
            var strData = "idPlan="+id;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    var objData = JSON.parse(request.responseText);
                    if(objData.estatus)
                    {
                        swal.fire("Eliminado!", objData.msg , "success");
                        tablePlanes.api().ajax.reload();

                    } else {
                        swal.fire("Atención!", objData.msg , "error");
                    }
                }
            }
        }
    });
}