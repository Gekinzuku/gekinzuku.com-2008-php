<?PHP
include("/home/nintend5/public_html/Gekinzuku/leftnav.php");
?>

<?php
if ($_POST['create'] == true )
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
		//Sends Version and location to get addr values
		$Addr = GetAddr($_POST['V'], $_POST['loc']);
		
		//makes sure the version of Ocarina of Time and the area selected are compatible
		if ($Addr[0] != "unsupported")
		{			
			//sends the actor name and returns the values for it
			$ActorVals = GetActorVals(stripslashes($_POST['Actor']));
			
			//makes sure the actor was found
			if ($ActorVals[0] != "failed")
			{
				//adds one count to the codes list to keep track of how many codes have been made
				$filename = "/home/nintend5/public_html/Gekinzuku/GShacking/AHcodes";
				$fp = fopen($filename, "r");

				$count = fgets($fp);
				fclose($fp);
				$count ++;

				$fp = fopen($filename, "w");

				fwrite($fp,$count);
				fclose($fp);

				if (substr_count($ActorVals[2],"*"))
				{
					$Addr[2] = "";
					$ActorVals[2] = "";
				}

				//if user requested that the code only be activated by button
				if ($_POST['Press'] == "on")
				{
					$Code = $Addr[4] . " " . GetButton($_POST['Button']);
					//if group is 0001 don't include it in the code because it seems to screw up sometimes
					if ($ActorVals[0] == "0001")
						echo $Code . "<br>" .  $Addr[1] . " " . $ActorVals[1] . "<br>" . $Code . "<br>" . $Addr[2] . " " . $ActorVals[2] . "<br><br><small>Note: You may need to remove extra spaces if you copy this directly into an emulator.</small>";
					else
						echo $Code . "<br>" . $Addr[0] . " " . $ActorVals[0] . "<br>" . $Code . "<br>" . $Addr[1] . " " . $ActorVals[1] . "<br>" . $Code . "<br>" . $Addr[2] . " " . $ActorVals[2] . "<br><br><small>Note: You may need to remove extra spaces if you copy this directly into an emulator.</small>";
				}
				else
				{
					//if group is 0001 don't include it in the code because it seems to screw up sometimes
					if ($ActorVals[0] == "0001")
						echo $Addr[1] . " " . $ActorVals[1] . "<br>" . $Addr[2] . " " . $ActorVals[2] . "<br><br><small>Note: You may need to remove extra spaces if you copy this directly into an emulator.</small>";
					else
						echo $Addr[0] . " " . $ActorVals[0] . "<br>" . $Addr[1] . " " . $ActorVals[1] . "<br>" . $Addr[2] . " " . $ActorVals[2] . "<br><br><small>Note: You may need to remove extra spaces if you copy this directly into an emulator.</small>";
				}
			}	
			else
				echo "The actor that was selected could not be found";
		}
		else 
			echo "This version of Ocarina of Time is incompatible with the selected area at this time.";
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

	//version 1.0
	if ($Version == "1.0")
	{
		if($loc == "kokiri")
		{
			$Addr[0] = "81244096";
			$Addr[1] = "81244124";
			$Addr[2] = "81244132";
		} 
		else if ($loc == "zora")
		{
			$Addr[0] = "81260978";
			$Addr[1] = "812609F8";
			$Addr[2] = "81260A06";
		}
		else if ($loc == "kakariko")
		{
			$Addr[0] = "8123A940";
			$Addr[1] = "8123A944";
			$Addr[2] = "8123A952";
		}
		else if ($loc == "lonlonranch")
		{
			$Addr[0] = "81248520";
			$Addr[1] = "81248544";
			$Addr[2] = "81248552";
		}
		$Addr[4] = "D01C84B5";
	}
	//version 1.1
	else if ($Version == "1.1")
	{
		if($loc == "kokiri")
		{
			$Addr[0] = "81244236";
			$Addr[1] = "812442C4";
			$Addr[2] = "812442D2";
		}
		$Addr[4] = "D01C8675";
	}
	//version 1.2
	else if ($Version == "1.2")
	{
		if($loc == "kokiri")
		{
			$Addr[0] = "81244716";
			$Addr[1] = "812447A4";
			$Addr[2] = "812447B2";
		}
		$Addr[4] = "D01C8D75";
	}

	return $Addr;
}
?>

<form method="post" action="ActorHacking.php">
<b>GeekyLink's custom actor hacking code generator:</b><br><br>
<small>Actor Hacking codes created with this generator: <?PHP include("/home/nintend5/public_html/Gekinzuku/GShacking/AHcodes"); ?><br><br></small>
Select your version of Ocarina of Time:<br>
Ocarina of Time U 1.0: <input type="radio" name="V" id="V" value="1.0"><br>
Ocarina of Time U 1.1: <input type="radio" name="V" id="V" value="1.1"><br>
Ocarina of Time U 1.2: <input type="radio" name="V" id="V" value="1.2"><br><br>

Select a location for actor to spawn: (values for anything other than the Kokiri kid only work on 1.0 atm)<br>
Kokiri Forest (rock humper): <input type="radio" name="loc" id="loc" value="kokiri" checked="checked"><br>
Kakariko Village (guard in front of Impa's house): <input type="radio" name="loc" id="loc" value="kakariko"><br>
Lon Lon Ranch (Talon): <input type="radio" name="loc" id="loc" value="lonlonranch"><br>
Zora's Domain (Waterfall): <input type="radio" name="loc" id="loc" value="zora"><br><br>

Select what to change actor to:
<select name="Actor" id="Actor">
<?php 
	$line = file("/home/nintend5/public_html/Gekinzuku/GShacking/actors");

	
	foreach ($line as $value)
	{
		echo "<option>" . strtok($value, "||") . "</option>";
	}
?>
</select><br><small>Note: The list is in alphabetical order to make it easy to find what you are looking for. Alpha and Beta actors are located at the end of the list however.</small><br><br>


Must hit a button to activate (Optional): <input type="checkbox" name="Press" id="Press">
<select name="Button" id="Button">
  <option>L</option>
  <option>R</option>
  <option>Both (L and R)</option>
</select><br>
<small>Note: You must hold the button down while entering the area for this to work.</small><br><br>
<input type="hidden" name="create" id="create" value="true">
<input type="submit" value="Create Code!">
</form><hr>

<?PHP
include("/home/nintend5/public_html/Gekinzuku/rightnav.php");
?>


</body></html>