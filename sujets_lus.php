<?php
session_start();
include("includes/identifiants.php");
$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
        // On marque les sujets comme lus pour l'utilisateur
        $query=$db->prepare('DELETE FROM forum_topic_view WHERE tv_id = '.$id.'');
        $query->execute();
                // On fait maintenant une redirection sur la page précédente.
                header('Location: ' . $_SERVER['HTTP_REFERER'] . '');
?>