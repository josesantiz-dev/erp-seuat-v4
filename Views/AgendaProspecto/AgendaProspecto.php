<?php
  headerAdmin($data);
  getModal('AgendaProspecto/modalAgendaProspectoTablaSeguimiento',$data);
?>

<div class="contentAjax" id="vistaAgendaProspecto">

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

                    <table id="tableAgendaProspecto" class="table table-bordered table-striped table-hover table-sm">

                      <thead>

                        <tr>

                          <th width="1%">#</th>
                          <th width="7%">Fecha</th>
                          <th width="7%">Hora</th>
                          <th width="20%">Asunto</th>
                          <th width="7%">Estado</th>

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
