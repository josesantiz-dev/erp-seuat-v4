<div class="modal fade" id="ModalFormAdministracTutoresEditar" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">

  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title">Editar tutores</h5>
        <button type="button" class="close cerrarModal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>

      <div class="modal-body">

        <small class="text-muted">Los campos con asterisco (<span class="required">*</span>) son obligatorios.</small>

        <div class="card mt-1">

          <form id="formAdminTutoresUp" name="formAdminTutoresUp" autocomplete="off">

            <input type="hidden" id="idAdminTutoresUp" name="idAdminTutoresUp">
            <input type="hidden" id="txtId_Usuario_ActualizacionUp" name="txtId_Usuario_ActualizacionUp">
            <input type="hidden" id="txtFecha_ActualizacionUp" name="txtFecha_ActualizacionUp" value="">

            <div class="card-body">

                    <div class="form-group">
                      <label for="txtNombreTutorUp">Nombre tutor</label>
                      <input type="text" id="txtNombreTutorUp" name="txtNombreTutorUp" class="form-control" placeholder="&#xf007 Nombre del salón compuesto"  name="Ingresa el nombre"  required>
                    </div>
                    <div class="form-group">
                      <label for="txtApellidoPatTutorUp">Apellido paterno</label>
                      <input type="text" id="txtApellidoPatTutorUp" name="txtApellidoPatTutorUp" class="form-control" placeholder="&#xf007 Nombre del salón compuesto"  name="Ingresa el nombre"  required>
                    </div>
                    <div class="form-group">
                      <label for="txtApellidoMatTutorUp">Apellido materno</label>
                      <input type="text" id="txtApellidoMatTutorUp" name="txtApellidoMatTutorUp" class="form-control" placeholder="&#xf007 Nombre del salón compuesto"  name="Ingresa el nombre"  required>
                    </div>
                    <div class="form-group">
                      <label for="txtDirreccionUp">Dirrección</label>
                      <input type="text" id="txtDirreccionUp" name="txtDirreccionUp" class="form-control" placeholder="&#xf007 Nombre del salón compuesto"  name="Ingresa el nombre"  required>
                    </div>
                    <div class="form-group">
                      <label for="txtTelCelularUp">Tel. celular</label>
                      <input type="text" id="txtTelCelularUp" name="txtTelCelularUp" class="form-control" placeholder="&#xf007 Nombre del salón compuesto"  name="Ingresa el nombre"  required>
                    </div>
                    <div class="form-group">
                      <label for="txtTelFijoUp">Tel. fijo</label>
                      <input type="text" id="txtTelFijoUp" name="txtTelFijoUp" class="form-control" placeholder="&#xf007 Nombre del salón compuesto"  name="Ingresa el nombre"  required>
                    </div>
                    <div class="form-group">
                      <label for="txtCorreoUp">Correo</label>
                      <input type="text" id="txtCorreoUp" name="txtCorreoUp" class="form-control" placeholder="&#xf007 Nombre del salón compuesto"  name="Ingresa el nombre"  required>
                    </div>
                    <div class="form-group">
                      <label>Estatus <span class="required">*</span></label>
                      <select class="custom-select" id="listEstatusUp" name="listEstatusUp" required="">
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