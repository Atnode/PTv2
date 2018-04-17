<?php
session_start();
$topic = (int) $_GET['t'];
include("../includes/identifiants.php");
$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;

if ($id!=0 AND isset($topic)) {
        // On marque les sujets comme lus pour l'utilisateur
        $query=$db->prepare('DELETE FROM topics_suivis WHERE id_membre = '.$id.' AND id_topic = '.$topic.'');
        $query->execute();
                // On fait maintenant une redirection sur la page précédente.
                header('Location: ' . $_SERVER['HTTP_REFERER'] . '');
}
?>