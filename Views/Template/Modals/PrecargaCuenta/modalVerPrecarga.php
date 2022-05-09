<div class="modal fade" id="modal_ver_servicio" data-backdrop="static" data-keyboard="true" tabindex="-1"
    role="dialog" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ver servicio</h5>
                <button type="button" class="close cerrarModalEdit" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-dark">
                    <form id="form_servicio_ver" name="form_servicio_ver" autocomplete="off">
                        <input type="hidden" id="intId_servicio_ver" name="intId_servicio_ver" value="">
                        <input type="hidden" id="intId_precio_unitario" name="intId_precio_unitario" value="">
                        <div class="card-body">
                            <div class="form-group text-center">
                                <h3><strong><span id="txtNombre_servicio_ver">COLEGIATURA TUXTLA CT</span></strong></h3>
                            </div>
                            <div class="form-group">
                                <label for="txtNombre_promocion">Precio actual</label>
                                <input type="text" id="intPrecio_actual_ver" name="intPrecio_actual_ver"
                                    class="form-control form-control-sm valid validText"
                                    placeholder="Ingrese el nombre de una promoción" maxlength="45" disabled>
                            </div>
                            <div class="form-group border shadow-sm p-3 mb-4 rounded" style="background-color:#ebebec">
                                <div class="form-group  text-center">
                                    <label for="inputCity"><b>Nuevo precio</b></label>
                                    <input type="number" id="intNuevo_precio_ver"
                                        name="intNuevo_precio_ver" min="1" max="100000"
                                        class="form-control invalid text-center" style="height:50px; font-size: 24px"
                                        disabled>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="txtFecha_limite_pago_ver">Fecha limite pago</label>
                                <input type="date" class="form-control form-control-sm" id="txtFecha_limite_pago_ver" name="txtFecha_limite_pago_ver" disabled>
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-outline-secondary icono-color-principal btn-inline cerrarModal" href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cerrar</a>
                <!-- <button id="btnActionForm" type="submit" class="btn btn-primary btn-inline">
                    <i class="fa fa-fw fa-lg fa-check-circle icono-azul"></i> Actualizar
                </button> -->
            </div>
            </form>
        </div>
    </div>
</div>