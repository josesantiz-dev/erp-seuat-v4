let tableProspectos
let tableSegProspectoIndividual
let tableSeguimientoProspecto = document.querySelector('#tableSeguimientoProspecto')
const formSeguimientoIndividual = document.querySelector('#formSeguimientoProspectoIndividual')
const formEditarDatos = document.querySelector('#formProspectoEdit')
const modalAgendarProspectoSeguimiento = document.querySelector("#ModalAgendarProspectoSeguimiento")
const formPersonaNuevo = document.querySelector('#formPersonaNuevo')
const modalProspeccionIndividual = document.querySelector("#modalProspeccionIndividual")
const slctNivel = document.querySelector('#slctNivelEstudiosEdit')
const slctCrr = document.querySelector('#slctCarreraEdit')
const slctCrrNvo = document.querySelector('#slctCarreraNvo')
//------------------------------------------
const strNombre = document.querySelector("#txtNombreNuevo")
const strApPaterno = document.querySelector("#txtApellidoPaNuevo")
const strApMaterno = document.querySelector("#txtApellidoMaNuevo")
const strAlias = document.querySelector("#txtAlias")
const strSexo = document.querySelector("#listSexoNuevo")
const strEdoCivil = document.querySelector("#listEstadoCivilNuevo")
const strOcupacion = document.querySelector("#txtOcupacionNuevo")
const strFechaNacimiento = document.querySelector("#txtFechaNacimientoNuevo")
const intEscolaridad = document.querySelector("#slctEscolaridad")
//Residencia
const strLocalidad = document.querySelector("#listLocalidadNuevo")
//Contacto
const strTelCel = document.querySelector("#txtTelCelNuevo")
const strTelfijo = document.querySelector("#txtTelFiNuevo")
const strEmail = document.querySelector("#txtEmailNuevo")
//Prospecto
const intPlantelProcedencia = document.querySelector("#txtPlantelProcedencia")
const intPlantelInteres = document.querySelector("#slctPlantel")
const intNivelEstudiosInteres = document.querySelector("#slctNivelEstudios")
const intCarreaInteres = document.querySelector("#slctCarreraNvo")
const comentario = document.querySelector("#comentario")
//------------------------------------------


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
            {"data": "nombre_plantel"},
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


});

function validarPersona(){

	if(!(strNombre.value == '') && !(strApPaterno.value == '') && !(strApMaterno.value == '') && !(strAlias.value == '') && !(strSexo.value == '') && !(strEdoCivil.value == '') && !(strOcupacion.value == '') && !(strFechaNacimiento.value == '') && !(intEscolaridad.value == '')) {

		document.getElementById("cardDatosPer").setAttribute("class", "card card-info mb-3");
		console.log("Hola")
		// document.getElementById("cardDatosPer").setAttribute("data-card-widget", "collapse");

	}else{

		document.getElementById("cardDatosPer").setAttribute("class", "card card-secondary mb-3 collapsed-card");
		console.log("mundo")
	}

}

function validarResi(){

	if(!(strLocalidad.value == '')){

		document.getElementById("datosResidencia").setAttribute("class", "card card-info mb-3");
		// document.getElementById("datosResidencia").setAttribute("data-card-widget", "collapse");

	}else{

		document.getElementById("datosResidencia").setAttribute("class", "card card-secondary mb-3 collapsed-card");

	}

}

function validarContac(){

	if(strTelCel.value != '' && strTelfijo.value != '' && strEmail.value != ''){

		document.getElementById("datosContacto").setAttribute("class", "card card-info mb-3");
		// document.getElementById("datosResidencia").setAttribute("data-card-widget", "collapse");

	}else{

		document.getElementById("datosContacto").setAttribute("class", "card card-secondary mb-3 collapsed-card");

	}

}

function validarProspecto(){

	if(intPlantelProcedencia.value != '' && intPlantelInteres.value != '' && intNivelEstudiosInteres.value != '' && intCarreaInteres.value != ''){

		document.getElementById("cardProspecto").setAttribute("class", "card card-info mb-3");
		// document.getElementById("datosResidencia").setAttribute("data-card-widget", "collapse");

	}else{

		document.getElementById("cardProspecto").setAttribute("class", "card card-secondary mb-3 collapsed-card");

	}

}

