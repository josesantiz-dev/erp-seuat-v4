<div class="modal fade" id="modalFormCampaniasEditar" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">

  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title">Editar Campaña</h5>
        <button type="button" class="close cerrarModal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>



      <div class="modal-body">

        <small class="text-muted">Los campos con asterisco (<span class="required">*</span>) son obligatorios.</small>

        <div class="card mt-1">


          <form id="formCampaniasup" name="idCampaniasUp" autocomplete="off">
            <input type="hidden" id="idCampaniasUp" name="idCampaniasUp">
            <input type="hidden" id="txtFechaActualizacionUp" name="txtFechaActualizacionUp" value="">
            <input type="hidden" id="txtIdUsuarioActualizacionUp" name="txtIdUsuarioActualizacionUp">

            <div class="card-body">

              <div class="form-group">

                <label for="txtNombreCampanias">Nombre Campaña <span class="required">*</span></label>
                <input type="text" id="txtNombreCampaniasUp" name="txtNombreCampaniasUp" class="form-control valid validText" placeholder="Ingrese una nueva categoría"  name="Ingresa el nombre de la categoría" required="">

              </div>

              <div class="form-group">
                <label for="txtFechaInicioUp">Fecha de inicio (<span class="required">*</span>)</label>
                <input type="date" id="txtFechaInicioUp" name="txtFechaInicioUp" class="form-control valid validText" placeholder="Inicio de la campaña" name="Ingresa la fecha de inicio" required="" autofocus>
              </div>

              <div class="form-group">
                <label for="txtFechaFinUp">Fecha limite (<span class="required">*</span>)</label>
                <input type="date" id="txtFechaFinUp" name="txtFechaFinUp" class="form-control valid validText" placeholder="Fin de la campaña" name="Fecha limite" required="" autofocus>
              </div>

              <div class="form-group">
                <label for="txtPresupuestoUp">Presupuesto (<span class="required">*</span>)</label>
                <input type="number" id="txtPresupuestoUp" name="txtPresupuestoUp" class="form-control valid validText" placeholder="Ingrese presupuesto" name="Fecha limite" required="" autofocus>
              </div>

              <div class="form-group">

                <label>Estatus <span class="required">*</span></label>
                <select class="custom-select" id="listEstatusUp" name="listEstatusUp" required="">
                  <option value="1">Activo</option>
                  <option value="2">Inactivo</option>
                </select>

              </div>

            </div>



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
