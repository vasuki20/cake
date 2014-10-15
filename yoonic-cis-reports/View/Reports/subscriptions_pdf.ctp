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
	<h2>Subscriptions</h2>
	

	<h3>Total Weekly Active Subscriptions</h3>

	<p class="report-text-indent">By Daily Basic - $weekly_subscriptions_active_daily_basic</p>

	<p class="report-text-indent">By Daily Premium - $weekly_subscriptions_active_daily_premium</p>

	<p class="report-text-indent">By Weekly Basic - $weekly_subscriptions_active_weekly_basic</p>

	<p class="report-text-indent">By Weekly Premium - $weekly_subscriptions_active_weekly_premium</p>

	<h3>Total Weekly Renewal</h3>

	<p class="report-text-indent">By Daily Basic - $weekly_total_renewal_daily_basic</p>

	<p class="report-text-indent">By Daily Premium - $weekly_total_renewal_daily_premium</p>

	<p class="report-text-indent">By Weekly Basic - $weekly_total_renewal_weekly_basic</p>

	<p class="report-text-indent">By Weekly Premium - $weekly_total_renewal_weekly_premium</p>

	<h3>Total Number of Inactive Subscribers</h3>

	<p class="report-text-indent">Inactive Subscribers - expired below 7 days - $inactive_subscribers_below_seven</p>

	<p class="report-text-indent">Inactive Subscribers - expired beyond 7 days - $inactive_subscribers_beyond_seven</p>

	<h3>List of Subscribers MSISDN</h3>
EOF;


$i = 1;
foreach($list_subscribers_msisdn as $subscriber_msisdn):
	$html .= $i.'. '.$subscriber_msisdn['Subscriber']['msisdn'].'<br />';
$i++;
endforeach;


// output the HTML content
$tcpdf->writeHTML($html, true, false, true, false, '');

echo $tcpdf->Output('Subscriptions Reporting.pdf', 'D'); 
?>
