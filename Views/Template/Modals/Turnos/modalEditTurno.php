<!-- Modal -->
<div class="modal fade" id="ModalEditTurno" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header headerUpdate">
                <h5 class="modal-title" id="titleModalNueva">Editar turno</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">
                    <form id="formTurnoEdit" name="formTurnoEdit">
                        <input type="hidden" id="idTurnoEdit" name="idTurnoEdit" value="">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-7">
                                    <label>Nombre del turno</label>
                                    <input type="text" id="txtTurnoEdit" name="txtTurnoEdit" class="form-control form-control-sm" placeholder="EJ: Lunes - Viernes / Matutino" name="" maxlength="45" required="">
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="">Abreviatura</label>
                                    <input type="text" id="txtAbreviaturaEdit" name="txtAbreviaturaEdit" class="form-control form-control-sm" placeholder="EJ: LVM" required="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="">Hora entrada</label>
                                    <input type="time" id="txtHoraEntEdit" name="txtHoraEntEdit" class="form-control form-control-sm" required="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Hora salida</label>
                                    <input type="time" id="txtHoraSalEdit" name="txtHoraSalEdit" class="form-control form-control-sm" required="">
                                </div>
                            </div>
                            <div class="row">
                                <table class="table table-stripped table-sm">
                                    <tr>
                                        <th class="text-center">Lu</th>
                                        <th class="text-center">Ma</th>
                                        <th class="text-center">Mi</th>
                                        <th class="text-center">Ju</th>
                                        <th class="text-center">Vi</th>
                                        <th class="text-center">Sá</th>
                                        <th class="text-center">Do</th>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" name="chkLunesEdit" id="chkLunesEdit">
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" name="chkMartesEdit" id="chkMartesEdit">
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" name="chkMiercolesEdit" id="chkMiercolesEdit">
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" name="chkJuevesEdit" id="chkJuevesEdit">
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" name="chkViernesEdit" id="chkViernesEdit">
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" name="chkSabadoEdit" id="chkSabadoEdit">
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" name="chkDomingoEdit" id="chkDomingoEdit">
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="form-group">
                                <label>Estatus</label>
                                <select name="slctEstatusTurnoEdit" id="slctEstatusTurnoEdit" class="form-control form-control-sm" required>
                                    <option value="">Selecciona el estatus de la categoría</option>
                                    <option value="1">Activo</option>
                                    <option value="2">Inactivo</option>
                                </select>
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" data-dismiss="modal" id="dimissModalEdit"><i class="fa fa-fw fa-lg fa-times-circle icono-azul" id="cancelarModalTurnoEdit"></i>Cancelar</a>
                <button id="btnActionFormEdit" type="submit" class="btn btn-outline-secondary icono-color-principal btn-inline"><i class="fa fa-fw fa-lg fa-check-circle icono-azul"></i><span id="btnText"> Actualizar</span></button>
            </div>
            </form>
        </div>
    </div>
</div>