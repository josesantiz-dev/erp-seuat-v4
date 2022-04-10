<!-- Modal -->
<div class="modal fade" id="ModalFormEditTutor" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header headerUpdated">
                <h5 class="modal-title" id="titleModalEdit">Editar Tutor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">
                    <form id="formEditTutor" name="formEditTutor">
                        <input type="hidden" id="idEditTutor" name="idEditTutor" value="">
                        <div class="card-body">
                            <div class="row" >
                                <div class="form-group col-md-4">
                                    <label>Nombre</label>
                                    <input type="text" id="txtNombreTutor" name="txtNombreTutor" class="form-control form-control-sm" placeholder="Nombre"  required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Apellido Paterno</label>
                                    <input type="text" id="txtAppPaternoTutor" name="txtAppPaternoTutor" class="form-control form-control-sm" placeholder="Apellido Paterno" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Apellido Materno</label>
                                    <input type="text" id="txtAppMaternoTutor" name="txtAppMaternoTutor" class="form-control form-control-sm" placeholder="Apellido Materno"  required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Teléfono Celular</label>
                                    <input type="text" id="txtTelCelularTutor" name="txtTelCelularTutor" class="form-control form-control-sm" placeholder="Telefono Celular"  >
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Teléfono Fijo</label>
                                    <input type="text" id="txtTelFijoTutor" name="txtTelFijoTutor" class="form-control form-control-sm" placeholder="Telefono Fijo"  >
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Email</label>
                                    <input type="text" id="txtEmailTutor" name="txtEmailTutor" class="form-control form-control-sm" placeholder="Email">
                                </div>  
                                <div class="form-group col-md-12">
                                    <label>Direccion</label>
                                    <textarea id="txtDireccionTutor" name="txtDireccionTutor" class="form-control form-control-sm" placeholder="Direccion" required=""></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" data-dismiss="modal" id="dimissModalEdit"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>
                    <button id="btnActionFormEdit" type="submit" class="btn btn-outline-secondary icono-color-principal btn-inline"><i class="fa fa-fw fa-lg fa-check-circle icono-azul"></i><span id="btnText">Actualizar</span></button>
                </div>   
            </form> 
        </div>
    </div>
</div>