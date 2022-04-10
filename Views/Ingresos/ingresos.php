<?php
    headerAdmin($data);
    getModal("Ingresos/modalBuscarPersona",$data);
    getModal("Ingresos/modalGenerarEdoCuenta",$data);
    getModal("Ingresos/modalCobrar",$data);
?>
<div id="contentAjax"></div>
<div class="wrapper">
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-7">
                        <h1 class="m-0"><?= $data['page_title'] ?></h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row col-12">
                                    <?php if($data['estatus_caja']['estatus_caja'] == 1){ ?>
                                        <div class="col-12 row">
                                            <div class="form-group col-md-4 col-sm-12">
                                                <input type="text" id="txtNombreNuevo" name="txtNombreNuevo" class="form-control" placeholder="Nombre de la persona a buscar"  name="" readonly required> 
                                            </div>
                                            <div class="form-group col-md-4 col-sm-12">
                                                <button type="button" class="btn btn-primary col-md-4 col-sm-12" data-toggle="modal" data-target="#modalNombrePersona"><i class="fa fa-search"></i> Buscar</button>
                                            </div>
                                        </div>
                                        <div class="col-12" id="alertAgregarAlumno">
                                            <div class="col-md-6 alert alert-warning alert-dismissible fade show m-auto" role="alert">
                                                <strong>Aviso!</strong> Para agregar servicios, primero agrega un alumno, click en <b>buscar</b>.
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="form-group col-12">
                                            <div class="col-md-3 p-0">
                                            <label>Que desea cobrar?</label>
                                            <select class="form-control" id="listTipoCobro"  name="listTipoCobro" onchange="fnTiposCobro(value)" style="width: 100%;" required >
                                                <option value="">Selecciona una</option>
                                                <option value="1">Colegiaturas mensuales</option>
                                                <option value="2">Otros servicios</option>
                                            </select></div>
                                        </div>
                                        <div class="form-group col-md-2 listGrado">
                                            <label>Grado</label>
                                            <select class="form-control" id="listGrado" onchange="fnChangeGrado(value)" required >
                                                <option value="">Selecciona un grado</option>
                                                <option value="1">1</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4 listServicios">
                                            <label>Servicios</label>
                                            <select class="form-control form-control-sm select2" id="listServicios"  name="listServicios" onchange="fnServicioSeleccionado(value)" style="width: 100%;" required >
                                                <option value="">Selecciona un servicio</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4 listPromociones">
                                            <label>Promociones</label>
                                            <div class="select2-blue">
                                                <select class="select2 form-control" multiple="multiple" id="listPromociones"  name="listPromociones" data-placeholder="Seleccciona una promocion" data-dropdown-css-class="select2-blue" style="width: 100%;" required>
            
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2" style="display:flex;align-items:end">
                                            <button type="button" id="btnAgregarServicio" class="btn btn-primary btn-block form-control" onclick="fnBtnAgregarServicioTabla()"><i class="fa fa-plus"></i>Agregar</button>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <hr>
                                        </div>
                                        <div class="form-group table-responsive"> 
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Nombre del servicio</th>
                                                        <th>Precio unitario</th>
                                                        <th>Cantidad</th>
                                                        <th>Descuento</th>
                                                        <th>Subtotal</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tableServicios">
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="form-group col-md-12 d-flex flex-row-reverse">
                                            <p><span>Subtotal: </span><b id="txtSubtotal">$0.00</b></p>
                                        </div>
                                        <div class="form-group col-md-12 d-flex flex-row-reverse">
                                            <p><span>Descuento: </span><b id="txtDescuento">0.00 %</b></p>
                                        </div>
                                        <div class="form-group col-md-12 d-flex flex-row-reverse">
                                            <h3><span>Total: </span><b id="txtTotal">$0.00</b></h3>
                                        </div>
                                        <div class="col-md-12 row" id="alertSinEdoCta">
                                            <div class="col-md-3"></div>
                                            <div class="col-md-6 alert alert-warning alert-dismissible fade show" role="alert">
                                                <strong>Aviso!</strong> El alumno seleccionado no tiene un estado de cuenta, para poder pagar servicios es necesario tener uno, click en el boton para generar!.
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button><br>
                                                <div class="col-md-12"><div class="form-group m-auto" style="display:flex;align-items:end">
                                                    <button type="button" class="btn btn-secondary btn-block form-control" onclick="fnGenerarEstadoCuenta()"><i class="fas fa-dollar-sign"></i></i> Generar estado de cuenta</button>
                                                </div></div>
                                            </div>
                                            <div class="col-md-3"></div>
                                        </div>
                                        <div class="form-group col-md-12 d-flex flex-row-reverse">
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-success btn-lg col-md-12" data-toggle="modal" data-target="#modalCobrar" onclick="fnButtonCobrar()"><i class="fas fa-dollar-sign mr-3"></i><b>COBRAR</b></button>
                                            </div>
                                        </div>
                                    <?php }else{ ?>
                                        <div class="col-12 d-flex mt-5 justify-content-center">
                                            <div class="card col-3 text-center">
                                                <div class="rounded-circle text-center" style="background-color:#d3e2f7;width:100px;height:100px;position:absolute;top:0;left:50%;transform:translate(-50%,-50%)">
                                                    <img src="<?php echo media() ?>/images/icons/close.png" width="80px"></img>
                                                </div><br><br>
						                        <div class="card-body">
                                                    <div class="text-center">
							                            <div class="col-12">
									                        <h5><b><?php echo($data['estatus_caja']['nombre'])?></b></h5>
							                            </div>
                                                        <span class="badge badge-warning"> Cerrada </span>
                                                        <div class="m-2 text-center">
                                                            <button type="button" class="btn btn-primary btn-sm btn-block" onclick="fnAperturarCaja(<?php echo($data['estatus_caja']['id_caja']) ?>)"><b>Clik aqui</b> para aperturar</button>
							                            </div>
                                                    </div>
						                        </div>
					                        </div>
                                        </div>
                                    <?php } ?>
                                </div>    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php footerAdmin($data); ?>