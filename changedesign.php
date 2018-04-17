<?php
//Cette fonction doit être appelée avant tout code html
session_start();
$titre = "Planète Toad &bull; Changer le thème";
$descrip = "Changer le thème du site";
include("includes/identifiants.php");
include("includes/debut.php");
if ($id==0) header('Location: erreur_403.html');
include("includes/menu.php");

$query=$db->prepare('SELECT * FROM forum_membres WHERE membre_id= '.$id.'');
$query->execute() or die(print_r($query->errorInfo())); 
$data = $query->fetch();
$theme_odyssey = $data['theme_odyssey']; ?>

<div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> <a href="./ntxp.html">Choix du thème</a></div><br />
<h1>Changer le thème</h1>

<img src="/images/theme-rouge.png" /><br/>
<a href="design-rouge.php"><input type="submit" id="envoyer" name="envoyer" value="Thème Rouge classique"></a><br/> 

<img src="/images/theme-bleu.png" /><br/>
<a href="design-bleu.php"><input type="submit" id="envoyer" name="envoyer" value="Thème Bleu classique"></a><br/>

<img src="/images/theme-odyssey.png" /><br/>
<?php if ($theme_odyssey==1) echo (
'<a href="design-odyssey.php"><input type="submit" id="envoyer" name="envoyer" value="Thème Super Mario Odyssey"></a><br/>');
else echo("Vous n'avez pas le thème Super Mario Odyssey."); ?>

<?php
include("includes/fin.php");
?>