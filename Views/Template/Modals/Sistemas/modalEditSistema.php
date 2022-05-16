<div class="modal fade" id="modal_edit_sistema" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar sistema educativo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form id="form_edit_sistema" method = "POST" name="form_edit_sistema" enctype="multipart/form-data">
                <input type="hidden" id="id_sistema_edit" name="id_sistema_edit">
                <input type="hidden" id="name_file_edit" name="name_file_edit">
                <div class="form-group">
                    <label for="txt_nombre_sistema_edit">Nombre del sistema <span class="required">*</span> </label>
                    <input type="text" id="txt_nombre_sistema_edit" name="txt_nombre_sistema_edit" class="form-control valid validText" placeholder="Ingrese un nombre" required="" maxlength="150">
                </div>
                <div class="form-group">
                    <label for="txt_abreviacion_edit">Abreviación <span class="required">*</span> </label>
                    <input type="text" id="txt_abreviacion_edit" name="txt_abreviacion_edit" class="form-control valid validText" placeholder="Ingrese una abreviación" required="" maxlength="10">
                </div>
                <div class="form-group">
                    <label>Logotipo del sistema</label>
                    <div class="card">
                        <div class="card-header">
                            <div class="col-md-12">
                                <a href="#" class="btn btn-warning btn-sm float-right" onclick="buscarImagenSistemaEdit()" id="btnBuscarImagenSistemaEdit">Cambiar</a>
                            </div>
                        </div>
                        <div class="form-group card-body text-center" style="position:relative;" >
                            <span class="img-div">
                                <img src="<?php echo media();?>/images/img/logo-empty.png" id="profileDisplaySistemaEdit" style="max-width:200px;">
                            </span>
                            <input type="file" name="profileImageSistema" onChange="displayImageSistemaEdit(this)" id="profileImageSistemaEdit" class="form-control" style="display: none;"
                                accept=".png,.jpg,.jpeg,.svg">
                        </div>
                    </div> 
                </div>
                <div class="form-group col-md-4">
                    <label>Estatus</label>
                    <select class="form-control form-control-sm" id="listEstatusEdit" name="listEstatusEdit"  required>
                        <option value="1">Activo</option>
                        <option value="2">Inactivo</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" data-dismiss="modal" id="dimissModalNuevo"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>
                <button id="btnActionFormEdit" type="submit" class="btn btn-outline-secondary btn-primary icono-color-principal btn-inline"><i class="fa fa-fw fa-lg fa-check-circle icono-azul"></i><span id="btnText"> Actualizar</span></button>
            </div>
            </form>
        </div>
    </div>
</div>