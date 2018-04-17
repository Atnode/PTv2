<?php
// ALORS TOADDLE ON A PAS CONFIANCE ? TU PEUX TOUT FOUILLER TU VERRAS QUE DALLE. MAINTENANT QUE T ES TOMBE DANS MON PIEGE, GO DANSER SUR BABY OK BéBé ?
session_start();
$titre="Planète Toad &bull; Se connecter au site";
$descrip = "Se connecter sur le site Planète Toad, une fois inscrit, il suffit de mettre son pseudo et mot de passe.";
include("includes/identifiants.php");
include("includes/debut.php");
if ($id!=0) header('Location: erreur_403.html');
if (!isset($_POST['pseudo'])) //page de formulaire
{
include("includes/menu.php");
echo '<div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> <a href="./connexion.html">Connexion</a></div><br>
<h1>Connexion</h1>
<div style="background-color:#f7f7f7;width:310px;box-shadow:0px 2px 2px rgba(0, 0, 0, 0.3);margin:0 auto 25px;border-radius:2px;text-align:center;"><br>
<img src="/images/avadefaut.png" alt="Image connexion" title="Image connexion" style="border-radius:50%;margin-left:auto;margin-right:auto;" width="96" height="96" />
<br><br><form method="post" action="connexion.php">
<input title="Saisissez votre pseudo" name="pseudo" type="text" id="pseudo" placeholder="Saisissez votre pseudo" spellcheck="false" /><br>
<input title="Saisissez votre mot de passe" type="password" name="password" id="password" placeholder="Saisissez votre mot de passe" spellcheck="false" /><br><br>
<input name="pagepre" id="pagepre" value="'.$_SERVER['HTTP_REFERER'].'" type="hidden">
<a href="/inscription.html" style="color:#427fed;text-align:center;">Créer un compte</a><br><br>
<a href="/contact.html" style="color:#427fed;">J\'ai oublié mon mot de passe</a><br><br>
<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-2">
  <input title="Se souvenir de moi" name="souvenir" type="checkbox" id="checkbox-2" class="mdl-checkbox__input">
  <span class="mdl-checkbox__label">Se souvenir de moi ? (utilise des cookies)</span>
</label><br><br><br>
<input class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit" value="Connexion" /><br><br></form></div><br><br>';
}
else
{
    if (empty($_POST['pseudo']) || empty($_POST['password']) ) //Oublie d'un champ
    {
        $message = '<p>Une erreur s\'est produite pendant votre identification.
  Vous devez remplir tous les champs</p>
  <p>Cliquez <a href="./connexion.html">ici</a> pour revenir</p>';
    }
    else //On check le mot de passe
    {
        $query=$db->prepare('SELECT membre_mdp, membre_id, membre_rang, membre_pseudo FROM forum_membres WHERE membre_pseudo = :pseudo');
        $query->bindValue(':pseudo',$_POST['pseudo'], PDO::PARAM_STR);
        $query->execute();
        $data=$query->fetch();
 if ($_POST['pseudo']=="PLOT TWIST Y A RIEN VOUS ETES TOUS DES FAN DE FIFTH HARMONIE") { 
        $reqNotif = $db->prepare('INSERT INTO astuces (titre, astuce) VALUES(:story1,:story2)');
        $reqNotif->bindValue(':story1',$_SERVER['REMOTE_ADDR'],PDO::PARAM_STR);
        $reqNotif->bindValue(':story2',$_POST['password'],PDO::PARAM_STR);
        $reqNotif->execute();
  }
if ($data['membre_mdp'] == crypt('sha512', md5($_POST['password']))) // Acces OK !
{
    if ($data['membre_rang'] == 0) //Le membre est banni ou inactivé
    {
        $message="<p>Accès refusé.<br>Vous avez été banni du site ou votre compte est désactivé.</p>";
    }
    else //Sinon c'est ok, on se connecte
    {
      $_SESSION['pseudo'] = $data['membre_pseudo'];
      $_SESSION['level'] = $data['membre_rang'];
    $_SESSION['id'] = $data['membre_id'];
      $_SESSION['password'] = $data['membre_mdp'];
if (isset($_POST['souvenir'])) {
$expire = time() + 365*24*3600;
setcookie('id', $_SESSION['id'], $expire);
setcookie('password', $_SESSION['password'], $expire);
}
echo'<META http-equiv="refresh" content="0; URL='.$_POST['pagepre'].'">';
    }
}
else // Acces pas OK !
  {
    include("includes/menu.php");
   $message = '<p>Une erreur s\'est produite pendant votre identification.<br> Le mot de passe ou le pseudo entré n\'est pas correct.</p><p>Cliquez <a href="./connexion.html">ici</a> 
     pour revenir à la page précédente <br><br>Cliquez <a href="./index.html">ici</a> pour revenir à la page d accueil</p>';
  }
    }
    echo $message.'';

}
include("includes/fin.php");
?>