var span = function (data) {
    frase=data['parse']['text']['*'];
    var html = $(frase);
    var tabla_ = html[0].getElementsByTagName("td");
    let nombre_autor = tabla_[4].getElementsByTagName("a")[0].innerHTML;
    let frase_ = tabla_[2].innerHTML.replace(/<[^>]*>?/g, '');
    let imagen_url = tabla_[0].getElementsByTagName("img")[0].getAttribute("src");
    let origen = tabla_[4].getElementsByTagName("small")[0].innerHTML.replace(/<[^>]*>?/g, '');
    let htmlFrase = "<p><b>"+"\"</b>"+frase_+"<b>\"</b></p><div style='text-align:right'><i style='font-size:12'><span>"+origen+"</span></i></div>";
    let url = `${base_url}/Dashboard/obtenerFrase`;
    fetch(url).then((res) => res.json()).then(resultado =>{
        if(resultado){
            Swal.fire({
                title: nombre_autor,
                html: htmlFrase,
                imageUrl: imagen_url,
                imageWidth: 200,
                imageHeight: 200,
                imageAlt: "Custom image",
            })
        }else{

        }
    }).catch(err => { throw err});
};
var frase = function () {
    /* var titulo='{{Plantilla:Frase-jueves}}';
    var titulo2='{{Plantilla:Portada/temporal/Cita_del_día}}'; */
    var now = new Date ();
    var day = now.getDay();
    if(day == 0) titulo='{{Plantilla:Frase-domingo}}';
    if(day == 1) titulo='{{Plantilla:Frase-lunes}}';
    if(day == 2) titulo='{{Plantilla:Frase-martes}}';
    if(day == 3) titulo='{{Plantilla:Frase-miércoles}}';
    if(day == 4) titulo='{{Plantilla:Frase-jueves}}';
    if(day == 5) titulo='{{Plantilla:Frase-viernes}}';
    if(day == 6) titulo='{{Plantilla:Frase-sábado}}';
    url = 'http://es.wikiquote.org/w/api.php?action=parse&text='+titulo+'&format=json&callback=span';
    var elem = document.createElement('script');
    elem.setAttribute('src', url);
    elem.setAttribute('type','text/javascript');
    document.getElementsByTagName('head')[0].appendChild(elem);
};
frase();