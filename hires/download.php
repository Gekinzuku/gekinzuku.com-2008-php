<?php

$filename = "/home/nintend5/public_html/Gekinzuku/hires/counter";
$fp = fopen($filename, "r");

$count = fgets($fp);
fclose($fp);

$count ++;

$fp = fopen($filename, "w");

fwrite($fp,$count);
fclose($fp);

header("Location: http://gekinzuku.nintendo-revolutionized.com/hires/OoTHiRes.zip");
?> 