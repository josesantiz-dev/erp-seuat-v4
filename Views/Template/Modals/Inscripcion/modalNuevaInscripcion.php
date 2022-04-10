<!-- Modal -->
<div class="modal fade" id="ModalFormNuevaInscripcion" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModalNuevo">Nueva Inscripcion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">
                    <nav>
                        <div class="nav nav-pills nav-fill" id="nav-tab" role="tablist">
                            <a class="nav-link tab-nav" id="step1-tab" data-toggle="tab" href="" onclick="fnNavTab(0)">Persona</a>
                            <a class="nav-link tab-nav" id="step2-tab" data-toggle="tab" href="" onclick="fnNavTab(1)">Tutor</a>
                        </div>
                    </nav>
                    <form id="formInscripcionNueva" name="formInscripcionNueva">
                        <input type="hidden" id="idNuevo" name="idNuevo" value="">
                        <input type="hidden" id="idPersonaSeleccionada" name="idPersonaSeleccionada" value="">
                        <div class="card-body"> 
                                <div class="tab">
                                    <div class = "col-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Nombre de la Persona</label>
                                                    <div class="row">
                                                        <div class="col-md-8"><input type="text" id="txtNombreNuevo" name="txtNombreNuevo" class="form-control form-control-sm" placeholder="Nombre de la Persona"  name="" readonly required></div>
                                                        <div class="col-md-4"><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalNombrePersona"><i class="fa fa-search"></i> Buscar</button></div>
                                                    </div>    
                                                </div>
                                            </div>
                                            <div class="form-group col-md-7">
                                                <label>Plantel</label>
                                                <select class="form-control form-control-sm" id="listPlantelNuevo" name="listPlantelNuevo" onchange="fnPlantelSeleccionado(value)" required>
                                                    <option value="">Selecciona el Plantel</option>
                                                    <?php 
                                                        foreach ($data['planteles'] as $value) {
                                                            ?>
                                                                <option value="<?php echo $value['id'] ?>"><?php echo $value['nombre_plantel'].' ('.$value['municipio'].')'  ?></option>
                                                            <?php
                                                        }    
                                                    ?>
                                                </select>                                    
                                            </div>
                                            <div class="form-group col-md-5">
                                                <label>Carrera</label>
                                                <select class="form-control form-control-sm" id="listCarreraNuevo" name="listCarreraNuevo" required>
                                                    <option value="">Selecciona la Carrera</option>
                                                </select>                                    
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>Grado</label>
                                                <select class="form-control form-control-sm" id="listGradoNuevo" name="listGradoNuevo" required>
                                                    <option value="">Seleccionar</option>
                                                    <?php
                                                        foreach ($data['grados'] as $key => $value) { ?>
                                                            <option value="<?php echo $value['numero_natural'] ?>"><?php echo $value['numero_natural']?></option>

                                                        <?php }
                                                    ?>
                                                </select>                                    
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Turno</label>
                                                <select class="form-control form-control-sm" id="listTurnoNuevo" name="listTurnoNuevo" required>
                                                    <option value="">Seleccionar</option>
                                                    <?php
                                                        foreach ($data['turnos'] as $key => $value) { ?>
                                                            <option value="<?php echo $value['id'] ?>"><?php echo $value['nombre_turno']?></option>

                                                        <?php }
                                                    ?>
                                                </select>                                    
                                            </div>
                                            <div class="form-group col-md-5">
                                                <label>Empresa donde trabaja</label>
                                                <input type="text" id="txtNombreEmpresa" name="txtNombreEmpresa" class="form-control form-control-sm" placeholder="Nombre de la empresa">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label><b>Campaña</b></label>
                                                <?php 
                                                    $campanias = $data['subcampanias'];
                                                    $campania = array_shift($campanias);
                                                ?>
                                                <input type="hidden" id="idSubcampaniaNuevo" name="idSubcampaniaNuevo" value="<?php echo $campania['id_subcampania']?>">
                                                <p>Estas inscribiendo a la campania/subcampania&nbsp<span class="badge badge-warning nombrecampania"><?php echo($campania['nombre_campania'].'/'.$campania['nombre_sub_campania'])?></span>&nbsp 
                                                    <button type="button" onclick="fnCambiarCamSubcampania()" class="btn btn-sm"><i class="fa fa-pencil-alt"></i></button>
                                                </p>
                                                <div class="col-md-8 row cambiarsubcampania">
                                                    <select class="form-control form-control-sm col-8 listCampSub" onchange="campaniaSeleccionada(value)">
                                                        <option value="">Seleccionar</option>
                                                        <?php 
                                                            foreach ($data['subcampanias'] as $key => $value) { ?>
                                                                <option value="<?php echo($value['id_subcampania']) ?>"><?php echo($value['nombre_campania'].'/'.$value['nombre_sub_campania'].'  ('.$value['fecha_fin_subcampania'].')') ?></option>
                                                            <?php }
                                                        ?>
                                                    </select> 
                                                    <div class="col-4"><button onclick="fnQuitCambiarSubCampania()" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></button></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>    
                                </div>
                                <div class="tab">
                                    <div class="row">
                                            <div class="custom-control custom-checkbox col-md-12">
                                                <input class="custom-control-input" type="checkbox" id="chk-alumno-tutor" onclick="fnChkAlumnoTutor()">
                                                <label for="chk-alumno-tutor" class="custom-control-label">Asignar el alumno como Tutor</label>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Nombre</label>
                                                <input type="text" id="txtNombreTutorAgregar" name="txtNombreTutorAgregar" class="form-control form-control-sm" placeholder="Nombre"  required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Apellido Paterno</label>
                                                <input type="text" id="txtAppPaternoTutorAgregar" name="txtAppPaternoTutorAgregar" class="form-control form-control-sm" placeholder="Apellido Paterno" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Apellido Materno</label>
                                                <input type="text" id="txtAppMaternoTutorAgregar" name="txtAppMaternoTutorAgregar" class="form-control form-control-sm" placeholder="Apellido Materno" required>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>Teléfono Celular</label>
                                                <input type="text" id="txtTelCelularTutorAgregar" name="txtTelCelularTutorAgregar" class="form-control form-control-sm" placeholder="Telefono Celular">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>Teléfono Fijo</label>
                                                <input type="text" id="txtTelFijoTutorAgregar" name="txtTelFijoTutorAgregar" class="form-control form-control-sm" placeholder="Telefono Fijo" >
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Email</label>
                                                <input type="text" id="txtEmailTutorAgregar" name="txtEmailTutorAgregar" class="form-control form-control-sm" placeholder="Email">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label>Direccion</label>
                                                <textarea id="txtDireccionNuevo" name="txtDireccionNuevo" class="form-control form-control-sm" placeholder="Direccion" required=""></textarea>
                                            </div>
                                    </div>   
                                </div>    
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row col-12">
                        <div class="col-6 text-right">
                                <span class="step"></span>
                                <span class="step"></span>
                        </div>
                        <div class="col-6">
                            <div style="overflow:auto;">
                                <div style="float:right;">
                                    <button class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" onclick="pasarTab(-1)"  id="btnAnterior"><i class="fas fa-fw fa-lg fa-arrow-circle-left icono-azul"></i>Anterior</button>
                                    <button class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" onclick="pasarTab(1)"  id="btnSiguiente"><i class="fas fa-fw fa-lg fa-arrow-circle-right icono-azul"></i>Siguiente</button>
                                    <button id="btnActionFormNuevo" type="submit" class="btn btn-outline-secondary btn-primary icono-color-principal btn-inline"><i class="fa fa-fw fa-lg fa-check-circle icono-azul"></i><span id="btnText"> Inscribir</span></button>
                                </div>
                            </div>
                        </div>
                    </div>
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
                <input type="text" class="form-control form-control-sm" id="busquedaPersona" placeholder="Nombre de la Persona" maxlength="100" autocomplete="off" onKeyUp="buscarPersona();" />
                <br>
                <table id="tablePersonas" class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Nombre Alumno</th>
                            <th>Estatus</th>
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