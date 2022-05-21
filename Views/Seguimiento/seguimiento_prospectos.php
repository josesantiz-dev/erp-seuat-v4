<?php
    headerAdmin($data);
    getModal("Seguimiento/modalNvoProspecto",$data);
    getModal("Seguimiento/modalAgendarProspecto",$data);
    getModal("Seguimiento/modalEditarDatos",$data);
    getModal("Seguimiento/modalSeguimiento",$data);
    getModal("Seguimiento/modalSeguimientoIndividual",$data);
    getModal("Seguimiento/modalLoginConexion",$data);
?>

<div class="wrapper">
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-7">
                        <h1 class="m-0"><?= $data['page_title']?></h1>
                    </div>
                    <div class="col-sm-5">
                        <ol class="breadcrumb float-sm-right btn-block">
                            <button type="button" id="btnNuevoProspecto" onClick="fnNuevoProspecto()" class="btn btn-inline btn-primary btn-sm btn-block" data-toggle="modal" data-target="#ModalNuevoProspecto"><i class="fa fa-plus-circle fa-md"></i> Nuevo Prospecto</button>
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
                                    <p class="card-text">
                                        <table id="tableSeguimientoProspecto" class="table table-bordered table-striped table-hover table-sm">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nombre completo</th>
                                                    <th>Alias</th>
                                                    <th>Teléfono celular</th>
                                                    <th>Nombre plantel</th>
                                                    <th>Nombre de carrera</th>
                                                    <th>Medio de captación</th>
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
</div>

<?php
footerAdmin($data);
?>