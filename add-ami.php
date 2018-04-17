<?php
session_start();
$idadd = isset($_GET['add'])?(int) $_GET['add']:'';
$titre="Planète Toad &bull; Ajouter un ami";
include("includes/identifiants.php");
include("includes/debut.php");
include("includes/menu.php");
if ($id==0) header('Location: erreur_403.html');
if (isset($idadd)) { // FAUT Kié quelquun
        $query=$db->prepare('SELECT membre_id, membre_pseudo, COUNT(*) AS nbr FROM forum_membres 
        WHERE membre_id = :idadd');
        $query->bindValue(':idadd',$idadd,PDO::PARAM_INT);
        $query->execute();
        $data = $query->fetch();
        $pseudo_exist = $data['nbr'];
        $i = 0;
        if(!$pseudo_exist) {
            echo '<p align="center">Ce membre ne semble pas exister<br />
            Cliquez <a href="./amis.html">ici</a> pour réessayer</p>';
            $i++;
        }
        $query->closeCursor();
        $query = $db->prepare('SELECT COUNT(*) AS nbr FROM forum_amis 
        WHERE ami_from = :id AND ami_to = :idadd
        OR ami_from = :id AND ami_to = :idadd');
        $query->bindValue(':id',$id,PDO::PARAM_INT);
        $query->bindValue(':idadd', $idadd, PDO::PARAM_INT);
        $query->execute();
        $deja_ami=$query->fetchColumn();
        $query->closeCursor();

        if ($deja_ami != 0) {
            echo '<p align="center">Ce membre fait déjà parti de vos amis ou a déjà fait une demande.<br>
            Cliquez <a href="./amis.html">ici</a> pour réessayer</p>';
            $i++;
        }
        if ($idadd == $id)
        {
            echo '<p align="center">Vous ne pouvez pas vous ajouter vous même<br>Cliquez <a href="./amis.html>ici</a> pour réessayer</p>';
            $i++;
        }
        if ($i == 0) {
            $query=$db->prepare('INSERT INTO forum_amis (ami_from, ami_to, ami_confirm, ami_date) VALUES(:id, :idadd, :conf, :temps)');
            $query->bindValue(':id',$id,PDO::PARAM_INT);
            $query->bindValue(':idadd', $idadd, PDO::PARAM_INT);
            $query->bindValue(':conf','0',PDO::PARAM_STR);
            $query->bindValue(':temps', time(), PDO::PARAM_INT);
            $query->execute();
            echo '<p align="center"><a href="/profil-'.$data['membre_id'].'.html">'.stripslashes(htmlspecialchars($data['membre_pseudo'])).'</a> 
            a bien été ajouté à vos amis, il faut toutefois qu\'il donne son accord.<br />
            Cliquez <a href="./index.html">ici</a> pour retourner à l\'accueil<br />
            Cliquez <a href="./amis.html">ici</a> pour retourner à la page de la gestion de vos amis</p>';
        }
}

include("includes/fin.php");
?>