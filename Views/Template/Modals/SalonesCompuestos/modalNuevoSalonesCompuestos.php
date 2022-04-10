<div class="modal fade" id="ModalFormSalonesCompuestos" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo salon compuesto</h5>
        <button type="button" class="close cerrarModal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="card card-secondary">

              <form id="formSalonesCompuestos" name="formSalonesCompuestos" class="needs-validation">
                <input type="hidden" id="idSalonesCompuestos" name="idSalonesCompuestos" value="">
                <input type="hidden" id="listEstatus" name="listEstatus" value="1">
                <input type="hidden" id="txtFecha_Creacion" name="txtFecha_Creacion" value="<?php echo date("Y-m-d H:i:s");?>">
                <input type="hidden" id="txtFecha_Actualizacion" name="txtFecha_Actualizacion" value="0000-00-00 00:00:00">
                <input type="hidden" id="txtId_usuario_creacion" name="txtId_usuario_creacion" value="1">
                <input type="hidden" id="txtId_Usuario_Actualizacion" name="txtId_Usuario_Actualizacion" value="NULL">

                <div class="card-body">
                  <div class="form-group">
                    <label for="txtNombre_SalonCompuesto">Nombre salón compuesto</label>
                    <input type="text" id="txtNombre_SalonCompuesto" name="txtNombre_SalonCompuesto" class="form-control" placeholder="&#xf007 Nombre del salón compuesto"  name="Ingresa el nombre"  required>
                  </div>
                    <div class="form-group">
                        <label for="listIdPeriodosNuevo">Periodo</label>
                        <select class="form-control" id="listIdPeriodosNuevo" name="listIdPeriodosNuevo" onchange="" required >
                        
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="listIdGradosNuevo">Grado</label>
                        <select class="form-control" id="listIdGradosNuevo" name="listIdGradosNuevo" onchange="" required >
                        
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="listIdGruposNuevo">Grupo</label>
                        <select class="form-control" id="listIdGruposNuevo" name="listIdGruposNuevo" onchange="" required >
                        
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="listIdPlantelesNuevo">Plantel</label>
                        <select class="form-control" id="listIdPlantelesNuevo" name="listIdPlantelesNuevo" onchange="" required >
                        
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="listIdTurnosNuevo">Turno</label>
                        <select class="form-control" id="listIdTurnosNuevo" name="listIdTurnosNuevo" onchange="" required >
                        
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="listIdSalonesNuevo">Salón</label>
                        <select class="form-control" id="listIdSalonesNuevo" name="listIdSalonesNuevo" onchange="" required >
                        
                        </select>
                    </div>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <a class="btn btn-outline-secondary icono-color-principal btn-inline cerrarModal" href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>
        <button id="btnActionForm" type="submit" class="btn btn-outline-secondary icono-color-principal btn-inline"><i class="fa fa-fw fa-lg fa-check-circle icono-azul"></i><span id="btnText"> Guardar</span></button>
      </div>   
      </form> 
    </div>
  </div>
</div>