<!-- Modal -->
<div class="modal fade" id="ModalFormNuevaMateria" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModalNuevo">Nueva materia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">
                    <form id="formMateriaNueva" name="formMateriaNueva">
                        <input type="hidden" id="idNuevo" name="idNuevo" value="">
                        <div class="card-body">
                            <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Nombre de la materia</label>
                                        <input type="text" id="txtNombreNuevo" name="txtNombreNuevo" class="form-control form-control-sm" placeholder="Nombre de la materia" maxlength="100" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Clave</label>
                                        <input type="text" id="txtClaveNuevo" name="txtClaveNuevo" class="form-control form-control-sm" placeholder="Clave de la materia" maxlength="10" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Horas teoría</label>
                                        <input type="text" id="txtHorasTeoriaNuevo" onkeypress="return validarNumeroInput(event)" name="txtHorasTeoriaNuevo" class="form-control form-control-sm" placeholder="Horas de teoría" maxlength="3" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Horas práctica</label>
                                        <input type="text" id="txtHorasPracticaNuevo" onkeypress="return validarNumeroInput(event)" name="txtHorasPracticaNuevo" class="form-control form-control-sm" placeholder="Horas de práctica" maxlength="3" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Créditos</label>
                                        <input type="text" id="txtCreditosNuevo" onkeypress="return validarNumeroInput(event)" name="txtCreditosNuevo" class="form-control form-control-sm" placeholder="Créditos de la materia" maxlength="2" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Tipo</label>
                                        <select class="form-control form-control-sm" id="listTipoNuevo" name="listTipoNuevo" required >
                                            <option value="">Selecciona el Tipo</option>
                                            <option value="1">Básica</option>
                                            <option value="2">Ordinaria</option>
                                        </select>                                    
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Grado</label>
                                        <select class="form-control form-control-sm" id="listGradoNuevo" name="listGradoNuevo" required >
                                            <option value="">Selecciona un Grado</option>
                                            <?php
                                                foreach ($data['grados'] as $value) {
                                                    ?>
                                                        <option value="<?php echo $value['id'] ?>"><?php echo($value['nombre_grado'].'('.$value['numero_romano'].')') ?></option>
                                                    <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Plantel</label>
                                        <select class="form-control form-control-sm" id="listPlantelNuevo" name="listPlantelNuevo" onchange="plantelSeleccionado(value)" required >
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
                                    <div class="form-group col-md-9">
                                        <label>Plan de estudios</label>
                                        <select class="form-control form-control-sm" id="listPlanEstudioNuevo" name="listPlanEstudioNuevo" required >
                                            <option value="">Selecciona un Plan de Estudio</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Clasificación</label>
                                        <select class="form-control form-control-sm" id="listClasificacionNuevo" name="listClasificacionNuevo" required >
                                            <option value="">Selecciona una Clasificación</option>
                                            <?php foreach ($data['clasificacion_materia'] as $key => $value) {
                                                ?>
                                                    <option value="<?php echo $value['id']?>"><?php echo $value['nombre_clasificacion_materia'] ?></option>
                                                <?php
                                            }?>
                                        </select>
                                    </div>
                                    <!--<div class="form-group col-md-6">
                                        <label>Estatus</label>
                                        <select class="form-control" id="listEstatusNuevo" name="listEstatusNuevo" required >
                                            <option value="">Selecciona un Estatus</option>
                                            <option value="1">Activo</option>
                                            <option value="2">Inactivo</option>
                                        </select>
                                    </div>-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" data-dismiss="modal" id="dimissModalNuevo"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>
                    <button id="btnActionFormNuevo" type="submit" class="btn btn-outline-secondary btn-primary icono-color-principal btn-inline"><i class="fa fa-fw fa-lg fa-check-circle icono-azul"></i><span id="btnText"> Guardar</span></button>
                </div>   
            </form> 
        </div>
    </div>
</div>