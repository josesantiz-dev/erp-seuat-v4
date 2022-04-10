<?php
    headerAdmin($data);

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
                               <p class="card-text">
                                    <table id="tableHistorialCorteCajas" class="table table-bordared table-striped table-sm" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Folio</th>
                                                <th>Plantel</th>
                                                <th>Nombre</th>
                                                <th>Fecha Apertura</th>
                                                <th>Fecha Cierre</th>
                                                <th>Usuario entrega</th>
                                                <th>Usuario recibe</th>
                                                <th>Faltante</th>
                                                <th>Sobrante</th>
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