<?php
session_start();
$titre = "Planète Toad &bull; Quiz";
include("includes/identifiants.php");
include("includes/debut.php");
if ($lvl<2) header('Location: erreur_403.html'); 
include("includes/menu.php");
echo'<div id="filariane"><i>Vous êtes ici</i> : <a href="./" title="Index">Index</a> -> Quiz</div><br />
<h1>Quiz</h1>';

echo'Bienvenue dans le quiz. Il sera composé de 10 questions et vous n\'aurez qu\'une minute pour répondre à chaque question. Bonne chance.<br /><br />
<a href="http://www.planete-toad.fr/quiz.php?q=1"><div class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">Cliquez ici pour commencer le quiz.</div></a>';
       $query=$db->prepare('SELECT * FROM quiz_membre WHERE id_membre=:id');
       $query->bindValue(':id',$id, PDO::PARAM_INT);
       $query->execute() or die(print_r($query->errorInfo()));
       $data=$query->fetch();
if ($query->rowCount()<1) { 
$commencer = $db->prepare('INSERT INTO quiz_membre (id_membre, id_question) VALUES (:id, "1")');
$commencer->bindValue(':id',$id,PDO::PARAM_INT);
$commencer->execute(); }
include("includes/fin.php");
?>