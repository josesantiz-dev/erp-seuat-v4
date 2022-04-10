<div class="modal fade" id="modalHistorialPagosAlumno" tabindex="-1" role="dialog" aria-labelledby="modalNombrePersonaLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title nombre_alumno"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="tableListaInscritos" class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Folio</th>
                            <th>Fecha</th>
                            <th>Concepto</th>
                            <th>Cargo</th>
                            <th>atendido por:</th>
                        </tr>
                    </thead>
                    <tbody id="valoresMovientosAlumnoDet">
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <a class="btn btn-outline-secondary btn-primary icono-color-principal btn-inline" href="#" data-dismiss="modal" id="cerrarModalListaInscritos"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cerrar</a>
            </div>
        </div>
    </div>
</div>