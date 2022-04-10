//Mostrar Lista de Planteles de Datatable
document.addEventListener('DOMContentLoaded', function(){
	tableCategoriasCarreras = $('#tableCategoriaCarreras').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": " "+base_url+"/Assets/plugins/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/CategoriaCarrera/getCategoriasCarreras",
            "dataSrc":""
        },
        "columns":[
            {"data":"numeracion"},
            {"data":"nombre_categoria_carrera"},
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
    //Nueva Categoria Carrera
	var formNuevaCategoria = document.querySelector("#formCategoriaNueva");
	formNuevaCategoria.onsubmit = function(e) {
		e.preventDefault();
        document.querySelector("#idCategoriaNueva").value = 1;
		var strNombre = document.querySelector('#txtNombreCategoriaNueva').value;
		//var intEstatus = document.querySelector('#listEstatusCategoriaNueva').value;
		if (strNombre == '')
		{
			swal.fire("Atención", "Atención todos los campos son obligatorios", "warning");
			return false;
		}
		var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
		var ajaxUrl = base_url+'/CategoriaCarrera/setCategioriaCarrera';
		var formData = new FormData(formNuevaCategoria);
		request.open("POST",ajaxUrl,true);
		request.send(formData);
		request.onreadystatechange = function() {
			if(request.readyState == 4 && request.status == 200) {
				var objData = JSON.parse(request.responseText);
				if(objData.estatus)
				{
					$('#ModalFormNuevaCategoriaCarrera').modal("hide");
					formNuevaCategoria.reset();	
					swal.fire("Categorias", objData.msg, "success").then((result) =>{
                        $('#dimissModalNuevo').click();
                    });
					tableCategoriasCarreras.api().ajax.reload()
					
				}else{
					swal.fire("Error", objData.msg, "error");
				}
			}
            return false;
		}
	}
});
$('#tableCategoriaCarreras').DataTable();

//Funcion para Ver Categoria Carrera
/* function fntVerCategoriaCarrera(val){
    var idCategoriaCarrera = val;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl  = base_url+'/CategoriaCarrera/getCategoriaCarrera/'+idCategoriaCarrera;
    request.open("GET",ajaxUrl ,true);
	request.send();
    request.onreadystatechange = function(){

        if(request.readyState == 4 && request.status == 200){
            var objData = JSON.parse(request.responseText);
            if(objData){   
                document.querySelector('#titleModalVer').innerHTML = objData.nombre_categoria_carrera;
                document.querySelector('#txtNombreCategoriaVer').value = objData.nombre_categoria_carrera;
                if(objData.estatus == 1)
                {
                    document.querySelector('#listEstatusCategoriaVer').innerHTML = "<option>Activo</option>"
                }else{
                    document.querySelector('#listEstatusCategoriaVer').innerHTML = "<option>Inactivo</option>"
                }
            }else{
                swal.fire("Error", objData.msg , "error");
            }
            
        }
    }
} */

//Funcion para Editar Categoria Carrera
function fntEditCategoriaCarrera(idCategoria){
    var idCategoriaCarrera = idCategoria;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl  = base_url+'/CategoriaCarrera/getCategoriaCarrera/'+idCategoriaCarrera;
    request.open("GET",ajaxUrl ,true);
	request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var objData = JSON.parse(request.responseText);
            if(objData){   
                document.querySelector("#idCategoriaEdit").value = objData.id;
                document.querySelector("#txtNombreCategoriaEdit").value = objData.nombre_categoria_carrera;
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
                document.querySelector("#listEstatusCategoriaEdit").innerHTML = htmlSelect;
            }else{
                swal.fire("Error", objData.msg , "error");
            }
        }
    }
}

//Funcion para Guardar Datos Categoria Carrera edit
var formEditCategoriaCarrera = document.querySelector("#formCategoriaEdit");
formEditCategoriaCarrera.onsubmit = function(e){
    e.preventDefault();
    var strNombre = document.querySelector('#txtNombreCategoriaEdit').value;
    var intEstatus = document.querySelector('#listEstatusCategoriaEdit').value;
    if (strNombre == '' || intEstatus == '')
    {
        swal.fire("Atención", "Atención todos los campos son obligatorios", "warning");
        return false;
    }
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+'/CategoriaCarrera/setCategioriaCarrera';
    var formData = new FormData(formEditCategoriaCarrera);
    request.open("POST",ajaxUrl,true);
    request.send(formData);
    request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status == 200) {
            var objData = JSON.parse(request.responseText);
            if(objData.estatus){
                $('#ModalFormEditCategoriaCarrera').modal("hide");
                formEditCategoriaCarrera.reset();
                swal.fire("Categorias", objData.msg, "success").then((result) =>{
                    $('#dimissModalEdit').click();
                });
                tableCategoriasCarreras.api().ajax.reload();  
            }else{
                swal.fire("Error", objData.msg, "error");
            }
        }
        return false;
    }
}

//Funcion para Eliminar Categoria Carreras
function fntDelCategoriaCarrera(id) {
    swal.fire({
        icon: "question",
        title: "Eliminar categoría",
        text: "¿Realmente quiere eliminar la categoría?",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33', 
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!"
    }). then((result) => {
        if (result.isConfirmed) 
        {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url+'/CategoriaCarrera/delCategoriaCarrera'; 
            var strData = "idCategoriaCarrera="+id;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    var objData = JSON.parse(request.responseText);
                    if(objData.estatus)
                    {
                        swal.fire("Eliminado!", objData.msg , "success");
                        tableCategoriasCarreras.api().ajax.reload();

                    } else {
                        swal.fire("Atención!", objData.msg , "error");

                    }
                }
            }
        }
    });
}


