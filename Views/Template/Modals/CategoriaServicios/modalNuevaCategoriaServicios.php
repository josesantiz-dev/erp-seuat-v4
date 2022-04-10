<div class="modal fade" id="modalFormCategoria_servicios" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">Nueva categoría</h5>
                <button type="button" class="close cerrarModal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <small class="text-muted pb-4">Los campos con asterisco (<span class="required">*</span>) son obligatorios..</small>
                <div class="card card-dark">
                    <form id="formCategoria_servicios" name="formCategoria_servicios" autocomplete="off">
                        <input type="hidden" id="idCategoria_servicios" name="idCategoria_servicios" value="0">
                        <input type="hidden" id="listEstatus" name="listEstatus" value="1">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="txtNombre_categoria">Clave categoría <span class="required">*</span></label>
                                <input type="text" id="txtClave_categoria" name="txtClave_categoria" class="form-control valid validText" placeholder="Ingrese una clave de categoría" maxlength='70' required="" autofocus>
                            </div>
                            <div class="form-group">
                                <label for="txtNombre_categoria">Nombre categoría <span class="required">*</span></label>
                                <input type="text" id="txtNombre_categoria" name="txtNombre_categoria" class="form-control valid validText" placeholder="Ingrese una nueva categoría" maxlength='100'  required="" autofocus>
                            </div>
                            <div class="form-row">
								<div class="form-group col-sm-12 col-md-12">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="chk_aplica_colegiatura" name="chk_aplica_colegiatura">
                                        <label for="chk_aplica_colegiatura" class="custom-control-label">Aplica a colegitura</label>
                                    </div>
								</div>
							</div>

                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-outline-secondary icono-color-principal btn-inline cerrarModal" href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>
                <button id="btnActionForm" type="submit" class="btn btn-primary btn-inline"><i class="fa fa-fw fa-lg fa-check-circle icono-azul"></i> Guardar</button>
            </div>  
            </form>
        </div>
    </div>
</div>