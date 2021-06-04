 <?PHP
include("/home/nintend5/public_html/Gekinzuku/leftnav.php");
?>

<?php
if ($_POST['data'] == true )
{
	echo "<b>Your Code:</b><br><br>";

	// error handler
	if($_POST['V'] == NULL)
		echo "<b>Error: You forgot to select which version of Ocarina of Time you have!</b>";
	else if($_POST['loc'] == NULL)
		echo "<b>Error: You didn't select a location!</b>";
	else if($_POST['Actor'] == NULL)
		echo "<b>Error: You didn't select an actor to change to!</b>";
	else if($_POST['Press'] == "on" && $_POST['Button'] == NULL)
		echo "<b>Error: You selected to use a button to activate the code, but didn't provide the button!</b>";
	else //everything is fine if it made it this far :D
	{
		$line = file("/home/nintend5/public_html/Gekinzuku/GShacking/files/ootgroups");

		echo '<select name="group" id="group">';

		foreach ($line as $value)
		{
			$loc = strtok($value, "||");
			$address = strtok("||");
			$orgval = strtok("||");
			$describe = strtok("||");
	
			if ($loc == $_POST['loc'])
			{
				echo '<option value="' . $address . '" title="' . $orgval . '">' . $describe . '</option>';
			}
		}
		
		echo '</select>';

	}
	echo "<hr>";
}


/*************************
**Takes button and returns value
*************************/
function GetButton($Button)
{
	if ($Button == "L")
		return "0020";
	else if ($Button == "R")
		return "0010";
	else if ($Button == "Both (L and R)")
		return "0030";
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



/*************************

**Takes the version and location and returns the addresses for the code

*************************/

function GetAddr($Version, $loc)
{
	$Addr[0] = "unsupported";
	
	
}

?>



<form method="post" action="ActorHack2.php">

<b>GeekyLink's custom actor hacking code generator:</b><br><br>

<small>Actor Hacking codes created with this generator: <?PHP
include("/home/nintend5/public_html/Gekinzuku/GShacking/AHcodes");
?><br><br></small>

Select your version of Ocarina of Time:<br>

Ocarina of Time U 1.0: <input type="radio" name="V" id="V" value="1.0"><br>
Ocarina of Time U 1.1: <input type="radio" name="V" id="V" value="1.1"><br>
Ocarina of Time U 1.2: <input type="radio" name="V" id="V" value="1.2"><br><br>



Select a location for actor to spawn:<br>

<select name="loc" id="loc">
<option>Kokiri Forest</option>
</select>
<br><br>

Select what to change actor to:

<select name="Actor" id="Actor">

<?php 
	$line = file("/home/nintend5/public_html/Gekinzuku/GShacking/actors");

	foreach ($line as $value)
	{
		echo "<option>" . strtok($value, "||") . "</option>";
	}

?>

</select><br><small>Note: The list is in alphabetical
order to make it easy to find what you are looking for. Alpha and Beta
actors are located at the end of the list
however.</small><br><br>





Must hit a button to activate (Optional): <input type="checkbox" name="Press" id="Press">

<select name="Button" id="Button">

  <option>L</option>

  <option>R</option>

  <option>Both (L and R)</option>

</select><br>

<small>Note: You must hold the button down while entering the area for this to work.</small><br><br>

<input type="hidden" name="data" id="data" value="true">

<input type="submit" value="Create Code!">

</form><hr>



<?PHP

include("/home/nintend5/public_html/Gekinzuku/rightnav.php");

?>





</body></html>