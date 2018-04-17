<?php
session_start();
$titre = "Planète Toad &bull; Boutique";
$descrip = "Cette page contient la liste de tous les articles disponibles sur Planète Toad";
include("includes/identifiants.php");
include("includes/debut.php");
if ($id==0) header('Location: erreur_403.html');
include("includes/menu.php");
?>
<div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> <a href="./boutique.html">Boutique</a></div><br />
<h1>Boutique</h1>
Bienvenue dans la boutique. Ici, vous pourrez acheter des articles qui se payent avec la monnaie virtuelle appelée <b>Champi</b>.<br><br>

<?php
$query=$db->prepare('SELECT * FROM forum_membres WHERE membre_id= '.$id.'');
$query->execute() or die(print_r($query->errorInfo())); 
$data = $query->fetch();
$champis = $data['membre_champi']; 
$article1 = $data['article1'];
$article4 = $data['article4'];
$theme_odyssey = $data['theme_odyssey'];
$banniere_champi = $data['banniere_champi'] ?>
<!--PT CARD-->
<table class="ludaweb01 jauge-color"><tbody><tr><td style="vertical-align:middle;padding:15px;"><img src="/images/boutique/jauge.png" title="Couleur de la barre d'expérience" /></td>
<td style="padding:30px;"><div style="font-size:18px;font-weight:bold;">PERSONNALISER LA COULEUR DE LA BARRE D'EXPERIENCE</div><br>
<br>Cet article vous permet de personnaliser la couleur de votre barre d'expérience affichée sur votre profil et dans les messages.<br>
<b>Prix :</b> 90 Champis<br><br>
<?php
if ($article4==1) {
echo'<i>Vous avez déjà acheté cet article</i>';
} elseif ($champis>=90) { echo'<a href="./acheter-article.php?id=6" class="buyButton">Acheter cet article</a>'; 
} else { echo'<a href="#" class="buyButton">Vous n\'avez pas assez de Champis pour acheter cet article.</a>'; } echo'</td></tr></tbody></table><br><br><br>'; 
 ?>


<!--PT CARD-->
<table class="ludaweb01 shop-card"><tbody><tr><td style="vertical-align:middle;padding:15px;"><img src="/images/banniere/card.png" title="PT Card" /></td>
<td style="padding:30px;"><div style="font-size:18px;font-weight:bold;">PLANETE TOAD CARD</div><br>
<br>La Planète Toad Card est une image contenant votre pseudo, avatar, nombre de Champis et votre rank affichable où vous le souhaitez.<br>
<b>Prix :</b> <s>200 Champis</s> 130 Champis (PRIX CHOC)<br><br>
<?php
$reqCard = $db->prepare('SELECT * FROM card WHERE membre_id = '.$id.'');
$reqCard->execute();
if ($reqCard->rowCount()>0) {
echo'<i>Vous avez déjà acheté cet article</i>';
} elseif ($champis>=130) { echo'<a href="./acheter-article.php?id=4" class="buyButton">Acheter cet article</a>'; 
} else { echo'<a href="#" class="buyButton">Vous n\'avez pas assez de Champis pour acheter cet article.</a>'; } echo'</td></tr></tbody></table><br><br><br>'; ?>

