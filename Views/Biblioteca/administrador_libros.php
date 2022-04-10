<?php
  headerAdmin($data);
?>
<div id="contentAjax">
</div>
<div class="wrapper">
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">  <?= $data['page_title'] ?>
              <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle fa-md"></i> Nuevo</button>
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><i class="fa fa-home fa-md"></i><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><a href="<?= base_url(); ?>/roles"><?= $data['page_title'] ?></a></li>
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
                <div class="col-12 col-xl-12">
                  <div class="card">
                    <div class="card-body">
                      <h3 class="card-title">Lista de Libros</h3>
                      <p class="card-text">
                      <table id="tableRoles" class="table table-bordered table-striped table-sm">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Nombre del Libro</th>
                            <th>Categoría</th>
                            <th>Autor</th>
                            <th>ISBN</th>
                            <th>Cantidad</th>
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
    </div>
  </div>
</div>
<?php footerAdmin($data); ?>