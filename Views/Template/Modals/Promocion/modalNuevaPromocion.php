<div class="modal fade" id="modalFormPromocion" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Nueva promoción</h5>
        <button type="button" class="close cerrarModal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card card-dark">
                <form id="formPromocion" name="formPromocion" autocomplete="off">
                    <input type="hidden" id="idPromocion" name="idPromocion" value="">
                    <input type="hidden" id="listEstatus" name="listEstatus" value="1">
                    <input type="hidden" id="txtFecha_creacion" name="txtFecha_creacion" value="2021-10-23 00:00:01">
                    <input type="hidden" id="txtFecha_actualizacion" name="txtFecha_actualizacion" value="0000-00-00 00:00:00">
                    <input type="hidden" id="txtId_usuario_creacion" name="txtId_usuario_creacion" value="1">
                    <input type="hidden" id="txtId_usuario_actualizacion" name="txtId_usuario_actualizacion" value="NULL">
                    <div class="card-body">
                      <div class="form-group">
                        <label for="txtNombre_promocion">Nombre promoción </label>
                        <input type="text" id="txtNombre_promocion" name="txtNombre_promocion" class="form-control form-control-sm valid validText" placeholder="Ingrese el nombre de una promoción"  maxlength="45" required="" >
                      </div>
                      <div class="form-group">
                        <label for="listServicios">Servicios</label>
                        <select class="form-control form-control-sm select2 select2-primary" data-dropdown-css-class="select2-primary" data-live-search="true" id="listServicios" name="listServicios" style="width: 100%;" required="" ></select>
                      </div>
                      <div class="form-group">
                        <label>Descripción</label>
                        <textarea class="form-control form-control-sm" id="txtDescripcion" name="txtDescripcion" rows="2" placeholder="Descripción de la promoción" required></textarea>
                      </div>

                      <div class="form-row">
                       
                        <div class="form-group col-md-5 border shadow-sm p-2 bg-white rounded text-center">
                            <label class="border-bottom btn-block">Vigencia</label>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="txtFecha_inicio">Inicio</label>
                                		<input type="date" class="form-control form-control-sm" id="txtFecha_inicio" name="txtFecha_inicio">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="txtFecha_fin">Finalización</label>
                                		<input type="date" class="form-control form-control-sm" id="txtFecha_fin" name="txtFecha_fin">
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-7 border shadow-sm p-2 bg-white rounded text-center">
                          <label class="border-bottom btn-block">Promoción</label>
                          <div class="form-row">
                            <div class="form-group col-md-6">
                              <label for="listCampania">Campañas</label>
                              <select class="form-control form-control-sm" id="listCampania" name="listCampania" onchange="fntSelectSubcampanias(value)" style="width: 100%;" required="" ></select>
                            </div>
                            <div class="form-group col-md-6">
                              <label for="listSubcampania">Subcampañas</label>
                              <select class="form-control form-control-sm" id="listSubcampania" name="listSubcampania" style="width: 100%;" required="" >
                                <option value="">- Seleccionar subcampaña -</option>
                              </select>  
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="form-row border shadow-sm p-3 mb-4 rounded" style="background-color:#ebebec">
                      <div class="form-group col-md-2">
                      </div>
                      <div class="form-group col-md-8 text-center">
                            <label for="inputCity"><b>% descuento autorizado</b></label>
                            <input type="number" id="txtPorcentaje_descuento" name="txtPorcentaje_descuento" min="1" max="100" step="1" class="form-control invalid text-center" style="height:50px; font-size: 24px" required="">
                      </div>
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

