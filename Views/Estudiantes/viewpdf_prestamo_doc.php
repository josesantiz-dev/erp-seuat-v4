<?php
    require_once 'Assets/plugins/dompdf/autoload.inc.php';
    use Dompdf\Dompdf;
    use Dompdf\Options;
    $dompdf = new Dompdf();
    ob_start();
    include "pdf_prestamo_doc.php";
    $html = ob_get_clean();
    $options = new Options();
    $options->set('isRemoteEnabled', TRUE);
    $dompdf = new DOMPDF($options);
    $dompdf->loadHtml($html);
    $dompdf->render();
    header("Content-type: application/pdf");
    header("Content-Disposition: inline; filename=documento.pdf");
    echo $dompdf->output();