let tableProspectos
let tableSegProspectoIndividual
let tableSeguimientoProspecto = document.querySelector('#tableSeguimientoProspecto')
const modalAgendarProspectoSeguimiento = document.querySelector('#ModalAgendarProspectoSeguimiento')
const formSeguimientoIndividual = document.querySelector('#formSeguimientoProspectoIndividual')

document.addEventListener('DOMContentLoaded', function(){
    tableSeguimientoProspecto = $('#tableSeguimientoProspecto').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": " "+base_url+"/Assets/plugins/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Seguimiento/getProspectos",
            "dataSrc":""
        },
        "columns":[
			{"data": "numeracion"},
			{"data": "nombre_completo"},
            {"data": "alias"},
			{"data": "tel_celular"},
			{"data": "plantel_interes"},
			{"data": "nombre_carrera"},
			{"data": "medio_captacion"},
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
})

$('tableSeguimientoProspecto').dataTable();

function ftnAgendar(id){
    let idAgendar = id
    document.querySelector('#idPersona').value = idAgendar
}

modalAgendarProspectoSeguimiento.addEventListener('submit', (e) =>{
    e.preventDefault()
    const agendatLlamada = new FormData(document.getElementById('formAgendar'))
    let url = `${base_url}/Seguimiento/setProgramarAgenda`;
    fetch(url, {
        method: 'POST',
        body: agendatLlamada
    })
    .then(res => res.json())
    .then((data) => {
        if(data.estatus){
            $('#cerrarModalAgendaProspectoSeguimiento').click()
            formAgendar.reset()
            swal.fire("Agendado", data.msg, "success")
        }else{
            swal.fire("Error", data.request , "error")
        }
    })
    .catch(err => {throw err})
})

function fnDarSeguimiento(idPer){
    let idPersona = idPer
	let url = `${base_url}/Seguimiento/getPersonaSeguimiento/${idPersona}`
	let idPers = document.querySelector('#idPersonaSeg')
	let idProspecto = document.querySelector('#idProspecto')
	let lblNombre = document.querySelector('#lblNombre')
	let lblTelefono = document.querySelector('#lblTel_celular')
	let lblEmail = document.querySelector('#lblEmail')
	let lblEstado = document.querySelector('#lblEstado')
	let lblMunicipio = document.querySelector('#lblMunicipio')
	let lblMedioPublicitario = document.querySelector('#lblMedioPublicitario')
	let lblNombreComisionista = document.querySelector('#lblNombreComisionista')
	let lblTelefonoComisionista = document.querySelector('#tel_celular_comisionista')
	let lblFecha = document.querySelector('#lblFecha')
	let lblNivelEducativo = document.querySelector('#lblNivelEducativo')
	let lblCarreraInteres = document.querySelector('#lblCarreraInteres')

    fetch(url)
        .then(response => response.json())
        .then(data=>{
            console.log(data)
            if(data.response.estatus)
            {
                idPers.value = data.datos.id
				idProspecto.value = data.datos.id_pro
				lblNombre.textContent = data.datos.nombre_persona
				lblEstado.textContent = data.datos.estado
				lblMunicipio.textContent = data.datos.municipio
				lblTelefono.textContent = data.datos.tel_celular
				lblEmail.textContent = data.datos.email
				lblNombreComisionista.textContent = data.datos.nombre_comisionista
				lblTelefonoComisionista.textContent = data.datos.tel_comisionista
				lblFecha.textContent = data.datos.fecha_creacion
				lblMedioPublicitario.textContent = data.datos.medio_captacion
				lblNivelEducativo.textContent = data.datos.nombre_nivel_educativo
				lblCarreraInteres.textContent = data.datos.nombre_carrera
            }
            tableSegProspectoIndividual = $('#tableSegProspectoIndividual').dataTable( {
				"aProcessing":true,
				"aServerSide":true,
				"language": {
					"url": " "+base_url+"/Assets/plugins/Spanish.json"
				},
				"ajax":{
					"url": " "+base_url+"/Seguimiento/getPersonaSeguimiento/"+idPersona,
					"dataSrc":"seguimiento"
				},
				"columns":[
					{"data": "fecha_de_seguimiento"},
					{"data": "respuesta_rapida"},
					{"data": "comentario"},
					{"data": "nombre_asesor"}
				],
				"responsive": true,
				"paging": false,
				"lengthChange": true,
				"searching": false,
				"ordering": false,
				"info": false,
				"autoWidth": false,
				//"scrollY": '42vh',
				"scrollCollapse": false,
				"bDestroy": true,
				"order": [[ 0, "asc" ]],
				"iDisplayLength": 10
			});

			$('#tableSegProspectoIndividual').DataTable();
        })
}

