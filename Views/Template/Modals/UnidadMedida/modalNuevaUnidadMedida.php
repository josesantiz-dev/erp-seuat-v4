<div class="modal fade" id="modalFormUnidad_medida" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nueva unidad de medida</h5>
                <button type="button" class="close cerrarModal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <small class="text-muted pb-4">Los campos con asterisco (<span class="required">*</span>) son obligatorios..</small>
                <div class="card card-dark">
                    <form id="formUnidad_medida" name="formUnidad_medida" autocomplete="off">
                        <input type="hidden" id="idUnidad_medida" name="idUnidad_medida" value="">
                        <input type="hidden" id="listEstatus" name="listEstatus" value="1">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="txtTipo">Tipo <span class="required">*</span></label>
                                <input type="text" id="txtTipo" name="txtTipo" class="form-control valid validText" placeholder="Ingrese el tipo de unidad de medida" required="" maxlength="100" autofocus>
                            </div>
                            <div class="form-group">
                                <label for="txtClave">Clave <span class="required">*</span></label>
                                <input type="text" id="txtClave" name="txtClave" class="form-control valid validText" placeholder="Ingrese la clave de unidad de medida" required="" maxlength="30" autofocus>
                            </div>
                            <div class="form-group">
                                <label for="txtNombre">Nombre unidad de medida <span class="required">*</span></label>
                                <input type="text" id="txtNombre" name="txtNombre" class="form-control valid validText" placeholder="Ingrese el nombre de la nueva unidad de medida" required="" maxlength="70" autofocus>
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