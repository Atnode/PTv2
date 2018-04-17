<?php
session_start();
$id_game = (int) $_GET['id'];
$infosGame = 1;
include("./includes/identifiants.php");
$reponse = $db->query('SELECT nom FROM jeux WHERE id='.$id_game.'');
$reponse->execute();
$donnees = $reponse->fetch();
$titre =  ''.$donnees['nom'].' &bull; Planète Toad';
$descrip = "Consulter la fiche du jeu ".$donnees['nom']." sur le site Planète Toad";
include("./includes/debut.php");
include("./includes/menu.php");
include("./includes/headergame.php");
$query=$db->prepare('SELECT * FROM jeux WHERE id='.$id_game.'');
$query->execute();
$data=$query->fetch();
if ($query->rowCount()<1)
{ header('Location: http://www.planete-toad.fr/erreur_403.html'); } else {
echo '<div class="corps" style="margin-top:-12.999px;"><div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> <a href="./encyclopedie.html">Encyclopedie</a> --> <a href="./jeux.html">Jeux</a> -->
<a href="./jeu-'.$id_game.'-'.$data['nom_url'].'.html">'.$data['nom'].'</a></div><br>';
echo'<h1>'.$data['nom'].'</h1><br>
<br><br><div class="commentaires">
<div style="text-align:justify;"><h2>Fiche technique</h2><br>
<b>Console :</b> '.$data['console'].'<br>
<b>Developpeur :</b> '.$data['developpeur'].'<br>
<b>Editeur :</b> '.$data['editeur'].'<br>
<b>Classification :</b> '.$data['classification'].'<br>
<b>Genre :</b> '.$data['genre'].'<br>
<b>Public :</b> '.$data['public'].'<br>
<b>Multijoueur :</b> '.$data['multijoueurs'].'<br>
<b>Online :</b> '.$data['online'].'<br>
<b>Sortie en Europe :</b> '.date("d/m/Y", strtotime($data['sortie_ue'])).'<br>
<b>Sortie aux Etats-Unis :</b> '.date("d/m/Y", strtotime($data['sortie_us'])).'<br>
<b>Sortie au Japon :</b> '.date("d/m/Y", strtotime($data['sortie_jp'])).'<br>
<b>Description :</b> '.$data['description'].'<br><br></div><br>
<div class="clearboth"></div></div><br><hr />';
}
include("includes/fin.php"); ?>
