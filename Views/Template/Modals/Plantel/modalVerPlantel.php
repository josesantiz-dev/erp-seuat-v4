<!-- Modal -->
<div class="modal fade" id="ModalVerPlantel" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titModal"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <input type="hidden" id="idPlantel" name="idPlantel" value="">
                    <div class="card card-light">
                        <div class="card-header">
                            <label><i class="far fa-building text-secondary"></i> Plantel</label>
                        </div> 
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-9">
                                    <label>Nombre del plantel</label>
                                    <input type="text" id="txtNombrePlantelVer" class="form-control form-control-sm" disabled >
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Abreviación del plantel</label>
                                    <input type="text" id="txtAbreviacionPlantelVer" class="form-control form-control-sm" disabled>
                                </div>
                            </div>
                        </div>
                    </div>    
                    <div class="card card-light">
                        <div class="card-header">
                            <label><i class="fas fa-city text-secondary"></i> Sistema</label>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-8">
                                    <label>Nombre del sistema</label>
                                    <input type="text" id="txtNombreSistemaVer" class="form-control form-control-sm"  disabled >
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Abreviación del sistema</label>
                                    <input type="text" id="txtAbreviacionsistemaVer"  class="form-control form-control-sm" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-light">
                        <div class="card-header">
                            <label><i class="fas fa-balance-scale text-secondary"></i> Legal</label>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Régimen</label>
                                    <input type="text" id="txtRegimenVer"  class="form-control form-control-sm"  disabled>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Clave del centro de trabajo</label>
                                    <input type="text" id="txtClaveCentroTrabajoVer" class="form-control form-control-sm"  disabled>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Servicio</label>
                                    <input type="text" id="txtServicioVer"  class="form-control form-control-sm"  disabled>
                                </div>
                                <!--<div class="form-group col-md-4">
                                    <label>Acuerdo de incorporación</label>
                                    <input type="text" id="txtAcuerdoIncorporacionVer" class="form-control form-control-sm"  disabled>
                                </div>-->
                                <div class="form-group col-md-8">
                                    <label>Categoría</label>
                                    <input type="text" id="txtCategoriaVer"  class="form-control form-control-sm" disabled>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Zona escolar</label>
                                    <input type="text" id="txtZonaEscolarVer" class="form-control form-control-sm"  disabled>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Cédula de funcionamiento</label>
                                    <input type="text" id="txtCedulaFuncionamientoVer"  class="form-control form-control-sm"  maxlength="5" disabled>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Clave de institución DGP</label>
                                    <input type="text" id="txtClaveInstitucionDGPVer"  class="form-control form-control-sm"  maxlength="5" disabled>
                                </div>
                                <!--<div class="form-group col-md-4">
                                    <label>Clave DGP</label>
                                    <input type="text" id="txtClaveDGPVer"  class="form-control form-control-sm"  maxlength="5" disabled>
                                </div>-->
                            </div>
                        </div>
                    </div>
                    <div class="card card-light">
                        <div class="card-header">
                            <label><i class="fas fa-map-marker-alt text-secondary"></i> Ubicacion</label>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Estado</label>
                                    <select class="form-control form-control-sm" id="txtEstadoVer" disabled>
                                        <option value="" >Selecciona un Estado</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Municipio</label>
                                    <select class="form-control form-control-sm" id="txtMunicipioVer" disabled>
                                        <option value="">Selecciona un Municipio</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Localidad</label>
                                    <select class="form-control form-control-sm" id="txtLocalidadVer" disabled>
                                        <option value="">Selecciona una Localidad</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-8">
                                    <label>Colonia</label>
                                    <input type="text" id="txtColoniaVer" class="form-control form-control-sm" disabled>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Codigo postal</label>
                                    <input type="text" id="txtCodigoPostalVer" class="form-control form-control-sm"  disabled>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Latitud</label>
                                    <input type="text" id="txtLatitudVer" class="form-control form-control-sm" disabled>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Longitud</label>
                                    <input type="text" id="txtLongitudVer" class="form-control form-control-sm"  disabled>
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Domicilio</label>
                                    <textarea class="form-control form-control-sm" id="txtDomicilioVer" rows="2" disabled></textarea>
                                </div>
                            </div>
                        </div>    
                    </div>
                    <div class="card card-light">
                        <div class="card-header">
                            <label><i class="far fa-image text-secondary"></i> Logos</label>
                        </div>  
                        <div class="card-body">
                            <div class="row d-flex justify-content-between">
                                <div class="form-group col-md-5">
                                    <div class="card">
                                        <div class="card-header row">
                                            <div class="col-6">
                                                <card-title>Plantel</card-title>  
                                            </div>
                                        </div>
                                        <div class="form-group card-body text-center" id="huhshu" style="position:relative;" >
                                            <span class="img-div">
                                                <img src="<?php echo media();?>/images/img/logo-empty.png" id="profilePlantelVer" style="max-width:200px;">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-5">
                                    <div class="card">
                                        <div class="card-header row d-flex justify-content-between">
                                            <div class="col-md-6">
                                                <card-title>Sistema</card-title>  
                                            </div>
                                        </div>
                                        <div class="form-group card-body text-center" style="position:relative;" >
                                            <span class="img-div">
                                                <img src="<?php echo media();?>/images/img/logo-empty.png" id="profileSistemaVer" style="max-width:200px;">
                                            </span>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>         
                    </div>
            </div>        
            <div class="modal-footer">
                <a class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" data-dismiss="modal" id="dimissModal"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>
            </div>
        </div>
    </div>
</div>