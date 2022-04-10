<!-- Modal -->
<div class="modal fade" id="ModalFormEditPersona" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header headerUpdated">
                <h5 class="modal-title" id="titleModalEdit">Editar Persona</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">
                    <form id="formPersonaEdit" name="formPersonaEdit">
                        <input type="hidden" id="idEdit" name="idEdit" value="">
                        <div class="card-body">
                            <small class="text-muted pb-4">Los campos con asterisco (<span class="required">*</span>) son obligatorios..</small>
                            <div class="row" >
                                <div class="card col-md-12 p-0">
								    <div class="card-header"  style="background-color: #D5DBDB !important">
									    <h5 class="card-title mb-0">Datos personales</h5>
								    </div>
								    <div class="card-body row">
                                        <div class="form-group col-md-3">
                                            <label for="txtNombreEdit">Nombre <span class="required">*</span></label>
                                            <input type="text" id="txtNombreEdit" name="txtNombreEdit" class="form-control form-control-sm " placeholder="Nombre"  maxlength="45" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Apellido Paterno</label>
                                            <input type="text" id="txtApellidoPaEdit" name="txtApellidoPaEdit" class="form-control form-control-sm" placeholder="Apellido paterno" maxlength="70">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Apellido Materno</label>
                                            <input type="text" id="txtApellidoMaEdit" name="txtApellidoMaEdit" class="form-control form-control-sm" placeholder="Apellido materno" maxlength="70">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Sexo</label>
                                            <select class="form-control form-control-sm" id="listSexoEdit" name="listSexoEdit" disabled>
                                                <option value="">Seleccionar</option>
                                                <option value="H">H</option>
                                                <option value="M">M</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label>Edad</label>
                                            <input type="number" id="txtEdadEdit" name="txtEdadEdit" class="form-control form-control-sm" placeholder="Edad" min = "0" max="120" onkeypress="return validarNumeroInput(event)">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="txtAliasEdit">Alias <span class="required">*</span></label>
                                            <input type="text" id="txtAliasEdit" name="txtAliasEdit" class="form-control form-control-sm" placeholder="Alias" maxlength="45" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Estado Civil</label>
                                            <select class="form-control form-control-sm" id="listEstadoCivilEdit" name="listEstadoCivilEdit">
                                                <option value="">Seleccionar</option>
                                                <option value="Soltero">Soltero(a)</option>
                                                <option value="Casado">Casado(a)</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Fecha de Nacimiento</label>
                                            <input type="date" id="txtFechaNacimientoEdit"  name="txtFechaNacimientoEdit" class="form-control form-control-sm form-control form-control-sm-sm">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>CURP</label>
                                            <input type="text" id="txtCURPEdit" name="txtCURPEdit" class="form-control form-control-sm form-control form-control-sm-sm"  placeholder="CURP" maxlength="18">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Ocupacion</label>
                                            <input type="text" id="txtOcupacionEdit" name="txtOcupacionEdit" class="form-control form-control-sm" placeholder="Ocupación" maxlength="50">
                                        </div>
                                        <div class="form-group col-md-4">
                                    <label>Categoria Persona</label>
                                    <select class="form-control form-control-sm" id="listCategoriaEdit" name="listCategoriaEdit" disabled>
                                        <option value="">Seleccionar</option>
                                        <?php 
                                            foreach ($data['categoria_persona'] as $value) {
                                                ?>
                                                    <option value="<?php echo $value['id'] ?>"><?php echo $value['nombre_categoria'] ?></option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                </div>
								    </div>
							    </div>
                                <div class="card col-md-12 p-0">
								    <div class="card-header"  style="background-color: #D5DBDB !important">
									    <h5 class="card-title mb-0">Datos de contacto</h5>
								    </div>
								    <div class="card-body row">
                                        <div class="form-group col-md-4">
                                            <label>Telefono Celular</label>
                                            <input type="text" id="txtTelCelEdit" name="txtTelCelEdit" class="form-control form-control-sm" placeholder="Telefono celular" onkeypress="return validarNumeroInput(event)" maxlength="10">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Telefono Fijo</label>
                                            <input type="text" id="txtTelFiEdit" name="txtTelFiEdit" class="form-control form-control-sm" placeholder="Telefono fijo" onkeypress="return validarNumeroInput(event)" maxlength="10">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Email</label>
                                            <input type="text" id="txtEmailEdit" name="txtEmailEdit" class="form-control form-control-sm" placeholder="Email">
                                        </div>
								    </div>
							    </div>
                                <div class="card col-md-12 p-0">
								    <div class="card-header"  style="background-color: #D5DBDB !important">
									    <h5 class="card-title mb-0">Datos profesionales</h5>
								    </div>
								    <div class="card-body row">
                                        <div class="form-group col-md-3">
                                            <label>Escolaridad</label>
                                            <select class="form-control form-control-sm" id="listEscolaridadEdit" name="listEscolaridadEdit">
                                                <option value="">Seleccionar</option>
                                                <?php 
                                                    foreach ($data['grados_estudios'] as $value) {
                                                        ?>
                                                            <option value="<?php echo $value['id'] ?>" ><?php echo $value['nombre_escolaridad'] ?></option>                
                                                        <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label>Plantel de interés</label>
                                            <select class="form-control form-control-sm" id="listPlantelInteresEdit" name="listPlantelInteresEdit">
                                                <option value="">Seleccionar</option>
                                                <?php  foreach ($data['planteles'] as $key => $plantel) { ?>
                                                    <option value="<?php echo $plantel['id'] ?>"><?php echo($plantel['nombre_plantel'].'('.$plantel['municipio'].')') ?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Nivel carrera de interés</label>
                                            <select class="form-control form-control-sm" id="listNivelCarreraInteresEdit" name="listNivelCarreraInteresEdit" onchange="nivelCarreraInteresSeleccionadoEdit(value)">
                                                <option value="">Seleccionar</option>
                                                <?php 
                                                    foreach ($data['grados_estudios'] as $value) {
                                                        ?>
                                                            <option value="<?php echo $value['id'] ?>" ><?php echo $value['nombre_escolaridad'] ?></option>                
                                                        <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Carrera de interés</label>
                                            <select class="form-control form-control-sm form-control form-control-sm-sm" id="listCarreraInteresEdit"  name="listCarreraInteresEdit">
                                                <option value="">Seleccionar</option>                                        
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Escuela de procedencia</label>
                                            <input type="text" id="txtNombreEscuelaProcEdit" name = "txtNombreEscuelaProcEdit" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Medio de captación</label>
                                            <input type="text" id="txtMedioCaptacionEdit" name = "txtMedioCaptacionEdit" class="form-control form-control-sm" disabled>
                                        </div>
								    </div>
							    </div>
                                <div class="card col-md-12 p-0">
								    <div class="card-header"  style="background-color: #D5DBDB !important">
									    <h5 class="card-title mb-0">Ubicación</h5>
								    </div>
								    <div class="card-body row">
                                        <div class="form-group col-md-3">
                                            <label >Estado </label>
                                            <select class="form-control form-control-sm" id="listEstadoEdit" name="listEstadoEdit" onchange="estadoSeleccionadoEdit(value)" disabled>
                                                <option value="">Seleccionar</option>
                                                <?php 
                                                    foreach ($data['estados'] as $value) {
                                                        ?>
                                                            <option value="<?php echo $value['id'] ?>" ><?php echo $value['nombre'] ?></option>                
                                                        <?php
                                                    }    
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label >Municipio </label>
                                            <select class="form-control form-control-sm" id="listMunicipioEdit" name="listMunicipioEdit" onchange="municipioSeleccionadoEdit(value)" disabled>
                                                <option value="">Seleccionar</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Localidad</label>
                                            <select class="form-control form-control-sm" id="listLocalidadEdit" name="listLocalidadEdit" disabled>
                                                <option value="">Seleccionar</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>CP</label>
                                            <input type="text" id="txtCPEdit" name="txtCPEdit" class="form-control form-control-sm" placeholder="CP" onkeypress="return validarNumeroInput(event)">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Colonia</label>
                                            <input type="text" id="txtColoniaEdit" name="txtColoniaEdit" class="form-control form-control-sm" placeholder="Colonia">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Direccion</label>
                                            <input type="text" id="txtDireccionEdit" name="txtDireccionEdit" class="form-control form-control-sm" placeholder="Direccion">   
                                        </div> 
								    </div>
                                </div>   
                                <div class="form-group col-md-12">
                                    <label for="txtObservacionEdit">Observación <span class="required">*</span></label>
                                    <textarea id="txtObservacionEdit" name="txtObservacionEdit" class="form-control form-control-sm" required></textarea>
                                </div>     
                            </div>                           
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" data-dismiss="modal" id="dimissModalEdit"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>
                    <button id="btnActionFormEdit" type="submit" class="btn btn-outline-secondary btn-primary icono-color-principal btn-inline"><i class="fa fa-fw fa-lg fa-check-circle icono-azul"></i><span id="btnText"> Actualizar</span></button>
                </div>   
            </form> 
        </div>
    </div>
</div>