<!--PSEUDO COLOR-->
<table class="ludaweb01 shop-color-pseudo"><tbody><tr><td style="vertical-align:middle;padding:15px;"><img src="/images/color-wheel.png" title="Color Wheel" /></td>
<td style="padding:30px;"><div style="font-size:18px;font-weight:bold;">CHANGER LA COULEUR DE SON PSEUDO</div><br>
<br>Cet article vous permet de pouvoir choisir la couleur de votre pseudo sur le site.<br>
<b>Prix :</b> 150 Champis<br><br>
<?php 
if ($data['membre_id']==7010) {echo 'Vous n\'avez pas l\'autorisation d\'acheter cette article - Banni de la fonction de modification de couleur/style pseudo.';}
else 
if ($article1==1) {
echo'<i>Vous avez déjà acheté cet article</i>';
} elseif ($champis>=150) { echo'<a href="./acheter-article.php?id=1" class="buyButton">Acheter cet article</a>'; 
} else { echo'<a href="#" class="buyButton">Vous n\'avez pas assez de Champis pour acheter cet article.</a>'; } echo'</td></tr></tbody></table><br><br><br>'; ?>
<!--BANNIERE CHAMPI-->
<table class="ludaweb01 shop-banniere-champi"><tbody><tr><td style="vertical-align:middle;padding:15px;"><img src="/images/banniere/champi.png" title="Bannière Champi Icône" /></td>
<td style="padding:30px;"><div style="font-size:18px;font-weight:bold;">BANNIERE CHAMPI</div><br>
<br>Cet article vous permet de personnaliser votre profil afin d'avoir la bannière "Champi" dessus. Cela montre votre richesse sur le site.<br>
<b>Prix :</b> 1000 Champis<br><br>
<?php if ($banniere_champi==1) {
echo'<i>Vous avez déjà acheté cet article</i>';
} elseif ($champis>=1000) {
echo'<a href="./acheter-article.php?id=2" class="buyButton">Acheter cet article</a>';
} else { echo'<a href="#" class="buyButton">Vous n\'avez pas assez de Champis pour acheter cet article.</a>'; } echo'</td></tr></tbody></table><br><br><br>'; ?>
<!--CHANGEMENT DE PSEUDO-->
<table class="ludaweb01 shop-change-pseudo"><tbody><tr><td style="vertical-align:middle;padding:15px;"><img src="/images/changement-pseudo.png" title="Bannière Champi Icône" /></td>
<td style="padding:30px;"><div style="font-size:18px;font-weight:bold;">CHANGEMENT DE PSEUDO</div><br>
<br>Cet article vous donne le droit de pouvoir changer votre pseudo une fois dans "Modifier mon profil".<br>
<b>Prix :</b> 100 Champis<br><br>
<?php if ($champis>=100) {
echo'<a href="./acheter-article.php?id=3" class="buyButton">Acheter cet article</a>';
} else { echo'<a href="#" class="buyButton">Vous n\'avez pas assez de Champis pour acheter cet article.</a>'; } echo'</td></tr></tbody></table><br><br><br>'; ?>

<?php
// THEME DE LUDA A VIRER
if ($lvl==6) {

echo'<!--<br><h2>Thèmes</h2><br>
<!--THEME SUPER MARIO WORLD-->
<!--<table class="ludaweb01 shop-change-pseudo"><tbody><tr><td style="vertical-align:middle;padding:15px;"><img src="/theme/smw/supermarioworld_boutique.gif" title="Thème Super Mario World - Icône"/></td>
<td style="padding:30px;"><div style="font-size:18px;font-weight:bold;">THEME SUPER MARIO WORLD</div><br>
<br>Thème Super Mario World<br>
<b>Prix :</b> 25 Champis<br><br>';
if ($champis>=25) {
echo'<a href="#" class="buyButton">Actuellement indisponible.</a>';
} else { echo'<a href="#" class="buyButton">Vous n\'avez pas assez de Champis pour acheter cet article.</a>'; } echo'</td></tr></tbody></table><br><br><br>';

echo'THEME SUPER MARIO 3D WORLD
<table class="ludaweb01 shop-change-pseudo"><tbody><tr><td style="vertical-align:middle;padding:15px;"><img src="/theme/smw/sm3dw_boutique.gif" title="Thème Super Mario World - Icône"/></td>
<td style="padding:30px;"><div style="font-size:18px;font-weight:bold;">THEME SUPER MARIO WORLD 3D</div><br>
<br>Yhème Super Mario 3D World<br>
<b>Prix :</b> 25 Champis<br><br>';
if ($champis>=25) {
echo'<a href="#" class="buyButton">Actuellement indisponible.</a>';
} else { echo'<a href="#" class="buyButton">Vous n\'avez pas assez de Champis pour acheter cet article.</a>'; } echo'</td></tr></tbody></table><br><br><br>'; ?> 







<!-- Thème Odyssey -->


<table class="ludaweb01 shop-banniere-champi"><tbody><tr><td style="vertical-align:middle;padding:15px;"><img src="/images/theme-odyssey.png" title="Thème Super Mario Odyssey Icône" /></td>
<td style="padding:30px;"><div style="font-size:18px;font-weight:bold;">THEME SUPER MARIO ODYSSEY</div><br>
<br>Cet article vous permet de débloquer le thème "Super Mario Odyssey".<br>
<b>Prix :</b>100 Champis<br><br>
<?php if ($theme_odyssey==1) {
echo'<i>Vous avez déjà acheté cet article</i>';
} elseif ($champis>=100) {
echo'<a href="./acheter-article.php?id=5" class="buyButton">Acheter cet article</a>';
} else { echo'<a href="#" class="buyButton">Vous n\'avez pas assez de Champis pour acheter cet article.</a>'; } echo'</td></tr></tbody></table><br><br><br>'; 
} // FIN DES THEMES LUDAWEB010101
?>




<?php
include("includes/fin.php");
?>