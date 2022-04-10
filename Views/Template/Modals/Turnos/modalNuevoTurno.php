<div class="modal fade" id="ModalNuevoTurno" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nuevo turno para inscripciones</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">
                    <form id="formTurnoNuevo" name="formTurnoNuevo">
                        <input type="hidden" id="idTurnoNuevo" name="idTurnoNuevo" value="">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-7">
                                    <label>Nombre del turno</label>
                                    <input type="text" id="txtTurnoNuevo" name="txtTurnoNuevo" class="form-control form-control-sm" placeholder="EJ: Lunes - Viernes / Matutino" name="" maxlength="45" required="">
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="">Abreviatura</label>
                                    <input type="text" id="txtAbreviatura" name="txtAbreviatura" class="form-control form-control-sm" placeholder="EJ: LVM" required="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="">Hora entrada</label>
                                    <input type="time" id="txtHoraEnt" name="txtHoraEnt" class="form-control form-control-sm" required="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Hora salida</label>
                                    <input type="time" id="txtHoraSal" name="txtHoraSal" class="form-control form-control-sm" required="">
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
                                                <input type="checkbox" name="chkLunes" id="chkLunes">
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" name="chkMartes" id="chkMartes">
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" name="chkMiercoles" id="chkMiercoles">
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" name="chkJueves" id="chkJueves">
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" name="chkViernes" id="chkViernes">
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" name="chkSabado" id="chkSabado">
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" name="chkDomingo" id="chkDomingo">
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" data-dismiss="modal" id="dimissModalNuevoSalon"><i class="fa fa-fw fa-lg fa-times-circle icono-azul" id="cancelarModalNTurno"></i>Cancelar</a>
                <button id="btnActionFormNuevo" type="submit" class="btn btn-outline-secondary icono-color-principal btn-inline"><i class="fa fa-fw fa-lg fa-check-circle icono-azul"></i><span id="btnText"> Guardar</span></button>
            </div>
            </form>
        </div>
    </div>
</div>