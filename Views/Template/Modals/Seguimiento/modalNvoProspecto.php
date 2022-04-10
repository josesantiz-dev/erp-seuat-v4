<div class="modal fade" id="ModalFormNuevaPersona" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModalNuevo">Nuevo Prospecto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">
                    <form id="formPersonaNuevo" name="formPersonaNuevo" >
                        <input type="hidden" id="idNuevo" name="idNuevo" value="">
                        <div class="card-body overflow-auto" style="height:435px;">

                            <div class="card mb-3 card-secondary collapsed-card" id="cardDatosPer" name="cardDatosPer">
                              <div class="card-header text-white">
                                <h3 class="card-title"><i class="fas fa-user"></i> &nbsp; Datos Persnales</h3>
                                <div class="card-tools">
                                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                  <i class="fas fa-plus"></i>
                                  </button>
                                </div>
                                <!-- /.card-tools -->
                              </div>
                              <!-- /.card-header -->
                              <div class="card-body">

                                <div class="row">

                                  <div class="col-4">

                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <input type="text" id="txtNombreNuevo" name="txtNombreNuevo" class="form-control" placeholder="Nombre" onkeyup="validarPersona()" name="">
                                    </div>

                                    <div class="form-group">
                                        <label>Sexo</label>
                                        <select class="form-control" id="listSexoNuevo" name="listSexoNuevo" onchange="validarPersona()">
                                        <option value="">Selecciona un Sexo</option>
                                        <option value="H">H</option>
                                        <option value="M">M</option>
                                        </select>
                                    </div>

                                    <div class="form-group">

                                      <label>Estado Civil</label>
                                      <select class="form-control" id="listEstadoCivilNuevo" name="listEstadoCivilNuevo" onchange="validarPersona()" required >
                                        <option value="">Selecciona un Estado</option>
                                        <option value="Soltero">Soltero(a)</option>
                                        <option value="Casado">Casado(a)</option>
                                      </select>
                                    </div>

                                  </div>
                                  <div class="col-4">

                                    <div class="form-group">
                                        <label>Apellido Paterno</label>
                                        <input type="text" id="txtApellidoPaNuevo" name="txtApellidoPaNuevo" class="form-control" placeholder="Apellido Paterno" onkeyup="validarPersona()"  name="">
                                    </div>

                                    <div class="form-group">
                                        <label>Alias</label>
                                        <input type="text" id="txtAlias" name="txtAlias" class="form-control" placeholder="Alias" onkeyup="validarPersona()"  name="">
                                    </div>

                                    <div class="form-group">
                                        <label>Ocupacion</label>
                                        <input type="text" id="txtOcupacionNuevo" name="txtOcupacionNuevo" class="form-control" placeholder="Ocupacion" onkeyup="validarPersona()" name="">
                                    </div>

                                    <div class="form-group">
                                        <label>Fecha de nacimento</label>
                                        <input type="date" id="txtFechaNacimientoNuevo" name="txtFechaNacimientoNuevo" class="form-control" placeholder="Fecha de Nacimiento" onchange="validarPersona()"  name="">
                                    </div>

                                  </div>
                                  <div class="col-4">

                                    <div class="form-group">
                                        <label>Apellido Materno</label>
                                        <input type="text" id="txtApellidoMaNuevo" name="txtApellidoMaNuevo" class="form-control" placeholder="Apellido Materno" onkeyup="validarPersona()"  name="">
                                    </div>

                                    <div class="form-group">
                                        <label>Edad</label>
                                        <input type="number" id="txtEdadNuevo" name="txtEdadNuevo" class="form-control" placeholder="Edad" onkeyup="validarPersona()" name="">
                                    </div>

                                    <div class="form-group">
                                        <label for="">Escolaridad</label>
                                        <select class="form-control" name="slctEscolaridad" id="slctEscolaridad" onkeyup="validarPersona()" >
                                            <option value="">Seleccionar...</option>
                                            <?php
                                            foreach ($data['niveles'] as $value) {
                                            ?>
                                                <option value="<?= $value['id'] ?>"><?= $value['nombre_nivel_educativo'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                  </div>

                                </div>

                              </div>
                              <!-- /.card-body -->
                            </div>

                            <div class="card card-secondary mb-3 collapsed-card" id="datosResidencia">
                              <div class="card-header text-white">
                                <h3 class="card-title"><i class="fas fa-map-marker-alt"></i> &nbsp; Residencia</h3>
                                <div class="card-tools">
                                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                  <i class="fas fa-plus"></i>
                                  </button>
                                </div>
                                <!-- /.card-tools -->
                              </div>
                              <!-- /.card-header -->
                              <div class="card-body">

                                <div class="row">

                                  <div class="col-4">

                                    <div class="form-group">
                                        <label>Estado</label>
                                        <select class="form-control" id="listEstadoNuevo" name="listEstadoNuevo" onchange="estadoSeleccionado(value)" required >
                                            <option value="">Selecciona un Estado</option>
                                            <?php
                                                foreach ($data['estados'] as $value) {
                                                    ?>
                                                        <option value="<?php echo $value['id'] ?>" ><?php echo $value['nombre'] ?></option>
                                                    <?php
                                                }
                                            ?>
                                        </select>
                                    </div>

                                  </div>

                                  <div class="col-4">

                                    <div class="form-group">
                                        <label>Municipio</label>
                                        <select class="form-control" id="listMunicipioNuevo" name="listMunicipioNuevo" onchange="municipioSeleccionado(value)" required >
                                            <option value="">Selecciona un Municipio</option>
                                        </select>
                                    </div>

                                  </div>

                                  <div class="col-4">

                                    <div class="form-group">
                                        <label>Localidad</label>
                                        <select class="form-control" id="listLocalidadNuevo" name="listLocalidadNuevo" onchange="validarResi()"  required >
                                        <option value="">Selecciona una Localidad</option>
                                        </select>
                                    </div>

                                  </div>

                                </div>

                              </div>
                              <!-- /.card-body -->
                            </div>

                            <div class="card card-secondary mb-3 collapsed-card" id="datosContacto">
                              <div class="card-header text-white">
                                <h3 class="card-title"><i class="fas fa-address-book"></i> &nbsp; Contacto</h3>
                                <div class="card-tools">
                                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                  <i class="fas fa-plus"></i>
                                  </button>
                                </div>
                                <!-- /.card-tools -->
                              </div>
                              <!-- /.card-header -->
                              <div class="card-body">

                                <div class="row">

                                  <div class="col-4">

                                    <div class="form-group">
                                        <label>Telefono Celular</label>
                                        <input type="text" id="txtTelCelNuevo" name="txtTelCelNuevo" class="form-control" placeholder="Telefono Celular" onkeyup="validarContac()" name="" required>
                                    </div>

                                  </div>
                                  <div class="col-4">

                                    <div class="form-group">
                                        <label>Telefono Fijo</label>
                                        <input type="text" id="txtTelFiNuevo" name="txtTelFiNuevo" class="form-control" placeholder="Telefono Fijo" onkeyup="validarContac()" name="" required>
                                    </div>

                                  </div>
                                  <div class="col-4">

                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" id="txtEmailNuevo" name="txtEmailNuevo" class="form-control" placeholder="Email" onkeyup="validarContac()" name="" required>
                                    </div>

                                  </div>

                                </div>

                              </div>
                              <!-- /.card-body -->
                            </div>

                            <div class="card card-secondary mb-3 collapsed-card" id="cardProspecto">
                              <div class="card-header text-white">
                                <h3 class="card-title"><i class="fas fa-layer-group"></i> &nbsp; Prospecto</h3>
                                <div class="card-tools">
                                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                  <i class="fas fa-plus"></i>
                                  </button>
                                </div>
                                <!-- /.card-tools -->
                              </div>
                              <!-- /.card-header -->
                              <div class="card-body">

                                <div class="row">

                                  <div class="col-4">

                                    <div class="form-group col-md-12">
                                        <label>Escuela Procedencia</label>
                                        <input type="text" id="txtPlantelProcedencia" name="txtPlantelProcedencia" class="form-control" placeholder="Plantel de Procedencia" onkeydown="validarProspecto()" name="" required>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="">Carrera de interés:</label>
                                        <select class="form-control" name="slctCarreraNvo" id="slctCarreraNvo" onchange="validarProspecto()">
                                            <option value="">Seleccionar...</option>
                                            <?php
                                            foreach ($data['carreras'] as  $value) {
                                            ?>
                                                <option value="<?= $value['id'] ?>"><?= $value['nombre_carrera'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                  </div>
                                  <div class="col-4">

                                    <div class="form-group col-md-12">
                                        <label for="">Plantel de interés:</label>
                                        <select class="form-control" name="slctPlantel" id="slctPlantel" onchange="validarProspecto()">
                                            <option value="">Seleccionar...</option>
                                            <?php
                                            foreach ($data['planteles'] as $value) {
                                            ?>
                                                <option value="<?= $value['id'] ?>"><?= $value['nombre_plantel'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <!-- <div class="form-group col-md-12">
                                      <label for="">Marcar si es <span class="text-danger"> <b>ALUMNO EGRESADO</b></span></label>
                                      <input type="checkbox"  class="form-control" name="egresado" id="egresado" value="1">
                                    </div> -->

                                  </div>
                                  <div class="col-4">

                                    <div class="form-group col-md-12">
                                        <label for="">Nivel de estudios de interés:</label>
                                        <select class="form-control" name="slctNivelEstudios" id="slctNivelEstudios" onchange="lvlSeleccionado(value)">
                                            <option value="">Seleccionar...</option>
                                            <?php
                                            foreach ($data['niveles'] as $value) {
                                            ?>
                                                <option value="<?= $value['id'] ?>"><?= $value['nombre_nivel_educativo'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <input type="hidden" id="txtIdCategoriaPersona" name="txtIdCategoriaPersona" value="1">

                                  </div>

                                </div>

                              </div>
                              <!-- /.card-body -->
                            </div>

                            <div class="card card-secondary mb-3 collapsed-card" id="cardCaptacion">
                              <div class="card-header text-white">
                                <h3 class="card-title"><i class="fas fa-thumbs-up"></i> &nbsp; Medio captación</h3>
                                <div class="card-tools">
                                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                  <i class="fas fa-plus"></i>
                                  </button>
                                </div>
                                <!-- /.card-tools -->
                              </div>
                              <!-- /.card-header -->
                              <div class="card-body">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div id="captacion1" class="form-check">

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div id="captacion2" class="form-check">

                                        </div>
                                    </div>
                                </div>

                              </div>
                              <!-- /.card-body -->
                            </div>

                            <div class="card card-secondary mb-3 collapsed-card" id="cardComent">
                              <div class="card-header text-white">
                                <h3 class="card-title"><i class="fas fa-comment-alt"></i> &nbsp; Comentario</h3>
                                <div class="card-tools">
                                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                  <i class="fas fa-plus"></i>
                                  </button>
                                </div>
                                <!-- /.card-tools -->
                              </div>
                              <!-- /.card-header -->
                              <div class="card-body">

                                <label for="">Agregar un comentario:</label>
                                <textarea id="comentario" name="comentario" onkeyup="validarMedio()" class="form-control" data-length="170"></textarea>

                              </div>
                              <!-- /.card-body -->
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
