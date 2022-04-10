<div class="modal fade" id="modalTableAgendaProspectoSeguimiento" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden>

  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">

    <div class="modal-content">
      <div class="modal-header">

        <h5 class="modal-title">
          Seguimiento "<b id="asunto"></b>"
        </h5>
        <button type="button" class="close cerrarModal" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">
            &times;
          </span>

        </button>

      </div>
      <div class="modal-body">

        <div class="card card-dark">

          <form id="formAgendaProspectoSeguimiento" name="formAgendaProspectoSeguimiento">

            <input type="hidden" id="idAgendaLtrUp" name="idAgendaLtrUp" value="">
            <input type="hidden" id="txtEstatus" name="txtEstatus" value="">

            <div class="card-body">

              <div class="container-fluid">

                <!--Caja perfil-->
                  <div class="card-body box-profile" id="txtInformacion">

                  </div>
                <!--/Caja perfil-->

              </div>

              <div class="container-fluid" id="cartaAtencion">

                <!-- <div class="card card-success">
                  <div class="card-header">
                    <h3 class="card-title">Success</h3>

                  </div>
                  <div class="card-body">
                    <span class="text-muted pb-4" style="margin-left:2%">
                      <b>Fecha Registro: </b> <small id="fechaRegistro"></small>
                    </span>

                    <br>

                    <span class="text-muted pb-4" style="margin-left:2%">
                      Seguimiento <b id="nombre"></b>
                    </span>

                    <div class="form-group" style="margin-left:1%">
                      <span class="card-title valign-wrapper" id="estatus">
                      </span>
                    </div>
                  </div>
                </div> -->

              </div>

            </div>

          </form>



        </div>
        <div class="modal-footer">
          <a class="btn btn-outline-secondary icono-color-principal btn-inline cerrarModal" href="#" data-dismiss="modal"><i class="fa fas fa-arrow-circle-left icono-azul"></i> Regresar</a>
        </div>

      </div>
    </div>

  </div>

</div>
