<?php
session_start();
	$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';
	$Chat = 1;
	$balises = true;
	if ($_SESSION['level']<2) {
	if (isset ($_COOKIE['id']) && isset($_COOKIE['password']))
	{
		setcookie('id', '', time(), null, null, false);
		setcookie('password', '', time(), null, null, false);
	}
	session_destroy();
	header('Location: erreur_403.html'); 
	}
	include("./includes/identifiants.php");
	include("./includes/bbcodechat.php");
	include("./includes/functions.php");

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
    $data = $query->fetch();
    $couleur = $data['membre_couleur'];
    $pseudo = $data['membre_pseudo'];

$BannisChat = $db->query('SELECT id FROM bannis_chat WHERE id = '. $id .'');
if ($BannisChat->fetch() == false)
{
	$req = $db->query('SELECT * FROM forum_chat LEFT JOIN forum_membres ON membre_id = posteur_id ORDER BY id DESC LIMIT 0,14');
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
}
else {
        $query=$db->prepare('SELECT membre_id, membre_pseudo, membre_couleur, id_bannisseur FROM bannis_chat LEFT JOIN forum_membres ON membre_id = id_bannisseur');
        $query->execute();
        $data=$query->fetch();
echo'<p align=center><b>Vous avez été banni du chat par <span style="color:'.$data['membre_couleur'].';">'. $data['membre_pseudo'] .'</span>. Pour connaître la raison, contactez-le</p></b>
<META http-equiv="refresh" content="0; URL=/chat.html">';
}
?>