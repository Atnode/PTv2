<?php
session_start();
$id_article = (int) $_GET['id'];
include("./includes/identifiants.php");
$titre =  'Planète Toad &bull; Acheter un article';
include("./includes/debut.php");
if ($id==0) header('Location: erreur_403.html'); //Invité refusé
include("./includes/menu.php");
?>
<div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> <a href="./boutique.html">Boutique</a></div><br />
<h1>Acheter un article</h1><br><br><br>
<?php
if ($id_article==1) { //Si c'est le pseudo couleur
   $query=$db->prepare('SELECT * FROM forum_membres WHERE membre_id= '.$id.'');
   $query->execute() or die(print_r($query->errorInfo()));
   $data = $query->fetch();

   $i==0;
   $article1 = $data['article1'];
   if ($article1==1) { // S'il a déjà l'article
   	echo'<p align=center>Vous avez déjà cet article. Pourquoi vouloir le racheter une seconde fois ?<br>
   	<a href="/boutique.html">- Retourner à la boutique</a></p>';
   	$i++;
   }

   $champi = $data['membre_champi'];
   if ($champi<150) { //Moins de 150 Champis
    echo'<p align=center>Vous avez moins de 150 Champis, vous ne pouvez ainsi donc pas acheter cette article.
    <a href="/boutique.html">- Retourner à la boutique</a></p>';
    $i++;
   }

   if ($i==0) { //Aucune erreur, on achète
    $query=$db->prepare('UPDATE forum_membres SET membre_champi = membre_champi - 150, article1 = 1 WHERE membre_id= '.$id.'');
    $query->execute() or die(print_r($query->errorInfo()));
    echo'<p align=center>Vous avez désormais la possibilité de changer votre pseudo de couleur. Allez dans le <a href="/modifierprofil.html">panneau de modification 
    de votre profil</a> et choisissez la couleur de choix. Cependant, seules les couleurs hexadécimales ou anglaises sont acceptées.</p>';
   }

}
if ($id_article==2) { //Si c'est la bannière champi
   $query=$db->prepare('SELECT * FROM forum_membres WHERE membre_id= '.$id.'');
   $query->execute() or die(print_r($query->errorInfo()));
   $data = $query->fetch();

   $i==0;
   $banniere_champi = $data['banniere_champi'];
   if ($banniere_champi==1) { // S'il a déjà l'article
   	echo'<p align=center>Vous avez déjà cet article. Pourquoi vouloir le racheter une seconde fois ?<br>
   	<a href="/boutique.html">- Retourner à la boutique</a></p>';
   	$i++;
   }

   $champi = $data['membre_champi'];
   if ($champi<1000) { //Moins de 1000 Champis
    echo'<p align=center>Vous avez moins de 1000 Champis, vous ne pouvez ainsi donc pas acheter cette article.
    <a href="/boutique.html">- Retourner à la boutique</a></p>';
    $i++;
   }

   if ($i==0) { //Aucune erreur, on achète
    $query=$db->prepare('UPDATE forum_membres SET membre_champi = membre_champi - 1000, banniere_champi = 1 WHERE membre_id= '.$id.'');
    $query->execute() or die(print_r($query->errorInfo()));
    echo'<p align=center>Vous avez désormais la possibilité de changer votre bannière sur votre profil. Allez dans le <a href="/modifierprofil.html">panneau de modification 
    de votre profil</a> et choisissez la bannière.</p>';
   }
}
if ($id_article==3) { //Si c'est la bannière champi
   $query=$db->prepare('SELECT * FROM forum_membres WHERE membre_id= '.$id.'');
   $query->execute() or die(print_r($query->errorInfo()));
   $data = $query->fetch();

   $i==0;
   $changerpseudo = $data['changerpseudo'];
   if ($changerpseudo==1) { // S'il a déjà l'article
   	echo'<p align=center>Vous avez déjà la possibilité de changer 1 fois votre pseudo.<br>
   	<a href="/boutique.html">- Retourner à la boutique</a></p>';
   	$i++;
   }

   $champi = $data['membre_champi'];
   if ($champi<100) { //Moins de 150 Champis
    echo'<p align=center>Vous avez moins de 800 Champis, vous ne pouvez pas changer pour l\'instant votre pseudo.
    <a href="/boutique.html">- Retourner à la boutique</a></p>';
    $i++;
   }

   if ($i==0) { //Aucune erreur, on achète
    $query=$db->prepare('UPDATE forum_membres SET membre_champi = membre_champi - 100, changerpseudo = 1 WHERE membre_id= '.$id.'');
    $query->execute() or die(print_r($query->errorInfo()));
    echo'<p align=center>Vous avez désormais la possibilité de changer votre pseudo sur votre profil, une fois changé, si vous voulez le changer une autre fois, il faudra racheter une fois le changement de pseudo. Allez dans le <a href="/modifierprofil.html">panneau de modification 
    de votre profil</a> et modifiez dès maintenant votre pseudo.</p>';
   }
}

