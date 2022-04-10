<!-- Modal -->
<div class="modal fade" id="modalProspeccionIndividual" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-xs" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Seguimiento individual</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="formSeguimientoProspectoIndividual" name="formSeguimientoProspectoIndividual">

              <input type="hidden" id="idProsInd" name="idProsInd" value="">

              <div class="modal-body">
                  <div class="row ">
                      <label for="" class="text-lg text-center"><i class="fas fa-reply"></i> Respuestas rápidas</label>
                  </div>
                  <div class="row">
                      <ul class="list-inline">
                          <li class="list-inline-item"><span class="badge badge-danger">NO INTERESADO</span></li>
                          <li class="list-inline-item"><span class="badge badge-info">PROBLEMAS DE COMUNICACIÓN</span></li>
                          <li class="list-inline-item"><span class="badge badge-primary">INTERACCIÓN SIN DEFINIR</span></li>
                          <li class="list-inline-item"><span class="badge badge-success"> <i class="fa fa-check-circle-o"></i> INTERESADO</span></li>
                      </ul>
                  </div>
                  <div class="row">
                      <div class="col-md-6">
                          <div id="respuestasRapidas1" class="form-check">

                          </div>
                      </div>
                      <div class="col-md-6">
                          <div id="respuestasRapidas2" class="form-check">

                          </div>
                      </div>
                  </div>
                  <hr>
                  <div class="row">
                      <div class="form-group col-md-12">
                          <label>Comentarios:</label>
                          <textarea name="txtComentarioSegInd" id="txtComentarioSegInd" class="form-control form-control-sm" cols="20" rows="3" placeholder="Comentario"></textarea>
                      </div>
                  </div>
              </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancelarModalSegInd">Cancelar</button>
                <button type="submit" class="btn btn-primary">Confirmar seguimiento <i class="fa fa-check-circle"></i></button>
            </div>
            </form>
        </div>
    </div>
</div>
