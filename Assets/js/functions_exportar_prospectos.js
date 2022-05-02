let divAlertExportProspectos = document.querySelector('.alert_select_prospectos');
divAlertExportProspectos.style.display = "none";
let arrProspectosExportar = [];
document.addEventListener('DOMContentLoaded', function(){
	tableGeneraciones = $('#table_exportar_prospectos').dataTable( {
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

function btnExportarProspectos(){
    if(arrProspectosExportar.length > 0){
        let url = `${base_url}/ExportarProspectos/exportarcsv`;
       //window.open(url, '_blank');

        fetch(url)
            .then((res) => res.json())
            .then(resultado =>{
                console.log(resultado);
            })
            .catch(err => {throw err}); 
    }else{
        swal.fire("Atención", "Atención no ha seleccionado prospectos", "warning");
        return false;
    }
}
