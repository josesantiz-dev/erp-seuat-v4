<div class="modal fade" id="modalTableAgendaProspectosDia" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">

  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">

    <div class="modal-content">
      <div class="modal-header">

        <h5 class="modal-title">
          Prospectos del Día <?php echo date("d-m-Y");?>
        </h5>
        <button type="button" class="close cerrarModal" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">
            &times;
          </span>

        </button>

      </div>
      <div class="modal-body">
        <small class="text-muted pb-4">
          Prospectos a contactar:
        </small>

        <div class="card card-dark">

          <table id="tableAgendaProspectosDia" class="table table-bordered table-striped table-hover table-sm">

            <thead>

              <tr>

                <th width="7%">#</th>
                <th>Nombre(s)</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th width="12%">Telefono</th>
                <th width="12%">Hora</th>

              </tr>

            </thead>
            
            <tbody>





            </tbody>


          </table>

        </div>

        <div class="modal-footer">
          <a class="btn btn-outline-secondary icono-color-principal btn-inline cerrarModal" href="#" data-dismiss="modal">
            <i class="fa fa-fw fa-lg fa-arrow-circle-right icono-azul"></i> Continuar
          </a>
        </div>

      </div>
    </div>

  </div>

</div>
