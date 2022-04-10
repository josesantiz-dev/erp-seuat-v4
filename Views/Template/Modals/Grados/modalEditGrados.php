<div class="modal fade" id="ModalFormGradoEditar" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">

  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title">Editar grado</h5>
        <button type="button" class="close cerrarModal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>

      <div class="modal-body">

        <small class="text-muted">Los campos con asterisco (<span class="required">*</span>) son obligatorios.</small>

        <div class="card mt-1">

          <form id="formGradosUp" name="formGradosUp" autocomplete="off">

            <input type="hidden" id="idGradosUp" name="idGradosUp">
            <input type="hidden" id="txtId_Usuario_ActualizacionUp" name="txtId_Usuario_ActualizacionUp">
            <input type="hidden" id="txtFecha_ActualizacionUp" name="txtFecha_ActualizacionUp" value="">

            <div class="card-body">

              <div class="form-group">
                <label for="txtNombre_GradoUp">Nombre grado</label>
                <input type="text" id="txtNombre_GradoUp" name="txtNombre_GradoUp" class="form-control" placeholder="&#xf007 Nombre del ciclo"  name="Ingresa el nombre"  required>
              </div>
              <div class="form-group">
                <label for="txtNumero_NaturalUp">Número natural</label>
                <input class="form-control" id="txtNumero_NaturalUp" name="txtNumero_NaturalUp" rows="2" type="number" value="" required>
              </div>
              <div class="form-group">
                <label for="txtNumero_RomanoUp">Número romano</label>
                <input type="text" id="txtNumero_RomanoUp" name="txtNumero_RomanoUp" class="form-control" placeholder="&#xf007 Número romano"  name="Ingresa el número romano"  required>
              </div>
              <div class="form-group">
                <label>Estatus <span class="required">*</span></label>
                <select class="custom-select" id="listEstatusUp" name="listEstatusUp" required>
                  <option value="1">Activo</option>
                  <option value="2">Inactivo</option>
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
