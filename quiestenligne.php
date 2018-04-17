<?php
//Cette fonction doit être appelée avant tout code html
session_start();
$titre = "Planète Toad &bull; Qui est en ligne";
$descrip = "";
include("includes/identifiants.php");
header("refresh:5;url=quiestenligne.php");
include("includes/debut.php");
if ($lvl<4) header('Location: ./erreur_403.html'); 
include("includes/menu.php");
?>
<div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> <a href="./quiestenligne.php">Qui est en ligne?</a></div><br />
<h1>Qui est en ligne?</h1>
<br>
<center><b><u>NOTE :</u></b> La page s'actualise automatiquement toutes les 5 SECONDES.</center><br>
<br>

<?php

//Décompte des membres
$texte_a_mettre = "";
$time_max = time() - (60 * 10);
$query=$db->prepare('SELECT membre_id, membre_pseudo, membre_couleur, membre_avatar, ip, useragent, membre_pageactuelle, membre_derniere_visite FROM forum_membres WHERE membre_derniere_visite > :timemax AND membre_id <> 0 ORDER BY membre_derniere_visite DESC');
$query->bindValue(':timemax',$time_max, PDO::PARAM_INT);
$query->execute();
$texte_a_mettre = substr($texte_a_mettre, 0, -1);
$count_membres= $TotalIOnline;
$count_membre_co = 0;
while ($data = $query->fetch())
{
	$count_membres ++;
	$count_membre_co ++;
    $derniereCo = time() - $data['membre_derniere_visite'];
	$texte_a_mettre .= '<table class="commentaires" style="margin:10px;"><tbody><tr>
	<td style="width:80px;">
	<img src="'.$data['membre_avatar'].'" alt="avatar" width="80" height="80" style="border-radius:50%;margin-top:5px;" /></td>
	<td style="padding-left:15px;"><a href="./profil-'.$data['membre_id'].'.html" title="'.$data['membre_pseudo'].'" style="color:'.$data['membre_couleur'].'">
	'.stripslashes(htmlspecialchars($data['membre_pseudo'])).'</a> <br>
	<b>IP :</b> '.$data['ip'].' <br>
	<b>UserAgent :</b> '.$data['useragent'].' <br>
	<b>Où est-il/elle :</b> '.$data['membre_pageactuelle'].' <br>
	<b>Dernière visite : </b> : Il y a <b>'.$derniereCo.'</b> seconde(s) <br>
	</td></tr></tbody></table><br><br>';
}

$texte_a_mettre = substr($texte_a_mettre, 0, -1);
if ($count_membres<2)
{
echo '<hr><p>Il y a <span style="color:darkgreen;"><span style="color:darkgreen;"><strong>'.$count_membre_co.'</strong></span> membre en ligne : <br />';
echo $texte_a_mettre.'</p>';
} else {
echo '<hr><p>Il y a <span style="color:darkgreen;"><strong>'.$count_membre_co.'</strong></span> membres en ligne : <br />';
echo $texte_a_mettre.'</p>';
}

echo'<br>';
?>

<?php
include("includes/fin.php");
?>