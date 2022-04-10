<div class="modal fade" id="modalFormUnidad_medida_editar" data-backdrop="static" data-keyboard="false" tabindex="-1"
    role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar unidad de medida</h5>
                <button type="button" class="close cerrarModal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <small class="text-muted">Los campos con asterisco (<span class="required">*</span>) son
                    obligatorios.</small>
                <div class="card mt-1">
                    <form id="formUnidad_medida_editar" name="formUnidad_medida_editar" autocomplete="off">
                        <input type="hidden" id="idUnidad_medidaup" name="idUnidad_medidaup">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="txtTipoEdit">Tipo <span class="required">*</span></label>
                                <input type="text" id="txtTipoEdit" name="txtTipoEdit" class="form-control valid validText" placeholder="Ingrese el tipo de unidad de medida" required="" maxlength="100" autofocus>
                            </div>
                            <div class="form-group">
                                <label for="txtClaveEdit">Clave <span class="required">*</span></label>
                                <input type="text" id="txtClaveEdit" name="txtClaveEdit" class="form-control valid validText" placeholder="Ingrese la clave de unidad de medida" required="" maxlength="30" autofocus>
                            </div>
                            <div class="form-group">
                                <label for="txtNombreEdit">Nombre unidad de medida <span
                                        class="required">*</span></label>
                                <input type="text" id="txtNombreEdit" name="txtNombreEdit"
                                    class="form-control valid validText" placeholder="Ingrese una nueva categoría"
                                    name="Ingresa el nombre de la categoría" required="">
                            </div>
                            <div class="form-group">
                                <label>Estatus <span class="required">*</span></label>
                                <select class="custom-select" id="listEstatusEdit" name="listEstatusEdit" required="">
                                    <option value="1">Activo</option>
                                    <option value="2">Inactivo</option>
                                </select>
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-outline-secondary icono-color-principal btn-inline cerrarModal" href="#"
                    data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>
                <button id="btnActionForm" type="submit" class="btn btn-primary btn-inline"><i
                        class="fa fa-fw fa-lg fa-check-circle icono-azul"></i> Actualizar</button>
            </div>
            </form>
        </div>
    </div>
</div>