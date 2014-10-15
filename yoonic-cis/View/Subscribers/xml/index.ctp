<?php
	$xml = Xml::build($subscribers);
	echo $xml->saveXML();
?>