<?php

$filename = "/home/nintend5/public_html/Gekinzuku/hacking/program";
$fp = fopen($filename, "r");

$count = fgets($fp);
fclose($fp);

$count ++;

$filename = "/home/nintend5/public_html/Gekinzuku/hacking/program";
$fp = fopen($filename, "w");

fwrite($fp,$count);
fclose($fp);

if ($_GET["file"] == "patcher") header("Location: http://gekinzuku.nintendo-revolutionized.com/hacking/GekinzukuPatcher.zip");
else echo "LOL!!!!";
?> 