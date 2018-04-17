<?php
//Cette fonction doit être appelée avant tout code html
session_start();
$titre = "Planète Toad &bull; Réseaux sociaux";
$descrip = "Les différents sites ou on peut retrouver Planète Toad.";
include("includes/identifiants.php");
include("includes/debut.php");
include("includes/menu.php");
?>
<div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> <a href="./ntxp.html">Réseaux sociaux</a></div><br />
<h1>Réseaux Sociaux</h1>

<h2>Facebook, Twitter et G+</h2>
<img src="images/logo-facebook.png" alt=""/><img src="images/logo-twitter.jpg" alt=""/><img src="images/logo-gplus.jpg" alt=""/><p>La page Facebook, Google+ et le compte Twitter de Planète Toad permet
de suivre l'actualité du site et les nouveautés.</p>

<h2>Youtube</h2>
<img src="images/yt.png" alt=""/><p>La chaîne Youtube de Planète Toad propose des vidéos en rapport avec Mario et Nintendo.</p>

<h2>Dubtrack</h2>
<img src="images/dubtrack.png" alt=""/><p>Dubtrack est un site qui permet d'écouter de la musique et discuter entre membres pour passer le temps.</p>

<?php
include("includes/fin.php");
?>