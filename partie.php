<?php
//Cette fonction doit être appelée avant tout code html
session_start();

$titre = "Planète Toad &bull; Partie de NumberFind";
include("./includes/identifiants.php");
include("./includes/debut.php");
include("./includes/menu.php");
?>
<style>
.welcomeNF {
	margin-left: auto;
	margin-right: auto;
	background-color: grey;
	border-radius: 10px;
	text-align: center;
    width: 390px;
}

.welcomeNFTD {
	border:none;
}
</style>
<div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> <a href="./partie.html">Partie de NumberFind</a></div><br />
<div class="welcomeNF"><table><tbody><tr><td class="welcomeNFTD"><img src="./images/avatars/1420278214.png" title="Bienvenue" alt="Bienvenue" width="124" height="150" /></td>
<td class="welcomeNFTD"><br /><span style="text-align:center; font-weight:bold;">Bienvenue !</span><br /><br />
<b>NumberFind</b> est un fangame conçu pour Planète Toad. Ce jeu consiste à deviner un nombre entre 1 et 1000 en suivant les indices donnés. Vous avez 50 tentatives. Au-delà de cette limite, vous serez disqualifié. La partie se fait au minimum à 2 joueurs et au maximum à 5 joueurs.</td></tr></tbody></table></div>
<?php

$query=$db->prepare('SELECT * FROM validateur_FINDNUMBER');
$query->execute();
$data = $query->fetch();
if(empty($data['id_partie'])) { //S'il n'y a pas de partie en cours
	echo'<center><br />Il n\'y a aucune partie en cours pour le moment.</center>';
	if ($lvl>4) {
		echo'<br /><center><a href="./create-partie.php">>>Créer une partie<<</a></center>';
	}
} else { //SINON
	if ($data['partie_commence']==0) { // SI LA partie est pas encore commencée
		echo'<center>La partie n\'a pas encore commencé. <br /> <a href="./rejoindre-partie.html">>>Rejoindre la partie<<</a></center>';
    if ($lvl>4) {
		echo'<br /><center><a href="./commencer-partie.php">>>Commencer la partie<<</a></center>';
	}
	    
	} else {
		
	}
}

include("./includes/fin.php");
?>