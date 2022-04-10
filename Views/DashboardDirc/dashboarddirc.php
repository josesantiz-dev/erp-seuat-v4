<?php
  headerAdmin($data);
  getModal("DashboardDirc/modalRvoesExp",$data);

?>

<div class="wrapper">
  <!-- Navbar -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?php echo $data['page_tag']?></h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            <!-- CARDS DE TOTALES-->
            <div class="row">
                <div class="col-12 mb-3">
                    <div class="col-lg-6 col-md-6">
                        <label>Selecciona una plantel</label>
                        <select class="custom-select" id="listPlataformas" onchange="plataformaSeleccionada(value)">
                            <option value="all" selected="">Todos</option>
                        <?php 
                        foreach ($data['planteles'] as $key => $value) {
                            ?>
                                <option value="<?php echo $value['id'] ?>"><?php echo($value['nombre_plantel'].'('.$value['municipio'].')')?></option>
                            <?php
                        }
                        ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3 col-6 divnomplant">
                    <div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col mt-0">
								</div>
                                <div class="col-auto">
                                    <div class="avatar">
                                        
                                    </div>
                                </div>
							</div>
							<h5 class="mt-1 mb-3 plntuno"></h5>
                            <div class="mb-0">
                                <span class="text-muted">Click aquí para </span>
								<a class="btn"  href="<?php echo BASE_URL?>/Plantel" role="button"><span class="badge badge-primary"> <i class="mdi mdi-arrow-bottom-right"></i> ver más </span></a>
							</div>
						</div>
					</div>
                </div>
                <div class="col-lg-3 col-6 divplant">
                    <div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col mt-0">
									<h5 class="card-title">Planteles</h5>
								</div>
                                <div class="col-auto">
                                    <div class="avatar">
                                        <div class="avatar-title rounded-circle bg-primary-light">
                                            <i data-feather="layout"></i>
                                        </div>
                                    </div>
                                </div>
							</div>
							<h1 class="mt-1 mb-3 plnt">0</h1>
                            <div class="mb-0">
                                <span class="text-muted">Click aquí para </span>
								<a class="btn"  href="<?php echo BASE_URL?>/Plantel" role="button"><span class="badge badge-primary"> <i class="mdi mdi-arrow-bottom-right"></i> ver más </span></a>
							</div>
						</div>
					</div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col mt-0">
									<h5 class="card-title">Planes de estudios</h5>
								</div>
                                <div class="col-auto">
                                    <div class="avatar">
                                        <div class="avatar-title rounded-circle bg-primary-light">
                                            <i data-feather="server"></i>
                                        </div>
                                    </div>
                                </div>
							</div>
							<h1 class="mt-1 mb-3 ple">0</h1>
                            <div class="mb-0">
                                <span class="text-muted">Click aquí para </span>
								<a class="btn" href="<?php echo BASE_URL?>/PlanEstudios" role="button"><span class="badge badge-primary"> <i class="mdi mdi-arrow-bottom-right"></i> ver más </span></a>
							</div>
						</div>
					</div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <div class="card">
						<div class="card-body">
						    <div class="row">
								<div class="col mt-0">
								    <h5 class="card-title">Materias</h5>
								</div>
                                <div class="col-auto">
                                    <div class="avatar">
                                        <div class="avatar-title rounded-circle bg-primary-light">
                                            <i data-feather="layers"></i>
                                        </div>
                                    </div>
                                </div>
							</div>
							<h1 class="mt-1 mb-3 mat">0</h1>
                            <div class="mb-0">
                                <span class="text-muted">Click aquí para </span>
								<a class="btn"  href="<?php echo BASE_URL?>/Materias" role="button"><span class="badge badge-primary"> <i class="mdi mdi-arrow-bottom-right"></i> ver más </span></a>
							</div>
						</div>
					</div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <div class="card">
						<div class="card-body">
						    <div class="row">
								<div class="col mt-0">
								    <h5 class="card-title">RVOES Próximos a expirar</h5>
								</div>
                                <div class="col-auto">
                                    <div class="avatar">
                                        <div class="avatar-title rounded-circle bg-warning">
                                            <i data-feather="alert-triangle"></i>
                                        </div>
                                    </div>
                                </div>
							</div>
							<h1 class="mt-1 mb-3 rvoeexp">0</h1>
                            <div class="mb-0">
                                <span class="text-muted">Click aquí para </span>
								<a class="btn" role="button" data-toggle="modal" data-target="#ModalFormRvoeExp" id="btnRvoesExp"><span class="badge badge-warning"> <i class="mdi mdi-arrow-bottom-right"></i> ver más </span></a>
							</div>
						</div>
					</div>
                </div>
                <!-- ./col -->
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Planes de estudios & Materias - Plantel</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex"><br><br>
                        </div>
                        <div class="position-relative mb-4">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <canvas id="sales-chart" height="200" style="display: block; width: 605px; height: 200px;" width="605" class="chartjs-render-monitor"></canvas>
                            <canvas id="sales-chart-plantel" height="200" style="display: block; width: 605px; height: 200px;" width="605" class="chartjs-render-monitor"></canvas>
                        </div>
                        <div class="d-flex flex-row justify-content-end">
                            <span class="mr-2">
                                <i class="fas fa-square text-primary"></i> Planes de estudios
                            </span>
                            <span>
                                <i class="fas fa-square text-gray"></i> Materias
                            </span>
                        </div>
                    </div>        
                </div>
            </div>
        <!-- /.row -->
        </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php footerAdmin($data); ?>