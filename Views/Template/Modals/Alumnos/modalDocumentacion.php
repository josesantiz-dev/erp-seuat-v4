<!-- Modal -->
<div class="modal fade" id="ModalFormDocumentacion" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModal">Documentacion</h5>
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
                                            <th scope="col">Nombre del Documento</th>
                                            <th scope="col">Original</th>
                                            <th scope="col">Copia</th>
                                            <th scope="col" width='20%'>Candidad copias</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbDocumentacionIns">
                                    </tbody>
                                </table>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="checkDocumentacion" onclick="validacionDocumentacion(this)">
                                    <label class="form-check-label" for="checkDocumentacion">Para <b style='color:#3b7ddd'>validar</b> marca esta casilla</label>
                                </div>
                            </div>     
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" data-dismiss="modal" id="dimissModalNuevo"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>
                    <button id="btnActionFormNueva" type="submit" class="btn btn-outline-secondary icono-color-principal btn-inline"><i class="fa fa-fw fa-lg fa-check-circle icono-azul"></i><span id="btnText"> Guardar</span></button>
                </div>   
            </form> 
        </div>
    </div>
</div>