<!-- Modal -->
<div class="modal fade" id="ModalFormVerPersona" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModalVer">Ver Persona</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">
                    <form id="formPersonaVer" name="formPersonaVer">
                        <input type="hidden" id="idVer" name="idVer" value="">
                        <div class="card-body">
                            <div class="row" >
                                    <div class="form-group col-md-3">
                                        <label>Nombre</label>
                                        <input type="text" id="txtNombreVer" class="form-control form-control-sm"   disabled>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Alias</label>
                                        <input type="text" id="txtAliasVer" class="form-control form-control-sm" disabled>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Apellido Paterno</label>
                                        <input type="text" id="txtApellidoPaVer"  class="form-control form-control-sm" disabled>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Apellido Materno</label>
                                        <input type="text" id="txtApellidoMaVer" class="form-control form-control-sm"  disabled>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Sexo</label>
                                        <select class="form-control form-control-sm" id="listSexoVer"  disabled >
                                        <option value="">Selecciona un Sexo</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Edad</label>
                                        <input type="text" id="txtEdadVer" class="form-control form-control-sm"  disabled>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Estado Civil</label>
                                        <select class="form-control form-control-sm" id="listEstadoCivilVer"  disabled >
                                        <option value="">Selecciona un Estado</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Fecha de Nacimiento</label>
                                        <input type="date" id="txtFechaNacimientOVer"  class="form-control form-control-sm"  disabled>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>CURP</label>
                                        <input type="text" id="txtCURPVer"  class="form-control form-control-sm"  disabled>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Ocupacion</label>
                                        <input type="text" id="txtOcupacionVer"  class="form-control form-control-sm"   disabled>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Categoria Persona</label>
                                        <select class="form-control form-control-sm" id="listCategoriaVer"  disabled >
                                        <option value="">Selecciona una Categoría</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Telefono Celular</label>
                                        <input type="text" id="txtTelCelVer"  class="form-control form-control-sm"    disabled>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Telefono Fijo</label>
                                        <input type="text" id="txtTelFiVer"  class="form-control form-control-sm"   disabled>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Escolaridad</label>
                                        <select class="form-control form-control-sm" id="listEscolaridadVer"  disabled >
                                            <option value="">Selecciona una Escolaridad</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label>Plantel de interés</label>
                                        <input type="text" id="txtPlantelInteresVer" class="form-control form-control-sm"   disabled>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Nivel carrera de interés</label>
                                        <select class="form-control form-control-sm" id="listNivelCarreraInteresVer"  disabled >
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Carrera de interés</label>
                                        <select class="form-control form-control-sm" id="listCarreraInteresVer"  disabled >
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Medio de captación</label>
                                        <input type="text" id="txtMedioCaptacionVer" class="form-control form-control-sm"   disabled>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Escuela de procedencia</label>
                                        <input type="text" id="txtNombreEscuelaProcVer" class="form-control form-control-sm" disabled>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Email</label>
                                        <input type="text" id="txtEmailVer"  class="form-control form-control-sm"    disabled>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Estado</label>
                                        <select class="form-control form-control-sm" id="listEstadoVer"  disabled >
                                            <option value="">Selecciona un Estado</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Municipio</label>
                                        <select class="form-control form-control-sm" id="listMunicipioVer"   disabled >
                                            <option value="">Selecciona un Municipio</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Localidad</label>
                                        <select class="form-control form-control-sm" id="listLocalidadVer" disabled >
                                        <option value="">Selecciona una Localidad</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-10">
                                        <label>Colonia</label>
                                        <input type="text" id="txtColoniaVer" class="form-control form-control-sm"  disabled>
                                    </div>  
                                    <div class="form-group col-md-2">
                                        <label>CP</label>
                                        <input type="text" id="txtCPVer"  class="form-control form-control-sm"  disabled>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Direccion</label>
                                        <input type="text" id="txtDireccionVer"  class="form-control form-control-sm"  disabled>
                                    </div>   
                                    <div class="form-group col-md-12">
                                        <label>Observación</label>
                                        <textarea id="txtObservacionVer" class="form-control form-control-sm" disabled></textarea>
                                    </div>                                 
                                    <div class="form-group col-md-2">
                                        <label>Estatus</label>
                                        <select class="form-control form-control-sm" id="listEstatusVer" disabled >
                                        <option value="">Selecciona un Estatus</option>
                                        </select>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" data-dismiss="modal" id="dimissModalVer"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>
                </div>   
            </form> 
        </div>
    </div>
</div>