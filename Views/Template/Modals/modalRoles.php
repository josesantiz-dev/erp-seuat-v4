<div class="modal fade" id="ModalFormRol" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Rol</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="card card-secondary">

              <form id="formRol" name="formRol" class="needs-validation">
                <input type="hidden" id="idRol" name="idRol" value="">
                <div class="card-body">
                  <div class="form-group">
                    <label for="txtNombre">Nombre</label>
                    <input type="text" id="txtNombre" name="txtNombre" class="form-control" placeholder="&#xf007 Nombre del rol"  name="Ingresa el nombre"  required>
                  </div>
                  <div class="form-group">
                    <label>Descripción</label>
                    <textarea class="form-control" id="txtDescripcion" name="txtDescripcion" rows="2" placeholder="Descripción del rol" required></textarea>
                  </div>
                  <div class="form-group">
                  <label>Estado</label>
                  <select class="form-control" id="listEstatus" name="listEstatus" required >
                    <option value="">-- Selecciona un elemento de la lista --</option>
                    <option value="1">Activo</option>
                    <option value="2">Inactivo</option>
                  </select>
                  </div>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <a class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>
        <button id="btnActionForm" type="submit" class="btn btn-outline-secondary icono-color-principal btn-inline"><i class="fa fa-fw fa-lg fa-check-circle icono-azul"></i><span id="btnText"> Guardar</span></button>
      </div>   
      </form> 
    </div>
  </div>
</div>