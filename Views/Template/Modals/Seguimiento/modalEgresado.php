<!-- Modal -->
<div class="modal fade" id="ModalEgresadoSeguimiento" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header headerUpdate">
                <h5 class="modal-title" id="titleModalNueva">Egresado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">

                    <form id="formEgresado" name="formEgresado">
                        <div class="card-body">
                            <div class="card">
                                <h5 class="card-title">Nivel educativo egreso</h5>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="" class="text-sm font-weight-bold">Carrera de egreso</label>
                                        </div>
                                        <div class="col-md-8">
                                            <label for="" class="text-md text-muted">Carrera de egreso</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="" class="text-sm font-weight-bold">Promedio de egreso</label>
                                        </div>
                                        <div class="col-md-8">
                                            <label for="" class="text-md text-muted">Promedio de egreso</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <label for="">Carrera deseada</label>
                                        <select class="form-control form-control-sm" name="slctCarreraDeseada" id="slctCarreraDeseada"></select>
                                    </div>
                                    <div class="row">
                                        <label for="">Empresa deseada donde trabajar</label>
                                        <input type="text" name="txtEmpresaTrabajo" id="txtEmpresaTrabajo" class="form-control form-control-sm" placeholder="EJ: Corporación S.A. de C.V.">
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" data-dismiss="modal" id="dimissModalEdit"><i class="fa fa-fw fa-lg fa-times-circle icono-azul" id="cancelarModalTurnoEdit"></i>Cancelar</a>
                <button id="btnActionFormEdit" type="submit" class="btn btn-outline-secondary icono-color-principal btn-inline"><i class="fa fa-fw fa-lg fa-check-circle icono-azul"></i><span id="btnText"> Actualizar</span></button>
            </div>
            </form>
        </div>
    </div>
</div>