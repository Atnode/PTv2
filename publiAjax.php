<?php
session_start();

$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';
$balises = true;
include("./includes/identifiants.php");
include("./includes/bbcode.php");
include("./includes/functions.php");
$publi = (int) $_GET['id'];

$commentaire=$db->prepare('SELECT * FROM publis_com LEFT JOIN forum_membres ON forum_membres.membre_id = publis_com.id_posteur WHERE id_publi = :id'); // On sélectionne les publications
$commentaire->bindValue(':id',$publi, PDO::PARAM_INT);
$commentaire->execute();
if ($commentaire->rowCount()>0) {
echo'<div id="commePubli" class="commentary">';
while ($comm=$commentaire->fetch()) {
echo'<div class="commentaires" style="width:75%;margin-left:83px;"><table><tbody><tr><td style="width:55px;"><img src="'.$comm['membre_avatar'].'" alt="avatar" style="max-width:50px;max-height:50px;border-radius:50%;" /></td>
   <td style="width:710px;text-align:left;">Par <a href="/profil-'.$comm['membre_id'].'.html" style="color:'.$comm['membre_couleur'].';">'.$comm['membre_pseudo'].'</a> le '.date('d/m/Y à H\hi', $comm['timestamp']).'';
              if ($comm['membre_id']==$id OR $lvl>=4) { 
                            echo '&nbsp; <a href="/action/comm-publi-suppr.php?id='.$comm['id'].'"><i class="material-icons md-18" style="color:red;">close</i></a>';
              }
   echo'<br> <p>'.code(stripslashes(htmlspecialchars($comm['texte']))).'</p></td>
   </tr></tbody></table></div>'; }
   echo'</div>'; }
?>