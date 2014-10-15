<?php
	$xml = Xml::build($consumptions);
	echo $xml->saveXML();
?>