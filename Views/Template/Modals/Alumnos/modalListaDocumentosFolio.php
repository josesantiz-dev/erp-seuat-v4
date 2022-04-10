<!-- Modal -->
<div class="modal fade" id="ModalListaDocFolio" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModal">Lista de documentos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">
                    <form id="formDocumentacionNueva" name="formDocumentacionNueva">
                        <input type="hidden" id="idInscripcion" name="idInscripcion" value="">
                        <div class="card-body">
                            <div id="card-documentacion"> 
                                <h5 class="card-title" id="nomPersonaDocumentacion"></h5>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Folio</th>
                                            <th scope="col">Nombre del documento</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbVerHistorialDocumentacion">
                                    </tbody>
                                </table>
                            </div>    
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" data-dismiss="modal" id="dimissModalNuevo"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cerrar</a>
                </div>   
            </form> 
        </div>
    </div>
</div>