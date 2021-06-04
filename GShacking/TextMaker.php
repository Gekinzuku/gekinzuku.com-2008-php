<?php 
include("/home/nintend5/public_html/Gekinzuku/leftnav.php");
?>

<?php 

if (!empty($_POST['say']))
{
	$Text = str_split(stripslashes($_POST['say']));
	$Color = $_POST['color'];

	if(!empty($_POST['offset']))
	{
		$offset = $_POST['offset'];
	}
	else
	{
		$offset = 0;
	}
		

	//$Addr = 1934122;
	$Addr = 1934120 + $offset;
	$i = 0;

	echo "<b>The code:</b><br>";

	$code = "";

	//terminates rest of text if it was requested
	if($T['kill'] == "on")
	{
		$code = $code . "<br>80" . strtoupper(dechex($Addr + $i)) . " 0002";
		$i ++;
	}

	$Special = "false";

	//converts and stores the main code
	foreach ($Text as $Value) 
	{
		if($Value == "\\")
		{
			$Special = "true";
		}
		else if ($Special == "true")
		{
			//Adds Link's name
			if ($Value == "F")
				$code = $code . "<br>80" . strtoupper(dechex($Addr + $i)) . " 000F";
			//Adds line break
			else if ($Value == "1")
				$code = $code . "<br>80" . strtoupper(dechex($Addr + $i)) . " 0001";
			//Enters Hyrule Time
			else if ($Value == "T")
				$code = $code . "<br>80" . strtoupper(dechex($Addr + $i)) . " 001F";
			//Adds new box
			else if ($Value == "4")
				$code = $code . "<br>80" . strtoupper(dechex($Addr + $i)) . " 0004";
			//Adds a pause
			else if ($Value == "D")
				$code = $code . "<br>80" . strtoupper(dechex($Addr + $i)) . " 000D";
			//Adds line break
			else if ($Value == "1")
				$code = $code . "<br>80" . strtoupper(dechex($Addr + $i)) . " 0001";
			//For colors
			else if ($Value == "W")
			{
				$code = $code . "<br>80" . strtoupper(dechex($Addr + $i)) . " 0005";
				$i ++;
				$code = $code . "<br>80" . strtoupper(dechex($Addr + $i)) . " 0040";
			}
			else if ($Value == "R")
			{
				$code = $code . "<br>80" . strtoupper(dechex($Addr + $i)) . " 0005";
				$i ++;
				$code = $code . "<br>80" . strtoupper(dechex($Addr + $i)) . " 0041";
			}
			else if ($Value == "G")
			{
				$code = $code . "<br>80" . strtoupper(dechex($Addr + $i)) . " 0005";
				$i ++;
				$code = $code . "<br>80" . strtoupper(dechex($Addr + $i)) . " 0042";
			}
			else if ($Value == "B")
			{
				$code = $code . "<br>80" . strtoupper(dechex($Addr + $i)) . " 0005";
				$i ++;
				$code = $code . "<br>80" . strtoupper(dechex($Addr + $i)) . " 0043";
			}
			else if ($Value == "L")
			{
				$code = $code . "<br>80" . strtoupper(dechex($Addr + $i)) . " 0005";
				$i ++;
				$code = $code . "<br>80" . strtoupper(dechex($Addr + $i)) . " 0044";
			}
			else if ($Value == "P")
			{
				$code = $code . "<br>80" . strtoupper(dechex($Addr + $i)) . " 0005";
				$i ++;
				$code = $code . "<br>80" . strtoupper(dechex($Addr + $i)) . " 0045";
			}
			else if ($Value == "Y")
			{
				$code = $code . "<br>80" . strtoupper(dechex($Addr + $i)) . " 0005";
				$i ++;
				$code = $code . "<br>80" . strtoupper(dechex($Addr + $i)) . " 0046";
			}
			else if ($Value == "b")
			{
				$code = $code . "<br>80" . strtoupper(dechex($Addr + $i)) . " 0005";
				$i ++;
				$code = $code . "<br>80" . strtoupper(dechex($Addr + $i)) . " 0047";
			}
			else if ($Value == "C")
			{
				$code = $code . "<br>80" . strtoupper(dechex($Addr + $i)) . " 0005";
				$i ++;
				$code = $code . "<br>80" . strtoupper(dechex($Addr + $i)) . " 0040";
			}

			$i ++;
			$Special = "false";
		}
		else
		{
			$code = $code . "<br>80" . strtoupper(dechex($Addr + $i)) . " 00" . strtoupper(dechex(ord($Value)));
			$i ++;
		}			
	}

	//terminates rest of text if it was requested
	if($_POST['kill'] == "on")
	{
		$code = $code . "<br>80" . strtoupper(dechex($Addr + $i)) . " 0002" ;
		$i ++;
	}

	//inputs the code that forces the game to need a button press to activate the new text
	if($_POST['activate'] == "on")
	{
		if ($_POST['2push'] == "L")
			$Button = "0020";
		else if ($_POST['2push'] == "R")
			$Button = "0010";
		else if ($_POST['2push'] == "Both (L and R)")
			$Button = "0030";
		else if ($_POST['2push'] == "None of the above")
			$Button = "0000";
		else if ($_POST['2push'] == "C-Right")
			$Button = "0001";
		else if ($_POST['2push'] == "C-Left")
			$Button = "0002";
		else if ($_POST['2push'] == "C-Down")
			$Button = "0004";
		else if ($_POST['2push'] == "C-Up")
			$Button = "0008";

		$buttonact = "<br>" . "D01C84B5 " . $Button . "<br>";
		$code = str_ireplace("<br>",$buttonact,$code);
	}

	//adds one count to the codes list to keep track of how many codes have been made
	$filename = "/home/nintend5/public_html/Gekinzuku/GShacking/Textcodes";
	$fp = fopen($filename, "r");

	$count = fgets($fp);
	fclose($fp);
	$count ++;

	$fp = fopen($filename, "w");
	fwrite($fp,$count);
	fclose($fp);

}
?>
<h2>GeekyLink's Text Conversation GameShark Code Generator.</h2><small>Codes only work on Ocarina of Time U1.0.</small><br><br>
<small>Text codes created with this generator: <?PHP include("/home/nintend5/public_html/Gekinzuku/GShacking/Textcodes"); ?><br></small>
<a href="http://nintendo-revolutionized.com/forums/index.php?topic=326">A guide for using this generator can be found here.</a><br><hr>
<form action="TextMaker.php" method="post">

