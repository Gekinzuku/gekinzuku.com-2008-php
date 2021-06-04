var GroupOrg = new Array();

//stores actor info from server
var AGroup = new Array();
var ANum = new Array();
var AVar = new Array();

//stores actor co-ordinates
var Xco = new Array();
var Yco = new Array();
var Zco = new Array();

//stores actor rotation
var Xrot = new Array();
var Yrot = new Array();
var Zrot = new Array();


/***********************************
** Puts Group Value Into Text Box **
***********************************/
function PutValInBox()
{
	var dropbox = document.getElementById("group");
	document.getElementById("groupval").value = dropbox.options[dropbox.selectedIndex].title;
	document.getElementById("groupval").focus();
}

/***********************
** Resets Group Value **
***********************/
function ResetGroup()
{
	var dropbox = document.getElementById("group");

	if(dropbox.options[dropbox.selectedIndex].title == "" || dropbox.options[dropbox.selectedIndex].title == "-- Select Group --")
	{
		document.getElementById("info").innerHTML = "<b>Error:</b> You didn't select an group to modify!";
		return;
	}

	//moves count down if the group wasn't already the original value
	if(dropbox.options[dropbox.selectedIndex].title != GroupOrg[dropbox.selectedIndex])
	{
		//displays number of groups changed
		var GroupEdits = document.getElementById("groupedits").innerHTML;
		GroupEdits --;
		document.getElementById("groupedits").innerHTML = GroupEdits;
	}

	dropbox.options[dropbox.selectedIndex].title = GroupOrg[dropbox.selectedIndex];
	document.getElementById("groupval").value = GroupOrg[dropbox.selectedIndex];

	document.getElementById("info").innerHTML = "<b>Update: </b>Group set back to original value.";
}

/***********************
** Updates Group Info **
***********************/
function UpdateGroup()
{
	var dropbox = document.getElementById("group");	
	if(dropbox.options[dropbox.selectedIndex].title == "" || dropbox.options[dropbox.selectedIndex].title == "-- Select Group --")
	{
		document.getElementById("info").innerHTML = "<b>Error:</b> You didn't select an group to modify!";
		return;
	}

	//makes sure the user inputted a four character value
	if(document.getElementById("groupval").value.length == 4)
	{
		//stores the original value so the system can determine which ones are changed
		if (GroupOrg[dropbox.selectedIndex] == null)
		{
			GroupOrg[dropbox.selectedIndex] = dropbox.options[dropbox.selectedIndex].title;

			//displays number of groups changed
			var GroupEdits = document.getElementById("groupedits").innerHTML;
			GroupEdits ++;
			document.getElementById("groupedits").innerHTML = GroupEdits;
		}
		dropbox.options[dropbox.selectedIndex].title = document.getElementById("groupval").value.toUpperCase();

		//displays info in info center
		document.getElementById("info").innerHTML = "<b>Update:</b> " + dropbox.options[dropbox.selectedIndex].text + "'s group has been updated to " + document.getElementById("groupval").value.toUpperCase() + ".";

		//moves count down if the group was changed back to the original value
		if(dropbox.options[dropbox.selectedIndex].title == GroupOrg[dropbox.selectedIndex])
		{
			//displays number of groups changed
			var GroupEdits = document.getElementById("groupedits").innerHTML;
			GroupEdits --;
			document.getElementById("groupedits").innerHTML = GroupEdits;
		}

	}
	else
	{
		document.getElementById("info").innerHTML = "<b>Error:</b> The group value must be four characters in length.";
	}
}

