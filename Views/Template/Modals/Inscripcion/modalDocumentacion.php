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
                    <form id="formCategoriaNueva" name="formCategoriaNueva">
                        <input type="hidden" id="idCategoriaNueva" name="idCategoriaNueva" value="">
                        <div class="card-body"> 
                            <h5 class="card-title">Documentacion</h5>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre del Documento</th>
                                    <th scope="col">Original</th>
                                    <th scope="col">Copia</th>
                                    <th scope="col">Pendiente</th>
                                    </tr>
                                </thead>
                                <tbody id="tbDocumentacionIns">
                                    <!-- <tr>
                                        <th scope="row">1</th>
                                        <td>Acta de Nacimiento</td>
                                        <td>
                                            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                <input type="checkbox" aria-label="Checkbox for following text input">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                <input type="checkbox" aria-label="Checkbox for following text input">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                <input type="checkbox" aria-label="Checkbox for following text input">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                            <td>CURP</td>
                                            <td>
                                                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                            <input type="checkbox" aria-label="Checkbox for following text input">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                            <input type="checkbox" aria-label="Checkbox for following text input">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                            <input type="checkbox" aria-label="Checkbox for following text input">
                                        </div>
                                    </td>
                                    </tr>
                                    <tr>
                                    <th scope="row">3</th>
                                    <td>Certificado de Preparatoria o Bachillerato</td>
                                    <td>
                                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                            <input type="checkbox" aria-label="Checkbox for following text input">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                            <input type="checkbox" aria-label="Checkbox for following text input">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                            <input type="checkbox" aria-label="Checkbox for following text input">
                                        </div>
                                    </td>
                                    </tr> -->
                                </tbody>
                                </table>
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