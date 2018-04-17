<?php
session_start();
$mpID = $_GET['id'];
include("../includes/identifiants.php");
$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;


// AUTEUR DU MP
$query = $db->prepare('SELECT * FROM mp_texte WHERE id = '.$mpID.'');
$query->execute();
$data = $query->fetch();
$auteurMP = $data['id_expediteur'];
if ($id==$auteurMP AND isset($mpID)) {
        // On supprime le MP
        $reqSuppr = $db->prepare('DELETE FROM mp_texte WHERE id = '.$mpID.'');
        $reqSuppr->execute();
                // On fait maintenant une redirection sur la page précédente.
                header('Location: ' . $_SERVER['HTTP_REFERER'] . '');
}
?>