<div class="modal fade" id="ModalFormDocumentacionVerificado" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModalNuevo">Documentación de: <span id="nomPersonaDocumentacionVerificado"style='color:#3b7ddd'></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">
                    <nav>
                        <div class="nav nav-pills nav-fill" id="nav-tab" role="tablist">
                            <a class="nav-link tab-nav" id="step1-tab" data-toggle="tab" href="" onclick="fnNavTab(0)">Documentos actuales</a>
                            <a class="nav-link tab-nav" id="step2-tab" data-toggle="tab" href="" onclick="fnNavTab(1)">Realizar préstamo</a>
                            <a class="nav-link tab-nav" id="step3-tab" data-toggle="tab" href="" onclick="fnNavTab(2)">Historial préstamos</a>
                        </div>
                    </nav>
                    <form id="formDocumentosEntregados"  name="formDocumentosEntregados">
                        <input type="hidden" id="idInscripcionPrestamo" name="idInscripcionPrestamo" value="">
                        <input type="hidden" id="tipo" name="tipo" value="">
                        <input type="hidden" id="folioDoc" name="folioDoc" value="">
                        <div class="card-body"> 
                                <div class="tab">
                                    <div class="row">
                                        <div class="col-12 mb-2">
                                            <button type="button" class="btn btn-primary float-right" onclick="fnCartaAutenticidad()"><i class="fas fa-print"></i> Imprimir carta de autenticidad</button>
                                        </div>
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Nombre del Documento</th>
                                                    <th scope="col">Original</th>
                                                    <th scope="col">Copia</th>
                                                    <th scope="col" width='20%'>Préstamo</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbDocumentosEntregados">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab">
                                    <div class="row">
                                        <div class = "col-md-6">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Nombre del Documento</th>
                                                        <th scope="col" width='20%'>Préstamo</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbDocumentosEntregadosPrestamos">
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class = "col-md-1">
                                        </div>
                                        <div class = "col-md-5">
                                            <div class="form-group">
                                                <label>Comentarios</label>
                                                <textarea type="text" id="txtComentarioPrestamo" name="txtComentarioPrestamo" class="form-control form-control-sm" placeholder="Comentarios" rows="5" required></textarea>
                                            </div>
                                            <div class="form-group" id="divFechaDevolucion">
                                                <label>Fecha devolución</label>
                                                <input type="date" id="txtFechaDevolucion" name="txtFechaDevolucion" class="form-control form-control-sm"  value="" max=" " required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab">
                                    <div class="row">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Folio</th>
                                                    <th>Fecha prestado</th>
                                                    <th>Fecha estimada devolucion</th>
                                                    <th>Fecha devolución</th>
                                                    <th>Usuario</th>
                                                    <th>Comentario prestamo</th>
                                                    <th>Comentario devolución</th>
                                                    <th>Estatus</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbHistorialPrestamoDoc">

                                            </tbody>
                                        </table>
                                    </div>               
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="checkDocumentacionValidado">
                                    <label class="form-check-label" for="checkDocumentacion">Para <b style='color:#3b7ddd'>validar</b> marca esta casilla</label>
                                    <p>Ya está <b style='color:#3b7ddd'>validado</b> por: <span class="badge badge-success" id="nombre_usuarios_verificacion"></span></p>
                                </div>     
                        </div>
                        <div class="col-12 text-center">
                            <span class="step"></span>
                            <span class="step"></span>
                            <span class="step"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row col-12">
                        <!--<div class="col-4">
                            <a class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" data-dismiss="modal" id="dimissModalNuevo"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>
                        </div>-->
                        <div class="col-4 text-right">
                           
                        </div>
                        <div class="col-12">
                            <div class="float-right">
                                <div class="row">
                                    <buttom class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" onclick="pasarTab(-1)"  id="btnAnterior"><i class="fas fa-fw fa-lg fa-arrow-circle-left icono-azul"></i>Anterior</buttom>
                                    <button id="btnConfirmPrestamo" type="submit" class="btn btn-outline-secondary btn-primary icono-color-principal btn-inline"><i class="fa fa-fw fa-lg fa-check-circle icono-azul"></i><span id="btnText">Confirmar préstamo</span></button>
                                    <a id="btnConfirmDevolucion" onclick="btnConfirmDevolucion(this)" type="submit" class="btn btn-outline-secondary btn-primary icono-color-principal btn-inline"><i class="fa fa-fw fa-lg fa-check-circle icono-azul"></i><span id="btnText">Confirmar devolución</span></a>
                                    <buttom class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" onclick="pasarTab(1)"  id="btnSiguiente"><i class="fas fa-fw fa-lg fa-arrow-circle-right icono-azul"></i>Siguiente</buttom>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>   
            </form> 
        </div>
    </div>
</div>