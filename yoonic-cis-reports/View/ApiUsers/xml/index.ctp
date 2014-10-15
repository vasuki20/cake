<?php
	$xml = Xml::build($apiUsers);
	echo $xml->saveXML();
?>