<div class="modal fade" id="modalformSubcampania" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">

  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">

    <div class="modal-content">
      <div class="modal-header">

        <h5 class="modal-title">Nueva Subcampaña</h5>
        <button type="button" class="close cerrarModal" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">
            &times;
          </span>

        </button>

      </div>

        <div class="modal-body">
          <small class="text-muted pb-4">
            Los campos con asterisco (<span class="required">*</span>) son obligatorios..
          </small>

          <div class="card card-dark">
            <form class="formSubcampania" id="formSubcampania" name="formSubcampania" autocomplete="off">
              <input type="hidden" id="idSubcampania" name="idSubcampania" value="">
              <input type="hidden" id="listaEstatus" name="listaEstatus" value="1">
              <input type="hidden" id="txtFechaCreacion" name="txtFechaCreacion" value="<?php echo date("Y-m-d");?>">
              <input type="hidden" id="txtFechaActualizacion" name="txtFechaActualizacion" value="0000-00-00">
              <input type="hidden" id="txtIdUsuarioCreacion" name="txtIdUsuarioCreacion" value="1">
              <input type="hidden" id="txtIdUsuarioActualizacion" name="txtIdUsuarioActualizacion" value="1">

              <div class="card-body">

                <!-- ESTO FALTA VER SI APLICA O USO OTRA FORMA -->

                <div class="form-group">
                  <label for="idCampania">Campaña (<span class="required">*</span>)</label>
                  <select class="form-control" name="selectIdCampania" id="selectIdCampania" onclick="sltSelectCampania()" required="" autofocus>
                    <option value="" id="idCampania" name="idCampania">Seleccione una Campaña</option>
                    <?php
                    foreach ($data['dataLastCampania'] as $value) {
                    ?>
                      <option value="<?php echo $value['id']; ?>" id="idCampania" name="idCampania"> <? echo $value["nombre_campania"] ?> </option>
                    <?php
                    }
                    ?>
                  </select>
                </div>


                <div class="form-group">
                  <label for="txtNombreSubcampania">Subcampaña <span class="required">*</span> </label>
                  <input type="text" id="txtNombreSubcampania" name="txtNombreSubcampania" class="form-control valid validText" placeholder="Ingrese una nueva Subcampaña" name="Ingresa el nombre de la Subcampaña" required="" autofocus><!-- disabled-->
                </div>

                <div class="form-group">
                  <label for="txtFechaInicio">Fecha de inicio (<span class="required">*</span>)</label>
                  <input type="date" id="txtFechaInicio" name="txtFechaInicio" class="form-control valid validText" placeholder="Inicio de la Subcampaña" name="Ingrese la fecha de Inicio" required="" autofocus><!-- disabled-->
                  <small id="fechaInicio"></small>
                </div>

                <div class="form-group">
                  <label for="txtFechaFin">Fecha Limite (<span class="required">*</span>)</label>
                  <input type="date" id="txtFechaFin" name="txtFechaFin" class="form-control valid validText" placeholder="Fin de la Subcampaña" name="Fecha limite" required="" autofocus><!-- disabled-->
                  <small id="fechaFin"></small>
                </div>

                <div class="form-group">
                  <label for="txtPresupuesto">presupuesto <span class="required">*</span> </label>
                  <input type="number" id="txtPresupuesto" name="txtPresupuesto" class="form-control valid validText" placeholder="Ingrese el presupuesto" name="Ingrese el presupuesto" onkeyup="showHint(this.value)" required="" autofocus><!-- disabled-->
                  <small id="smlPresupuesto"></small>
                </div>


              </div>

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
