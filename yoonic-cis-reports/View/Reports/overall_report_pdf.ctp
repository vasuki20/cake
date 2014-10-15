<?php 
App::import('Vendor','xtcpdf');  
$tcpdf = new XTCPDF(); 
$textfont = 'freesans'; // looks better, finer, and more condensed than 'dejavusans' 

$tcpdf->SetAuthor("Yoonic"); 
$tcpdf->SetAutoPageBreak( false ); 
$tcpdf->xfootertext = 'Copyright© %d Yoonic All rights reserved.'; 

$tcpdf->SetFont('dejavusans', '', 10);

// add a page
$tcpdf->AddPage();

// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

// create some HTML content
$html = <<<EOF
	<h2>Overall Reporting</h2>

	<h3>Total Number of Subscribers</h3>
	<p>$total_subscribers</p>

	<h3>Total Number of Active Subscribers</h3>
	<p>$active_subscribers</p>

	<h3>Total Number of Inactive Subscribers</h3>

	<p class="report-text-indent">Inactive Subscribers - expired below 7 days - $inactive_subscribers_below_seven</p>

	<p class="report-text-indent">Inactive Subscribers - expired beyond 7 days - $inactive_subscribers_beyond_seven</p>
EOF;


// output the HTML content
$tcpdf->writeHTML($html, true, false, true, false, '');

echo $tcpdf->Output('Overall Reporting.pdf', 'D'); 
?>