if ($id_article==4) { //Si c'est LA CARD
   $query=$db->prepare('SELECT * FROM forum_membres WHERE membre_id= '.$id.'');
   $query->execute() or die(print_r($query->errorInfo()));
   $data = $query->fetch();
   $champi = $data['membre_champi'];

   $i==0;
   $reqCard = $db->prepare('SELECT * FROM card WHERE membre_id = '.$id.'');
$reqCard->execute();
if ($reqCard->rowCount()>0) { 
echo'<p align=center>Vous avez déjà acheté cet article.
    <a href="/boutique.html">- Retourner à la boutique</a><br></p>';
    $i++; }


   if ($champi<130) { //Moins de 130 Champis
    echo'<p align=center>Vous avez moins de 130 Champis, vous ne pouvez pas changer pour l\'instant votre pseudo.
    <a href="/boutique.html">- Retourner à la boutique</a></p>';
    $i++;
   }

   if ($i==0) { //Aucune erreur, on achète
    $query=$db->prepare('UPDATE forum_membres SET membre_champi = membre_champi - 130 WHERE membre_id= '.$id.'');
    $query->execute() or die(print_r($query->errorInfo()));

        $reqNotif = $db->prepare('INSERT INTO card (membre_id, type) VALUES(:id,"1")');
        $reqNotif->bindValue(':id',$id,PDO::PARAM_INT);
        $reqNotif->execute();
        $idcard = $db->lastInsertId();
        $champi = $data['membre_champi'];

    $msgPUBLI = "[b][couleur=".$couleur."]".$pseudo."[/couleur][/b] vient d'acheter la [b]Planète Toad Card[/b] à la [url=http://www.planete-toad.fr/boutique.html]boutique[/url]";

    $publication = $db->prepare('INSERT INTO publications (id_posteur, id_receveur, message, timestamp, officielle) VALUES(:id, :id, :msgPUBLI, :time, :officielle)');
    $publication->bindValue(':id',$id,PDO::PARAM_INT);
        $publication->bindValue(':msgPUBLI',$msgPUBLI,PDO::PARAM_STR);  
        $publication->bindValue(':time',time(),PDO::PARAM_INT);
        $publication->bindValue(':officielle',"1",PDO::PARAM_INT);
        $publication->execute();


   }
    echo'<p align=center>Aperçu de votre Planète Toad Card :<br>
    <img src="/card-'.$idcard.'-'.strtolower($pseudo).'.png" title="Planète Toad Card" alt="Planète Toad Card" /><br><br>

   Voici l\'URL de votre Planète Toad Card : <b>http://www.planete-toad.fr/card-'.$idcard.'-'.strtolower($pseudo).'.png</b><br>
   Merci de ne pas l\'enregistrer sur votre ordinateur sinon les données ne s\'actualiseront plus automatiquement<br>
   Vous pouvez par exemple la mettre dans votre signature<br>
   </p>';

}









// Thème Odyssey

if ($id_article==5) { //Thème Odyssey
   $query=$db->prepare('SELECT * FROM forum_membres WHERE membre_id= '.$id.'');
   $query->execute() or die(print_r($query->errorInfo()));
   $data = $query->fetch();

   $i==0;
   $theme_odyssey = $data['theme_odyssey'];
   if ($theme_odyssey==1) { // S'il a déjà l'article
   	echo'<p align=center>Vous avez déjà cet article. Pourquoi vouloir le racheter une seconde fois ?<br>
   	<a href="/boutique.html">- Retourner à la boutique</a></p>';
   	$i++;
   }

   $champi = $data['membre_champi'];
   if ($champi<100) { //Moins de 1000 Champis
    echo'<p align=center>Vous avez moins de 200 Champis, vous ne pouvez ainsi donc pas acheter cette article.
    <a href="/boutique.html">- Retourner à la boutique</a></p>';
    $i++;
   }

   if ($i==0) { //Aucune erreur, on achète
    $query=$db->prepare('UPDATE forum_membres SET membre_champi = membre_champi - 200, theme_odyssey = 1 WHERE membre_id= '.$id.'');
    $query->execute() or die(print_r($query->errorInfo()));
    echo'<p align=center>Vous pouvez désormais choisir le thème "Super Mario Odyssey" dans <a href="/changedesign.html">la page du choix des thèmes.</a>.</p>';
   }
}

if ($id_article==6) { //Si c'est la JAUGE COULEUR
   $query=$db->prepare('SELECT * FROM forum_membres WHERE membre_id= '.$id.'');
   $query->execute() or die(print_r($query->errorInfo()));
   $data = $query->fetch();

   $i==0;
   $article4 = $data['article4'];
   if ($article4==1) { // S'il a déjà l'article
    echo'<p align=center>Vous avez déjà cet article. Pourquoi vouloir le racheter une seconde fois ?<br>
    <a href="/boutique.html">- Retourner à la boutique</a></p>';
    $i++;
   }

   $champi = $data['membre_champi'];
   if ($champi<90) { //Moins de 180 Champis
    echo'<p align=center>Vous avez moins de 90 Champis, vous ne pouvez ainsi donc pas acheter cette article.
    <a href="/boutique.html">- Retourner à la boutique</a></p>';
    $i++;
   }

   if ($i==0) { //Aucune erreur, on achète
    $query=$db->prepare('UPDATE forum_membres SET membre_champi = membre_champi - 90, article4 = 1 WHERE membre_id= '.$id.'');
    $query->execute() or die(print_r($query->errorInfo()));
    echo'<p align=center>Vous avez désormais la possibilité de changer la couleur de votre barre d\'expérience. Allez dans le <a href="/modifierprofil.html">panneau de modification 
    de votre profil</a> et choisissez la couleur de choix.</p>';

    $msgPUBLI = "[b][couleur=".$couleur."]".$pseudo."[/couleur][/b] vient d'acheter l'article pour personnaliser la couleur de sa barre d'expérience à la [url=http://www.planete-toad.fr/boutique.html]boutique[/url]";

    $publication = $db->prepare('INSERT INTO publications (id_posteur, id_receveur, message, timestamp, officielle) VALUES(:id, :id, :msgPUBLI, :time, :officielle)');
    $publication->bindValue(':id',$id,PDO::PARAM_INT);
        $publication->bindValue(':msgPUBLI',$msgPUBLI,PDO::PARAM_STR);  
        $publication->bindValue(':time',time(),PDO::PARAM_INT);
        $publication->bindValue(':officielle',"1",PDO::PARAM_INT);
        $publication->execute();

   }

}




include("includes/fin.php");
?>