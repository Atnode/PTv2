<?php
session_start();
  $membre = isset($_GET['m'])?(int) $_GET['m']:'';
  $amis = 1;
  $balises = true;
  include("includes/identifiants.php");
  $reponse = $db->query('SELECT membre_pseudo FROM forum_membres WHERE membre_id=' . $membre . '');
  $donnees = $reponse->fetch();
  $titre =  'Planète Toad &bull; Amis de ' . $donnees['membre_pseudo'] . '';
  $descrip = 'Consulter le nombre d\'amis du membre '.$donnees['membre_pseudo'].' sur le site Planète Toad';
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
    echo '<div class="corps" style="margin-top:-12.999px;"><br><h1>Amis de '.stripslashes(htmlspecialchars($data['membre_pseudo'])).'</h1>
       <br>';
       $searchFriends=$db->prepare('SELECT (ami_from + ami_to - :membre) AS membre_id, membre_pseudo, membre_avatar, membre_couleur FROM forum_amis LEFT JOIN forum_membres ON membre_id = (ami_from + ami_to - :membre) WHERE (ami_from = :membre OR ami_to = :membre) AND ami_confirm = :confirm');
       $searchFriends->bindValue(':membre',$membre, PDO::PARAM_INT);
       $searchFriends->bindValue(':confirm','1', PDO::PARAM_STR);
       $searchFriends->execute();
       echo'&nbsp; Ce membre a <b>'.$searchFriends->rowCount().'</b> ami(s).<br>';
     while ($data2=$searchFriends->fetch())
     {
echo '<div class="commentaires"><table><tbody><tr><td><a href="/profil-'.$data2['membre_id'].'.html"><img src="'.$data2['membre_avatar'].'" alt="amis" title="'.$data2['membre_pseudo'].'" style="max-height:130px;max-width:130px;border-radius:50%;" /></a></td>
<td style="vertical-align:middle;padding-left:15px;"><a href="/profil-'.$data2['membre_id'].'.html" style="color:'.$data2['membre_couleur'].';">'.$data2['membre_pseudo'].'</span></a><br><br>';
$idMec = $data2['membre_id'];
        if ($id!=0 AND $id != $idMec) {
       $AmisYou = $db->prepare('SELECT * FROM forum_amis WHERE (ami_from = '.$id.' AND ami_to = '.$idMec.') OR (ami_from = '.$idMec.' AND ami_to = '.$id.')');
       $AmisYou->execute();
       if ($AmisYou->rowCount()>0){
       $amisM = $AmisYou->fetch();
       if ($amisM['ami_confirm']==1) { echo'<a href="./envoi-mp-dest'.$idMec.'.html" class="buyButton" style="color:rgba(0, 171, 255, 0.78)!important;border-color:rgba(0, 171, 255, 0.78)!important;background:transparent;font-size:12px;text-shadow:0 0 0;"><i class="material-icons">&#xE163;</i> Envoyer un MP</a>'; } else { echo'<div class="butButton" style="color:grey;background:transparent;font-size:12px;text-shadow:0 0 0;">Demande en attente...</div>'; }
       } else {
           echo'<a href="./add-ami.php?add='.$idMec.'" class="buyButton" style="color:#00ff00!important;border-color:#00ff00!important;background:transparent;font-size:12px;text-shadow:0 0 0;">Ajouter en ami</a>';
       }
        } elseif ($id==$idMec) {
           echo'<a href="./modifierprofil.html" class="buyButton" style="color:rgba(0, 171, 255, 0.78)!important;border-color:rgba(0, 171, 255, 0.78)!important;background:transparent;font-size:12px;text-shadow:0 0 0;">Modifier mon profil</a>';
        }
echo'</td></tr></tbody></table></div><br><br>';
     }
}
include("includes/fin.php");
?>