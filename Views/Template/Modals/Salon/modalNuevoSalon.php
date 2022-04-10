<div class="modal fade" id="ModalNuevoSalon" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nuevo salón</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">
                    <form id="formSalonNuevo" name="formSalonNuevo">
                        <input type="hidden" id="idSalonNuevo" name="idSalonNuevo" value="">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-7">
                                    <label>Nombre del salón</label>
                                    <input type="text" id="txtNombreNuevo" name="txtNombreNuevo" class="form-control form-control-sm" placeholder="EJ: Salón 1" name="" maxlength="45" required>
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="">Capacidad máx. alumnos</label>
                                    <input type="number" min="1" pattern="^[0-9]" id="txtCantidadMax" name="txtCantidadMax" class="form-control form-control-sm" placeholder="EJ: 10,15,20" required>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" data-dismiss="modal" id="dimissModalNuevoSalon"><i class="fa fa-fw fa-lg fa-times-circle icono-azul" id="cancelarModalNuevo"></i>Cancelar</a>
                <button id="btnActionFormNuevo" type="submit" class="btn btn-outline-secondary icono-color-principal btn-inline"><i class="fa fa-fw fa-lg fa-check-circle icono-azul"></i><span id="btnText"> Guardar</span></button>
            </div>
            </form>
        </div>
    </div>
</div>