<?php
session_start();
$titre="Planète Toad &bull; Enregistre Score";
include("../includes/identifiants.php");
if (isset ($_COOKIE['id']) && isset($_COOKIE['password']) && empty($id))
{
$_SESSION['id'] = $_COOKIE['id'];
$_SESSION['password'] = $_COOKIE['password']; 

        $query = $db->prepare('SELECT * FROM forum_membres WHERE membre_id = :id');
		$query->bindValue(':id',$_COOKIE['id'],PDO::PARAM_INT);
		$query->execute();
		$data = $query->fetch();
if ($data['membre_mdp'] == ($_COOKIE['password'])) // Acces OK !
{
        $_SESSION['pseudo'] = $data['membre_pseudo'];
        $_SESSION['level'] = $data['membre_rang'];
	    $_SESSION['id'] = $data['membre_id'];
		$_SESSION['password'] = $data['membre_mdp'];
}

}

//Attribution des variables de session
$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';
if ($id!=0) {
$query = $db->prepare('SELECT record_TA FROM forum_membres WHERE membre_id = :id');
$query->bindValue(':id',$id,PDO::PARAM_INT);
$query->execute();
$data = $query->fetch();
$Score = gdjs.evtTools.common.getVariableString(runtimeScene.getVariables().getFromIndex(1)) ;
if ($Score>$data['record_TA']) {
	$newRecord = $db->prepare('UPDATE forum_membres SET record_TA = '.$Score.' WHERE membre_id = :id');
    $newRecord->bindValue(':id',$id,PDO::PARAM_INT);
    $newRecord->execute();
	
	//La publi informe
	$PubliInforme = $db->prepare('INSERT INTO publications(id_posteur, id_receveur, message, timestamp) VALUES(:id, :id, :msg, :time)');
    $PubliInforme->bindValue(':id',$id,PDO::PARAM_INT);
    $PubliInforme->bindValue(':id',$id,PDO::PARAM_INT);
    $PubliInforme->bindValue(':msg',"Mon nouveau record au Toad Airplane est désormais de ".$Score." points.",PDO::PARAM_STR);
    $PubliInforme->bindValue(':time',time(),PDO::PARAM_INT);
    $PubliInforme->execute();	
}
}
include("../includes/fin.php");
?>