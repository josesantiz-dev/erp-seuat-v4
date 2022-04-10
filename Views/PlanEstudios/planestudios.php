<?php
    headerAdmin($data);
    getModal("PlanEstudio/modalNuevoPlanEstudios",$data);
    getModal("PlanEstudio/modalVerPlanEstudios",$data);
    getModal("PlanEstudio/modalEditPlanEstudios",$data);
?>
<div id="contentAjax"></div>
<div class="wrapper">
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-7">
                        <h1 class="m-0"> <?= $data['page_title'] ?></h1>
                    </div>
                    <div class="col-sm-5">
                        <ol class="breadcrumb float-sm-right btn-block">
                            <button type="button" class="btn btn-inline btn-primary btn-sm btn-block" onclick="btnPlanEstudioNuevo()" data-toggle="modal" data-target="#ModalFormNuevoPlanEstudios"><i class="fa fa-plus-circle fa-md"></i>Nuevo</button>
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
<!--                                 <h3 class="card-title">Listado de planes de Estudios</h3>
 -->                                <p class="card-text">
                                    <table id="tablePlanEstudios" class="table table-bordered table-striped table-hover table-sm">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Carrera</th>
                                                <th>Categoria</th>
                                                <th>Plantel</th>
                                                <th>RVOE</th>
                                                <th>Vigencia</th>
                                                <th>Estatus</th>
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