<?php

//If actor not selected, die
if($_GET['Actor'] == "")
die();

//If the request wasn't specified, die
if($_GET['action'] == "group" || $_GET['action'] == "num" || $_GET['action'] == "var")
{
	$ActorVals = GetActorVals(stripslashes($_GET['Actor']));

	//outputs the requested info about the actor
	if($_GET['action'] == "group")
		$string = $ActorVals[0];
	else if($_GET['action'] == "num")
		$string = $ActorVals[1];
	else if($_GET['action'] == "var")
		$string = $ActorVals[2];


	$string = str_replace("\n", "", $string);
	$string = str_replace("\r", "", $string);
	$string = trim($string); 

	echo $string;
} 
else
{
	die();
}


/*************************
**Takes the Actor's name and returns the values for it
*************************/
function GetActorVals($Actor)
{
	$line = file("/home/nintend5/public_html/Gekinzuku/GShacking/actors");

	
	foreach ($line as $value)
	{
		if (substr_count($value,$Actor))
		{
			$string = $value;

		}
	}
	$token = strtok($string, "||");

	$ActorVals[0] = "failed";

	while ($token !== false)
	{
		if ($token == $Actor)
		{
			$ActorVals[0] = strtok("||");
			$ActorVals[1] = strtok("||");
			$ActorVals[2] = strtok("||");
			break;
		}
		$token = strtok("||");
	}

	return $ActorVals;
}

?> 