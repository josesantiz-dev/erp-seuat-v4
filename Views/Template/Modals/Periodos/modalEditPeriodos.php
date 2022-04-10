<div class="modal fade" id="ModalFormPeriodoEditar" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">

  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title">Editar periodo</h5>
        <button type="button" class="close cerrarModal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>

      <div class="modal-body">

        <small class="text-muted">Los campos con asterisco (<span class="required">*</span>) son obligatorios.</small>

        <div class="card mt-1">

          <form id="formPeriodosUp" name="formPeriodosUp" autocomplete="off">

            <input type="hidden" id="idPeriodosUp" name="idPeriodosUp">
            <input type="hidden" id="txtId_Usuario_ActualizacionUp" name="txtId_Usuario_ActualizacionUp">
            <input type="hidden" id="txtFecha_ActualizacionUp" name="txtFecha_ActualizacionUp" value="">

            <div class="card-body">

              <div class="form-group">
                <label for="txtNombre_PeriodoUp">Nombre Periodo <span class="required">*</span></label>
                <input type="text" id="txtNombre_PeriodoUp" name="txtNombre_PeriodoUp" class="form-control valid validText" placeholder="Ingrese una nueva categoría"  name="Ingresa el nombre de la categoría" required="">
              </div>
              <div class="form-group">
                <label for="txtFecha_inicioUp">fecha inicio</label>
                <input class="form-control" id="txtFecha_inicioUp" name="txtFecha_inicioUp" rows="2" type="date" value="" required>
              </div>
              <div class="form-group">
                <label for="txtFecha_finUp">fecha fin</label>
                <input class="form-control" id="txtFecha_finUp" name="txtFecha_finUp" rows="2" type="date" value="" required>
              </div>
              <div class="form-group">
                <label>Estatus <span class="required">*</span></label>
                <select class="custom-select" id="listEstatusUp" name="listEstatusUp" required>
                  <option value="1">Activo</option>
                  <option value="2">Inactivo</option>
                </select>
              </div>
              <div class="form-group">
                    <label for="listIdOrganizacionesEditar">Organizaciones planes</label>
                    <select class="form-control" id="listIdOrganizacionesEditar" name="listIdOrganizacionesEditar" required >
                      
                    </select>
              </div>
              <div class="form-group">
                    <label for="listIdCiclosEditar">Ciclos</label>
                    <select class="form-control" id="listIdCiclosEditar" name="listIdCiclosEditar" required >
                      
                    </select>
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
