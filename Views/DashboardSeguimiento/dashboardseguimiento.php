<?php
headerAdmin($data);
getModal('Campanias/modalNuevoCampania', $data);
getModal('Campanias/modalEditCampanias', $data);
?>

<div id="contentAjax"></div>

<div class="wrapper">

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-7">
                        <h1 class="m-0">
                            <?= $data['page_title'] ?>
                        </h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            
            <div class="container-fluid">
                <div class="row">
                    <label>Seleccione un plantel</label>
                    <select class="custom-select" id="listPlataforma" onchange="plataformaSeleccionada(value)">
                        <option value="all" selected="">Todos</option>
                        <?php
                        foreach ($data['planteles'] as $key => $value) {
                        ?>
                            <option value="<?php echo $value['id'] ?>"><?= $value['nombre_plantel'] . " [" . $value['municipio'] . "]" ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title tit-plt"></h5>
                                    </div>
                                    <div class="col-auto">
                                        <div class="avatar">
                                            <div class="avatar-title rounded-circle bg-primary-light">
                                                <i data-feather="layout"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h2 class="mt-1 mb-3 plt">0</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Seguimiento</h5>
                                    </div>
                                    <div class="col-auto">
                                        <div class="avatar">
                                            <div class="avatar-title rounded-circle bg-primary-light">
                                                <i data-feather="phone"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <h1 class="mt-1 mb-3 prospect_segui">0</h1>
                                    <h1 class="mt-1 mb-3">&nbsp; de &nbsp;</h1>
                                    <h1 class="mt-1 mb-3 total_prospect"> 0 </h1>
                                </div>
                                <span class="text-muted">Prospectos con seguimiento</span>
                                <div class="mb-0">
                                    <span class="text-muted">Click aquí para </span>
                                    <a class="btn" href="<?php echo BASE_URL ?>/Seguimiento/seguimiento_prospectos" role="button"><span class="badge badge-primary"> <i class="mdi mdi-arrow-bottom-right"></i> aquí </span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Agenda</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="avatar">
                                            <div class="avatar-title rounded-circle bg-primary-light">
                                                <i data-feather="edit"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3 agn">0</h1>
                                <span class="text-muted">Llamadas sin atender</span>
                                <div class="mb-0">
                                    <span class="text-muted">Dando click</span>
                                    <a class="btn" href="<?php echo BASE_URL ?>/AgendaProspecto" role="button"><span class="badge badge-primary"> <i class="mdi mdi-arrow-bottom-right"></i> aquí </span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <?php footerAdmin($data); ?>