/************************************
** Updates The Actor Selection Box **
************************************/
function UpdateActor()
{
	var dropbox1 = document.getElementById("ActorOptions");	
	var dropbox2 = document.getElementById("Actor");	

	if (dropbox1.options[dropbox1.selectedIndex].text == "-- Select An Actor --")
	{
		document.getElementById("info").innerHTML = "<b>Error:</b> You didn't select an actor to modify!";
		return;
	}
	dropbox1.options[dropbox1.selectedIndex].title = dropbox2.options[dropbox2.selectedIndex].text;

	//Receives info for actor
	Loading("on");

	xmlHttp=GetXmlHttpObject()
	if (xmlHttp==null)
	{
		alert ("Browser does not support HTTP Request")
		return
	}

	var url="getactorinfo.php"
	url=url+"?Actor=" + dropbox2.options[dropbox2.selectedIndex].text
	url=url+"&action=group"
	url=url+"&sid="+Math.random()
	xmlHttp.onreadystatechange=GroupPut
	xmlHttp.open("GET",url,true)
	xmlHttp.send(null)
}

/********************************
** Checks Actor Info and Warns **
********************************/
function CheckActorInfo(ActorNum)
{
	
	if(AGroup[ActorNum] == "0001 " || AGroup[ActorNum] == "0000 ")
		return;

	document.getElementById("info").innerHTML = document.getElementById("info").innerHTML + "<br /><b>Warning: </b>This actor requires group: " + AGroup[ActorNum]; 
}

/*********************************
** Checks Data And Creates Code **
*********************************/
function CreateCode()
{
	var dropbox = document.getElementById("group");	
	var dropbox2 = document.getElementById("ActorOptions");	

	var opt = "";
	
	//adds all the group info first
	for(i=1; i <= dropbox.length; i++)
	{
		if (GroupOrg[i] != null && GroupOrg[i] != dropbox.options[i].title)
			opt = opt + "81" + dropbox.options[i].value + " " + dropbox.options[i].title + "<br />";
	}

	//adds all the actor specific things
	for(i=1; i <= dropbox2.length; i++)
	{
		if(ANum[i] != null && AVar != null)
		{
			opt = opt + "81" + dropbox2.options[i].value + " " + ANum[i] + "<br />";

			//Adds X co-ord
			if(Xco[i] != null)
				opt = opt + "81" + d2h(h2d(dropbox2.options[i].value) + 2) + " " + Xco[i] + "<br />";

			//Adds Y co-ord
			if(Yco[i] != null)
				opt = opt + "81" + d2h(h2d(dropbox2.options[i].value) + 4) + " " + Yco[i] + "<br />";

			//Adds Z co-ord
			if(Zco[i] != null)
				opt = opt + "81" + d2h(h2d(dropbox2.options[i].value) + 6) + " " + Zco[i] + "<br />";

			//Adds X rot
			if(Xrot[i] != null)
				opt = opt + "81" + d2h(h2d(dropbox2.options[i].value) + 8) + " " + Xrot[i] + "<br />";

			//Adds Y rot
			if(Yrot[i] != null)
				opt = opt + "81" + d2h(h2d(dropbox2.options[i].value) + 10) + " " + Yrot[i] + "<br />";

			//Adds Z rot
			if(Zrot[i] != null)
				opt = opt + "81" + d2h(h2d(dropbox2.options[i].value) + 12) + " " + Zrot[i] + "<br />";

			//Adds the actor's varible
			if(AVar[i] != "* ")
				opt = opt + "81" + d2h(h2d(dropbox2.options[i].value) + 14) + " " + AVar[i] + "<br />";
		}
	}
	

	//if no changes were found, terminate
	if (opt == "")
	{
		document.getElementById("info").innerHTML = "<b>Error:</b> No changes were found!";
		return;
	}

	//writes the code
	document.getElementById("code").innerHTML = opt.toUpperCase();
	document.getElementById("info").innerHTML = "<b>Code created!</b>";
}


