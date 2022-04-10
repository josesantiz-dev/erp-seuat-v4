<div class="modal fade" id="modalFormAgendaProspectosAgendar" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">

  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">

    <div class="modal-content">

        <div class="modal-header">

        <h5 class="modal-title">Agendar "<label id="idProspecto"> </label>" </h5>
        <button type="button" class="close cerrarModal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>

    <div class="modal-body">

      <small class="text-muted">Los campos con asterisco (<span class="required">*</span>) son obligatorios</small>

      <div class="card card-dark">

        <form class="formAgendaProspectosAgendar" id="formAgendaProspectosAgendar" name="formSubcampania" autocomplete="off">

          <input type="hidden" id="idAgenda" name="idAgenda" value="">
          <input type="hidden" id="idPersona" name="idPersona" value="">
          <input type="hidden" id="idUsuarioAtendidoAgenda" name="idUsuarioAtendidoAgenda" value>
          <input type="hidden" id="txtFechaActualizacion" name="txtFechaActualizacion" value="<?php echo date("Y-m-d"); ?>">

          <div class="card-body">

            <div class="form-group">
              <label for="txtFechaProgramada">Fecha <span class="required">*</span> </label>
              <input type="date" id="txtFechaProgramada" name="txtFechaProgramada" class="form-control valid validText" placeholder="Ingrese la fecha para la lamada" name="Programar Fecha" required="" autofocus>
            </div>

            <div class="form-group">
              <label for="txtHoraProgramada">Hora <span class="required">*</span> </label>
              <input type="time" id="txtHoraProgramada" name="txtHoraProgramada" class="form-control valid validText" placeholder="Programar Hora de llamada" name="Programar Hora de llamadas" required="" autofocus>
            </div>

            <div class="form-group">
              <label for="txtAsutnoLlamada">Asunto <span class="required">*</span> </label>
              <input type="text" id="txtAsutnoLlamada" name="txtAsutnoLlamada" class="form-control valid validText" placeholder="Ingrese el asunto de la llamada" name="Ingrese el asunto de la llamada" required="" autofocus>
            </div>

            <div class="form-group">
              <label for="txtDetalleLlamada">Detalle <span class="required">*</span> </label>
              <textarea id="txtDetalleLlamada" name="txtDetalleLlamada" class="form-control valid validText" placeholder="Ingrese el Detalle de la llamada" name="Ingrese el Detalle de la llamada" required="" autofocus></textarea>
            </div>

          </div>

          <div class="modal-footer">
            <a class="btn btn-outline-secondary icono-color-principal btn-inline cerrarModal" href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>
            <button id="btnActionForm" type="submit" class="btn btn-primary btn-inline"><i class="fa fa-fw fa-lg fa-check-circle icono-azul"></i> Actualizar</button>
          </div>


        </form>

      </div>

    </div>
    </div>

  </div>

</div>
