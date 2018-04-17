<?php
//Cette fonction doit être appelée avant tout code html
session_start();
$titre = "Planète Toad &bull; Guide";
$descrip = "Bien démarrer sur Planète Toad";
include("includes/identifiants.php");
include("includes/debut.php");
include("includes/menu.php");
?>
<div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> <a href="./ntxp.html">Guide du nouveau</a></div><br />
<h1>Guide du nouveau</h1>

<p>Tu viens de t'inscrire et tu ne sais pas où aller ? Ce guide va vous permettre de découvrir les bases du site.</p>

<h2>Bien débuter</h2>
<p>Après l'inscription, la meilleure chose à faire est sans doute d'aller se présenter ! Pour cela, clique sur le lien <b>Forum</b> puis <b>Réglement et Présentation</b>, pour créer un nouveau sujet,
clique sur le bouton <b>Nouveau</b>. Une page apparaîtra et tu devra mettre le titre de ta présentation <b>"Présentation de TONPSEUDO"</b> ou autre si tu as d'autres idées. Tu peux t'inspirer
du modèle de présentation mais ce n'est pas obligatoire.</p>

<h2>Modifier son profil</h2>
<p>Dans la barre du haut, il y a un lien <b>Modifier son profil</b>. Il permet de modifier ton mot de passe, ton adresse-mail liée à ton compte, ainsi que ton avatar, qui est une image
qui te "représente" (tu peux mettre l'image que tu veux tant qu'elle respecte les règles, bien sûr). Tu peux aussi régler ta signature (qui s'affiche en dessous de tous tes messages) et la
description de ton profil.</p>

<h2>Ton profil</h2>

<img src="images/guide-profil.png" />
<p><i>Note : Tout le monde a accès à ton profil.</p>
<p><b>1 : Ton pseudo</b><br/>
<b>2 : Ton rang</b> : Plus tu accumules de champis (les champis dépensés sont compris !), plus tu augmente de rang (de Champi jusqu'à étoile). A l'heure où j'écris ce guide, seul deux membres
ont le rang étoile !<br/>
<b>3 : Ton avatar</b><br/>
<b>4 : Quelques statistiques à ton sujet</b> : comme le nombre de messages postés, la date d'inscription et ta dernière visite ou ton code ami 3ds et ton ID Nintendo Network.<br/>
<b>5 : Ton pseudo</b> : Les champis sont la monnaie du site, ils permettent d'acheter des objets dans la boutique et s'optiennent en participant à la vie du site.<br/>
<b>6 : Les badges</b> : Les badges s'optiennent en réalisants des objectifs qui sont expliqués quand tu clique sur <b>Cliquez ici pour voir tous les badges</br>.
</p>
<?php
include("includes/fin.php");
?>