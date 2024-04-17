<?php

use Dompdf\Dompdf;
use Dompdf\Options;



function mergePdf($dompdf, $pdfContent) {
    $pages = $dompdf->getCanvas()->get_dompdf()->get_pages();
    $newDompdf = new Dompdf();
    $newDompdf->set_paper($dompdf->getPaperOrientation(), $dompdf->getPaperSize());
    foreach ($pages as $page) {
        $page = clone $page;
        $page->merge_pdf($pdfContent);
        $newDompdf->getCanvas()->get_dompdf()->add_page($page);
    }
    return $newDompdf;
}


ob_start();
switch ($_GET['file']) {
    case 'liste_bon_regularise':
        require_once 'outputs/liste_bon_regularise.php';
        break;
    
    default:
        //$moi = 34;
        $bon_id = $_GET['id_bon_afficher'];
        include_once 'outputs/bon.php';
        break;
}





$html = ob_get_contents();
ob_end_clean();


require_once 'includes/dompdf/autoload.inc.php';

$options = new Options();
//$options->set('defaultFont', 'Courier');

//utiliser pour permetre d'afficher les img
$options->set('chroot', realpath(''));

$dompdf = new Dompdf($options);

$dompdf->loadHtml($html);

$dompdf->setPaper('A4', 'portrait');

$dompdf->render();

$output = 'mon-pdf.pdf';

// Output the generated PDF (1 = download and 0 = preview)

// Output the generated PDF (1 = download and 0 = preview)
//$dompdf->stream("test.pdf",array("Attachment"=>0));
//file_put_contents($output, $dompdf->output());
$pdfContent = $dompdf->output();



echo base64_encode($pdfContent);

?>




