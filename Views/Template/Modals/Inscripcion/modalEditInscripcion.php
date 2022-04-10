<!-- Modal -->
<div class="modal fade" id="ModalFormEditInscripcion" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModalEdit">Editar Inscripcion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">
                    <nav>
                        <div class="nav nav-pills nav-fill" id="nav-tab" role="tablist">
                            <a class="nav-link tab-navEdit" id="step1-tab" data-toggle="tab" href="" onclick="fnNavTabEddit(0)">Persona</a>
                            <a class="nav-link tab-navEdit" id="step2-tab" data-toggle="tab" href="" onclick="fnNavTabEddit(1)">Tutor</a>
                        </div>
                    </nav>
                    <form id="formInscripcionEdit" name="formInscripcionEdit">
                        <input type="hidden" id="idEdit" name="idEdit" value="">
                        <input type="hidden" id="idPersonaSeleccionadaEdit" name="idPersonaSeleccionadaEdit" value="">
                        <div class="card-body"> 
                                <div class="tabEdit">
                                    <div class = "col-8">
                                        <div class="form-group">
                                            <label>Nombre de la Persona</label>
                                            <input type="text" id="txtNombreEdit" name="txtNombreNEdit" class="form-control" placeholder="Nombre de la Persona"  name="" readonly required>
                                        </div>
                                        <div class="form-group">
                                            <label>Plantel</label>
                                            <select class="form-control" id="listPlantelEdit" name="listPlantelEdit" onchange="fnPlantelSeleccionadoEdit(value)" required>
                                                <option value="">Selecciona el Plantel</option>
                                                <?php 
                                                    foreach ($data['planteles'] as $value) {
                                                        ?>
                                                            <option value="<?php echo $value['id'] ?>"><?php echo $value['nombre_plantel'] ?></option>
                                                        <?php
                                                    }    
                                                ?>
                                            </select>                                    
                                        </div>
                                        <div class="form-group">
                                            <label>Carrera</label>
                                            <select class="form-control" id="listCarreraEdit" name="listCarreraEdit" required>
                                                <option value="">Selecciona la Carrera</option>
                                            </select>                                    
                                        </div>
                                    </div>    
                                </div>
                                <div class="tabEdit">
                                    <div class="row">
                                        <div class = "col-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="chk-alumno-tutor-edit" onclick="fnChkAlumnoTutor()">
                                                <label class="form-check-label">Asignar el alumno como Tutor</label>
                                            </div><br>
                                            <div class="form-group">
                                                <label>Nombre</label>
                                                <input type="text" id="txtNombreTutorEdit" name="txtNombreTutorEdit" class="form-control" placeholder="Nombre"  name="" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Apellido Paterno</label>
                                                <input type="text" id="txtAppPaternoTutorEdit" name="txtAppPaternoTutorEdit" class="form-control" placeholder="Apellido Paterno"  name="" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Apellido Materno</label>
                                                <input type="text" id="txtAppMaternoTutorEdit" name="txtAppMaternoTutorEdit" class="form-control" placeholder="Apellido Materno"  name="" required>
                                            </div>
                                        </div>    
                                        <div class = "col-6">
                                            <div class="form-group">
                                                <label>Teléfono Celular</label>
                                                <input type="text" id="txtTelCelularTutorEdit" name="txtTelCelularTutorEdit" class="form-control" placeholder="Telefono Celular"  name="">
                                            </div>
                                            <div class="form-group">
                                                <label>Teléfono Fijo</label>
                                                <input type="text" id="txtTelFijoTutorEdit" name="txtTelFijoTutorEdit" class="form-control" placeholder="Telefono Fijo"  name="">
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" id="txtEmailTutorEdit" name="txtEmailTutorEdit" class="form-control" placeholder="Email"  name="">
                                            </div>
                                        </div>    
                                    </div>   
                                </div>    
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row col-12">
                        <div class="col-4">
                            <a class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" data-dismiss="modal" id="dimissModalEdit"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>
                        </div>
                        <div class="col-4 text-center">
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
                    <!--a class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" data-dismiss="modal" id="dimissModalNuevo"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>-->
                    <!--<button id="btnActionFormNuevo" type="submit" class="btn btn-outline-secondary icono-color-principal btn-inline"><i class="fa fa-fw fa-lg fa-check-circle icono-azul"></i><span id="btnText"> Guardar</span></button>-->
                </div>   
            </form> 
        </div>
    </div>
</div>








<div class="modal fade" id="modalNombrePersona" tabindex="-1" role="dialog" aria-labelledby="modalNombrePersonaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalNombrePersonaNLabel">Buscar Persona</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control" id="busquedaPersonaEdit" placeholder="Nombre de la Persona" maxlength="100" autocomplete="off" onKeyUp="buscarPersona();" />
                <br>
                <table id="tablePersonas" class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Nombre Alumno</th>
                            <th width="15%">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" id="cerrarModalBuscarPersona">Cerrar</button>
            </div>
        </div>
    </div>
</div>