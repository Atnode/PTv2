<?php
session_start();
include("./includes/identifiants.php");
$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
if ($id==0) header('Location: erreur_403.html'); 
echo'<h2>Stats</h2><br><br>';
$diceRequete = $db->prepare('SELECT * FROM toadparty_stats LEFT JOIN forum_membres ON forum_membres.membre_id = toadparty_stats.id_joueur LEFT JOIN toadparty_participants ON toadparty_participants.id_joueur = toadparty_stats.id_joueur ORDER BY nombre_etoiles DESC, nombre_pieces DESC');
$diceRequete->execute() or die(print_r($diceRequete->errorInfo()));
while ($data = $diceRequete->fetch()) {

// On cherche le personnage correspondant
$query = $db->prepare('SELECT * FROM toadparty_personnages WHERE id = '.$data['id_perso'].'');
$query->execute();
$perso = $query->fetch();

echo'<b><span style="color:'.$perso['color_perso'].'">'.$perso['name_perso'].'</span></b> (<b><span style="color:'.$data['membre_couleur'].'">'.$data['membre_pseudo'].'</span></b>) a <b>'.$data['nombre_etoiles'].' étoile(s)</b> et <b>'.$data['nombre_pieces'].' pièce(s)</b>.<br><br>';
}
?>