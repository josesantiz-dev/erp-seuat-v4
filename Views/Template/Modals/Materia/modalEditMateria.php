<!-- Modal -->
<div class="modal fade" id="ModalFormEditMateria" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header headerUpdaded">
                <h5 class="modal-title" id="titleModalEdit">Editar materia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">
                    <form id="formMateriaEdit" name="formMateriaEdit">
                        <input type="hidden" id="idEdit" name="idEdit" value="">
                        <div class="card-body">
                            <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Nombre de la materia</label>
                                        <input type="text" id="txtNombreEdit" name="txtNombreEdit" class="form-control form-control-sm" placeholder="Nombre de la materia"  maxlength="100" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Clave</label>
                                        <input type="text" id="txtClaveEdit" name="txtClaveEdit" class="form-control form-control-sm" placeholder="Clave de la materia"  maxlength="10" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Horas teoría</label>
                                        <input type="text" id="txtHorasTeoriaEdit" onkeypress="return validarNumeroInput(event)" name="txtHorasTeoriaEdit" class="form-control form-control-sm" placeholder="Horas de teoría"  maxlength="3" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Horas práctica</label>
                                        <input type="text" id="txtHorasPracticaEdit" onkeypress="return validarNumeroInput(event)" name="txtHorasPracticaEdit" class="form-control form-control-sm" placeholder="Horas de práctica"  maxlength="3" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Créditos</label>
                                        <input type="text" id="txtCreditosEdit" onkeypress="return validarNumeroInput(event)" name="txtCreditosEdit" class="form-control form-control-sm" placeholder="Créditos de la materia" maxlength="2" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Tipo</label>
                                        <select class="form-control form-control-sm" id="listTipoEdit" name="listTipoEdit" required >
                                            <option value="">Selecciona el Tipo</option>
                                            <option value="1">Básica</option>
                                            <option value="2">Ordinaria</option>
                                        </select>                                    
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Grado</label>
                                        <select class="form-control form-control-sm" id="listGradoEdit" name="listGradoEdit" required >
                                            <option value="">Selecciona un Grado</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-7">
                                        <label>Plantel</label>
                                        <select class="form-control form-control-sm" id="listPlantelEdt" name="listPlantelEdit" onchange="plantelSeleccionadoEdit(value)" required >
                                            <option value="">Selecciona un Plantel</option>
                                            <?php
                                                foreach ($data['plantel'] as $value) {
                                                    ?>
                                                        <option value="<?php echo $value['id'] ?>"><?php echo($value['nombre_plantel'].' ('.$value['municipio'].')') ?></option>
                                                    <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label>Plan de estudios</label>
                                        <select class="form-control form-control-sm" id="listPlanEstudioEdit" name="listPlanEstudioEdit" required >
                                            <option value="">Selecciona un Plan de Estudio</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Clasificación</label>
                                        <select class="form-control form-control-sm" id="listClasificacionEdit" name="listClasificacionEdit" required >
                                            <option value="">Selecciona una Clasificación</option>
                                            <?php foreach ($data['clasificacion_materia'] as $key => $value) {
                                                ?>
                                                    <option value="<?php echo $value['id']?>"><?php echo $value['nombre_clasificacion_materia'] ?></option>
                                                <?php
                                            }?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Estatus</label>
                                        <select class="form-control form-control-sm" id="listEstatusEdit" name="listEstatusEdit" required >
                                            <option value="">Selecciona un Estatus</option>
                                        </select>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" data-dismiss="modal" id="dimissModalEdit"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>
                    <button id="btnActionFormEdit" type="submit" class="btn btn-outline-secondary icono-color-principal btn-primary btn-inline"><i class="fa fa-fw fa-lg fa-check-circle icono-azul"></i><span id="btnText"> Actualizar</span></button>
                </div>   
            </form> 
        </div>
    </div>
</div>