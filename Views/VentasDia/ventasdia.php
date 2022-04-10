<?php
    headerAdmin($data);
    getModal('VentasDia/modalVentasDia',$data);
    getModal('VentasDia/modalDetallesVentaFolio',$data);
?>
<div class="wrapper">
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-7">
                        <h1 class="m-0">  <?= $data['page_title'] ?></h1>
                    </div>
                    <div class="col-sm-5">
                        <ol class="breadcrumb float-sm-right btn-block">
                            <a href="<?php BASE_URL ?>Ingresos" class="btn btn-inline btn-primary btn-sm btn-block"><i class="fa fa-plus-circle fa-md" href="www.google.com"></i> Nueva venta</a>
                        </ol>
                    </div>
                </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <!--Datos del Dia-->
                                    <div class="col-md-12">
                                        <div class="card p-2">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12 text-center">
                                                        <h3 class="fw-semi-bold"><span id="fechaHoraRealTime"></span></h3>
                                                        <h3 class="fw-semi-bold"><b><span id="totalSaldo">$0,000.00</span></b></h3>
                                                    </div>
                                                    
                                                </div>
                                                <div>
                                                    <div class="row">
                                                        <div class="col-md-6 form-group text-right">
                                                            <a type="button" class="form-control btn btn-primary col-4" href="<?php echo BASE_URL ?>/CorteCaja">Corte parcial de caja</a>
                                                        </div>
                                                        <div class="col-md-6 form-group text-left"><button class="form-control btn btn-secondary col-4" onclick="fnImprimirReporteVentaDia()">Imprimir reporte de ventas</button></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p class="card-text">
                                    <table id="tableVentasDia" class="table table-bordered table-striped table-hover table-sm">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Folio</th>
                                                <th>Estudiante</th>
                                                <th>Plantel</th>
                                                <th>Carrera</th>
                                                <th>Grado</th>
                                                <th>Fecha</th>
                                                <th>Factura</th>
                                                <th>Total</th>
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