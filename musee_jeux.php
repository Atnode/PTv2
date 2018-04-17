<?php
//Cette fonction doit être appelée avant tout code html
session_start();
$titre = "Planète Toad &bull; Salle d'arcade";
$descrip = "La Zone Bonus contient des mini-jeux en flash disponibles uniquement en ligne sur Planète Toad.";
include("includes/identifiants.php");
include("includes/debut.php");
include("includes/menu.php");
?>
<div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> <a href="./musee-jeux.html">Salle d'arcade</a></div><br />
<h1>Musée Toad</h1>
<?php
if ($id!=0) 
{
	echo'<h2>Jeux</h2>
	<center>
	<p>Bienvenue dans la page des jeux. Ici, on peut jouer à plein de jeux et partager ses records !</p>
	<h2>Jeux exclus Planète Toad</h2>
	<p><span class="mdl-badge" data-badge="3"><a href="ToadA/"><img src="/images/toad-airplane.png" alt="Jouer à Toad\'s Airplane" title="Jouer à Toad\'s Airplane" width="192" height="71"></a></span></p>
	<p><span class="mdl-badge" data-badge="4"><a href="TCA2-0-1/"><img src="/images/TCA2.png" alt="Jouer à Toad\'s Castle Attack" title="Jouer à Toad\'s Castle Attack" width="192" height="71"></a></span></p><br /><br />
	
	<h2>Jeux flash</h2>
	<p><span class="mdl-badge" data-badge="3"><a href="flash-sploder.php"><img src="/images/sploder.png" alt="Jouer à des jeux Sploder" title="Jouer à des jeux Sploder" width="192" height="71"></a></span></p><br /><br /> 
	<p><em>Des nouveaux jeux vont arriver très prochainement. </em></p>
     
';
	
}
else
{
	echo'<h2>Jeux</h2>
	<center>
	<p>Bienvenue dans la page des jeux. Ici, on peut jouer à plein de jeux et partager ses records !<br/>
	Il faut être connecté pour accéder aux jeux.</p>
	</center>
		
';
}
include("includes/fin.php");
?>