<?php
    require_once 'Assets/plugins/dompdf/autoload.inc.php';
    use Dompdf\Dompdf;
    use Dompdf\Options;
    $dompdf = new Dompdf();
    ob_start();
    include "pdf_comprobante_faltante_corte_caja.php";
    $html = ob_get_clean();
    $options = new Options();
    $options->set('isRemoteEnabled', TRUE);
    $dompdf = new DOMPDF($options);
    $dompdf->loadHtml($html,'UTF-8');
    $dompdf->render();
    
    // Aplicamos fondo de imagen para marca de agua
    $canvas = $dompdf->getCanvas();
    $w = $canvas->get_width();
    $h = $canvas->get_height();
    $imageURL = media().'/images/logo-seuat-contorno-ok.png';
    $imgWidth = 360;
    $imgHeight = 310;
    $canvas->set_opacity(.25);

    $x = (($w-$imgWidth)/2);
    $y = (($h-$imgHeight)/2.41);

    $canvas->image($imageURL, $x, $y, $imgWidth, $imgHeight);

    header("Content-type: application/pdf");
    header("Content-Disposition: inline; filename=documento.pdf");
    echo $dompdf->output();