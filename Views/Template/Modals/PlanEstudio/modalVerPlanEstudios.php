<!-- Modal -->
<div class="modal fade" id="ModalFormVerPlanEstudios" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModalNuevo">Ver plan de estudios</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">
                    <form id="formPlanEstudiosVer" name="formPlanEstudiosVer">
                        <input type="hidden" id="" name="" value="">
                        <div class="card-body"> 
                                <div class="card card-light p-2">
                                    <h5 class="card-header"><b>CARRERA</b></h5>
                                    <div class="row">
                                            <div class="form-group col-md-8">
                                                <label>Nombre</label>
                                                <input type="text" id="txtNombreVer" name="txtNombreVer" class="form-control form-control-sm"  disabled>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Nombre corto</label>
                                                <input type="text" id="txtNombrecortoVer" name="txtNombrecortoVer" class="form-control form-control-sm"  disabled>
                                            </div>
                                            <div class="form-group col-md-8">
                                                <label>Plantel</label>
                                                <select class="form-control form-control-sm" id="listPlantelVer" name="listPlantelVer"  disabled>
                                                    <option value="">Selecciona un Plantel</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Nivel educativo</label>
                                                <select class="form-control form-control-sm" id="listNivelEdVer" name="listNivelEdVer"  disabled>
                                                    <option value="">Selecciona un Nivel Educativo</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Categoría</label>
                                                <select class="form-control form-control-sm" id="listCategoriaVer" name="listCategoriaVer"  disabled>
                                                    <option value="">Selecciona una Categoria</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Duración</label>
                                                <input type="text" id="txtDuracionVer" name="txtDuracionVer" class="form-control form-control-sm"  disabled>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Materias totales</label>
                                                <input type="text" id="txtMatTotalesVer" name="txtMatTotalesVer" class="form-control form-control-sm"  disabled>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Total horas</label>
                                                <input type="text" id="txtTotalHrsVer" name="txtTotalHrsVer" class="form-control form-control-sm"  disabled>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Calificacion mínima</label>
                                                <input type="text" id="txtCalMinVer" name="txtCalMinVer" class="form-control form-control-sm"  disabled>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Modalidad</label>
                                                <select class="form-control form-control-sm" id="listModalidadVer" name="listModalidadVer"  disabled>
                                                    <option value="">Selecciona una Modalidad</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Total créditos</label>
                                                <input type="text" id="listTotalCreditosVer" name="listTotalCreditosVer" class="form-control form-control-sm"  disabled>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Plan</label>
                                                <select class="form-control form-control-sm" id="listPlanVer" name="listPlanVer"  disabled>
                                                    <option value="">Selecciona un Plan</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Estatus</label>
                                                <select class="form-control form-control-sm" id="listEstatusVer" name="listEstatusVer"  disabled>
                                                <option value="">Selecciona un Status</option>
                                                <option value="1">Activo</option>
                                                <option value="2">Inactivo</option>
                                                </select>
                                            </div>
                                    </div>
                                </div><br>
                                <div class="card card-light p-2">
                                    <h5 class="card-header"><b>RVOE</b></h5>
                                    <div class="row">
                                            <div class="form-group col-md-4">
                                                <label>Clave de profesiones</label>
                                                <input type="text" id="txtClaveProfVer" name="txtClaveProfVer" class="form-control form-control-sm"  disabled>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Tipo RVOE</label>
                                                <select class="form-control form-control-sm" id="listTipoRvoeVer" name="listTipoRvoeVer"  disabled>
                                                <option value="">Selecciona un Status</option>
                                                <option value="0">Estatal</option>
                                                <option value="1">Federal</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>RVOE</label>
                                                <input type="text" id="txtRvoeVer" name="txtRvoeVer" class="form-control form-control-sm"  disabled>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Fecha vigencia</label>
                                                <input type="text" id="txtFechaVigenciaVer" name="txtFechaVigenciaVer" class="form-control form-control-sm"  disabled>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Fecha de otorgamiento</label>
                                                <input type="date" id="txtFechaOtorgamientoVer" name="txtFechaOtorgamientoVer" class="form-control form-control-sm"  disabled>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Fecha de actualización</label>
                                                <input type="date" id="txtFechaActualizacionVer" name="txtFechaActualizacionVer" class="form-control form-control-sm"  disabled>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Turno</label>
                                                <select class="form-control form-control-sm" id="listTunoRvoeVer"  disabled>
                                                <option value="">Selecciona un turno</option>
                                                <option value="matutino">Matutino</option>
                                                <option value="vespertino">Vespertino</option>
                                                <option value="mixto">Mixto</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-8">
                                                <label>Clasificaciones</label>
                                                <div id="clasificacionesVer" class="row">
                                                </div>
                                            </div>
                                    
                                    </div>
                                </div><br>
                                <div class="card card-light p-2">
                                    <h5 class="card-header"><b>Perfil</b></h5>
                                    <div class="form-group">
                                        <label>Perfil de ingreso</label>
                                        <textarea type="text" id="txtPerfilIngresoVer" name="txtPerfilIngresoVer" class="form-control form-control-sm" rows="3" disabled></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Perfil de egreso</label>
                                        <textarea type="text" id="txtPerfilEgresoVer" name="txtPerfilEgresoVer" class="form-control form-control-sm"  rows="3" disabled></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Campo laboral</label>
                                        <textarea type="text" id="txtCampoLaboralVer" name="txtCampoLaboralVer" class="form-control form-control-sm"  rows="3"  disabled></textarea>
                                    </div>
                                </div>       
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div style="overflow:auto;">
                        <div style="float:right;">
                            <a class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" data-dismiss="modal" id="dimissModalNuevo"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a> 
                        </div>
                    </div>
                </div>   
            </form> 
        </div>
    </div>
</div>