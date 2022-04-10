let tableTurnos 
const formNuevoTurno = document.querySelector('#formTurnoNuevo')
const formEditTurno = document.querySelector('#formTurnoEdit')

document.addEventListener('DOMContentLoaded', function(){
	tableTurnos = $('#tableTurnos').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": " "+base_url+"/Assets/plugins/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Turnos/getTurnos",
            "dataSrc":""
        },
        "columns":[
			{"data": "numeracion"},
			{"data": "nombre_turno"},
			{"data": "abreviatura"},
			{"data": "hora_entrada"},
            {"data": "hora_salida"},
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
$('#tableTurnos').DataTable();

function fnNuevoTurno()
{
	document.querySelector('#idTurnoNuevo').value = 1;
}

//Nuevo turno
formNuevoTurno.addEventListener('submit', (e) =>{
	e.preventDefault()
	let idNuevoTurno = document.querySelector('#idTurnoNuevo')
	strNombreTurno = document.querySelector('#txtAbreviatura').value
	strAbreviatura = document.querySelector('#txtTurnoNuevo').value
	strHoraEntrada = document.querySelector('#txtHoraEnt').value
	strHoraSalida = document.querySelector('#txtHoraSal').value
	if(strNombreTurno == "" || strAbreviatura == "" || strHoraEntrada == "" || strHoraSalida == "")
	{
		swal.fire("Atención","Atención todos los campos son obligatorios","warning");
        return false;
	}
	idNuevoTurno.value = 1 
	const datosNuevo = new FormData(document.getElementById('formTurnoNuevo'))
	let url = `${base_url}/Turnos/setTurnos/`

	fetch(url, {
		method: 'POST',
		body: datosNuevo
	})
	.then(response => response.json())
	.then(data => {
		if(data.estatus)
		{
			$('#cancelarModalNTurno').click()
			formNuevoTurno.reset()
			swal.fire('Turnos', data.msg, 'success')
			tableTurnos.api().ajax.reload()
		}
		else
		{
			swal.fire('Error', data.msg, 'error')
		}
	})

	.catch(function (err){
		console.log('Error ',err)
	})
})

formEditTurno.addEventListener('submit', (e) => {
	e.preventDefault()
	const datos = new FormData(document.getElementById('formTurnoEdit'))
	let url = `${base_url}/Turnos/setTurnos/`

	fetch(url, {
		method: 'POST',
		body: datos
	})

	.then(response => response.json())
	.then(data => {
		if(data.estatus)
		{
			console.log(data)
			$('#cancelarModalTurnoEdit').click()
			formEditTurno.reset()
			swal.fire('Turnos', data.msg, 'success')
			tableTurnos.api().ajax.reload()
		}
		else
		{
			swal.fire('Error', data.msg, 'error')
		}
	})

	.catch(function (err){
		console.log('Error: ', err)
	})
})

function fnEditarTurno(idTrn){
	let idTurno = idTrn
	let url = `${base_url}/Turnos/getTurno/${idTurno}`
	let txtNombreTurno = document.querySelector('#txtTurnoEdit') 
	let txtAbreviatura = document.querySelector('#txtAbreviaturaEdit')
	let txtHoraEntrada = document.querySelector('#txtHoraEntEdit')
	let txtHoraSalida = document.querySelector('#txtHoraSalEdit')
	let lun = document.querySelector('#chkLunesEdit')
	let mar = document.querySelector('#chkMartesEdit')
	let mie = document.querySelector('#chkMiercolesEdit')
	let jue = document.querySelector('#chkJuevesEdit')
	let vie = document.querySelector('#chkViernesEdit')
	let sab = document.querySelector('#chkSabadoEdit')
	let dom = document.querySelector('#chkDomingoEdit')
	let estatus = document.querySelector('#slctEstatusTurnoEdit')
	fetch(url)
		.then(response => response.json())
		.then(data => {
			if(data.estatus)
			{
				let txtId = document.querySelector('#idTurnoEdit')
				console.log(data)
				txtId.value = data.data.id
				txtNombreTurno.value = data.data.nombre_turno
				txtAbreviatura.value = data.data.abreviatura
				txtHoraEntrada.value = data.data.hora_entrada
				txtHoraSalida.value = data.data.hora_salida
				data.data.lu == 1 ? lun.checked = true : lun.checked = false
				data.data.ma == 1 ? mar.checked = true : mar.checked = false
				data.data.mi == 1 ? mie.checked = true : mie.checked = false
				data.data.ju == 1 ? jue.checked = true : jue.checked = false
				data.data.vi == 1 ? vie.checked = true : vie.checked = false
				data.data.sa == 1 ? sab.checked = true : sab.checked = false
				data.data.do == 1 ? dom.checked = true : dom.checked = false
				if(data.data.estatus == 1)
				{
					estatus.text = "Activo"
					estatus.value = "1"
				}
				else
				{
					estatus.text = "Inactivo"
					estatus.value = "2"
				}
			}
		})
		.catch(err => console.log('Error: ',err))
}

function fnEliminarTurno(idTrn)
{
	var idTurno = idTrn
	swal.fire({
		icon: "question",
		title: "Eliminar turno",
		text: "¿Quiere eliminar el turno?",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: '#3085d6', //add
		cancelButtonColor: '#d33', //add
		confirmButtonText: "¡Si, eliminar!",
		cancelButtonText: "¡No, cancelar!"
	}). then ((result) =>{
		if(result.isConfirmed)
		{
			let url = `${base_url}/Turnos/delTurno?id=${idTurno}`
			fetch(url)
				.then(response => response.json())
				.then(data => {
					if(data.estatus)
					{
						swal.fire('¡Elimnado!', data.msg, 'success')
						tableTurnos.api().ajax.reload()
					}
				})
		}
	})
}