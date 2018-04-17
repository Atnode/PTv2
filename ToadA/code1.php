<?php
session_start();
include("../includes/identifiants.php");
include("../includes/debut.php");
if ($id!=0) {
  $scoreTA = $_POST["gdjs.evtTools.common.getVariableString(runtimeScene.getVariables().getFromIndex(1))"];
  if (isset($scoreTA)) {
  $query = $db->prepare('UPDATE forum_membres SET score_ta = '.$scoreTA.' WHERE membre_id = '.$id.'');
  $query->execute();

  $message = "J'ai fait un record de ".$scoreTA." au [b]Toad Airplane[/b].";
  $query = $db->prepare('INSERT INTO publications (id_posteur, id_receveur, message, timestamp, officielle) VALUES(:id, :id, :message, :time, :officielle)');
  $query->bindValue(':id',$id,PDO::PARAM_INT);
  $query->bindValue(':message',$message,PDO::PARAM_STR);
  $query->bindValue(':time',time(),PDO::PARAM_INT);
  $query->bindValue(':officielle','1',PDO::PARAM_STR);
  $query->execute();
  }
}
?>