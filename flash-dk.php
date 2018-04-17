<?php
//Cette fonction doit être appelée avant tout code html
session_start();
$titre = "Planète Toad &bull; Super Mario Flash : Halloween Version";
$descrip = "La Zone Bonus contient des mini-jeux en flash disponibles uniquement en ligne sur Planète Toad.";
include("includes/identifiants.php");
include("includes/debut.php");
include("includes/menu.php");
?>
<div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> <a href="./musee_index.html">Musée Toad</a> --> <a href="./musee_jeux.html">Salle d'arcade</a></div><br />
<h1>Donkey Kong</h1>

<table style="margin:0 0 10px 0; width:244px; background:#fff; border:1px solid #F3F3F3;" cellpadding="0" cellspacing="0">
	<tbody>
		<tr>
			<td style="font-family:verdana; font-size:11px; color:#000; padding:5px 5px;">
				<object style="width: 640px; height: 480px;" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0"><param id="movie" value="http://www.jeuxclic.com/jeux/jeux-flash-1546.swf" /><param id="quality" value="high" /><param id="menu" value="false" /><embed style="width: 640px; height: 480px;" src="http://www.jeuxclic.com/jeux/jeux-flash-1546.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" menu="false" /></object>
			</td>
		</tr>
		<tr>
			<td style="font-family:verdana; font-size:11px; padding:5px 10px; border-top:1px solid #F3F3F3;" align="center">
				<strong><a href="http://www.jeuxclic.com/jeux.php?id=5330" target="_blank">Donkey kong</a></strong> | <a href="http://www.jeuxclic.com/categorie-jeux.php?cat=jeux-classiques" target="_blank">Jeux classiques</a> avec <a href="http://www.jeuxclic.com" title="Jeux avec Jeuxclic.com" target="_blank">Jeuxclic.com</a>
			</td>
		</tr>
	</tbody>
</table>

<?php

include("includes/fin.php");
?>