<div class="modal fade" id="modal_editar_servicio" data-backdrop="static" data-keyboard="true" tabindex="-1"
    role="dialog" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar servicio</h5>
                <button type="button" class="close cerrarModalEdit" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-dark">
                    <form id="form_servicio_edit" name="form_servicio_edit" autocomplete="off">
                        <input type="hidden" id="intId_servicio_edit" name="intId_servicio_edit" value="">
                        <input type="hidden" id="intId_precio_unitario" name="intId_precio_unitario" value="">
                        <div class="card-body">
                            <div class="form-group text-center">
                                <h3><strong><span id="txtNombre_servicio_edit">COLEGIATURA TUXTLA CT</span></strong></h3>
                            </div>
                            <div class="form-group">
                                <label for="txtNombre_promocion">Precio actual</label>
                                <input type="text" id="intPrecio_actual_edit" name="intPrecio_actual_edit"
                                    class="form-control form-control-sm valid validText"
                                    placeholder="Ingrese el nombre de una promoción" maxlength="45" disabled>
                            </div>
                            <div class="form-group border shadow-sm p-3 mb-4 rounded" style="background-color:#ebebec">
                                <div class="form-group  text-center">
                                    <label for="inputCity"><b>Nuevo precio</b></label>
                                    <input type="number" id="intNuevo_precio_edit"
                                        name="intNuevo_precio_edit" min="1" 
                                        class="form-control invalid text-center" style="height:50px; font-size: 24px"
                                        required="">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="txtFecha_limite_pago">Fecha limite pago</label>
                                <input type="date" class="form-control form-control-sm" id="txtFecha_limite_pago" name="txtFecha_limite_pago" required>
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-outline-secondary icono-color-principal btn-inline cerrarModal" href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>
                <button id="btnActionForm" type="submit" class="btn btn-primary btn-inline">
                    <i class="fa fa-fw fa-lg fa-check-circle icono-azul"></i> Actualizar
                </button>
            </div>
            </form>
        </div>
    </div>
</div>