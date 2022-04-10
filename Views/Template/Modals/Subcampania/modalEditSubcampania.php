<div class="modal fade" id="modalformSubcampaniaEdit" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">

    <div class="modal-content">
      <div class="modal-header">

        <h5 class="modal-title">Editar Subcampaña</h5>
        <button type="button" class="close cerrarModal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">
            &times;
          </span>
        </button>

      </div>



        <div class="modal-body">

          <small class="text-muted">
            Los campos con asterisco (<span class="required">*</span>) son obligatorios.
          </small>

          <div class="card mt-1">
            <form id="formSubcampaniaUp" name="formSubcampaniaUp" autocomplete="off">
              <input type="hidden" id="idSubcampaniaUp" name="idSubcampaniaUp">
              <input type="hidden" id="txtFechaActualizacionUp" name="txtFechaActualizacionUp" value="">
              <input type="hidden" id="txtIdUsuarioActualizacionUp" name="txtIdUsuarioActualizacionUp">
              <input type="hidden" id="IdCampania" name="IdCampania">

              <div class="card-body">

                <div class="form-group">

                  <label for="txtNombreSubcampania">Subcampaña <span class="required">*</span></label>
                  <input type="text" id="txtNombreSubcampaniaUp" name="txtNombreSubcampaniaUp" class="form-control valid validText" placeholder="Ingrse una nueva Subcampaña" name="Ingrese el nombre de la Subcampaña" required="">

                </div>

                <div class="form-group">
                  <label for="txtFechaInicio">Fecha de inicio (<span class="required">*</span>)</label>
                  <input type="date" id="txtFechaInicioUp" name="txtFechaInicioUp" class="form-control valid validText" placeholder="Inicio de la Subcampaña" name="Ingrese la fecha de Inicio" value="<?php echo date("Y-m-d"); ?>" required="" autofocus>
                </div>

                <div class="form-group">
                  <label for="txtFechaFin">Fecha Limite (<span class="required">*</span>)</label>
                  <input type="date" id="txtFechaFinUp" name="txtFechaFinUp" class="form-control valid validText" placeholder="Fin de la Subcampaña" name="Fecha limite" required="" autofocus>
                </div>

                <div class="form-group">
                  <label for="txtPresupuesto">presupuesto <span class="required">*</span> </label>
                  <input type="number" id="txtPresupuestoUp" name="txtPresupuestoUp" class="form-control valid validText" placeholder="Ingrese el presupuesto" name="Ingrese el presupuesto" onkeyup="editSubcampaniaAjax(this.value)" required="">
                  <small id="smlPresupuestoUp"></small>
                </div>

                <div class="form-group">

                  <label>Estatus <span class="required">*</span></label>
                  <select class="custom-select" id="listaEstatusUp" name="listaEstatusUp" required="">
                    <option value="1">Activo</option>
                    <option value="2">Inactivo</option>
                  </select>

                </div>

              </div>



          </div>

        </div>

        <div class="modal-footer">
          <a class="btn btn-outline-secondary icono-color-principal btn-inline cerrarModal" href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>
          <button id="btnActionForm" type="submit" class="btn btn-primary btn-inline"><i class="fa fa-fw fa-lg fa-check-circle icono-azul"></i> Actualizar</button>
        </div>

      </form>

    </div>

  </div>
</div>
