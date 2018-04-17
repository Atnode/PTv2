<?php
session_start();
$q = isset($_GET['q'])?htmlspecialchars($_GET['q']):'';
$titre = "Planète Toad &bull; Quiz";
include("includes/identifiants.php");
include("includes/debut.php");
if ($lvl<2) header('Location: erreur_403.html'); 
include("includes/menu.php");
echo'<div id="filariane"><i>Vous êtes ici</i> : <a href="./" title="Index">Index</a> -> Quiz</div><br />
<h1>Quiz</h1>';

       $query=$db->prepare('SELECT * FROM quiz_membre WHERE id_membre=:id');
       $query->bindValue(':id',$id, PDO::PARAM_INT);
       $query->execute() or die(print_r($query->errorInfo()));
       $data=$query->fetch();
if ($query->rowCount()<1)
{} else {
if (($_GET['q'])!=$data['id_question']) { echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://www.planete-toad.fr/quiz.php?q='.$data['id_question'].'">';} else {
echo'<div style="text-align:center;font-weight:bold;">';
$question1 = $db->prepare('SELECT * FROM quiz_liste WHERE id = '.($_GET['q']).'');
$question1->execute();
$question2 = $question1->fetch();
$_GET['q'] = ($_GET['q']);
echo''.$question2['question'].'</div>
<form method="post" action="quiz.php?q='.($_GET['q']).'">
<input id="reponse" name="reponse"></input>
<br /><input class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit" value="Envoyer" /></form>';
if (isset($_POST['reponse'])) {
      $reponse = $_POST['reponse'];
      $query = $db->prepare('INSERT INTO quiz_reply (id_question,id_membre,reponse) VALUES(:question, :id, :reponse)');
      $query->bindValue(':question',$_GET['q'],PDO::PARAM_INT);
		$query->bindValue(':id',$id,PDO::PARAM_INT);
		$query->bindValue(':reponse',$reponse,PDO::PARAM_STR);
		$query->execute();


      $lalala = $db->prepare('UPDATE quiz_membre SET id_question = id_question + 1 WHERE id_membre = :id');
	  $lalala->bindValue(':id',$id,PDO::PARAM_INT);
	  $lalala->execute();
echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://www.planete-toad.fr/quiz.php?q='.$data['id_question'].'">';
} } }
include("includes/fin.php");
?>