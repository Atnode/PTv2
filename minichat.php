<?php
session_start();
$titre = "Planète Toad &bull; Chat";
$balises = true;
include("./includes/identifiants.php");
include("./includes/debut.php");
if ($_SESSION['level']<2) header('Location: erreur_403.html'); 
include("./includes/menu.php");
echo '<div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> <a href="./chat.html">Chat</a></div><br>';
include("./includes/bbcodechat.php");

echo'<h1>Minichat</h1>';
$BannisChat = $db->query('SELECT id FROM bannis_chat WHERE id = '. $id .'');
if ($BannisChat->fetch() == false)
{
echo'<p style="text-align:center;">
<form action="#" method="post" style="text-align:center;">';
include("code.php");
echo'<br>
 <textarea name="message" rows="6" cols="60" id="message" placeholder="Votre message..."></textarea><br>
 <button id="envoyer" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="button"><i class="material-icons">&#xE163;</i> Envoyer (ou CTRL+Entrée)</button>
<div id="demo-snackbar-example" class="mdl-js-snackbar mdl-snackbar">
  <div class="mdl-snackbar__text">Message envoyé</div>
  <button class="mdl-snackbar__action" type="button"></button>
</div></form></p>
<div style="float:left;width:75%;" id="minichat">';
if ($lvl==0) {
  if (isset ($_COOKIE['id']) && isset($_COOKIE['password']))
  {
    setcookie('id', '', time(), null, null, false);
    setcookie('password', '', time(), null, null, false);
  }
  session_destroy();
}

    $query=$db->query('SELECT * FROM forum_membres WHERE membre_id= '.$id.'');
  if ($query->rowCount()<1) {
  if (isset ($_COOKIE['id']) && isset($_COOKIE['password']))
  {
    setcookie('id', '', time(), null, null, false);
    setcookie('password', '', time(), null, null, false);
  }
  session_destroy();
  }

  $req = $db->query('SELECT * FROM forum_chat LEFT JOIN forum_membres ON membre_id = posteur_id ORDER BY id DESC LIMIT 0,30');
  while($val = $req->fetch())
  {
      // Pseudo color
        $val['message'] = str_replace($pseudo, "[b][couleur=".$couleur."]".$pseudo."[/couleur][/b]", $val['message']);
    $val['message'] = preg_replace('`\[couleur=(.+)\](.*)\[couleur=.+\](.*)\[/couleur\](.*)\[/couleur\]`isU',"[couleur=$1]$2$3$4[/couleur]",$val['message']);
    $val['message'] = preg_replace('`\[b\](.*)\[b\](.*)\[/b\](.*)\[/b\]`isU',"[b]$1$2$3[/b]",$val['message']);


    echo '
      <div class="commentaires"><table>
        <tbody>
          <tr>
            <td style="width:70px;">';
            if (!empty($val['membre_avatar'])) {
              echo '<a href="/profil-'.$val['membre_id'].'.html"><img src="'.$val['membre_avatar'].'" style="border-radius:50%;margin-top:10px;" width="70" title="'.$val['membre_pseudo'].'" /></a>' ;
            }
            echo '</td>
            <td style="width:980px;padding-left:20px;">
              Par <strong><span onclick="address(\''.str_replace("'","\\'", htmlentities(stripslashes($val['membre_pseudo']))) .'\',\''.htmlentities(stripslashes($val['membre_couleur'])).'\' ); return false;" style="color:'.htmlentities(stripslashes($val['membre_couleur'])).'; cursor:pointer;">
                '.htmlentities(stripslashes($val['membre_pseudo']), ENT_QUOTES, "UTF-8").'</span>
              </strong> à '.date('H:i:s',$val['timestamp']);
              if ($val['membre_id']==$id OR $lvl>=4) { 
                            echo '&nbsp; <a href="./postok.php?action=suppr_chat&amp;id='.$val['id'].'"><i class="material-icons md-18" style="color:red;">close</i></a>';
              }
              echo '<p>'.code(nl2br(stripslashes(htmlspecialchars($val['message'], ENT_QUOTES, "UTF-8")))).'</p>
            </td>
          </tr>
        </tbody>
      </table></div>';
  }
echo'</div>'; //Fermeture de #minichat
if ($id!=0) {
$EnLigne = $db->query('SELECT * FROM chat_online WHERE id_online = '.$id.'');
if ($EnLigne->fetch() == false)
{
  $query = $db->prepare('INSERT INTO chat_online(id_online, timestamp) VALUES(:id, :time)');
  $query->bindValue(':id',$id,PDO::PARAM_INT);
  $query->bindValue(':time',time(),PDO::PARAM_INT);
  $query->execute();
} else {
  $query = $db->prepare('UPDATE chat_online SET timestamp = :time, absent = "0" WHERE id_online = :id');
  $query->bindValue(':time',time(),PDO::PARAM_INT);
  $query->bindValue(':id',$id,PDO::PARAM_INT);
  $query->execute();
  $query->closeCursor();

$time_max = time() - (60 * 5);
$query=$db->prepare('DELETE FROM chat_online WHERE timestamp < :timemax');
$query->bindValue(':timemax',$time_max,PDO::PARAM_INT);
$query->execute();
$query->closeCursor();

//S'il est absent
$absent = time() - (60 * 3);
$query = $db->prepare('UPDATE chat_online SET absent = "1" WHERE timestamp < :absent');
$query->bindValue(':absent',$absent,PDO::PARAM_INT);
$query->execute();
$query->closeCursor();
}  }
$Liste = $db->query('SELECT id_online, membre_id, membre_pseudo, membre_couleur, membre_avatar, absent FROM chat_online LEFT JOIN forum_membres ON membre_id = id_online ORDER BY timestamp DESC');
echo'<div id="online"><h2>Membres en ligne</h2>
<table><tbody><tr>';
while($data = $Liste->fetch()) {
	echo'<td style="padding:20px;"><a href="/profil-'.htmlentities(stripslashes($data['membre_id'])).'.html" style="color:'.htmlentities(stripslashes($data['membre_couleur'])).';">';
	if ($data['absent']=="0"){echo'<img src="'.htmlentities(stripslashes($data['membre_avatar'])).'" style="max-width:75px;margin-right:10px;margin-bottom:-14%;border-radius:50%;border:4px solid green;" alt="avatar" title="En ligne">';}
	else{echo'<img src="'.htmlentities(stripslashes($data['membre_avatar'])).'" style="max-width:75px;margin-right:10px;margin-bottom:-14%;border-radius:50%;border:4px solid orange;" alt="avatar" title="Absent">';}
	
	echo''.htmlentities(stripslashes($data['membre_pseudo']), ENT_QUOTES, "UTF-8").'</a></td>';
    echo'</tr><tr>';
}
echo'
</tr></tbody></table></div><div class="clearboth"></div>';
}
else {
        $query=$db->prepare('SELECT membre_id, membre_pseudo, membre_couleur, id_bannisseur FROM bannis_chat LEFT JOIN forum_membres ON membre_id = id_bannisseur');
        $query->execute();
        $data=$query->fetch();
echo'<p align=center><b>Vous avez été banni du chat par <span style="color:'.$data['membre_couleur'].';">'. $data['membre_pseudo'] .'</span>. 
Pour connaître la raison, contactez-le</p></b>';
}
?>
<script>
var myPseudo = "<?php echo htmlspecialchars($pseudo); ?>";
function address(e,n){var t=document.getElementById("message"),o=t.value;t.value="[b][couleur="+n+"]"+e+" ->[/couleur][/b] "+o,t.focus(),t.selectionStart=t.value.length}
$(function() {
        function e(fromMe) {
            var e = $("#minichat").html();
            $("#minichat").load("minichat_ajax.php", function() {
                !fromMe && ($("#minichat").html() != e) && (n || (document.title = "Nouveaux messages !"))
            })
        }
        var n = !0,
            t = document.title;
        $(window).focus(function() {
            n = !0, document.title = t
        }), $(window).blur(function() {
            n = !1
        }), e(true), $("#envoyer").click(function() {
            var n = $("#message").val();
            $.post("minichat_post.php", {
                message: n
            }, function() {
                $("#message").val(""), $("#message").focus(), e(true)
            })
        }), document.addEventListener("keypress", function(n) {
            if (10 == n.keyCode) {
                var t = $("#message").val();
                $.post("minichat_post.php", {
                    message: t
                }, function() {
                    $("#message").val(""), $("#message").focus(), e(true)
                });
            }
        }, !1), setInterval(e, 2e3)
    }), $(function() {
        function fonline() {
            $("#online").html(), $("#online").load("minichat_online.php")
        }
        setInterval(fonline, 5e3)
    }), $("#button_online").on("click", function(e) {
        e.preventDefault();
        var n = $("#online");
        n.show(), $("body").scrollTop(n.offset().top - 100)
    });</script>
<?php
include("./includes/fin.php");
?>
