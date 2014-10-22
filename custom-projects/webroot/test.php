<?php
$unixtime = time();
$random = rand(0,99999);
	/*
	echo $unixtime."\n";
	echo $random."\n";
	echo strval($unixtime)."\n";
	echo strval($random)."\n";
	*/

if ($random <= 9) {
	echo strval($unixtime) . "0000" . strval($random);
} else if ($random <= 99) {
	echo strval($unixtime) . "000" . strval($random);
} else if ($random <= 999) {
	echo strval($unixtime) . "00" . strval($random);
} else if ($random <= 9999) {
	echo strval($unixtime) . "0" . strval($random);
} else {
	echo strval($unixtime) . strval($random);
}
?>