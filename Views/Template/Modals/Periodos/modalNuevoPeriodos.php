<div class="modal fade" id="ModalFormPeriodos" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Periodo</h5>
        <button type="button" class="close cerrarModal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
            <div class="card card-secondary">

              <form id="formPeriodos" name="formPeriodos" class="needs-validation">
                <input type="hidden" id="idPeriodos" name="idPeriodos" value="">
                <input type="hidden" id="listEstatus" name="listEstatus" value="1">
                <input type="hidden" id="txtFecha_Creacion" name="txtFecha_Creacion" value="<?php echo date("Y-m-d H:i:s");?>">
                <input type="hidden" id="txtFecha_Actualizacion" name="txtFecha_Actualizacion" value="0000-00-00 00:00:00">
                <input type="hidden" id="txtId_usuario_creacion" name="txtId_usuario_creacion" value="1">
                <input type="hidden" id="txtId_Usuario_Actualizacion" name="txtId_Usuario_Actualizacion" value="NULL">

                <div class="card-body">
                  <div class="form-group">
                    <label for="txtNombre_Periodo">Nombre</label>
                    <input type="text" id="txtNombre_Periodo" name="txtNombre_Periodo" class="form-control" placeholder="&#xf007 Nombre del periodo"  name="Ingresa el nombre"  required>
                  </div>
                  <div class="form-group">
                    <label for="txtFecha_inicio">fecha inicio</label>
                    <input class="form-control" id="txtFecha_inicio" name="txtFecha_inicio" rows="2" type="date" value="" required>
                  </div>
                  <div class="form-group">
                    <label for="txtFecha_fin">fecha fin</label>
                    <input class="form-control" id="txtFecha_fin" name="txtFecha_fin" rows="2" type="date" value="" required>
                  </div>
                  <div class="form-group">
                    <label for="listIdOrganizacionesNuevo">Organizaciones planes</label>
                    <select class="form-control" id="listIdOrganizacionesNuevo" name="listIdOrganizacionesNuevo" required >

                    </select>
                  </div>
                  <div class="form-group">
                    <label for="listIdCiclosNuevo">Ciclos</label>
                    <select class="form-control" id="listIdCiclosNuevo" name="listIdCiclosNuevo" required >

                    </select>
                  </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a class="btn btn-outline-secondary icono-color-principal btn-inline cerrarModal" href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>
            <button id="btnActionForm" type="submit" class="btn btn-outline-secondary btn-primary icono-color-principal btn-inline"><i class="fa fa-fw fa-lg fa-check-circle icono-azul"></i><span id="btnText"> Guardar</span></button>
        </div>   
      </form> 
    </div>
  </div>
</div>