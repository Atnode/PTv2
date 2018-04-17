<?php
session_start();
$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
if ($id==0) header('Location: erreur_403.html');
$titre = "Planète Toad &bull; Liste des news";
include("includes/identifiants.php");
include("includes/debut.php");
include("includes/menu.php");
?>
<div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> <a href="./liste_tennindo.php">Panneau du rédacteur</a></div><br>
<h1>Panneau du Tennindonnien</h1><br>
&bull; <a href="rediger-tenninews.php">Ajouter une tenninews</a><br>
<?php
//-----------------------------------------------------
// Vérification 1 : est-ce qu'on veut poster une news ?
//-----------------------------------------------------
if (isset($_POST['titre']) AND isset($_POST['contenu']) AND isset($_POST['image']))
{
    $titre = ($_POST['titre']);
    $contenu = ($_POST['contenu']);
	$image = ($_POST['image']);
    // On vérifie si c'est une modification de news ou non.
    if ($_POST['id_news'] == 0)
    {
        // Ce n'est pas une modification, on crée une nouvelle entrée dans la table.
        $query = $db->prepare('INSERT INTO tennindo(posteur_id,titre,contenu,timestamp,image) VALUES(:posteur_id, :titre, :contenu, :timestamp, :image)');
		$query->bindValue(':posteur_id',$id,PDO::PARAM_INT);
		$query->bindValue(':titre',$titre,PDO::PARAM_STR);
		$query->bindValue(':contenu',$contenu,PDO::PARAM_INT);
		$query->bindValue(':timestamp',time(),PDO::PARAM_INT);
		$query->bindValue(':image',$_POST['image'],PDO::PARAM_STR);
		$query->execute();
		
        $query = $db->prepare('UPDATE forum_membres SET membre_champi = membre_champi + 10, champi_total = champi_total + 10 WHERE membre_id = :id');
		$query->bindValue(':id',$id,PDO::PARAM_INT);
		$query->execute();		
    }
    else
    {

        // C'est une modification, on met juste à jour le titre et le contenu.
        $query = $db->prepare('UPDATE tennindo SET titre=:titre, contenu=:contenu, image=:image WHERE id=:id_news ');
		$query->bindValue(':titre',$titre,PDO::PARAM_STR);
		$query->bindValue(':contenu',$contenu,PDO::PARAM_INT);
		$query->bindValue(':image',$_POST['image'],PDO::PARAM_STR);
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
    $retour = $db->query('DELETE FROM tennindo WHERE id=\'' . $_GET['supprimer_news'] . '\'');
    $query = $db->prepare('SELECT posteur_id FROM news WHERE id = '.$_GET['supprimer_news'].'');
    $query->execute();
    $data = $query->fetch();    
    $retour = $db->query('UPDATE forum_membres SET membre_champi = membre_champi - 10, champi_total = champi_total - 10 WHERE membre_id = '.$data['posteur_id'].'');
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
	$retour = $db->query('UPDATE forum_membres SET membre_champi = membre_champi + 10, champi_total = champi_total + 10 WHERE membre_id = '.$data['posteur_id'].'');
}
?>
<table style="width:100%;text-align:center;"><tr>
<th>Modifier</th>
<th>Supprimer</th>
<th>Titre</th>
<th>Date</th>
<th>Posteur</th>
</tr>
<?php
$retour = $db->query('SELECT * FROM tennindo LEFT JOIN forum_membres ON membre_id = posteur_id ORDER BY id DESC');
$retour->execute();
while ($donnees = $retour->fetch())
{
?>
<tr style="border:1px dashed grey;">
<td style="border:1px dashed grey;"><?php echo '<a href="rediger-tenninews.php?modifier_news=' . $donnees['id'] . '">'; ?>Modifier</a></td>
<td style="border:1px dashed grey;"><?php echo '<a href="liste_tenninews.php?supprimer_news=' . $donnees['id'] . '">'; ?>Supprimer</a>
<td style="border:1px dashed grey;"><?php echo stripslashes($donnees['titre']); ?></td>
<td style="border:1px dashed grey;"><?php echo date('d/m/Y', $donnees['timestamp']); ?></td>
<td style="border:1px dashed grey;"><?php echo stripslashes($donnees['membre_pseudo']); ?></td>
</tr>
<?php
} // Fin de la boucle qui liste les news.
?>
</table>
<?php
include("includes/fin.php");
?>