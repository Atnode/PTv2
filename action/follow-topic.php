<?php
session_start();
$topic = (int) $_GET['t'];
include("../includes/identifiants.php");
$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;

if ($id!=0 AND isset($topic)) {
        // On suit le topic
        $query = $db->prepare('INSERT INTO topics_suivis (id_membre, id_topic) VALUES(:id, :topic)');
        $query->bindValue(':id',$id,PDO::PARAM_INT);
        $query->bindValue(':topic',$topic,PDO::PARAM_INT);
        $query->execute();
                // On fait maintenant une redirection sur la page précédente.
                header('Location: ' . $_SERVER['HTTP_REFERER'] . '');
}
?>