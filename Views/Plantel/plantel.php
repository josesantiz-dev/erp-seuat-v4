<?php
    headerAdmin($data);
    getModal('Plantel/modalNuevoPlantel',$data);
    getModal('Plantel/modalVerPlantel',$data);
    getModal('Plantel/modalEditPlantel',$data);
?>
<div id="contentAjax"></div>
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
                            <button type="button"  class="btn btn-inline btn-primary btn-sm btn-block" data-toggle="modal"  onclick="btnNuevoPlantel()" data-target="#ModalFormNuevoPlantel"><i class="fa fa-plus-circle fa-md"></i> Nuevo</button>
                            <!--<li class="breadcrumb-item"><i class="fa fa-home fa-md"></i><a href="#">Home</a></li>
                            <li class="breadcrumb-item active"><a href="<?= base_url(); ?>/roles"><?= $data['page_title'] ?></a></li>-->
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
<!--                                 <h3 class="card-title">Listado de planteles</h3>
 -->                                <p class="card-text">
                                    <table id="tablePlantel" class="table table-bordered table-striped table-hover table-sm">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Plantel</th>
                                                <th>Estado</th>
                                                <th>Municipio</th>
                                                <th>Localidad</th>
                                                <th>Regimen</th>
                                                <th>Servicio</th>
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


