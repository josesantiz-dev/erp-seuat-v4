<div class="modal fade" id="modal_nuevo_sistema" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nuevo sistema educativo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form id="form_nuevo_sistema" method = "POST" name="form_nuevo_sistema" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="txt_nombre_sistema">Nombre del sistema <span class="required">*</span> </label>
                    <input type="text" id="txt_nombre_sistema" name="txt_nombre_sistema" class="form-control valid validText" placeholder="Ingrese un nombre" required="" maxlength="100">
                </div>
                <div class="form-group">
                    <label for="txt_abreviacion">Abreviación <span class="required">*</span> </label>
                    <input type="text" id="txt_abreviacion" name="txt_abreviacion" class="form-control valid validText" placeholder="Ingrese una abreviación" required="" maxlength="10">
                </div>
                <div class="form-group">
                    <label>Logotipo del sistema</label>
                    <div class="card">
                        <div class="card-header">
                            <div class="col-md-12">
                                <a href="#" class="btn btn-primary btn-sm float-right" onclick="buscarImagenSistema()" id="btnBuscarImagenSistema">Buscar Imagen</a>
                            </div>
                        </div>
                        <div class="form-group card-body text-center" style="position:relative;" >
                            <span class="img-div">
                                <img src="<?php echo media();?>/images/img/logo-empty.png" id="profileDisplaySistema" style="max-width:200px;">
                            </span>
                            <input type="file" name="profileImageSistema" onChange="displayImageSistema(this)" id="profileImageSistema" class="form-control" style="display: none;"
                                accept=".png,.jpg,.jpeg,.svg">
                        </div>
                    </div> 
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" data-dismiss="modal" id="dimissModalNuevo"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>
                <button id="btnActionFormNuevo" type="submit" class="btn btn-outline-secondary btn-primary icono-color-principal btn-inline"><i class="fa fa-fw fa-lg fa-check-circle icono-azul"></i><span id="btnText"> Guardar</span></button>
            </div>
            </form>
        </div>
    </div>
</div>