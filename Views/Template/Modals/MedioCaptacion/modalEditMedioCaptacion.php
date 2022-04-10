<div class="modal fade" id="modalFromEditMedioCaptacion" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">

  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title">Editar Campaña</h5>
        <button type="button" class="close cerrarModal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>

      <div class="modal-body">

        <small class="text-muted">Los campos con asterisco (<span class="required">*</span>) son obligatorios.</small>

        <div class="card mt-1">

          <form id="fromNvoMedioCaptacion" name="fromNvoMedioCaptacion" autocomplete="off">

            <input type="hidden" id="idMedioCaptacion" name="idMedioCaptacion" value="">
            <input type="hidden" id="txtFechaActuzalizacion" name="txtFechaActuzalizacion" value="<?php echo date("Y-m-d\TH-i");?>" >

            <div class="card-body">

              <div class="form-group">
                <label for="txtMedioCaptacion">Medio Caotacion <span class="required">*</span> </label>
                <input type="text" id="txtMedioCaptacion" name="txtMedioCaptacion" class="form-control valid validText" placeholder="Ingrese el Medio de Captacion" name="Ingrese el Medio de Captacion" required="" autofocus>
              </div>

              <div class="form-group">

                <label>Estatus <span class="required">*</span></label>
                <select class="custom-select" id="listEstatusUp" name="listEstatusUp" required="">
                  <option value="1">Activo</option>
                  <option value="2">Inactivo</option>
                </select>

              </div>

            </div>

            <div class="modal-footer">
              <a class="btn btn-outline-secondary icono-color-principal btn-inline cerrarModal" href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>
              <button id="btnActionForm" type="submit" class="btn btn-primary btn-inline"><i class="fa fa-fw fa-lg fa-check-circle icono-azul"></i> Guardar</button>
            </div>

          </form>

        </div>

      </div>

    </div>

  </div>

</div>











<!--  -->
