<!-- Modal -->
<div class="modal fade" id="ModalEditDatosProspectoSeguimiento" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header headerUpdate">
                <h5 class="modal-title" id="titleModalNueva">Editar datos del prospecto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">
                    <form id="formProspectoEdit" name="formProspectoEdit">
                        <input type="hidden" id="idPersonaEdit" name="idPersonaEdit" value="">
                        <input type="hidden" id="idProspectoEdit" name="idProspectoEdit" value="">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>Nombre(s)</label>
                                    <input type="text" id="txtNombreEdit" name="txtNombreEdit" class="form-control form-control-sm" placeholder="Ingrese nombre" name="" maxlength="45" required="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="">Apellido Paterno</label>
                                    <input type="text" id="txtApellidoPatEdit" name="txtApellidoPatEdit" class="form-control form-control-sm" placeholder="Ingrese apellido paterno" required="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Apellido Materno</label>
                                    <input type="text" id="txtApellidoMatEdit" name="txtApellidoMatEdit" class="form-control form-control-sm" placeholder="Ingrese apellido materno" required="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="">Teléfono celular:</label>
                                    <input type="text" id="txtTelefonoCelEdit" name="txtTelefonoCelEdit" class="form-control form-control-sm" placeholder="EJ: 0123456789" requred="">
                                </div>
                                <div class="form-group col-md-8">
                                    <label for="">Correo electrónico</label>
                                    <input type="email" class="form-control form-control-sm" id="txtEmail" name="txtEmail" placeholder="EJ: example@correo.com">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="">Plantel de interés:</label>
                                    <select class="form-control" name="slctPlantelEdit" id="slctPlantelEdit">
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
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="">Nivel de estudios de interés:</label>
                                    <select class="form-control" name="slctNivelEstudiosEdit" id="slctNivelEstudiosEdit" onchange="nivelSeleccionado(value)">
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
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="">Carrera de interés:</label>
                                    <select class="form-control" name="slctCarreraEdit" id="slctCarreraEdit">
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
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" data-dismiss="modal" id="dimissModalEdit"><i class="fa fa-fw fa-lg fa-times-circle icono-azul" id="cancelarModalEditDatosProspecto"></i>Cancelar</a>
                <button id="btnActionFormEdit" type="submit" class="btn btn-outline-secondary icono-color-principal btn-inline"><i class="fa fa-fw fa-lg fa-check-circle icono-azul"></i><span id="btnText"> Actualizar</span></button>
            </div>
            </form>
        </div>
    </div>
</div>