function fnSeguimientoInvidual(){
	
	let idPro = document.querySelector('#idProspecto').value
	console.log(idPro)
	document.querySelector('#idProsInd').value = idPro
	let respuestas = document.querySelector('#respuestasRapidas1')
	let respuestas2 = document.querySelector('#respuestasRapidas2')
	let url = `${base_url}/Seguimiento/getRespuestasRapidas`
	fetch(url)
		.then(response => response.json())
		.then(data => {
			respuestas.innerHTML = ""
			respuestas2.innerHTML = ""
			for (let i = 0; i < data.length; i++) {
				if(i<8)
				{
					respuestas.innerHTML += '<div class="text-danger">'+data[i]['respuesta_rapida']+'</div>'
				}
				if(i>9 && i<14)
				{
					respuestas2.innerHTML += '<div class="text-info">'+data[i]['respuesta_rapida']+'</div>'
				}
				if(i>15 && i<19)
				{
					respuestas2.innerHTML += '<div class="text-primary">'+data[i]['respuesta_rapida']+'</div>'
				}
				if(i>=19)
				{
					respuestas2.innerHTML += '<div class="text-success">'+data[i]['respuesta_rapida']+'</div>'
				}
			}
		})
		.catch(err => console.log(err))
}

formSeguimientoIndividual.addEventListener('submit', (e) =>{
	e.preventDefault()
	const datos = new FormData(document.querySelector('#formSeguimientoProspectoIndividual'))
	let url = `${base_url}/Seguimiento/setSeguimientoProspectoIndividual`
	fetch(url,{
		method: 'POST',
		body: datos
	})
		.then(response => response.json())
		.then(data =>{
			if(data.estatus)
			{
				$('#cancelarModalSegInd').click()
				formSeguimientoIndividual.reset()
				swal.fire('Seguimiento', data.msg,'success')
				tableSegProspectoIndividual.api().ajax.reload()
			}
			else
			{
				swal.fire('Error', data.msg,'error')
			}
		})
})

function fnEditarDatosProspecto(idPer){
	let idPersona = idPer
	let url = `${base_url}/Seguimiento/getProspecto/${idPersona}`
	let intIdPros = document.querySelector('#idProspectoEdit')
	let intIdPers = document.querySelector('#idPersonaEdit')
	let txtNombreEdit = document.querySelector('#txtNombreEdit')
	let txtApellidoPEdit = document.querySelector('#txtApellidoPatEdit')
	let txtApellidoMEdit = document.querySelector('#txtApellidoMatEdit')
	let txtTelCelular = document.querySelector('#txtTelefonoCelEdit')
	let txtCorreo = document.querySelector('#txtEmail')
	let slctPltInt = document.querySelector('#slctPlantelEdit')
	let slctNvlInt = document.querySelector('#slctNivelEstudiosEdit')
	let slctCrrInt = document.querySelector('#slctCarreraEdit')

	fetch(url)
		.then(response => response.json())
		.then(data => {
			console.log(data)
			intIdPros.value = data.pro_id
			intIdPers.value = data.per_id
			txtNombreEdit.value = data.nombre_persona
			txtApellidoPEdit.value = data.ap_paterno
			txtApellidoMEdit.value = data.ap_materno
			txtTelCelular.value = data.tel_celular
			txtCorreo.value = data.email
			slctPltInt.value = data.id_plantel_interes
			slctNvlInt.value = data.id_nivel_carrera_interes
			slctCrrInt.value = data.id_carrera_interes
		})
		//.catch(err => console.log(err))
}