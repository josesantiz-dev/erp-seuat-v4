<?php
    headerAdmin($data);
    getModal("Alumnos/modalDocumentacion",$data);
    getModal("Alumnos/modalDatosPersonalesVerificar",$data);
    getModal("Alumnos/modalDocumentacionVerificado",$data);
    getModal("Alumnos/modalEditTutor",$data);
    getModal("Alumnos/modalDatosFiscales",$data);
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
<!--                             <button type="button" class="btn btn-inline btn-primary btn-sm btn-block" data-toggle="modal" data-target="#ModalFormNuevaMateria"><i class="fa fa-plus-circle fa-md"></i>Nuevo</button>
 -->                        </ol>
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
<!--                                 <h3 class="card-title">Listado de Estudiantes</h3>
 -->                                <p class="card-text">
                                    <table id="tableEstudiantes" class="table table-bordared table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nombre</th>
                                                <th>Apellidos</th>
                                                <th>Plantel</th>
                                                <th>Carrera</th>
                                                <th>Grado</th>
                                                <th>Salón</th>
                                                <th>Documentación</th>
                                                <th>Datos</th>
                                                <!-- <?php if($data['page_name'] == 'estudiantes'){?><th>Documentacion</th><?php }?>
                                                <?php if($data['page_name'] == 'estudiantes'){?><th>Datos</th><?php }?>
                                                <?php if($data['page_name'] == 'verificados'){?><th>Estatus</th><?php }?> -->
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