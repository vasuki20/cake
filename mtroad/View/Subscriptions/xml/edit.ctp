<?php
	$xml = Xml::build($subscription);
	echo $xml->saveXML();
?>