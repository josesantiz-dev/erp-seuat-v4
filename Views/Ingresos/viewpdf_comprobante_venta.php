<?php
    require_once 'Assets/plugins/dompdf/autoload.inc.php';
    use Dompdf\Dompdf;
    use Dompdf\Options;
    $dompdf = new Dompdf();
    $dompdf->setPaper('b7','portrait');
    ob_start();
    include "pdf_comprobante_venta.php";
    $html = ob_get_clean();
    $dompdf->loadHtml($html);
    $dompdf->render();
    header("Content-type: application/pdf");
    header("Content-Disposition: inline; filename=documento.pdf");
    echo $dompdf->output();