<?php
	$xml = Xml::build($transactions);
	echo $xml->saveXML();
?>