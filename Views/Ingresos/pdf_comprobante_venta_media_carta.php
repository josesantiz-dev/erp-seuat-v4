<?php
date_default_timezone_set('America/Mexico_City');
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
    width: 35%;
    float: left;
    height:90px;
    text-align: right;
  }
  .c_encabezado{
    width:50%;
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
  .linea-titulo{
    width: 75px;
    height:2px;
    margin:2px auto 0px;
    background-color: #A4A4A4;
  }
  #content_pdf{
    font-size: 11px;
    width: 100%;
    margin-top: 12px;

  }
#fila-normal{
  background-color: #eae9e9;
  width:759px; height: 21px; margin-top:7px;
}
.subfila{
  width: 759px;
  display: inline-block;
}

.borde-tabla{
 border-bottom: 1px dashed #ccc;
 padding-bottom:5px;
}
.borde-tabla-dos{
 border-bottom: 1px dashed #fff;
 padding-bottom:5px;
}

table {border-collapse:collapse}

/*borde simple*/
table.borde_simple>thead>tr>th{border:1px solid #9e9e9e;border-radius:0;padding:4px 5px;display:table-cell;text-align:left;vertical-align:middle;border-radius:2px;font-size: 10px;background-color:#eae9e9}
table.borde_simple>thead>tr>td{border:1px solid #9e9e9e;border-radius:0;padding:4px 5px;display:table-cell;text-align:left;vertical-align:middle;border-radius:2px;font-size: 10px}
table.borde_simple>tbody>tr>td{border:1px solid #9e9e9e;border-radius:0;padding:4px 5px;display:table-cell;text-align:left;vertical-align:middle;border-radius:2px;font-size: 10px}
table.borde_simple>tbody>tr>th{border:1px solid #9e9e9e;border-radius:0;padding:4px 5px;display:table-cell;text-align:left;vertical-align:middle;border-radius:2px;font-size: 10px}
table.borde_simple>tfoot>tr>th{border:1px solid #9e9e9e;border-radius:0;padding:4px 5px;display:table-cell;text-align:left;vertical-align:middle;border-radius:2px;font-size: 10px}
table.borde_simple>tfoot>tr>td{border:1px solid #9e9e9e;border-radius:0;padding:4px 5px;display:table-cell;text-align:left;vertical-align:middle;border-radius:2px;font-size: 10px}

/*Sin borde*/
table.sin_borde{border:0px solid #ffffff; width: 100%;}
</style>
<div id="header_pdf">

    <!--Encabezado -->
    <div id="contenedor_cabecera">
        <div class="c_logo_left">
          <img src="<?php echo(media().'/images/logo_iessic.jpg') ?>" alt="logo SEUAT" height="76" width="76">
        </div>
        <div class="c_encabezado">
            <table class="sin_borde">
                <tr>
                    <th colspan="5" style="font-size:12px;font-weight: bold; text-align: left;"><?php echo(strtoupper($data['datosInstitucion']['nombre_sistema']))?></th>
                </tr>
                <tr>
                    <th colspan="5" style="font-size:12px;font-weight: bold; text-align: left;">R.F.C.: <?php echo(strtoupper($data['datosInstitucion']['rfc'])) ?></th>
                </tr>
                <tr>
                    <th colspan="5" style="font-size:11px;font-weight:normal;text-align: left;"><?php echo(strtoupper($data['datosInstitucion']['domicilio'])) ?></th>
                </tr>
                <tr>
                    <th colspan="5" style="font-size:11px;font-weight:norml; text-align: left;"><?php echo(strtoupper($data['datosInstitucion']['colonia'].','.$data['datosInstitucion']['localidad'].','.$data['datosInstitucion']['municipio'].','. ','.$data['datosInstitucion']['estado'].',CP: '.$data['datosInstitucion']['cod_postal'])) ?></th>
                </tr>
            </table>
        </div>
        <div class="c_logo_right">
            <table class="sin_borde">
                <tr><th><th><th></tr>
                <tr>
                    <th colspan="1" style="font-size:12px;font-weight: bold; text-align: left; background-color:#EEEEEE"><?php echo(strtoupper($data['datosInstitucion']['municipio'])) ?></th>
                    <th colspan="2" style="font-size:12px;font-weight: normal; text-align: left; background-color:#CBCBCB">FOLIO: <?php echo(strtoupper($data['datosInstitucion']['codigo_plantel'])) ?></th>
                </tr>
                <tr>
                    <th colspan="3" style="font-size:10px;font-weight: normal; text-align: left; background-color:#F9F7F7"><?php echo(strtoupper($data['datosInstitucion']['domicilio'])) ?></th>
                </tr>
                <tr>
                    <th colspan="3" style="font-size:10px;font-weight:normal; text-align: left; background-color: #F9F7F7"><?php echo(strtoupper($data['datosInstitucion']['colonia'].','.$data['datosInstitucion']['localidad'].','.$data['datosInstitucion']['municipio'].','. ','.$data['datosInstitucion']['estado'].',CP: '.$data['datosInstitucion']['cod_postal'])) ?></th>
                </tr>
            </table>
        </div>
    </div>
    
    <div id="content_pdf">
        <div style="width:759px; font-size:16px; font-weight: bold; letter-spacing: 0.2em; text-align: center;background-color: #eae9e9; "> RECIBO DE INSCRIPCIÓN</div>

        <br>
        <div id="fila-normal" >
            <div class="subfila" style="width: 156px; height: 12px; float:left; background-color: #ffffff; padding: 7px 2px 2px 0px;text-align:left">RECIBÍ DEL (A) ALUMNO (A):</div>
            <div class="subfila" style="width:262px; height: 12px; float:left; background-color: #eae9e9; padding: 5px 2px 4px 4px; text-align: left; "><b><?php echo(strtoupper($data['datos_alumno']['nombre_persona'].' '.$data['datos_alumno']['ap_paterno'].' '.$data['datos_alumno']['ap_materno'])) ?></b></div>
        </div>
        <div id="fila-normal" >
            <div class="subfila" style="width: 96px; height: 12px; float:left; background-color: #ffffff; padding: 7px 2px 2px 0px;text-align:left">PARA ESTUDIAR</div>
            <div class="subfila" style="width:262px; height: 12px; float:left; background-color: #eae9e9; padding: 5px 2px 4px 4px; text-align: left; "><?php echo(strtoupper($data['datos_alumno']['nombre_carrera'])) ?></div>
        </div>
        <div id="fila-normal">
            <div class="subfila" style="width: 180px; height: 12px; float:left; background-color: #ffffff; padding: 7px 2px 2px 0px;text-align:left">POR CONCEPTO DE: <b>INSCRIPCION</b></div>
            <div class="subfila" style="width: 50px; height: 12px; float:left; background-color: #eae9e9; padding: 5px 2px 4px 4px; text-align: left; "><?php 
            if($data['datos_venta']['inscripcion'] != 0){
                echo ('$ '.formatoMoneda($data['datos_venta']['inscripcion']));
            }else{
                echo '';
            }
            ?></div>
            <div class="subfila" style="width: 90px; height: 12px; float:left; background-color: #ffffff; padding: 7px 2px 2px 0px;text-align:left"><b>COLEGIATURA</b></div>
            <div class="subfila" style="width: 50px; height: 12px; float:left; background-color: #eae9e9; padding: 5px 2px 4px 4px; text-align: left; "><?php 
            if($data['datos_venta']['colegiatura'] != 0){
                echo ('$ '.formatoMoneda($data['datos_venta']['colegiatura']));
            }else{
                echo '';
            }
            ?></div>
            <div class="subfila" style="width: 50px; height: 12px; float:left; background-color: #ffffff; padding: 7px 2px 2px 0px;text-align:left"><b>OTROS</b></div>
            <div class="subfila" style="width: 100px; height: 12px; float:left; background-color: #eae9e9; padding: 5px 2px 4px 4px; text-align: left; ">Otros</div>
            <div class="subfila" style="width: 10px; height: 12px; float:left; background-color: #ffffff; padding: 7px 2px 2px 0px;text-align:left"></div>
            <div class="subfila" style="width: 50px; height: 12px; float:left; background-color: #eae9e9; padding: 5px 2px 4px 4px; text-align: left; "><?php 
            if($data['datos_venta']['otros'] != 0){
                echo ('$ '.formatoMoneda($data['datos_venta']['otros']));
            }else{
                echo '';
            }
            ?></div>
        </div>
        <div id="fila-normal">
            <div class="subfila" style="width: 140px; height: 12px; float:left; background-color: #ffffff; padding: 7px 2px 2px 0px;text-align:left">LA CANTIDAD TOTAL DE:</div>
            <div class="subfila" style="width: 200px; height: 12px; float:left; background-color: #eae9e9; padding: 5px 2px 4px 4px; text-align: left; "><?php echo('$ '.formatoMoneda($data['datos_venta']['total'])) ?></div>
            <div class="subfila" style="width: 10px; height: 12px; float:left; background-color: #ffffff; padding: 7px 2px 2px 4px;text-align:left"><b>(</b></div>
            <div class="subfila" style="width: 380px; height: 12px; float:left; background-color: #eae9e9; padding: 5px 2px 4px 4px; text-align: left; "><?php echo(strtoupper(number_words($data['datos_venta']['total'],"pesos","y","centavos"))) ?></div>
            <div class="subfila" style="width: 10px; height: 12px; float:left; background-color: #ffffff; padding: 7px 2px 2px 4px;text-align:left"><b> ).</b></div>
        </div>
        <div id="fila-normal">
            <div class="subfila" style="width: 110px; height: 12px; float:left; background-color: #ffffff; padding: 7px 2px 2px 0px;text-align:left">EN EL PERIODO DEL:</div>
            <div class="subfila" style="width: 150px; height: 12px; float:left; background-color: #eae9e9; padding: 5px 2px 4px 4px; text-align: left; "><?php 
            $mes = date("m",strtotime($data['datos_alumno']['fecha_inicio_periodo']));
            $listaMeses = array('01'=>'Enero','02'=>'Febrero','03'=>'Marzo','04'=>'Abril','05'=>'Mayo','06'=>'Junio','07'=>'Julio','08'=>'Agosto','09'=>'Septiembre','10'=>'Octubre','11'=>'Noviembre','12'=>'Diciembre');
            echo(strtoupper($listaMeses[$mes]));
            ?></div>
            <div class="subfila" style="width: 10px; height: 12px; float:left; background-color: #ffffff; padding: 7px 2px 2px 4px;text-align:left">AL</div>
            <div class="subfila" style="width: 150px; height: 12px; float:left; background-color: #eae9e9; padding: 5px 2px 4px 4px; text-align: left; "><?php 
            $mes = date("m",strtotime($data['datos_alumno']['fecha_fin_periodo']));
            $listaMeses = array('01'=>'Enero','02'=>'Febrero','03'=>'Marzo','04'=>'Abril','05'=>'Mayo','06'=>'Junio','07'=>'Julio','08'=>'Agosto','09'=>'Septiembre','10'=>'Octubre','11'=>'Noviembre','12'=>'Diciembre');
            echo(strtoupper($listaMeses[$mes]));
            ?></div>
            <div class="subfila" style="width: 40px; height: 12px; float:left; background-color: #ffffff; padding: 7px 2px 2px 4px;text-align:left">DEL</div>
            <div class="subfila" style="width: 30px; height: 12px; float:left; background-color: #eae9e9; padding: 5px 2px 4px 4px; text-align: left; "><?php 
            $anio = date("Y",strtotime($data['datos_alumno']['fecha_fin_periodo']));
            echo($anio);
            ?></div>
            <div class="subfila" style="width: 232px; height: 12px; float:left; background-color: #ffffff; padding: 7px 2px 2px 4px;text-align:left">.</div>
        </div>
        <hr>
        <div id="fila-normal">
            <div class="subfila" style="width: 180px; height: 12px; float:left; background-color: #ffffff; padding: 7px 2px 2px 0px;text-align:left">LUGAR Y FECHA DE EXPEDICIÓN:</div>
            <div class="subfila" style="width: 550px; height: 12px; float:left; background-color: #eae9e9; padding: 5px 2px 4px 4px; text-align: left; "><?php 
            $listaMeses = array('01'=>'Enero','02'=>'Febrero','03'=>'Marzo','04'=>'Abril','05'=>'Mayo','06'=>'Junio','07'=>'Julio','08'=>'Agosto','09'=>'Septiembre','10'=>'Octubre','11'=>'Noviembre','12'=>'Diciembre');
            $listaDias = array('1'=>'Lunes','2'=>'Martes','3'=>'Miercoles','4'=>'Jueves','5'=>'Viernes','6'=>'Sabado','7'=>'Domingo');
            echo ($data['datos_usuario']['localidad'].','.$data['datos_usuario']['municipio'].','.$data['datos_usuario']['estado'].' a las '.date("h:i:s A").' del dia '.$listaDias[date("N")].' , '.$listaMeses[date("m")].','.date("Y"));
            ?></div>
        </div><br><br>  
        <div id="fila-normal">
            <div class="subfila" style="width: 425px; height: 12px; float:left; background-color: #ffffff; padding: 7px 2px 2px 0px;text-align:left">
                <table class="tg" style="undefined;table-layout: fixed; width: 425px; margin-top: 0px;">
                    <tr>
                        <th width="50%"></th>
                        <th width="50%"></th>
                    </tr>
                    <tr>
                        <td valign="top" colspan="2">
                            <div style="text-align:justify;font-weight:normal">PRESNTE ESTE RECIBO ANEXANDO LA DOCUMENTACIÓN DE INGRESO AL DEPARTAMENTO DE CONTROL ESCOLAR DE LA INSTITUCIÓN PARA CONCLUIR SUS TRÁMITES DE REGISTRO DE ESCOLARIDAD</div>
                            <br><br><br><br><br>
                            <div class="row">
                                <div style="width:45%;float:left;font-size:10px;text-align:center">NOMBRE
                                    <div style="border-top: 1px solid #000;">DIRECCIÓN DE PROMOCIÓN Y DIFUCIÓN</div>
                                </div>
                                <div style="width:10%;float:left">                            
                                </div>
                                <div style="width:45%;float:right;font-size:10px;text-align:center"><?php echo(strtoupper($data['datos_usuario']['nombre_persona'].' '.$data['datos_usuario']['ap_paterno'].' '.$data['datos_usuario']['ap_materno'])) ?>
                                    <div style="border-top: 1px solid #000;">NOMBRE Y FIRMA DEL CAJERO(A)</div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="subfila" style="width: 425px; height: 12px; float:left; background-color: #fff; padding: 5px 2px 4px 4px; text-align: left; ">
                <div id="container" style="height: 120px;width: 300px;border: 1px solid black;position: relative;">
                    <div id="label" style="position: absolute;top: -10px;left: 90px;height: 20px;width: 100px;background-color: grey;text-align: center">NOTAS: </div>
                        <div style="position:absolute;top:20px;left:10px;text-align:justify">UNA VEZ REQUISITADO EL PRESENTE DOCUMENTO NO PROCEDERÁ LA DEVOLUCIÓN DE CUOTAS PAGADAS POR INSCRIPCIÓN, COLEGIATURA Y OTROS. SOLO PODRÁ APLICARLO COMO INSCRIPCION A LOS PRÓXIMOS PERIODOS DE INICIO O CANJEARLO CON OTRAS PERSONAS PRESENTADA POR EL BENEFICIARIO.</div>
                </div>
            </div>
        </div><br><br><br><br><br><br><br><br><br><br>
        <div id="fila-normal">
            <div class="subfila" style="width: 100%; height: 12px; float:left; background-color: #ffffff; padding: 7px 2px 2px 0px;text-align:left">
                <table class="tg" style="undefined;table-layout: fixed; width: 100%; margin-top: 0px;">    
                    <tr>
                        <td valign="top" colspan="1">
                           <div style="text-align:justify; font-size:8px">ESTAMOS COMPROMETIDOS CON USTED POR EL BUEN USO Y MANEJO QUE DAREMOS A SUS DATOS PERSONALES, POR ESO, EL SISTEMA EDUCATIVO UNIVERSITARIO AZTECA TUXTLA, S.C. CON DOMICILIO EN AVENIDA 2A. NORTE No. 741. ENTRE 6A. Y 8A. ORIENTE COL. CENTRO, TUXTLA GUTIERREZ, CHIAPAS, CP. 29000 CON TEL. 961 61 22329 Y 961 61 37926 PONE A SU DISPOSICIÓN SU AVISO DE PRIVACIDAD PARA CONOCERLO, VISITE NUESTRA PÁGINA <b>WWW.SEUAT.MX</b></div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <?php
        function number_words($valor,$desc_moneda, $sep, $desc_decimal) {
            $arr = explode(".", $valor);
            $entero = $arr[0];
            if (isset($arr[1])) {
                $decimos = strlen($arr[1]) == 1 ? $arr[1] . '0' : $arr[1];
            }
            $fmt = new \NumberFormatter('es', \NumberFormatter::SPELLOUT);
            if (is_array($arr)) {
                $num_word = ($arr[0]>=1000000) ? "{$fmt->format($entero)} de $desc_moneda" : "{$fmt->format($entero)} $desc_moneda";
                if (isset($decimos) && $decimos > 0) {
                    $num_word .= " $sep {$fmt->format($decimos)} $desc_decimal";
                }
            }
            return $num_word;
        }
    ?>
</div>
</html>