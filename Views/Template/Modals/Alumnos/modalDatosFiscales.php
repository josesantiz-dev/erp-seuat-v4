<!-- Modal -->
<div class="modal fade" id="ModalFormDatosFiscales" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header headerUpdated">
                <h5 class="modal-title" id="titleModalEdit">Datos de facturación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">
                    <form id="formDatosFiscales" name="formDatosFiscales">
                        <input type="hidden" id="idPersonaDatosFis" name="idPersonaDatosFis" value="">
                        <div class="card-body">
                            <div class="row" >
                                    <div class="form-group col-md-12">
                                        <label>Nombre del alumno</label>
                                        <input type="text" id="txtNombreAlumno" class="form-control form-control-sm" disabled>
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label>RFC</label>
                                        <input type="text" id="txtRFC" name="txtRFC" class="form-control form-control-sm" placeholder="RFC" maxlength="15" required>
                                    </div>
                                    <div class="form-group col-md-7">
                                        <label>Nombre social</label>
                                        <input type="text" id="txtNombreSocial" name="txtNombreSocial" class="form-control form-control-sm" placeholder="Nombre social"  maxlength="180" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>CP</label>
                                        <input type="text" id="txtCP" name="txtCP" class="form-control form-control-sm" onkeypress="return validarNumeroInput(event)" placeholder="CP"   maxlength="5" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Teléfono</label>
                                        <input type="text" id="txtTelefono" name="txtTelefono" class="form-control form-control-sm" onkeypress="return validarNumeroInput(event)" placeholder="Teléfono"   maxlength="10" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Email</label>
                                        <input type="text" id="txtEmail" name="txtEmail" class="form-control form-control-sm" placeholder="Email"  maxlength="100" required>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Dirección</label>
                                        <textarea id="txtDireccion" name="txtDireccion" class="form-control form-control-sm" placeholder="Dirección" rows='2' maxlength="200" required></textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Lugar</label>
                                        <textarea id="txtLugar" name="txtLugar" class="form-control form-control-sm" placeholder="Lugar" rows='1' maxlength="100" required></textarea>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" data-dismiss="modal" id="dimissModalEdit"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>
                    <button id="btnActionFormEdit" type="submit" class="btn btn-outline-secondary icono-color-principal btn-primary btn-inline"><i class="fa fa-fw fa-lg fa-check-circle icono-azul"></i><span id="btnText">Guardar</span></button>
                </div>   
            </form> 
        </div>
    </div>
</div>