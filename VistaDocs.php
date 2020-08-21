<?php
# incluimos la libreria fdpf
# http://www.fpdf.org/
require_once('fpdf17/fpdf.php');
# incluimos la libreria fpdi
# http://www.setasign.com/products/fpdi/about/
require_once('FPDI-1.5.2/fpdi.php');

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

$bucket = 'bibliotele1';
$keyname = 'us-east-1:99155b2a-019f-472f-b6f0-1d3afde07b24';

$s3 = new S3Client([
    'version' => 'latest',
    'region'  => 'us-east-1'
]);

try {
    // Get the object.
    $result = $s3->getObject([
        'Bucket' => $bucket,
        'Key'    => $keyname
    ]);

    // Display the object in the browser.
    header("Content-Type: {$result['ContentType']}");
    echo $result['Body'];
} catch (S3Exception $e) {
    echo 

# inicializamos el objeto
$pdf = new FPDI();

# definimos el archivo pdf a leer. Nos devuel el numero de paginas
$paginas=$pdf->setSourceFile('linux.pdf');
$pagina=1;

# importamos cada una de las paginas
$templateId=$pdf->importPage($pagina);
# obtenemos el temaño de cada hoja
$size=$pdf->getTemplateSize($templateId);

// create a page definiendo el formato y tamaños
if($size['w'] > $size['h']){
	for($i=1;$i<=$paginas;$i++){
		$pdf->AddPage('L',array($size['w'],$size['h']));
		$templateId=$pdf->importPage($i);
		$pdf->useTemplate($templateId);
	}
}else {
	for($i=1;$i<=$paginas;$i++){
		$pdf->AddPage('P',array($size['w'],$size['h']));
		$templateId=$pdf->importPage($i);
		$pdf->useTemplate($templateId);
	}
}
# devolvemos el documento
$pdf->Output();
?>
