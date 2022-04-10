<!-- Modal -->
<div class="modal fade" id="ModalFormEditPlanEstudios" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModalEdit">Editar plan de estudios</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">
                    <nav>
                        <div class="nav nav-pills nav-fill" id="nav-tab" role="tablist">
                            <a class="nav-link tab-navEdit" id="step1-tabEdit" data-toggle="tab" href="" onclick="fnNavTabEdit(0)">Carrera</a>
                            <a class="nav-link tab-navEdit" id="step2-tabEdit" data-toggle="tab" href="" onclick="fnNavTabEdit(1)">RVOE</a>
                            <a class="nav-link tab-navEdit" id="step3-tabEdit" data-toggle="tab" href="" onclick="fnNavTabEdit(2)">Perfil</a>
                        </div>
                    </nav>
                    <form id="formPlanEstudiosEdit" name="formPlanEstudiosEdit">
                        <input type="hidden" id="idEdit" name="idEdit" value="">
                        <div class="card-body"> 
                                <div class="tabEdit">
                                    <div class="row">
                                            <div class="form-group col-md-8">
                                                <label>Nombre</label>
                                                <input type="text" id="txtNombreEdit" name="txtNombreEdit" class="form-control form-control-sm" placeholder="EJ: Licenciatura en Trabajo Social" maxlength="150" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Nombre corto</label>
                                                <input type="text" id="txtNombrecortoEdit" name="txtNombrecortoEdit" class="form-control form-control-sm" placeholder="EJ: LTS" maxlength="7" required>
                                            </div>
                                            <div class="form-group col-md-8">
                                                <label>Plantel</label>
                                                <select class="form-control form-control-sm" id="listPlantelEdit" name="listPlantelEdit"  required>
                                                    <?php foreach ($data['planteles'] as $value) {
                                                        ?>
                                                            <option id="<?php echo $value['id'] ?>"value="<?php echo $value['id'] ?>"><?php echo($value['nombre_plantel'].' ('.$value['municipio'].')') ?></option>
                                                        <?php
                                                    } ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Nivel educativo</label>
                                                <select class="form-control form-control-sm" id="listNivelEdEdit" name="listNivelEdEdit"  required>
                                                    <?php foreach ($data['niveles_educativos'] as $value) {
                                                        ?>
                                                            <option value="<?php echo $value['id']?>"><?php echo $value['nombre_nivel_educativo'] ?></option>
                                                        <?php
                                                    }?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Categoría</label>
                                                <select class="form-control form-control-sm" id="listCategoriaEdit" name="listCategoriaEdit"  required>
                                                    <?php foreach ($data['categorias'] as $value) {
                                                        ?>
                                                        <option value="<?php echo $value['id']?>"> <?php echo $value['nombre_categoria_carrera']?> </option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Duración</label>
                                                <input type="text" id="txtDuracionEdit" name="txtDuracionEdit" class="form-control form-control-sm" placeholder="EJ: 2 años(6 cuatrimestres)" maxlength="100" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Materias totales</label>
                                                <input type="text" id="txtMatTotalesEdit" onkeypress="return validarNumeroInput(event)" name="txtMatTotalesEdit" class="form-control form-control-sm" placeholder="Materias totales" maxlength="2" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Total horas</label>
                                                <input type="text" id="txtTotalHrsEdit" onkeypress="return validarNumeroInput(event)" name="txtTotalHrsEdit" class="form-control form-control-sm" placeholder="Total de horas" maxlength="4" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Calificacion mínima</label>
                                                <input type="text" id="txtCalMinEdit" onkeypress="return validarNumeroInput(event)" name="txtCalMinEdit" class="form-control form-control-sm" placeholder="Calificación mínima" maxlength="1" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Total créditos</label>
                                                <input type="text" id="listTotalCreditosEdit" onkeypress="return validarNumeroInput(event)" name="listTotalCreditosEdit" class="form-control form-control-sm" placeholder="Total de créditos" maxlength="3" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Modalidad</label>
                                                <select class="form-control form-control-sm" id="listModalidadEdit" name="listModalidadEdit"  required>
                                                    <?php foreach ($data['modalidad'] as $value) {
                                                        ?>
                                                            <option value="<?php echo $value['id'] ?>"> <?php echo $value['nombre_modalidad'] ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Plan</label>
                                                <select class="form-control form-control-sm" id="listPlanEdit" name="listPlanEdit"  required>
                                                    <?php foreach ($data['plan'] as $value) {
                                                        ?>
                                                            <option value="<?php echo $value['id'] ?>"> <?php echo $value['nombre_plan']?> </opion>
                                                        <?php
                                                    }?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Estatus</label>
                                                <select class="form-control form-control-sm" id="listEstatusEdit" name="listEstatusEdit"  required>
                                                <option value="1">Activo</option>
                                                <option value="2">Inactivo</option>
                                                </select>
                                            </div>
                                    </div>
                                </div>
                                <div class="tabEdit">
                                    <div class="row">
                                            <div class="form-group col-md-4">
                                                <label>Clave de profesiones</label>
                                                <input type="text" id="txtClaveProfEdit" name="txtClaveProfEdit" class="form-control form-control-sm" placeholder="Clave de profesiones" maxlength="10">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Tipo RVOE</label>
                                                <select class="form-control form-control-sm" id="listTipoRvoeEdit" name="listTipoRvoeEdit"  required>
                                                <option value="Estatal">Estatal</option>
                                                <option value="Federal">Federal</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>RVOE</label>
                                                <input type="text" id="txtRvoeEdit" name="txtRvoeEdit" class="form-control form-control-sm" placeholder="RVOE" maxlength="25" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Fecha vigencia</label>
                                                <input type="text" id="txtFechaVigenciaEdit" name="txtFechaVigenciaEdit" class="form-control form-control-sm"  placeholder="Fecha vigencia" maxlength="20" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Fecha de otorgamiento</label>
                                                <input type="date" id="txtFechaOtorgamientoEdit" name="txtFechaOtorgamientoEdit" class="form-control form-control-sm"  value="" min="<?php //echo date('Y-m-d')?>" max=""  required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Fecha actualización</label>
                                                <input type="date" id="txtFechaActualizacionEdit" name="txtFechaActualizacionEdit" class="form-control form-control-sm"  value="" min="<?php //echo date('Y-m-d')?>" max=""  required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Turno</label>
                                                <select class="form-control form-control-sm" id="listTunoRvoeEdit" name="listTunoRvoeEdit"  required>
                                                <option value="">Selecciona un turno</option>
                                                <option value="matutino">Matutino</option>
                                                <option value="vespertino">Vespertino</option>
                                                <option value="mixto">Mixto</option>
                                                </select>
                                            </div>
                                            <div class="form-group row col-md-8">
                                                <div class="col-md-10">
                                                    <label>Agregar clasificaciones</label>
                                                    <select class="form-control form-control-sm" id="listAgClasificacionEdit" name="listAgClasificacionEdit">
                                                        <option value="">Selecciona las clasificaciones</option>
                                                        <?php 
                                                            foreach ($data['clasificacion'] as $key => $clasificacion) {
                                                                ?>
                                                                    <option value="<?php echo $clasificacion['id']?>"><?php echo $clasificacion['nombre_clasificacion_materia'] ?></option>
                                                                <?php
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-2 d-flex align-items-end">
                                                    <button type="button" class="btn btn-primary btn-sm" onclick="fnAgregarClasificacionEdit()"><i class="fas fa-plus">Agregar</i></button>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12" id="clasificacionesEdit">

                               
                                            </div>

                                    </div>
                                </div>
                                <div class="tabEdit">
                                    <div class="form-group">
                                        <label>Perfil de ingreso</label>
                                        <textarea type="text" id="txtPerfilIngresoEdit" name="txtPerfilIngresoEdit" class="form-control form-control-sm" placeholder="Perfíl de ingreso" rows="3" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Perfil de egreso</label>
                                        <textarea type="text" id="txtPerfilEgresoEdit" name="txtPerfilEgresoEdit" class="form-control form-control-sm" placeholder="Perfíl de egreso" rows="3" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Campo laboral</label>
                                        <textarea type="text" id="txtCampoLaboralEdit" name="txtCampoLaboralEdit" class="form-control form-control-sm" placeholder="Campo laboral" rows="3" required></textarea>
                                    </div>
                                </div>       
                        </div>
                    </div>
                </div>
                <!--<div class="modal-footer">
                    <div class="row col-12">
                        <div class="col-4">
                            <a class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" data-dismiss="modal" id="dimissModalEdit"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>
                        </div>
                        <div class="col-4 text-center">
                                <span class="stepEdit"></span>
                                <span class="stepEdit"></span>
                                <span class="stepEdit"></span>
                        </div>
                        <div class="col-4">
                            <div style="overflow:auto;">
                                <div style="float:right;">
                                    <button class="btn btn-primary" type="button" id="btnAnteriorEdit" onclick="pasarTabEdit(-1)">Anterior</button>
                                    <button class="btn btn-primary" type="button" id="btnSiguienteEdit" onclick="pasarTabEdit(1)">Siguiente</button>
                                    <button class="btn btn-success" type="submit" id="btnActionFormEdit">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>--> 
                <div class="modal-footer">
                    <div class="row col-12">
                        <!--<div class="col-4">
                            <a class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" data-dismiss="modal" id="dimissModalNuevo"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>
                        </div>-->
                        <div class="col-6 text-right">
                                <span class="stepEdit"></span>
                                <span class="stepEdit"></span>
                                <span class="stepEdit"></span>
                        </div>
                        <div class="col-6">
                            <div class="float-right">
                                <div class="row">
<!--                             <a class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" data-dismiss="modal" id="dimissModalEdit"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>
 -->                            <buttom class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" onclick="pasarTabEdit(-1)"  id="btnAnteriorEdit"><i class="fas fa-fw fa-lg fa-arrow-circle-left icono-azul"></i>Anterior</buttom>
                            <buttom class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" onclick="pasarTabEdit(1)"  id="btnSiguienteEdit"><i class="fas fa-fw fa-lg fa-arrow-circle-right icono-azul"></i>Siguiente</buttom>
                            <button id="btnActionFormEdit" type="submit" class="btn btn-outline-secondary btn-primary icono-color-principal btn-inline"><i class="fa fa-fw fa-lg fa-check-circle icono-azul"></i><span id="btnText"> Actualizar</span></button>
                                    <!--<button class="btn btn-primary" type="button" id="btnAnterior" onclick="pasarTab(-1)">Anterior</button>
                                    <button class="btn btn-primary" type="button" id="btnSiguiente" onclick="pasarTab(1)">Siguiente</button>
                                    <button class="btn btn-success" type="submit" id="btnActionFormNuevo">Guardar</button>-->
                                                </div>
                                                </div>
                        </div>
                    </div>
                    <!--a class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" data-dismiss="modal" id="dimissModalNuevo"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>-->
                    <!--<button id="btnActionFormNuevo" type="submit" class="btn btn-outline-secondary icono-color-principal btn-inline"><i class="fa fa-fw fa-lg fa-check-circle icono-azul"></i><span id="btnText"> Guardar</span></button>-->
                </div>   
            </form> 
        </div>
    </div>
</div>