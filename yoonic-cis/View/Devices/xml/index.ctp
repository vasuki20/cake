<?php
	$xml = Xml::build($devices);
	echo $xml->saveXML();
?>