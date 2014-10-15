<?php
	$xml = Xml::build($subscriptions);
	echo $xml->saveXML();
?>