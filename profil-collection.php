<?php
session_start();
  $membre = isset($_GET['m'])?(int) $_GET['m']:'';
  $collection = 1;
  $balises = true;
  include("includes/identifiants.php");
  $reponse = $db->query('SELECT membre_pseudo FROM forum_membres WHERE membre_id=' . $membre . '');
  $donnees = $reponse->fetch();
  $titre =  'Planète Toad &bull; Collection de ' . $donnees['membre_pseudo'] . '';
  $descrip = 'Consulter la collection du membre '.$donnees['membre_pseudo'].' sur le site Planète Toad';
  include("includes/debut.php");
  include("includes/menu.php");
  include("includes/bbcode.php");
  include("includes/headerprofil.php"); 

  //On récupère les infos du profil à voir
  $query=$db->prepare('SELECT * FROM forum_membres WHERE membre_id= :membre');
  $query->bindValue(':membre',$membre, PDO::PARAM_INT);
  $query->execute();
  $data=$query->fetch();
  if ($query->rowCount()>0) {
    echo '<div class="corps" style="margin-top:-12.999px;"><br><h1>Collection de '.stripslashes(htmlspecialchars($data['membre_pseudo'])).'</h1>
       <br>';
    // JEUX
    ?><h2>Jeux du membre</h2><p style="text-align:center;">Ce membre ne possède aucun jeu.</p>

<?php }
include("includes/fin.php");
?>