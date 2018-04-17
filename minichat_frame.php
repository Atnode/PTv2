<div style="background-color: white;" >

<?php
$balises = true;
include("./includes/identifiants.php");

if (isset($_COOKIE['id']) && isset($_COOKIE['password']) && empty($id)) {
$_SESSION['id'] = $_COOKIE['id'];
$_SESSION['password'] = $_COOKIE['password'];
        $query = $db->prepare('SELECT * FROM forum_membres WHERE membre_id = :id');
        $query->bindValue(':id',$_COOKIE['id'],PDO::PARAM_INT);
        $query->execute();
        $data = $query->fetch();
if ($data['membre_mdp'] == $_COOKIE['password']) // Acces OK !
{
        $_SESSION['pseudo'] = $data['membre_pseudo'];
        $_SESSION['level'] = $data['membre_rang'];
        $_SESSION['id'] = $data['membre_id'];
        $_SESSION['password'] = $data['membre_mdp'];


}
        else {
            setcookie('id', '', time(), null, null, false);
            setcookie('password', '', time(), null, null, false);
            session_destroy();
            header('Location: ' . $_SERVER['HTTP_REFERER'] . '');
            $fakeCookie == 1;
        }
}
//Attribution des variables de session
$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

if ($_SESSION['level']<2) header('Location: erreur_403.html'); 
include("./includes/bbcodechat.php");

//echo'<h1>Minichat</h1>';
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
<div id="minichat">';
if ($lvl==0) {
  if (isset ($_COOKIE['id']) && isset($_COOKIE['password']))
  {
    setcookie('id', '', time(), null, null, false);
    setcookie('password', '', time(), null, null, false);
  }
  session_destroy();
}

    $query=$db->prepare('SELECT * FROM forum_membres WHERE membre_id= '.$id.'');
    $query->execute();
  if ($query->rowCount()<1) {
  if (isset ($_COOKIE['id']) && isset($_COOKIE['password']))
  {
    setcookie('id', '', time(), null, null, false);
    setcookie('password', '', time(), null, null, false);
  }
  session_destroy();
  }

  $req = $db->prepare('SELECT * FROM forum_chat LEFT JOIN forum_membres ON membre_id = posteur_id ORDER BY id DESC LIMIT 0,30');
  $req->execute();
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
                var o = document.querySelector("#demo-snackbar-example"),
                    a = {
                        message: "Message envoyé.",
                        timeout: 2e3
                    };
                o.MaterialSnackbar.showSnackbar(a)
            }
        }, !1), setInterval(e, 2e3)
    }),
    function() {
        "use strict";
        var e = document.querySelector("#demo-snackbar-example"),
            n = document.querySelector("#envoyer");
        n.addEventListener("click", function() {
            n.style.backgroundColor = "#" + Math.floor(16777215 * Math.random()).toString(16);
            var t = {
                message: "Message envoyé.",
                timeout: 2e3
            };
            e.MaterialSnackbar.showSnackbar(t)
        })
    }();</script>
</div>