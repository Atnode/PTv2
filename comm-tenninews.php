<?php
session_start();
$titre="Planète Toad &bull; Poster";
include("includes/identifiants.php");
include("includes/debut.php");
if ($id==0) header('Location: erreur_403.html');
include("includes/menu.php");
$news = (isset($_GET['news']))?htmlspecialchars($_GET['news']):'';

if (isset($_GET['news'])) // Si l'on demande de mettre un comm
{
    // On protège la variable « id » pour éviter une faille SQL.
    $_GET['news'] = ($_GET['news']);
if (isset($_POST['commenter'])) 
{
    // S'il essaie de commenter une vieille news
    $oldNews = $db->prepare('SELECT * FROM tennindo WHERE id = '.$_GET['news'].'');
    $oldNews->execute();
    $agenews = $oldNews->fetch();
    $OneMonth = time() - $agenews['timestamp'];
    if ($OneMonth<2629800) {    
      $commentaire = $_POST['commenter'];
      if (!empty($commentaire)){
    $AddCom = $db->prepare('INSERT INTO commentairest (id_posteur,id_news,commentaire,timestamp) VALUES(:posteur_id, :news, :commentaire, :timestamp)');
    $AddCom->bindValue(':posteur_id',$id,PDO::PARAM_INT);
    $AddCom->bindValue(':news',$_GET['news'],PDO::PARAM_INT);
    $AddCom->bindValue(':commentaire',$commentaire,PDO::PARAM_STR);
    $AddCom->bindValue(':timestamp',time(),PDO::PARAM_INT);
    $AddCom->execute(); }
    }
}
}
include("includes/fin.php");
?>