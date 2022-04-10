<?php
  headerAdmin($data);
  getModal('Servicios/modalNuevoServicio',$data);
  getModal('Servicios/modalEditServicio',$data);
  
?>

<div id="contentAjax"></div>

<div class="wrapper">


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
                <table id="tableServicios" class="table table-bordered table-striped table-hover table-sm">
                  <thead>
                  <tr>
                    <th width="7%">ID</th>
                    <th>Código</th>
                    <th>Servicio</th>
                    <th width="10%">P. unitario</th>
                    <th>Edo. cta</th>
                    <th width="7%">Estatus</th>
                    <th>Plantel</th>
                    <th>Municipio</th>
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
      </div>
    </div>
    <!-- /.content -->
  </div>

</div>


<?php footerAdmin($data); ?>