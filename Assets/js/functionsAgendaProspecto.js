let tableAgendaProspecto;
let rowTable;
// let divLoading = document.querySelector("#divLoading");

document.addEventListener('DOMContentLoaded', function(){

  tableAgendaProspecto = $('#tableAgendaProspecto').dataTable({
    "aProcessing":true,
    "aServerSide":true,
    "language":{
      "url": " "+base_url+"/Assets/plugins/Spanish.json"
    },
    "ajax":{
      "url": " "+base_url+"/AgendaProspecto/getAgendaProspectos",
      "dataSrc": ""
    },
    "columns":[
      {"data":"id"},
      {"data":"fecha_programada"},
      {"data":"hora_programada"},
      {"data":"asunto"},
      {"data":"estatus"}
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

    if(document.querySelector("#formAgendaProspectoSeguimiento")){

      let formAgendaProspectoSeguimiento = document.querySelector("#formAgendaProspectoSeguimiento");
      formAgendaProspectoSeguimiento.onsubmit = function(e){
        e.preventDefault();

        let intIdLtrUp = document.querySelector('#idAgendaLtrUp').value;
        let intEstatus = document.querySelector("#txtEstatus").value;

        // divLoading.style.display = "flex";
  			let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url+'/AgendaProspecto/setEstatusProspecto/';
        let formData = new FormData(formAgendaProspectoSeguimiento);
  			request.open("POST",ajaxUrl,true);
  			request.send(formData);

        request.onreadystatechange = function(){

          if(request.readyState == 4 && request.status == 200){

            let objData = JSON.parse(request.responseText);

						if(objData.estatus){
              swal.fire("Atendido", objData.msg, "success");
              $("#modalTableAgendaProspectoSeguimiento").modal('hide')
              tableAgendaProspecto.api().ajax.reload();
            }else{
              console.log("No");
              swal.fire("Algo Salio mal", objData.msg, "success");
            }

          }

        }

      }


    }

}, false);

function ftnAgendarProspecto(element, id){

  rowTable = element.parentNode.parentNode.parentNode.parentNode.parentNode;
  let ajaxUrl = base_url+'/AgendaProspecto/getAgendaProspecto/'+id;

  fetch(ajaxUrl)
    .then(res => res.json())
    .then((resultado) => {

      let urlPersona = `${base_url}/AgendaProspecto/getNombreUsuarioCreacion/${resultado.data.id_usuario_atendio}`
      fetch(urlPersona)
        .then(res => res.json())
        .then((data) => {

          var lblNombre = data.data.nombre_persona+" "+data.data.ap_paterno+" "+data.data.ap_materno;
          // document.querySelector('#nombre').innerHTML = lblNombre;
          document.querySelector('#asunto').innerHTML = resultado.data.asunto;
          document.querySelector('#txtInformacion').innerHTML = resultado.data.info;
          // document.querySelector('#fechaRegistro').innerHTML = resultado.data.fecha_registro;
          document.querySelector('#idAgendaLtrUp').value = resultado.data.id;
          document.querySelector('#txtEstatus').value = 2;

          var divCarta = ``;

          if(resultado.data.estatus == '1'){

            divCarta = `<div class="card card-secondary">
                          <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-briefcase"></i> Pendiente de Atender</h3>
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body">
                            <h5 class="d-flex justify-content-center text-muted pb-4 align-self-center">
                              Fecha Registro:&nbsp;<b>`+resultado.data.fecha_registro+`</b>
                              &nbsp; Seguimiento:&nbsp;<b>`+lblNombre+`</b>
                            </h5>
                            <div class="form-group d-flex justify-content-center">
                              <span class="card-title grey-text valign-wrapper">
                                <button id="btnActionForm" type="submit" class="btn btn-info btn-inline">
                                  <h5><i class="fas fa-thumbs-up"></i> Marcar Como Atendido</h5>
                                </button>
                              </span>
                            </div>
                          </div>
                        </div>`;
          }else{

            divCarta = `<div class="card card-info">
                          <div class="card-header">
                            <h3 class="card-title">Prospecto Atendidio</h3>
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body">
                            <h5 class="d-flex justify-content-center text-muted pb-4 align-self-center">
                              Fecha Registro:&nbsp;<b>`+resultado.data.fecha_registro+`</b>
                              &nbsp; Seguimiento:&nbsp;<b>`+lblNombre+`</b>
                            </h5>
                          </div>
                        </div>`;

          }
          document.querySelector('#cartaAtencion').innerHTML = divCarta;

        })
        .catch(err => {throw err})


    })
    .catch();


    $('#modalTableAgendaProspectoSeguimiento').modal('show');

}

$(".cerrarModal").click(function(){
	$("#modalTableAgendaProspectoSeguimiento").modal('hide')
});
