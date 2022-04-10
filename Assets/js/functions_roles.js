var tableRoles;
var divLoading = document.querySelector("#divLoading");
/*
$('.dataTables_wrapper').DataTable( {
	fixedColumns: {
		heightMatch: 'none'
	}}
	);
*/
/*
$('#tableRoles').dataTable( {
	scrollY: 100,
	scrollCollapse: true,
	"paging": true,
  } );
*/
document.addEventListener('DOMContentLoaded', function(){

	tableRoles = $('#tableRoles').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	//url:"<?php echo media(); ?>/plugins/Spanish.json"
        	"url": " "+base_url+"/Assets/plugins/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Roles/getRoles",
            "dataSrc":""
        },
        "columns":[
            {"data":"id"},
            {"data":"nombre_rol"},
            {"data":"descripcion"},
            {"data":"estatus"},
            {"data":"options"}
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
	    "order": [[ 0, "desc" ]],
	    "iDisplayLength": 25
    });


	//Nuevo Rol
	var formRol = document.querySelector("#formRol");
	formRol.onsubmit = function(e) {
		e.preventDefault();

		var intIdRol = document.querySelector('#idRol').value;
		var strNombre = document.querySelector('#txtNombre').value;
		var strDescripcion = document.querySelector('#txtDescripcion').value;
		var intEstatus = document.querySelector('#listEstatus').value;

		if (strNombre == '' || strDescripcion == '' || intEstatus == '')
		{
			swal.fire("Atención", "Atención todos los campos son obligatorios", "warning");
			return false;
		}
		divLoading.style.display = "flex";
		var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
		var ajaxUrl = base_url+'/Roles/setRol';
		var formData = new FormData(formRol);
		request.open("POST",ajaxUrl,true);
		request.send(formData);
		request.onreadystatechange = function() {
			//console.log(request);
			if(request.readyState == 4 && request.status == 200) {
					//console.log(request.responseText);
				var objData = JSON.parse(request.responseText);
				if(objData.estatus)
				{
					$('#modalFormRol').modal("hide");
					formRol.reset();	
					swal.fire("Roles de usuario", objData.msg, "success");
					tableRoles.api().ajax.reload();
					
				}else{
					swal.fire("Error", objData.msg, "error");
				}
			}
 			divLoading.style.display = "none";
            return false;
		}
	}

});

$('#tableRoles').DataTable();

function openModal() {

	document.querySelector('#idRol').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Rol";
    document.querySelector("#formRol").reset();
	$('#modalFormRol').modal('show');
}

window.addEventListener('load', function() {
	//fntEditRol();
	//fntDelRol();
   //fntPermisos();
}, false);

function fntEditRol(idrol){
    document.querySelector('#titleModal').innerHTML ="Actualizar Rol";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML ="Actualizar";
	
    var idrol = idrol;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl  = base_url+'/Roles/getRol/'+idrol;
    request.open("GET",ajaxUrl ,true);
    request.send();
    request.onreadystatechange = function(){

        if(request.readyState == 4 && request.status == 200){
            var objData = JSON.parse(request.responseText);
            if(objData.estatus)
            {
                document.querySelector("#idRol").value = objData.data.id;
                document.querySelector("#txtNombre").value = objData.data.nombre_rol;
                document.querySelector("#txtDescripcion").value = objData.data.descripcion;

                if(objData.data.estatus == 1)
                {
                    var optionSelect = '<option value="1" selected class="notBlock">Activo</option>';
                }else{
                    var optionSelect = '<option value="2" selected class="notBlock">Inactivo</option>';
                }
                var htmlSelect = `${optionSelect}
                                  <option value="1">Activo</option>
                                  <option value="2">Inactivo</option>
                                `;
                document.querySelector("#listEstatus").innerHTML = htmlSelect;
                $('#modalFormRol').modal('show');
            }else{
                swal.fire("Error", objData.msg , "error");
            }
        }
    }

}

