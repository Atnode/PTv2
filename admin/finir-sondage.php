<?php
session_start();
$titre="Planète Toad &bull; Administration";
$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
$admin = 1;
include("../includes/identifiants.php");
include("../includes/debut.php");
if ($lvl<5) header('Location: ../erreur_403.html'); 
include("../includes/menu.php");

echo'<br><h1>Publier les résultats du sondage</h1><br><br>';
if (!isset($_POST['diagramme'])) {
echo'<form method="post" action="finir-sondage.php">
<label for="diagramme">Lien du diagramme :</label>
<input type="text" name="diagramme" id="diagramme" value=""><br><br>
<input class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit" value="Publier les résultats et vider les votes !" /></form>';
} else {
$diagramme = $_POST['diagramme'];

// Num du sondage
$query = $db->prepare('SELECT * FROM sondage');
$query->execute();
$data = $query->fetch();

// Nombre de votes
$numberVotes = $db->prepare('SELECT * FROM sondage_vote');
$numberVotes->execute();

// On fait la news
$newsContenu = "Bonjour à tous. Je vais vous présenter les résultats du sondage numéro ".$data['id_sondage'].".


[center][b][s]Résultats[/s][/b]

".$diagramme."[/center]


Il y a eu : <b>".$numberVotes->rowCount()."</b> votes.

Sinon, il y a déjà un nouveau sondage, n'hésitez pas à aller voter !";

$query = $db->prepare('INSERT INTO news (posteur_id, titre, contenu, timestamp, icon, valide) VALUES (:id, :titre, :contenu, :timestamp, :icon, :valide)');
$query->bindValue(':id',$id,PDO::PARAM_INT);
$query->bindValue(':titre',"[Résultats Sondage #".$data['id_sondage']."] ".$data['question']."",PDO::PARAM_STR);
$query->bindValue(':contenu',$newsContenu,PDO::PARAM_STR);
$query->bindValue(':timestamp',time(),PDO::PARAM_INT);
$query->bindValue(':icon',"0",PDO::PARAM_STR);
$query->bindValue(':valide',"1",PDO::PARAM_INT);
$query->execute();

// On ajoute les 10 Champis au posteur
$query = $db->prepare('UPDATE forum_membres SET membre_champi = membre_champi + 10, champi_total = champi_total + 10 WHERE membre_id = :id');
$query->bindValue(':id',$id,PDO::PARAM_INT);
$query->execute();

// ID DU SONDAGE
$query = $db->prepare('UPDATE sondage SET id_sondage = id_sondage + 1');
$query->execute();

// On vide les votes
$query = $db->prepare('TRUNCATE TABLE sondage_vote');
$query->execute();

echo'C\'est fait !';
}
include("../includes/fin.php");
?>