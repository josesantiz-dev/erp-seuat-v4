<?php
    headerAdmin($data);
    getModal("HistorialPagosAlumno/modalHistorialPagosAlumno",$data);
?>
<div id="contentAjax"></div>
<div class="wrapper">
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-7">
                        <h1 class="m-0"> <?= $data['page_title'] ?></h1>
                        <h1 class="nombre_pagina" hidden><?= $data['page_name'] ?></h1>
                    </div>
                    <div class="col-sm-5">
                        <ol class="breadcrumb float-sm-right btn-block">
                       </ol>
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
                                <div class="container-fluid p-0">
                                    <div class="mb-3">
                                        <h1 class="h3 d-inline align-middle">Alumnos</h1>
                                    </div>
                                    <div class="row">
                                            <div class="card col-xl-8">
                                                <div class="card-header pb-0">
                                                    <h5 class="card-title mb-0">Alumnos</h5>
                                                </div>
                                                <div class="card-body">
                                                    <table id="tableAlumnos" class="table table-bordared table-hover table-striped table-sm">
                                                        <thead>
                                                            <tr>
                                                                <th width="5%">#</th>
                                                                <th>Nombre</th>
                                                                <th>Apellidos</th>
                                                                <th>Plantel</th>
                                                                <th>Carrera</th>
                                                                <th width="10%">Grado y Grupo</th>
                                                                <th width="5%">Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                  
                                            <div class="card col-xl-4 card-info-alumno" style="display:none">
                                                <div class="card-header">
                                                    <h5 class="card-title mb-0 name"></h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row g-0">
                                                        <div class="col-sm-3 col-xl-12 col-xxl-3 text-center">
                                                            <img src="<?php echo media() ?>/images/img/user.jpg" width="64" height="64" class="rounded-circle mt-2 img_user" alt="Angelica Ramos">
                                                        </div>
                                                        <div class="col-sm-9 col-xl-12 col-xxl-9">
                                                            <strong></strong>
                                                            <p></p>
                                                        </div>
                                                    </div>
                                                    <table class="table table-sm mt-2 mb-4">
                                                        <tbody>
                                                            <tr>
                                                                <th>Teléfono</th>
                                                                <td class="tel"></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Email</th>
                                                                <td class="email"></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Dirección</th>
                                                                <td class="direccion"></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Estatus</th>
                                                                <td class="estatus"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <strong>Ultimos 5 movimientos</strong>
                                                    <ul class="timeline mt-2 mb-0 ultimos_movimientos">
                                                        
                                                    </ul>
                                                    <a href="" id="ver_mas_detalles_alumno" data-toggle="modal" data-target="#modalHistorialPagosAlumno"><p><i style="color:blue">Ver <b>más</b></i></p></a>
                                                </div>
                                            </div>
                                    </div>
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