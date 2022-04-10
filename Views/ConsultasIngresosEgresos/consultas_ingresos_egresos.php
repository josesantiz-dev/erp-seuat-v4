<?php
    headerAdmin($data);
    getModal('ConsultasIngresosEgresos/modalBuscarAlumno',$data);
    //getModal('CategoriaCarrera/modalVerCategoriaCarrera',$data);
    //getModal('CategoriaCarrera/modalEditCategoriaCarrera',$data);
?>
<div id="contentAjax"></div>
<div class="wrapper">
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-md-6 col-lg-6">
                        <h1 class="m-0">  <?= $data['page_title'] ?></h1><br>
                    </div>
                    <div class="col-md-6  col-lg-6 row">
                        <div class="form-group col-md-6 col-lg-7">
                            <input type="text" style="background-color:#FFF !important" id="txtNombrealumno" class="form-control" placeholder="Matricula o RFC">
                        </div>
                        <div class="form-group col-md-3 col-lg-2">
                            <button type="button" id="btnBuscar" class="form-control btn btn-primary">Buscar</button>
                        </div>
                        <div class="form-group col-md-3 col-lg-3">
                            <button type="button" id="btnBuscarAlumno"class="form-control btn btn-primary" data-toggle="modal" data-target="#ModalBuscarAlumno">Buscar por Nombre</button>
                        </div>
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
                                <div class="col-12 row">
                                    <div class="col-md-6 col-sm-12">
                                    </div>
                                    <div class="col-12 card_dato_cta">
                                        <div class="row mb-5">
                                            <!--Datos del Alumno-->
                                            <div class="col-md-5">
                                                <div class="card p-2">
                                                    <div class="card-body">
                                                        <div class="border-bottom border-gray-light pb-3 mb-3 row">
                                                            <div class="col-md-3 text-center">
                                                                <img src="<?php echo media()?>/images/img/user.jpg" width="60" height="60" loading="lazy" alt="…" class="rounded-circle me-3">
                                                            </div>
                                                            <div class="col-md-9 text-center">
                                                                <h1 id="nomAlumEdoCta"></h1>
                                                                <div class="row">
                                                                    <a href="" class="col-md-6 mb-1 fs-6 text-gray">
                                                                        <i class="fas fa-phone-alt me-2 text-primary fa-xs"></i><span id="telCelAlumno"></span>
                                                                    </a><br>
                                                                    <a href="mailto:hello@example.com" class="col-md-6 mb-1 fs-6 text-gray">
                                                                        <i class="fa fa-envelope me-2 text-primary"></i><span id="emailAlumno"></span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <ul>
                                                            <li class="mb-1">
                                                                <h3 class="h6 me-4 d-inline-block"><b>Dirección: </b></h3>
                                                                <span id="domicilioAlumno" class="text-muted"></span>
                                                            </li>
                                                            <li class="mb-1">
                                                                <h3 class="h6 fw-semi-bold me-4 d-inline-block"><b>Carrera: </b></h3>
                                                                <span id="carreraAlumno" class="text-gray"></span>
                                                            </li>
                                                            <li class="mb-1">
                                                                <h3 class="h6 fw-semi-bold me-4 d-inline-block"><b>Grado y Grupo: </b></h3>
                                                                <span id="nombreSalon"></span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--Cuenta-->
                                            <div class="col-md-4">
                                                <div class="card p-2">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-12 text-center">
                                                                <p class="text-gray mb-3">Saldo total</p>
                                                                <h3 class="fw-semi-bold"><b><span id="totalSaldo"></span></b></h3>
                                                            </div>
                                                            <div class="col-md-12 row">
                                                                <div class="col-md-6">
                                                                    <p class="text-gray mb-1">Saldo en colegiaturas</p>
                                                                    <h5 class="fw-semi-bold"><span id="saldoColegiaturas"></span></h5>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <p class="text-gray mb-1">Saldo en Servicios</p>
                                                                    <h5 class="fw-semi-bold"><span id="saldoServicios"></span></h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="mb-4 row">
                                                                <div class="col-md-6 form-group"><button id="btnVerEdoCta" class="form-control btn btn-primary">Ver estado de cuenta</button></div>
                                                                <div class="col-md-6 form-group"><button class="form-control btn btn-secondary" id="btnImprimirEdoCta">Imprimir</button></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-6 col-sm-12">
                                        <div class="d-flex justify-content-end">
                                            <div class="col-6"><input type="text" id="txtNombrealumno" class="form-control" placeholder="Matricula o RFC"></div>
                                            <div class="col-2"><button type="button" id="btnBuscar" class="btn btn-primary">Buscar</button></div>
                                            <div class="col-1"><p>o</p></div>
                                            <div class="col-4"><button type="button" id="btnBuscarAlumno"class="btn btn-primary" data-toggle="modal" data-target="#ModalBuscarAlumno">Buscar por Nombre</button></div>
                                        </div> 
                                    </div>
                                    <div class="col-12 row">
                                        <div class="col-4 text-center"><h1 id="nomAlumEdoCta"></h1></div>
                                        <div class="col-4 text-center"><h1 id="totalSaldo"></h1></div>
                                        <div class="col-4 mt-2" style="text-align:right"><button type="button" id="btnImprimirEdoCta" class="btn btn-secondary">Imprimir</button></div>
                                    </div> -->
                                </div>                             
                                <p class="card-text">
                                    <table id="tableEstadoCuenta" class="table table-bordered table-striped table-hover table-sm">
                                        <thead>
                                            <tr>
                                                <th width="5%">#</th>
                                                <th>Fecha</th>
                                                <th>Concepto</th>
                                                <th>Subconcepto</th>
                                                <th>Descripcion</th>
                                                <th>Cargo</th>
                                                <th>Abono</th>
                                                <th>Saldo</th>
                                                <th>Fecha pago</th>
                                                <th>Referencia</th>
                                                <th>Tipo comprobante</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </p>
                            </div>
                        </div>
                    </div>        
                </div>
            </div>
        </div>
    </div>
</div>
<?php footerAdmin($data); ?>


