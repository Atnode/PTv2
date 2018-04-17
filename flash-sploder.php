<?php
//Cette fonction doit être appelée avant tout code html
session_start();
$titre = "Planète Toad &bull; Super Mario Flash";
$descrip = "La Zone Bonus contient des mini-jeux en flash disponibles uniquement en ligne sur Planète Toad.";
include("includes/identifiants.php");
include("includes/debut.php");
include("includes/menu.php");
?>
<div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> <a href="./musee_index.html">Musée Toad</a> --> <a href="./musee_jeux.html">Salle d'arcade</a></div><br />
<h1>Jeu sur Sploder</h1>

<h2>La super aventure de Migumagus</h2>

<div style="text-align: center;">
<object type="application/x-shockwave-flash" data="http://www.sploder.com/player7.php?s=d004ywia&nocache=1" id="game" base="http://www.sploder.com" width="400" height="300" scale="noscale" salign="LT" >
<param name="base" value="http://www.sploder.com" />
<param name="movie" value="http://www.sploder.com/player7.php?s=d004ywia" />
<param name="s" value="d004ywia" />
<param name="scale" value="noscale" />
<param name="salign" value="LT" />
<param name="bgcolor" value="#333333" />
<!-- embedded thumbnail -->
<a href="http://www.sploder.com/?s=d004ywia" target="_blank" title="Sploder, Make Your Own Games"><img src="http://sploder.com/users/group1654/user1654391_20131015140504/thumbs/proj7500090.png" alt="La Super Aventure 3.2" /><br />Play Game</a>
<!-- end thumbnail -->
</object><br />
<!-- link code, helps support our community -->
<a href="http://www.sploder.com" target="_blank" style="font-size: x-small; color: #999; text-decoration: none;" title="Sploder, Make Your Own Games">Make a Free Flash Game</a>
</div>

<h2>Pays Collite et la Ville de Migumagus</h2>

<div style="text-align: center;">
<object type="application/x-shockwave-flash" data="http://www.sploder.com/player7.php?s=d004n8av&nocache=1" id="game" base="http://www.sploder.com" width="400" height="300" scale="noscale" salign="LT" >
<param name="base" value="http://www.sploder.com" />
<param name="movie" value="http://www.sploder.com/player7.php?s=d004n8av" />
<param name="s" value="d004n8av" />
<param name="scale" value="noscale" />
<param name="salign" value="LT" />
<param name="bgcolor" value="#333333" />
<!-- embedded thumbnail -->
<a href="http://www.sploder.com/?s=d004n8av" target="_blank" title="Sploder, Make Your Own Games"><img src="http://sploder.com/users/group1654/user1654391_20131015140504/thumbs/proj6998806.png" alt="Pays Collite Et La Ville" /><br />Play Game</a>
<!-- end thumbnail -->
</object><br />
<!-- link code, helps support our community -->
<a href="http://www.sploder.com" target="_blank" style="font-size: x-small; color: #999; text-decoration: none;" title="Sploder, Make Your Own Games">Make a Free Flash Game</a>
</div>

<h2>La super aventure 2 de Migumagus</h2>

<div style="text-align: center;">
<object type="application/x-shockwave-flash" data="http://www.sploder.com/player7.php?s=d003xdup&nocache=1" id="game" base="http://www.sploder.com" width="400" height="300" scale="noscale" salign="LT" >
<param name="base" value="http://www.sploder.com" />
<param name="movie" value="http://www.sploder.com/player7.php?s=d003xdup" />
<param name="s" value="d003xdup" />
<param name="scale" value="noscale" />
<param name="salign" value="LT" />
<param name="bgcolor" value="#333333" />
<!-- embedded thumbnail -->
<a href="http://www.sploder.com/?s=d003xdup" target="_blank" title="Sploder, Make Your Own Games"><img src="http://sploder.com/users/group1654/user1654391_20131015140504/thumbs/proj5933750.png" alt="La Super Aventure 2" /><br />Play Game</a>
<!-- end thumbnail -->
</object><br />
<!-- link code, helps support our community -->
<a href="http://www.sploder.com" target="_blank" style="font-size: x-small; color: #999; text-decoration: none;" title="Sploder, Make Your Own Games">Make a Free Flash Game</a>
</div>


<?php

include("includes/fin.php");
?>