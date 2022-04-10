let idCaja = null;
let tabActual = 0;
let idCorteCaja = null;
let total = 0;
let totalSCaja = 0;
let faltante = 0;
let sobrante = 0;
let arrTotales = [];

function fnSelectCajero(value){
    if(value == ''){
        swal.fire("Atención","Selecciona una caja/cajero","warning");
        return false;
    }
    let id_caja = value;
    total = 0;
    totalSCaja = 0;
    arrTotales = [];
    let url = `${base_url}/CorteCaja/getCaja/${id_caja}`;
    fetch(url)
    .then(res => res.json())
    .then((resultado) => {
        if(resultado.estatus){
            if(resultado.estatus_caja == 1){
                idCaja = value;
                idCorteCaja = resultado.id_corte_caja;
                document.querySelector('#num_caja').value = resultado.nombre;
                document.querySelector('#dateCorteDesde').value = resultado.fechayhora_apertura_caja;
                document.querySelector('#dateCorteHasta').value = resultado.fechayhora_actual;
                fnTotalesMetodosPago(id_caja,resultado.fechayhora_apertura_caja);
            }else{
                Swal.fire({
                    title: 'Caja cerrada!',
                    text: "La caja seleccionada, actualmente se encuentra cerrada!",
                    icon: 'warning',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                  })
            }
        }else{
            Swal.fire({
                title: 'Caja cerrada!',
                text: "La caja seleccionada, actualmente se encuentra cerrada!",
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
              })
        }
    }).catch(err => { throw err });
}
function fnTotalesMetodosPago(id_caja,fecha_apertura){
    let url = `${base_url}/CorteCaja/getTotalesMetodosPago/${id_caja}/${fecha_apertura}`;
    fetch(url)
    .then(res => res.json())
    .then((resultado) =>{
        let numeracion = -1;
        document.querySelector('#totalesEfecMetoPago').innerHTML = "";
        document.querySelector('#nav-tab').innerHTML = "";
        document.querySelector('#content-nav').innerHTML = "";
        resultado['totales'].forEach(element => {
            let arr = {'id_metodo_pago':element.id,'total':element.total};
            arrTotales.push(arr);
            total += element.total;
            numeracion += 1;
            //let row = "<tr id='"+element.id+"'><th scope='row'>"+element.metodo+"</th><td><input type='text' class='form-control' value='"+formatoMoneda(element.total.toFixed(2))+"' disabled></td><td><input type='text' class='form-control' placeholder='$0.00' value='0' onkeyup = 'fnChangeTotalSegunCaja()'></td></tr>";
            let row = "<tr id='"+element.id+"'><th scope='row'>"+element.metodo+"</th><td><input type='text' class='form-control' value='"+formatoMoneda(element.total.toFixed(2))+"' disabled></td><td><div class='input-group mb-3'><div class='input-group-prepend'><span class='input-group-text'>$<span></div><input type='text' class='form-control' value='' onkeyup='fnChangeTotalSegunCaja()'><div class='input-group-append'></div></div></td></tr>";
            let content = "";
            document.querySelector('#totalesEfecMetoPago').innerHTML += row;
            document.querySelector('#nav-tab').innerHTML +='<a class="nav-link tab-nav" id="'+numeracion+'-tab" data-toggle="tab" href="" onclick="fnNavTab('+numeracion+')" >'+element.metodo+'</a>';
            let numRow = 0;
            resultado['detalles'].forEach(detalle => {
                if(detalle.id_metodo_pago == element.id){
                    numRow += 1
                    content += "<tr><td>"+numRow+"</td><td>"+detalle.folio+"</td><td>"+detalle.nombre_persona+"</td><td>"+detalle.fecha+"</td><td>"+formatoMoneda(detalle.total)+"</td><td><button type='button' class='btn btn-primary btn-sm' onclick='fnDetallesIgreso("+detalle.id_ingreso+")'>Detalles</button></td></tr>";
                }
            });
            document.querySelector('#content-nav').innerHTML += '<div class="tab" id="'+numeracion+'"><table id="" class="table table-bordared table-striped table-sm"><thead><tr><th>#</th><th>Folio</th><th>Alumno</th><th>Fecha</th><th>Total</th><th>Acciones</th></tr></thead><tbody id="tbody-'+element.id+'">'+content+'</tbody></table></div>';
            document.getElementsByClassName('tab')[tabActual].style.display = 'block';
            document.getElementById('0-tab').className += " active";
        });
        document.querySelector('#totalSSistema').textContent = formatoMoneda(total.toFixed(2));
    }).catch(err => {throw err});
}
function fnNavTab(numTab){
    tabActual = numTab;
    let x = document.getElementsByClassName('tab');
    for(let i = 0; i<x.length;i++){
        x[i].style.display = 'none';
    }
    x[numTab].style.display = 'block';
}

function fnDetallesIgreso(value){
    let url = `${base_url}/CorteCaja/getDetallesIngreso/${value}`;
    fetch(url)
    .then(res => res.json())
    .then((resultado) => {
        let numeracion = 0;
        document.querySelector("#tbodyDetallesVenta").innerHTML = "";
        resultado.forEach(element => {
            numeracion += 1;
            let row ="<tr><td>"+numeracion+"</td><td>"+element.fecha+"</td><td>"+element.codigo+"</td><td>"+element.nombre+"</td><td>"+formatoMoneda(element.abono)+"</td><td>"+element.folio+"</td><td>"+element.nombre_usuario+"</td></tr>";
            document.querySelector('#tbodyDetallesVenta').innerHTML += row;
        });
    }).catch(err => {throw err});
}

