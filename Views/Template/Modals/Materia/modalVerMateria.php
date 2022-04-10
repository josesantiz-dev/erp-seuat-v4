<!-- Modal -->
<div class="modal fade" id="ModalFormVerMateria" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModalVer"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">
                    <form id="formMateriaVer" name="formMateriaVer">
                        <input type="hidden" id="idVer" name="idVer" value="">
                        <div class="card-body">
                            <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Nombre de la materia</label>
                                        <input type="text" id="txtNombreVer" name="txtNombreVer" class="form-control form-control-sm"  disabled>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Clave</label>
                                        <input type="text" id="txtClaveVer" name="txtClaveVer" class="form-control form-control-sm"  disabled>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Horas teoría</label>
                                        <input type="text" id="txtHorasTeoriaVer" name="txtHorasTeoriaVer" class="form-control form-control-sm"  disabled>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Horas práctica</label>
                                        <input type="text" id="txtHorasPracticaVer" name="txtHorasPracticaVer" class="form-control form-control-sm"  disabled>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Créditos</label>
                                        <input type="text" id="txtCreditosVer" name="txtCreditosVer" class="form-control form-control-sm" disabled>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Tipo</label>
                                        <select class="form-control form-control-sm" id="listTipoVer" name="listTipoVer" disabled >
                                            <option value="">Selecciona el Tipo</option>
                                            <option value="1">Básica</option>
                                            <option value="2">Ordinaria</option>
                                        </select>                                    
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Grado</label>
                                        <select class="form-control form-control-sm" id="listGradoVer" name="listGradoVer" disabled >
                                            <option value="">Selecciona un Grado</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Plantel</label>
                                        <select class="form-control form-control-sm" id="listPlantelVer" name="listPlantelVer" disabled >
                                            <option value="">Selecciona un Plantel</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-9">
                                        <label>Plan de estudios</label>
                                        <select class="form-control form-control-sm" id="listPlanEstudioVer" name="listPlanEstudioVer" disabled >
                                            <option value="">Selecciona un Plan de Estudio</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Clasificación</label>
                                        <select class="form-control form-control-sm" id="listClasificacionVer" name="listClasificacionVer" disabled >
                                            <option value="">Selecciona una Clasificación</option>
                                            <?php foreach ($data['clasificacion_materia'] as $key => $value) {
                                                ?>
                                                    <option value="<?php echo $value['id']?>"><?php echo $value['nombre_clasificacion_materia'] ?></option>
                                                <?php
                                            }?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Estatus</label>
                                        <select class="form-control form-control-sm" id="listEstatusVer" name="listEstatusVer" disabled >
                                            <option value="">Selecciona un Estatus</option>
                                        </select>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" data-dismiss="modal" id="dimissModalVer"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>
                </div>   
            </form> 
        </div>
    </div>
</div>