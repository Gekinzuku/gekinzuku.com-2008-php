<?php
$line = file("/home/nintend5/public_html/Gekinzuku/GShacking/files/ootaddresses");

//makes sure the user didn't pick the top option
if ($_GET['SelLoc'] == "--- Select Area ---")
{
die();
}

echo '<select name="ActorOptions" id="ActorOptions" onchange="PutValInBox();"><option selected="selected">-- Select An Actor --</option>';
foreach ($line as $value)
{
	$loc = strtok($value, "||");
	$address = strtok("||");
	$describe = strtok("||");

	$SelLoc = $_GET['SelLoc'];

	if ($loc == $SelLoc)
	{
		echo '<option value="' . $address . '">' . $describe . '</option>';
	}
}

echo '</select><br />';
?>

Change actor to:
<select name="Actor" id="Actor">
<?php 
	$line = file("/home/nintend5/public_html/Gekinzuku/GShacking/actors");

	
	foreach ($line as $value)
	{
		echo "<option>" . strtok($value, "||") . "</option>";
	}
?>
</select>
<input type="button" value="Change" onclick="UpdateActor();"><br /><br />

<table><tr><td>
Co-ordinates: X: <input size="4" type="text" name="Xco" id="Xco" maxlength="4"> 
Y: <input size="4" type="text" name="Yco" id="Yco" maxlength="4"> 
Z: <input size="4" type="text" name="Zco" id="Zco" maxlength="4"><br />

Rotation: X: <input size="4" type="text" name="Xrot" id="Xrot" maxlength="4"> 
Y: <input size="4" type="text" name="Yrot" id="Yrot" maxlength="4"> 
Z: <input size="4" type="text" name="Zrot" id="Zrot" maxlength="4"><br />
</td><td><input type="button" value="Update Details" onclick="UpdatePos();"><br />
<input type="button" value="Clear Details" onclick="ClearPos();">
</td></tr></table>