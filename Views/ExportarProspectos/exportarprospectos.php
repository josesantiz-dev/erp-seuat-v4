<?php
    headerAdmin($data);
    getModal("ExportarProspectos/modalExportarProspectos",$data);
    /*getModal("Persona/modalEditPersona",$data);
    getModal("Persona/modalVerPersona",$data); */
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
                            <button type="button" class="btn btn-inline btn-primary btn-block" onclick="fnExportarProspectos()"><i class="fas fa-file-download"></i>&nbsp&nbspExportar</button>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="alert alert-warning alert-dismissible fade show alert_select_prospectos" role="alert">
                <strong>Atención!</strong>&nbspselecciona a las personas a exportar.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-text">
                                    <table id="table_exportar_prospectos" class="table table-bordered table-striped table-hover table-sm">
                                        <thead>
                                            <tr>
                                                <td></td>
                                                <th>#</th>
                                                <th>Alias</th>
                                                <th>Nombre</th>
                                                <th>Apellidos</th>
                                                <th>Email</th>
                                                <th>Telefono</th>
                                                <th>Direccion</th>
                                                <th>Perfil</th>
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