
<div class="modal fade" id="modalCorteCaja" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Corte de caja</h5>
                <button type="button" onclick="cerrarModla()"class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-12 text-center">
                    <div class="icon-box" id="box-corte-done" style="color:#fff;margin: 0 auto;left: 0;right: 0;top: -70px;width: 95px;height: 95px;border-radius: 50%;z-index: 9;background: #28a745;padding: 15px;text-align: center;box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);display:none">
                        <i class="fas fa-check" style="	font-size: 58px;position: relative;top: 3px;"></i>
                    </div><br>
                    <div class="icon-box" id="box-corte-error"  style="color:#fff;margin: 0 auto;left: 0;right: 0;top: -70px;width: 95px;height: 95px;border-radius: 50%;z-index: 9;background: #dc3545;padding: 15px;text-align: center;box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);display:none">
                        <i class="fas fa-exclamation" style="font-size: 58px;position: relative;top: 3px;"></i>
                    </div><br>
                    <div id="msg-corte"></div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Cantidad a entregar</label>
                        <div class="text-center"><input type="text" class="form-control col-md-6 col-lg-6 m-auto" id="txtCantidadEntregar" placeholder="Ex: $1500.00" style="height:50px;font-size:24px"></div>
                    </div>   
                    <div class="form-group">
                        <select class="custom-select" id="listCajeros">
                            <option value="" selected>Seleccionar un cajero(a)</option>
                            <?php foreach ($data['cajeros'] as $key => $cajero) { ?>
                                <option value="<?php echo $cajero['id_caja'] ?>"><?php echo $cajero['nombre_persona'].' '.$cajero['ap_paterno'].' '.$cajero['ap_materno'] ?></option>
                            <?php }?>
                        </select>
                    </div>             
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" data-dismiss="modal" onclick="cerrarModla()"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>
                <button onclick="fnRealizarCorte()" type="submit" class="btn btn-outline-secondary btn-primary icono-color-principal btn-inline"><i class="fa fa-fw fa-lg fa-check-circle icono-azul"></i><span id="btnText"> Guardar</span></button>
            </div>
        </div>
    </div>
</div> 
<!-- <style>
    <style>
.modal-confirm {		
	color: #636363;
	width: 325px;
	font-size: 14px;
}
.modal-confirm .modal-content {
	padding: 20px;
	border-radius: 5px;
	border: none;
}
.modal-confirm .modal-header {
	border-bottom: none;   
	position: relative;
}
.modal-confirm h4 {
	text-align: center;
	font-size: 26px;
	margin: 30px 0 -15px;
}
.modal-confirm .form-control, .modal-confirm .btn {
	min-height: 40px;
	border-radius: 3px; 
}
.modal-confirm .close {
	position: absolute;
	top: -5px;
	right: -5px;
}	
.modal-confirm .modal-footer {
	border: none;
	text-align: center;
	border-radius: 5px;
	font-size: 13px;
}	
.modal-confirm .icon-box {
	color: #fff;		
	position: absolute;
	margin: 0 auto;
	left: 0;
	right: 0;
	top: -70px;
	width: 95px;
	height: 95px;
	border-radius: 50%;
	z-index: 9;
	background: #82ce34;
	padding: 15px;
	text-align: center;
	box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
}
.modal-confirm .icon-box i {
	font-size: 58px;
	position: relative;
	top: 3px;
}
.modal-confirm.modal-dialog {
	margin-top: 80px;
}
.modal-confirm .btn {
	color: #fff;
	border-radius: 4px;
	background: #82ce34;
	text-decoration: none;
	transition: all 0.4s;
	line-height: normal;
	border: none;
}
.modal-confirm .btn:hover, .modal-confirm .btn:focus {
	background: #6fb32b;
	outline: none;
}
.trigger-btn {
	display: inline-block;
	margin: 100px auto;
}
</style>
    </style>
<div id="modalCorteCaja" class="modal fade">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
			<div class="modal-header">
				<div class="icon-box">

                    <i class="fas fa-check"></i>
				</div>				
				<h4 class="modal-title w-100">Awesome!</h4>	
			</div>
			<div class="modal-body">
				<p class="text-center">Your booking has been confirmed. Check your email for detials.</p>
			</div>
			<div class="modal-footer">
				<button class="btn btn-success btn-block" data-dismiss="modal">OK</button>
			</div>
		</div>
	</div>
</div>  -->