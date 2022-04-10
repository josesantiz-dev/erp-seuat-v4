<?php
    $medidaTicket = 180;
    $datosInstitucion = $data['datosInstitucion'];
    $datosVenta = $data['datos_venta'];
    $datosAlumno = $data['datos_alumno'];
?>
<!DOCTYPE html>
<html>
<head>
    <style>
        * {
            font-size: 12px;
            font-family: 'DejaVu Sans', serif;
        }
        .ticket {
            margin: 5px;
            width: <?php echo $medidaTicket ?>px;
            max-width: <?php echo $medidaTicket ?>px;
        }
        td,th,tr,table {
            border-top: 1px solid black;
            border-collapse: collapse;
            margin: 0 auto;
        }

        td.precio {
            text-align: right;
            font-size: 11px;
        }
        #datos_alumno{
            font-size:8px;
        }
        td.cantidad {
            font-size: 11px;
        }
        th , .centrado, td.producto{
            text-align: center;
        }
        img {
            max-width: inherit;
            width: inherit;
        }
       /*  * {
            margin: 0;
            padding: 0;
        } */

        .ticket {
            margin: 0;
            padding: 0;
        }
        .encabezado{
            font-size: 9px;
            font-style:bold
        }
        .subencabezado{
            font-size: 8px;
        }
        .direccion{
            font-size: 6px;
        }
        .footer p{
            font-size:10px;
        }
    </style>
</head>

<body>
    <div class="ticket centrado">
        <p class="encabezado"><?php echo(strtoupper($datosInstitucion['nombre_sistema'])) ?></p>
        <p class="subencabezado"> CLAVE: <?php echo($datosInstitucion['cve_centro_trabajo']) ?></p>
        <p class="direccion"><?php echo($datosInstitucion['domicilio'].','.$datosInstitucion['colonia'].','.$datosInstitucion['municipio'].','.$datosInstitucion['estado'].', México, CP:'.$datosInstitucion['cod_postal']) ?></p>
        <table>
            <tr>
                <td class="cantidad" colspan=2>
                    <p style="font-size:8px">Folio: <?php echo($datosVenta[0]['folio'])?></p>
                </td>
                <td class="precio" colspan=2>
                    <p style="font-size:8px"><?php echo($datosVenta[0]['fecha']) ?></p>
                </td>
            </tr>
            <tr>
                <td class="cantidad" colspan=3>
                    <p id="datos_alumno">Plantel: <?php echo($datosInstitucion['abreviacion_sistema'].' '.$datosInstitucion['municipio'])?></p>
                    <p id="datos_alumno">Estudiante: <?php echo($datosAlumno['nombre_persona'].' '.$datosAlumno['ap_paterno'].' '.$datosAlumno['ap_materno']) ?></p>
                    <p id="datos_alumno">Carrera: <?php echo($datosAlumno['nombre_carrera']) ?></p>
                    <p id="datos_alumno">Matricula: <?php echo($datosAlumno['matricula_interna'])?></p>
                </td>
                <td class="precio">
                </td> 
            </tr>
            <thead>
                <tr class="centrado">
                    <th class="cantidad">#</th>
                    <th class="producto">Desc.</th>
                    <th class="producto">P.U</th>
                    <th class="precio">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                foreach ($datosVenta as $servicio) {
                    $total += $servicio["cantidad"] * $servicio["total"];
                ?>
                    <tr>
                        <td class="cantidad"><p style="font-size:8px"><?php echo($servicio['cantidad']) ?></p></td>
                        <td class="producto"><p style="font-size:8px"><?php echo($servicio['nombre_servicio'])//echo number_format($producto["cantidad"], 2) ?></p></td>
                        <td class="precio"><p style="font-size:8px">$<?php echo($servicio['precio_unitario'])?></p></td>
                        <td class="precio"><p style="font-size:8px">$<?php echo($servicio['total'])?></p></td>
                    </tr>
                <?php } ?> 
            </tbody>
            <tr>
                <td class="cantidad"></td>
                <td class="producto">
                    <strong>TOTAL</strong>
                </td>
                <td class="precio">
                    $<?php echo number_format($total, 2) ?>
                </td>
            </tr>
        </table><br><br> 
        <div class="footer">
            <p class="centrado"><strong>¡GRACIAS</strong> <i>haz hecho una elección inteligente!</i>
            <br>www.seuat.mx</p>
        </div>
    </div>
</body>
</html>