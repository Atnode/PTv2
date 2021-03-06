<?php
session_start();
$titre = "Planète Toad &bull; Rédiger une fiche de personnage";
if ($_SESSION['id']==0) header('Location: erreur_403.html');
include("includes/identifiants.php");
include("includes/debut.php");
include("includes/menu.php");
echo'<div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> <a href="./personnages.html">Encyclpédie des personnages</a> --> <a href="./add-perso.php">Ajouter une fiche</a></div><br>
<h1>Rédiger une fiche de personnage</h1><br><br>
<div style="padding-left:4px;">L\'encyclopédie des personnages contient des fiches biographiques sur les personnages de l\'univers Mario. 
Afin qu\'elle soit plus complète, ce sont les membres qui l\'alimentent. C\'est ici que vous pouvez créer des fiches de personnage. 
Afin qu\'elle soit la plus complète possible, merci de visiter plusieurs sources différentes, notamment des sites anglophones et détaillez le plus possible.</div>';

if (empty($_POST['nom_perso'])) // Si on la variable est vide, on peut considérer qu'on est sur la page de formulaire
{
    echo'<form method="post" action="add-perso.php"><div class="commentaires">
    <p><label for="nom_perso">Nom du personnage :</label>  <input name="nom_perso" type="text" id="pseudo" /></p><hr><br>
    <p><label for="premiere_apparition">Première apparition (ID JEU) :</label><input type="text" name="premiere_apparition" id="premiere_apparition" /></p><hr><br>
    <p><label for="derniere_apparition">Dernière apparition (ID JEU) :</label><input type="text" name="derniere_apparition" id="derniere_apparition" /></p><hr><br>
    <p><label for="alias">Alias :</label><input type="text" name="alias" id="alias" /></p><hr><br>
    <p><label for="sexe">Sexe :</label><input type="text" name="sexe" id="sexe" /></p><hr><br>
    <p><label for="espece">Espèce :</label><input type="text" name="espece" id="espece" /></p><hr><br>
    <p><label for="citation">Citation :</label><input type="text" name="citation" id="citation" /></p><hr><br>
    <p><label for="biographie">Biographie :</label>
    <textarea cols="160" rows="20" name="biographie" id="biographie"></textarea></p><hr><br>
    <p><input class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit" value="Envoyer" /></p></div></form>';
} else {
    echo'<p align=center>La fiche a bien été envoyée. Cependant, elle doit être validée par un rédacteur ou un membre de l\'équipe avant qu\'elle ne soit visible pour tout le monde.</p>';

    // On renomme les variabes
    $nom_perso = $_POST['nom_perso'];
    $premiere_apparition = $_POST['premiere_apparition'];
    $derniere_apparition = $_POST['derniere_apparition'];
    $alias = $_POST['alias'];
    $sexe = $_POST['sexe'];
    $espece = $_POST['espece'];
    $citation = $_POST['citation'];
    $biographie = $_POST['biographie'];

    $query=$db->prepare('INSERT INTO personnages (id_posteur, nom_perso, premiere_apparition, derniere_apparition, alias, sexe, espece, citation, texte, valide)
    VALUES (:id, :nom_perso, :premiere_apparition, :derniere_apparition, :alias, :sexe, :espece, :citation, :biographie, :valide)');
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->bindValue(':nom_perso', $nom_perso, PDO::PARAM_STR);
    $query->bindValue(':premiere_apparition', $premiere_apparition, PDO::PARAM_INT);
    $query->bindValue(':derniere_apparition', $derniere_apparition,PDO::PARAM_INT);
    $query->bindValue(':alias', $alias, PDO::PARAM_STR);
    $query->bindValue(':sexe', $sexe, PDO::PARAM_STR);
    $query->bindValue(':espece', $espece, PDO::PARAM_STR);
    $query->bindValue(':citation', $citation, PDO::PARAM_STR);
    $query->bindValue(':biographie', $biographie, PDO::PARAM_STR);
    $query->bindValue(':valide', "0", PDO::PARAM_INT);
    $query->execute() or die(print_r($query->errorInfo())); 
}


include("includes/fin.php");
?>