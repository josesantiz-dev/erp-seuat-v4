<div class="modal fade" id="ModalFormSalonCompEditar" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">

  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title">Editar salón compuesto</h5>
        <button type="button" class="close cerrarModal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>

      <div class="modal-body">

        <small class="text-muted">Los campos con asterisco (<span class="required">*</span>) son obligatorios.</small>

        <div class="card mt-1">

          <form id="formSalonesCompuestosUp" name="formSalonesCompuestosUp" autocomplete="off">

            <input type="hidden" id="idSalonesCompuestosUp" name="idSalonesCompuestosUp">
            <input type="hidden" id="txtId_Usuario_ActualizacionUp" name="txtId_Usuario_ActualizacionUp">
            <input type="hidden" id="txtFecha_ActualizacionUp" name="txtFecha_ActualizacionUp" value="">

            <div class="card-body">

                    <div class="form-group">
                      <label for="txtNombre_SalonCompuestoUp">Nombre salón compuesto</label>
                      <input type="text" id="txtNombre_SalonCompuestoUp" name="txtNombre_SalonCompuestoUp" class="form-control" placeholder="&#xf007 Nombre del salón compuesto"  name="Ingresa el nombre"  required>
                    </div>
                    <div class="form-group">
                        <label for="listIdPeriodosEditar">Periodo</label>
                        <select class="form-control" id="listIdPeriodosEditar" name="listIdPeriodosEditar" required >
                        
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="listIdGradosEditar">Grado</label>
                        <select class="form-control" id="listIdGradosEditar" name="listIdGradosEditar" required >
                        
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="listIdGruposEditar">Grupo</label>
                        <select class="form-control" id="listIdGruposEditar" name="listIdGruposEditar" required >
                        
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="listIdPlantelesEditar">Plantel</label>
                        <select class="form-control" id="listIdPlantelesEditar" name="listIdPlantelesEditar" required >
                        
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="listIdTurnosEditar">Turno</label>
                        <select class="form-control" id="listIdTurnosEditar" name="listIdTurnosEditar" required >
                        
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="listIdSalonesEditar">Salón</label>
                        <select class="form-control" id="listIdSalonesEditar" name="listIdSalonesEditar" required >
                        
                        </select>
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