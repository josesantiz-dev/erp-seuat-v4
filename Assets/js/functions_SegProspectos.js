let tableProspectos
let tableSegProspectoIndividual
let tableSeguimientoProspecto = document.querySelector('#tableSeguimientoProspecto')
const modalAgendarProspectoSeguimiento = document.querySelector('#ModalAgendarProspectoSeguimiento')
const formSeguimientoIndividual = document.querySelector('#formSeguimientoProspectoIndividual')
const slctCrr = document.querySelector('#slctCarreraEdit')
const slctCrrNvo = document.querySelector('#slctCarreraNuevoPro')
const formProspectoNuevo = document.querySelector('#formPersonaNuevo')
const formEditarDatosPros = document.querySelector('#formProspectoEdit')
const togglePassword = document.querySelector('#togglePassword')
const formLoginNvo = document.querySelector('#formNuevaSesion')


togglePassword.addEventListener('click',function(e){
	const type = document.querySelector('#txtPasswordNvaSesion').getAttribute('type') === 'password' ? 'text' : 'password';
	document.querySelector('#txtPasswordNvaSesion').setAttribute('type',type);
	this.classList.toggle('fa-eye-slash');
})


// formProspectoNuevo.addEventListener('submit', (e) =>{
// 	e.preventDefault()
// 	let url = `${base_url}/Seguimiento/setProspecto`
// 	const datos = new FormData(document.querySelector('#formPersonaNuevo'))
// 	console.log(url)
// 	fetch(url,{
// 		method:'POST',
// 		body:datos
// 	})
// 		.then(response => response.json())
// 		.then(data =>{
// 			if(data.estatus)
// 			{
// 				$('#dimissModalNvoProspecto').click()
// 				formProspectoNuevo.reset()
// 				$('#ModalNuevoProspecto').modal('hide')
// 				swal.fire('Nuevo prospecto creado', data.msg,'success')
// 				tableProspectos.api().ajax.reload()
// 			}
// 			else
// 			{
// 				swal.fire('Error',err,'error')
// 			}
// 		})
// 		.catch(function(err){
// 			swal.fire('Error',err,'error')
// 		})
// })

formLoginNvo.addEventListener('submit', (e) =>{
	e.preventDefault();
	//console.log('diste clic al boton de iniciar sesión')
	let url = `${base_url}/Seguimiento/addSesiones`;
	const datos = new FormData(document.querySelector('#formNuevaSesion'));
	fetch(url,{
		method: 'POST',
		body: datos
	})
	.then(response => response.json())
	.then(data => {
		console.log(data)
		if (data.estatus) {
			$("#salirModalLoginNvo").click();
			formLoginNvo.reset();
			swal.fire("Atención", data.msg, "success");
	    } else {
			swal.fire("Error", err, "error");
	    }
	})
	
	
})


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
			{"data": "nom_plantel_interes"},
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

function estadoSeleccionado(value){
	const selMunicipio = document.querySelector('#listMunicipioNuevo')
	let url = base_url+"/Seguimiento/getMunicipios?idestado="+value
	fetch(url)
		.then(res => res.json())
		.then((resultado) => {
			selMunicipio.innerHTML = ""
			for (let i = 0; i < resultado.length; i++) {
				opcion = document.createElement('option')
				opcion.text = resultado[i]['nombre']
				opcion.value = resultado[i]['id']
				selMunicipio.appendChild(opcion)
			}
		})
		.catch(err => {throw err})
}

