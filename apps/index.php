<html>
<head>
<title>Custom Countdown Creator</title>
</head>


<body bgcolor="#FFFFFF">

<h2>Countdown Editor</h2>
<form method='post' action='index.php'>
		  Title of countdown:<br> <input name='title' type='text'/><br>
		  Message when time is up:<br> <input name='message' type='text'/><br><br>
		  <input value='Get Countdown' type='submit' /><input type="reset" value="Reset Info" />		  
			</form><hr>

<h2><?php echo $_POST["title"]; ?></h2>

<script type="text/javascript" language="JavaScript">
<!-- //start

function GetCount(){

dateFuture = new Date(2010,10,16,0,0,0);

	dateNow = new Date();
	amount = dateFuture.getTime() - dateNow.getTime();		//calc milliseconds between dates
	delete dateNow;

	gekinzuku = "<br><br><small>Countdown made by <a href=\"gekinzuku.nintendo-revolutionized.com\">Gekinzuku</a></small>"

	// time is already past
	if(amount < 0){
		document.getElementById('countbox').innerHTML="<?php echo $_POST["message"]; ?>" + gekinzuku;
	}
	// date is still good
	else{
		days=0;hours=0;mins=0;secs=0;out="";

		amount = Math.floor(amount/1000);//kill the "milliseconds" so just secs

		days=Math.floor(amount/86400);//days
		amount=amount%86400;

		hours=Math.floor(amount/3600);//hours
		amount=amount%3600;

		mins=Math.floor(amount/60);//minutes
		amount=amount%60;

		secs=Math.floor(amount);//seconds

		if(days != 0){out += days +" day"+((days!=1)?"s":"")+", ";}
		if(days != 0 || hours != 0){out += hours +" hour"+((hours!=1)?"s":"")+", ";}
		if(days != 0 || hours != 0 || mins != 0){out += mins +" minute"+((mins!=1)?"s":"")+", ";}
		out += secs +" seconds";
		document.getElementById('countbox').innerHTML=out + gekinzuku;

		setTimeout("GetCount()", 1000);
	}
}
window.onload=function(){GetCount();}//call when everything has loaded
//-->
</script>
<div id="countbox"></div><br>

</body>


</html>