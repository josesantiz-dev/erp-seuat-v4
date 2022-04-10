<?php
    headerAdmin($data);
    getModal("Turnos/modalNuevoTurno",$data);
    getModal("Turnos/modalEditTurno",$data);
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
                            <button type="button" id="btnNuevoTurno" onClick="fnNuevoTurno()" class="btn btn-inline btn-primary btn-sm btn-block" data-toggle="modal" data-target="#ModalNuevoTurno"><i class="fa fa-plus-circle fa-md"></i> Nuevo</button>
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
<!--                                 <h3 class="card-title">Listado de planteles</h3>
 -->                                <p class="card-text">
                                    <table id="tableTurnos" class="table table-bordered table-hover table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Turno</th>
                                                <th>Abreviatura</th>
                                                <th>Hora entrada</th>
                                                <th>Hora salida</th>
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