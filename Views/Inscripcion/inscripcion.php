<?php
    headerAdmin($data);
    getModal("Inscripcion/modalNuevaInscripcion",$data);
    getModal("Inscripcion/modalDocumentacion",$data);
    getModal("Inscripcion/modalEditInscripcion",$data);
    getModal("Inscripcion/modalListaInscritos",$data);
;
?>
<div id="contentAjax"></div>
<div class="wrapper">
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-7">
                        <h1 class="m-0"><?= $data['page_title'] ?></h1>
                    </div>
                    <div class="col-sm-5">
                        <ol class="breadcrumb float-sm-right btn-block">
                            <?php 
                                if($data['rol'] == 'admin' || $data['rol'] == 'superadmin'){

                                }else{ ?>
                                    <button type="button" onclick="fnNuevaInscripcion()" class="btn btn-inline btn-primary btn-sm btn-block" data-toggle="modal" data-target="#ModalFormNuevaInscripcion"><i class="fa fa-plus-circle fa-md"></i>Nuevo</button>
                                <?php }
                            ?>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <?php if($data['rol'] == 'admin' || $data['rol'] == 'superadmin'){ ?>
                            <div class="card">
                                <div class="card-body">
                                    <div class="col-md-6">
                                        <select class="custom-select" id="listPlantelDatatable" onchange="fnPlantelSeleccionadoDatatable(value)">
                                            <option selected>Todos</option>
                                            <?php 
                                                foreach (conexiones as $key => $conexion) {
                                                    ?>
                                                        <option value="<?php echo $key ?>"><?php echo $conexion['NAME']?></option>
                                                    <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        <?php }else { ?>
                            <div class="card" style="display: none;">
                                <div class="card-body">
                                    <div class="col-md-6">
                                        <select class="custom-select" id="listPlantelDatatable" onchange="fnPlantelSeleccionadoDatatable(value)">
                                            <option value="<?php echo $data['nomConexion']?>" selected><?php echo conexiones[$data['nomConexion']]['NAME'] ?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="card-title" id="nombrePlantelDatatable"></h2>
                                <p class="card-text">
                                    <table id="tableInscripciones" class="table table-bordared table-hover table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nombre de la Carrera</th>
                                                <th>Nivel Educativo</th>
                                                <th>Grado</th> 
                                                <th>Plan</th>
                                                <th>Turno</th>
                                                <th>Grupo</th>
                                                <th>Total inscritos</th>
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
<?php
    footerAdmin($data);
?>