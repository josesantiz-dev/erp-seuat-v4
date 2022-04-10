<div class="modal fade" id="modal_form_promocion_edit" data-backdrop="static" data-keyboard="true" tabindex="-1"
    role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar promoción</h5>
                <button type="button" class="close cerrarModal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-dark">
                    <form id="form_promocion_edit" name="form_promocion_edit" autocomplete="off">
                        <input type="hidden" id="idPromocion_edit" name="idPromocion_edit" value="">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="txtNombre_promocion">Nombre promoción </label>
                                <input type="text" id="txtNombre_promocion_edit" name="txtNombre_promocion_edit"
                                    class="form-control form-control-sm valid validText"
                                    placeholder="Ingrese el nombre de una promoción" maxlength="45" required="">
                            </div>
                            <div class="form-group">
                                <label for="listServicios">Servicios</label>
                                <select class="form-control form-control-sm select2 select2-primary"
                                    data-dropdown-css-class="select2-primary" data-live-search="true"
                                    id="listServicios_edit" name="listServicios_edit" style="width: 100%;"
                                    required=""></select>

                            </div>
                            <div class="form-group">
                                <label>Descripción</label>
                                <textarea class="form-control form-control-sm" id="txtDescripcion_edit"
                                    name="txtDescripcion_edit" rows="2" placeholder="Descripción de la promoción"
                                    required></textarea>
                            </div>

                            <div class="form-row">

                                <div class="form-group col-md-5 border shadow-sm p-2 bg-white rounded text-center">
                                    <label class="border-bottom btn-block">Vigencia</label>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="txtFecha_inicio_edit">Inicio</label>
                                            <input type="date" class="form-control form-control-sm"
                                                id="txtFecha_inicio_edit" name="txtFecha_inicio_edit">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="txtFecha_fin_edit">Finalización</label>
                                            <input type="date" class="form-control form-control-sm"
                                                id="txtFecha_fin_edit" name="txtFecha_fin_edit">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-7 border shadow-sm p-2 bg-white rounded text-center">
                                    <label class="border-bottom btn-block">Promoción</label>
                                    <div class="form-row">

                                        <div class="form-group col-md-6">
                                            <label for="listCampania">Campañas</label>
                                            <select class="form-control form-control-sm" id="listCampania_edit"
                                                name="listCampania_edit" onchange="fntSelectSubcampaniasEdit(value)"
                                                style="width: 100%;" required="">
                                                <?php foreach ($data['campanias'] as $key => $campania) { ?>
                                                <option value="<?php echo $campania['id'] ?>">
                                                    <?php echo $campania['nombre_campania'] ?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="listSubcampania">Subcampañas</label>
                                            <select class="form-control form-control-sm" id="listSubcampania_edit"
                                                name="listSubcampania_edit" style="width: 100%;" required="">
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
                                    <input type="number" id="txtPorcentaje_descuento_edit"
                                        name="txtPorcentaje_descuento_edit" min="1" max="100" step="1"
                                        class="form-control invalid text-center" style="height:50px; font-size: 24px"
                                        required="">
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Estatus</label>
                                <select class="form-control form-control-sm" id="listEstatusEdit" name="listEstatusEdit"  required>
                                    <option value="1">Activo</option>
                                    <option value="2">Inactivo</option>
                                </select>
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-outline-secondary icono-color-principal btn-inline cerrarModal" href="#"
                    data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>
                <button id="btnActionForm" type="submit" class="btn btn-primary btn-inline"><i
                        class="fa fa-fw fa-lg fa-check-circle icono-azul"></i> Actualizar</button>
            </div>
            </form>
        </div>
    </div>
</div>