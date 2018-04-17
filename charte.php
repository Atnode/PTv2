<?php
//Cette fonction doit être appelée avant tout code html
session_start();
$titre = "Planète Toad &bull; Charte";
$descrip = "Le règlement de Planète Toad à respecter";
include("includes/identifiants.php");
include("includes/debut.php");
include("includes/menu.php");
?>
<div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> <a href="./charte.html">Charte du site</a></div><br />
<h1>Charte du site</h1>

<p>La charte du site est l'ensemble des règles à respecter sur le site afin qu'il continue d'avoir une bonne ambiance et que le site soit propre. Planète Toad est un site où les fans de la
série de jeux vidéos Mario, et des autres série peuvent se regrouper pour discuter de tout et de rien en rapport ou non avec cette série.</p>

<h2>Sécurité</h2>

<p>Planète Toad n'est pas responsable de la sécurité de votre mot de passe. Il est recommendé d'utiliser un mot de passe de plus de 7 caractères, avec des lettres, majuscules, minuscules, chiffres
et caractères spéciaux. Il faut éviter d'avoir le même mot de passe que sur d'autres sites ou services. Le site vous demande votre adresse e-mail. Cette adresse e-mail peut vous servir à récuperer
votre compte grâce au formulaire de contact en bas à gauche du site.</p>

<h2>Données personnelles</h2>

<p>Il faut éviter de dévoiler ses informations personelles sur le site tel que le nom de famille, l'adresse où vous habitez ou même votre mot de passe. Il est bien sur interdit de dévoiler des
informations personelles de quelqu'un d'autre que vous.</p>

<h2>Choses illégales</h2>

<p>Tout acte de piratage envers le site est strictement interdit. Les liens vers des Roms ou Isos de jeux, films ou autres sont aussi interdits. Vous devez respecter la loi dans le pays ou vous vous
situez et dans lequel Planète Toad est hébergé (France).</p>

<?php
include("includes/fin.php");
?>