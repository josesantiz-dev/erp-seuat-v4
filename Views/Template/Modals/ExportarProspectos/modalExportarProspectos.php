<div class="modal fade" id="modal_exportar_prospectos" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Exportar prospectos</h5>
        <button type="button" class="close cerrarModal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="card card-secondary">
              <form id="form_exportar_prospectos" name="form_exportar_prospectos" class="needs-validation">
                <div class="card-body">
                  <div class="form-group">
                    <label for="txtNombre_Grado">Plantel</label>
                    <select class="custom-select" required id="select_planteles">
                        <option value="">Seleccionar...</option>
                        <?php foreach (conexiones as $key => $conexion) { if($key != $data['conexion']){?>
                            <option value="<?php echo $key ?>"><?php echo $conexion['NAME'] ?></option>
                        <?php } } ?>
                    </select>
                  </div>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <a class="btn btn-outline-secondary icono-color-principal btn-inline cerrarModal" href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>
        <button id="btnActionForm" type="submit" class="btn btn-outline-secondary btn-primary icono-color-principal btn-inline"><i class="fa fa-fw fa-lg fa-check-circle icono-azul"></i><span id="btnText"> Aceptar</span></button>
      </div>   
      </form> 
    </div>
  </div>
</div>