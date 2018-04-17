<?php
if ($id!=0) { ?> <script src="../actualbar.js" async></script> <?php }
echo'<header class="mdl-layout__header" id="bardefil">
    <div class="mdl-layout__header-row">
      <div class="mdl-layout--large-screen-only"><span class="mdl-layout-title">Planète Toad</span></div>
      <div class="mdl-layout--large-screen-only" id="barSearch" style="margin-left:25px;background:rgba(0,0,0,0.1);padding:5px;width:50%;border-radius:5px"><form>
      <i style="color:rgba(255,255,255,0.75);position:relative;top:5px;" class="material-icons md-24">search</i>
      <input style="background:transparent;border-color:transparent;width:93%;font-size:16px;" type="text" id="recherche_field" onkeyup="autocomplet()" autocomplete="off" placeholder="Recherche..." title="Recherche...">
      </form></div>
      <div class="mdl-layout-spacer"></div>
      <nav class="mdl-navigation">';
if ($lvl>1) {
    $query=$db->prepare('SELECT * FROM forum_membres WHERE membre_id= '.$id.'');
    $query->execute();
    $data = $query->fetch();
    $couleur = $data['membre_couleur'];
    $avatar = $data['membre_avatar'];

if ($data['membre_rang']==0) {
setcookie('id', '', time(), null, null, false);
setcookie('password', '', time(), null, null, false);
session_destroy();
}

echo'<span style="float:right;"><a class="mdl-navigation__link" href="/profil-'.$data['membre_id'].'.html"><img src="'.$data['membre_avatar'].'" alt="avamembre" class="avabarre" /></a></span>
<div class="mdl-layout--large-screen-only"><span style="float:right;"><a class="mdl-navigation__link" href="/profil-'.$data['membre_id'].'.html" style="line-height:38px;text-shadow:none;"><b><span style="color:'.$data['membre_couleur'].';">'.$data['membre_pseudo'].'</span></b></a></span></div>';

if ($id=="115") {
echo'<span style="float:right;"><a class="mdl-navigation__link" href="/modifierprofil.html" title="Modifier le profil" style="color:white;line-height:38px;"><i class="material-icons">&#xE8B8;</i></a></span>'; }
echo'<div id="Barr">';
    //MP
    $query=$db->prepare('SELECT COUNT(*) FROM mp_texte WHERE id_receveur = :id AND lu = :non');
    $query->bindValue(':id',$id,PDO::PARAM_INT);
    $query->bindValue(':non','0',PDO::PARAM_STR);
    $query->execute();
    $new_mp=$query->fetchColumn();
if ($new_mp==0) {
echo'<span style="float:right;"><a class="mdl-navigation__link" href="/mp.html" title="Messagerie Privée" style="color:white;line-height:38px;"><i class="material-icons md-18">&#xE0BE;</i></a></span>';
} else {
echo'<span style="float:right;"><a class="mdl-navigation__link" href="/mp.html" title="Messagerie Privée" style="color:cyan;line-height:38px;"><div class="material-icons md-18 mdl-badge mdl-badge--overlap" data-badge="'.$new_mp.'">&#xE0BE;</div></a></span>';
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
echo'<span style="float:right;"><a class="mdl-navigation__link" href="/amis.html" title="Amis" style="color:white;line-height:38px;"><i class="material-icons md-18">&#xE420;</i></a></span>';
} else {
echo'<span style="float:right;"><a class="mdl-navigation__link" href="/amis.html" title="Amis" style="color:cyan;line-height:38px;"><div class="material-icons md-18 mdl-badge mdl-badge--overlap" data-badge="'.$demande_ami.'">&#xE420;</div></a></span>';
}
  // Pour les notifs
  $searchNotifs=$db->prepare('SELECT COUNT(*) FROM notifs WHERE id_receveur = :id AND lu = :zero');
  $searchNotifs->bindValue(':id',$id,PDO::PARAM_INT);
  $searchNotifs->bindValue(':zero','0', PDO::PARAM_STR);
  $searchNotifs->execute();
  $new_notif=$searchNotifs->fetchColumn();

if ($new_notif==0) {
echo'<span style="float:right;"><a class="mdl-navigation__link" href="/notifs.html" title="Notifications" style="color:white;line-height:38px;"><i class="material-icons md-18">&#xE7F4;</i></a></span>';
} else {
echo'<span style="float:right;"><a class="mdl-navigation__link" href="/notifs.html" title="Notifications" style="color:cyan;line-height:38px;"><div class="material-icons md-18 mdl-badge mdl-badge--overlap" data-badge="'.$new_notif.'">&#xE7F4;</div></a></span>';
}
echo'</div>
<a class="mdl-navigation__link"  href="/deconnexion-'.md5($_COOKIE['PHPSESSID']).'.html" title="Se déconnecter" style="color:white;line-height:38px;"><i class="material-icons">close</i></a>';

} else { // Pour les invités
echo'<a class="boutonconnexion mdl-button mdl-js-button mdl-button--raised mdl-button--colored" href="/connexion.html" title="Se connecter sur Planète Toad" style="color:white;line-height:38px;">Connexion</a>&nbsp;&nbsp;
<a class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" style="background-color:#2bb92f;color:white;line-height:38px;" href="/inscription.html" title="S\'inscrire sur Planète Toad">Inscription</a>';
}
      echo'</nav>
    </div>
  </header>
  <div class="mdl-layout__drawer">
  <div style="line-height:64px;font-size:20px;"><div class="logoPT32"></div><span class="mdl-layout-title">Planète Toad</span></div>
    <nav class="mdl-navigation">
      <a class="mdl-navigation__link'; if (stripos($titre, 'magnifique univers de Toad') !== FALSE) { echo' pageActive'; } echo'" href="/"><i class="material-icons">home</i> Accueil</a>
      <a class="mdl-navigation__link'; if (stripos($titre, 'forum') !== FALSE) { echo' pageActive'; } echo'" href="/forum.html"><i class="material-icons">forum</i> Forum</a>';
      if (isset($_SESSION['pseudo'])) {
      echo'<a class="mdl-navigation__link'; if (stripos($titre, 'membres') !== FALSE) { echo' pageActive'; } echo'" href="/membres.html"><i class="material-icons">people</i> Membres</a>
      <a class="mdl-navigation__link'; if (stripos($titre, 'Chat') !== FALSE) { echo' pageActive'; } echo'" href="/chat.html"><i class="material-icons">chat</i> Chat</a>
      <a class="mdl-navigation__link'; if (stripos($titre, 'boutique') !== FALSE) { echo' pageActive'; } echo'" href="/boutique.html"><i class="material-icons">shop</i> Boutique</a>
      <a class="mdl-navigation__link'; if (stripos($titre, 'Modification de votre profil') !== FALSE) { echo' pageActive'; } echo'" href="/modifierprofil.html"><i class="material-icons">settings</i> Modifier mon profil</a>';
      }
    echo'<a class="mdl-navigation__link" style="font-weight:bold;cursor:pointer;" aria-expanded="false" id="TLink1" onclick="toggle(\'navbar\', \'TLink1\')"><i class="material-icons">library_books</i> Encyclopédie</a>
    <div style="display:none;" id="navbar"><a class="mdl-navigation__link" href="/personnages.html">Personnages</a>
    <a class="mdl-navigation__link" href="/objets.html">Objets</a>
    <a class="mdl-navigation__link" href="/lieux.html">Lieux</a>
    <a class="mdl-navigation__link" href="/jeux.html">Jeux</a>
    <a class="mdl-navigation__link" href="/retrospectives.html">Rétrospectives</a></div>
    <a class="mdl-navigation__link" href="/musee-avatars.html"><i class="material-icons">insert_photo</i> Galerie d\'avatars</a>
    <a class="mdl-navigation__link" href="/musee-jeux.html"><i class="material-icons">casino</i> Salle d\'arcade</a>
    <a class="mdl-navigation__link'; if (stripos($titre, 'livre d\'or') !== FALSE) { echo' pageActive'; } echo'" href="/livreor.html"><i class="material-icons">bookmark</i> Livre d\'or</a>
	<a class="mdl-navigation__link" href="/changedesign.html"><i class="material-icons">wallpaper</i> Changer de thème</a>
	<a class="mdl-navigation__link" href="/pttv.html"><i class="material-icons">live_tv</i> Planète Toad TV - Super Mario Direct</a>
    </nav>
  </div><div id="recherche"></div><main class="mdl-layout__content"><div class="corps">';