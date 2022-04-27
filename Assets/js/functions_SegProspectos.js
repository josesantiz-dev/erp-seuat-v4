let tableProspectos
let tableSeguimientoProspecto = document.querySelector('#tableSeguimientoProspecto')
const modalAgendarProspectoSeguimiento = document.querySelector('#ModalAgendarProspectoSeguimiento')

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