<?php
include("/home/nintend5/public_html/Gekinzuku/leftnav.php");
?>


<script type="text/javascript" src="engine.js"></script> 
<script type="text/javascript" src="hacking.js"></script>
<br />
<h3>GeekyLink's Actor Hacking Generator 2.0 ALPHA</h3>
<hr />

<table width="100%" valign="top">
<tr><td width="90%" align="left">
Area Selection: 
<select name="area" id="area" onchange="getData();">
<option>--- Select Area ---</option>
<?php

	$line = file("/home/nintend5/public_html/Gekinzuku/GShacking/files/ootareas");

	foreach ($line as $value)
	{
		echo "<option>" . $value . "</option>";
	}

?></td><td width="10%" align="right">
</select><span id="loading"></span></td></tr></table>
<hr />
<table width="100%" valign="top">
<tr><td width="80%">
<div id="groups">Select an area.</div>
</td><td width="20%" rowspan="5" style="border-left: thin solid grey" valign="top">
<b>The Code:</b><br /><br />
<div id="code"></div>
</td></tr><tr><td>
<hr /></td></tr><tr><td>
<div id="ActorsInArea">Select an area.</div>
</td></tr><tr><td>
<hr />
<div id="advopt">Advanced Options:</div>
</td></tr><tr><td>
<hr />
<div id="info">Information center<br /></div>
</td></tr></table>

<?php
include("/home/nintend5/public_html/Gekinzuku/rightnav.php");
?>

</body>
</html>