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
echo'<h1>Rédiger une news</h1>';
if (isset($_GET['modifier_news'])) // Si on demande de modifier une news.
{
    // On protège la variable « modifier_news » pour éviter une faille SQL.
    $_GET['modifier_news'] = htmlspecialchars($_GET['modifier_news']);
    // On récupère les informations de la news correspondante.
    $retour = $db->prepare('SELECT * FROM news WHERE id= :modifnews');
    $retour->bindValue(':modifnews',$_GET['modifier_news'], PDO::PARAM_INT);
    $retour->execute() or die(print_r($retour->errorInfo()));
    while ($donnees = $retour->fetch())
{
    
    // On place le titre et le contenu dans des variables simples.
    $titre = stripslashes($donnees['titre']);
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
if ($lvl==3 OR $lvl==5) {
?>
<form action="liste_news.php" method="post" style="text-align:center;">
<p>Titre : <input type="text" size="30" name="titre" value="<?php echo $titre; ?>" /></p>
<p>
<?php
if (isset($id_news) AND $id_news==0)
{
echo'
<select name="icon">
<option value="0">Site</option>
<option value="1">3ds</option>
<option value="2">Wii U</option>
<option value="3">Multi</option>
<option value="4">E-Shop</option>
<option value="5">Miiverse</option>
<option value="6">Divers</option>
<option value="7">NTXP</option>
<option value="8">Chronique</option>
<option value="9">NX</option>
<option value="10">Mobile</option>
</select>';
}
else {
    $retour = $db->prepare('SELECT icon FROM news WHERE id= :modifnews');
    $retour->bindValue(':modifnews',$_GET['modifier_news'], PDO::PARAM_INT);
    $retour->execute() or die(print_r($retour->errorInfo()));
    while ($donnees = $retour->fetch())
{
?>

<p>N'hésitez pas à aller voir le guide de news <a href="http://www.planete-toad.fr/topic-758-1-le-guide-ultime-du-newser.html">ici</a>.

<select name="icon">
<option <?php if ($donnees['icon']==0) echo'selected="selected"';?> value="0">Site</option>
<option <?php if ($donnees['icon']==1) echo'selected="selected"';?> value="1">3ds</option>
<option <?php if ($donnees['icon']==2) echo'selected="selected"';?> value="2">Wii U</option>
<option <?php if ($donnees['icon']==3) echo'selected="selected"';?> value="3">Multi</option>
<option <?php if ($donnees['icon']==4) echo'selected="selected"';?> value="4">E-Shop</option>
<option <?php if ($donnees['icon']==5) echo'selected="selected"';?> value="5">Miiverse</option>
<option <?php if ($donnees['icon']==6) echo'selected="selected"';?> value="6">Divers</option>
<option <?php if ($donnees['icon']==7) echo'selected="selected"';?> value="7">NTXP</option>
<option <?php if ($donnees['icon']==8) echo'selected="selected"';?> value="8">Chronique</option>
<option <?php if ($donnees['icon']==9) echo'selected="selected"';?> value="9">NX</option>
<option <?php if ($donnees['icon']==10) echo'selected="selected"';?> value="10">Mobile</option>
</select>
<?php
}
}
?>
</p>
<p>
<?php include('code.php'); ?>
    Contenu :<br>
    <textarea name="contenu" id="message" cols="100" rows="25"><?php echo $contenu; ?></textarea><br />
    <input type="hidden" name="id_news" value="<?php echo $id_news; ?>" />
    <input class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit" value="Envoyer" />
</p>
</form>
<?php
} else { ?>
<form action="liste_news.php" method="post" style="text-align:center;">
<p>Titre : <input type="text" size="30" name="titre" value="<?php echo $titre; ?>" /></p>
<p>
<?php
if (isset($id_news) AND $id_news==0)
{
echo'
<select name="icon">
<option value="0">Site</option>
<option value="1">3ds</option>
<option value="2">Wii U</option>
<option value="3">Multi</option>
<option value="4">E-Shop</option>
<option value="5">Miiverse</option>
<option value="6">Divers</option>
<option value="7">NTXP</option>
<option value="8">Chronique</option>
<option value="9">NX</option>
<option value="10">Mobile</option>
</select>';
}
else {
    $retour = $db->prepare('SELECT icon FROM news WHERE id= :modifnews');
    $retour->bindValue(':modifnews',$_GET['modifier_news'], PDO::PARAM_INT);
    $retour->execute() or die(print_r($retour->errorInfo()));
    while ($donnees = $retour->fetch())
{
?>
<select name="icon">
<option <?php if ($donnees['icon']==0) echo'selected="selected"';?> value="0">Site</option>
<option <?php if ($donnees['icon']==1) echo'selected="selected"';?> value="1">3ds</option>
<option <?php if ($donnees['icon']==2) echo'selected="selected"';?> value="2">Wii U</option>
<option <?php if ($donnees['icon']==3) echo'selected="selected"';?> value="3">Multi</option>
<option <?php if ($donnees['icon']==4) echo'selected="selected"';?> value="4">E-Shop</option>
<option <?php if ($donnees['icon']==5) echo'selected="selected"';?> value="5">Miiverse</option>
<option <?php if ($donnees['icon']==6) echo'selected="selected"';?> value="6">Divers</option>
<option <?php if ($donnees['icon']==7) echo'selected="selected"';?> value="7">NTXP</option>
<option <?php if ($donnees['icon']==8) echo'selected="selected"';?> value="8">Chronique</option>
<option <?php if ($donnees['icon']==9) echo'selected="selected"';?> value="9">NX</option>
<option <?php if ($donnees['icon']==10) echo'selected="selected"';?> value="10">Mobile</option>
</select>
<?php
}
}
?>
</p>
<p>
<?php include('code.php'); ?>
    Contenu : <br>
    <textarea name="contenu" id="message" cols="100" rows="25"><?php echo $contenu; ?></textarea><br />    
    <input type="hidden" name="id_news" value="<?php echo $id_news; ?>" />
    <input class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit" value="Envoyer" />
</p>
</form>
<?php
}
include("includes/fin.php");
?>