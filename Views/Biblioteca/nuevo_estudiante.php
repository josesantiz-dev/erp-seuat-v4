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
                <div class="col-12 col-xl-6">
                  <div class="card">
                    <div class="card-header">
                      <h2>Nuevo Estudiante</h2>
                    </div>
                    <div class="card-body">
                      <form>
                        <div class="mb-3">
                          <h4>Nombre</h4>
                          <div>
                            <input type="text" class="form-control" placeholder="Nombre">
                          </div>
                        </div>
                        <div class="mb-3">
                          <h4>Apellidos</h4>
                          <div>
                            <input type="text" class="form-control" placeholder="Apellidos">
                          </div>
                        </div>
                        <div class="mb-3">
                          <h4>Matricula</h4>
                          <div>
                            <input type="text" class="form-control" placeholder="Matrícula">
                          </div>
                        </div>
                        <div class="mb-3">
                          <h4>Correo</h4>
                          <div>
                            <input type="email" class="form-control" placeholder="Correo">
                          </div>
                        </div>
                        <div class="mb-3">
                          <h4>Teléfono</h4>
                          <div>
                            <input type="text" class="form-control" placeholder="Teléfono">
                          </div>
                        </div>
                        <div class="mb-3 row"></div>
                        <div class="mb-3 row">
                          <div class="col-sm-12 ms-sm-auto">
                            <button type="submit" class="btn btn-primary float-right pl-4 pr-4">Agregar</button>
                          </div>
                        </div>
                      </form>
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