<?php
session_start();
$titre="Planète Toad &bull; Messagerie Privée";
$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
if ($id==0) header('Location: erreur_403.html'); 
$balises = true;
include("includes/identifiants.php");
include("includes/debut.php");
include("includes/menu.php");
include("includes/bbcode.php");
$action = (isset($_GET['action']))?htmlspecialchars($_GET['action']):'';

switch($action) //On switch sur $action
{
case "conversation": //Si on veut lire un message
    $id_conv = (int) $_GET['id']; //On récupère la valeur de l'id
    $infoss = 0;

    $query = $db->prepare('SELECT * FROM mp_texte
    LEFT JOIN forum_membres ON forum_membres.membre_id = id_expediteur
    LEFT JOIN mp_conversations ON mp_conversations.id = id_conversation 
    WHERE id_conversation = :id_conv');
    $query->bindValue(':id_conv',$id_conv,PDO::PARAM_INT);
    $query->execute() or die(print_r($query->errorInfo()));

    while ($data=$query->fetch()) {
    if ($infoss==0) {
          echo'<div id="filariane"><i>Vous êtes ici</i> : <a href="./index.html">Index</a> --> <a href="./mp.html">Messagerie Privée</a> --> Conversation</div><br>';
    echo '<h1>Conversation avec '.stripslashes(htmlspecialchars($data['membre_pseudo'])).'</h1>';
       
    //bouton de réponse
    echo'<p><a href="/nouveau-mp.html">
    <img src="./images/nouveau.png" alt="Nouveau message" title="Nouveau message" />
    </a>
    &nbsp; <a href id="rep_mp"><img src="./images/repondre.png" alt="Répondre" title="Répondre" /></a><div id="messages-list"><div id="messages-ajax">';
    $infoss++;
    }

if(is_array($data['id'])) {
$data['id'] = current(array_filter($data['id']));
}
    // Attention ! Seul le receveur du mp peut le lire !
/*    if ($data['id_createur'] == $id OR $data['id_guest'] == $id ) {


// Vérif pour voir si c'est déjà suppr
$verifSuppr = $db->prepare('SELECT * FROM mp_deleted WHERE id_membre = '.$id.' AND id_mp = '.$data['id'].'');
$verifSuppr->execute() or die(print_r($verifSuppr->errorInfo()));
if ($verifSuppr->rowCount()<1) {

if ($data['id_expediteur']==$id) {
echo'<div class="mp-me"><div style="float:right;"><a href="/profil-'.$data['membre_id'].'.html"><img style="max-width:65px;max-height:65px;border-radius:50%;" src="'.$data['membre_avatar'].'" alt="Avatar" /></a></div>
<div class="content-mpme">
<p style="color:#4E4E4E;font-style:italic;">';
$m = date('n',$data['time']);
echo 'Le '.date('d',$data['time']) .' ' . getMinMonth($m) .' '. date('Y',$data['time']) .' à '. date('H:i:s',$data['time']) .'
&nbsp; <a href="/action/delete-mp.php?id='.$data['id'].'&token='.md5($_COOKIE['PHPSESSID']).'"><i class="material-icons md-18" style="color:red;">close</i></a></p><br>
<p>'.code(nl2br(stripslashes(htmlspecialchars($data['texte'])))).'</p>
</div></div><div class="clearboth"></div><br><br><br><br>';
} else {
echo'<div class="mp-other"><div style="float:left;"><a href="/profil-'.$data['membre_id'].'.html"><img style="max-width:65px;max-height:65px;border-radius:50%;" src="'.$data['membre_avatar'].'" alt="Avatar" /></a></div>
<div class="content-mpother">
<p style="color:#4E4E4E;font-style:italic;"><a href="/profil-'.$data['membre_id'].'.html"><span style="color:'.stripslashes(htmlspecialchars($data['membre_couleur'])).';">'.stripslashes(htmlspecialchars($data['membre_pseudo'])).'</span></a>, ';
$m = date('n',$data['time']);
echo 'Le '.date('d',$data['time']) .' ' . getMinMonth($m) .' '. date('Y',$data['time']) .' à '. date('H:i:s',$data['time']) .'
&nbsp; <a href="/action/delete-mp.php?id='.$data['id'].'&token='.md5($_COOKIE['PHPSESSID']).'"><i class="material-icons md-18" style="color:red;">close</i></a></p><br>
<p>'.code(nl2br(stripslashes(htmlspecialchars($data['texte'])))).'</p>
</div></div><div class="clearboth"></div><br><br><br><br>';
}
  

    if ($data['lu'] == 0) {
      $putLu=$db->prepare('UPDATE mp_texte SET lu = :lu WHERE id_conversation = :id_conv AND id_receveur = :id');
      $putLu->bindValue(':lu',"1", PDO::PARAM_STR);
      $putLu->bindValue(':id',$id, PDO::PARAM_INT);
      $putLu->bindValue(':id_conv',$id_conv, PDO::PARAM_INT);
      $putLu->execute();
    }
}
        } else { echo'<META http-equiv="refresh" content="0; URL=/erreur_403.html">'; }*/
} // Fin du while
echo'</div><div class="clearboth"></div><form action="#" method="post">
<br><div id="answer_mp" style="width:auto;">';
include("code.php");
    echo'<textarea style="width:99%;" name="message" rows="3" id="message" placeholder="Votre message..."></textarea><br>
  <input id="envoyer" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="button" value="Envoyer (ou CTRL+Entrée)" /></div><br>
</form><br><br><div class="clearboth"></div>
</div>';
break; //La fin

case "nouveau": //Nouveau mp
       
   echo'<div id="filariane"><i>Vous êtes ici</i> : <a href="./index.html">Index</a> --> <a href="./mp.html">Messagerie privée</a> --> Ecrire un message</div><br>';
   echo '<h1>Nouveau message privé</h1>';

    $searchAmis = $db->prepare('SELECT (ami_from + ami_to - :id) AS ami_id, ami_date, membre_id, membre_pseudo FROM forum_amis
    LEFT JOIN forum_membres ON membre_id = (ami_from + ami_to - :id)
    WHERE (ami_from = :id OR ami_to = :id) AND ami_confirm = :conf ORDER BY membre_pseudo');
    $searchAmis->bindValue(':id',$id,PDO::PARAM_INT);       
    $searchAmis->bindValue(':conf','1',PDO::PARAM_STR);
    $searchAmis->execute();
   ?>
   <form method="post" action="postok.php?action=nouvelleconversation" style="text-align:center;" name="formulaire"><br>
   Envoyer à :<br>
   <select name="to">
   <option>-</option>
   <?php
    while ($data = $searchAmis->fetch())
    {
      echo'<option name="to" value="'.$data['membre_id'].'">'.$data['membre_pseudo'].'</option>';
    }
   ?> </select>
   <br>
   <br><br><?php include("code.php") ?><br>
   <textarea cols="80" rows="8" id="message" name="message"></textarea><br>
   <input type="submit" name="submit" id="envoyer" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" value="Envoyer" /></fieldset>
   </form>
<?php 
break;

case "repondre": //On veut répondre
   echo'<div id="filariane"><i>Vous êtes ici</i> : <a href="./index.html">Index</a> --> <a href="./mp.html">Messagerie privée</a> --> Répondre à un message</div><br>';
   echo '<h1><i class="material-icons">&#xE163;</i> Envoyer un message privé</h1><br><br>';

   $dest = (int) $_GET['dest'];
   $searchConv = $db->prepare('SELECT * FROM mp_conversations WHERE (id_createur = '.$id.' AND id_guest = '.$dest.') OR (id_createur = '.$dest.' AND id_guest = '.$id.')');
   $searchConv->execute();
   if ($searchConv->rowCount()>0) {
   $Conv = $searchConv->fetch();
   echo'<META http-equiv="refresh" content="0; URL=/conversation-'.$Conv['id'].'.html">';
   }

   $searchInfos = $db->prepare('SELECT * FROM forum_membres WHERE membre_id = '.$dest.'');
   $searchInfos->execute();
   $data = $searchInfos->fetch();
   echo'<p style="text-align:center;">Destinataire de votre MP : <b><span style="color:'.$data['membre_couleur'].';">'.$data['membre_pseudo'].'</span></b></p><br>';
   ?>
   <form method="post" action="postok.php?action=repondremp&dest=<?php echo $dest; ?>" style="text-align:center;"  name="formulaire">
   <br><br><?php include("code.php") ?><br>
   <textarea cols="80" rows="8" id="message" name="message"></textarea>
   <br>
   <input type="submit" name="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" value="Envoyer" />
   </form>
   <?php
break;

default;
    
    echo'<div id="filariane"><i>Vous êtes ici</i> : <a href="./index.html">Index</a> --> <a href="./mp.html">Messagerie privée</a></div><br />';
    echo '<h1>Messagerie Privée</h1>';

    $mpconv=$db->prepare('SELECT * FROM mp_conversations
    LEFT JOIN forum_membres ON membre_id = (id_createur + id_guest - :id)
    WHERE id_createur = :id OR id_guest = :id ORDER BY last_timestamp DESC');
    $mpconv->bindValue(':id',$id,PDO::PARAM_INT);
    $mpconv->execute();
    echo'<p><a href="./nouveau-mp.html">
    <img src="./images/nouveau.png" alt="Nouveau" title="Nouveau message" />
    </a></p>';
    if ($mpconv->rowCount()>0) {
        echo'<table style="width:100%;text-align:center;"><tr><th>Avatar</th><th>Pseudo</th><th>Messages échangés</th><th>Dernier message envoyé</th></tr>';
        //On boucle et on remplit le tableau
        while ($data = $mpconv->fetch())
        {
          $query=$db->prepare('SELECT COUNT(*) FROM mp_texte WHERE id_conversation = '.$data['id'].'');
          $query->execute();
          $TotalME=$query->fetchColumn();
          
          $query1=$db->prepare('SELECT * FROM mp_texte WHERE id_conversation = '.$data['id'].' AND id_receveur = '.$id.' ORDER BY id DESC');
          $query1->execute();
          $data2 = $query1->fetch();
            //Mp jamais lu, on affiche l'icone en question
            if($data2['lu']=="0") {
            echo'<tr style="background-color:#c2fbff;border-bottom:1px solid #969696;">';
            }
            else //si c'est lu
            {
            echo'<tr style="border-bottom:1px solid #969696;">';
            }
            if ($data['id_guest']==$id) {
            echo'<td class="forum" id="mp_expediteur" style="text-align:center;"><a href="./profil-'.$data['membre_id'].'.html"><img src="'.$data['membre_avatar'].'" alt="avatar" style="max-height:80px;border-radius:50%;" /></a></td>
            <td class="forum" id="mp_expediteur" style="text-align:center;"><a href="./conversation-'.$data['id'].'.html" style="color:'.htmlspecialchars($data['membre_couleur']).'">
            '.stripslashes(htmlspecialchars($data['membre_pseudo'])).'</a></td>
            <td>'.$TotalME.'</td>
            <td class="forum" id="mp_time">Le '.date('d/m/Y à H:i',$data['last_timestamp']).'</td></tr>';              
            } else {
            echo'<td class="forum" id="mp_expediteur" style="text-align:center;"><a href="./profil-'.$data['membre_id'].'.html"><img src="'.$data['membre_avatar'].'" alt="avatar" style="max-height:80px;border-radius:50%;" /></a></td>
            <td class="forum" id="mp_expediteur" style="text-align:center;"><a href="./conversation-'.$data['id'].'.html" style="color:'.htmlspecialchars($data['membre_couleur']).'">
            '.stripslashes(htmlspecialchars($data['membre_pseudo'])).'</a></td>
            <td>'.$TotalME.'</td>
            <td class="forum" id="mp_time">Le '.date('d/m/Y à H:i',$data['last_timestamp']).'</td></tr>';
          }
        } //Fin de la boucle
        echo '</table>';

    } //Fin du if
    else
    {
        echo'<p align=center>Vous n\'avez aucune conversation active, cliquez
        <a href="./nouveau-mp.html">ici</a> pour en créer une.</p>';
    }
} //Fin du switch
?>
<script type="text/javascript">
$("#rep_mp").on("click",function(o){o.preventDefault();var t=$("#answer_mp");t.show().find("textarea").focus(),$("body").scrollTop(t.offset().top-100)});

$(function() {
    function e() {
        var e = "<?php echo $id_conv; ?>";
        $("#messages-ajax").load("mpAjax.php?id=" + e)
    }
        e(), $("#envoyer").click(function() {
        var o = "<?php echo $id_conv; ?>",
        n = $("#message").val();
        
        return $.post("mpok.php?idconv=" + o, {
            message: n
        }, function() {
            $("#message").val(""), $("#message").focus(), e()
        })
    }), document.addEventListener("keypress", function(n) {
        if (10 == n.keyCode) {
            var o = "<?php echo $id_conv; ?>",
            t = $("#message").val();
            return $.post("mpok.php?idconv=" + o, {
            message: t
            }, function() {
                $("#message").val(""), $("#message").focus(), e()
            })
        }
    }, !1), setInterval(e, 15e3)
});
</script>
<?php
include("includes/fin.php");
?>