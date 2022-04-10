<?php
headerAdmin($data);
getModal('Seguimiento/modalEditarDatos',$data);
getModal('Seguimiento/modalAgendarProspecto',$data);
getModal('Seguimiento/modalEgresado',$data);
getModal('Seguimiento/modalSeguimiento',$data);
getModal('Seguimiento/modalSeguimientoIndividual',$data);
getModal('Seguimiento/modalNvoProspecto',$data);
?>

<div class="contentAjax">

  <div class="wrapper">

    <!-- Content Wrapper. Contains page content -->
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
            <div class="col-sm-5">

              <ol class="breadcrumb float-sm-right btn-block">

                <button type="button" onClick="ftnNvoProspecto();" class="btn btn-inline btn-primary btn-sm btn-block" >
                  <i class="fa fa-plus-circle fa-md"></i> Nuevo Prospecto
                </button>

              </ol>

            </div>

          </div>
        </div>
      </div>

      <!-- Main content -->
      <div class="content">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">


              <div class="card">
                <div class="card-body">

                  <p class="card-text">

                  <table id="tableSeguimientoProspecto" class="table table-bordered table-striped table-hover table-sm">

                    <thead>

                      <tr>

                        <th width="3%">#</th>
                        <th width="18%">Nombre completo</th>
                        <th>Alias</th>
                        <th>Teléfono celular</th>
                        <th witdh="2%">Plantel de interés</th>
                        <th>Carrera de interés</th>
                        <th>Medio de captación</th>
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

      <!--       /.content-header       -->
    </div>
    <!--            /.content-wrapper          -->

  </div>

</div>
<?php footerAdmin($data); ?>
