    <?php
    headerAdmin($data);
    getModal('CorteCaja/modalCorteCaja',$data);
?>
<div class="wrapper">
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-7">
                        <h1 class="m-0">  <?= $data['page_title'] ?></h1>
                    </div>
                </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card p-2">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label>Corte de caja No.</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" value="">
                                                            <div class="input-group-append">
                                                                <span type="button" class="input-group-text" id="basic-addon2">Buscar</span>
                                                            </div>
                                                        </div>
                                                        <label>Fecha</label>
                                                        <input type="text" class="form-control" value="<?php echo date("j/m/Y H:i:s A"); ?>" disabled>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <label>Cajero</label>
                                                        <div class="input-group">
                                                            <select class="custom-select" onchange="fnSelectCajero(value)">
                                                                <option value="">Seleccionar...</option>
                                                                <?php foreach ($data['cajeros'] as $key => $cajero) { ?>
                                                                    <option value="<?php echo $cajero['id_caja'] ?>"><?php echo $cajero['nombre_persona'].' '.$cajero['ap_paterno'].' '.$cajero['ap_materno']  ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <label>Caja No</label>
                                                        <input type="text" id="num_caja" class="form-control" value="" disabled>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div>
                                                            <label>Desde.</label>
                                                            <input type="text" class="form-control" id="dateCorteDesde" placeholder="" value="" disabled>
                                                            <label>Hasta.</label>
                                                            <input type="text" class="form-control" id="dateCorteHasta" placeholder="" value="" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card p-2">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <table class="table table-striped col-md-12">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col"></th>
                                                                    <th scope="col">Segun sistema</th>
                                                                    <th scope="col">Segun caja</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="totalesEfecMetoPago">
                                                            </tbody>
                                                            <tr><td>Totales</td><td class="text-center"><b><span id="totalSSistema">$0.00</span></b></td><td class="text-center"><b><span id="totalSCaja">$0.00</span></b></td></tr>

                                                        </table>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <div class="card card-secondary">
                                                            <nav>
                                                                <div class="nav nav-pills nav-fill" id="nav-tab" role="tablist">

                                                                </div>
                                                            </nav>
                                                            <form>
                                                                <div class="card-body" id="content-nav"> 

                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="card p-2">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-9">
                                                        <p class="card-text">
                                                            <table id="tableVentasDia" class="table table-bordered table-striped table-hover table-sm">
                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Fecha</th>
                                                                        <th>Codigo</th>
                                                                        <th>concepto</th>
                                                                        <th>Monto</th>
                                                                        <th>Referencia</th>
                                                                        <th>autorizado por</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="tbodyDetallesVenta">
                                                                    
                                                                </tbody>
                                                            </table>
                                                        </p>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label>Devoluciones.</label>
                                                        <input type="text" class="form-control" value="$0.00">
                                                        <label>Total egresos</label>
                                                        <input type="text" class="form-control" value="0.00">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card p-2">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label>Faltante</label>
                                                        <input type="text" class="form-control" id="faltante" value="$0.00" disabled>
                                                        <label>Sobrante</label>   
                                                        <input type="text" class="form-control" id="sobrante" value="$0.00" disabled>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Observaciones</label>
                                                        <textarea type="text" class="form-control" id="observaciones" rows="4" placeholder="Observaciones"></textarea>
                                                    </div>
                                                    <div class="col-md-2 block">
                                                        <button type="button" class="btn btn-primary col-12 mb-2 mt-2"  onclick="gnGuardarCorte()">Guardar</button>
                                                        <button type="button" class="btn btn-primary col-12" onclick="imprimirCorte()">Imprimir</button>
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
        </div>
    </div>
</div>

<?php footerAdmin($data); ?>