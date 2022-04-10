let tableAdministracionTutores;
let rowTable = "";
let divLoading = document.querySelector("#divLoading");

//SELECT PARA EDITAR
// window.addEventListener('load', function(){
//     fntSelectEditSalonComPerio();
//     fntSelectEditSalonComGrado();
//     fntSelectEditSalonComGrupo();
//     fntSelectEditSalonComPlantel();
//     fntSelectEditSalonComTurno();
//     fntSelectEditSalonComSalon();
// }, false);


document.addEventListener('DOMContentLoaded', function(){

    tableAdministracionTutores = $('#tableAdministracionTutores').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": " "+base_url+"/Assets/plugins/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Administracion_tutores/getAdministracionTutores",
            "dataSrc":""
        },
        "columns":[
            {"data":"idTut"},
            {"data":"nombre_tutor"},
            {"data":"direccion"},
            {"data":"tel_celular"},
            {"data":"tel_fijo"},
            {"data":"email"},
            {"data":"Estatus"},
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




    // Actualizar
	if(document.querySelector("#formAdminTutoresUp")){
		let formAdminTutoresUp = document.querySelector("#formAdminTutoresUp");
		formAdminTutoresUp.onsubmit = function(e) {
			e.preventDefault();

            let intIdAdminisTurores = document.querySelector('#idAdminTutoresUp').value;
            let strNombreTutor = document.querySelector('#txtNombreTutorUp').value;
            let strApellidoPatTutor = document.querySelector('#txtApellidoPatTutorUp').value;
            let strApellidoMatTutor = document.querySelector('#txtApellidoMatTutorUp').value;
            let strDirreccion = document.querySelector('#txtDirreccionUp').value;
            let strTelCelular = document.querySelector('#txtTelCelularUp').value;
            let strTelFijo = document.querySelector('#txtTelFijoUp').value;
            let strCorreo = document.querySelector('#txtCorreoUp').value;
			let intEstatus = document.querySelector('#listEstatusUp').value;
			let strFecha_Actualizacion = document.querySelector('#txtFecha_ActualizacionUp').value;
			let intId_Usuario_Actualizacion = document.querySelector('#txtId_Usuario_ActualizacionUp').value;

			if(strNombreTutor == '' || strApellidoPatTutor == '' || strApellidoMatTutor == '' || strDirreccion == '' || strTelCelular == '' || strTelFijo == '' || strCorreo == '' || intEstatus == '' || intId_Usuario_Actualizacion == '')
			{
				swal.fire("Atención", "Atención todos los campos son obligatorios", "warning");
				return false;
			} 
			
			divLoading.style.display = "flex";
			let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
			let ajaxUrl = base_url+'/Administracion_tutores/setAdminisTutores_up';
			let formData = new FormData(formAdminTutoresUp);
			request.open("POST",ajaxUrl,true);
			request.send(formData);

			request.onreadystatechange = function(){
				if(request.readyState == 4 && request.status == 200){
					
					let objData = JSON.parse(request.responseText);
					if(objData.estatus)
					{
						if(rowTable == ""){
							tableAdministracionTutores.api().ajax.reload();
						}else{
							htmlEstatus = intEstatus == 1 ?
                            '<span class="badge badge-dark">Activo</span>' :
							'<span class="badge badge-secondary">Inactivo</span>';
							rowTable.cells[1].textContent = strNombreTutor + " "+strApellidoPatTutor + " "+strApellidoMatTutor;
                            rowTable.cells[2].textContent = strDirreccion;
                            rowTable.cells[3].textContent = strTelCelular;
                            rowTable.cells[4].textContent = strTelFijo;
                            rowTable.cells[5].textContent = strCorreo;
                            rowTable.cells[6].innerHTML = htmlEstatus;
							rowTable = "";
						}
																			
						$('#ModalFormAdministracTutoresEditar').modal('hide');
						formAdminTutoresUp.reset();	
						swal.fire("Generaciones ", objData.msg, "success");

					}else{
						swal.fire("Error", objData.msg , "error");
					}
				}
				divLoading.style.display = "none";
				return false;
			}
		}
	}


},false );




//EDITAR ADMINISTRACION TUTORES 
function fntEditAdminisTutores(element, id){
    rowTable = element.parentNode.parentNode.parentNode.parentNode.parentNode;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Administracion_tutores/getAdminisTut/'+id;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){

            let objData = JSON.parse(request.responseText);
            if(objData.estatus){
                document.querySelector("#idAdminTutoresUp").value = objData.data.id;
                document.querySelector("#txtNombreTutorUp").value = objData.data.nombre_tutor;
                document.querySelector("#txtApellidoPatTutorUp").value = objData.data.appat_tutor;
                document.querySelector("#txtApellidoMatTutorUp").value = objData.data.apmat_tutor;
                document.querySelector("#txtDirreccionUp").value = objData.data.direccion;
                document.querySelector("#txtTelCelularUp").value = objData.data.tel_celular;
                document.querySelector("#txtTelFijoUp").value = objData.data.tel_fijo;
                document.querySelector("#txtCorreoUp").value = objData.data.email;
                document.querySelector("#txtId_Usuario_ActualizacionUp").value = 1;

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
                document.querySelector("#listEstatusUp").innerHTML = htmlSelect;
                $('#ModalFormAdministracTutoresEditar').modal('show');
            }else{
                swal.fire("Error", objData.msg , "error");
            }
        }
    }
}


//FUNTION PARA ELIMINAR TUTORES
function fntDelAdminisTutores(id){
    swal.fire({
        icon: "question",
        title: "Eliminar tutor",
        text: "¿Realmente quiere eliminar el tutor seleccionada?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#045FB4',
		cancelButtonColor: '#d33',
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!"
    }). then((result) =>{

        if(result.isConfirmed)
        {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Administracion_tutores/delAdminisTutores';
            let strData = "idTut="+id;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.estatus)
                    {
                        swal.fire("Eliminar!", objData.msg, "success");
                        tableAdministracionTutores.api().ajax.reload();
                    }else{
                        swal.fire("Atención", objData.msg, "error");
                    }
                }
            }
        }
    });
}


//CERRAR MODAL
$('.cerrarModal').click(function(){
    $('#ModalFormAdministracTutoresEditar').modal('hide');
});