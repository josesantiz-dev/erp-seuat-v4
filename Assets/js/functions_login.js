document.addEventListener('DOMContentLoaded', function(){
    if(document.querySelector("#formLogin")){

        let formLogin = document.querySelector("#formLogin");
        formLogin.onsubmit = function(e){
            e.preventDefault();

            let strNickname = document.querySelector('#txtNickname').value;
            let strPassword = document.querySelector('#txtPassword').value;

            if(strNickname == "" || strPassword == "")
            {
                swal.fire("Por favor", "Escribe un usuario y contraseña.", "error");
                return false;
            }else{
                var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                var ajaxUrl = base_url+'/Login/loginUser';
                var formData = new FormData(formLogin);
                request.open("POST",ajaxUrl,true);
                request.send(formData);

                request.onreadystatechange = function(){

                    if(request.readyState !=4) return;
                    if(request.status == 200){
                        var objData = JSON.parse(request.responseText);
                        if(objData.estatus)
                        {
                            window.location = base_url+'/dashboard';
                        }else{
                            swal.fire("Atención", objData.msg, "error");
                            document.querySelector('#txtPassword').value = "";
                        }
                    }else{
                        swal.fire("Atención","Error en el proceso", "error");
                    }
                    return false;
                }
            }
        }
    }
}, false);