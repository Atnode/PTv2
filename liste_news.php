<?php
session_start();
$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
if ($id==0) header('Location: erreur_403.html');
$titre = "Planète Toad &bull; Liste des news";
include("includes/identifiants.php");
include("includes/debut.php");
include("includes/menu.php");
if ($lvl==3 OR $lvl==4 OR $lvl==5) {
?>
<div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> <a href="./liste_news.php">Panneau du rédacteur</a></div><br>
<h1>Panneau du rédacteur</h1><br>
&bull; <a href="rediger-news.php">Ajouter une news</a><br>
&bull; <a href="upload-image.php">Upload une image (index)</a><br>
<?php
//-----------------------------------------------------
// Vérification 1 : est-ce qu'on veut poster une news ?
//-----------------------------------------------------
if (isset($_POST['titre']) AND isset($_POST['contenu']) AND isset($_POST['icon']))
{
    $titre = ($_POST['titre']);
    $contenu = ($_POST['contenu']);
	$icon = ($_POST['icon']);
    // On vérifie si c'est une modification de news ou non.
    if ($_POST['id_news'] == 0)
    {
        // Ce n'est pas une modification, on crée une nouvelle entrée dans la table.
        $query = $db->prepare('INSERT INTO news(posteur_id,titre,contenu,timestamp,icon,valide) VALUES(:posteur_id, :titre, :contenu, :timestamp, :icon, :valide)');
		$query->bindValue(':posteur_id',$id,PDO::PARAM_INT);
		$query->bindValue(':titre',$titre,PDO::PARAM_STR);
		$query->bindValue(':contenu',$contenu,PDO::PARAM_INT);
		$query->bindValue(':timestamp',time(),PDO::PARAM_INT);
		$query->bindValue(':icon',$_POST['icon'],PDO::PARAM_INT);
		$query->bindValue(':valide',"1",PDO::PARAM_INT);
		$query->execute();
		
        if ($lvl>2) {
        $query = $db->prepare('UPDATE forum_membres SET membre_champi = membre_champi + 10, champi_total = champi_total + 10 WHERE membre_id = :id');
		$query->bindValue(':id',$id,PDO::PARAM_INT);
		$query->execute();
        }		
    }
    else
    {

        // C'est une modification, on met juste à jour le titre et le contenu.
        $query = $db->prepare('UPDATE news SET titre=:titre, contenu=:contenu, icon=:icon WHERE id=:id_news ');
		$query->bindValue(':titre',$titre,PDO::PARAM_STR);
		$query->bindValue(':contenu',$contenu,PDO::PARAM_INT);
		$query->bindValue(':icon',$_POST['icon'],PDO::PARAM_INT);
		$query->bindValue(':id_news',$_POST['id_news'],PDO::PARAM_INT);
		$query->execute();	
    }
}
 
//--------------------------------------------------------
// Vérification 2 : est-ce qu'on veut supprimer une news ?
//--------------------------------------------------------
if (isset($_GET['supprimer_news'])) // Si l'on demande de supprimer une news.
{
    // Alors on supprime la news correspondante.
    // On protège la variable « id_news » pour éviter une faille SQL.
    $_GET['supprimer_news'] = ($_GET['supprimer_news']);
    $query = $db->prepare('SELECT * FROM news WHERE id = '.$_GET['supprimer_news'].'');
    $query->execute();
    $data = $query->fetch();    
    $retour1 = $db->prepare('UPDATE forum_membres SET membre_champi = membre_champi - 10, champi_total = champi_total - 10 WHERE membre_id = '.$data['posteur_id'].'');
    $retour1->execute();

if ($data['posteur_id']!=$id) {
 $message = 'Votre news intitulée : "<i>'.$data['titre'].'</i>" a malheureusement été refusée ou supprimée par <a href="profil-'.$id.'.html" style="color:'.$couleur.'">'.$pseudo.'</a>';
 $sendNotif = $db->prepare('INSERT INTO notifs (id_receveur, image, text, time, lu) VALUES(:id, :image, :text, :time, :lu)');
 $sendNotif->bindValue(':id',$data['posteur_id'],PDO::PARAM_INT);
 $sendNotif->bindValue(':image',"/images/notifs/yoshi-news.png",PDO::PARAM_STR);
 $sendNotif->bindValue(':text',$message,PDO::PARAM_STR);
 $sendNotif->bindValue(':time',time(),PDO::PARAM_INT);
 $sendNotif->bindValue(':lu','0',PDO::PARAM_STR);
 $sendNotif->execute();
}


    $retour2 = $db->query('DELETE FROM news WHERE id=\'' . $_GET['supprimer_news'] . '\'');
    $retour2->execute();
}
if (isset($_GET['valider'])) // Si l'on demande de valider une news.
{
    // Alors on supprime la news correspondante.
    // On protège la variable « id_news » pour éviter une faille SQL.
    $_GET['valider'] = ($_GET['valider']);
    $retour = $db->query('UPDATE news SET valide = 1 WHERE id = '.$_GET['valider'].'');
	$query = $db->prepare('SELECT posteur_id FROM news WHERE id = '.$_GET['valider'].'');
    $query->execute();
    $data = $query->fetch();	
	$retour = $db->prepare('UPDATE forum_membres SET membre_champi = membre_champi + 10, champi_total = champi_total + 10 WHERE membre_id = '.$data['posteur_id'].'');
    $retour->execute();
}
?>
<br><table style="width:100%;text-align:center;" class="mdl-data-table mdl-js-data-table mdl-shadow--2dp"><tr>
<th class="mdl-data-table__cell--non-numeric">Modifier</th>
<th class="mdl-data-table__cell--non-numeric">Supprimer</th>
<th class="mdl-data-table__cell--non-numeric">Titre</th>
<th>Date</th>
<th class="mdl-data-table__cell--non-numeric">Posteur</th>
<th>Validation</th>
</tr>
<?php
$retour = $db->query('SELECT * FROM news LEFT JOIN forum_membres ON membre_id = posteur_id ORDER BY id DESC');
$retour->execute();
while ($donnees = $retour->fetch())
{
?>
<tr style="border:1px dashed grey;">
<td style="border:1px dashed grey;" class="mdl-data-table__cell--non-numeric"><?php echo '<a href="rediger-news.php?modifier_news=' . $donnees['id'] . '">'; ?>Modifier</a></td>
<td style="border:1px dashed grey;" class="mdl-data-table__cell--non-numeric"><?php echo '<a href="liste_news.php?supprimer_news=' . $donnees['id'] . '">'; ?>Supprimer</a>
<td style="border:1px dashed grey;" class="mdl-data-table__cell--non-numeric"><?php echo stripslashes($donnees['titre']); ?></td>
<td style="border:1px dashed grey;"><?php echo date('d/m/Y', $donnees['timestamp']); ?></td>
<td style="border:1px dashed grey;" class="mdl-data-table__cell--non-numeric"><?php echo stripslashes($donnees['membre_pseudo']); ?></td>
<?php if ($donnees['valide']==0) {
echo'<td style="border:1px dashed grey;"><b><a href="/liste_news.php?valider=' . $donnees['id'] . '"><span style="color:red">Non</span></a></b></td>';
} else {
echo'<td style="border:1px dashed grey;">Oui</td>'; } ?>
</tr>
<?php
} // Fin de la boucle qui liste les news.
?>
</table>
<?php
} else { ?>
<h1>News</h1>
 
<?php
//-----------------------------------------------------
// Vérification 1 : est-ce qu'on veut poster une news ?
//-----------------------------------------------------
if (isset($_POST['titre']) AND isset($_POST['contenu']) AND isset($_POST['icon']))
{
    $titre = ($_POST['titre']);
    $contenu = ($_POST['contenu']);
	$icon = ($_POST['icon']);
    // On vérifie si c'est une modification de news ou non.
    if ($_POST['id_news'] == 0)
    {
        // Ce n'est pas une modification, on crée une nouvelle entrée dans la table.
        $query = $db->prepare('INSERT INTO news(posteur_id,titre,contenu,timestamp,icon, valide) VALUES(:posteur_id, :titre, :contenu, :timestamp, :icon, :valide)');
		$query->bindValue(':posteur_id',$id,PDO::PARAM_INT);
		$query->bindValue(':titre',$titre,PDO::PARAM_STR);
		$query->bindValue(':contenu',$contenu,PDO::PARAM_INT);
		$query->bindValue(':timestamp',time(),PDO::PARAM_INT);
		$query->bindValue(':icon',$_POST['icon'],PDO::PARAM_INT);
		$query->bindValue(':valide',"0",PDO::PARAM_INT);
		$query->execute();	
		
		echo'News postée.';
    }
}
?>
<?php }
include("includes/fin.php");
?>