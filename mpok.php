<?php
session_start();
$idconv = isset($_GET['idconv'])?(int) $_GET['idconv']:'';
$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
if ($id==0) header('Location: erreur_403.html'); 
include("includes/identifiants.php");

$query = $db->prepare('SELECT * FROM mp_conversations WHERE id = '.$idconv.'');
$query->execute();
$data = $query->fetch();
if ($query->rowCount()>0 AND isset($_POST['message']) AND ($data['id_createur']==$id OR $data['id_guest']==$id)) {

	$lastMP = $db->prepare('SELECT time FROM mp_texte WHERE id_expediteur = '.$id.' AND id_conversation = '.$idconv.' ORDER BY id DESC LIMIT 1');
    $lastMP->execute();
    $lastMPsent = $lastMP->fetch();
    $lastTime = $lastMPsent['time'];

    if ((time() - $lastTime)>5) { // LIMITE FLOOD
 
    $AmisYou = $db->prepare('SELECT * FROM forum_amis WHERE (ami_from = '.$data['id_createur'].' AND ami_to = '.$data['id_guest'].') OR (ami_from = '.$data['id_guest'].' AND ami_to = '.$data['id_createur'].') AND ami_confirm = "1" ');
    $AmisYou->execute();
    if ($AmisYou->rowCount()>0) {
	$newMP=$db->prepare('INSERT INTO mp_texte (id_conversation, id_expediteur, id_receveur, texte, time, lu) VALUES(:conv, :id, :id_receveur, :texte, :temps, :lu)');
	$newMP->bindValue(':conv', $idconv, PDO::PARAM_INT);
	$newMP->bindValue(':id', $id, PDO::PARAM_INT);
	if ($data['id_createur']==$id) {
	$newMP->bindValue(':id_receveur', $data['id_guest'], PDO::PARAM_INT);
    } else {
	$newMP->bindValue(':id_receveur', $data['id_createur'], PDO::PARAM_INT);    
    }
	$newMP->bindValue(':texte', $_POST['message'], PDO::PARAM_STR);
    $newMP->bindValue(':temps', time(), PDO::PARAM_INT);
    $newMP->bindValue(':lu', '0', PDO::PARAM_STR);
	$newMP->execute();

	$updateConv = $db->prepare('UPDATE mp_conversations SET last_timestamp = '.time().' WHERE id = '.$idconv.'');
	$updateConv->execute();
}
	}
}
?>