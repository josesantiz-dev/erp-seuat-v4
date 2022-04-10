<?php
    headerAdmin($data);
    getModal("Persona/modalNuevaPersona",$data);
    getModal("Persona/modalEditPersona",$data);
    getModal("Persona/modalVerPersona",$data);
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
                            <button type="button" class="btn btn-inline btn-primary btn-sm btn-block" data-toggle="modal" data-target="#ModalFormNuevaPersona"><i class="fa fa-plus-circle fa-md"></i>Nuevo</button>
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
<!--                                 <h3 class="card-title">Listado de Personas</h3>
 -->                                <p class="card-text">
                                    <table id="tablePersonas" class="table table-bordered table-striped table-hover table-sm">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Alias</th>
                                                <th>Nombre</th>
                                                <th>Apellidos</th>
                                                <th>Email</th>
                                                <th>Telefono</th>
                                                <th>Direccion</th>
                                                <th>Perfil</th>
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