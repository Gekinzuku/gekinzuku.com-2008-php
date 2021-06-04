<?php
$dahdate=getdate(date("U"));

if($dahdate[month]=="January")
{
switch($dahdate[mday])
 {
 case 1:
 $musiclist="";
 break;
 case 2:
 $musiclist="";
 break;
 case 3:
 $musiclist="";
 break;
 case 4:
 $musiclist="";
 break;
 case 5:
 $musiclist="";
 break;
 case 6:
 $musiclist="";
 break;
 case 7:
 $musiclist="";
 break;
 case 8:
 $musiclist="";
 break;
 case 9:
 $musiclist="";
 break;
 case 10:
 $musiclist="";
 break;
 case 11:
 $musiclist="";
 break;
 case 12:
 $musiclist="Promised Grace - Final Fantasy: Crystal Chronicles (GCN)"; break;
 case 13:
 $musiclist="Had Enough - Breaking Benjamin"; break;
 case 14:
 $musiclist="What I've Done - Linkin Park"; break;
 case 15:
 $musiclist="Blow Me Away - Halo Final Boss Theme [by Breaking Benjamin] (XBox)"; break;
 case 16:
 $musiclist="Drown - Three Days Grace"; break;
 case 17:
 $musiclist="Start Something - Lostprophets"; break;
 case 18:
 $musiclist="My Own Prison - Creed"; break;
 case 19:
 $musiclist="N64 Dream Land - Super Smash Brothers Melee (GCN)"; break;
 case 20:
 $musiclist="The Flood - Jars Of Clay"; break;
 case 21:
 $musiclist="Before It's Too Late - Goo Goo Dolls"; break;
 case 22:
 $musiclist="Minority - Green Day"; break;
 case 23:
 $musiclist="Walk The Sky - Fuel"; break;
 case 24:
 $musiclist="How You Remind Me - Nickelback"; break;
 case 25:
 $musiclist="My Hero - Foo Fighters"; break;
 case 26:
 $musiclist="Sandstorm - Darude"; break;
 case 27:
 $musiclist="No Roads Left - Linkin Park"; break;
 case 28:
 $musiclist="Smoke On The Water - Deep Purple"; break;
 case 29:
 $musiclist="Noah's Lute - Final Fantasy III (DS)"; break;
 case 30:
 $musiclist="Are You Gonna Be My Girl?"; break;
 case 31:
 $musiclist="Shallow Bay - Breaking Benjamin"; break;
 }
}
if($dahdate[month]=="February")
{
switch($dahdate[mday])
 {
 case 1:
 $musiclist="Hands Held High - Linkin Park"; break;
 case 2:
 $musiclist="Shotgun Bullet - F-Zero GX (GCN)"; break;
 case 3:
 $musiclist="Happy Birthday To My Brother"; break;
 case 4:
 $musiclist="Everything You Are - Goo Goo Dolls"; break;
 case 5:
 $musiclist="Sugarcoat - Breaking Benjamin"; break;
 case 6:
 $musiclist="Warning - Green Day"; break;
 case 7:
 $musiclist="Final Destination - Super Smash Brothers Melee (GCN)"; break;
 case 8:
 $musiclist="Stairway To Heaven (Live) - Led Zeppelin"; break;
 case 9:
 $musiclist="H! Vltg3 - Linkin Park"; break;
 case 10:
 $musiclist="Learn To Fly - Foo Fighters"; break;
 case 11:
 $musiclist="Illusion - Creed"; break;
 case 12:
 $musiclist="Break My Fall - Breaking Benjamin"; break;
 case 13:
 $musiclist="Phendrana Drifts - Metroid Prime (GCN)"; break;
 case 14:
 $musiclist="Gone Forever - Three Days Grace"; break;
 case 15:
 $musiclist="Everyday Combat - Lostprophets"; break;
 case 16:
 $musiclist="Green Hill Zone - Sonic The Hedgehog (NES)"; break;
 case 17:
 $musiclist="Polyamorous (Run Like Hell) - Breaking Benjamin"; break;
 case 18:
 $musiclist="Down Poison - 3 Doors Down"; break;
 case 19:
 $musiclist="Main Theme - Kontra (NES)"; break;
 case 20:
 $musiclist="End Of All Hope - Nightwish"; break;
 case 21:
 $musiclist="Ice Queen - Within Temptation"; break;
 case 22:
 $musiclist="One - Creed"; break;
 case 23:
 $musiclist="Krwing - Linkin Park"; break;
 case 24:
 $musiclist="If Everyone Cared - Nickelback"; break;
 case 25:
 $musiclist="Burn, Burn - Lostprophets"; break;
 case 26:
 $musiclist="Sugar - System Of A Down"; break;
 case 27:
 $musiclist="Brainstar - Super Smash Brothers Melee"; break;
 case 28:
 $musiclist=""; break;
 }
}
if($dahdate[month]=="March")
{
switch($dahdate[mday])
 {
 case 20:
 $musiclist="Ai No Uta - Super Smash Brothers Brawl"; break;
 case 21:
 $musiclist="Ai No Uta (French Version) - Super Smash Brothers Brawl"; break;
 case 22:
 $musiclist="Attack - System Of A Down"; break;
 case 23:
 $musiclist="Forgotten - Linkin Park"; break;
 case 24:
 $musiclist="Alone I Break - KoRn"; break;
 case 25:
 $musiclist="Basket Case - Green Day"; break;
 }
}

if ($musiclist!="")
{ echo "<b>I'm listening to " . $musiclist . "</b><br>"; }
?>