<?php
session_start();
$mp = (int) $_GET['id'];
$token = isset($_GET['token'])?(int) $_GET['token']:'';
include("../includes/identifiants.php");
$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;

if ($id!=0 AND isset($mp) AND $token == md5($_COOKIE['PHPSESSID'])) {

// Vérif pour voir si c'est déjà suppr
$verifSuppr = $db->prepare('SELECT * FROM mp_deleted WHERE id_membre = '.$id.' AND id_mp = '.$mp.'');
$verifSuppr->execute();
if ($verifSuppr->rowCount()<1) {

        // On ajoute dans la table des MP DELETE
        $query=$db->prepare('INSERT INTO mp_deleted (id_membre, id_mp) VALUES(:id, :idmp)'); 
        $query->bindValue(':id',$id,PDO::PARAM_INT);   
        $query->bindValue(':idmp',$mp,PDO::PARAM_INT);
        $query->execute();
        $query->closeCursor();
} // FIN VERIF pour voir si c'est déjà suppr

// MAINTENANT SI Y A 2 RESULTATS ON VIRE LE MP
$verifDouble = $db->prepare('SELECT * FROM mp_deleted WHERE id_mp = '.$mp.'');
$verifDouble->execute();
if ($verifDouble->rowCount()==2) {
            //On supprime le MP
            $supprDouble=$db->prepare('DELETE FROM mp_texte WHERE id = :mp');
            $supprDouble->bindValue(':mp',$mp,PDO::PARAM_INT);
            $supprDouble->execute();
            $supprDouble->closeCursor();
}
                // On fait maintenant une redirection sur la page précédente.
                header('Location: ' . $_SERVER['HTTP_REFERER'] . '');
} else {
	// On fait maintenant une redirection sur la page précédente.
     header('Location: ' . $_SERVER['HTTP_REFERER'] . '');
     echo'<META http-equiv="refresh" content="0; URL=/">';
}
?>