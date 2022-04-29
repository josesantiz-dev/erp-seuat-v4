<div class="modal fade" id="ModalNuevoProspecto" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nuevo prospecto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">
                    <form id="formPersonaNuevo" name="formPersonaNuevo">
                        <input type="hidden" id="idNuevo" name="idNuevo" value="">
                        <div class="card-body">
                            <div class="row">
                                <div class="card card-secondary col-md-12 p-0">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0"><i class="fa fa-user"></i> &nbsp;Datos personales</h5>
                                    </div>
                                    <div class="card-body row">
                                        <div class="form-group col-md-3">
                                            <label for="txtNombreNuevo">Nombre</label>
                                            <input type="text" id="txtNombreNuevo" name="txtNombreNuevo" class="form-control form-control-sm" placeholder="Nombre" maxlength="45" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Apellido Paterno</label>
                                            <input type="text" id="txtApellidoPaNuevo" name="txtApellidoPaNuevo" class="form-control form-control-sm" placeholder="Apellido paterno" maxlength="70">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Apellido Materno</label>
                                            <input type="text" id="txtApellidoMaNuevo" name="txtApellidoMaNuevo" class="form-control form-control-sm" placeholder="Apellido materno" maxlength="70">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Sexo</label>
                                            <select class="form-control form-control-sm" id="listSexoNuevo" name="listSexoNuevo">
                                                <option value="">Elige sexo</option>
                                                <option value="H">H</option>
                                                <option value="M">M</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Alias</label>
                                            <input type="text" id="txtNombreNuevo" name="txtNombreNuevo" class="form-control form-control-sm" placeholder="Alias">
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label>Edad</label>
                                            <input type="text" name="txtApellidoPaNuevo" id="txtApellidoPaNuevo" class="form-control form-control-sm" placeholder="Edad">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Estado civil</label>
                                            <select class="form-control form-control-sm" id="listEstadoCivilNuevo" name="listEstadoCivilNuevo" required>
                                                <option value="">Elije estado civil</option>
                                                <option value="Soltero">Soltero(a)</option>
                                                <option value="Casado">Casado(a)</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Ocupación</label>
                                            <input type="text" name="txtApellidoPaNuevo" id="txtApellidoPaNuevo" class="form-control form-control-sm" placeholder="Ocupación">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Escolaridad</label>
                                            <select class="form-control form-control-sm" name="slctEscolaridad" id="slctEscolaridad">
                                                <option value="">Seleccionar...</option>
                                                <?php
                                                foreach ($data['escolaridad'] as $value) {
                                                ?>
                                                    <option value="<?= $value['id'] ?>"><?= $value['nombre_escolaridad'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Fecha de nacimiento</label>
                                            <input type="date" name="txtApellidoPaNuevo" id="txtApellidoPaNuevo" class="form-control form-control-sm" placeholder="Apellido paterno">
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-secondary col-md-12 p-0">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0"><i class="fas fa-map-marker-alt"></i> &nbsp;Residencia</h5>
                                    </div>
                                    <div class="card-body row">
                                        <div class="form-group col-md-4">
                                            <label for="listEstadoNuevo">Estado </label>
                                            <select class="form-control form-control-sm" id="listEstadoNuevo" name="listEstadoNuevo" onchange="estadoSeleccionado(value)" required>
                                                <option value="">Selecciona un Estado</option>
                                                <?php
                                                foreach ($data['estados'] as $value) {
                                                ?>
                                                    <option value="<?php echo $value['id'] ?>"><?php echo $value['nombre'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="listMunicipioNuevo">Municipio</label>
                                            <select class="form-control form-control-sm" id="listMunicipioNuevo" name="listMunicipioNuevo" onchange="municipioSeleccionado(value)" required>
                                                <option value="">Selecciona un Municipio</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="listLocalidadNuevo">Localidad</label>
                                            <select class="form-control form-control-sm" id="listLocalidadNuevo" name="listLocalidadNuevo" required>
                                                <option value="">Selecciona una Localidad</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-secondary col-md-12 p-0">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0"><i class="fas fa-address-book"></i> &nbsp;Contacto</h5>
                                    </div>
                                    <div class="card-body row">
                                        <div class="form-group col-md-4">
                                            <label>Telefono Celular</label>
                                            <input type="text" id="txtTelCelNuevo" name="txtTelCelNuevo" class="form-control form-control-sm" placeholder="Telefono celular" maxlength="10">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Telefono Fijo</label>
                                            <input type="text" id="txtTelFiNuevo" name="txtTelFiNuevo" class="form-control form-control-sm" placeholder="Telefono fijo" maxlength="10">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Email</label>
                                            <input type="email" id="txtEmailNuevo" name="txtEmailNuevo" class="form-control form-control-sm" placeholder="Email" maxlength="50">
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-secondary col-md-12 p-0">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0"><i class="fas fa-layer-group"></i> &nbsp;Prospecto</h5>
                                    </div>
                                    <div class="card-body row">
                                        <div class="form-group col-md-3">
                                            <label>Escuela Procedencia</label>
                                            <input type="text" id="txtPlantelProcedencia" name="txtPlantelProcedencia" class="form-control form-control-sm" placeholder="Plantel de Procedencia" name="" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Plantel de interés</label>
                                            <select class="form-control form-control-sm" name="slctCarreraNvo" id="slctCarreraNvo">
                                                <option value="">Seleccionar...</option>
                                                <?php foreach(conexiones as $key => $conexion){?>
                                                    <option value="<?php echo $key?>"><?php echo $conexion['NAME']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Nivel de estudios de interés</label>
                                            <select class="form-control form-control-sm" name="slctNivelEstudios" id="slctNivelEstudios" onchange="nvlSeleccionadoPros(value)">
                                                <option value="">Seleccionar...</option>
                                                <?php
                                                foreach ($data['nivel_estudios_interes'] as $key => $nivel) {?>
                                                    <option value="<?= $nivel['id']?>"><?php echo($nivel['nombre_nivel_educativo']) ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Carrera de interés</label>
                                            <select class="form-control form-control-sm" name="slctCarreraNuevoPro" id="slctCarreraNuevoPro">
                                                
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-secondary col-md-12 p-0">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0"><i class="fas fa-thumbs-up"></i> &nbsp;Medio de captación</h5>
                                    </div>
                                    <div class="card-body row">
                                        <div class="col-md-4">
                                            <div id="captacion1" class="form-check">

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div id="captacion2" class="form-check">

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div id="captacion3" class="form-check">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-secondary col-md-12 p-0">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0"><i class="fas fa-comment-alt"></i> &nbsp; Comentarios</h5>
                                    </div>
                                    <div class="card-body row">
                                        <label for="txtObservacion">Comentarios:</label>
                                        <textarea id="txtObservacion" name="txtObservacion" class="form-control form-control-sm" placeholder="Observación" maxlength="200" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" data-dismiss="modal" id="dimissModalNuevo"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>
                <button id="btnActionFormNuevo" type="submit" class="btn btn-outline-secondary icono-color-principal btn-inline"><i class="fa fa-fw fa-lg fa-check-circle icono-azul"></i><span id="btnText"> Guardar</span></button>
            </div>
            </form>
        </div>
    </div>
</div>