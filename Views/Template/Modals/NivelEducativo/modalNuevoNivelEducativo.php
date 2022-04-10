<!-- Modal -->
<div class="modal fade" id="ModalFormNuevoNivelEducativo" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModalNuevo">Nuevo nivel educativo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">
                    <form id="formNivelEducativoNuevo" name="formNivelEducativoNuevo">
                        <input type="hidden" id="idNuevo" name="idNuevo" value="">
                        <div class="card-body"> 
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" id="txtNombreNuevo" name="txtNombreNuevo" class="form-control" placeholder="EJ: Técnico Superior Universitario" maxlength="45" required>
                            </div>
                            <div class="form-group">
                                <label>Abreviatura</label>
                                <input type="text" id="txtAbreviaturaNuevo" name="txtAbreviaturaNuevo" class="form-control" placeholder="EJ: TSU" maxlength="6" required>
                            </div>
                            <div class="form-group">
                                <label>Orden</label>
                                <input type="text" id="txtOrdenNuevo" onkeypress="return validarNumeroInput(event)" name="txtOrdenNuevo" class="form-control" placeholder="EJ: 2" maxlength="5">
                            </div>
                            <!--<div class="form-group">
                                <label>Estatus</label>
                                <select class="form-control" id="listEstatusNuevo" name="listEstatusNuevo" required >
                                <option value="">Selecciona un Estatus</option>
                                <option value="1">Activo</option>
                                <option value="2">Inactivo</option>
                                </select>
                            </div>-->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" data-dismiss="modal" id="dimissModalNuevo"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>
                    <button id="btnActionFormNuevo" type="submit" class="btn btn-outline-secondary btn-primary icono-color-principal btn-inline"><i class="fa fa-fw fa-lg fa-check-circle icono-azul"></i><span id="btnText"> Guardar</span></button>
                </div>   
            </form> 
        </div>
    </div>
</div>