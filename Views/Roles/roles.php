<?php
  headerAdmin($data);
  getModal('Roles/modalNuevoRol',$data); 
  //getModal('Permisos/modalPermisos',$data);
  //getModal('modalFormPermisos',$data);
?>

<div id="contentAjax"></div>
<div class="wrapper">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-7">
            <h1 class="m-0">  <?= $data['page_title'] ?>
              
            </h1>
          </div>
          <div class="col-sm-5">
            <ol class="breadcrumb float-sm-right btn-block">
            <button type="button" onclick="openModal();" class="btn btn-inline btn-primary btn-sm btn-block"><i class="fa fa-plus-circle fa-md"></i> Nuevo</button>
            <!--<button type="button" onclick="openModal();" class="btn btn-inline btn-primary btn-sm btn-block" data-toggle="modal" data-target="#ModalFormRol"><i class="fa fa-plus-circle fa-md"></i> Nuevo</button>-->
              <!--<li class="breadcrumb-item"><i class="fa fa-home fa-md"></i><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><a href="<?= base_url(); ?>/roles"><?= $data['page_title'] ?></a></li>-->
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content-header -->


    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">


            <div class="card">
              <div class="card-body">
                <h3 class="card-title">Listado de roles</h3>
                <p class="card-text">
                <table id="tableRoles" class="table table-bordered table-striped table-hover table-sm">
                  <thead>
                  <tr>
                    <th width="7%">ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th width="8%">Estatus</th>
                    <th width="17%">Acciones</th>
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
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->

  <!--<aside class="control-sidebar control-sidebar-dark">
     Control sidebar content goes here -->
    <!--<div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>-->
  <!-- /.control-sidebar -->

</div>
<!-- ./wrapper -->

<?php footerAdmin($data); ?>