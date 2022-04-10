<!-- Modal -->
<div class="modal fade" id="ModalAgendarProspectoSeguimiento" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header headerUpdate">
                <h5 class="modal-title" id="titleModalNueva">Agendar</h5>
                <button id="cerrarModalAgendaProspectoSeguimiento" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">
                    <form id="formAgendar" name="formAgendar">

                    <!--Se Cambio id y name ^ v -->

                    <!--form id="formTurnoEdit" name="formTurnoEdit"-->
                        <input type="hidden" id="idPersona" name="idPersona" value="">
                        <input type="hidden" id="txtFechaRegistro" name="txtFechaRegistro" value="<?php echo date('Y-m-d'); ?>">
                        <!--Se agrego el input idUsuarioAtendidoAgenda-->
                        <input type="hidden" id="idUsuarioAtendidoAgenda" name="idUsuarioAtendidoAgenda" value="1">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>Fecha programada</label>
                                    <input type="date" id="txtFechaProg" name="txtFechaProg" class="form-control form-control-sm" placeholder="Ingrese nombre" required="" value="<?php echo date("Y-m-d"); ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>Hora programada</label>
                                    <input type="time" id="txtHoraProg" name="txtHoraProg" class="form-control form-control-sm" placeholder="Ingrese nombre" required="">
                                    <!--Se Cambio id y name ^ v -->
                                    <!--input type="time" id="txtFechaProg" name="txtFechaProg" class="form-control form-control-sm" placeholder="Ingrese nombre" required=""-->
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>Asunto</label>
                                    <input type="text" id="txtAsunto" name="txtAsunto" class="form-control form-control-sm" placeholder="Ingrese nombre" required="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>Comentarios</label>
                                    <textarea name="txtComentario" class="form-control form-control-sm" placeholder="Observaciones" id="txtComentario" cols="30" rows="2" maxlength="150"></textarea>
                                </div>
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
