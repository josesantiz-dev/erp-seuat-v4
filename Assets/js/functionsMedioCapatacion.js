let tableMedioCaptacion;
let divLoading = document.querySelector("#divLoading");
const modalFromNvoMedioCaptacion = document.querySelector("#modalFromNvoMedioCaptacion")

document.addEventListener('DOMContentLoaded', function(){

  tableMedioCaptacion = $('#tableMedioCaptacion').dataTable({

    "aProcessing":true,
    "aServerSide":true,
      "language":{
        "url": `${base_url}/Assets/plugins/Spanish.json`
      },
      "ajax":{
        "url": `${base_url}/MedioCaptacion/getMediosCaptacion`,
        "dataSrc":""
      },
      "columns":[
        {"data":"id"},
        {"data":"medio_captacion"},
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

  })

})

modalFromNvoMedioCaptacion.addEventListener('submit', (e) =>{

  e.preventDefault()

  const medio =  new FormData(document.getElementById('fromNvoMedioCaptacion'))
  let url = `${base_url}/MedioCaptacion/setMedioCaptacion`

  fetch(url, {
    method: 'POST',
    body: medio
  })
  .then(res => res.json())
  .then(data =>{

    if(data.estatus){
			fromNvoMedioCaptacion.reset()
			$('#modalFromNvoMedioCaptacion').modal('hide')
			swal.fire('Nuevo Medio de Captacion creado', data.msg,'success')
			tableMedioCaptacion.api().ajax.reload()

    }else{
      swal.fire('Error', data.msg,'error')
    }

  })
  .catch(function (err){
    swal.fire('Error', err,'error')
  })

})

function fntEditMedioCaptacion(element, id){

  rowTable = "";
	$('#modalFromEditMedioCaptacion').modal({
		backdrop: 'static',
		keyboard: false,
	});

	$('#modalFromEditMedioCaptacion').modal('show');

}

function ftnMedioCaptacion(){

  rowTable = "";
	$('#modalFromNvoMedioCaptacion').modal({
		backdrop: 'static',
		keyboard: false,
	});

	$('#modalFromNvoMedioCaptacion').modal('show');

}

$(".cerrarModal").click(function(){
	$('#modalFromNvoMedioCaptacion').modal('hide')
})

$(".cerrarModal").click(function(){
	$('#modalFromNvoMedioCaptacion').modal('hide')
})
