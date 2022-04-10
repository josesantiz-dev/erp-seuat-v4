<?php
  headerAdmin($data);
  getModal('Promocion/modalNuevaPromocion',$data);
  getModal('Promocion/modalEditPromocion',$data);
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
            <button type="button" onclick="openModal();" class="btn btn-inline btn-primary btn-sm btn-block" ><i class="fa fa-plus-circle fa-md"></i> Nuevo</button>
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
                <p class="card-text">
                <table id="tablePromocion" class="table table-bordered table-striped table-hover table-sm">
                  <thead>
                  <tr>
                    <th width="7%">ID</th>
                    <th>Promoción</th>
                    <th>Servicio aplicado</th>
                    <th width="10%">% descuento</th>
                    <th width="7%">Estatus</th>
                    <th width="12%">Acciones</th>
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

 
</div>
<!-- ./wrapper -->

<?php footerAdmin($data); ?>