/*
	var btnEditRol = document.querySelectorAll(".btnEditRol");
	btnEditRol.forEach(function(btnEditRol){
		btnEditRol.addEventListener('click', function(){
			
			document.querySelector('#titleModal').innerHTML = "Actualizar Rol";
			document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
			document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
			document.querySelector("#btnText").innerHTML = "Actualizar";
			
			$('#modalFormRol').modal('show');
		});
	});
}*/


function openModal(){
	rowTable = "";
	$('#ModalFormRol').modal({
		backdrop: 'static',
		keyboard: false,
	});

	$('#ModalFormRol').modal('show');
}

function openModalPermisos(){
	rowTable = "";
	$('#modalFormPermisos').modal({
		backdrop: 'static',
		keyboard: false,
	});

	$('#modalFormPermisos').modal('show');
}

$(".cerrarModal").click(function(){
	$("#ModalFormRol").modal('hide')
});

$(".cerrarModal").click(function(){
	$("#modalFormPermisos").modal('hide')
});





function fntDelRol(id) {
			var idRol = id;
			swal.fire({
				icon: "question",
				title: "Eliminar Rol",
				text: "¿Realmente quiere eliminar el Rol?",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: '#3085d6', //add
				cancelButtonColor: '#d33', //add
				confirmButtonText: "Si, eliminar!",
				cancelButtonText: "No, cancelar!"
				//closeOnConfirm: false,
				//closeOnCancel: true
			}). then((result) => {
        
				if (result.isConfirmed) 
				{
					var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
					var ajaxUrl = base_url+'/Roles/delRol'; // Crear Método delRol en el controlador Roles.php 
					var strData = "idRol="+idRol;
					//alert(idrol);
					request.open("POST",ajaxUrl,true);
					request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					request.send(strData);
					request.onreadystatechange = function(){
						if(request.readyState == 4 && request.status == 200){
							var objData = JSON.parse(request.responseText);
							if(objData.estatus)
							{
								swal.fire("Eliminar!", objData.msg , "success");
								tableRoles.api().ajax.reload(); //(function(){
									//fntEditRol();
									//fntDelRol();
									//fntPermisos();
								//});
							} else {
								swal.fire("Atención!", objData.msg , "error");
							}
						}
					}
				}
			});
	//	})
   // });
}



function fntPermisos(idrol){
	//var btnPermisosRol = document.querySelectorAll(".btnPermisosRol");
   //btnPermisosRol.forEach(function(btnPermisosRol){
      //btnPermisosRol.addEventListener('click', function(){

         //var idrol = this.getAttribute("r1");
         var idrol = idrol;
         var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
         var ajaxUrl = base_url+'/Permisos/getPermisosRol/'+idrol;
         request.open("GET", ajaxUrl, true);
         request.send();

         request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
            //console.log(request.responseText);
            document.querySelector('#contentAjax').innerHTML = request.responseText;
            $('.modalFormPermisos').modal('show');
			document.querySelector('#formPermisos').addEventListener('submit',fntSavePermisos,false);
            }
         }
         
    //  });
 //  });
}


function fntSavePermisos(evnet){
	evnet.preventDefault();
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	var ajaxUrl = base_url+'/Permisos/setPermisos';
	var formElement = document.querySelector("#formPermisos");
	var formData = new FormData(formElement);
	request.open("POST", ajaxUrl, true);
	request.send(formData);

	request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var objData = JSON.parse(request.responseText);
            if(objData.estatus)
            {
                swal.fire("Permisos de usuario", objData.msg ,"success");
            }else{
                swal.fire("Error", objData.msg , "error");
            }
        }
    }
}



function ActivarCheckbox(casilla) 
{
	casillaCheckbox=document.getElementsByTagName('input'); //Rescatamos controles tipo Input
	for(i=0;i<casillaCheckbox.length;i++) //Ejecutamos y recorremos los controles
	{
		if(casillaCheckbox[i].type == "checkbox") // Ejecutamos si es una casilla de verificacion
		{
			casillaCheckbox[i].checked=casilla.checked; // Si el input es CheckBox se aplica la funcion ActivarCasilla
		}
	}
}