function validarMedio(){

	document.getElementById("cardCaptacion").setAttribute("class", "card card-info mb-3");

	if(comentario.value != ''){

		document.getElementById("cardComent").setAttribute("class", "card card-info mb-3");

	}else{

		document.getElementById("cardComent").setAttribute("class", "card card-secondary mb-3 collapsed-card");

	}

}

$('#tableSeguimientoProspecto').DataTable();

function ftnAgendar(id){
	var idAgendar = id;
	document.querySelector("#idPersona").value = idAgendar;
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

function nivelSeleccionado(idNivel)
{
	let url = base_url+'/Seguimiento/getCarrera?idNivel='+idNivel
	fetch(url)
		.then(response => response.json())
		.then(data => {
			slctCrr.innerHTML = ""
			for (let i = 0; i < data.length; i++) {
				if(data[i]['id'] == "" && data[i]['nombre_carrera'] == "")
				{
					slctCrr.text = "Seleccione..."
					slctCrr.value = ""
				}
				else
				{
					opc1 = document.createElement('option')
					opc1.text = data[i]['nombre_carrera']
					opc1.value = data[i]['id']
					slctCrr.appendChild(opc1)
				}
			}
		})
		.catch(err => {throw err})
}

function lvlSeleccionado(idNivel)
{
	let url = base_url+'/Seguimiento/getCarrera?idNivel='+idNivel
	console.log(url)
	fetch(url)
		.then(response => response.json())
		.then(data => {
			slctCrrNvo.innerHTML = ""
			for (let i = 0; i < data.length; i++) {
				if(data[i]['id'] == "" && data[i]['nombre_carrera'] == "")
				{
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
		.catch(err => {throw err})
}

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
		.catch(err => console.log(err))
}

function fnSeguimientoInvidual(){
	let idPro = document.querySelector('#idProspecto').value
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
		.then(data => {
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

formEditarDatos.addEventListener('submit', (e) => {
	e.preventDefault()
	//console.log('Diste clic a editar datos')
	const datos = new FormData(document.querySelector('#formProspectoEdit'))
	let url =`${base_url}/Seguimiento/editDatos`
	fetch(url,{
		method: 'POST',
		body: datos
	})
	.then(response => response.json())
	.then(data => {
		console.log(data)
		if(data.estatus)
		{
			$('#cancelarModalEditDatosProspecto').click()
			formEditarDatos.reset()
			swal.fire('Editar datos prospecto', data.msg,'success')
			tableSeguimientoProspecto.api().ajax.reload()
		}
		else
		{
			swal.fire('Error', data.msg,'error')
		}
	})
})

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
				swal.fire('Seguimiento', data.msg, 'success')
				tableSegProspectoIndividual.api().ajax.reload()
			}
			else
			{
				swal.fire('Error', data.msg,'error')
			}
		})
	// .catch(function (err){
	// 	console.log(err)
	// })
})

// function validar(){
//
// 	if(!(document.getElementById("slctNivelEstudios").value == "")){
// 		document.getElementById("cardProspecto").setAttribute("class", "card-success");
// 	}else{
// 		console.log("HOLA MUNDO XDD")
// 	}
//
// }


// const modalFormNuevaPersona = document.querySelector("#ModalFormNuevaPersona")
//


function ftnNvoProspecto(){

	rowTable = "";
	$('#ModalFormNuevaPersona').modal({
		backdrop: 'static',
		keyboard: false,
	})

	$('#ModalFormNuevaPersona').modal('show');

	let captacion1 = document.querySelector('#captacion1')
	let captacion2 = document.querySelector('#captacion2')
	let dataLenght;
	let url = `${base_url}/Seguimiento/getMedioCaptacion`
	fetch(url)
		.then(response => response.json())
		.then(data => {
			captacion1.innerHTML = ""
			captacion2.innerHTML = ""
			dataLenght = data.length/2;
			for (let i = 0; i < data.length; i++) {
				if(i<dataLenght){
					captacion1.innerHTML += '<div class="text-info">'+data[i]['med_capInput']+'</div>'
				}else{
					captacion2.innerHTML += '<div class="text-info">'+data[i]['med_capInput']+'</div>'
				}

			}
		})
		.catch(err => console.log(err))

		let subcampania = document.querySelector('#slctSubcampania')
		let idCampania = document.querySelector('#idCampania').value
		let urlSbC = `${base_url}/Seguimiento/getSubCampaniass/${idCampania}`
		fetch(urlSbC)
			.then(res => res.json())
			.then(data => {

				subcampania.innerHTML
				for(let i = 0; i < data.length; i++){

					option = document.createElement('option');
					option.text = data[i]['nombre_sub_campania']+" [Vigencia "+data[i]['fecha_inicio']+" Al "+data[i]['fecha_fin']+"]";
					option.value = data[i]['id'];
					subcampania.appendChild(option);

				}

			})
			.catch()

}

function estadoSeleccionado(value){
    const selMunicipio = document.querySelector('#listMunicipioNuevo');
    let url = base_url+"/Seguimiento/getMunicipios?idestado="+value;
    fetch(url)
    .then(res => res.json())
    .then((resultado) => {
        selMunicipio.innerHTML = "";
        for (let i = 0; i < resultado.length; i++) {
            opcion = document.createElement('option');
            opcion.text = resultado[i]['nombre'];
            opcion.value = resultado[i]['id'];
            selMunicipio.appendChild(opcion);

        }
    })
    .catch(err =>{throw err});
}

function municipioSeleccionado(value){
    const selLocalidades = document.querySelector('#listLocalidadNuevo');
    let url = base_url+"/Seguimiento/getLocalidades?idmunicipio="+value;
    fetch(url)
        .then(res => res.json())
        .then((resultado) => {
            selLocalidades.innerHTML ="";
            for (let i = 0; i < resultado.length; i++) {
                opcion = document.createElement('option');
                opcion.text = resultado[i]['nombre'];
                opcion.value = resultado[i]['id'];
                selLocalidades.appendChild(opcion);
            }
        })
        .catch(err => {throw err});
}

formPersonaNuevo.addEventListener('submit', (e) =>{

	e.preventDefault()

	//Datos personales
	strNombre.value
	strApPaterno.value
	strApMaterno.value
	strAlias.value
	strSexo.value
	strEdoCivil.value
	strOcupacion.value
	strFechaNacimiento.value
	intEscolaridad.value
	//Residencia
	strLocalidad.value
	//Contacto
	strTelCel.value
	strTelfijo.value
	strEmail.value
	//Prospecto
	intPlantelProcedencia.value
	intPlantelInteres.value
	intNivelEstudiosInteres.value
	intCarreaInteres.value

	if(strNombre == '' || strApPaterno == '' || strApMaterno == '' || strAlias == '' || strSexo == '' || strEdoCivil == '' || strOcupacion == '' || strFechaNacimiento == '' || intEscolaridad == '' || strLocalidad == '' || strTelCel == '' || strTelfijo == '' || strEmail == '' || intPlantelProcedencia == '' || intPlantelInteres == '' || intNivelEstudiosInteres == '' || intCarreaInteres == ''){

		swal.fire("Atencion", "Todos los campos son obligatorios.", "warning");

	}


	const datos = new FormData(document.querySelector('#formPersonaNuevo'))
	let url = `${base_url}/Seguimiento/setNuevoProspecto`
	console.log(url)
	fetch(url, {
		method: 'POST',
		body: datos
	})
	.then(response => response.json())
	.then(data => {
		if(data.estatus){
			$('#ModalFormNuevaPersona').click()
			formEditarDatos.reset()
			$('#ModalFormNuevaPersona').modal('hide')
			swal.fire('Nuevo prospecto creado', data.msg,'success')
			tableSeguimientoProspecto.api().ajax.reload()
		}else{
			swal.fire('Error', data.msg,'error')
		}
	})
	.catch(function (err){
		swal.fire('Error', err,'error')
	})

})

$(".close").click(function(){
	$('#ModalFormNuevaPersona').modal('hide')
})

$("#dimissModalNuevo").click(function(){
	$('#ModalFormNuevaPersona').modal('hide')
})
