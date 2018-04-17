<?php
session_start();
$id_game = (int) $_GET['id'];
$testGame = 1;
include("./includes/identifiants.php");
$reponse = $db->prepare('SELECT * FROM jeux WHERE id='.$id_game.'');
$reponse->execute();
$donnees = $reponse->fetch();
$titre =  'Test de '.$donnees['nom'].' &bull; Planète Toad';
$descrip = "Consulter le test du jeu ".$donnees['nom']." sur le site Planète Toad";
include("./includes/debut.php");
include("./includes/menu.php");
include("./includes/headergame.php");
$query=$db->prepare('SELECT * FROM tests LEFT JOIN jeux ON jeux.id = tests.id_game LEFT JOIN forum_membres ON forum_membres.membre_id = tests.id_posteur WHERE id_game ='.$id_game.'');
$query->execute();
$data=$query->fetch();
if ($query->rowCount()<1)
{ echo'<div class="corps" style="margin-top:-12.999px;"><div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> <a href="./encyclopedie.html">Encyclopedie</a> --> <a href="./jeux.html">Jeux</a> -->
<a href="./game-'.$id_game.'-'.$donnees['nom_url'].'.html">'.$donnees['nom'].'</a> --> <a href="/test-game-'.$id_game.'-'.$donnees['nom_url'].'.html">Test</a></div><br>';
echo'<h1>'.$data['nom'].'</h1><br><br>
<p style="text-align:center;">Ce jeu n\'a pas encore de test. Vous pouvez aller en proposer un <a href="/forum-21-tests.html">ici</a>.</p>'; } else {
echo '<div class="corps" style="margin-top:-12.999px;"><div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> <a href="./encyclopedie.html">Encyclopedie</a> --> <a href="./jeux.html">Jeux</a> -->
<a href="./jeu-'.$id_game.'-'.$data['nom_url'].'.html">'.$data['nom'].'</a> --> <a href="/test-game-'.$id_game.'-'.$data['nom_url'].'.html">Test</a></div><br>';
echo'<h1>'.$data['nom'].'</h1><br><br><br>';
echo''.nl2br($data['test']).'
<br><br><br><hr><br>
<table style="margin-left:auto;margin-right:auto;text-align:center;"><tbody><tr><td style="background-color:#9CFF9C;color:darkgreen;padding:10px;"><b>Points positifs :</b><br><br>
'.nl2br($data['pointsforts']).'</td><td style="background-color:#FF9B9B;color:darkred;padding:10px;"><b>Points négatifs :</b><br><br>
'.nl2br($data['pointsfaibles']).'</td></tr></tbody></table>
<br><br><br>
<div style="text-align:center;float:right;margin-right:10px;background-color:#F7F7F7;border:1px dashed grey;padding:5px;font-size:15px;"><b>NOTE :</b> <span style="color:#00b7ff;font-weight:bold;">'.$data['note'].'</span>/20</div>
<div class="clearboth"></div><br><hr /><div style="text-align:right;font-style:italic;">
Par <a href="./profil-'.$data['membre_id'].'.html" style="color:'.$data['membre_couleur'].';">'.$data['membre_pseudo'].'</a></div><br><br><br>';
}
include("includes/fin.php"); ?>
