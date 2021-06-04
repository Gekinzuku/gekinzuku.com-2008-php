<?php

$con = mysql_connect("localhost","nintend5_Gnews","K0r1NG33k");

if(!$con)
{
	die("Error in database: " . mysql_error());
} 

if (!mysql_select_db("nintend5_GekinzukuNews", $con))
{
	die("Error selecting database: " . mysql_error());
}

if ($_GET['users'] == "create")
{
	$sql = "CREATE TABLE users (Username varchar(15), Password varchar(32), Articles int)";
	if(mysql_query($sql,$con))
	{
		echo "success!";
	}
	else
	{
		echo "error: " . mysql_error();
	}
}

if($_GET['ass'] == "lol")
{
	$result = mysql_query("SELECT * FROM users WHERE UserName=UserName");
		while($row = mysql_fetch_array($result))
		{
		  echo $row['Username'] . " :: " . $row['Password'] . " || " . $row['Articles'];
		  echo "<br />";
		}
}

if ($_POST['user'] != "" && $_POST['pass'] != "")
{
	if ($_POST['login'] != "login")
	{

		mysql_query("INSERT INTO users (Username, Password, Articles) VALUES ('" . addslashes($_POST[user]) . "', '" . md5($_POST['pass']) . "', '0')");
		//mysql_query("INSERT INTO users (UserName, Password, Articles) VALUES(" . addslashes($_POST[user]) . "," . md5($_POST['pass'] . ",0)");
		echo "Thank you for registering " . stripslashes($_POST['user']) . ". You may now login.";
	}
	else
	{
		$lol = "SELECT * FROM users WHERE UserName='" . addslashes($_POST['user']) ."' AND Password='" . md5($_POST['pass']) . "'";

echo "<br><br>" . $lol;
		$result = mysql_query($lol);
		while($row = mysql_fetch_array($result))
		{
		  echo "Welcome " . stripslashes($row['Username']) . "! You have written " . $row['Articles'] . " because you are a lazy prick!";
		  echo "<br />";
		}
	}
}

?>

<html>
<body>

Register:<br>
<form action="login.php" method="post">

Username: <input type="text" id="user" name="user"><br>
Password: <input type="password" id="pass" name="pass"><br>
<input type="submit" value="Register">
</form>
<hr>
Login:<br>
<form action="login.php" method="post">

Username: <input type="text" id="user" name="user"><br>
Password: <input type="password" id="pass" name="pass"><br>
<input type="hidden" name="login" id = "login" value="login">
<input type="submit" value="Login">
</form>

</body>
</html>