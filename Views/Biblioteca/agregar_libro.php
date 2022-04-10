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
                      <h2>Agregar Libro</h2>
                    </div>
                    <div class="card-body">
                      <form>
                        <div class="mb-3">
                          <h4>Nombre del Libro</h4>
                          <div>
                            <input type="text" class="form-control" placeholder="Nombre del Libro">
                          </div>
                        </div>
                        <div class="mb-3">
                            <h4>Categoria</h4>
                            <div>
                                <input type="text" class="form-control" placeholder="Categoría">
                            </div>
                        </div>
                        <div class="mb-3">
                            <h4>Autor</h4>
                            <div>
                                <input type="text" class="form-control" placeholder="Autor">
                            </div>
                        </div>
                        <div class="mb-3">
                            <h4>Numero de ISBN</h4>
                            <div>
                                <input type="text" class="form-control" placeholder="Numero de ISBN">
                            </div>
                        </div>
                        <div class="mb-3">
                            <h4>DCC</h4>
                            <div>
                                <input type="text" class="form-control" placeholder="Clasificacion Decimal Dewey">
                            </div>
                        </div>
                        <div class="mb-3">
                            <h4>Cantidad</h4>
                            <div>
                                <input type="text" class="form-control" placeholder="Cantidad">
                            </div>
                        </div>
                        <div class="mb-3 row">
                          <div class="col-sm-12 ms-sm-auto">
                            <button type="submit" class="btn btn-primary float-right pl-4 pr-4">Crear</button>
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