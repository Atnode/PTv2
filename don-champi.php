<?php
session_start();
$mchampi = $_GET['id'];
include("./includes/identifiants.php");
$titre =  'Planète Toad &bull; Don de Champis';
include("./includes/debut.php");
if ($id==0) header('Location: erreur_403.html');
include("./includes/menu.php");
$query=$db->prepare('SELECT * FROM forum_membres WHERE membre_id='.$mchampi.'');
$query->execute();
$data=$query->fetch();
if ($query->rowCount()<1) { header('Location: http://www.planete-toad.fr/erreur_403.html'); } else {
echo '<div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> <a href="./membres.html">Membres</a> --> Donner des Champis à 
'.$data['membre_pseudo'].'</div><br>';
if (empty($_POST['valeur_champis'])) // Si la variable est vide, on peut considérer qu'on est sur la page de formulaire
{
echo '<h1>Donner des Champis</h1><br>
    <div style="text-align:center;">Membre qui va reçevoir vos Champis : <span style="font-weight:bold;color:'.$data['membre_couleur'].';">'.$data['membre_pseudo'].'</span>
    <br>Attention : Donner des Champis n\'augmentera pas l\'expérience du membre en question.</div><br><br>';
    echo '<form method="post" action="don-champi-'.$mchampi.'.html">
    <p><label for="valeur_champi">Nombre de Champis à donner :</label>  <input name="valeur_champis" type="number" id="valeur_champis" /></p>
    <p><input class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit" value="Donner" /></p></form>';
} else {
$valeur_champis = htmlspecialchars(intval($_POST['valeur_champis']));
$infosmembre = $db->prepare('SELECT * FROM forum_membres WHERE membre_id = '.$id.'');
$infosmembre->execute() or die(print_r($infosmembre->errorInfo()));
$membre = $infosmembre->fetch();
$i = 0;
 
if ($id == $mchampi) { echo'Vous ne pouvez pas vous donner de Champi à vous-même.'; $i++; }
if ($valeur_champis>$membre['membre_champi']) { echo'Vous ne pouvez pas donner plus de Champis que vous n\'en possédez'; $i++; }
if ($valeur_champis<1) {echo'What... Tu veux donner un nombre négatif ou nul de Champis ?'; $i++; }
 
if ($i==0) { //On peut
    $req1 = $db->prepare('UPDATE forum_membres SET membre_champi = membre_champi - '.$valeur_champis.' WHERE membre_id = '.$id.'');
    $req1->execute() or die(print_r($req1->errorInfo()));
 
    $req2 = $db->prepare('UPDATE forum_membres SET membre_champi = membre_champi + '.$valeur_champis.' WHERE membre_id = '.$mchampi.'');
    $req2->execute() or die(print_r($req2->errorInfo()));
 
    $req3 = $db->prepare('INSERT INTO publications (id_posteur, id_receveur, message, timestamp, officielle) VALUES (:id_posteur, :id_receveur, :message, :timestamp, :officielle)');
    $req3->bindValue(':id_posteur', $id, PDO::PARAM_INT);
    $req3->bindValue(':id_receveur', $id, PDO::PARAM_INT);
    $req3->bindValue(':message', "[b][couleur=".$pseudo."]".$pseudo."[/couleur][/b] a donné ".$valeur_champis." :champi: à [b][couleur=".$data['membre_couleur']."]".$data['membre_pseudo']."[/couleur][/b].", PDO::PARAM_STR);
    $req3->bindValue(':timestamp',time(),PDO::PARAM_INT);
    $req3->bindValue(':officielle',"1",PDO::PARAM_INT);
    $req3->execute() or die(print_r($req3->errorInfo()));
 
    $req4 = $db->prepare('INSERT INTO notifs (id_receveur, image, text, time, lu) VALUES (:id_receveur, :image, :text, :time, :lu)');
    $req4->bindValue(':id_receveur', $mchampi, PDO::PARAM_INT);
    $req4->bindValue(':image', $avatar, PDO::PARAM_STR);
    $req4->bindValue(':text', "<a href=\"/profil-".$id.".html\" style=\"font-weight:bold;color:".$couleur."\">".$pseudo."</a> vous a donné ".$valeur_champis." <img src=\"http://www.planete-toad.fr/champi.png\" alt=\"Champis\" />." ,PDO::PARAM_STR);
    $req4->bindValue(':time', time(), PDO::PARAM_INT);
    $req4->bindValue(':lu', "0", PDO::PARAM_INT);
    $req4->execute() or die(print_r($req4->errorInfo()));
 
    echo'<META http-equiv="refresh" content="0; URL=/profil-'.$mchampi.'.html">';
}
 
}
}
include("includes/fin.php"); ?>