<?php
session_start();
$balises = true;
$titre = "Planète Toad &bull; Publications";
$descrip = "Toutes les publications postées par les membres sur Planète Toad";
include("includes/identifiants.php");
include("includes/bbcode.php");
include("includes/debut.php");
include("includes/menu.php");
?>
<div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> <a href="./ntxp.html">Toutes les publis</a></div><br />
<h1>Toutes les publications</h1><br>

<?php
if ($id!=0) {
     echo'<form method="post" style="padding:5px;" action="postok.php?action=publier&amp;id='.$id.'" name="formulaire">
<div class="commentaires" style="padding:20px;"><table>
    <tbody>
      <tr>
        <td style="width:80px;">
          <img src="'.$avatar.'" alt="avatar" width="80" height="80" style="border-radius:50%;margin-top:5px;" />
        </td>';
     include("code.php");
     echo'<td><textarea name="publier" rows="6" cols="60" id="message" placeholder="Publier un p\'tit message..."></textarea><br>
     <input type="submit" name="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" value="Envoyer" /></form></td></tr></tbody></table></div><br><hr /><br>'; }
    $query=$db->prepare('SELECT * FROM publications LEFT JOIN forum_membres ON forum_membres.membre_id = publications.id_receveur WHERE officielle <> 1 ORDER BY timestamp DESC LIMIT 75'); // On sélectionne les publications
    $query->execute();
    while ($data = $query->fetch()) {
$publi = $data['id'];
    $CountComms=$db->prepare('SELECT COUNT(*) FROM publis_com WHERE id_publi = '.$publi.''); // On sélectionne les publications
    $CountComms->execute();
    $NbrComm=$CountComms->fetchColumn();

if ($data['id_posteur'] == $data['id_receveur']) { // Si le membre poste sur son profil
    echo '<div class="commentaires" style="padding:20px;"><table>
    <tbody>
      <tr>
        <td style="width:80px;">
          <img src="'.$data['membre_avatar'].'" alt="avatar" width="80" height="80" style="border-radius:50%;margin-top:5px;" />
        </td>';

        echo'<td style="width:98%; text-align:left;padding-left:15px;"><span style="font-size:14px;"><p style="color:#888;">
        <a href="/profil-'.$data['membre_id'].'.html" style="color:'.$data['membre_couleur'].';">'.$data['membre_pseudo'].'</a> a publié sur son mur</p><a href="/publi-'.$publi.'.html" style="color:#a0a0a0;"><i class="material-icons" style="font-size:14px;">av_timer</i>
          le '.date('d/m/Y à H\hi', $data['timestamp']).'</a></span>
          <p>'.code(stripslashes(htmlspecialchars($data['message']))).'</p>';
        if ($data['id_posteur'] == $id OR $lvl>3) { 
          echo '&nbsp;&nbsp; <a href="./postok.php?action=suppr_publi&amp;id='.$publi.'" style="color:red;float:right;background:#f1c5c5;" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored"><i class="material-icons md-18">delete_forever</i> Supprimer</a>';
        }
        echo '<a href="/publi-'.$publi.'.html" style="float:right;background:#2597dd;" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored"><i class="material-icons md-18">comment</i> Commentaires ('.$NbrComm.')</a></td></tr>
    </tbody>
  </table></div>';
} else { // s'il publie sur un autre profil
       $receveur=$db->prepare('SELECT * FROM publications LEFT JOIN forum_membres ON forum_membres.membre_id = publications.id_posteur WHERE id = :id'); // On sélectionne les publications
     $receveur->bindValue(':id',$publi, PDO::PARAM_INT);
     $receveur->execute();
     $post=$receveur->fetch();

     echo '<div class="commentaires" id="'.$publiNumber.'" style="padding:20px;"><table><tbody><tr>
   <td style="width:80px;"><img src="'.$post['membre_avatar'].'" alt="avatar" width="80" height="80" style="border-radius:50%;margin-top:5px;" /></td>
     <td style="width:98%;text-align:left;padding-left:15px;"><span style="font-size:14px;"><p style="color:#888;">
     <a href="/profil-'.$post['membre_id'].'.html" style="color:'.$post['membre_couleur'].';">'.$post['membre_pseudo'].'</a> a publié sur le mur de <a href="/profil-'.$data['membre_id'].'.html" style="color:'.$data['membre_couleur'].';">'.$data['membre_pseudo'].'</a></p>
      <a href="/publi-'.$publi.'.html" style="color:#a0a0a0;"><i class="material-icons md-18" style="font-size:14px;">av_timer</i> le '.date('d/m/Y à H\hi', $post['timestamp']).'</a></span>
      <p>'.code(stripslashes(htmlspecialchars($data['message']))).'</p>';
        if ($data['id_posteur'] == $id OR $lvl>3) { 
          echo '&nbsp;&nbsp; <a href="./postok.php?action=suppr_publi&amp;id='.$publi.'" style="color:red;float:right;background:#f1c5c5;" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored"><i class="material-icons md-18">delete_forever</i> Supprimer</a>';
        }
        echo '<a href="/publi-'.$publi.'.html" style="float:right;background:#2597dd;" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored"><i class="material-icons md-18">comment</i> Commentaires ('.$NbrComm.')</a></td>
   </table></div>';
} }
include("includes/fin.php");
?>