<!-- Modal -->
<div class="modal fade" id="ModalFormNuevoPlanEstudios" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModalNuevo">Nuevo plan de estudios</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">
                    <nav>
                        <div class="nav nav-pills nav-fill" id="nav-tab" role="tablist">
                            <a class="nav-link tab-nav" id="step1-tab" data-toggle="tab" href="" onclick="fnNavTab(0)">Carrera</a>
                            <a class="nav-link tab-nav" id="step2-tab" data-toggle="tab" href="" onclick="fnNavTab(1)">RVOE</a>
                            <a class="nav-link tab-nav" id="step3-tab" data-toggle="tab" href="" onclick="fnNavTab(2)">Perfil</a>
                        </div>
                    </nav>
                    <form id="formPlanEstudiosNueva" name="formPlanEstudiosNueva">
                        <input type="hidden" id="idNuevo" name="idNuevo" value="">
                        <div class="card-body"> 
                                <div class="tab">
                                    <div class="row">
                                            <div class="form-group col-md-8">
                                                <label>Nombre</label>
                                                <input type="text" id="txtNombreNuevo" name="txtNombreNuevo" class="form-control form-control-sm" placeholder="EJ: Licenciatura en Trabajo Social" maxlength="150" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Nombre corto</label>
                                                <input type="text" id="txtNombrecortoNuevo" name="txtNombrecortoNuevo" class="form-control form-control-sm" placeholder="EJ: LTS" maxlength="7" required>
                                            </div>
                                            <div class="form-group col-md-8">
                                                <label>Plantel</label>
                                                <select class="form-control form-control-sm" id="listPlantelNuevo" name="listPlantelNuevo"  required>
                                                    <option value="">Selecciona un Plantel</option>
                                                    <?php foreach ($data['planteles'] as $value) {
                                                        ?>
                                                            <option value="<?php echo $value['id'] ?>"><?php echo($value['nombre_plantel'].' ('.$value['municipio'].')') ?></option>
                                                        <?php
                                                    } ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Nivel educativo</label>
                                                <select class="form-control form-control-sm" id="listNivelEdNuevo" name="listNivelEdNuevo"  required>
                                                    <option value="">Selecciona un Nivel Educativo</option>
                                                    <?php foreach ($data['niveles_educativos'] as $value) {
                                                        ?>
                                                            <option value="<?php echo $value['id']?>"><?php echo $value['nombre_nivel_educativo'] ?></option>
                                                        <?php
                                                    }?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Categoría</label>
                                                <select class="form-control form-control-sm" id="listCategoriaNuevo" name="listCategoriaNuevo"  required>
                                                    <option value="">Selecciona una Categoria</option>
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
                                                <input type="text" id="txtDuracionNuevo" name="txtDuracionNuevo" class="form-control form-control-sm" placeholder="EJ: 2 años(6 cuatrimestres)" maxlength="100" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Materias totales</label>
                                                <input type="text" id="txtMatTotalesNuevo" onkeypress="return validarNumeroInput(event)" name="txtMatTotalesNuevo" class="form-control form-control-sm" placeholder="Materias totales" maxlength="2" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Total horas</label>
                                                <input type="text" id="txtTotalHrsNuevo" onkeypress="return validarNumeroInput(event)" name="txtTotalHrsNuevo" class="form-control form-control-sm" placeholder="Total de horas" maxlength="4" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Calificacion mínima</label>
                                                <input type="text" id="txtCalMinNuevo" onkeypress="return validarNumeroInput(event)" name="txtCalMinNuevo" class="form-control form-control-sm" placeholder="Calificación mínima" maxlength="1" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Total créditos</label>
                                                <input type="text" id="listTotalCreditosNuevo" onkeypress="return validarNumeroInput(event)" name="listTotalCreditosNuevo" class="form-control form-control-sm" placeholder="Total de créditos" maxlength="3" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Modalidad</label>
                                                <select class="form-control form-control-sm" id="listModalidadNuevo" name="listModalidadNuevo"  required>
                                                    <option value="">Selecciona una Modalidad</option>
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
                                                <select class="form-control form-control-sm" id="listPlanNuevo" name="listPlanNuevo"  required>
                                                    <option value="">Selecciona un Plan</option>
                                                    <?php foreach ($data['plan'] as $value) {
                                                        ?>
                                                            <option value="<?php echo $value['id'] ?>"> <?php echo $value['nombre_plan']?> </opion>
                                                        <?php
                                                    }?>
                                                </select>
                                            </div>
                                    </div>
                                </div>
                                <div class="tab">
                                    <div class="row">
                                            <div class="form-group col-md-4">
                                                <label>Clave de profesiones</label>
                                                <input type="text" id="txtClaveProfNuevo" name="txtClaveProfNuevo" class="form-control form-control-sm" placeholder="Clave de profesiones" maxlength="10">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Tipo RVOE</label>
                                                <select class="form-control form-control-sm" id="listTipoRvoeNuevo" name="listTipoRvoeNuevo"  required>
                                                <option value="">Selecciona un Status</option>
                                                <option value="0">Estatal</option>
                                                <option value="1">Federal</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>RVOE</label>
                                                <input type="text" id="txtRvoeNuevo" name="txtRvoeNuevo" class="form-control form-control-sm" placeholder="RVOE" maxlength="25" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Fecha vigencia</label>
                                                <input type="text" id="txtFechaVigenciaNuevo" name="txtFechaVigenciaNuevo" class="form-control form-control-sm"  placeholder="Fecha vigencia" maxlength="20" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Fecha de otorgamiento</label>
                                                <input type="date" id="txtFechaOtorgamientoNuevo" name="txtFechaOtorgamientoNuevo" class="form-control form-control-sm"  value="" min="<?php //echo date('Y-m-d')?>" max=""  required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Fecha actualización</label>
                                                <input type="date" id="txtFechaActualizacionNuevo" name="txtFechaActualizacionNuevo" class="form-control form-control-sm"  value="" min="<?php //echo date('Y-m-d')?>" max=""  required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Turno</label>
                                                <select class="form-control form-control-sm" id="listTunoRvoeNuevo" name="listTunoRvoeNuevo"  required>
                                                <option value="">Selecciona un turno</option>
                                                <option value="matutino">Matutino</option>
                                                <option value="vespertino">Vespertino</option>
                                                <option value="mixto">Mixto</option>
                                                </select>
                                            </div>
                                            <div class="form-group row col-md-8">
                                                <div class="col-md-10">
                                                    <label>Agregar clasificaciones</label>
                                                    <select class="form-control form-control-sm" id="listAgClasificacionNuevo" name="listAgClasificacionNuevo">
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
                                                    <button type="button" class="btn btn-primary btn-sm" onclick="fnAgregarClasificacion()"><i class="fas fa-plus">Agregar</i></button>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12" id="clasificaciones">

                               
                                            </div>
                                    </div>
                                </div>
                                <div class="tab">
                                    <div class="form-group">
                                        <label>Perfil de ingreso</label>
                                        <textarea type="text" id="txtPerfilIngresoNuevo" name="txtPerfilIngresoNuevo" class="form-control form-control-sm" placeholder="Perfíl de ingreso" rows="3" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Perfil de egreso</label>
                                        <textarea type="text" id="txtPerfilEgresoNuevo" name="txtPerfilEgresoNuevo" class="form-control form-control-sm" placeholder="Perfíl de egreso" rows="3" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Campo laboral</label>
                                        <textarea type="text" id="txtCampoLaboralNuevo" name="txtCampoLaboralNuevo" class="form-control form-control-sm" placeholder="Campo laboral" rows="3" required></textarea>
                                    </div>
                                </div>       
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row col-12">
                        <!--<div class="col-4">
                            <a class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" data-dismiss="modal" id="dimissModalNuevo"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>
                        </div>-->
                        <div class="col-6 text-right">
                                <span class="step"></span>
                                <span class="step"></span>
                                <span class="step"></span>
                        </div>
                        <div class="col-6">
                            <div class="float-right">
                                <div class="row">
<!--                             <a class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" data-dismiss="modal" id="dimissModalNuevo"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>
 -->                            <buttom class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" onclick="pasarTab(-1)"  id="btnAnterior"><i class="fas fa-fw fa-lg fa-arrow-circle-left icono-azul"></i>Anterior</buttom>
                            <buttom class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" onclick="pasarTab(1)"  id="btnSiguiente"><i class="fas fa-fw fa-lg fa-arrow-circle-right icono-azul"></i>Siguiente</buttom>
                            <button id="btnActionFormNuevo" type="submit" class="btn btn-outline-secondary btn-primary icono-color-principal btn-inline"><i class="fa fa-fw fa-lg fa-check-circle icono-azul"></i><span id="btnText"> Guardar</span></button>
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