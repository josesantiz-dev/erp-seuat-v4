let tableUnidadMedida;
let rowTable = "";
let divLoading = document.querySelector("#divLoading");

document.addEventListener('DOMContentLoaded', function () {
	tableUnidadMedida = $('#tableUnidadMedida').dataTable({
		"aProcessing": true,
		"aServerSide": true,
		"language": {
			"url": " " + base_url + "/Assets/plugins/Spanish.json"
		},
		"ajax": {
			"url": " " + base_url + "/Unidad_medida/getUnidad_medidas",
			"dataSrc": ""
		},
		"columns": [
			{ "data": "numeracion" },
			{ "data": "tipo" },
			{ "data": "clave" },
			{ "data": "nombre_unidad_medida" },
			{ "data": "estatus" },
			{ "data": "options" }

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
		"order": [[0, "asc"]]
	});

	// Crear
	if (document.querySelector("#formUnidad_medida")) {
		let formUnidad_medida = document.querySelector("#formUnidad_medida");
		formUnidad_medida.onsubmit = function (e) {
			e.preventDefault();
			let intIdUnidadMedida = document.querySelector('#idUnidad_medida').value;
			let intEstatus = document.querySelector('#listEstatus').value;
			let strTipo = document.querySelector('#txtTipo').value;
			let strClave = document.querySelector('#txtClave').value;
			let strNombre = document.querySelector('#txtNombre').value;
			if (intEstatus == '' || strTipo == '' || strClave == '' || strNombre == '') {
				swal.fire("Atención", "Todos los campos son obligatorios.", "warning");
				return false;
			}
			divLoading.style.display = "flex";
			let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
			let ajaxUrl = base_url + '/Unidad_medida/setUnidad_medida';
			let formData = new FormData(formUnidad_medida);
			request.open("POST", ajaxUrl, true);
			request.send(formData);
			request.onreadystatechange = function () {
				if (request.readyState == 4 && request.status == 200) {
					let objData = JSON.parse(request.responseText);
					if (objData.estatus) {
						$('#modalFormUnidad_medida').modal("hide");
						formUnidad_medida.reset();
						swal.fire("Unidad de medida", objData.msg, "success");
						tableUnidadMedida.api().ajax.reload();
					} else {
						swal.fire("Error", objData.msg, "error");
					}
				}
				divLoading.style.display = "none";
				return false;
			}
		}
	}



	// Actualizar
	if (document.querySelector("#formUnidad_medida_editar")) {
		let formUnidad_medida_editar = document.querySelector("#formUnidad_medida_editar");
		formUnidad_medida_editar.onsubmit = function (e) {
			e.preventDefault();
			let intIdUnidadMedida = document.querySelector('#idUnidad_medidaup').value;
			let strTipo = document.querySelector('#txtTipoEdit').value;
			let strClave = document.querySelector('#txtClaveEdit').value;
			let strNombreUnidadMedida = document.querySelector('#txtNombreEdit').value;
			let intEstatus = document.querySelector('#listEstatusEdit').value;
			if (intIdUnidadMedida == '' || strTipo == '' || strClave == '' || strNombreUnidadMedida == '' || intEstatus == '') {
				swal.fire("Atención", "Atención todos los campos son obligatorios", "warning");
				return false;
			}

			divLoading.style.display = "flex";
			let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
			let ajaxUrl = base_url + '/Unidad_medida/setUnidad_medida_up';
			let formData = new FormData(formUnidad_medida_editar);
			request.open("POST", ajaxUrl, true);
			request.send(formData);
			request.onreadystatechange = function () {
				if (request.readyState == 4 && request.status == 200) {
					let objData = JSON.parse(request.responseText);
					if (objData.estatus) {
						$('#modalFormUnidad_medida_editar').modal('hide');
						formUnidad_medida_editar.reset();
						swal.fire("Unidad de medida", objData.msg, "success");
						tableUnidadMedida.api().ajax.reload();

					} else {
						swal.fire("Error", objData.msg, "error");
					}
				}
				divLoading.style.display = "none";
				return false;
			}
		}
	}

}, false);




function fntEditUnidad_medida(element, id) {
	rowTable = element.parentNode.parentNode.parentNode.parentNode.parentNode;
	let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	let ajaxUrl = base_url + '/Unidad_medida/getUnidad_medida/' + id;
	request.open("GET", ajaxUrl, true);
	request.send();
	request.onreadystatechange = function () {
		if (request.readyState == 4 && request.status == 200) {
			let objData = JSON.parse(request.responseText);
			if (objData.estatus) {
				document.querySelector("#idUnidad_medidaup").value = objData.data.id;
				document.querySelector("#txtTipoEdit").value = objData.data.tipo;
				document.querySelector("#txtClaveEdit").value = objData.data.clave;
				document.querySelector("#txtNombreEdit").value = objData.data.nombre_unidad_medida;
				document.querySelector('#listEstatusEdit').querySelector('option[value="'+objData.data.estatus+'"]').selected = true;
				$('#modalFormUnidad_medida_editar').modal('show');

			} else {
				swal.fire("Error", objData.msg, "error");
			}
		}
	}
}


function openModal() {
	rowTable = "";
	$('#modalFormUnidad_medida').modal({
		backdrop: 'static',
		keyboard: false,
	});

	$('#modalFormUnidad_medida').modal('show');
}


$(".cerrarModal").click(function () {
	$("#modalFormUnidad_medida").modal('hide');
	$("#modalFormUnidad_medida_editar").modal('hide');

});


function fntDelUnidad_medida(id) {
	swal.fire({
		icon: "question",
		title: "Eliminar unidad de medida",
		text: "¿Realmente quiere eliminar la unidad de medida seleccionada?",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: '#045FB4',
		cancelButtonColor: '#d33',
		confirmButtonText: "Si, eliminar!",
		cancelButtonText: "No, cancelar!"
	}).then((result) => {
		if (result.isConfirmed) {
			let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
			let ajaxUrl = base_url + '/Unidad_medida/delUnidad_medida';
			let strData = "idUnidad_medida=" + id;
			request.open("POST", ajaxUrl, true);
			request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			request.send(strData);
			request.onreadystatechange = function () {
				if (request.readyState == 4 && request.status == 200) {
					let objData = JSON.parse(request.responseText);
					if (objData.estatus) {
						swal.fire("Eliminar!", objData.msg, "success");
						tableUnidadMedida.api().ajax.reload();
					} else {
						swal.fire("Atención!", objData.msg, "error");
					}
				}
			}
		}
	});
}





