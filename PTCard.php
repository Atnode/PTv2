<?php
include("includes/identifiants.php");
$idcard = $_GET['id'];

if (isset($idcard)) {
$query = $db->prepare('SELECT * FROM card LEFT JOIN forum_membres ON forum_membres.membre_id = card.membre_id WHERE id = '.$idcard.'');
$query->execute();
$data = $query->fetch();

// MAINTENANT ON CHERCHE LE NOM DU RANG
$rangReq = $db->prepare('SELECT nom, name FROM rangs WHERE tchampi_min <= '.$data['champi_total'].' AND tchampi_max >='.$data['champi_total'].'');
$rangReq->execute();
$rang = $rangReq->fetch();

$nom_image = "images/PTCard.jpeg";  // le nom de votre image avec l'extension jpeg
$RankImage = $rang['name'];
$nameRank = imagecreatefrompng($RankImage);
$nbrChampis = $data['membre_champi'];
$imgChampis = "champi.png";
$imageChampis = imagecreatefrompng($imgChampis);
$pseudo = $data['membre_pseudo'];
$avatar = $data['membre_avatar'];

// REDIMENSIONNEMENT DE L AVATAR
// Le fichier
$filename = $avatar;
$extension_avatar = strtolower(substr(  strrchr($avatar, '.')  ,1));

// Définition de la largeur et de la hauteur maximale
$width = 60;
$height = 60;

// Content type
if ($extension_avatar=="png") {
header('Content-Type: image/png');
} else {
header('Content-Type: image/jpeg');
}

// Cacul des nouvelles dimensions
list($width_orig, $height_orig) = getimagesize($filename);

$ratio_orig = $width_orig/$height_orig;

if ($width/$height > $ratio_orig) {
   $width = $height*$ratio_orig;
} else {
   $height = $width/$ratio_orig;
}

// Redimensionnement
$avatarH = imagecreatetruecolor($width, $height);
if ($extension_avatar=="png") {
$avatarI = imagecreatefrompng($filename);
} else {
$avatarI = imagecreatefromjpeg($filename);
}
imagecopyresampled($avatarH, $avatarI, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

$image = imagecreatefromjpeg($nom_image);
$noir = imagecolorallocate($image, 0, 0, 0);
ImageCopy($image, $avatarH, 38, 45, 0, 0, 60, 60);
ImageCopy($image, $nameRank, 150, 35, 0, 0, 200, 30);
ImageCopy($image, $imageChampis, 255, 74, 0, 0, 15, 14);
imagestring($image, 5, 285, 44,$nameRank, $noir);
imagestring($image, 5, 225, 74,$nbrChampis, $noir);
imagestring($image, 5, 35, 24,$pseudo, $noir);
imagepng($image);

}
?>