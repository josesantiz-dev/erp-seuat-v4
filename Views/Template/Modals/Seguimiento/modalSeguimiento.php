<!-- Modal -->
<div class="modal fade" id="ModalSeguimiento" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header headerUpdate">
                <h5 class="modal-title" id="titleModalNueva">Seguimiento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="idProspecto" name="idProspecto" value="">
                <input type="hidden" id="idPersonaSeg" name="idPersonaSeg" value="">
                <div class="row">

                    <div class="col-md-6">
                        <!-- Widget: user widget style 1 -->
                        <div class="card card-widget widget-user">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-info">
                                <h3 class="widget-user-username" id="lblNombre"></h3>
                                <h3 class="widget-user-username" id="lblApellidos"></h3>
                                <h6 class="widget-user-desc">Prospecto de nivel <b><label id="lblNivelEducativo"></label></b></h6>
                            </div>
                            <div class="widget-user-image">
                                <img class="img-circle elevation-2" src="<?= media() . "/images/img/avatar4.png" ?>" alt="User Avatar">
                            </div>
                            <div class="card-body mt-3">
                                <div class="row">
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header"><i class="fa fa-map-marker"></i> Lugar de origen </h5>
                                            <span class="text-sm description-text" id="lblMunicipio"></span> /
                                            <span class="text-sm description-text" id="lblEstado"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header"><i class="fa fa-phone"></i> Teléfono </h5>
                                            <span class="text-sm description-text" id="lblTel_celular"></span>

                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="description-block">
                                            <h5 class="description-header"><i class="fa fa-envelope"></i> Correo electrónico </h5>
                                            <span class="text-sm description-text" id="lblEmail"></span>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12 text-md">
                                        <i class="fas fa-graduation-cap"></i> Carrera de interés: <label id="lblCarreraInteres" class="badge badge-info"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex align-items-stretch flex-column">
                        <div class="card bg-light d-flex flex-fill">
                            <div class="card-header text-muted border-bottom-0">
                                Asesor de prospección:
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="lead"><label id="lblNombreComisionista"></label></h2>

                                        <ul class="ml-4 mb-0 fa-ul text-muted">
                                            <li class="medimum"><span class="fa-li"><i class="fa fa-phone"></i></span>Teléfono comisionista: <br><span id="tel_celular_comisionista"></span></li>
                                            <li class="medium"><span class="fa-li"><i class="fa fa-calendar"></i></span> Fecha de prospección: <br><span id="lblFecha"></span></li>
                                            <li class="medium"><span class="fa-li"><i class="fa fa-suitcase"></i></span>Medio publicitario: <br><span id="lblMedioPublicitario"></span></li>
                                        </ul>
                                    </div>
                                    <div class="col-5 text-center">
                                        <img src="<?= media() . "/images/img/avatar5.png" ?>" style="width: 65px; height: 65px;" class="img-circle img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-right">
                                    <a href="#" class="btn btn-sm btn-primary">
                                        <i class="fas fa-user"></i> Ver perfil
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 text-right">
                        <button id="btnInscripcion" class="btn btn-xl btn-success icono-color-principal btn-inline">
                            <i class="fas fa-user-plus"></i>Inscribir
                        </button>
                    </div>
                    <div class="col-md-6 text-left">
                        <button id="btnSeguimiento" data-toggle="modal" data-target="#modalProspeccionIndividual" onClick="fnSeguimientoInvidual()" class="btn btn-xl btn-primary icono-color-principal btn-inline">
                            <i class="fas fa-forward"></i> Seguimiento
                        </button>
                    </div>
                </div>
                <div class="card card-secondary">
                    <div class="card-body">
                        <p class="card-text">
                        <table id="tableSegProspectoIndividual" class="table table-bordered table-striped table-hover ">
                            <thead>
                                <tr>
                                    <th>Fecha y hora</th>
                                    <th>Respuesta</th>
                                    <th>Comentario</th>
                                    <th>Asesor</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-outline-secondary icono-color-principal btn-inline" data-dismiss="modal" id="dimissModalEdit"><i class="fa fa-fw fa-lg fa-times-circle icono-azul" id="cancelarModalSeguimiento"></i>Salir</a>
            </div>
            <!--</form>-->
        </div>
    </div>
</div>