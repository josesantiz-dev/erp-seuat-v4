<div class="modal fade" id="modal_buscar_servicios" data-backdrop="static" data-keyboard="true" tabindex="-1"
    role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Buscar servicios</h5>
                <button type="button" class="close cerrarModalEdit" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-dark">
                    <form id="form_servicio_edit" name="form_servicio_edit" autocomplete="off">
<!--                         <input type="hidden" id="intId_servicio_edit" name="intId_servicio_edit" value="">
                        <input type="hidden" id="intId_precio_unitario" name="intId_precio_unitario" value=""> -->
                        <div class="card-body">
                            <div class="d-flex justify-content-center"><input type="text" class="form-control col-6" id="busquedaServicio" placeholder="Ingrese el nombre del servicio" maxlength="100" autocomplete="off" onkeyup="buscarServicio();"></div>
                            <br>
                            <table id="tableServicios" class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Código</th>
                                        <th>Subcódigo</th>
                                        <th>Precio</th>
                                        <th>Año fiscal</th>
                                        <th width="10%">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-outline-secondary icono-color-principal btn-inline cerrarModal" href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>
            </div>
            </form>
        </div>
    </div>
</div>