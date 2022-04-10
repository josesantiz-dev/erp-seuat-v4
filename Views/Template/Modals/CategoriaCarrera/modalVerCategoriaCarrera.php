<!-- Modal -->
<div class="modal fade" id="ModalFormVerCategoriaCarrera" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModalVer"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">
                    <form id="formCategoriaVer" name="formCategoriaVer">
                        <input type="hidden" id="idCategoriaVer" name="idCategoriaVer" value="">
                        <div class="card-body"> 
                            <div class="form-group">
                                <label>Nombre categoría</label>
                                <input type="text" id="txtNombreCategoriaVer" name="txtNombrecategoriaVer" class="form-control form-control-sm" disabled>
                            </div>
                            <div class="form-group">
                                <label>Estatus</label>
                                <select class="form-control form-control-sm" id="listEstatusCategoriaVer" name="listEstatusCategoriaVer" disabled>
                                <option value="">Selecciona un estatus</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" data-dismiss="modal" id="dimissModalVer"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cerrar</a>
                </div>   
            </form> 
        </div>
    </div>
</div>