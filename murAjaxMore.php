<?php
session_start();
$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';
$balises = true;
include("./includes/identifiants.php");
include("./includes/bbcode.php");
include("./includes/functions.php");
    $membre = (int) $_GET['id']; //On récupère la valeur de l'id
       $query=$db->prepare('SELECT * FROM publications LEFT JOIN forum_membres ON forum_membres.membre_id = publications.id_receveur WHERE id_receveur = :membre ORDER BY timestamp DESC LIMIT 20 OFFSET '.$_GET['offsetID'].''); // On sélectionne les publications
       $query->bindValue(':membre',$membre, PDO::PARAM_INT);
       $query->execute();
 if ($query->rowCount()>0)
 {
   $publiNumber = $_GET['offsetID'] + 1;
     while ($dataP=$query->fetch()) {
$publi = $dataP['id'];
    $CountComms=$db->prepare('SELECT COUNT(*) FROM publis_com WHERE id_publi = '.$publi.''); // On sélectionne les publications
    $CountComms->execute();
    $NbrComm=$CountComms->fetchColumn();

if ($dataP['id_posteur'] == $dataP['id_receveur']) { // Si le membre poste sur son profil
    echo '<div class="commentaires hidden" id="'.$publiNumber.'" style="padding:20px;"><table>
    <tbody>
      <tr>
        <td style="width:80px;">
          <img src="'.$dataP['membre_avatar'].'" alt="avatar" width="80" height="80" style="border-radius:50%;margin-top:5px;" />
        </td>';

      if ($dataP['officielle']==0) {
        echo'<td style="width:98%; text-align:left;padding-left:15px;"><span style="font-size:14px;"><p style="color:#888;">
        <a href="/profil-'.$dataP['membre_id'].'.html" style="color:'.$dataP['membre_couleur'].';">'.$dataP['membre_pseudo'].'</a> a publié sur son mur</p><a href="/publi-'.$publi.'.html" style="color:#a0a0a0;"><i class="material-icons" style="font-size:14px;">av_timer</i>
          le '.date('d/m/Y à H\hi', $dataP['timestamp']).'</a></span>
          <p>'.code(stripslashes(htmlspecialchars($dataP['message']))).'</p>';
        if ($dataP['id_posteur'] == $id OR $lvl>3) { 
          echo '&nbsp;&nbsp; <a href="./postok.php?action=suppr_publi&amp;id='.$publi.'" style="color:red;float:right;background:#f1c5c5;" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">SUPPRIMER</a>';
        }
        echo '<a href="/publi-'.$publi.'.html" style="color:darkblue;float:right;background:#c3fcff;" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">['.$NbrComm.'] COMMENTAIRE(S)</a></td>';
      } else { // Si c'est OFFICIEL
        echo'<td style="width:98%; text-align:left;padding-left:15px;"><span style="font-size:14px;"><p style="color:#888;">'.code(stripslashes(htmlspecialchars($dataP['message']))).'</p><p style="color:#a0a0a0;"><i class="material-icons" style="font-size:14px;">av_timer</i>
          le '.date('d/m/Y à H\hi', $dataP['timestamp']).'</p></span>&nbsp;';
        if ($lvl>3) {
          echo '&nbsp; <a href="./postok.php?action=suppr_publi&amp;id='.$publi.'" style="color:red;float:right;background:#f1c5c5;" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">SUPPRIMER</a>';
        }
      }
      echo'</tr>
    </tbody>
  </table></div>';
} else { //Sil publie sur un autre profil
     $receveur=$db->prepare('SELECT * FROM publications LEFT JOIN forum_membres ON forum_membres.membre_id = publications.id_posteur WHERE id = :id AND officielle = 0'); // On sélectionne les publications
     $receveur->bindValue(':id',$publi, PDO::PARAM_INT);
     $receveur->execute();
     $post=$receveur->fetch();

     echo '<div class="commentaires hidden" id="'.$publiNumber.'" style="padding:20px;"><table><tbody><tr>
   <td style="width:80px;"><img src="'.$post['membre_avatar'].'" alt="avatar" width="80" height="80" style="border-radius:50%;margin-top:5px;" /></td>
     <td style="width:98%;text-align:left;padding-left:15px;"><span style="font-size:14px;"><p style="color:#888;">
     <a href="/profil-'.$post['membre_id'].'.html" style="color:'.$post['membre_couleur'].';">'.$post['membre_pseudo'].'</a> a publié sur le mur de <a href="/profil-'.$dataP['membre_id'].'.html" style="color:'.$dataP['membre_couleur'].';">'.$dataP['membre_pseudo'].'</a></p>
      <a href="/publi-'.$publi.'.html" style="color:#a0a0a0;"><i class="material-icons" style="font-size:14px;">av_timer</i> le '.date('d/m/Y à H\hi', $post['timestamp']).'</a></span>
      <p>'.code(stripslashes(htmlspecialchars($dataP['message']))).'</p>';
        if ($dataP['id_posteur'] == $id OR $lvl>3) { 
          echo '&nbsp;&nbsp; <a href="./postok.php?action=suppr_publi&amp;id='.$publi.'" style="color:red;float:right;background:#f1c5c5;" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">SUPPRIMER</a>';
        }
        echo '<a href="/publi-'.$publi.'.html" style="color:darkblue;float:right;background:#c3fcff;" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">['.$NbrComm.'] COMMENTAIRE(S)</a></td></tr></tbody>
   </table></div>';
       }
    $publiNumber++;
   }
} else { echo 'Rien de récent !'; }
?>