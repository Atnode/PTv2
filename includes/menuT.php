<?php
if ($id!=0) { ?> <script src="/actualbar.js"></script> <?php }
echo'<nav>
<div class="headerbar">
<ul id="bardefil">

<li style="margin-top:-6px;"><img src="/images/logo_bleu.png" alt="Logo site Planète Toad" width="56" height="56" /></li>
<li><a href="/" title="Accueil" style="color:white;line-height:38px;">Accueil</a></li>
<li><a href="/forum.html" title="Forum" style="color:white;line-height:38px;">Forum</a></li>';
if (isset($_SESSION['pseudo'])) {
echo'
<li><a href="#" title="Communauté" style="color:white;line-height:38px;">Communauté ▽</a>
<ul>
<li style="width:150px;margin-top:0px;"><a href="/membres.html" title="Membres" style="color:white;line-height:38px;">Membres</a></li>
<li style="width:150px;margin-top:0px;"><a href="/chat.html" title="Chat" style="color:white;line-height:38px;">Chat</a></li>
<li style="width:150px;margin-top:0px;"><a href="/boutique.html" title="Boutique" style="color:white;line-height:38px;">Boutique</a></li>
<li style="width:150px;margin-top:0px;"><a href="/modifierprofil.html" title="Modifier mon profil" style="color:white;line-height:38px;">Modifier profil</a></li>
</ul>
</li>';
} echo'
<li><a href="#" title="Encyclopédie" style="color:white;line-height:38px;">Encyclopédie ▽</a>
<ul>
<li style="width:140px;margin-top:0px;"><a href="/personnages.html" title="Personnages" style="color:white;line-height:38px;">Personnages</a></li>
<li style="width:140px;margin-top:0px;"><a href="/objets.html" title="Objets" style="color:white;line-height:38px;">Objets</a></li>
<li style="width:140px;margin-top:0px;"><a href="/lieux.html" title="Lieux" style="color:white;line-height:38px;">Lieux</a></li>
<li style="width:140px;margin-top:0px;"><a href="/jeux.html" title="Jeux" style="color:white;line-height:38px;">Jeux</a></li>
<li style="width:140px;margin-top:0px;"><a href="/retrospectives.html" title="Rétrospectives" style="color:white;line-height:38px;">Rétrospectives</a></li>
</ul>
</li>
<li><a href="/musee-index.html" title="Musée de Toad" style="color:white;line-height:38px;">Musée Toad</a></li>
<li><a href="/tennindo.html" title="Tennindo" style="color:white;line-height:38px;">Tennindo</a></li>
<li><a href="/livreor.html" title="Livre d\'or" style="color:white;line-height:38px;">Livre d\'or</a></li>';
if ($lvl>1) {
echo'<li style="float:right;"><a href="/deconnexion.html" title="Se déconnecter" style="color:white;line-height:38px;"><img src="/images/croix-suppr.png" alt="Se déconnecter" title="Se déconnecter" width="16" height="16"/></a></li>
<div id="Barr">';
  // Pour les notifs
  $searchNotifs=$db->prepare('SELECT COUNT(*) FROM notifs WHERE id_receveur = :id AND lu = :zero');
  $searchNotifs->bindValue(':id',$id,PDO::PARAM_INT);
  $searchNotifs->bindValue(':zero','0', PDO::PARAM_STR);
  $searchNotifs->execute();
  $new_notif=$searchNotifs->fetchColumn();

if ($new_notif==0) {
echo'<li style="float:right;"><a class="mdl-navigation__link" href="/notifs.html" title="Notifications" style="color:white;line-height:38px;"><i class="material-icons md-18">notifications</i></a></li>';
} else {
echo'<li style="float:right;"><a class="mdl-navigation__link" href="/notifs.html" title="Notifications" style="color:cyan;line-height:38px;"><i class="material-icons md-18">notifications</i> ('.$new_notif.')</a></li>';
}
    //Amis
    $query=$db->prepare('SELECT COUNT(*) FROM forum_amis
    WHERE ami_to = :id AND ami_confirm = :conf');
    $query->bindValue(':id',$id,PDO::PARAM_INT);
    $query->bindValue(':conf','0', PDO::PARAM_STR);
    $query->execute();
    $demande_ami=$query->fetchColumn();
     $conf = ':conf';
if ($demande_ami==0) {
echo'<li style="float:right;"><a class="mdl-navigation__link" href="/amis.html" title="Amis" style="color:white;line-height:38px;"><i class="material-icons md-18">tag_faces</i></a></li>';
} else {
echo'<li style="float:right;"><a class="mdl-navigation__link" href="/amis.html" title="Amis" style="color:cyan;line-height:38px;"><div class="material-icons md-18 mdl-badge mdl-badge--overlap" data-badge="'.$demande_ami.'">email</div></a></li>';
}
    //MP
    $query=$db->prepare('SELECT COUNT(*) FROM forum_mp WHERE mp_receveur = :id AND mp_lu = :non');
    $query->bindValue(':id',$id,PDO::PARAM_INT);
    $query->bindValue(':non','0',PDO::PARAM_STR);
    $query->execute();
     $new_mp=$query->fetchColumn();
     $mp_nlu = ':non';
if ($new_mp==0) {
echo'<li style="float:right;"><a class="mdl-navigation__link" href="/mp.html" title="Messagerie Privée" style="color:white;line-height:38px;"><i class="material-icons md-18">email</i></a></li>';
} else {
echo'<li style="float:right;"><a class="mdl-navigation__link" href="/mp.html" title="Messagerie Privée" style="color:cyan;line-height:38px;"><div class="material-icons md-18 mdl-badge mdl-badge--overlap" data-badge="'.$new_mp.'">email</div></a></li>';
}
echo'</div>';
    $query=$db->prepare('SELECT * FROM forum_membres WHERE membre_id= '.$id.'');
    $query->execute();
    $data = $query->fetch();
    $couleur = $data['membre_couleur'];
    $avatar = $data['membre_avatar'];
    $lvl = $data['membre_rang'];
echo'<li style="float:right;"><a href="/profil-'.$data['membre_id'].'.html" style="line-height:38px;text-shadow:none;"><b><span style="color:'.$data['membre_couleur'].';">'.$data['membre_pseudo'].'</span></b></a></li>
<li style="float:right;"><img src="'.$data['membre_avatar'].'" alt="avamembre" class="avabarre" /></li>';

} else { // Pour les invités
echo'<li style="float:right;"><a href="/inscription.html" title="S\'inscrire sur Planète Toad" style="color:white;line-height:38px;">Inscription</a></li>
<li style="float:right;"><a href="/connexion.html" title="Se connecter sur Planète Toad" style="color:white;line-height:38px;">Connexion</a></li>';
} ?>
</ul>
</div>
</nav>
<div class="corps">