function fnChangeTotalSegunCaja(){
    let x = document.querySelector('#totalesEfecMetoPago');
    let totalCaja = 0;
    x.childNodes.forEach(element => {
        let cantidad = (element.childNodes[2].childNodes[0].childNodes[1].value == '')?0:element.childNodes[2].childNodes[0].childNodes[1].value;
        let id_metodo = element.id;
        if(isNaN(cantidad)){
            Swal.fire({
                title: 'Error!',
                text: "No se aceptan cadenas de texto!",
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
              }).then((result) =>{
                element.childNodes[2].childNodes[0].childNodes[1].value = 0;
            });
        }else{
            totalCaja += parseInt(cantidad);
            for(let i = 0; i<arrTotales.length;i++){
                if(arrTotales[i].id_metodo_pago == id_metodo){
                    let val = {'id_metodo_pago':arrTotales[i].id_metodo_pago,'total':arrTotales[i].total,'total_caja':parseFloat(cantidad)};
                    arrTotales[i] = val;
                }
            }
        }
    });
    totalSCaja = totalCaja;
    document.querySelector('#totalSCaja').textContent = formatoMoneda(totalCaja.toFixed(2));
    let diferencia = total-totalCaja;
    if(diferencia<0){
        document.querySelector('#sobrante').value = formatoMoneda(diferencia*(-1).toFixed(2));
        document.querySelector('#faltante').value = "$0.00";
        faltante = 0;
        sobrante = diferencia*(-1);
    }else{
        document.querySelector('#sobrante').value = "$0.00"
        document.querySelector('#faltante').value = formatoMoneda(diferencia.toFixed(2));
        faltante = diferencia;
        sobrante = 0;
    }

    
}
function cerrarModla(){
    $('#modalCorteCaja').modal('hide')
}

function gnGuardarCorte(){
    if(idCaja == null || idCorteCaja == null){
        swal.fire("Atención","Selecciona una caja/cajero","warning");
        return false;
    }
    if(totalSCaja <= 0){
        swal.fire("Atención","Error en las cantidades Segun caja, <b>corregir</b>","warning");
        return false;
    }
    if(faltante != 0 && document.getElementById('observaciones').value == ''){
        swal.fire("Atención","Es necesario poner un comentarios, <b>corregir</b>","warning").then((result)=>{
            if(result.isConfirmed){
                document.getElementById('observaciones').focus();
            }
        });
        return false;
    }
    $("#modalCorteCaja").modal('show');
    if(sobrante == 0 && faltante == 0){
        document.getElementById('box-corte-done').style.display = "block";
        document.getElementById('box-corte-error').style.display = "none";
        document.getElementById('msg-corte').innerHTML = "<div class='alert alert-success' role='alert'>Todo correcto</div>";
    }else if(sobrante != 0 || faltante != 0){
        document.getElementById('box-corte-error').style.display = "block";
        document.getElementById('box-corte-done').style.display = "none";
        document.getElementById('msg-corte').innerHTML = "<div class='alert alert-danger' role='alert'><div class='row'><div class='col-6'><label>Faltantes</label><h2>"+formatoMoneda(faltante.toFixed(2))+"</h2></div><div class='col-6'><label>Sobrantes</label><h2>"+formatoMoneda(sobrante.toFixed(2))+"</h2></div></div></div>";
    }
}
function fnRealizarCorte(){
    let cantidad = document.querySelector('#txtCantidadEntregar').value;
    let cajero = document.querySelector('#listCajeros').value;
    let arrCorte = [];
    let observacion = document.querySelector('#observaciones').value;
    arrCorte = {'totales':arrTotales,'observaciones':observacion,'id_corte_caja':idCorteCaja,'id_caja':idCaja};
    arrCorte = JSON.stringify(arrCorte);

    if(cantidad =='' || cajero == ''){
        swal.fire("Atención","Todos los datos son obligatorios","warning");
        return false;
    }
    let url = `${base_url}/CorteCaja/setCorteCaja/${idCaja}/${idCorteCaja}/${convToBase64(arrCorte)}/${cantidad}/${cajero}/${faltante}/${sobrante}`;
    if(faltante != 0){
        Swal.fire({
            title: 'Realizar corte?',
            html: "Al realizar el corte, se genererá un comprobante de pago de <b>FALTANTES</b>, y automaticamente se cerrará la <b>caja</b>!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, realizar',
            cancelButtonText:'No'
          }).then((result) => {
            if (result.isConfirmed) {
              fetch(url).then(res => res.json()).then((resultado) =>{
                if(resultado.estatus){
                    window.open(`${base_url}/CorteCaja/imprimir_comprobante_faltante/${idCaja}/${idCorteCaja}/${convToBase64(arrCorte)}/${cantidad}/${cajero}/${faltante}/${sobrante}`, '_blank');
                    Swal.fire('Exito!',resultado.msg,'success').then((result) =>{
                        window.location.href = `${base_url}/Ingresos`;
                    })
                }else{
                    Swal.fire('Error!',resultado.msg,'error');
                }
              }).catch(err => {throw err});
            }
          })
          return false;
    }else{
        fetch(url).then(res => res.json()).then((resultado) =>{
            console.log(resultado);
            if(resultado.estatus){
                Swal.fire('Exito!',resultado.msg,'success').then((result) =>{
                    window.location.href = `${base_url}/Ingresos`;
                })
            }else{
                Swal.fire('Error!',resultado.msg,'error');
            }
        }).catch(err => {throw err});
    }
}

function imprimirCorte(){
    //console.log("imprimiendo");
}

//Function para dar formato un numero a Moneda
function formatoMoneda(numero){
    let str = numero.toString().split(".");
    str[0] = str[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return "$"+str.join(".");
}

function convToBase64(string){
    let value = window.btoa(unescape(encodeURIComponent(string)));
    return value;
}  