let tableCategoria_servicios;
let rowTable = "";
let divLoading = document.querySelector("#divLoading");


document.addEventListener('DOMContentLoaded', function () {
	tableCategoria_servicios = $('#tableCategoria_servicios').dataTable({
		"aProcessing": true,
		"aServerSide": true,
		"language": {
			"url": " " + base_url + "/Assets/plugins/Spanish.json"
		},
		"ajax": {
			"url": " " + base_url + "/Categoria_servicios/getCategoria_servicios",
			"dataSrc": ""
		},
		"columns": [
			{ "data": "numeracion" },
			{ "data": "clave_categoria" },
			{ "data": "nombre_categoria" },
			{ "data": "aplica_colegiatura" },
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

	document.getElementById('chk_aplica_colegiatura').onclick = function () {
		if (this.checked) {
			document.querySelector("#chk_aplica_colegiatura").value = 1;
		} else {
			document.querySelector("#chk_aplica_colegiatura").value = 0;
		}
	};
	document.getElementById('chk_aplica_colegiatura_edit').onclick = function () {
		if (this.checked) {
			document.querySelector("#chk_aplica_colegiatura_edit").value = 1;
		} else {
			document.querySelector("#chk_aplica_colegiatura_edit").value = 0;
		}
	};


	// Crear
	if (document.querySelector("#formCategoria_servicios")) {
		let formCategoria_servicios = document.querySelector("#formCategoria_servicios");
		formCategoria_servicios.onsubmit = function (e) {
			e.preventDefault();
			let intIdCategoria_servicios = document.querySelector('#idCategoria_servicios').value;
			let strClave_categoria = document.querySelector('#txtClave_categoria').value;
			let strNombre_categoria = document.querySelector('#txtNombre_categoria').value;
			let intEstatus = document.querySelector('#listEstatus').value;

			if (intIdCategoria_servicios == '' || strClave_categoria == '' || strNombre_categoria == '' || intEstatus == '') {
				swal.fire("Atención", "Todos los campos son obligatorios.", "warning");
				return false;
			}

			divLoading.style.display = "flex";
			let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
			let ajaxUrl = base_url + '/Categoria_servicios/setCategoria_servicios';
			let formData = new FormData(formCategoria_servicios);
			request.open("POST", ajaxUrl, true);
			request.send(formData);
			request.onreadystatechange = function () {
				if (request.readyState == 4 && request.status == 200) {
					let objData = JSON.parse(request.responseText);
					if (objData.estatus) {
						$('#modalFormCategoria_servicios').modal("hide");
						formCategoria_servicios.reset();
						swal.fire("Categoría de servicios", objData.msg, "success");
						tableCategoria_servicios.api().ajax.reload();
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
	if (document.querySelector("#formCategoria_serviciosup")) {
		let formCategoria_serviciosup = document.querySelector("#formCategoria_serviciosup");
		formCategoria_serviciosup.onsubmit = function (e) {
			e.preventDefault();
			let intIdCategoria_servicios = document.querySelector('#idCategoria_serviciosup').value;
			let strClave_categoria = document.querySelector('#txtClave_categoriaup').value;
			let strNombre_categoria = document.querySelector('#txtNombre_categoriaup').value;
			let intEstatus = document.querySelector('#listEstatusup').value;
			let intAplica_colegiatura = document.querySelector('#chk_aplica_colegiatura_edit').value;
			if (intIdCategoria_servicios == '' || strClave_categoria == '' || strNombre_categoria == '' || intEstatus == '' || intAplica_colegiatura == '') {
				swal.fire("Atención", "Atención todos los campos son obligatorios", "warning");
				return false;
			}

			divLoading.style.display = "flex";
			let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
			let ajaxUrl = base_url + '/Categoria_servicios/setCategoria_servicios_up';
			let formData = new FormData(formCategoria_serviciosup);
			request.open("POST", ajaxUrl, true);
			request.send(formData);
			request.onreadystatechange = function () {
				if (request.readyState == 4 && request.status == 200) {
					let objData = JSON.parse(request.responseText);
					if (objData.estatus) {
						tableCategoria_servicios.api().ajax.reload();
						$('#modalFormCategoria_servicios_editar').modal('hide');
						formCategoria_serviciosup.reset();
						swal.fire("Categoría servicios", objData.msg, "success");

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



function fntEditCategoria_servicios(element, id) {
	rowTable = element.parentNode.parentNode.parentNode.parentNode.parentNode;
	//console.log(rowTable);
	let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	let ajaxUrl = base_url + '/Categoria_servicios/getCategoria_servicio/' + id;
	request.open("GET", ajaxUrl, true);
	request.send();

	request.onreadystatechange = function () {
		if (request.readyState == 4 && request.status == 200) {

			let objData = JSON.parse(request.responseText);
			if (objData.estatus) {
				document.querySelector("#idCategoria_serviciosup").value = objData.data.id;
				document.querySelector('#txtClave_categoriaup').value = objData.data.clave_categoria;
				document.querySelector("#txtNombre_categoriaup").value = objData.data.nombre_categoria;
				if(objData.data.colegiatura == 1){
					document.querySelector('#chk_aplica_colegiatura_edit').checked = true;
					document.querySelector('#chk_aplica_colegiatura_edit').value = 1;
				}else{
					document.querySelector('#chk_aplica_colegiatura_edit').checked = false;
					document.querySelector('#chk_aplica_colegiatura_edit').value = 0;
				}
				document.querySelector('#listEstatusup').querySelector('option[value="'+objData.data.estatus+'"]').selected = true;
				$('#modalFormCategoria_servicios_editar').modal('show');

			} else {
				swal.fire("Error", objData.msg, "error");
			} 
		}
	}
}



function openModal() {
	rowTable = "";
	$('#modalFormCategoria_servicios').modal({
		backdrop: 'static',
		keyboard: false,
	});

	$('#modalFormCategoria_servicios').modal('show');
}


$(".cerrarModal").click(function () {
	$("#modalFormCategoria_servicios").modal('hide');
	$("#modalFormCategoria_servicios_editar").modal('hide');
});



function fntDelCategoria_servicios(id) {
	swal.fire({
		icon: "question",
		title: "Eliminar Categoría",
		text: "¿Realmente quiere eliminar la categoría seleccionada?",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: '#045FB4',
		cancelButtonColor: '#d33',
		confirmButtonText: "Si, eliminar!",
		cancelButtonText: "No, cancelar!"
	}).then((result) => {

		if (result.isConfirmed) {
			let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
			let ajaxUrl = base_url + '/Categoria_servicios/delCategoria_servicios';
			let strData = "idCategoria_servicios=" + id;
			request.open("POST", ajaxUrl, true);
			request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			request.send(strData);
			request.onreadystatechange = function () {
				if (request.readyState == 4 && request.status == 200) {
					let objData = JSON.parse(request.responseText);
					if (objData.estatus) {
						swal.fire("Eliminar!", objData.msg, "success");
						tableCategoria_servicios.api().ajax.reload();
					} else {
						swal.fire("Atención!", objData.msg, "error");
					}
				}
			}
		}
	});
}