function municipioSeleccionado(value){
	const selLocalidades = document.querySelector('#listLocalidadNuevo')
	let url = base_url+"/Seguimiento/getLocalidades?idmunicipio="+value
	fetch(url)
		.then(res => res.json())
		.then((resultado) => {
			selLocalidades.innerHTML = ""
			for (let i = 0; i < resultado.length; i++) {
				opcion = document.createElement('option')
				opcion.text = resultado[i]['nombre']
				opcion.value = resultado[i]['id']
				selLocalidades.appendChild(opcion)
			}
		})
		.catch(err => {throw err})
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

formEditarDatosPros.addEventListener('submit', (e) =>{
	e.preventDefault()
	const datos = new FormData(document.querySelector('#formProspectoEdit'))
	let url = `${base_url}/Seguimiento/editDatos`
	fetch(url,{
		method: 'POST',
		body: datos
	})
	.then(response => response.json())
	.then(data => {
		if(data.estatus){
			$('#cancelarModalEditDatosProspecto').click()
			formEditarDatosPros.reset()
			swal.fire('Editar datos prospecto', data.msg,'success')
			tableSeguimientoProspecto.api().ajax.reload()
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
			slctPltInt.value = data.plantel_interes
			slctNvlInt.value = data.id_nivel_carrera_interes
			slctCrrInt.value = data.id_carrera_interes
		})
		.catch(err => console.log(err))
}

function fnNuevoProspecto()
{
	let captacion1 = document.querySelector('#captacion1')
	let captacion2 = document.querySelector('#captacion2')
	let captacion3 = document.querySelector('#captacion3')
	let url = `${base_url}/Seguimiento/getMedioCaptacion`
	fetch(url)
		.then(response => response.json())
		.then(data =>{
			captacion1.innerHTML = ""
			captacion2.innerHTML = ""
			captacion3.innerHTML = ""
			for (let i = 0; i < data.length; i++) {
				if (i<6) {
					captacion1.innerHTML += '<div class="text-success">'+data[i]['med_capInput']+'</div>'
				}
				else if(i<12){
					captacion2.innerHTML += '<div class="text-success">'+data[i]['med_capInput']+'</div>'
				}
				else
				{
					captacion3.innerHTML += '<div class="text-success">'+data[i]['med_capInput']+'</div>'
				}
			}
		})
		.catch(err => console.log(err))
}

function nivelSeleccionado(idNivel)
{
	let url = base_url+'/Seguimiento/getCarrera?idNivel='+idNivel;
	fetch(url)
		.then(response => response.json())
		.then(data => {
			slctCrr.innerHTML = ""
			for (let i = 0; i < data.length; i++) {
				if(data[i]['id'] == "" && data[i]['nombre_carrera'] == "")
				{
					slctCrr.text="Seleccione..."
					slctCrr.value=""
				}
				else{
					opc1 = document.createElement('option')
					opc1.text = data[i]['nombre_carrera']
					opc1.value = data[i]['id']
					slctCrr.appendChild(opc1)
				}
			}
		})
		.catch(err => {throw err})
}

function nvlSeleccionadoPros(idNivel)
{
	let url = base_url+'/Seguimiento/getCarrera?idNivel='+idNivel
	fetch(url)
		.then(response => response.json())
		.then(data => {
			slctCrrNvo.innerHTML = ""
			for (let i = 0; i < data.length; i++) {
				if(data[i]['id'] == "" && data[i]['nombre_carrera'] == ""){
					slctCrrNvo.text = "Seleccione..."
					slctCrrNvo.value = ""
				}
				else
				{
					opc1 = document.createElement('option')
					opc1.text = data[i]['nombre_carrera']
					opc1.value = data[i]['id']
					slctCrrNvo.appendChild(opc1)
				}
			}
		})
}

formProspectoNuevo.addEventListener('submit', (e) =>{
	e.preventDefault()
	let url = `${base_url}/Seguimiento/setProspecto`
	const datos = new FormData(document.querySelector('#formPersonaNuevo'))
	console.log(url)
	fetch(url,{
		method:'POST',
		body:datos
	})
		.then(response => response.json())
		.then(data =>{
			if(data.estatus)
			{
				$('#dimissModalNvoProspecto').click()
				formProspectoNuevo.reset()
				$('#ModalNuevoProspecto').modal('hide')
				swal.fire('Nuevo prospecto creado', data.msg,'success')
				tableProspectos.api().ajax.reload()
			}
			else
			{
				swal.fire('Error',err,'error')
			}
		})
		.catch(function(err){
			swal.fire('Error',err,'error')
		})
})