/*******************************
** Updates The Actor Position **
*******************************/
function UpdatePos()
{
	var dropbox1 = document.getElementById("ActorOptions");	

	//verify an actor is selected
	if (dropbox1.options[dropbox1.selectedIndex].text == "-- Select An Actor --")
	{
		document.getElementById("info").innerHTML = "<b>Error:</b> You didn't select an actor to modify!";
		return;
	}

	//First make sure at least one of the boxes is filled
	if(document.getElementById("Xco").value == "" && document.getElementById("Yco").value == "" && document.getElementById("Zco").value == "" && document.getElementById("Xrot").value == "" && document.getElementById("Yrot").value == "" && document.getElementById("Zrot").value == "")
	{
		document.getElementById("info").innerHTML = "<b>Error: </b>No co-ordinate or rotation box was filled!";
		return;
	}

	var XCoTemp = "";
	var YCoTemp = "";
	var ZCoTemp = "";

	var XRotTemp = "";
	var YRotTemp = "";
	var ZRotTemp = "";

	//Figures out which ones are used
	if(document.getElementById("Xco").value != "")
	{
		//verifies all the box doesn't have four characters, terminate
		if(document.getElementById("Xco").value.length != 4) 
		{
			document.getElementById("info").innerHTML = "<b>Error: </b>Co-ordinate or rotation box needs four characters!";
			return;
		}
			
		//else we temp take the value
		XCoTemp = document.getElementById("Xco").value;
	}

	if(document.getElementById("Yco").value != "")
	{
		//verifies all the box doesn't have four characters, terminate
		if(document.getElementById("Yco").value.length != 4) 
		{
			document.getElementById("info").innerHTML = "<b>Error: </b>Co-ordinate or rotation box needs four characters!";
			return;
		}
			
		//else we temp take the value
		YCoTemp = document.getElementById("Yco").value;
	}

	if(document.getElementById("Zco").value != "")
	{
		//verifies all the box doesn't have four characters, terminate
		if(document.getElementById("Zco").value.length != 4) 
		{
			document.getElementById("info").innerHTML = "<b>Error: </b>Co-ordinate or rotation box needs four characters!";
			return;
		}
			
		//else we temp take the value
		ZCoTemp = document.getElementById("Zco").value;
	}

	if(document.getElementById("Xrot").value != "")
	{
		//verifies all the box doesn't have four characters, terminate
		if(document.getElementById("Xrot").value.length != 4) 
		{
			document.getElementById("info").innerHTML = "<b>Error: </b>Co-ordinate or rotation box needs four characters!";
			return;
		}
			
		//else we temp take the value
		XRotTemp = document.getElementById("Xrot").value;
	}

	if(document.getElementById("Yrot").value != "")
	{
		//verifies all the box doesn't have four characters, terminate
		if(document.getElementById("Yrot").value.length != 4) 
		{
			document.getElementById("info").innerHTML = "<b>Error: </b>Co-ordinate or rotation box needs four characters!";
			return;
		}
			
		//else we temp take the value
		YRotTemp = document.getElementById("Yrot").value;
	}

	if(document.getElementById("Zrot").value != "")
	{
		//verifies all the box doesn't have four characters, terminate
		if(document.getElementById("Zrot").value.length != 4) 
		{
			document.getElementById("info").innerHTML = "<b>Error: </b>Co-ordinate or rotation box needs four characters!";
			return;
		}
			
		//else we temp take the value
		ZRotTemp = document.getElementById("Zrot").value;
	}
	
	//Now puts the temps into the actual spots. Why'd we do it this way? 
	//This way we can make sure all the boxes are proper before filling in ANY info :P

	//clears varibles
	Xco[dropbox1.selectedIndex] = null;
	Yco[dropbox1.selectedIndex] = null;
	Zco[dropbox1.selectedIndex] = null;
	Xrot[dropbox1.selectedIndex] = null;
	Yrot[dropbox1.selectedIndex] = null;
	Zrot[dropbox1.selectedIndex] = null;

	if(XCoTemp != "")
		Xco[dropbox1.selectedIndex] = XCoTemp;
	if(YCoTemp != "")
		Yco[dropbox1.selectedIndex] = YCoTemp;
	if(ZCoTemp != "")
		Zco[dropbox1.selectedIndex] = ZCoTemp;

	if(XRotTemp != "")
		Xrot[dropbox1.selectedIndex] = XRotTemp;
	if(YRotTemp != "")
		Yrot[dropbox1.selectedIndex] = YRotTemp;
	if(ZRotTemp != "")
		Zrot[dropbox1.selectedIndex] = ZRotTemp;	

	//displays success for this big ass function
	document.getElementById("info").innerHTML = "<b>Update: </b>Co-ordinates and rotation data added.";
}

