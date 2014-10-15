<?php
	$xml = Xml::build($receipt);
	echo $xml->saveXML();
?>