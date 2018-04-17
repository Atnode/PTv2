<?php
//Cette fonction doit être appelée avant tout code html
session_start();
$titre = "Planète Toad &bull; Qui est en ligne";
$descrip = "";
include("includes/identifiants.php");
include("includes/debut.php");
if ($lvl<4) header('Location: ./erreur_403.html'); 
include("includes/menu.php");
?>
<div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> <a href="./quiestenligne.php">Qui est en ligne?</a></div><br />
<h1>Qui est en ligne?</h1>
<br>

<?php
echo'<br>';
//On compte les membres
$TotalDesMembres = $db->prepare('SELECT COUNT(*) FROM forum_membres');
$TotalDesMembres->execute();
$TotalMembres=$TotalDesMembres->fetchColumn();

$query = $db->prepare('SELECT membre_pseudo, membre_id, membre_couleur FROM forum_membres ORDER BY membre_id DESC LIMIT 0, 1');
$query->execute();
$data = $query->fetch();
$derniermembre = stripslashes(htmlspecialchars($data['membre_pseudo']));
//On compte les messages
$CountMessages = $db->prepare('SELECT COUNT(*) FROM forum_post');
$CountMessages->execute();
$TotalM=$CountMessages->fetchColumn();
//Idem les topics
$CountTopics = $db->prepare('SELECT COUNT(*) FROM forum_topic');
$CountTopics->execute();
$TotalT=$CountTopics->fetchColumn();
//Idem les publis
$CountPublis = $db->prepare('SELECT COUNT(*) FROM publications');
$CountPublis->execute();
$TotalP=$CountPublis->fetchColumn();
//Idem les commentaires des news
$CountComms = $db->prepare('SELECT COUNT(*) FROM commentaires');
$CountComms->execute();
$TotalC=$CountComms->fetchColumn();
//Idem les commentaires des tenninews
$CountCommst = $db->prepare('SELECT COUNT(*) FROM commentairest');
$CountCommst->execute();
$TotalCT=$CountComms->fetchColumn();
//Idem les news
$CountNews = $db->prepare('SELECT COUNT(*) FROM news');
$CountNews->execute();
$TotalN=$CountNews->fetchColumn();
//Idem les tenninews
$CountTenn = $db->prepare('SELECT COUNT(*) FROM tennindo');
$CountTenn->execute();
$TotalTenn=$CountNews->fetchColumn();
//Idem les publis_com
$CountPCom = $db->prepare('SELECT COUNT(*) FROM publis_com');
$CountPCom->execute();
$TotalPubliCom=$CountPCom->fetchColumn();

$CountIOnline = $db->prepare('SELECT COUNT(*) FROM online');
$CountIOnline->execute();
$TotalIOnline=$CountIOnline->fetchColumn();

$TotalMC = $TotalM + $TotalC + $TotalCT + $TotalPubliCom;
$TotalTN = $TotalT + $TotalN + $TotalTenn;

// Anniversaire
$birthday = $db->prepare('SELECT * FROM forum_membres WHERE DATE_FORMAT(birthday, "%m-%d") = DATE_FORMAT(NOW(), "%m-%d")');
$birthday->execute() or die(print_r($birthday->errorInfo()));
$NothingBirthday=0;
if ($birthday->rowCount()<1) { $NothingBirthday++; } else {
while ($birthday1 = $birthday->fetch()) {
 $membreBirthday = '<a href="./profil-'.$birthday1['membre_id'].'.html" style="color:'.$birthday1['membre_couleur'].'">
	'.stripslashes(htmlspecialchars($birthday1['membre_pseudo'])).'</a> ('.age($birthday1['birthday']).'),';
}
}

echo'La communauté est composée de <span class="darkgreen"><strong>'.$TotalMembres.'</strong></span> membres qui ont posté <span class="darkgreen"><strong>'.$TotalMC.'</strong></span> messages et commentaires répartis dans <span class="darkgreen"><strong>'.$TotalTN.'</strong></span> sujets et news.<br />
Le dernier membre qui a rejoint la communauté est <a href="./profil-'.$data['membre_id'].'.html" title="Le dernier membre inscrit" style="color:'.$data['membre_couleur'].'">'.$derniermembre.'</a>.
<br><span class="darkgreen"><strong>'.$TotalP.'</strong></span> publications ont été publiées sur le site.';

//Décompte des membres
$texte_a_mettre = "";
$time_max = time() - (60 * 10);
$query=$db->prepare('SELECT membre_id, membre_pseudo, membre_couleur, ip, useragent, membre_pageactuelle FROM forum_membres WHERE membre_derniere_visite > :timemax AND membre_id <> 0 ORDER BY membre_pseudo');
$query->bindValue(':timemax',$time_max, PDO::PARAM_INT);
$query->execute();
$texte_a_mettre = substr($texte_a_mettre, 0, -1);
$count_membres= $TotalIOnline;
$count_membre_co = 0;
while ($data = $query->fetch())
{
	$count_membres ++;
	$count_membre_co ++;
	$texte_a_mettre .= '<a href="./profil-'.$data['membre_id'].'.html" title="'.$data['membre_pseudo'].'" style="color:'.$data['membre_couleur'].'">
	'.stripslashes(htmlspecialchars($data['membre_pseudo'])).'</a> IP: '.$data['ip'].' / UserAgent: '.$data['useragent'].' / Où est-il/elle : '.$data['membre_pageactuelle'].'<br><br><hr><br>';
}

$texte_a_mettre = substr($texte_a_mettre, 0, -1);
if ($count_membres<2)
{
echo '<hr><p>Il y a <span style="color:darkgreen;"><strong>'.$count_membres.'</strong></span> utilisateur en ligne dont <span style="color:darkgreen;"><strong>'.$count_membre_co.'</strong></span> membre : <br />';
echo $texte_a_mettre.'</p>';
} else {
echo '<hr><p>Il y a <span style="color:darkgreen;"><strong>'.$count_membres.'</strong></span> utilisateurs en ligne dont <span style="color:darkgreen;"><strong>'.$count_membre_co.'</strong></span> membres : <br />';
echo $texte_a_mettre.'</p>';
}

echo'<br>';
?>

<?php
include("includes/fin.php");
?>