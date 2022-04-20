let tableGeneraciones;
let rowTable = "";
let divLoading = document.querySelector("#divLoading");


document.addEventListener('DOMContentLoaded', function(){

	tableGeneraciones = $('#tableGeneraciones').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	//url:"<?php echo media(); ?>/plugins/Spanish.json"
        	"url": " "+base_url+"/Assets/plugins/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Generacion/getGeneraciones",
            "dataSrc":""
        },
        "columns":[
            {"data":"numeracion"},
            {"data":"nomGen"},
            {"data":"fechIn"},
			{"data":"fechFin"},
            {"data":"est"},
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


	//Nueva Generacion
	if(document.querySelector("#formGeneracion")){
		let formGeneracion = document.querySelector("#formGeneracion");
		formGeneracion.onsubmit = function(e){
			e.preventDefault();
			let intIdGeneraciones = document.querySelector('#idGeneraciones').value;
			let strNombre_Generacion = document.querySelector('#txtNombre_Generacion').value;
			let strFecha_inicio = document.querySelector('#txtFecha_inicio').value;
			let strFecha_fin = document.querySelector('#txtFecha_fin').value;
			let intEstatus = document.querySelector('#listEstatus').value;
			let intId_usuario_creacion = document.querySelector('#txtId_usuario_creacion').value;
			let intId_Usuario_Actualizacion = document.querySelector('#txtId_Usuario_Actualizacion').value;
			let strFecha_Creacion = document.querySelector('#txtFecha_Creacion').value;
			let strFecha_Actualizacion = document.querySelector('#txtFecha_Actualizacion').value;

			if (strNombre_Generacion == '' || strFecha_inicio == '' || strFecha_fin == '' || intEstatus == '' || strFecha_Creacion =='' || intId_usuario_creacion =='')
			{
				swal.fire("Atención", "Atención todos los campos son obligatorios", "warning");
				return false;
			}
			divLoading.style.display = "flex";
			let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
			let ajaxUrl = base_url+'/Generacion/setGeneracion';
			let formData = new FormData(formGeneracion);
			request.open("POST",ajaxUrl,true);
			request.send(formData);
			request.onreadystatechange = function() {
				
				if (request.readyState == 4 && request.status == 200) {
					let objData = JSON.parse(request.responseText);
				if (objData.estatus)
					{
						$('#ModalFormGeneracion').modal("hide");
						formGeneracion.reset();
						swal.fire("Generaciones de usuario", objData.msg, "success");
						tableGeneraciones.api().ajax.reload();

					}else{
						swal.fire("Error",objData.msg, "error");
					}
				}
				divLoading.style.display = "none";
				return false;
			}
		}
	}

	// Actualizar
	if(document.querySelector("#formGeneracionesUp")){
		let formGeneracionesUp = document.querySelector("#formGeneracionesUp");
		formGeneracionesUp.onsubmit = function(e) {
			e.preventDefault();

			let intIdGeneraciones = document.querySelector('#idGeneracionesUp').value;
			let strNombre_Generacion = document.querySelector('#txtNombre_GeneracionUp').value;
			let strFecha_inicio = document.querySelector('#txtFecha_inicioUp').value;
			let strFecha_fin = document.querySelector('#txtFecha_finUp').value;
			let intEstatus = document.querySelector('#listEstatusUp').value;
			let strFecha_Actualizacion = document.querySelector('#txtFecha_ActualizacionUp').value;
			let intId_Usuario_Actualizacion = document.querySelector('#txtId_Usuario_ActualizacionUp').value;

			if(strNombre_Generacion == '' || strFecha_inicio == '' || strFecha_fin == '' || intEstatus == '' || intId_Usuario_Actualizacion == '')
			{
				swal.fire("Atención", "Atención todos los campos son obligatorios", "warning");
				return false;
			} 
			
			divLoading.style.display = "flex";
			let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
			let ajaxUrl = base_url+'/Generacion/setGeneraciones_up';
			let formData = new FormData(formGeneracionesUp);
			request.open("POST",ajaxUrl,true);
			request.send(formData);

			request.onreadystatechange = function(){
				if(request.readyState == 4 && request.status == 200){
					
					let objData = JSON.parse(request.responseText);
					if(objData.estatus)
					{
						if(rowTable == ""){
							tableGeneraciones.api().ajax.reload();
						}else{
							htmlEstatus = intEstatus == 1 ?
							'<span class="badge badge-dark">Activo</span>' :
							'<span class="badge badge-secondary">Inactivo</span>';
							rowTable.cells[1].textContent = strNombre_Generacion;
							rowTable.cells[2].textContent = strFecha_inicio;
							rowTable.cells[3].textContent = strFecha_fin;
							rowTable.cells[4].innerHTML = htmlEstatus;
							rowTable = "";
						}
																			
						$('#ModalFormGeneracionEditar').modal('hide');
						formGeneracionesUp.reset();	
						swal.fire("Generaciones ", objData.msg, "success");

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

$('#tableGeneraciones').DataTable();
//ABRIR MODAL
function openModal() {
	document.querySelector('#idGeneraciones').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nueva generación";
    document.querySelector("#formGeneracion").reset();
	$('#ModalFormGeneracion').modal('show');
}

window.addEventListener('load', function() {
	//fntEditGeneracion();
	//fntDelGeneracion();
   //fntPermisos();
}, false);



//EDITAR GENERACIÓN
function fntEditGeneraciones(element,id){
	rowTable = element.parentNode.parentNode.parentNode.parentNode.parentNode;
	let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	let ajaxUrl = base_url+'/Generacion/getGeneracion/'+id;
	request.open("GET",ajaxUrl,true);
	request.send();
	request.onreadystatechange = function(){
		if(request.readyState == 4 && request.status == 200){

			let objData = JSON.parse(request.responseText);
			if(objData.estatus){
				//console.log("hola mundo");
					document.querySelector("#idGeneracionesUp").value = objData.data.id;
					document.querySelector("#txtNombre_GeneracionUp").value = objData.data.nombre_generacion;
					document.querySelector("#txtFecha_inicioUp").value = objData.data.fecha_inicio_gen;
					document.querySelector("#txtFecha_finUp").value = objData.data.fecha_fin_gen;
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
					$('#ModalFormGeneracionEditar').modal('show');

			}else{
					swal.fire("Error", objData.msg , "error");
			}
		}
	}
}

//FUNCION ELIMINAR
function fntDelGeneraciones(id){
	swal.fire({
        icon: "question",
        title: "Eliminar generación",
        text: "¿Realmente quiere eliminar la generación seleccionada?",
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
            let ajaxUrl = base_url+'/Generacion/delGeneraciones';
            let strData = "idGeneraciones="+id;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.estatus)
                    {
                        swal.fire("Eliminar!", objData.msg, "success");
                        tableGeneraciones.api().ajax.reload();
                    }else{
                        swal.fire("Atención!", objData.msg, "error");
                    }
                }
            }
        }
    });
}

// function fntDelGeneraciones(id){
//     swal.fire({
//         icon: "question",
//         title: "Eliminar generación",
//         text: "¿Realmente quiere eliminar la generación seleccionada?",
//         type: "warning",
//         showCancelButton: true,
//         confirmButtonColor: '#045FB4',
// 		cancelButtonColor: '#d33',
//         confirmButtonText: "Si, eliminar!",
//         cancelButtonText: "No, cancelar!"
//     }). then((result) =>{

//         if(result.isConfirmed)
//         {
//             let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
//             let ajaxUrl = base_url+'/Generacion/delGeneraciones';
//             let strData = "idGen="+id;
//             request.open("POST",ajaxUrl,true);
//             request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//             request.send(strData);
//             request.onreadystatechange = function(){
//                 if(request.readyState == 4 && request.status == 200){
//                     let objData = JSON.parse(request.responseText);
//                     if(objData.estatus)
//                     {
//                         swal.fire("Eliminar!", objData.msg, "success");
//                         tablePeriodos.api().ajax.reload();
//                     }else{
//                         swal.fire("Atención", objData.msg, "error");
//                     }
//                 }
//             }
//         }
//     });
// }


//PARA ABRIR MODAL
/* function openModal(){
	rowTable = "";
	$('#ModalFormGeneracion').modal({
		backdrop: 'static',
		keyboard: false,
	});

	$('#ModalFormGeneracion').modal('show');
} */

//CERAR MODAL AL CANCELAR DE NUEVO
$('.cerrarModal').click(function(){
	$('#ModalFormGeneracion').modal('hide')
});

//CERAR MODAL AL CANCELAR DE EDITAR
$('.cerrarModal').click(function(){
	$('#ModalFormGeneracionEditar').modal('hide')
});