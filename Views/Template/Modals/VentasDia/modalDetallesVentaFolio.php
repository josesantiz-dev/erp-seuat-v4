<!-- Modal -->
<div class="modal fade" id="modalVentaDetallesDia" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalles Venta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-12 col-xl-12">
		            <div class="card">
				        <div class="card-header">
					        <h5 class="card-title">Folio: <span id="folioDetallesVenta"></span></h5><br>
					        <h6 class="card-subtitle text-muted m-auto">Observaciones: <i><span id="observacionIngreso"></span></i></h6>
				        </div>
				        <table class="table table-striped">
					        <thead>
						        <tr>
							        <th style="width:5%;">No</th>
							        <th style="width:40%">Concepto</th>
							        <th style="width:15%">Precio unitario</th>
							        <th style="width:40%">Promociones</th>
						        </tr>
					        </thead>
					        <tbody id="tableDetallesVentaModal">
						        
							</tbody>
						</table>
					</div>
				</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>