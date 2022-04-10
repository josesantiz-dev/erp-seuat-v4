document.addEventListener('DOMContentLoaded', function(){
    var tableHistorialCorteCaja = $('#tableHistorialCorteCajas').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": " "+base_url+"/Assets/plugins/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/HistorialCorteCajas/getCortesCajas",
            "dataSrc":""
        },
        "columns":[
            {"data":"numeracion"},
            {"data":"folio"},
            {"data":"plantel"},
            {"data":"nombre"},
            {"data":"fechayhora_apertura_caja"},
            {"data":"fechayhora_cierre_caja"},
            {"data":"usuario_entrega"},
            {"data":"usuario_recibe"},
            {"data":"faltante"},
            {"data":"sobrante"},
            {"data":"options"}
        ],
        "responsive": true,
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "scrollCollapse": true,
        "bDestroy": true,
        "order": [[ 0, "asc" ]],
        "iDisplayLength": 10
    });
});
$('#tableHistorialCorteCajas').DataTable();

//Function para dar formato un numero a Moneda
function formatoMoneda(numero){
    let str = numero.toString().split(".");
    str[0] = str[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return "$"+str.join(".");
}