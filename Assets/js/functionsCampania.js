let tableCampanias;
let rowTable = "";
let divLoading = document.querySelector("#divLoading");


document.addEventListener('DOMContentLoaded', function(){
	tableCampanias = $('#tableCampanias').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
			"language": {
				"url": " "+base_url+"/Assets/plugins/Spanish.json"
			},
			"ajax":{
					"url": " "+base_url+"/Campania/getCampanias",
					"dataSrc":""
			},
			"columns":[
					{"data":"id"},
					{"data":"nombre_campania"},
					{"data":"fecha_inicio"},
					{"data":"fecha_fin"},
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
			"iDisplayLength": 25,
			"order": [[0,"asc"]]
	});


	// Crear
	if(document.querySelector("#formCampanias")){
		let formCampanias = document.querySelector("#formCampanias");
		formCampanias.onsubmit = function(e) {
			e.preventDefault();

					let intIdCampania = document.querySelector("#idCampanias").value;
	      	let strNombreCampania = document.querySelector("#txtNombreCampanias").value;
	       	let strFechaInicio = document.querySelector("#txtFechaInicio").value;
	      	let strFechaFin = document.querySelector("#txtFechaFin").value;
	      	let intEstatus = document.querySelector("#listaEstatus").value;
	      	let strFechaCreacion = document.querySelector("#txtFechaCreacion").value;
	      	let strFechaActualizacion = document.querySelector("#txtFechaActualizacion").value;
	      	let intIdUsuarioCreacion = document.querySelector("#txtIdUsuarioCreacion").value;
	      	let intIdUsuarioActualizacion = document.querySelector("#txtIdUsuarioActualizacion").value;
					let intPresupuesto = document.querySelector("#txtPresupuesto").value;

			if(strNombreCampania == '' || strFechaInicio == '' || strFechaFin == '' || intEstatus == '' || strFechaCreacion == '' || intIdUsuarioCreacion == '' || intPresupuesto == '')
			{
					swal.fire("Atención", "Todos los campos son obligatorios." , "warning");
					return false;
			}
			divLoading.style.display = "flex";
			let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
			let ajaxUrl = base_url+'/Campania/setCampanias';
			let formData = new FormData(formCampanias);
			request.open("POST",ajaxUrl,true);
			request.send(formData);
			request.onreadystatechange = function() {
					if(request.readyState == 4 && request.status == 200) {
						let objData = JSON.parse(request.responseText);
						if(objData.estatus)
						{
							$('#modalformCampanias').modal("hide");
							formCampanias.reset();
							swal.fire("Campaña", objData.msg, "success");
							tableCampanias.api().ajax.reload();
						}else{
							swal.fire("Error", objData.msg, "error");
						}
					}
					divLoading.style.display = "none";
					return false;
			}
		}
	}



	// Actualizar
	if(document.querySelector("#formCampaniasup")){
		let formCampaniasup = document.querySelector("#formCampaniasup");
			formCampaniasup.onsubmit = function(e) {
					e.preventDefault();

					let intIdCampania = document.querySelector('#idCampaniasUp').value;
			    let strNombreCampania = document.querySelector('#txtNombreCampaniasUp').value;
			    let intEstatus = document.querySelector('#listEstatusUp').value;
			    let intIdUsuarioActualizacion = document.querySelector('#txtIdUsuarioActualizacionUp').value;
					let strFechaInicioActualizacion = document.querySelector("#txtFechaInicioUp").value;
					let strFechaFinActualizacion =  document.querySelector("#txtFechaFinUp").value;
					let intPresupuesto = document.querySelector("#txtPresupuestoUp").value;

			    if(strNombreCampania == '' || intEstatus == '' || intIdUsuarioActualizacion == '' || strFechaInicioActualizacion == '' || strFechaFinActualizacion == '' || intPresupuesto == '')
					{
						swal.fire("Atención", "Atención todos los campos son obligatorios", "warning");
						return false;
					}

			divLoading.style.display = "flex";
			let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
			let ajaxUrl = base_url+'/Campania/setCampaniasUp';
			let formData = new FormData(formCampaniasup);
			request.open("POST",ajaxUrl,true);
			request.send(formData);

			request.onreadystatechange = function(){
					if(request.readyState == 4 && request.status == 200){

						let objData = JSON.parse(request.responseText);
						if(objData.estatus)
						{
							if(rowTable == ""){
									tableCampanias.api().ajax.reload();
							}else{
									htmlEstatus = intEstatus == 1 ?
									'<span class="badge badge-dark">Activo</span>' :
									'<span class="badge badge-secondary">Inactivo</span>';
									rowTable.cells[1].textContent = strNombreCampania;
									rowTable.cells[4].innerHTML = htmlEstatus;
									rowTable = "";
							}

							$('#modalFormCampaniasEditar').modal('hide');
							formCampaniasup.reset();
							swal.fire("Campaña", objData.msg, "success");

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



function fntEditCampanias(element,id){
	rowTable = element.parentNode.parentNode.parentNode.parentNode.parentNode;
	let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	let ajaxUrl = base_url+'/Campania/getCampania/'+id;
	request.open("GET",ajaxUrl,true);
	request.send();

	request.onreadystatechange = function(){
		if(request.readyState == 4 && request.status == 200){

			let objData = JSON.parse(request.responseText);

			if(objData.estatus){
					document.querySelector("#idCampaniasUp").value = objData.data.id;
					document.querySelector("#txtNombreCampaniasUp").value = objData.data.nombre_campania;
					document.querySelector("#txtFechaInicioUp").value = objData.data.fecha_inicio;
					document.querySelector("#txtFechaFinUp").value = objData.data.fecha_fin;
					document.querySelector("#txtPresupuestoUp").value = objData.data.presupuesto;
					document.querySelector("#txtIdUsuarioActualizacionUp").value = 1;

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
					$('#modalFormCampaniasEditar').modal('show');

			}else{
					swal.fire("Error", objData.msg , "error");
			}
		}
	}
}



function openModal(){
	rowTable = "";
	$('#modalformCampanias').modal({
		backdrop: 'static',
		keyboard: false,
	});

	$('#modalformCampanias').modal('show');
}


$(".cerrarModal").click(function(){
	$("#modalformCampanias").modal('hide')
});


$(".cerrarModal").click(function(){
	$("#modalFormCampaniasEditar").modal('hide')
});


function fntDelCampania(id) {
    swal.fire({
        icon: "question",
        title: "Eliminar Categoría",
        text: "¿Realmente quiere eliminar la Campaña seleccionada?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#045FB4',
		cancelButtonColor: '#d33',
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!"
    }). then((result) => {

        if (result.isConfirmed)
        {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Campania/delCampania';
            let strData = "idCampanias="+id;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.estatus)
                    {
                        swal.fire("Eliminar!", objData.msg , "success");
                        tableCampanias.api().ajax.reload();
                    } else {
                        swal.fire("Atención!", objData.msg , "error");
                    }
                }
            }
        }
    });
}
