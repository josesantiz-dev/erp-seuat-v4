<!-- Modal -->
<div class="modal fade" id="ModalFormRvoeExp" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header headerUpdaded">
                <h5 class="modal-title" id="titleModalEdit">RVOES por expirar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">
                    <form>
                        <div class="card-body">
                            <div class="row">
                                <table class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre del plan</th>
                                            <th>Sistema</th>
                                            <th>Plantel</th>
                                            <th>RVOE</th>
                                            <th>Fecha expiración</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableRvoesExp">
                                    </tbody>
                                </table>    
                                <div id="alertSinRvoeExp" class="col-12">
                                </div>     
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" data-dismiss="modal" id="dimissModalEdit"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>
                </div>   
            </form> 
        </div>
    </div>
</div>