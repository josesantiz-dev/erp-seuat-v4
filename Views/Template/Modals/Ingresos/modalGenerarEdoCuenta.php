<!-- Modal -->
<div class="modal fade" id="modalFormGenerarEdoCuenta" tabindex="-1" role="dialog" aria-labelledby="modalFormGenerarEdoCuenta" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title">Generar estado de cuenta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">
                    <form id="formGenerarEdoCuenta" name="formGenerarEdoCuenta">
                        <div class="card-body">
                            <div class="row" >
                                <div class="alert alert-warning" role="alert">
                                    Para generar un estado de cuenta, es necesario seleccionar el tipo de <b>comprobante</b> y la <b>forma de pago</b> que realizará el Alumno.
                                </div>
                                <div class="form-group col-12">
                                    <label>Tipo de comprobante</label>
                                    <select class="form-control" id="litsTipoComprobante" name="litsTipoComprobante" required >
                                        <option value="">Selecciona un tipo</option>
                                        <option value="1">Factura</option>
                                        <option value="2">Nota sencilla</option>
                                    </select>  
                                </div>
                                <div class="form-group col-12">
                                    <label>Forma de pago</label>
                                    <select class="form-control" id="listFormaPago" name="listFormaPago" required >
                                        <option value="">Selecciona una</option>
                                        <option value="1">Tarjeta crédito</option>
                                        <option value="2">Efectivo</option>
                                        <option value="3">Transferencia</option>
                                    </select>  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" data-dismiss="modal" id="cerrarModalGenerarEdoCuenta"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>
                    <button type="submit" class="btn btn-outline-secondary btn-primary icono-color-principal btn-inline"><i class="fa fa-fw fa-lg fa-check-circle icono-azul"></i><span id="btnText"> Generar estado de cuenta</span></button>
                </div>  
            </form> 
        </div>
    </div>
</div>