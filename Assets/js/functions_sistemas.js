let tableSistemas;
let formNuevoSistema = document.querySelector('#form_nuevo_sistema');
let formEditSistema = document.querySelector('#form_edit_sistema');
let divLoading = document.querySelector("#divLoading");

//Datatable de sistemas
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
			{"data": "numeracion"},
			{"data": "nombre_sistema"},
			{"data": "abreviacion_sistema"},
			{"data": "estatus"},
			{"data": "options"}
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

//Submit de nuevo Sistema
formNuevoSistema.addEventListener('submit',(e) =>{
    e.preventDefault();
    let strNombreSistema = document.querySelector('#txt_nombre_sistema').value;
    let strAbreviacion = document.querySelector('#txt_abreviacion').value;
    if(strNombreSistema ==''  || strAbreviacion == ''){
        swal.fire("Atención","Atención todos los campos son obligatorios","warning");
        return false;
    }
    divLoading.style.display = "flex";
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+'/Sistemas/setSistema';
    var formData = new FormData(formNuevoSistema);
    request.open("POST",ajaxUrl,true);
    request.send(formData);
    request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status == 200) {
            var objData = JSON.parse(request.responseText);
            if(objData.estatus){
                $('#modal_nuevo_sistema').modal("hide");
                formNuevoSistema.reset();
                swal.fire("Sistemas", objData.msg, "success").then((result) =>{
                    $('.close').click();
                });
                tableSistemas.api().ajax.reload();  
            }else{
                swal.fire("Error", objData.msg, "error");
            }
        }else{
            swal.fire("Error", "No se pudo guardar los datos", "error");
        }
        divLoading.style.display = "none";
        return false;
    }
});

//Boton Buscar/Agregar imagen del sistema
function buscarImagenSistema()
{
    document.querySelector('#profileImageSistema').click();
}
function buscarImagenSistemaEdit(f){
    document.querySelector('#profileImageSistemaEdit').click();
}

//Mostrar imagen seleccionada en el modal
function displayImageSistema(f) {
    if (f.files[0]) {
        var reader = new FileReader();
        reader.onload = function(f){
            document.querySelector('#profileDisplaySistema').setAttribute('src', f.target.result);
            document.getElementById('btnBuscarImagenSistema').textContent = "Cambiar";
            document.querySelector('#btnBuscarImagenSistema').classList.replace("btn-primary", "btn-warning");
        }
        reader.readAsDataURL(f.files[0]);
    }
}
function displayImageSistemaEdit(f){
    if (f.files[0]) {
        var reader = new FileReader();
        reader.onload = function(f){
            document.querySelector('#profileDisplaySistemaEdit').setAttribute('src', f.target.result);
            document.getElementById('btnBuscarImagenSistemaEdit').textContent = "Cambiar";
            document.querySelector('#btnBuscarImagenSistemaEdit').classList.replace("btn-primary", "btn-warning");
        }
        reader.readAsDataURL(f.files[0]);
    }
}

//Editar sistema
function fnEditSistema(idSistema)
{
    if(idSistema != ''){
        let urlSistema = `${base_url}/Sistemas/getSistema/${idSistema}`;
        fetch(urlSistema)
        .then((res) => res.json())
        .then(resultado =>{
            if(resultado.estatus){
                document.querySelector('#id_sistema_edit').value = resultado.data.id;
                document.querySelector('#txt_nombre_sistema_edit').value = resultado.data.nombre_sistema;
                document.querySelector('#txt_abreviacion_edit').value = resultado.data.abreviacion_sistema;
                document.querySelector("#profileDisplaySistemaEdit").src = base_url+"/Assets/images/logos/"+resultado.data.logo_sistema;
                document.querySelector('#listEstatusEdit').querySelector('option[value="' + resultado.data.estatus + '"]').selected = true;
                document.querySelector('#name_file_edit').value = resultado.data.logo_sistema;
            }else{
                swal.fire("Error", resultado.msg, "error");
            }
        }).catch(err =>{throw err});
    }
}

//Submit de edit Sistema
formEditSistema.addEventListener('submit',(e) =>{
    e.preventDefault();
    let idSistemaEdit = document.querySelector('#id_sistema_edit').value;
    let strNombreSistemaEdit = document.querySelector('#txt_nombre_sistema_edit').value;
    let strAbreviacionEdit = document.querySelector('#txt_abreviacion_edit').value;
    let intEstatusEdit = document.querySelector('#listEstatusEdit').value;
    if(idSistemaEdit == ''  || strNombreSistemaEdit == '' || strAbreviacionEdit == '' || intEstatusEdit == ''){
        swal.fire("Atención","Atención todos los campos son obligatorios","warning");
        return false;
    }
    divLoading.style.display = "flex";
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+'/Sistemas/updateSistema';
    var formData = new FormData(formEditSistema);
    request.open("POST",ajaxUrl,true);
    request.send(formData);
    request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status == 200) {
            var objData = JSON.parse(request.responseText);
            if(objData.estatus){
                $('#modal_edit_sistema').modal("hide");
                formEditSistema.reset();
                swal.fire("Sistemas", objData.msg, "success").then((result) =>{
                    $('.close').click();
                });
                tableSistemas.api().ajax.reload();  
            }else{
                swal.fire("Error", objData.msg, "error");
            } 
        }else{
            swal.fire("Error", "No se pudo actualizar los datos", "error");
        }
        divLoading.style.display = "none";
        return false;
    } 
});

function fnDelSistema(idSistema)
{
    if(idSistema != null || idSistema != ''){
        swal.fire({
            icon: "question",
            title: "Eliminar sistema educativo",
            text: "¿Quiere eliminar el sistema educativo?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6', //add
            cancelButtonColor: '#d33', //add
            confirmButtonText: "¡Si, eliminar!",
            cancelButtonText: "¡No, cancelar!"
        }). then ((result) =>{
            if(result.isConfirmed){
                let url = `${base_url}/Sistemas/delSistema/${idSistema}`;
                fetch(url)
                .then((res) => res.json())
                .then(resultado =>{
                    if(resultado.estatus){
                        swal.fire("Sistemas educativos", resultado.msg, "success");
                        tableSistemas.api().ajax.reload();  
                    }else{
                        swal.fire("Error", resultado.msg, "error");
                    }   
                }).catch(err =>{throw err}); 
            }
        })
    }
}