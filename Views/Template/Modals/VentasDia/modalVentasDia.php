<!-- Modal -->
<div class="modal fade" id="modalCorteParcialCaja" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Corte de caja</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="col-12 text-center">
                <h1><b><span id="totalVentaCorteParcial">$0,000.00</span></b></h1>
                <br>
            </div>
            <div clas="col-12">
                <input type="text" id="totalEfectivoCorte" class="form-control col-9 m-auto text-center" placeholder="Total en efectivo" style="font-size:30pt;height:88px">
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" onclick="btnGuardarCorte()" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>