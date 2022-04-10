<div class="modal fade" id="modalformCampanias" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">

  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">

    <div class="modal-content">
      <div class="modal-header">

        <h5 class="modal-title">Nueva Campaña</h5>
        <button type="button" class="close cerrarModal" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">
            &times;
          </span>

        </button>

      </div>



      <div class="modal-body">
        <small class="text-muted pb-4">
          Los campos con asterisco (<span class="required">*</span>) son obligatorios..
        </small>

        <div class="card card-dark">
          <form id="formCampanias" name="formCampanias" autocomplete="off">

            <input type="hidden" id="idCampanias" name="idCampanias" value="">
            <input type="hidden" id="listaEstatus" name="listaEstatus" value="1">
            <input type="hidden" id="txtFechaCreacion" name="txtFechaCreacion" value="<?php echo date("Y-m-d\TH-i");?>">
            <input type="hidden" id="txtFechaActualizacion" name="txtFechaActualizacion" value="0000-00-00 00:00:00">
            <input type="hidden" id="txtIdUsuarioCreacion" name="txtIdUsuarioCreacion" value="1">
            <input type="hidden" id="txtIdUsuarioActualizacion" name="txtIdUsuarioActualizacion" value="NULL">

            <div class="card-body">

              <div class="form-group">
                <label for="txtNombreCampanias">Campaña <span class="required">*</span> </label>
                <input type="text" id="txtNombreCampanias" name="txtNombreCampanias" class="form-control valid validText" placeholder="Ingrese una nueva campaña" name="Ingresa el nombre de la campaña" required="" autofocus>
              </div>

              <div class="form-group">
                <label for="txtFechaInicio">Fecha de inicio (<span class="required">*</span>)</label>
                <input type="date" id="txtFechaInicio" name="txtFechaInicio" class="form-control valid validText" placeholder="Inicio de la campaña" name="Ingresa la fecha de inicio" required="" autofocus>
              </div>

              <div class="form-group">
                <label for="txtFechaFin">Fecha limite (<span class="required">*</span>)</label>
                <input type="date" id="txtFechaFin" name="txtFechaFin" class="form-control valid validText" placeholder="Fin de la campaña" name="Fecha limite" required="" autofocus>
              </div>

              <div class="form-group">
                <label for="txtFechaFin">Presupuesto (<span class="required">*</span>)</label>
                <input type="number" id="txtPresupuesto" name="txtPresupuesto" class="form-control valid validText" placeholder="Ingrese presupuesto" name="Fecha limite" required="" autofocus>
              </div>
<!--presupuesto-->
            </div>


        </div>

      </div>
      <div class="modal-footer">
        <a class="btn btn-outline-secondary icono-color-principal btn-inline cerrarModal" href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>
        <button id="btnActionForm" type="submit" class="btn btn-primary btn-inline"><i class="fa fa-fw fa-lg fa-check-circle icono-azul"></i> Guardar</button>
      </div>

</form>
    </div>

  </div>

</div>
