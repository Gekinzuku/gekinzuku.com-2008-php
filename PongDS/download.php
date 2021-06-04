<?php

$filename = "/home/nintend5/public_html/Gekinzuku/PongDS/counter";
$fp = fopen($filename, "r");

$count = fgets($fp);
fclose($fp);

$count ++;

$filename = "/home/nintend5/public_html/Gekinzuku/PongDS/counter";
$fp = fopen($filename, "w");

fwrite($fp,$count);
fclose($fp);

if ($_GET["version"] == "3") header("Location: http://gekinzuku.nintendo-revolutionized.com/PongDS/Pong3.0.zip");
else header("Location: http://gekinzuku.nintendo-revolutionized.com/PongDS/Pong2.1.zip");
?> 