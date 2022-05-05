let divAlertExportProspectos = document.querySelector('.alert_select_prospectos');
divAlertExportProspectos.style.display = "none";
let formExportarProspectos = document.querySelector('#form_exportar_prospectos');
let tablePersonas = "";
let arrProspectosExportar = [];
let arrNewData = [];
divAlertExportProspectos.style.display = "flex";
document.addEventListener('DOMContentLoaded', function(){
	tablePersonas = $('#table_exportar_prospectos').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	//url:"<?php echo media(); ?>/plugins/Spanish.json"
        	"url": " "+base_url+"/Assets/plugins/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/ExportarProspectos/getProspectos",
            "dataSrc":""
        },
        "columns":[
            {"data":"check"},
            {"data":"numeracion"},
            {"data":"alias"},
            {"data":"nombre_persona"},
			{"data":"apellidos"},
            {"data":"email"},
            {"data":"tel_celular"},
            {"data":"direccion"},
            {"data":"nombre_categoria"},
        ],
        "responsive": true,
	    "paging": true,
	    "lengthChange": true,
	    "searching": true,
	    "ordering": true,
	    "info": true,
	    "autoWidth": false,
	    "scrollY": '44vh',
	    "scrollCollapse": true,
	    "bDestroy": true,
	    "order": [[ 0, "asc" ]],
	    "iDisplayLength": 25
    });
	
}, false);
$('#table_exportar_prospectos').DataTable();

function fnSeleccionarProspectoExportar(value,id){
    let idPersona = id;
    if(value.checked){
        let value = {'id_persona':idPersona,'plantel_prospecto':null,'estatus':1};
        arrProspectosExportar[idPersona] = value;
    }else{
        let value = {'id_persona':idPersona,'plantel_prospecto':null,'estatus':0};
        arrProspectosExportar[idPersona] = value;
    }
}
function fnExportarProspectos(){
    arrProspectosExportar.forEach(persona => {
        if(persona.estatus == 1){
            arrNewData.push(persona);
        }
    });
    if(arrNewData.length <= 0){
        swal.fire("Atención", "Selecciona un alumno a exportar", "warning");
        return false;
    }else{
        $('#modal_exportar_prospectos').modal('show');
    }
}
$(".cerrarModal").click(function(){
	$("#modal_exportar_prospectos").modal('hide')
});

formExportarProspectos.onsubmit = function(e){
    e.preventDefault();
    let selectPlantel = document.querySelector('#select_planteles').value;
    if(selectPlantel == ''){
        swal.fire("Atención","Selecciona un plantel a exportar","warning");
        return false;
    }
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = `${base_url}/ExportarProspectos/exportarcsv?data=${convStrToBase64(JSON.stringify(arrNewData))}&plantel=${selectPlantel}`;
    var formData = new FormData(formExportarProspectos);
    request.open("POST",ajaxUrl,true);
    request.send(formData);
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var objData = JSON.parse(request.responseText);
            if(objData){
                exportToCsv('prospectos-csv.csv',objData.data)
                let urltr = `${base_url}/ExportarProspectos/setTransferencia?datos=${convStrToBase64(JSON.stringify(arrNewData))}&folio=${objData.folio}&plantel=${selectPlantel}`;
                fetch(urltr)
                .then((res) => res.json())
                .then(transferencia =>{
                    if(transferencia.estatus){
                        tablePersonas.api().ajax.reload();
                        arrProspectosExportar = [];
                        arrNewData = [];
                        swal.fire("Persona", transferencia.msg, "success").then((result) =>{
                            $("#modal_exportar_prospectos").modal('hide')
                        }); 
                    }else{
                        swal.fire("Error",transferencia.msg,"error");
                        return false;
                    }
                }).catch(err => {throw err});
            }
        }
        divLoading.style.display = "none";
        return false;
    }
}

function exportToCsv(filename, rows) {
    var processRow = function (row) {
        var finalVal = '';
        for (var j = 0; j < row.length; j++) {
            var innerValue = row[j] === null ? '' : row[j].toString();
            if (row[j] instanceof Date) {
                innerValue = row[j].toLocaleString();
            };
            var result = innerValue.replace(/"/g, '""');
            if (result.search(/("|,|\n)/g) >= 0)
                result = '"' + result + '"';
            if (j > 0)
                finalVal += ',';
            finalVal += result;
        }
        return finalVal + '\n';
    };

    var csvFile = '';
    for (var i = 0; i < rows.length; i++) {
        csvFile += processRow(rows[i]);
    }

    var blob = new Blob([csvFile], { type: 'text/csv;charset=utf-8;' });
    if (navigator.msSaveBlob) { // IE 10+
        navigator.msSaveBlob(blob, filename);
    } else {
        var link = document.createElement("a");
        if (link.download !== undefined) { // feature detection
            // Browsers that support HTML5 download attribute
            var url = URL.createObjectURL(blob);
            link.setAttribute("href", url);
            link.setAttribute("download", filename);
            link.style.visibility = 'hidden';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    }
}
//Function para convertir un string  a  Formato Base64
function convStrToBase64(str){
    return window.btoa(unescape(encodeURIComponent( str ))); 
}

