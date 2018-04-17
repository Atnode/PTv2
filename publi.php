<?php
session_start();
$publi = (int) $_GET['id'];
include("./includes/identifiants.php");
//REQUETE SUR LA PUBLI
$query=$db->prepare('SELECT * FROM publications LEFT JOIN forum_membres ON forum_membres.membre_id = publications.id_receveur WHERE id='.$publi.' AND officielle <> 1');
$query->execute();
$publiData=$query->fetch();
if ($query->rowCount()<1)
{
echo'La publication n\'existe pas'; } else {

if (strlen($publiData['message'])<=52) { $PubliTexte = stripslashes($publiData['message']); } else { $PubliTexte = substr(stripslashes(htmlspecialchars($publiData['message'])), 0, 52).'...'; }

$titre =  'Planète Toad &bull; '.$PubliTexte.' ';
$descrip = "Consulter, commenter la publication sur le site Planète Toad";
$balises = true;
include("./includes/debut.php");
include("./includes/menu.php");
include("./includes/bbcode.php");

echo '<div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> <a href="./touteslespublis.html">Publications</a> -->
<a href="./publi-'.$publi.'.html">Consulter une publication</a></div><br>';
echo'<h1>Consulter une publication</h1>';
    $CountComms=$db->prepare('SELECT COUNT(*) FROM publis_com WHERE id_publi = '.$publi.''); // On sélectionne les publications
    $CountComms->execute();
    $NbrComm=$CountComms->fetchColumn();

if ($publiData['id_posteur'] == $publiData['id_receveur']) { // Si le membre poste sur son profil
    echo '<div class="commentaires"'; if(isset($data['article3_color'])) { echo'style="color:'.$data['article3_color'].';padding:20px;"'; } else{echo'padding:20px;';} echo'><table>
    <tbody>
      <tr>
        <td style="width:80px;">
          <img src="'.$publiData['membre_avatar'].'" alt="avatar" width="80" height="80" style="border-radius:50%;margin-top:5px;" />
        </td>

        <td style="width:98%; text-align:left;padding-left:15px;"><div style="font-size:14px;"><p style="color:#888;">
        <a href="/profil-'.$publiData['membre_id'].'.html" style="color:'.$publiData['membre_couleur'].';">'.$publiData['membre_pseudo'].'</a> a publié sur son mur</p><a href="/publi-'.$publi.'.html" style="color:#a0a0a0;"><i class="material-icons" style="font-size:14px;">av_timer</i>
          le '.date('d/m/Y à H\hi', $publiData['timestamp']).'</a></div>
          <p>'.code(stripslashes(htmlspecialchars($publiData['message']))).'</p><br>';
          if ($id!=0 AND $publiData['membre_id']!=$id) { // SEULS LES INSCRITS PEUVENT STATUER

         $CountLikeComms=$db->prepare('SELECT COUNT(*) FROM like_publis WHERE id_publi = '.$publi.''); // On sélectionne le nbr de like
         $CountLikeComms->execute();
         $total_likes=$CountLikeComms->fetchColumn();
          echo'<input type="button" value="Like" id="like" class="like" />&nbsp;(<span id="likes">'.$total_likes.'</span>)

          <a onclick="like('.$publi.')" style="cursor:pointer;float:left;"><img src="/images/publis/like.png" width="32" height="32" alt="Like" /></a>';
          }
        if ($publiData['id_posteur'] == $id OR $lvl>3) { 
          echo '&nbsp;&nbsp; <a href="./postok.php?action=suppr_publi&amp;id='.$publi.'" style="color:red;float:right;background:#f1c5c5;" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">SUPPRIMER</a>';
        }
        echo '</td></tr>
    </tbody>
  </table></div>';
} else { //Sil publie sur un autre profil
     $receveur=$db->prepare('SELECT * FROM publications LEFT JOIN forum_membres ON forum_membres.membre_id = publications.id_posteur WHERE id = :id AND officielle = 0'); // On sélectionne les publications
     $receveur->bindValue(':id',$publi, PDO::PARAM_INT);
     $receveur->execute();
     $post=$receveur->fetch();

     echo '<div class="commentaires" style="padding:20px;"><table><tbody><tr>
   <td style="width:80px;"><img src="'.$post['membre_avatar'].'" alt="avatar" width="80" height="80" style="border-radius:50%;margin-top:5px;" /></td>
     <td style="width:98%;text-align:left;padding-left:15px;"><span style="font-size:14px;"><p style="color:#888;">
     <a href="/profil-'.$post['membre_id'].'.html" style="color:'.$post['membre_couleur'].';">'.$post['membre_pseudo'].'</a> a publié sur le mur de <a href="/profil-'.$publiData['membre_id'].'.html" style="color:'.$publiData['membre_couleur'].';">'.$publiData['membre_pseudo'].'</a></p>
      <a href="/publi-'.$publi.'.html" style="color:#a0a0a0;"><i class="material-icons" style="font-size:14px;">av_timer</i> le '.date('d/m/Y à H\hi', $post['timestamp']).'</a></span>
      <p>'.code(stripslashes(htmlspecialchars($publiData['message']))).'</p>';
        if ($publiData['id_posteur'] == $id OR $lvl>3) { 
          echo '&nbsp;&nbsp; <a href="./postok.php?action=suppr_publi&amp;id='.$publi.'" style="color:red;float:right;background:#f1c5c5;" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">SUPPRIMER</a>';
        }
        echo '</td></tr></tbody></table></div>';
       }
// Commentaire
if ($id!=0) { echo'<br><form method="post" action="#" name="formulaire" style="text-align:center;">';
     echo'<textarea id="commenter" row="8" cols="60" name="commenter" placeholder="Répondre à la publication"></textarea><br>
     <input type="submit" id="envoyer" name="envoyer" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" value="Commenter ! (ou CTRL + Entrée)" /><br></form>'; }

//affichage
$commentaire=$db->prepare('SELECT * FROM publis_com LEFT JOIN forum_membres ON forum_membres.membre_id = publis_com.id_posteur WHERE id_publi = :id'); // On sélectionne les publications
$commentaire->bindValue(':id',$publi, PDO::PARAM_INT);
$commentaire->execute();
if ($commentaire->rowCount()>0) {
echo'<div id="commePubli" class="commentary">';
while ($comm=$commentaire->fetch()) {
echo'<div class="commentaires" style="width:75%;margin-left:83px;"><table><tbody><tr><td style="width:55px;"><img src="'.$comm['membre_avatar'].'" alt="avatar" style="max-width:50px;max-height:50px;border-radius:50%;" /></td>
   <td style="width:710px;text-align:left;">Par <a href="/profil-'.$comm['membre_id'].'.html" style="color:'.$comm['membre_couleur'].';">'.$comm['membre_pseudo'].'</a> le '.date('d/m/Y à H\hi', $comm['timestamp']).'';
              if ($comm['membre_id']==$id OR $lvl>=4) { 
                          echo '&nbsp; <a href="/comm-suppr-publi.php?id='.$comm['id'].'"><i class="material-icons md-18" style="color:red;">close</i></a>';
              }
   echo'<br> <p>'.code(stripslashes(htmlspecialchars($comm['texte']))).'</p></td>
   </tr></tbody></table></div>'; }
     echo'</div>'; }
?> <script type="text/javascript">
$(function(){function e(){var e="<?php echo $publi; ?>";$("#commePubli").load("publiAjax.php?id="+e)}e(),$("#envoyer").click(function(){var o="<?php echo $publi; ?>",n=$("#commenter").val();return $.post("postok.php?action=comment_publi&id="+o,{commenter:n},function(){$("#commenter").val(""),$("#commenter").focus(),e()}),!1}),document.addEventListener("keypress",function(o){if(10==o.keyCode){var n="<?php echo $publi; ?>",c=$("#commenter").val();return $.post("postok.php?action=comment_publi&id="+n,{commenter:c},function(){$("#commenter").val(""),$("#commenter").focus(),e()}),!1}})});

$(document).ready(function(){

    // like and unlike click
    $(".like").click(function(){
        var id = this.id;   // Getting Button id
        var split_id = id.split("_");

        var text = split_id[0];
        var postid = split_id[1];  // postid

        // Finding click type
        var type = 0;
        if(text == "like"){
            type = 1;
        }else{
            type = 0;
        }

        // AJAX Request
        $.ajax({
            url: 'like_publi.phpid='+n,
            type: 'post',
            data: {postid:postid,type:type},
            dataType: 'json',
            success: function(data){
                var likes = data['likes'];
                var unlikes = data['unlikes'];

                $("#likes_"+postid).text(likes);        // setting likes
                $("#unlikes_"+postid).text(unlikes);    // setting unlikes

                if(type == 1){
                    $("#like_"+postid).css("color","#ffa449");
                    $("#unlike_"+postid).css("color","lightseagreen");
                }

                if(type == 0){
                    $("#unlike_"+postid).css("color","#ffa449");
                    $("#like_"+postid).css("color","lightseagreen");
                }


            },
            error: function(data){
                alert("error : " + JSON.stringify(data));
            }
        });

    });


});
</script>
<?php
}
include("./includes/fin.php");
?>