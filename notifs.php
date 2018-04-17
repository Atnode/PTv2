<?php
session_start();
$titre="Planète Toad &bull; Notifications";
include("includes/identifiants.php");
include("includes/debut.php");
if ($id==0) header('Location: erreur_403.html'); 
include("includes/menu.php");
?>
<div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> Notifications</div><br>
<h1>Notifications</h1><br>
Bienvenue dans l'espace de notifications. Cet espace vous informe de ce qu'il se passe et qui pourrait vous intéresser.

<?php
$searchNotif = $db->prepare('SELECT lu, image, text, time FROM notifs WHERE id_receveur = '.$id.' ORDER BY id DESC LIMIT 35');
$searchNotif->execute();
// S'il a aucune notif
if ($searchNotif->rowCount()<1) {
	echo'<div class="commentaires">Vous n\'avez aucune notification pour le moment... revenez plus tard.</div>'; 
} else {
    echo'<br><a href="./delete-notifications.html" onclick="if(confirm(\'Êtes-vous sûr de vouloir supprimer toutes vos notifications ? Cela est irréversible !\') == false){return false;}" style="float:right;" class="boutonconnexion mdl-button mdl-js-button mdl-button--raised mdl-button--colored"><i class="material-icons md-18">close</i> Supprimer toutes les notifications</a><div class="clearboth"></div><br><br>';
	while ($notif = $searchNotif->fetch()) {
    echo'<div class="commentaires"'; if ($notif['lu']==0) { echo'style="background-color:rgba(169, 169, 169, 0.32);"'; } echo'><table><tbody><tr>
    <td style="vertical-align:inherit;"><img src="'.$notif['image'].'" alt="Image Notif" title="Image notif"
    style="max-width:70px;max-height:70px;border-radius:50%;" /></td>
    <td style="vertical-align:inherit;"><p>'.$notif['text'].'</p></td></tr></tbody></table>
    <div style="color:grey;text-align:right;font-style:italic;margin-right:10px;">';
    if (date('d/m/Y',$notif['time'])==date('d/m/Y',time())) { echo'Envoyée aujourd\'hui à '.date('H:i:s',$notif['time']).''; }
    elseif (date('d/m/Y',$notif['time'])==date('d/m/Y',strtotime("yesterday"))) { echo'Envoyée hier à '.date('H:i:s',$notif['time']).''; } else {
    $m = date('n',$notif['time']);
    echo 'Envoyée le '.date('d',$notif['time']) .' ' . getMonth($m) .' '. date('Y',$notif['time']) .' à '. date('H:i:s',$notif['time']) .''; }
    echo'</div></div>';

    $luAll = $db->prepare('UPDATE notifs SET lu = "1" WHERE id_receveur = '.$id.' AND lu = "0"');
    $luAll->execute();
	}
}
include("includes/fin.php"); ?>