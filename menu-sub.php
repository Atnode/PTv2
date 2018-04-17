<?php
//Cette fonction doit être appelée avant tout code html
session_start();
$titre = "Planète Toad &bull; Menu Principal";
$descrip = "Menu principal";
include("includes/identifiants.php");
include("includes/debut.php");
include("includes/menu.php");
?>
<div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> <a href="./ntxp.html">Menu Principal</a></div><br />
<h1>Menu principal</h1>
 
<a href="/"><i class="material-icons">home</i> Accueil</a><br/>
<a href="/forum.html"><i class="material-icons">forum</i> Forum</a><br/>
<a href="/membres.html"><i class="material-icons">people</i> Membres</a><br/>
<a href="/chat.html"><i class="material-icons">chat</i> Chat</a><br/>
<a href="/boutique.html"><i class="material-icons">people</i> Boutique</a><br/>
<a href="/musee-avatars.html"><i class="material-icons">insert_photos</i> Galerie d'avatars</a><br/>
<a href="/musee-jeux.html"><i class="material-icons">casino</i> Salle d'Arcade</a><br/>
<a href="/livreor.html"><i class="material-icons">bookmark</i> Livre d'or</a><br/>
<a href="/pttv.html"><i class="material-icons">wallpaper</i> Changer de thème</a><br/>

<?php
include("includes/fin.php");
?>