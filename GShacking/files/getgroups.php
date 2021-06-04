<?php
$line = file("/home/nintend5/public_html/Gekinzuku/GShacking/files/ootgroups");

//makes sure the user didn't pick the top option
if ($_GET['SelLoc'] == "--- Select Area ---")
{
die();
}


echo '<table><tr><td width="80%" colspan="2" align="center">';

echo "Area selected: " . $_GET['SelLoc'] . ".<br /></td></tr><tr><td width='40%'>";

echo '<select name="group" id="group" onchange="PutValInBox();"><option selected="selected">-- Select Group --</option>';

$i = 0;
foreach ($line as $value)
{
	$loc = strtok($value, "||");
	$address = strtok("||");
	$orgval = strtok("||");
	$describe = strtok("||");

	$SelLoc = $_GET['SelLoc'];

	if ($loc == $SelLoc)
	{
		echo '<option value="' . $address . '" title="' . $orgval . '">' . $describe . '</option>';
		$i ++;
	}
}

echo '</select> : <input type="textbox" size="4" maxlength="4" name="groupval" id="groupval"> <input type="button" value="Change" onclick="UpdateGroup();"><input type="button" value="Reset Group" onclick="ResetGroup();">';

echo '</td><td width="20%" align="right">Edited groups: <span id="groupedits">0</span>/' . $i . '.</td></tr></table>';
?>