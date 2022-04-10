<div class="modal fade" id="modalFormCategoria_servicios_editar" data-backdrop="static" data-keyboard="false"
    tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar categoría</h5>
                <button type="button" class="close cerrarModal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <small class="text-muted">Los campos con asterisco (<span class="required">*</span>) son
                    obligatorios.</small>
                <div class="card mt-1">
                    <form id="formCategoria_serviciosup" name="formCategoria_serviciosup" autocomplete="off">
                        <input type="hidden" id="idCategoria_serviciosup" name="idCategoria_serviciosup">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="txtClave_categoria">Clave categoría <span class="required">*</span></label>
                                <input type="text" id="txtClave_categoriaup" name="txtClave_categoriaup"
                                    class="form-control valid validText" placeholder="Ingrese una nueva categoría" maxlength='70'
                                    required="">
                            </div>
                            <div class="form-group">
                                <label for="txtNombre_categoria">Nombre categoría <span
                                        class="required">*</span></label>
                                <input type="text" id="txtNombre_categoriaup" name="txtNombre_categoriaup"
                                    class="form-control valid validText" placeholder="Ingrese una nueva categoría"
                                    name="Ingresa el nombre de la categoría" maxlength='100' required="">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-sm-12 col-md-12">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="chk_aplica_colegiatura_edit"
                                            name="chk_aplica_colegiatura_edit">
                                        <label for="chk_aplica_colegiatura_edit" class="custom-control-label">Aplica a
                                            colegitura</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Estatus <span class="required">*</span></label>
                                <select class="custom-select" id="listEstatusup" name="listEstatusup" required="">
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