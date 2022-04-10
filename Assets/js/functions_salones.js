let tableSalon;
const formNuevoSalon = document.querySelector('#formSalonNuevo');
const formSalonEdit = document.querySelector('#formSalonEdit');

//DataTable
document.addEventListener('DOMContentLoaded', function(){
	tableSalon = $('#tableSalon').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": " "+base_url+"/Assets/plugins/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Salones/getSalones",
            "dataSrc":""
        },
        "columns":[
			{"data": "numeracion"},
			{"data": "nombre_salon"},
			{"data": "cantidad_max_estudiantes"},
			{"data": "estatus"},
			{"data": "options"}
        ],
        "responsive": true,
	    "paging": true,
	    "lengthChange": true,
	    "searching": true,
	    "ordering": false,
	    "info": true,
	    "autoWidth": false,
	    "scrollY": '42vh',
	    "scrollCollapse": true,
	    "bDestroy": true,
	    "order": [[ 0, "asc" ]],
	    "iDisplayLength": 10
    });
});
$('#tableSalon').DataTable();

function fnNuevoSalon()
{
	document.querySelector('#idSalonNuevo'). value = 1
}

//Nuevo salón
formNuevoSalon.addEventListener('submit', (e) => {
	e.preventDefault()
	strSalonNuevo = document.querySelector('#txtNombreNuevo').value
	strCantidadMax = document.querySelector('#txtCantidadMax').value
	if(strSalonNuevo == '' || strCantidadMax == ''){
        swal.fire("Atención","Atención todos los campos son obligatorios","warning");
        return false;
    }
	let idNuevoSalon = document.querySelector('#idSalonNuevo')
	idNuevoSalon.value = 1
	const datosNuevo = new FormData(document.getElementById('formSalonNuevo'))
	let url = `${base_url}/Salones/setSalon/`
	
	fetch(url, {
		method: 'POST',
		body: datosNuevo
	})

	.then(response => response.json())
	.then(data => {
		console.log(data)
		if(data.estatus){
			$('#cancelarModalNuevo').click();
			formNuevoSalon.reset();
			swal.fire('Salones', data.msg, 'success');
			tableSalon.api().ajax.reload();
		}
		else{
			swal.fire('Error', data.msg, 'error');
			formNuevoSalon.reset()
		}
	})

	.catch(function (err){
		console.log(err);
	})
})

//Editar salón
formSalonEdit.addEventListener('submit', (e) =>{
	e.preventDefault()
	const datosEdit = new FormData(document.getElementById('formSalonEdit'))
	let url = `${base_url}/Salones/setSalon/`
	
	fetch(url, {
		method: 'POST',
		body: datosEdit
	})
	.then(response => response.json())
	.then(data => {
		console.log(data)
		if(data.estatus){
			$('#cancelarModalEdit').click()
			formSalonEdit.reset()
			swal.fire('Salones', data.msg, 'success')
			tableSalon.api().ajax.reload()
		}
		else{
			swal.fire('Error', data.msg,'error')
		}
	})
	.catch(function(err){
		console.log(err)
	})
})

function fnEditarSalon(idSln){
	var idSalon = idSln;
	let url = `${base_url}/Salones/getSalon/${idSalon}`;
	let txtNombreSalon = document.querySelector('#txtNombreEdit');
	let txtCantidadMax = document.querySelector('#txtCantidadMaxEdit');
	let slctEstatus = document.querySelector('#slctEstatus');
	fetch(url)
		.then(response => response.json())
		.then(data =>{
			if(data.estatus)
			{
				let txtId = document.querySelector('#idSalonEdit');
				console.log(data.data);
				txtId.value = data.data.id;
				txtNombreSalon.value = data.data.nombre_salon;
				txtCantidadMax.value = data.data.cantidad_max_estudiantes;
				if(data.data.estatus == 1)
				{
					slctEstatus.text = "Activo";
					slctEstatus.value = "1";
				}
				else
				{
					slctEstatus.text = "Inactivo"
					slctEstatus.value = "2"
				}
				//console.log(data);
			}
		})
		.catch(err => console.log('Error: ', err));
}

function fnEliminarSalon(idSln)
{
	var idSalon = idSln
	swal.fire({
		icon: "question",
		title: "Eliminar salón",
		text: "¿Quiere eliminar el salón?",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: '#3085d6', //add
		cancelButtonColor: '#d33', //add
		confirmButtonText: "Si, eliminar!",
		cancelButtonText: "No, cancelar!"
	}). then((result) => {
		if(result.isConfirmed){
			let url = `${base_url}/Salones/delSalon?id=${idSalon}`
			fetch(url)
				.then(response => response.json())
				.then(data => {
					if(data.estatus)
					{
						swal.fire('¡Eliminado!', data.msg,'success');
						tableSalon.api().ajax.reload();
					}
				})
		}
	})
}