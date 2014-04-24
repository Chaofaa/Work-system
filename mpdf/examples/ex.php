<?

$html = file_get_contents('ex_t.php');

include("../mpdf.php");

$mpdf=new mPDF('c','A4','','' , 0 , 0 , 0 , 0 , 0 , 0); 

$mpdf->WriteHTML($html);
$mpdf->Output();
exit;


?>