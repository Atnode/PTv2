<?php
session_start();

$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';
include("./includes/identifiants.php");
include("./includes/bbcode.php");
include("./includes/functions.php");
    $id_conv = ($_GET['id']); //On récupère la valeur de l'id

    $query = $db->prepare('SELECT * FROM mp_texte
    LEFT JOIN forum_membres ON forum_membres.membre_id = mp_texte.id_expediteur
    LEFT JOIN mp_conversations ON mp_conversations.id = mp_texte.id_conversation
    WHERE id_conversation = :id_conv');
    $query->bindValue(':id_conv',$id_conv,PDO::PARAM_INT);
    $query->execute();
    while ($data=$query->fetch(PDO::FETCH_NAMED)) {

    // Attention ! Seul le receveur du mp peut le lire !
    if ($data['id_createur'] == $id OR $data['id_guest'] == $id ) { 

if(is_array($data['id'])) {
$data['id'] = current(array_filter($data['id']));
}

// Vérif pour voir si c'est déjà suppr
$verifSuppr = $db->prepare('SELECT * FROM mp_deleted WHERE id_membre = '.$id.' AND id_mp = '.$data['id'].'');
$verifSuppr->execute() or die(print_r($verifSuppr->errorInfo()));
if ($verifSuppr->rowCount()<1) {


if ($data['id_expediteur']==$id) {
echo'<div class="mp-me"><div style="float:right;"><a href="/profil-'.$data['membre_id'].'.html"><span style="color:'.stripslashes(htmlspecialchars($data['membre_couleur'])).';"><img style="max-width:65px;max-height:65px;border-radius:50%;" src="'.$data['membre_avatar'].'" alt="Avatar" /></a></div>
<div class="content-mpme">
<p style="color:#4E4E4E;font-style:italic;">';
$m = date('n',$data['time']);

echo 'Le '.date('d',$data['time']) .' ' . getMinMonth($m) .' '. date('Y',$data['time']) .' à '. date('H:i:s',$data['time']) .'
&nbsp; <a href="/action/delete-mp.php?id='.$data['id'].'&token='.md5($_COOKIE['PHPSESSID']).'"><i class="material-icons md-18" style="color:red;">close</i></a></p><br>
<p>'.code(nl2br(stripslashes(htmlspecialchars($data['texte'])))).'</p>
</div></div><div class="clearboth"></div><br><br><br><br>';
} elseif ($data['id_receveur']==$id) {
echo'<div class="mp-other"><div style="float:left;"><a href="/profil-'.$data['membre_id'].'.html"><span style="color:'.stripslashes(htmlspecialchars($data['membre_couleur'])).';"><img style="max-width:65px;max-height:65px;border-radius:50%;" src="'.$data['membre_avatar'].'" alt="Avatar" /></a></div>
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
        }
} // Fin du while
?>