/*************************
** Clears Position Data **
*************************/
function ClearPos()
{
	var dropbox1 = document.getElementById("ActorOptions");	

	//verify an actor is selected
	if (dropbox1.options[dropbox1.selectedIndex].text == "-- Select An Actor --")
	{
		document.getElementById("info").innerHTML = "<b>Error:</b> You didn't select an actor to modify!";
		return;
	}

	//clears varibles
	Xco[dropbox1.selectedIndex] = null;
	Yco[dropbox1.selectedIndex] = null;
	Zco[dropbox1.selectedIndex] = null;
	Xrot[dropbox1.selectedIndex] = null;
	Yrot[dropbox1.selectedIndex] = null;
	Zrot[dropbox1.selectedIndex] = null;

	//clears boxes
	document.getElementById("Xco").value = "";
	document.getElementById("Yco").value = "";
	document.getElementById("Zco").value = "";

	document.getElementById("Xrot").value = "";
	document.getElementById("Yrot").value = "";
	document.getElementById("Zrot").value = "";

	document.getElementById("info").innerHTML = "<b>Update: </b>Co-ordinates and rotation data removed.";
}

/**********************************
** Small Dumb Functions For AJAX **
**********************************/

//Yeah, I know they suck

//gets the actor group
function GroupPut()
{
	var dropbox1 = document.getElementById("ActorOptions");	
	var dropbox2 = document.getElementById("Actor");	
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{
		AGroup[dropbox1.selectedIndex] = xmlHttp.responseText;
		
		xmlHttp=GetXmlHttpObject()
		var url="getactorinfo.php"
		url=url+"?Actor=" + dropbox2.options[dropbox2.selectedIndex].text
		url=url+"&action=var"
		url=url+"&sid="+Math.random()
		xmlHttp.onreadystatechange=VarPut
		xmlHttp.open("GET",url,true)
		xmlHttp.send(null)
	}
}

//gets the actor variable 
function VarPut()
{
	var dropbox1 = document.getElementById("ActorOptions");	
	var dropbox2 = document.getElementById("Actor");
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{
		AVar[dropbox1.selectedIndex] = xmlHttp.responseText;

		xmlHttp=GetXmlHttpObject()
		var url="getactorinfo.php"
		url=url+"?Actor=" + dropbox2.options[dropbox2.selectedIndex].text
		url=url+"&action=num"
		url=url+"&sid="+Math.random()
		xmlHttp.onreadystatechange=NumPut
		xmlHttp.open("GET",url,true)
		xmlHttp.send(null)
	}
}

//gets the actor number
function NumPut()
{
	var dropbox1 = document.getElementById("ActorOptions");	
	var dropbox2 = document.getElementById("Actor");
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{
		ANum[dropbox1.selectedIndex] = xmlHttp.responseText;
		document.getElementById("info").innerHTML = "<b>Update:</b> " + dropbox1.options[dropbox1.selectedIndex].text + " changed to " + dropbox2.options[dropbox2.selectedIndex].text + ".";
		CheckActorInfo(dropbox1.selectedIndex);
		Loading("off");
	}
}

/******************************
** Decimal to Hex Converters **
******************************/
function d2h(d) {return d.toString(16);}
function h2d(h) {return parseInt(h,16);}