<table width="100%"><tr><td width="30%" valign="top" align="left">

<b>Text to make characters say:</b><br>
<input type="text" name="say" size="28" id="say"><br><br>

<b>Add Color Options:</b><br>

<input type="button" value="White" onclick="document.getElementById('say').value = document.getElementById('say').value + '\\W';">
<input type="button" value="Red" onclick="document.getElementById('say').value = document.getElementById('say').value + '\\R';">
<input type="button" value="Green" onclick="document.getElementById('say').value = document.getElementById('say').value + '\\G';"><br>
<input type="button" value="Blue" onclick="document.getElementById('say').value = document.getElementById('say').value + '\\B';">
<input type="button" value="Pink" onclick="document.getElementById('say').value = document.getElementById('say').value + '\\P';">
<input type="button" value="Yellow" onclick="document.getElementById('say').value = document.getElementById('say').value + '\\Y';"><br>
<input type="button" value="Light Blue" onclick="document.getElementById('say').value = document.getElementById('say').value + '\\L';">
<input type="button" value="Black" onclick="document.getElementById('say').value = document.getElementById('say').value + '\\b';"><br>
<input type="button" value="Close Color" onclick="document.getElementById('say').value = document.getElementById('say').value + '\\C';"><br>
<small>Note: Red appears as orange on signs, and pink appears as purple on signs.</small><br><br>

<input type="submit" value="Create Code!"><br>


</td><td align="center" valign="top" width="40%">
<b>Input:</b><br>
<input type="button" title="Makes the following text appear on a new line." value="Line Break" onclick="document.getElementById('say').value = document.getElementById('say').value + '\\1';">
<input type="button" title="Displays the player's name." value="Player Name" onclick="document.getElementById('say').value = document.getElementById('say').value + '\\F';">
<input type="button" title="Makes the following text appear in a new box." value="New Box" onclick="document.getElementById('say').value = document.getElementById('say').value + '\\4';">
<input type="button" title="Pauses the box until player hits a button." value="Pause" onclick="document.getElementById('say').value = document.getElementById('say').value + '\\D';">
<input type="button" title="Displays what the Hyrule time is." value="Hyrule Time" onclick="document.getElementById('say').value = document.getElementById('say').value + '\\T';">
<input type="button" title="Keeps the original letter of this location." value="Skip" onclick="document.getElementById('say').value = document.getElementById('say').value + '\\ ';">
<br><br>
<b>Additional Options:</b><br>
Terminate all text after this string: <input type="checkbox" name="kill" id="kill"><br>

<br>Button to activate new text: <input type="checkbox" name="activate" id="activate"><br>
<small>Warning: Doubles the size of the code.</small>
<select name="2push" id="2push">

<option>L</option>
<option>R</option>
<option>Both (L and R)</option>
<option>C-Right</option>

<option>C-Left</option>
<option>C-Up</option>
<option>C-Down</option>
<option>None of the above</option>

</select><br><br>
Offset start of text by: 
<input type="text" name="offset" id="offset" size="3" maxlength="3"><br>
<small>Note: Enter number in decimal, not hex.</small>
</td><td width="30%" align="center" valign="top">
<?php
//displays the code
echo $code;

if (empty($_POST['say']))
{
	echo "<b>The code:</b><br><br>";
}
?> 
</td></tr></table></form>

<?php 
include("/home/nintend5/public_html/Gekinzuku/rightnav.php");
?>

</body>

</html>