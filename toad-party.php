<?php
session_start();
include("./includes/identifiants.php");
$titre =  'Planète Toad &bull; Toad Party';
$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
if ($id==0) header('Location: erreur_403.html'); 
include("./includes/debut.php");
include("./includes/menu.php");
?>
<div id="filariane">>> <a href="./">Index</a> --> <a href="./toad-party.php">Toad Party</a></div>
<br><h1>Toad Party</h1>
<br><div style="text-align:center;"><a href="./toad-party-game.php" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">CLIQUER ICI POUR COMMENCER LA PARTIE</a></div><br><br>
<h2>Liste des participants</h2>
<?php
$query = $db->prepare('SELECT * FROM toadparty_participants LEFT JOIN forum_membres ON forum_membres.membre_id = toadparty_participants.id_joueur LEFT JOIN toadparty_personnages ON toadparty_personnages.id = toadparty_participants.id_perso');
$query->execute();
echo'<br><p style="text-align:center;">';
while ($data=$query->fetch()) {
	echo'<a href="./profil-'.$data['membre_id'].'.html" style="color:'.$data['membre_couleur'].'">
        '.stripslashes(htmlspecialchars($data['membre_pseudo'])).'</a> <i>s\'est inscrit(e) avec le personnage</i> <span style="font-weight:bold;color:'.$data['color_perso'].';">'.$data['name_perso'].'</span><br><br>';
}


include("./includes/fin.php");
?>