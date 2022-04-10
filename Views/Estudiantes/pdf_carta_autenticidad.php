<?php
date_default_timezone_set('America/Mexico_City');
$formatFechaActual = iconv('ISO-8859-2', 'UTF-8', strftime("%A, %d de %B de %Y", strtotime(date('Y-m-d'))));
$userAlumno = $data['datos']['nombre_persona'].' '.$data['datos']['ap_paterno'].' '.$data['datos']['ap_materno'];
$userAtencion = 'Jose Santiz Ruiz';
?>

<html>
<style>
    @page { margin: 168px 29px; }
    #header_pdf { position: fixed; left: 0px; top: -169px; right: 0px; height: 130px; text-align: center; font-size: 10px; }
    #footer_pdf { position: fixed; left: 0px; bottom: -169px; right: 0px; height: 50px; font-size:9px; }
    #footer_pdf .page:after { content: counter(page, upper-roman); }
background-image: url(<?php echo media() ?>/images/logo-seuat-contorno-ok.png);
background-repeat: no-repeat;
background-size:100%;
background-position: bottom left;
  .titulo{
    text-align: center;
    font-size:10px;
    font-weight: bold; /*300*/
    float: left;
    width: 100%;
    height: 25px;
    color: #01579b;
  }
  .titulo_plantel{
    text-align: center;
    font-size:16px;
    font-weight: bold; /*300*/
    float: left;
    width: 100%;
    height: 25px;
  }
  #contenedor_cabecera{
    width:100%;
    margin-top:27px; /*30px*/
    height: 90px;
  }
  .c_logo_left{
    width:15%;
    float: left;
    height: 90px;
    text-align: left;
  }
  .c_logo_right{
    width: 20%;
    float: left;
    height:90px;
    text-align: right;
  }
  .c_encabezado{
    width:65%;
    float: left;
    height: 90px;
  }
  #contenedor_firmas{
    vertical-align: bottom;
    position:absolute;
    bottom:0;
    left:0;
    margin-bottom: 70px;
    min-height: 70px;
    width:100%;
    text-align: center;
  }
  #content_pdf{
    font-size: 18px;
    width: 100%;
    margin-top: 12px;

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

</style>
<div id="header_pdf">
    <div id="contenedor_cabecera">
        <div class="c_logo_left">
          <img src="<?php echo(media().'/images/logo_iessic.jpg') ?>" alt="logo SEUAT" height="76" width="76">
        </div>
        <div class="c_encabezado">
            <table class="sin_borde">
                <tr>
                    <th colspan="5" style="font-size:18px;font-weight: bold; text-align: left;"><?php echo(strtoupper($data['datos']['nombre_sistema'])) ?></th>
                </tr>
                <tr>
                    <th colspan="5" style="font-size:12px;font-weight: bold; text-align: left;"><?php  echo(strtoupper($data['datos']['nombre_plantel'])) ?><br><br></th>
                </tr>
                <tr>
                    <td colspan="5" style="padding-top: -15px; font-size: 8px; text-align: left;">
                        <?php echo($data['datos']['categoria']) ?><br>
                        CLAVE: <?php echo($data['datos']['cve_centro_trabajo'])?><br>
                        <?php echo($data['datos']['ubicacion'])?>.
                        <br><br>
                    </td>
                </tr>
                <tr>
                    <th colspan="5"></th>
                </tr>
            </table>
        </div>
    </div>
    <div id="footer_pdf">
        <p>
            <small><br><i> Documento Impreso el <?php echo DATE('d-m-Y H:i:s') ?> por Jose Santiz Ruiz</i></small>
        </p>
    </div>
    <div class="col-12" style="text-align:center">
        <h4 style="font-size: 18px;">CARTA DE AUTENTICIDAD Y VERACIDAD</h4>
    </div>
    <div class="cabecera">
        <div>
            <div class="row">
                <div class="col-12" style="text-align:right">
                    <p>Tuxtal Gutierrez , <?php echo $formatFechaActual ?></b>
                    </p>
                </div>
            </div>
        </div>
        <div></div>   
    </div><br><br><br>
    <div id="content_pdf">
        
        <div class="col-12" style="text-align:justify;text-justify:inter-word;line-height=150%">
            <p>&nbsp;&nbsp;&nbsp;&nbsp;Por medio de la presente manifiesto bajo protesta de decir verdad que toda la documentación entregada, en
                especial el Certificado de Estudios, son auténticos y cuenta con validéz legal ya que en su momento fueron expedidos
                por las autoridades correspondientes conforme a lo establecido por la ley. 
            </p>
            <p>&nbsp;&nbsp;&nbsp;&nbsp;Por lo anterior hago constar que asumo toda la responsabilidad que a mi conlleve derivado de la veracidad
                y autenticidad de la documentación entregada para los fines de la Institución.
            </p>
        </div><br><br><br><br><br><br><br><br><br>
        <div>
        <div class="col-6" style="text-align:center">
            <h4>Alumno(a)</h4><br>
            <hr style="width:50%">
            <p><?php echo($userAlumno) ?></p>
        </div>
        <div class="col-6" style="text-align:center">
            <h4>Personal administrativo:</h4><br>
            <hr style="width:50%">
            <p><?php echo $userAtencion ?></p>
        </div>
    </div>
    </div>
</div>
</html>