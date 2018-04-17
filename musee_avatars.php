<?php
//Cette fonction doit être appelée avant tout code html
session_start();
$titre = "Planète Toad &bull; Galerie";
$descrip = "La Zone Bonus contient des mini-jeux en flash disponibles uniquement en ligne sur Planète Toad.";
include("includes/identifiants.php");
include("includes/debut.php");
include("includes/menu.php");
?>
<div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> <a href="./musee_avatars.html">Galerie</a></div><br />
<h1>Galerie</h1>
<?php
if ($id!=0) 
{
	echo'
	
<div class="gavatar">
    <img class="membreava" src="avatars/A001.png" alt="Yoshi" />
    <p>Avatar de Yoshi par Maxhu</p>
	<p><a href="avatars/A001.png" download="Avatar PT.png" />Télécharger !</a></p>
</div>

<div class="gavatar">
    <img src="avatars/A002.png" alt="Toad" /></p>
    <p>Avatar de Toad par Maxhu</p>
	<p><a href="avatars/A002.png" download="Avatar PT.png" />Télécharger !</a></p>
</div>

<div class="gavatar">
    <img class="membreava" src="avatars/A003.png" alt="Koopa" /></p>
    <p>Avatar de Koopa par Maxhu</p>
	<p><a href="avatars/A003.png" download="Avatar PT.png" />Télécharger !</a></p>
</div>

<div class="gavatar">
    <img class="membreava" src="avatars/A004.png" alt="Maskass" /></p>
    <p>Avatar de Maskass par Oceantix</p>
	<p><a href="avatars/A004.png" download="Avatar PT.png" />Télécharger !</a></p>
</div>

<div class="gavatar">
    <img class="membreava" src="avatars/A005.png" alt="Thwomp" /></p>
    <p>Avatar de Thwomp par oceantix</p>
	<p><a href="avatars/A005.png" download="Avatar PT.png" />Télécharger !</a></p>
</div>

<div class="gavatar">
    <img class="membreava" src="avatars/A006.png" alt="Luigi" /></p>
    <p>Avatar de Luigi par Kerouz</p>
	<p><a href="avatars/A006.png" download="Avatar PT.png" />Télécharger !</a></p>
</div>

<div class="gavatar">
    <img class="membreava" src="avatars/A007.png" alt="Diddy Kong" /></p>
    <p>Avatar de Diddy Kong par Kerouz</p>
	<p><a href="avatars/A007.png" download="Avatar PT.png" />Télécharger !</a></p>
</div>

<div class="gavatar">
    <img class="membreava" src="avatars/A008.png" alt="Harmonie" /></p>
    <p>Avatar d\'Harmonie par Kerouz</p>
	<p><a href="avatars/A008.png" download="Avatar PT.png" />Télécharger !</a></p>
</div>

<div class="gavatar">
    <img class="membreava" src="avatars/A009.png" alt="Mario nuage" /></p>
    <p>Avatar de Mario Nuage par Haruna</p>
	<p><a href="avatars/A009.png" download="Avatar PT.png" />Télécharger !</a></p>
</div>

<div class="gavatar">
    <img class="membreava" src="avatars/A010.png" alt="Bowser Jr" /></p>
    <p>Avatar de Bowser Jr. par Kerouz</p>
	<p><a href="avatars/A010.png" download="Avatar PT.png" />Télécharger !</a></p>
</div>

<div class="gavatar">
    <img class="membreava" src="avatars/A011.png" alt="Larry" /></p>
    <p>Avatar de Larry par Kerouz</p>
	<p><a href="avatars/A011.png" download="Avatar PT.png" />Télécharger !</a></p>
</div>

<div class="gavatar">
    <img class="membreava" src="avatars/A012.png" alt="Roy" /></p>
    <p>Avatar de Roy par Kerouz</p>
	<p><a href="avatars/A012.png" download="Avatar PT.png" />Télécharger !</a></p>
</div>

<div class="gavatar">
    <img class="membreava" src="avatars/A013.png" alt="Iggy" /></p>
    <p>Avatar de Iggy par Kerouz</p>
	<p><a href="avatars/A013.png" download="Avatar PT.png" />Télécharger !</a></p>
</div>

<div class="gavatar">
    <img class="membreava" src="avatars/A014.png" alt="Lemmy" /></p>
    <p>Avatar de Lemmy par Kerouz</p>
	<p><a href="avatars/A014.png" download="Avatar PT.png" />Télécharger !</a></p>
</div>

<div class="gavatar">
    <img class="membreava" src="avatars/A015.png" alt="Ludwig" /></p>
    <p>Avatar de Ludwig par Kerouz</p>
	<p><a href="avatars/A015.png" download="Avatar PT.png" />Télécharger !</a></p>
</div>

<div class="gavatar">
    <img class="membreava" src="avatars/A016.png" alt="Morton Jr" /></p>
    <p>Avatar de Morton Jr par Kerouz</p>
	<p><a href="avatars/A016.png" download="Avatar PT.png" />Télécharger !</a></p>
</div>

<div class="gavatar">
    <img class="membreava" src="avatars/A017.png" alt="Wendy" /></p>
    <p>Avatar de Wendy par Kerouz</p>
	<p><a href="avatars/A017.png" download="Avatar PT.png" />Télécharger !</a></p>
</div>

<div class="gavatar">
    <img class="membreava" src="avatars/A018.png" alt="Maskass" /></p>
    <p>Avatar de Maskass par Maxhu</p>
	<p><a href="avatars/A018.png" download="Avatar PT.png" />Télécharger !</a></p>
</div>

<div class="gavatar">
    <img class="membreava" src="avatars/A019.png" alt="Skelerex" /></p>
    <p>Avatar de Skelerex par Maxhu</p>
	<p><a href="avatars/A019.png" download="Avatar PT.png" />Télécharger !</a></p>
</div>

<div class="gavatar">
    <img class="membreava" src="avatars/A020.png" alt="Lakitu" /></p>
    <p>Avatar de Lakitu par Maxhu</p>
	<p><a href="avatars/A020.png" download="Avatar PT.png" />Télécharger !</a></p>
</div>

<div class="gavatar">
    <img src="avatars/A021.png" alt="Bomb-omb" /></p>
    <p>Avatar de Bob-omb par Maxhu</p>
	<p><a href="avatars/A021.png" download="Avatar PT.png" />Télécharger !</a></p>
</div>

<div class="gavatar">
    <img src="avatars/A022.png" alt="Frère Marto" /></p>
    <p>Avatar de Frère Marto par Maxhu</p>
	<p><a href="avatars/A022.png" download="Avatar PT.png" />Télécharger !</a></p>
</div>

<div class="gavatar">
    <img src="avatars/A023.png" alt="Goomba" /></p>
    <p>Avatar de Goomba par Maxhu</p>
	<p><a href="avatars/A023.png" download="Avatar PT.png" />Télécharger !</a></p>
</div>

<div class="gavatar">
    <img src="avatars/A024.png" alt="Toaddle" /></p>
    <p>Avatar de Captain Toad par Toaddle</p>
	<p><a href="avatars/A024.png" download="Avatar PT.png" />Télécharger !</a></p>
</div>

<div class="gavatar">
    <img src="avatars/A025.png" alt="Toadette" /></p>
    <p>Avatar de Toadette par Toaddle</p>
	<p><a href="avatars/A025.png" download="Avatar PT.png" />Télécharger !</a></p>
</div>

<div class="gavatar">
    <img src="avatars/A026.png" alt="Wario" /></p>
    <p>Avatar de Wario par Toaddle</p>
	<p><a href="avatars/A026.png" download="Avatar PT.png" />Télécharger !</a></p>
</div>

<div class="gavatar">
    <img src="avatars/A027.png" alt="Gracowitz" /></p>
    <p>Avatar de Gracowitz par Toaddle</p>
	<p><a href="avatars/A027.png" download="Avatar PT.png" />Télécharger !</a></p>
</div>

<div class="gavatar">
    <img src="avatars/A028.png" alt="Bowser" /></p>
    <p>Avatar de Bowser par Toaddle</p>
	<p><a href="avatars/A028.png" download="Avatar PT.png" />Télécharger !</a></p>
</div>

<div class="gavatar">
    <img src="avatars/A029.png" alt="Donkey Kong" /></p>
    <p>Avatar de Donkey Kong par Toaddle</p>
	<p><a href="avatars/A029.png" download="Avatar PT.png" />Télécharger !</a></p>
</div>

<div class="gavatar">
    <img src="avatars/A030.png" alt="Professeur Karl Tastroff" /></p>
    <p>Avatar du Professeur Karl Tastroff par Toaddle</p>
	<p><a href="avatars/A030.png" download="Avatar PT.png" />Télécharger !</a></p>
</div>

<div class="gavatar">
    <img src="avatars/A031.png" alt="Wiggler" /></p>
    <p>Avatar de Wiggler fait par Champoad</p>
	<p><a href="avatars/A031.png" download="Avatar PT.png" />Télécharger !</a></p>
</div>

<div class="gavatar">
    <img src="avatars/A032.png" alt="Mario Retro" /></p>
    <p>Avatar de Mario (Retro) fait par Toaddle</p>
	<p><a href="avatars/A032.png" download="Avatar PT.png" />Télécharger !</a></p>
</div>

<div class="gavatar">
    <img src="avatars/A033.png" alt="Dr.Mario" /></p>
    <p>Avatar de Dr.Mario fait par Toaddle</p>
	<p><a href="avatars/A033.png" download="Avatar PT.png" />Télécharger !</a></p>
</div>

<div class="gavatar">
    <img src="avatars/A034.png" alt="Helico-Maskass" /></p>
    <p>Avatar d\'Helico-Maskass fait par Toaddle</p>
	<p><a href="avatars/A034.png" download="Avatar PT.png" />Télécharger !</a></p>
</div>

<div class="gavatar">
    <img src="avatars/A035.png" alt="Mario" /></p>
    <p>Avatar de Mario fait par Toaddle</p>
	<p><a href="avatars/A035.png" download="Avatar PT.png" />Télécharger !</a></p>
</div>

<div class="gavatar">
    <img src="avatars/A036.png" alt="Funky Kong" /></p>
    <p>Avatar de Funky-Kong fait par Oceantix</p>
	<p><a href="avatars/A036.png" download="Avatar PT.png" />Télécharger !</a></p>
</div>

<div class="gavatar">
    <img src="avatars/A037.png" alt="Peach" /></p>
    <p>Avatar de Peach fait par Oceantix</p>
	<p><a href="avatars/A037.png" download="Avatar PT.png" />Télécharger !</a></p>
</div>

<div class="gavatar">
    <img src="avatars/A038.png" alt="Waluigi" /></p>
    <p>Avatar de Waluigi fait par Oceantix</p>
	<p><a href="avatars/A038.png" download="Avatar PT.png" />Télécharger !</a></p>
</div>

<div class="gavatar">
    <img src="avatars/A040.png" alt="Avatar de Koopa" /></p>
    <p>Avatar de Koopa fait par Champoad</p>
	<p><a href="avatars/A040.png" download="Avatar PT.png" />Télécharger !</a></p>
</div>

<div class="gavatar">
    <img src="avatars/A041.png" alt="Avatar de Koopa Bleu" /></p>
    <p>Avatar de Koopa Bleu fait par Toaddle</p>
	<p><a href="avatars/A041.png" download="Avatar PT.png" />Télécharger !</a></p>
</div>

<div class="gavatar">
    <img src="avatars/A042.png" alt="Avatar de Koopa Bleu" /></p>
    <p>Avatar de Koopa Bleu fait par Champoad</p>
	<p><a href="avatars/A042.png" download="Avatar PT.png" />Télécharger !</a>
</div>
';
	
}
else
{
	echo'<h2>Galerie d\'avatars</h2>
	
	<p>Vous devez être inscrit pour télécharger les avatars."</p>
	
';
}
include("includes/fin.php");
?>