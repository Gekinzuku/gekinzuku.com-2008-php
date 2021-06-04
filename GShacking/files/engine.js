var xmlHttp
var RanOnce = "false"

function getData()
{

fart = document.getElementById("area");

usethis = fart.options[fart.selectedIndex].text;

if (fart.options[fart.selectedIndex].text == "--- Select Area ---")
return;

Loading("on");

if(RanOnce != "false")
{
var r=confirm("Any changes you have made to the current area will be lost.\n\nContinue?");
if (r != true)
{
fart.selectedIndex = 0;
Loading("off");
return;
}
}

fart.selectedIndex = 0;

RanOnce = "true";

xmlHttp=GetXmlHttpObject()
if (xmlHttp==null)
{
alert ("Browser does not support HTTP Request")
return
}

var url="getgroups.php"
url=url+"?SelLoc=" + usethis
url=url+"&sid="+Math.random()
xmlHttp.onreadystatechange=stateChanged
xmlHttp.open("GET",url,true)
xmlHttp.send(null)
}

function stateChanged()
{
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
{
document.getElementById("groups").innerHTML = xmlHttp.responseText;

xmlHttp=GetXmlHttpObject()
if (xmlHttp==null)
{
alert ("Browser does not support HTTP Request")
return
}

var url="getactors.php"
url=url+"?SelLoc=" + usethis
url=url+"&sid="+Math.random()
xmlHttp.onreadystatechange=stateChanged2
xmlHttp.open("GET",url,true)
xmlHttp.send(null)

}
}

function stateChanged2()
{
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
{
document.getElementById("ActorsInArea").innerHTML = xmlHttp.responseText;
document.getElementById("info").innerHTML = "<b>Update: </b>Area changed to " + usethis + ".";
document.getElementById("code").innerHTML = "";
Loading("off");
}
}

function GetXmlHttpObject()
{
var objXMLHttp=null
if (window.XMLHttpRequest)
{
objXMLHttp=new XMLHttpRequest()
}
else if (window.ActiveXObject)
{
objXMLHttp=new ActiveXObject("Microsoft.XMLHTTP")
}
return objXMLHttp
}

function Loading(onoff)
{
if (onoff == "on")
{
document.getElementById("loading").innerHTML = '<img src="images/loading.gif" alt="loading" />';
}
else
{
document.getElementById("loading").innerHTML = '<input type="button" value="Create Code" onclick="CreateCode();">';
}
}