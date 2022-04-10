<div class="modal fade modalFormPermisos" id="modalFormPermisos" data-backdrop="static" data-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered  modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Permisos Roles de Usuario</h5>
          <button type="button" class="close cerrarModal" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
        <form action="" id="formPermisos" name="formPermisos">
          <input type="hidden" id="idrol" name="idrol" value="<?= $data['idrol']; ?>" required="">
          <div class="modal-body">
          <?php 
            //dep($data); 
          ?>
          
          <div class="col-12 mb-1">
            <div class="form-check form-check-inline">
            <input type="checkbox" class="form-check-input" name="my-checkbox" id="my-checkbox" data-bootstrap-switch data-off-color="danger" data-on-color="success" onclick="ActivarCheckbox(this);" > 
              <label class="form-check-label text-secodnary" for="my-checkbox">
                Seleccionar todos
              </label>
            </div>
          </div>

            <div class="col-12">
                <div class="card">
                  <!-- /.card-header -->
                  <div class="card-body table-responsive p-0" style="height: 300px;">
                    <table class="table table-striped table-sm table-head-fixed text-nowrap ">
                      <thead> 
                        <tr>
                          <th>#</th>
                          <th>Módulo</th>
                          <th width="8%" class="text-center">Ver</th>
                          <th width="8%" class="text-center">Crear</th>
                          <th width="8%" class="text-center">Actualizar</th>
                          <th width="8%" class="text-center">Eliminar</th>
                        </tr>
                      </thead>
                      <tbody>
                            <?php 
                                $no=1;
                                $modulos = $data['modulos'];
                                for ($i=0; $i < count($modulos); $i++) { 

                                    $permisos = $modulos[$i]['permisos'];
                                    $rCheck = $permisos['r'] == 1 ? " checked " : "";
                                    $wCheck = $permisos['w'] == 1 ? " checked " : "";
                                    $uCheck = $permisos['u'] == 1 ? " checked " : "";
                                    $dCheck = $permisos['d'] == 1 ? " checked " : "";

                                    $idmod = $modulos[$i]['id'];
                            ?>
                          <tr>
                            <td>
                                <?= $no; ?>
                                <input type="hidden" name="modulos[<?= $i; ?>][id]" value="<?= $idmod ?>" required >
                            </td>
                            <td>
                                <?= $modulos[$i]['titulo']; ?>
                            </td>
                            <td class="text-center"><div class="toggle-flip">
                                  <label>
                                    <input type="checkbox" name="modulos[<?= $i; ?>][r]" <?= $rCheck ?> ><span class="flip-indecator" data-toggle-on="ON" data-toggle-off="OFF"></span>
                                  </label>
                                </div>
                            </td>
                            <td class="text-center"><div class="toggle-flip">
                                  <label>
                                    <input type="checkbox" name="modulos[<?= $i; ?>][w]" <?= $wCheck ?>><span class="flip-indecator" data-toggle-on="ON" data-toggle-off="OFF"></span>
                                  </label>
                                </div>
                            </td>
                            <td class="text-center"><div class="toggle-flip">
                                  <label>
                                    <input type="checkbox" name="modulos[<?= $i; ?>][u]" <?= $uCheck ?>><span class="flip-indecator" data-toggle-on="ON" data-toggle-off="OFF"></span>
                                  </label>
                                </div>
                            </td>
                            <td class="text-center"><div class="toggle-flip">
                                  <label>
                                    <input type="checkbox" name="modulos[<?= $i; ?>][d]" <?= $dCheck ?>><span class="flip-indecator" data-toggle-on="ON" data-toggle-off="OFF"></span>
                                  </label>
                                </div>
                            </td>
                          </tr>
                      <?php
                        $no++;
                      }
                      ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
          </div>
          <div class="modal-footer">
            <!--<a class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>-->
            <a class="btn btn-outline-secondary icono-color-principal btn-inline cerrarModal" href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i> Cancelar</a>
            <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-lg fa-check-circle icono-azul"></i> Guardar</button>
          </div>
        </form>
    </div>
  </div>
</div>







