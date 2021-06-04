<?php

$filename = "/home/nintend5/public_html/Gekinzuku/SC/counter";
$fp = fopen($filename, "r");

$count = fgets($fp);
fclose($fp);

$count ++;

$filename = "/home/nintend5/public_html/Gekinzuku/SC/counter";
$fp = fopen($filename, "w");

fwrite($fp,$count);
fclose($fp);

header("Location: http://gekinzuku.nintendo-revolutionized.com/SC/SantasChallenge.zip");
?> 