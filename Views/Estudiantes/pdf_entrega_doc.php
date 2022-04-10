<?php
setlocale(LC_ALL,"es_ES");
date_default_timezone_set('UTC');
$userAtencion = 'Jose Santiz Ruiz';
$userAlumno = $data['data'][0]['nombre_persona'].' '.$data['data'][0]['apellidos'];
$formatFechaActual = iconv('ISO-8859-2', 'UTF-8', strftime("%A, %d de %B de %Y", strtotime(date('Y-m-d'))));
$nombreCarrera = $data['data'][0]['nombre_carrera'];
$fechaComEntrega = iconv("UTF-8", "ISO-8859-1", strftime("%A, %d de %B de %Y", strtotime($data['fechaComEntrega'])));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carta compromiso</title>
    <style type="text/css">
        body {
            background-size:100%;
            background-repeat: no-repeat;
            font-family: "Source Sans Pro",-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
        }
        .col-8 {
            float: left;
            width: 66.67%;
            padding: 0px;
        }
        .col-6 {
            float: left;
            width: 50%;
            padding: 0px;
        }
        .col-3 {
            float: left;
            width: 25%;
            padding: 0px;
        }
        .col-2 {
            float: left;
            width: 16.667%;
            padding: 0px;
        }
        .row:after {
            content: "";
            display: table;
            clear: both;
        }
        h3{
            color:white;
            margin: 0px;
        }
        .invoice-box {
        max-width: 800px;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }

    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }

    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }

    .invoice-box table tr td:nth-child(2) {
        text-align: left;
    }

    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }

    .invoice-box table tr.information table td {
        padding-bottom: 10px;
        font-size: 12px;
    }

    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }

    .invoice-box table tr.details td {
        padding-bottom: 1px;
        font-size: 12px;
    }

    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
        font-size: 12px;
    }

    .invoice-box table tr.item.last td {
        border-bottom: none;
    }

    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }


        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }

    /** RTL **/
    .rtl {
        direction: rtl;
    }

    .rtl table {
        text-align: right;
    }

    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    .footer {
   position: fixed;
   left: 0;
   bottom: 0;
   color: black;
   font-size: 10px;
   width: 100%;
    white-space: nowrap;
    text-overflow: ellipsis;
 overflow: hidden;;

}
    </style>
</head>
<body>

    <div class="cabecera">
        <div>
            <div class="row">
                <div class="col-2">
                    <img src="<?php echo(media().'/images/Logo_seuat_color.jpeg') ?>" height="80" width="80">
                </div>
                <div class="col-8" style="text-align:center">
                    <p><b>SISTEMA EDUCATIVO UNIVERSITARIO AZTECA</b><br>
                        <small style="font-size: 13px"><b>INSTITUTO DE ESTUDIOS SUPERIORES "SOR JUANA INES DE LA CRUZ"</b></small><br>
                        <small>Incorporado a la Secretaria de Educacion Publica</small><br>
                        <small>CLAVE: 07PSU0018E</small><br>
                        <small>2a Norte Oriente N° 741, Tuxtla Gutierrez Chiapas</small>
                    </p>
                </div>
                <div class="col-2" style="text-align:right">
                    <img src="<?php echo(media().'/images/logo_iessic.jpg') ?>" height="80" width="80">
                </div>
            </div>
        </div>
        <div></div>   
    </div>
    <div class="col-12" style="text-align:center">
        <h4>CARTA COMPROMISO DE ENTREGA DE DOCUMENTOS
        </h4>
    </div>
    <div class="cabecera">
        <div>
            <div class="row">
                <div class="col-12" style="text-align:right">
                    <p>Tuxtal Gutierrez <?php echo $formatFechaActual ?></b>
                    </p>
                </div>
                <div class="col-12" style="text-align:justify;text-justify:inter-word;line-height=150%">
                    <p>El (la) suscrito(a) <b><?php echo $userAlumno?></b>, alumno(a) de la
                    <b><?php echo $nombreCarrera ?></b>.
                    Me doy por enterado que a más tardar el día<b>*</b>  <?php echo $fechaComEntrega ?>, debo
                    hacer la entrega de los documentos faltantes: 
                    </p>
                </div>
            </div>
        </div>
        <div></div>   
    </div>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="information">
                <td colspan="12">
                    <table>
                        <tr>
                            <td>
                                <b>Lista de documentos: </b>  <?php //echo($data['folio']); ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr> 
            <tr class="heading">
                <td class="col-2">#</td>
                <td class="col-8">Nombre del documento</td>
                <td class="col-2">Estatus</td>
            </tr>
            <?php
                $numeracion = 0;
                if(count($data['docstatus']) != 0){
                    foreach ($data['docstatus'] as $key => $value) {
                        $numeracion += 1;
                        if($value['entrego_cantidad_original'] == 1){
                            $estatus = "Entregado";
                        }else{
                            $estatus = "No entregado";
                        }
                        ?>
                            <tr class="details">
                                <td class="col-2"><b><?php echo $numeracion ?></b></td>
                                <td class="col-8"><?php echo($value['tipo_documento'])?></td>
                                <td class="col-2"><?= $estatus ?></td>
                            </tr>
                        <?php
                        
                    }
                }else{
                    foreach ($data['doc'] as $key => $value) {
                        $numeracion += 1;
                        ?>
                            <tr class="details">
                                <td class="col-2"><b><?php echo $numeracion ?></b></td>
                                <td class="col-8"><?php echo($value['tipo_documento'])?></td>
                                <td class="col-2">No entregado</td>
                            </tr>
                        <?php
                        
                    }
                }
            ?>    
        </table>
    </div>
    <div class="cabecera">
        <div>
            <div class="row">
                <div class="col-12" style="text-align:justify;text-justify:inter-word;line-height: 120%">
                    <p>En caso de no entregar dicho documento en la fecha antes mencionada la Institución Educativa se
                    deslinda de toda responsabilidad, en caso de que surgiera alguna supervisión y no estuviese mi
                    documento bajo resguardo, y esto fuera causa de Baja en forma inmediata y definitiva sin
                    perjuicio para la Institución.
                    Así mismo en caso de que mi fecha de conclusión de los estudios resulta con invasión de ciclo
                    <i>(máximo al 01 de Enero del 2021, la Institución me dará de baja definitiva del
                    sistema sin perjuicio alguno)</i>.
                    Me comprometo a entregar dicho DOCUMENTO a más tardar el día <b><?php echo $fechaComEntrega ?></b>. 
                    </p>
                </div>
            </div>
        </div>
        <div></div>   
    </div>
    <div style='text-align:center'>
        <h4>FIRMAS</h4>   
    </div>
    <div>
        <div class="col-6" style="text-align:center">
            <h4>Alumno(a)</h4><br>
            <hr style="width:50%">
            <p><?php echo $userAlumno ?></p>
        </div>
        <div class="col-6" style="text-align:center">
            <h4>Personal administrativo:</h4><br>
            <hr style="width:50%">
            <p><?php echo $userAtencion ?></p>
        </div>
    </div>
    <div class="footer">
        <p>* El tiempo máximo de la entrega del documento lo define la institución de acuerdo a lo que marque
        la instancia educativa a la que estemos incorporados.</p>
    </div>
</html>