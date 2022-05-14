let tableSistemas;
document.addEventListener('DOMContentLoaded', function(){
    tableSistemas = $('#table_sistemas').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": " "+base_url+"/Assets/plugins/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Sistemas/getSistemas",
            "dataSrc":""
        },
        "columns":[
			{"data": "id"},
			{"data": "id"},
			{"data": "id"},
			{"data": "id"}
        ],
        "responsive": true,
	    "paging": true,
	    "lengthChange": true,
	    "searching": true,
	    "ordering": false,
	    "info": true,
	    "autoWidth": false,
	    "scrollY": '42vh',
	    "scrollCollapse": true,
	    "bDestroy": true,
	    "order": [[ 0, "asc" ]],
	    "iDisplayLength": 10
    });
})
$('#table_sistemas').DataTable();


function btnSistemaNuevo()
{
    
}