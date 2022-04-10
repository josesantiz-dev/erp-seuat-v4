<!-- Modal -->
<div class="modal fade" id="ModalFormEditPlantel" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title">Editar plantel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">
                    <nav>
                        <div class="nav nav-pills nav-fill" id="nav-tab" role="tablist">
                            <a class="nav-link tab-navEdit" id="step1-tabEdit" data-toggle="tab" href="" onclick="fnNavTabEdit(0)">Plantel</a>
                            <a class="nav-link tab-navEdit" id="step2-tabEdit" data-toggle="tab" href="" onclick="fnNavTabEdit(1)">Sistema</a>
                            <a class="nav-link tab-navEdit" id="step3-tabEdit" data-toggle="tab" href="" onclick="fnNavTabEdit(2)">Legal</a>
                            <a class="nav-link tab-navEdit" id="step4-tabEdit" data-toggle="tab" href="" onclick="fnNavTabEdit(3)">Ubicación</a>
                            <a class="nav-link tab-navEdit" id="step5-tabEdit" data-toggle="tab" href="" onclick="fnNavTabEdit(4)">Logos</a>
                        </div>
                    </nav>
                    <form id="formEditPlantel" method = "POST" name="formEditPlantel" enctype="multipart/form-data">
                        <input type="hidden" id="idPlantelEdit" name="idPlantelEdit" value="">
                        <div class="card-body"> 
                                <div class="tabEdit">
                                    <div class="row">
                                        <div class="form-group col-md-9">
                                            <label>Nombre del plantel</label>
                                            <input type="text" id="txtNombrePlantelEdit" name="txtNombrePlantelEdit" class="form-control form-control-sm" placeholder="EJ: Instituto de Estudios Superiores Azteca" maxlength="100" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Abreviación del plantel</label>
                                            <input type="text" id="txtAbreviacionPlantelEdit" name="txtAbreviacionPlantelEdit" class="form-control form-control-sm" placeholder="EJ: IESAZTECA" maxlength="10" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="tabEdit">
                                    <div class="row">
                                        <div class="form-group col-md-8">
                                            <label>Nombre del sistema</label>
                                            <input type="text" id="txtNombreSistemaEdit" name="txtNombreSistemaEdit" class="form-control form-control-sm" placeholder="EJ: Universidad Particular Azteca en Oaxaca" maxlength="100" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Abreviación del sistema</label>
                                            <input type="text" id="txtAbreviacionSistemaEdit" name="txtAbreviacionSistemaEdit" class="form-control form-control-sm" placeholder="EJ: UPAO" maxlength="10" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="tabEdit">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label>Régimen</label>
                                            <input type="text" id="txtRegimenEdit" name="txtRegimenEdit" class="form-control form-control-sm" placeholder="EJ: Particula" maxlength="30" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Clave del centro de trabajo</label>
                                            <input type="text" id="txtClaveCentroTrabajoEdit" name="txtClaveCentroTrabajoEdit" class="form-control form-control-sm" placeholder="Clave del centro de trabajo" maxlength="15" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Servicio</label>
                                            <input type="text" id="txtServicioEdit" name="txtServicioEdit" class="form-control form-control-sm" placeholder="EJ: Educativo" maxlength="50" required>
                                        </div>
                                        <!--<div class="form-group col-md-4">
                                            <label>Acuerdo de incorporación</label>
                                            <input type="text" id="txtAcuerdoIncorporacionEdit"  name="txtAcuerdoIncorporacionEdit" class="form-control form-control-sm" placeholder="EJ: PSU-21/2022" maxlength="15" required>
                                        </div>-->
                                        <div class="form-group col-md-8">
                                            <label>Categoría</label>
                                            <input type="text" id="txtCategoriaEdit" name="txtCategoriaEdit" class="form-control form-control-sm" placeholder="EJ: Incorporado a Secretaría de Educación del Estado de Chiapas" maxlength="70" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Zona escolar</label>
                                            <input type="text" id="txtZonaEscolarEdit"  name="txtZonaEscolarEdit" class="form-control form-control-sm" placeholder="Zona escolar" maxlength="5">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Cédula de funcionamiento</label>
                                            <input type="text" id="txtCedulaFuncionamientoEdit" name="txtCedulaFuncionamientoEdit" class="form-control form-control-sm" placeholder="Cédula de funcionamiento"" maxlength="30">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Clave de institución DGP</label>
                                            <input type="text" id="txtClaveInstitucionDGPEdit" name="txtClaveInstitucionDGPEdit" class="form-control form-control-sm" placeholder="Clave de institución" maxlength="30">
                                        </div>
                                        <!--<div class="form-group col-md-4">
                                            <label>Clave DGP</label>
                                            <input type="text" id="txtClaveDGPEdit" name="txtClaveDGPEdit" class="form-control form-control-sm" placeholder="Clave DGP" maxlength="20">
                                        </div>-->
                                    </div>               
                                </div>   
                                <div class="tabEdit">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label>Estado</label>
                                            <select class="form-control form-control-sm" id="listEstadoEdit" name="listEstadoEdit" onchange="estadoSeleccionadoEdit(value)" required>
                                                <option value="" >Selecciona un Estado</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Municipio</label>
                                            <select class="form-control form-control-sm" id="listMunicipioEdit" name="listMunicipioEdit" onchange="municipioSeleccionadoEdit(value)" required>
                                                <option value="">Selecciona un Municipio</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Localidad</label>
                                            <select class="form-control form-control-sm" id="listLocalidadEdit" name="listLocalidadEdit" required>
                                                <option value="">Selecciona una Localidad</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-8">
                                            <label>Colonia</label>
                                            <input type="text" id="txtColoniaEdit" name="txtColoniaEdit" class="form-control form-control-sm" placeholder="Colonia" maxlength="70" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Codigo postal</label>
                                            <input type="text" id="txtCodigoPostalEdit" onkeypress="return validarNumeroInput(event)" name="txtCodigoPostalEdit" class="form-control form-control-sm" placeholder="Código postal" maxlength="6" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Latitud</label>
                                            <input type="text" id="txtLatitudEdit" name="txtLatitudEdit" class="form-control form-control-sm" placeholder="Latitud" maxlength="40" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Longitud</label>
                                            <input type="text" id="txtLongitudEdit" name="txtLongitudEdit" class="form-control form-control-sm" placeholder="Longitud" maxlength="40" required>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Domicilio</label>
                                            <textarea class="form-control form-control-sm" id="txtDomicilioEdit" name="txtDomicilioEdit" rows="2" placeholder="Domicilio" maxlength="200" required></textarea>
                                        </div>
                                    </div>               
                                </div>
                                <div class="tabEdit">
                                    <div class="row">
                                        <div class="form-group col-md-5">
                                            <div class="card">
                                                <div class="card-header row">
                                                    <div class="col-md-6">
                                                        <card-title>Plantel</card-title>  
                                                    </div>
                                                    <div class="col-md-6">
                                                        <a href="#" class="btn btn-warning btn-sm float-right" onclick="buscarImagenPlantelEdit()" id="btnBuscarImagenPlantelEdit">Cambiar</a>
                                                    </div>
                                                </div>
                                                <div class="form-group card-body text-center"  style="position:relative;" >
                                                    <span class="img-div">
                                                        <img src="<?php echo media();?>/images/img/logo-empty.png" id="profileDisplayPlantelEdit" style="max-width:200px;">
                                                    </span>
                                                    <input type="file" name="profileImagePlantel" onChange="displayImagePlantelEdit(this)" id="profileImagePlantelEdit" class="form-control" style="display: none;"
                                                        accept=".png,.jpg,.jpeg,.svg">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <div class="card">
                                                <div class="card-header row d-flex justify-content-between">
                                                    <div class="col-md-6">
                                                        <card-title>Sistema</card-title>  
                                                    </div>
                                                    <div class="col-md-6">
                                                        <a href="#" class="btn btn-warning btn-sm float-right" onclick="buscarImagenSistemaEdit()" id="btnBuscarImagenSistemaEdit">Cambiar</a>
                                                    </div>
                                                </div>
                                                <div class="form-group card-body text-center" style="position:relative;" >
                                                    <span class="img-div">
                                                        <img src="<?php echo media();?>/images/img/logo-empty.png" id="profileDisplaySistemaEdit" style="max-width:200px;">
                                                    </span>
                                                    <input type="file" name="profileImageSistema" onChange="displayImageSistemaEdit(this)" id="profileImageSistemaEdit" class="form-control" style="display: none;"
                                                    accept=".png,.jpg,.jpeg,.svg">
                                                </div>
                                            </div> 
                                        </div>
                                    </div>               
                                </div>    
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row col-12">
                        <!--<div class="col-4">
                            <a class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" data-dismiss="modal" id="dimissModalNuevo"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>
                        </div>-->
                        <div class="col-6 text-right">
                            <span class="stepEdit"></span>
                            <span class="stepEdit"></span>
                            <span class="stepEdit"></span>
                            <span class="stepEdit"></span>
                            <span class="stepEdit"></span>
                        </div>
                        <div class="col-6">
                            <div class="float-right">
                                <div class="row">
                                    <!--<a class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" data-dismiss="modal" id="dimissModalEdit"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>-->
                                    <buttom class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" onclick="pasarTabEdit(-1)"  id="btnAnteriorEdit"><i class="fas fa-fw fa-lg fa-arrow-circle-left icono-azul"></i>Anterior</buttom>
                                    <buttom class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" onclick="pasarTabEdit(1)"  id="btnSiguienteEdit"><i class="fas fa-fw fa-lg fa-arrow-circle-right icono-azul"></i>Siguiente</buttom>
                                    <button id="btnActionFormEdit" type="submit" class="btn btn-outline-secondary btn-primary icono-color-principal btn-inline"><i class="fa fa-fw fa-lg fa-check-circle icono-azul"></i><span id="btnText"> Actualizar</span></button>
                                    <!--<button class="btn btn-primary" type="button" id="btnAnterior" onclick="pasarTab(-1)">Anterior</button>
                                    <button class="btn btn-primary" type="button" id="btnSiguiente" onclick="pasarTab(1)">Siguiente</button>
                                    <button class="btn btn-success" type="submit" id="btnActionFormNuevo">Guardar</button>-->
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

