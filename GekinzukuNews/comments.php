<script language="javascript" type="text/javascript">
<!--
function testforgaybots()
{
	var helper = document.getElementById("verify").value;

	if (helper == "yellow")
	{
		document.getElementById("displayit").innerHTML = '<input type="submit" name="submit" value="Add My Comment">';
		document.getElementById("hiddenvalue").innerHTML = '<input type="hidden" name="jsran" value="true">';
	}
	else if(helper == "blue")
	{
		document.getElementById("displayit").innerHTML = '<input type="submit" name="submit" value="Add My Comment" disabled="disabled">';
		document.getElementById("hiddenvalue").innerHTML = '<input type="hidden" name="jsran" value="false">';
	}
	else if (helper == "black")
	{
		document.getElementById("displayit").innerHTML = '<input type="submit" name="submit" value="Add My Comment" disabled="disabled">';
		document.getElementById("hiddenvalue").innerHTML = '<input type="hidden" name="jsran" value="false">';
	}
	else if(helper == "gold")
	{
		document.getElementById("displayit").innerHTML = '<input type="submit" name="submit" value="Add My Comment" disabled="disabled">';
		document.getElementById("hiddenvalue").innerHTML = '<input type="hidden" name="jsran" value="false">';
	}
	else
	{
		document.getElementById("displayit").innerHTML = '<input type="submit" name="submit" value="Add My Comment" disabled="disabled">';
		document.getElementById("hiddenvalue").innerHTML = '<input type="hidden" name="jsran" value="false">';
	}
	
}
-->
</script>
<?php 
//checks for the name and comment field to have something in them
if ($_POST['name'] != NULL && $_POST['comment'] != NULL)
{
	
$prename = trim($_POST['name']);
$precomment = trim($_POST['comment']);

//strips tags
$name = strip_tags($prename);
$comment = strip_tags($precomment, "<b><i>");

$errors = "";

if ($_POST['jsran'] != "true")
{
	$errors = "<b>You have been detected as a bot! If you are not, please complete the anti-bot quiz properly.</b><br>";
}

//if name contains HTML tags
if ($name != $prename) $errors = $errors . "<b>Your name may not contain HTML tags.</b><br>";

//if comment contains HTML tags
if ($comment != $precomment) $errors = $errors . "<b>Your comment contained certain HTML tags that are not allowed.</b><br>";

//strips slashes
$comment = stripslashes($comment);
$name = stripslashes($name);

//if name does not have anything in it
if ($name == "")  $errors = $errors . "<b>You did not specify a name.</b><br>";

//if comment does not exist
if ($comment == "") $errors = $errors . "<b>You did not write a comment.</b><br>";

$message = "";

//if there aren't any errors post the message
if ($errors == ""){
	
echo "Comment posted!<br><br>"; 

$my_t=getdate(date("U"));

$date =  $my_t[month] . " " . $my_t[mday] . ", " . $my_t[year]. "&#160;" . $my_t[hours] . ":" . $my_t[minutes];

$Message = $name . " said on " . $date . ":<br>" . $comment . "<hr>";
} else {
//tell the user what they did wrong
	echo "Your comment cannot be posted for the following reasons:<br>" . $errors . "<br>";
}

}

//displays the comments
$filename = "/home/nintend5/public_html/Gekinzuku/GekinzukuNews/comment.database.php";
$fp = fopen($filename, "r");

$precomments = fgets($fp);
fclose($fp); 

$comments = trim($precomments);
$comments = stripslashes($comments);

if ($Message != "")
{
	
$save = $precomments . $Message;

$fp = fopen($filename, "w");

fwrite($fp,$save);
fclose($fp);

$name = "";
$comment = "";

}

$NumComments = substr_count($comments . $Message,"<hr>");

if ($comments == "" && $Message == "") echo "No comments posted about this project yet.";
else echo "<small>The number of comments on this project: " . $NumComments . "</small><br><br>" .  $comments . $Message;

?>

<form method="post" action="index.php">
<br><br>Your name:<br>
<input name="name" type="text" value="<?php echo $name; ?>"><br>
Your comment:<br>
<textarea rows="10" cols="60" name="comment" type="text"><?php echo $comment; ?></textarea><br>

      
      Type the word that says the name of the color that it is, and then hit "verify!" (bot check): <br />
      <b style="color:green">blue</b>, <b style="color:pink">black</b>, 
      <b style="color:blue">gold</b>, <b style="color:yellow">yellow</b>.<br />

      <input type="text" name="verify" id="verify" /> 
<input type="button" value="Verify!" onclick="testforgaybots();" /><br />

      <div id="displayit"><input type="submit" name="submit" value="Add My Comment" disabled="disabled"></div>
	<div id="hiddenvalue"><input type="hidden" name="jsran" value="false"></div>
</form>