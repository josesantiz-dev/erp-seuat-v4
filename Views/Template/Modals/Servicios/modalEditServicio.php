<div class="modal fade" id="modalFormEditServicios" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar servicio</h5>
                <button type="button" class="close cerrarModalEdit" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-dark">
                    <form id="formServicios_edit" name="formServicios" autocomplete="off">
                        <input type="hidden" id="idServicioEdit" name="idServicio" value="">
                        <div class="card-body">
						    <label class="border-bottom bg-gray bg-disabled pl-2 border-secondary btn-block rounded-top"> <strong>Datos servicio</strong></label>
							<div class="form-row">
								<div class="form-group col-sm-12 col-md-6">
									<label for="txtCodigo_servicio">Código </label>
									<input type="text" id="txtCodigo_servicio_edit" name="txtCodigo_servicio" class="form-control form-control-sm valid validText" placeholder="Ingrese el código para indentificar el servicio"  maxlength="10" required="" >
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-sm-12 col-md-10">
									<label for="txtNombre_servicio">Nombre servicio </label>
									<input type="text" id="txtNombre_servicio_edit" name="txtNombre_servicio" class="form-control form-control-sm valid validText" placeholder="Ingrese el nombre del nuevo servicio"  maxlength="100" required="" >
								</div>
								<div class="form-group col-sm-12 col-md-2">
									<label for="txtPrecio_unitario">Precio </label>
									<input type="text" id="txtPrecio_unitario_edit" name="txtPrecio_unitario" class="form-control form-control-sm valid validText" placeholder="Precio"  onkeypress="return validarNumeroInput(event)" required="" >
								</div>
							</div>
							<div class="form-row">
							    <div class="form-group col-md-5">
								    <label for="listIdCategoria_servicio">Categoría</label>
									<select class="form-control form-control-sm" id="listIdCategoria_servicio_edit" name="listIdCategoria_servicio" style="width: 100%;" required="" >
                                        <?php  foreach ($data['categoria'] as $key => $categoria) { ?>
                                            <option value="<?php echo $categoria['id'] ?>"><?php echo $categoria['nombre_categoria'] ?></option>
                                        <?php }
                                        ?>
                                    </select>
								</div>
								<div class="form-group col-md-5">
								    <label for="listIdUnidades_medida">Unidad de medida</label>
									<select class="form-control form-control-sm" id="listIdUnidades_medida_edit" name="listIdUnidades_medida" style="width: 100%;" required="" >
                                    <?php foreach ($data['unidad_medida'] as $key => $unidad) { ?>
                                        <option value="<?php echo $unidad['id'] ?>"><?php echo $unidad['nombre_unidad_medida'] ?></option>
                                    <?php }?>
                                    </select>
								</div>
								<div class="form-group col-md-2">
								    <label for="listAnioFiscal">Año fiscal</label>
									<select class="form-control form-control-sm" id="listAnioFiscal_edit" name="listAnioFiscal" style="width: 100%;" required="" >
									<option value='2022' selected> 2022</option></select>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-sm-12 col-md-12">
									<div class="custom-control custom-checkbox col-sm-12 col-md-12 toggle-flip">
									    <input class="custom-control-input custom-control-input-primary" type="checkbox" id="chkAplica_edo_cuenta_edit" name="chkAplica_edo_cuenta" >
									    <label for="chkAplica_edo_cuenta" class="custom-control-label text-lead">Aplicar en el estado de cuenta.</label>
									</div>
								</div>
							</div>
							<label class="border-bottom border btn-block"></label>
							<label class="border-bottom bg-gray bg-disabled pl-2 border-secondary btn-block rounded-top mt-3"> <strong>Ubicación</strong></label>
							<div class="form-row">
								<div class="form-group col-md-12">
								    <label for="listIdPlantel">Plantel</label>
									<select class="form-control form-control-sm" id="listIdPlantel_edit" name="listIdPlantel" style="width: 100%;" required="" >
                                        <?php foreach ($data['planteles'] as $key => $plantel) { ?>
                                            <option value="<?php echo $plantel['id'] ?>"><?php echo $plantel['nombre_plantel'].','.$plantel['municipio'].','.$plantel['estado'] ?></option>
                                        <?php }?>
                                    </select>
								</div>
							</div>
                            <div class="form-group col-4">
                                <label>Estatus</label>
                                <select class="form-control form-control-sm" id="list_estatus_servicios_edit" name="listEstatus" >
                                    <option value="1">Activo</option>
                                    <option value="2">Inactivo</option>
                                </select>
                            </div>
							<label class="border-bottom border btn-block"></label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-outline-secondary icono-color-principal btn-inline cerrarModal" href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>
                    <button id="btnActionForm" type="submit" class="btn btn-primary btn-inline" ><i class="fa fa-fw fa-lg fa-check-circle icono-azul"></i> Guardar</button>
                </div>  
            </form>
        </div>
    </div>
</div>

