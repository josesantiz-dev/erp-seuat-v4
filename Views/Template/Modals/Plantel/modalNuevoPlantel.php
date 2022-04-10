<!-- Modal -->
<div class="modal fade" id="ModalFormNuevoPlantel" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModalNuevo">Nuevo plantel</h5>
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">
                    <nav>
                        <div class="nav nav-pills nav-fill" id="nav-tab" role="tablist">
                            <a class="nav-link tab-nav" id="step1-tab" data-toggle="tab" href="" onclick="fnNavTab(0)">Plantel</a>
                            <a class="nav-link tab-nav" id="step2-tab" data-toggle="tab" href="" onclick="fnNavTab(1)">Sistema</a>
                            <a class="nav-link tab-nav" id="step3-tab" data-toggle="tab" href="" onclick="fnNavTab(2)">Legal</a>
                            <a class="nav-link tab-nav" id="step4-tab" data-toggle="tab" href="" onclick="fnNavTab(3)">Ubicación</a>
                            <a class="nav-link tab-nav" id="step5-tab" data-toggle="tab" href="" onclick="fnNavTab(4)">Logos</a>
                        </div>
                    </nav>
                    <form id="formNuevoPlantel" method = "POST" name="formNuevoPlantel" enctype="multipart/form-data">
                        <input type="hidden" id="idPlantelNuevo" name="idPlantelNuevo" value="">
                        <div class="card-body"> 
                                <div class="tab">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label>Nombre del plantel</label>
                                            <input type="text" id="txtNombrePlantelNuevo" name="txtNombrePlantelNuevo" class="form-control form-control-sm" placeholder="EJ: Instituto de Estudios Superiores Azteca" maxlength="100" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Abreviación del plantel</label>
                                            <input type="text" id="txtAbreviacionPlantelNuevo" name="txtAbreviacionPlantelNuevo" class="form-control form-control-sm" placeholder="EJ: IESAZTECA" maxlength="10" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label>Nombre del sistema</label>
                                            <input type="text" id="txtNombreSistemaNuevo" name="txtNombreSistemaNuevo" class="form-control form-control-sm" placeholder="EJ: Universidad Particular Azteca en Oaxaca" maxlength="100" requires>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Abreviación del sistema</label>
                                            <input type="text" id="txtAbreviacionSistemaNuevo" name="txtAbreviacionSistemaNuevo" class="form-control form-control-sm" placeholder="EJ: UPAO" maxlength="10" requires>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label>Régimen</label>
                                            <input type="text" id="txtRegimenNuevo" name="txtRegimenNuevo" class="form-control form-control-sm" placeholder="EJ: Particular" maxlength="30" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Clave del centro de trabajo</label>
                                            <input type="text" id="txtClaveCentroTrabajoNuevo" name="txtClaveCentroTrabajoNuevo" class="form-control form-control-sm" placeholder="Clave del centro de trabajo" maxlength="15" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Servicio</label>
                                            <input type="text" id="txtServicioNuevo" name="txtServicioNuevo" class="form-control form-control-sm" placeholder="EJ: Educativo" maxlength="50" required>
                                        </div>
                                        <!--<div class="form-group col-md-4">
                                            <label>Acuerdo de incorporación</label>
                                            <input type="text" id="txtAcuerdoIncorporacionNuevo" name="txtAcuerdoIncorporacionNuevo" class="form-control form-control-sm" placeholder="EJ: PSU-21/2022" maxlength="15" required>
                                        </div>-->
                                        <div class="form-group col-md-8">
                                            <label>Categoría</label>
                                            <input type="text" id="txtCategoriaNuevo" name="txtCategoriaNuevo" class="form-control form-control-sm" placeholder="EJ: Incorporado a Secretaría de Educación del Estado de Chiapas" maxlength="70" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Zona escolar</label>
                                            <input type="text" id="txtZonaEscolarNuevo" name="txtZonaEscolarNuevo" class="form-control form-control-sm" placeholder="Zona escolar" maxlength="5">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Cédula de funcionamiento</label>
                                            <input type="text" id="txtCedulaFuncionamientoNuevo" name="txtCedulaFuncionamientoNuevo" class="form-control form-control-sm" placeholder="Cédula de funcionamiento" maxlength="30">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Clave de institución DGP</label>
                                            <input type="text" id="txtClaveInstitucionDGPNuevo" name="txtClaveInstitucionDGPNuevo" class="form-control form-control-sm" placeholder="Clave de institución" maxlength="30">
                                        </div>
                                        <!--<div class="form-group col-md-4">
                                            <label>Clave DGP</label>
                                            <input type="text" id="txtClaveDGPNuevo" name="txtClaveDGPNuevo" class="form-control form-control-sm" placeholder="Clave DGP" maxlength="20">
                                        </div>-->
                                    </div>               
                                </div>   
                                <div class="tab">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label>Estado</label>
                                            <select class="form-control form-control-sm" id="listEstadoNuevo" name="listEstadoNuevo" onchange="estadoSeleccionado(value)" required>
                                                <option value="" >Selecciona un Estado</option>
                                                <?php 
                                                    foreach ($data['lista_estados'] as $value) {
                                                        ?>
                                                            <option value="<?php echo $value['id']; ?>" ><?php echo $value['nombre']; ?></option>
                                                        <?php
                                                    }

                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Municipio</label>
                                            <select class="form-control form-control-sm" id="listMunicipioNuevo" name="listMunicipioNuevo" onchange="municipioSeleccionado(value)" required>
                                                <option value="">Selecciona un Municipio</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Localidad</label>
                                            <select class="form-control form-control-sm" id="listLocalidadNuevo" name="listLocalidadNuevo" required>
                                                <option value="">Selecciona una Localidad</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-8">
                                            <label>Colonia</label>
                                            <input type="text" id="txtColoniaNuevo" name="txtColoniaNuevo" class="form-control form-control-sm" placeholder="Colonia" maxlength="70" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Codigo postal</label>
                                            <input type="text" id="txtCodigoPostalNuevo" onkeypress="return validarNumeroInput(event)" name="txtCodigoPostalNuevo" class="form-control form-control-sm" placeholder="Código postal" maxlength="6" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Latitud</label>
                                            <input type="text" id="txtLatitudNuevo"  name="txtLatitudNuevo" class="form-control form-control-sm" placeholder="Latitud" maxlength="40" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Longitud</label>
                                            <input type="text" id="txtLongitudNuevo"  name="txtLongitudNuevo" class="form-control form-control-sm" placeholder="Longitud" maxlength="40" required>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Domicilio</label>
                                            <textarea class="form-control form-control-sm" id="txtDomicilioNuevo" name="txtDomicilioNuevo" rows="2" placeholder="Domicilio" maxlength="200" required></textarea>
                                        </div>
                                    </div>               
                                </div>
                                <div class="tab">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <div class="card">
                                                <div class="card-header row">
                                                    <div class="col-md-6">
                                                        <card-title>Plantel</card-title>  
                                                    </div>
                                                    <div class="col-md-6">
                                                        <a href="#" class="btn btn-primary btn-sm float-right" onclick="buscarImagenPlantel()" id="btnBuscarImagenPlantel">Buscar Imagen</a>
                                                    </div>
                                                </div>
                                                <div class="form-group card-body text-center" id="huhshu" style="position:relative;" >
                                                    <span class="img-div">
                                                        <img src="<?php echo media();?>/images/img/logo-empty.png" id="profileDisplayPlantel" style="max-width:200px;">
                                                    </span>
                                                    <input type="file" name="profileImagePlantel" onChange="displayImagePlantel(this)" id="profileImagePlantel" class="form-control" style="display: none;"
                                                        accept=".png,.jpg,.jpeg,.svg" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <div class="card">
                                                <div class="card-header row d-flex justify-content-between">
                                                    <div class="col-md-6">
                                                        <card-title>Sistema</card-title>  
                                                    </div>
                                                    <div class="col-md-6">
                                                        <a href="#" class="btn btn-primary btn-sm float-right" onclick="buscarImagenSistema()" id="btnBuscarImagenSistema">Buscar Imagen</a>
                                                    </div>
                                                </div>
                                                <div class="form-group card-body text-center" style="position:relative;" >
                                                    <span class="img-div">
                                                        <img src="<?php echo media();?>/images/img/logo-empty.png" id="profileDisplaySistema" style="max-width:200px;">
                                                    </span>
                                                    <input type="file" name="profileImageSistema" onChange="displayImageSistema(this)" id="profileImageSistema" class="form-control" style="display: none;"
                                                    accept=".png,.jpg,.jpeg,.svg" required>
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
                        <div class="col-7 text-right">
                            <span class="step"></span>
                            <span class="step"></span>
                            <span class="step"></span>
                            <span class="step"></span>
                            <span class="step"></span>
                        </div>
                        <div class="col-5">
                            <div class="float-right">
                                <div class="row">
                                    <!--<a class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" data-dismiss="modal" id="dimissModalNuevo"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>-->
                                    <buttom class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" onclick="pasarTab(-1)"  id="btnAnterior"><i class="fas fa-fw fa-lg fa-arrow-circle-left icono-azul"></i>Anterior</buttom>
                                    <buttom class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" onclick="pasarTab(1)"  id="btnSiguiente"><i class="fas fa-fw fa-lg fa-arrow-circle-right icono-azul"></i>Siguiente</buttom>
                                    <button id="btnActionFormNuevo" type="submit" class="btn btn-outline-secondary btn-primary icono-color-principal btn-inline"><i class="fa fa-fw fa-lg fa-check-circle icono-azul"></i><span id="btnText"> Guardar</span></button>
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

