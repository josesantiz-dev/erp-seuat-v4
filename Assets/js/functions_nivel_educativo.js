var tableNivelEducativo;
var formNivelEducativoNuevo = document.querySelector("#formNivelEducativoNuevo");
var formNivelEducativoEdit = document.querySelector("#formNivelEducativoEdit");

//Datatable
document.addEventListener('DOMContentLoaded', function(){
	tableNivelEducativo = $('#tableNivelEducativo').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": " "+base_url+"/Assets/plugins/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/NivelEducativo/getNivelesEducativos",
            "dataSrc":""
        },
        "columns":[
            {"data":"numeracion"},
            {"data":"nombre_nivel_educativo"},
			{"data":"abreviatura"},
			{"data":"orden"},
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
$('#tableNivelEducativo').DataTable();

//Nuevo Nivel educativo
formNivelEducativoNuevo.onsubmit = function(e){
    e.preventDefault();
    document.querySelector("#idNuevo").value = 1;
    var strNombre = document.querySelector('#txtNombreNuevo').value;
    var strAbreviatura = document.querySelector('#txtAbreviaturaNuevo').value;
    //var intOrden = document.querySelector('#txtOrdenNuevo').value;
    //var intEstatus = document.querySelector('#listEstatusNuevo').value;
    if(strNombre == '' || strAbreviatura == ''){
        swal.fire("Atención","Atención todos los campos son obligatorios","warning");
        return false;
    }
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+'/NivelEducativo/setNivelEducativo';
    var formData = new FormData(formNivelEducativoNuevo);
    request.open("POST",ajaxUrl,true);
    request.send(formData);
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var objData = JSON.parse(request.responseText);
             if(objData.estatus){
                formNivelEducativoNuevo.reset();
                swal.fire("Nivel educativo",objData.msg,"success").then((result) =>{
                    $('#dimissModalNuevo').click();
                });
                tableNivelEducativo.api().ajax.reload();
            }else{
                swal.fire("Error",objData.msg,"error");
            }
        }
        return false;
    }
}

//Editar Nivel Educativo
function fntEditNivelEducativo(idNivelEducativo){
    var idNivelEducativo = idNivelEducativo;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl  = base_url+'/NivelEducativo/getNivelEducativo/'+idNivelEducativo;
    request.open("GET",ajaxUrl ,true);
	request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var objData = JSON.parse(request.responseText);
            if(objData){   
                document.querySelector("#idEdit").value = objData.id;
                document.querySelector("#txtNombreEdit").value = objData.nombre_nivel_educativo;
                document.querySelector("#txtAbreviaturaEdit").value = objData.abreviatura;
                document.querySelector("#txtOrdenEdit").value = objData.orden;
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
//Form Nivel Edicativo Edit
formNivelEducativoEdit.onsubmit = function(e){
    e.preventDefault();

    var strNombre = document.querySelector('#txtNombreEdit').value;
    var strAbreviatura = document.querySelector('#txtAbreviaturaEdit').value;
    //var intOrden = document.querySelector('#txtOrdenEdit').value;
    //var intEstatus = document.querySelector('#listEstatusEdit').value;

    if(strNombre == '' || strAbreviatura == ''){
        swal.fire("Atención","Atención todos los campos son obligatorios","warning");
        return false;
    }
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+'/NivelEducativo/setNivelEducativo';
    var formData = new FormData(formNivelEducativoEdit);
    request.open("POST",ajaxUrl,true);
    request.send(formData);
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var objData = JSON.parse(request.responseText);
            console.log(objData);
              if(objData.estatus){
                formNivelEducativoEdit.reset();
                swal.fire("Nivel educativo",objData.msg,"success").then((result) =>{
                    $('#dimissModalEdit').click();
                });
                tableNivelEducativo.api().ajax.reload();
            }else{
                swal.fire("Error",objData.msg,"error");
            }
        }
        return false;
    }
}

//Funcion para Eliminar Nivel Educativo
function fntDelNivelEducativo(id) {
    swal.fire({
        icon: "question",
        title: "Eliminar nivel educativo?",
        text: "¿Realmente quiere eliminar el nivel educativo?",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33', 
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!"
    }). then((result) => {
        if (result.isConfirmed) 
        {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url+'/NivelEducativo/delNivelEducativo'; 
            var strData = "idNivelEducativo="+id;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    var objData = JSON.parse(request.responseText);
                    if(objData.estatus)
                    {
                        swal.fire("Eliminado!", objData.msg , "success");
                        tableNivelEducativo.api().ajax.reload();

                    } else {
                        swal.fire("Atención!", objData.msg , "error");
                    }
                }
            }
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
