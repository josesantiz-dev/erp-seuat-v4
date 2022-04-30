<div class="modal fade" id="modal_editar_precarga" data-backdrop="static" data-keyboard="true" tabindex="-1"
    role="dialog" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar precarga cuenta</h5>
                <button type="button" class="close cerrarModalEdit" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-dark">
                    <form id="form_precarga_edit" name="form_precarga_edit" autocomplete="off">
                        <input type="hidden" id="intId_precarga_edit" name="intId_precarga_edit">
                        <!-- <input type="hidden" id="intId_precio_unitario" name="intId_precio_unitario" value=""> -->
                        <input type="hidden" id="txtId_Usuario_ActualizacionUp" name="txtId_Usuario_ActualizacionUp">
                        <input type="hidden" id="txtFecha_ActualizacionUp" name="txtFecha_ActualizacionUp" value="">
                        <div class="card-body">
                            <div class="form-group text-center">
                                <h3><strong><span id="txtNombre_servicio_edit"></span></strong></h3>
                            </div>
                            <!-- <div class="form-group">
                                <label for="txtNombre_promocion">Precio actual</label>
                                <input type="text" id="intPrecio_actual_precarg_edit" name="intPrecio_actual_precarg_edit"
                                    class="form-control form-control-sm valid validText"
                                    placeholder="Ingrese el nombre de una promoción" maxlength="45" disabled>
                            </div> -->
                            <div class="form-group border shadow-sm p-3 mb-4 rounded" style="background-color:#ebebec">
                                <div class="form-group  text-center">
                                    <label for="intNuevo_precio_precarg_edit"><b>Nuevo precio</b></label>
                                    <input type="number" id="intNuevo_precio_precarg_edit"
                                        name="intNuevo_precio_precarg_edit" min="1" 
                                        class="form-control invalid text-center" style="height:50px; font-size: 24px"
                                        required="">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="txtFecha_limite_pago_pre_edit">Fecha limite pago</label>
                                <input type="date" class="form-control form-control-sm" id="txtFecha_limite_pago_pre_edit" name="txtFecha_limite_pago_pre_edit" required>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Estatus <span class="required">*</span></label>
                                    <select class="custom-select" id="listEstatusUp" name="listEstatusUp" required>
                                    <option value="1">Activo</option>
                                    <option value="2">Inactivo</option>
                                    </select>
                                </div>
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