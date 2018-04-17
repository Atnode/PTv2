<?php
session_start();
$titre = "Planète Toad &bull; Rédiger une fiche d'objet";
if ($_SESSION['lvl']>=2) header('Location: erreur_403.html');
include("includes/identifiants.php");
include("includes/debut.php");
include("includes/menu.php");
echo'<div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> <a href="./jeux.html">Encyclpédie des jeux</a> --> <a href="./add-game.php">Ajouter une fiche</a></div><br>
<h1>Rédiger une fiche de jeux</h1><br><br>
<div style="padding-left:4px;">L\'encyclopédie des jeux contient des fiches biographiques sur les jeux de l\'univers Mario. 
Afin qu\'elle soit la plus complète possible, merci de visiter plusieurs sources différentes, notamment des sites anglophones et détaillez le plus possible.</div>';

if (empty($_POST['nom'])) // Si on la variable est vide, on peut considérer qu'on est sur la page de formulaire
{
    echo'<form method="post" action="add-game.php"><div class="commentaires">
    <p><label for="nom">Nom du jeu :</label>  <input name="nom" type="text" id="nom" /></p><hr><br>
    <p><label for="console">Console :</label><input type="text" name="console" id="console" /></p><hr><br>
    <p><label for="developpeur">Développeur :</label><input type="text" name="developpeur" id="developpeur" /></p><hr><br>
    <p><label for="editeur">Editeur :</label><input type="text" name="editeur" id="editeur" /></p><hr><br>
    <p><label for="description">Description :</label>
    <textarea cols="160" rows="20" name="description" id="description"></textarea></p><hr><br>
    <p><label for="classification">Classification :</label><input type="text" name="classification" id="classification" /></p><hr><br>
    <p><label for="genre">Genre :</label><input type="text" name="genre" id="genre" /></p><hr><br>
    <p><label for="public">Public :</label><input type="text" name="public" id="public" /></p><hr><br>
    <p><label for="multijoueurs">Multijoueurs :</label><input type="text" name="multijoueurs" id="multijoueurs" /></p><hr><br>
    <p><label for="online">Online :</label><input type="text" name="online" id="online" /></p><hr><br>
    <p><label for="sortie_ue">Sortie UE : (Format AAAA-MM-YY)</label><input type="text" name="sortie_ue" id="sortie_ue" /></p><hr><br>
    <p><label for="sortie_us">Sortie US : (Format AAAA-MM-YY)</label><input type="text" name="sortie_us" id="sortie_us" /></p><hr><br>
    <p><label for="sortie_jp">Sortie Japon : (Format AAAA-MM-YY)</label><input type="text" name="sortie_jp" id="sortie_jp" /></p><hr><br>
    <p><input class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit" value="Envoyer" /></p></div></form>';
} else {
    echo'<p align=center>La fiche a bien été envoyée.</p>';

    // On renomme les variabes
    $nom = $_POST['nom'];
    $console = $_POST['console'];
    $developpeur = $_POST['developpeur'];
    $editeur = $_POST['editeur'];
    $description = $_POST['description'];
    $classification = $_POST['classification'];
    $genre = $_POST['genre'];
    $public = $_POST['public'];
    $multijoueurs = $_POST['multijoueurs'];
    $online = $_POST['online'];
    $sortie_ue = $_POST['sortie_ue'];
    $sortie_us = $_POST['sortie_us'];
    $sortie_jp = $_POST['sortie_jp'];

    $query=$db->prepare('INSERT INTO jeux (nom, console, developpeur, editeur, description, classification, genre, public, multijoueurs, online, sortie_ue, sortie_us, sortie_jp)
    VALUES (:nom, :console, :developpeur, :editeur, :description, :classification, :genre, :public, :multijoueurs, :online, :sortie_ue, :sortie_us, :sortie_jp)');
    $query->bindValue(':nom', $nom, PDO::PARAM_STR);
    $query->bindValue(':console', $console, PDO::PARAM_STR);
    $query->bindValue(':developpeur', $developpeur, PDO::PARAM_STR);
    $query->bindValue(':editeur', $editeur, PDO::PARAM_STR);
    $query->bindValue(':description', $description, PDO::PARAM_STR);
    $query->bindValue(':classification', $classification, PDO::PARAM_STR);
    $query->bindValue(':genre', $genre, PDO::PARAM_STR);
    $query->bindValue(':public', $public, PDO::PARAM_STR);
    $query->bindValue(':multijoueurs', $multijoueurs, PDO::PARAM_STR);
    $query->bindValue(':online', $online, PDO::PARAM_STR);
    $query->bindValue(':sortie_ue', $sortie_ue, PDO::PARAM_STR);
    $query->bindValue(':sortie_us', $sortie_us, PDO::PARAM_STR);
    $query->bindValue(':sortie_jp', $sortie_jp, PDO::PARAM_STR);
    $query->execute() or die(print_r($query->errorInfo())); 
}
include("includes/fin.php");
?>