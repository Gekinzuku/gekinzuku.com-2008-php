<?PHP
include("/home/nintend5/public_html/Gekinzuku/leftnav.php");
?>

We don't have many games here yet, hope you can hang on. Try this game out for fun. Try to hit win without crossing over another different box that says lose. This can be beaten...

<SCRIPT LANGUAGE="JavaScript">

var Loser = false;

function Poop()
{
	if (Loser == true)
		document.writeln ("you lost before hitting this, hit backspace or the back button to go back.");
	else
		document.writeln ("You won :o hit back if you wanna go back to Gekinzuku.");
}

function Noob()
{
	setTimeout('document.title = "You went over a Lose Button";',0);
	setTimeout('document.title = "Gekinzuku Company";',500);
	Loser = true;
}

function tryagain()
{
	setTimeout('document.title = "Gekinzuku Company";',0);
	Loser = false;	
}
</script>

<input type="button" name="vote" value="Retry" onclick="tryagain()"><br><br><br>
<input type="button" name="vote" value="You Lose" onmouseover="Noob()">
<br>
<input type="button" name="vote" value="You Lose" onmouseover="Noob()">
<input type="button" name="vote" value="You Lose" onmouseover="Noob()">
<br>
<input type="button" name="vote" value="You Lose" onmouseover="Noob()">
<input type="button" name="vote" value="win" onclick="Poop()">
<input type="button" name="vote" value="You Lose" onmouseover="Noob()">
<br>
<input type="button" name="vote" value="You Lose" onmouseover="Noob()">
<input type="button" name="vote" value="You Lose" onmouseover="Noob()">
<input type="button" name="vote" value="You Lose" onmouseover="Noob()">


<?PHP
include("/home/nintend5/public_html/Gekinzuku/rightnav.php");
?>