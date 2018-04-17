<?php
session_start();
include("includes/identifiants.php");
include("includes/debut.php");

$query = $db->prepare('SELECT * FROM forum_membres');
$query->execute();
while ($data = $query->fetch()) {
	$avatar = $data['membre_avatar'];
	$newAva = strripos($avatar, '/');
	$avatarSansUrl = '//avatars.planete-toad.fr' . $newAva ;
	
	$sql = $db->prepare('select SUBSTRING_INDEX(membre_avatar,'/',-1) from forum_membres WHERE membre_id = '.$data['membre_id'].'');
	$sql->execute();
	echo $sql->fetch() . '<br>';
    
	//$query1 = $db->prepare('UPDATE forum_membres SET membre_avatar = '.$avatarSansUrl.' WHERE membre_id = '.$data['membre_id'].'');
	//$query1->execute();
}