<?php
if ($id!=0) { ?> <script src="/actualbar.js"></script> <?php }
echo'<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
  <header class="mdl-layout__header">
    <div class="mdl-layout__header-row">
      <span class="mdl-layout-title">Planète Toad</span>
      <div class="mdl-layout-spacer"></div>
      <nav class="mdl-navigation" id="bardefil">';
if ($lvl>1) {
echo'<li style="float:right;"><a class="mdl-navigation__link" href="/deconnexion.html" title="Se déconnecter" style="color:white;line-height:38px;"><img src="/images/croix-suppr.png" alt="Se déconnecter" title="Se déconnecter" width="16" height="16"/></a></li>
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
} else { // Pour les invités
echo'<li style="float:right;"><a class="mdl-navigation__link" href="/inscription.html" title="S\'inscrire sur Planète Toad" style="color:white;line-height:38px;">Inscription</a></li>
<li style="float:right;"><a class="mdl-navigation__link" href="/connexion.html" title="Se connecter sur Planète Toad" style="color:white;line-height:38px;">Connexion</a></li>';
}
        echo'</nav>
    </div>
  </header>
  <div class="mdl-layout__drawer">
    <span class="mdl-layout-title">Planète Toad</span>
    <nav class="mdl-navigation">
      <a class="mdl-navigation__link" href="/">Accueil</a>
      <a class="mdl-navigation__link" href="/forum.html">Forum</a>';
      if (isset($_SESSION['pseudo'])) { // Liens membres
      echo'<a class="mdl-navigation__link" href="/membres.html">Membres</a>
      <a class="mdl-navigation__link" href="/chat.html">Chat</a>
      <a class="mdl-navigation__link" href="/boutique.html">Boutique</a>
      <a class="mdl-navigation__link" href="/modifierprofil.html">Modifier mon profil</a>';
      }
    echo'<a class="mdl-navigation__link" href="/personnages.html">Personnages</a>
    <a class="mdl-navigation__link" href="/objets.html">Objets</a>
    <a class="mdl-navigation__link" href="/lieux.html">Lieux</a>
    <a class="mdl-navigation__link" href="/jeux.html">Jeux</a>
    <a class="mdl-navigation__link" href="/retrospectives.html">Rétrospectives</a>
    <a class="mdl-navigation__link" href="/musee-index.html">Musée de Toad</a>
    <a class="mdl-navigation__link" href="/tennindo.html">Tennindo</a>
    <a class="mdl-navigation__link" href="/livreor.html">Livre d\'or</a>
    </nav>
  </div>
<div class="corps">';