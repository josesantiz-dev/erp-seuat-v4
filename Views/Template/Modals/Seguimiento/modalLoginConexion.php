<div class="modal fade" id="addConexion" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Iniciar sesión</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <img class="card-img-top" alt="">
                    <form action="" name="formNuevaSesion" id="formNuevaSesion">
                        <div class="card-body">
                            <div class="input-group">
                                <input type="text" id="txtNicknameNvaSesion" name="txtNicknameNvaSesion" class="form-control" placeholder="Nombre de usuario" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="input-group">
                                <input type="password" id="txtPasswordNvaSesion" name="txtPasswordNvaSesion" class="form-control" placeholder="Contraseña" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <i class="far fa-eye mr-2" id="togglePassword" style="color:#045FB4"></i>
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="input-group mb-4">
                                <select class="form-control custom-select" name="selectPlantelNvo" id="selectPlantelNvo" required>
                                    <option value="" selected>Selecciona un plantel</option>
                                    <?php foreach(conexiones as $key => $conexion){?>
                                        <option value="<?php echo($key)?>"><?php echo($conexion['NAME']) ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    
                </div>
            </div>
            <div class="modal-footer">
                <button id="cerrar"type="button" class="btn btn-outline-secondary icono-color-principal btn-inline" data-dismiss="modal" id="dimissModalNuevoLogin"><i class="fa fa-fw fa-lg fa-times-circle icono-azul" id="salirModalLoginNvo"></i> Cerrar</button>
                <button id="btnLoginNuevo" type="submit" class="btn btn-outline-secondary icono-color-principal btn-inline"><i class="fa fa-fw fa-lg fa-check-circle icono-azul"></i><span id="btnText"> Iniciar sesión</span></button>
            </div>
            </form>
        </div>
    </div>
</div>