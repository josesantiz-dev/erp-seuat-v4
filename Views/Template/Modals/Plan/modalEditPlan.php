<!-- Modal -->
<div class="modal fade" id="ModalFormEditPlan" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header headerUpdate">
                <h5 class="modal-title" id="titleModalEdit">Editar plan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">
                    <form id="formPlanEdit" name="formPlanEdit">
                        <input type="hidden" id="idEdit" name="idEdit" value="">
                        <div class="card-body"> 
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" id="txtNombreEdit" name="txtNombreEdit" class="form-control" placeholder="EJ: Semestral"  maxlength="30" required>
                            </div>
                            <div class="form-group">
                                <label>Abreviatura</label>
                                <input type="text" id="txtAbreviaturaEdit" name="txtAbreviaturaEdit" class="form-control" placeholder="EJ: sm"  maxlength="10" required>
                            </div>
                            <div class="form-group">
                                <label>Estatus</label>
                                <select class="form-control" id="listEstatusEdit" name="listEstatusEdit" >
                                <option value="">Selecciona un Estatus</option>
                                <option value="1">Activo</option>
                                <option value="2">Inactivo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" data-dismiss="modal" id="dimissModalEdit"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>
                    <button id="btnActionFormEdit" type="submit" class="btn btn-outline-secondary icono-color-principal btn-primary btn-inline"><i class="fa fa-fw fa-lg fa-check-circle icono-azul"></i><span id="btnText"> Actualizar</span></button>
                </div>   
            </form> 
        </div>
    </div>
</div>