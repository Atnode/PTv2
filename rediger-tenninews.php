<?php
session_start();
$titre = "Planète Toad &bull; Rédiger une news";
$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
if ($id==0) header('Location: erreur_403.html');
include("includes/identifiants.php");
$balises = true;
include("includes/debut.php");
include("includes/menu.php");
include("includes/bbcode.php");
echo'<h1>Rédiger une tenninews</h1>';
if (isset($_GET['modifier_news'])) // Si on demande de modifier une news.
{
    // On protège la variable « modifier_news » pour éviter une faille SQL.
    $_GET['modifier_news'] = htmlspecialchars($_GET['modifier_news']);
    // On récupère les informations de la news correspondante.
    $retour = $db->prepare('SELECT * FROM tennindo WHERE id= :modifnews');
    $retour->bindValue(':modifnews', $_GET['modifier_news'], PDO::PARAM_INT);
    $retour->execute() or die(print_r($retour->errorInfo()));
    while ($donnees = $retour->fetch())
    {   
    // On place le titre et le contenu dans des variables simples.
    $titre = stripslashes($donnees['titre']);
    $image = $donnees['image'];
    $contenu = stripslashes($donnees['contenu']);
    $id_news = $donnees['id']; // Cette variable va servir pour se souvenir que c'est une modification.
    }
}
else // C'est qu'on rédige une nouvelle news.
{
    // Les variables $titre et $contenu sont vides, puisque c'est une nouvelle news.
    $titre = '';
    $contenu = '';
    $id_news = 0; // La variable vaut 0, donc on se souviendra que ce n'est pas une modification.
}
?>
<form action="liste_tennindo.php" method="post" style="text-align:center;">
<p>Titre : <input type="text" size="30" name="titre" value="<?php echo $titre; ?>" /></p>
<p>Icône news : <input type="text" size="60" name="image" value="<?php echo $image; ?>" /></p>
<p>
<?php include('code.php'); ?>
    Contenu :<br>
    <textarea name="contenu" id="message" cols="100" rows="25"><?php echo $contenu; ?></textarea><br />
    <input type="hidden" name="id_news" value="<?php echo $id_news; ?>" />
    <input class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit" value="Envoyer" />
</p>
</form>
<?php
include("includes/fin.php");
?>