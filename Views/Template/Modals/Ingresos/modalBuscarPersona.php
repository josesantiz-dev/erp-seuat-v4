<div class="modal fade" id="modalNombrePersona" tabindex="-1" role="dialog" aria-labelledby="modalNombrePersonaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalNombrePersonaNLabel">Buscar Persona</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control col-md-5 form-control-sm" id="inputBusquedaPersona" placeholder="Nombre de la Persona" maxlength="100" autocomplete="off" onKeyUp="fnInputBuscarPersona();" />
                <br>
                <div class="table-responsive">
                    <table id="tablePersonas" class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre alumno</th>
                                <th>Carrera</th>
                                <th>Grado</th>
                                <th>Grupo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-outline-secondary icono-color-principal btn-primary btn-inline" href="#" data-dismiss="modal" id="cerrarModalBuscarPersona"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cerrar</a>
            </div>
        </div>
    </div>
</div>