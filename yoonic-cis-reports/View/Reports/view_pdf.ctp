<?php 
$asd = 123;
App::import('Vendor','xtcpdf');  
$tcpdf = new XTCPDF(); 
$textfont = 'freesans'; // looks better, finer, and more condensed than 'dejavusans' 

$tcpdf->SetAuthor("Yoonic"); 
$tcpdf->SetAutoPageBreak( false ); 
$tcpdf->setHeaderFont(array($textfont,'',10)); 
$tcpdf->xheadertext = 'Yoonic'; 
$tcpdf->xfootertext = 'Copyright© %d Yoonic All rights reserved.'; 

// add a page (required with recent versions of tcpdf) 
$tcpdf->AddPage(); 

// Now you position and print your page content 
// example:  
// set font
$tcpdf->SetFont('dejavusans', '', 10);

// add a page
$tcpdf->AddPage();

// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

// create some HTML content
$html = <<<EOF
<h1>Test custom bullet image for list items</h1>
<ul> 
    <li>test custom bullet image</li>
    <li>test custom bullet image</li>
    <li>test custom bullet image</li>
    <li>test custom bullet image</li>
</ul>
EOF;


// output the HTML content
$tcpdf->writeHTML($html, true, false, true, false, '');

echo $tcpdf->Output('filename.pdf', 'D'); 

?>
