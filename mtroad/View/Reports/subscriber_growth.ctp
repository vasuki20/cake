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

// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

// create some HTML content
$html = <<<EOF
<h2>Subscriber Growth</h2>

	<h3>Total Weekly new subscribers</h3>
	<p>$weekly_new_subscribers</p>

	<h3>Total Weekly New Number Subscription</h3>

	<p class="report-text-indent">By Daily Basic - $weekly_new_number_subscription_by_daily_basic</p>

	<p class="report-text-indent">By Daily Premium - $weekly_new_number_subscription_by_daily_premium</p>

	<p class="report-text-indent">By Weekly Basic - $weekly_new_number_subscription_by_weekly_basic</p>

	<p class="report-text-indent">By Weekly Premium - $weekly_new_number_subscription_by_weekly_premium</p>

	<h3>List of Subscribers MSISDN</h3>
EOF;

	$i = 1;
	foreach($list_subscribers_msisdn as $subscriber_msisdn):
		$html .= $i.'. '.$subscriber_msisdn['Subscriber']['msisdn'].'<br />';
	$i++;
	endforeach;

// output the HTML content
$tcpdf->writeHTML($html, true, false, true, false, '');

echo $tcpdf->Output('Subscriber Growth.pdf', 'D'); 

?>
