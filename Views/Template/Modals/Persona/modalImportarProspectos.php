<!-- Modal -->
<div class="modal fade" id="modal_importar_prospectos" data-backdrop="static" data-keyboard="true" tabindex="-1"
    role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModalNuevo">Importar prospectos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">
                    <form id="form_importar_prospectos" name="form_importar_prospectos">
                        <div class="card-body">
                            <div class="row">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="file_csv_importar_prospectos"
                                        accept=".csv" required>
                                    <label class="custom-file-label" for="file_csv_importar_prospectos"
                                        id="label_input_csv">Seleccione un archivo csv...</label>
                                </div>
                            </div>
                            <br>
                            <div class="alert alert-light fade show alert_select_prospectos text-center" role="alert">
                                Vista previa de los prospectos a importar.
                            </div>
                            <div style="overflow-x: auto;">
                                <table class="table table-striped">
        
                                    <tbody id="table_personas_modal_preview">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" data-dismiss="modal"
                    id="dimissModalNuevo"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>
                <button id="btnActionFormNuevo" type="submit"
                    class="btn btn-outline-secondary icono-color-principal btn-primary btn-inline"><i
                        class="fa fa-fw fa-lg fa-check-circle icono-azul"></i><span
                        id="btnText">Importar</span></button>
            </div>
            </form>
        </div>
    </div>
</div>