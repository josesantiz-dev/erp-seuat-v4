<?php
date_default_timezone_set('America/Mexico_City');
$formatFechaActual = iconv('ISO-8859-2', 'UTF-8', strftime("%d/%m/%Y", strtotime(date('Y-m-d'))));
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Your receipt</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @page { margin: 168px 29px; }
        #header_pdf { position: fixed; left: 0px; top: -169px; right: 0px; height: 130px; text-align: center; font-size: 10px; }
        #footer_pdf { position: fixed; left: 0px; bottom: -169px; right: 0px; height: 50px; font-size:9px; }
        #footer_pdf .page:after { content: counter(page, upper-roman); }
        #content_pdf{
            font-size: 11px;
            width: 100%;
            margin-top: 12px;
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
        .linea-titulo{
            width: 75px;
            height:2px;
            margin:2px auto 0px;
        }
        .edo_cta {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            padding-top: 0px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 14px;
            line-height: 24px;
        }
        .edo_cta table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-spacing: 0;
            border-collapse: collapse;
        }
        .edo_cta table tr.heading {
            font-size: 12px;
        }
        .edo_cta table tr.item {
            font-size: 12px;
            line-height:20px;
        }
        .edo_cta table td {
            padding: 5px;
            vertical-align: top;
        }
        .edo_cta table tr.top table td {
            padding-bottom: 20px;
        }
        .edo_cta table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }
        .edo_cta table tr.information table td {
            padding-bottom: 40px;
        }
        .edo_cta table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }
        .edo_cta table tr.item td{
            border-bottom: 1px solid #eee;
        }
        .text-align-right {
            text-align: right;
        }
        /*Sin borde*/
        table.sin_borde{border:0px solid #ffffff; width: 100%;}
    </style>
</head>

<div id="header_pdf">
    <div id="contenedor_cabecera">
        <div class="c_logo_left">
          <img src="<?php echo(media().'/images/logo_iessic.jpg') ?>" alt="logo SEUAT" height="76" width="76">
        </div>
        <div class="c_encabezado">
            <table class="sin_borde">
                <tr>
                    <th colspan="5" style="font-size:18px;font-weight: bold; text-align: left;"><?php echo(strtoupper($data['data']['datos']['nombre_sistema'])) ?></th>
                </tr>
                <tr>
                    <th colspan="5" style="font-size:12px;font-weight: bold; text-align: left;"><?php  echo(strtoupper($data['data']['datos']['nombre_plantel'])) ?><br><br></th>
                </tr>
                <tr>
                    <td colspan="5" style="padding-top: -15px; font-size: 8px; text-align: left;">
                        <?php echo $data['data']['datos']['categoria'] ?><br>
                        CLAVE: <?php echo $data['data']['datos']['cve_centro_trabajo'] ?><br>
                        <?php echo $data['data']['datos']['domicilio'].','.$data['data']['datos']['colonia'].','.$data['data']['datos']['municipio'].','.$data['data']['datos']['estado'].', Mexico, CP:'.$data['data']['datos']['cod_postal'] ?>
                        <br><br>
                    </td>
                </tr>
                <tr>
                    <th colspan="5"></th>
                </tr>
            </table>
        </div>
        <div class="c_logo_right">
            <table class="sin_borde">
                <tr style="background-color:#F2F2F2; ">
                    <th colspan="5" style="font-size:16px;font-weight: bold; text-align: right; vertical-align:middle; padding: 15px 7px 15px 5px">F:10225</th>
                </tr>
            </table>
        </div>
    </div>
    <div id="footer_pdf">
        <p>
            <small><br><i> Documento Impreso el <?php echo DATE('d-m-Y H:i:s') ?> por Jose Santiz Ruiz</i></small>
        </p>
    </div>
    <div id="content_pdf">
        <div style="width:759px; font-size:16px; font-weight: bold; letter-spacing: 0.2em; text-align: center; "> Estado de cuenta del <?php echo $formatFechaActual ?></div>
        <div class="linea-titulo" style="margin-bottom:20px; "></div>
    </div>
    <div class="edo_cta">
            <table>
                <tr class="information">
                    <td colspan="4">
                        <b>Nombre del alumno</b>: <?php echo $data['data']['datos']['nombre_persona'].' '.$data['data']['datos']['ap_paterno'].' '.$data['data']['datos']['ap_materno'] ?><br>
                        <b>Numero de cuenta</b>: <?php echo $data['data']['datos']['matricula_interna'] ?><br>
                        <b>Plantel</b>: <?php echo $data['data']['datos']['nombre_plantel'] ?><br>
                        <b>Carrera</b>: <?php echo $data['data']['datos']['nombre_carrera'] ?><br>
                        <b>Periodo actualmente cursado</b>: <?php echo $data['data']['datos']['nombre_periodo']?>
                    </td>
                    <td> </td>
                    <td colspan="3" style="text-align:right">
                        <br><br>SALTO TOTAL: <b>$ <?php echo formatoMoneda($data['data']['totalSaldo']) ?></b>
                    </td>
                </tr>
                <tr>
                    <td colspan="8" style="text-align:center">SERVICIOS</td>
                </tr>
                <tr class="heading">
                    <td>Fecha</td>
                    <td>Cantidad</td>
                    <td>Codigo servicio</td>
                    <td>Concepto</td>
                    <td>Cargo</td>
                    <td>Recargo</td>
                    <td>Abono</td>
                    <td class="text-align-right">Saldo</td>
                </tr>
                <?php foreach ($data['edo_cta'] as $key => $value){
                    if($value['codigo_servicio'] != 'CM'){ ?>
                        <tr class="item">
                            <td><?php echo $value['fecha_pago'] ?></td>
                            <td><?php echo $value['cantidad'] ?></td>
                            <td><?php echo $value['codigo_servicio'] ?></td>
                            <td><?php echo $value['nombre_servicio'] ?></td>
                            <td><?php echo $value['cargo'] ?></td>
                            <td><?php echo $value['recargo'] ?></td>
                            <td><?php echo $value['abono'] ?></td>
                            <td class="text-align-right"><?php
                               if($value['pagado'] == true){
                                   echo '$ 0.00';
                               }else{
                                   echo ($value['precio_unitario']);
                               }
                           ?></td></tr>
                    <?php }else{?>
                <?php }}?>
                <tr class="total">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td colspan="3" style="text-align:right">
                    <b>Total saldo: $ <?php echo formatoMoneda($data['data']['saldoServicios']) ?></b>
                    </td>
                </tr>
            </table>

            <table>
                <tr>
                    <td colspan="8" style="text-align:center">COLEGIATURAS</td>
                </tr>
                <tr class="heading">
                    <td>Fecha</td>
                    <td>Cantidad</td>
                    <td>Codigo servicio</td>
                    <td>Concepto</td>
                    <td>Cargo</td>
                    <td>Recargo</td>
                    <td>Abono</td>
                    <td class="text-align-right">Saldo</td>
                </tr>
                <?php foreach ($data['edo_cta'] as $key => $value){
                    if($value['codigo_servicio'] == 'CM'){ ?>
                        <tr class="item">
                            <td><p style="font-size:10px"><?php echo $value['fecha_pago'] ?></p></td>
                            <td><p style="font-size:10px"><?php echo $value['cantidad'] ?></p></td>
                            <td><p style="font-size:10px"><?php echo $value['codigo_servicio'] ?></p></td>
                            <td><p style="font-size:10px"><?php echo $value['nombre_servicio'] ?></p></td>
                            <td><p style="font-size:10px"><?php echo $value['cargo'] ?></p></td>
                            <td><p style="font-size:10px"><?php echo $value['recargo'] ?></p></td>
                            <td><p style="font-size:10px"><?php echo $value['abono'] ?></p></td>
                            <td class="text-align-right"><?php
                               if($value['pagado'] == true){
                                   echo '$ 0.00';
                               }else{
                                   echo ($value['precio_unitario']);
                               }
                           ?></td></tr>
                    <?php }else{?>
                <?php }}?>
                <tr class="total">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td colspan="3" style="text-align:right">
                    <b>Total saldo: $ <?php echo formatoMoneda($data['data']['saldoColegiaturas']) ?></b>
                    </td>
                </tr>
            </table>
        </div>
</div>
</html>