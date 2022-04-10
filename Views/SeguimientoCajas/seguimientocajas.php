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
                        <h1 class="m-0">
                            <?= $data['page_title']?>
                        </h1>
                    </div>
                    <div class="col-sm-5">
                        <ol class="breadcrumb float-sm-right btn-block">
                            <button type="button" onclick="openModal();"
                                class="btn btn-inline btn-primary btn-sm btn-block">
                                <i class="fa fa-plus-circle fa-md">Nuevo</i>
                            </button>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 row">
                        <div class="col-8">
                            <div class="card">
                                <div class="card-body">
                                    <canvas id="myChart" style="width:100%;max-width:100%"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 overflow-auto cards-planteles" style="height:435px;">        

                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header border-0">
                                    <h4 class="card-title">Cajeros</h4>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="transaction-table">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th scope="col"></th>
                                                        <th scope="col">Sistema</th>
                                                        <th scope="col">Plantel</th>
                                                        <th scope="col">Cajero</th>
                                                        <th scope="col">Caja</th>
                                                        <th scope="col">Ventas</th>
                                                        <th scope="col">Estatus</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($data['cajeros'] as $key => $cajero) {  
                                                        ?>
                                                        <tr>
                                                            <th scope="row"><i class="fas fa-arrow-alt-circle-down" style="color:red"></i></th>
                                                            <td><?php echo $cajero['nombre_sistema'] ?></td>
                                                            <td><?php echo $cajero['nombre_plantel'] ?></td>
                                                            <td><?php echo($cajero['nombre_persona'].' '.$cajero['ap_paterno'].' '.$cajero['ap_materno']) ?></td>
                                                            <td><?php echo $cajero['nombre_caja']?></td>
                                                            <td><?php echo '$ '. formatoMoneda($cajero['total_venta']) ?></td>
                                                            <?php 
                                                                if($cajero['estatus_caja'] == 1){ ?>
                                                                    <td><span class="badge badge-success">Abieto</span></td>
                                                                <?php } else{ ?>
                                                                    <td><span class="badge badge-danger">Cerrado</span></td>
                                                                <?php }
                                                            ?>
                                                        </tr>
                                                    <?php }?>                  
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php footerAdmin($data); ?>