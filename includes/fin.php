<?php
$membreBirthday = "";

if ($lvl>1) { //ACtu page récente
$query=$db->prepare('UPDATE forum_membres SET membre_pageactuelle = '.$titre.'  WHERE membre_id = :id');
$query->bindValue(':id',$id,PDO::PARAM_INT);
$query->execute();
}
echo'<br><div id="stats">
<h3 style="background-color:#19af5d;">Statistiques <i class="floatright material-icons">info_outline</i></h3><br>';
//On compte les membres 
$TotalDesMembres = $db->prepare('SELECT COUNT(membre_id) FROM forum_membres');
$TotalDesMembres->execute();
$TotalMembres=$TotalDesMembres->fetchColumn();
$TotalDesMembres->closeCursor();

$query = $db->prepare('SELECT membre_pseudo, membre_id, membre_couleur FROM forum_membres ORDER BY membre_id DESC LIMIT 0, 1');
$query->execute();
$data = $query->fetch();
$derniermembre = stripslashes(htmlspecialchars($data['membre_pseudo']));
$query->closeCursor();
//On compte les messages
$CountMessages = $db->prepare('SELECT COUNT(post_id) FROM forum_post');
$CountMessages->execute();
$TotalM=$CountMessages->fetchColumn();
$CountMessages->closeCursor();
//Idem les topics
$CountTopics = $db->prepare('SELECT COUNT(topic_id) FROM forum_topic');
$CountTopics->execute();
$TotalT=$CountTopics->fetchColumn();
$CountTopics->closeCursor();
//Idem les publis
$CountPublis = $db->prepare('SELECT COUNT(id) FROM publications');
$CountPublis->execute();
$TotalP=$CountPublis->fetchColumn();
$CountPublis->closeCursor();
//Idem les commentaires des news
$CountComms = $db->prepare('SELECT COUNT(id) FROM commentaires');
$CountComms->execute();
$TotalC=$CountComms->fetchColumn();
$CountComms->closeCursor();
//Idem les commentaires des tenninews
$CountCommst = $db->prepare('SELECT COUNT(id) FROM commentairest');
$CountCommst->execute();
$TotalCT=$CountComms->fetchColumn();
$CountCommst->closeCursor();
//Idem les news
$CountNews = $db->prepare('SELECT COUNT(id) FROM news');
$CountNews->execute();
$TotalN=$CountNews->fetchColumn();
$CountNews->closeCursor();
//Idem les tenninews
$CountTenn = $db->prepare('SELECT COUNT(id) FROM tennindo');
$CountTenn->execute();
$TotalTenn=$CountNews->fetchColumn();
$CountTenn->closeCursor();
//Idem les publis_com
$CountPCom = $db->prepare('SELECT COUNT(id) FROM publis_com');
$CountPCom->execute();
$TotalPubliCom=$CountPCom->fetchColumn();
$CountPCom->closeCursor();

$CountIOnline = $db->prepare('SELECT COUNT(id) FROM online');
$CountIOnline->execute();
$TotalIOnline=$CountIOnline->fetchColumn();
$CountIOnline->closeCursor();

$TotalMC = $TotalM + $TotalC + $TotalCT + $TotalPubliCom;
$TotalTN = $TotalT + $TotalN + $TotalTenn;

echo'La communauté est composée de <span class="darkgreen"><strong>'.$TotalMembres.'</strong></span> membres qui ont posté <span class="darkgreen"><strong>'.$TotalMC.'</strong></span> messages et commentaires répartis dans <span class="darkgreen"><strong>'.$TotalTN.'</strong></span> sujets et news.<br />
Le dernier membre qui a rejoint la communauté est <a href="./profil-'.$data['membre_id'].'.html" title="Le dernier membre inscrit" style="color:'.$data['membre_couleur'].'">'.$derniermembre.'</a>.
<br><span class="darkgreen"><strong>'.$TotalP.'</strong></span> publications ont été publiées sur le site.';

//Décompte des membres
$texte_a_mettre = "";
$time_max = time() - (60 * 10);
$MembresOnlineReq=$db->prepare('SELECT membre_id, membre_pseudo, membre_couleur FROM forum_membres WHERE membre_derniere_visite > :timemax AND membre_id <> 0 ORDER BY membre_pseudo');
$MembresOnlineReq->bindValue(':timemax',$time_max, PDO::PARAM_INT);
$MembresOnlineReq->execute();
$texte_a_mettre = substr($texte_a_mettre, 0, -1);
$count_membres= $TotalIOnline;
$count_membre_co = 0;
while ($data = $MembresOnlineReq->fetch())
{
	$count_membres ++;
	$count_membre_co ++;
	$texte_a_mettre .= '<a href="./profil-'.$data['membre_id'].'.html" title="'.$data['membre_pseudo'].'" style="color:'.$data['membre_couleur'].'">
	'.stripslashes(htmlspecialchars($data['membre_pseudo'])).'</a>,';
}

$texte_a_mettre = substr($texte_a_mettre, 0, -1);
if ($count_membres<2)
{
echo '<br><p>Il y a <span class="darkgreen"><strong>'.$count_membres.'</strong></span> utilisateur en ligne dont <span class="darkgreen"><strong>'.$count_membre_co.'</strong></span> membre : ';
echo $texte_a_mettre.'</p>';
} else {
echo '<br><p>Il y a <span class="darkgreen"><strong>'.$count_membres.'</strong></span> utilisateurs en ligne dont <span class="darkgreen"><strong>'.$count_membre_co.'</strong></span> membres : ';
echo $texte_a_mettre.'</p>';
}
$MembresOnlineReq->closeCursor();

// Anniversaire
$birthday = $db->prepare('SELECT * FROM forum_membres WHERE DATE_FORMAT(birthday, "%m-%d") = DATE_FORMAT(NOW(), "%m-%d")');
$birthday->execute();
$NothingBirthday=0;
if ($birthday->rowCount()<1) { $NothingBirthday++; } else {
while ($birthday1 = $birthday->fetch()) {
 $age = $birthday1['birthday'];
 $date = date_parse($age);
 $annee = $date['year'];
 $affichPseudo = '<a href="./profil-'.$birthday1['membre_id'].'.html" style="color:'.$birthday1['membre_couleur'].'">
	'.stripslashes(htmlspecialchars($birthday1['membre_pseudo'])).'</a>';
 if (substr($age, 0, 3)!="0000") { $year = ' ('.age($birthday1['birthday']).')'; } else {$year = '';}
 $membreBirthday .= $affichPseudo . $year . ',';
}
}

//Anniversaires
if ($NothingBirthday==0) {
$membreBirthday = substr($membreBirthday, 0, -1);
echo'<hr>Anniversaire(s) du jour : '.$membreBirthday.' <br>'; }
$birthday->closeCursor();
?>
<br></div><br></div>
<footer class="mdl-mega-footer">
  <div class="mdl-mega-footer__middle-section">

    <div class="mdl-mega-footer__drop-down-section">
      <h4 class="mdl-mega-footer__heading">RÉSEAUX SOCIAUX</h4>
      <div class="mdl-mega-footer__link-list">
<a href="https://www.facebook.com/planete.toad/" title="Page Facebook du site" target="_blank" class="facebook"></a>
<a href="https://twitter.com/planetetoad" title="Page Twitter du site" target="_blank" class="twitter"></a>
<a href="https://www.youtube.com/channel/UCRql8l00_wv2t1p9tqOnCiw" target="_blank" title="Chaine Youtube du site" class="youtube"></a>
<a href="https://www.dubtrack.fm/join/club-de-planete-toad" title="Salle Dubtrack.fm du site" target="_blank" class="dubtrack"></a>
      </div>
    </div>

    <div class="mdl-mega-footer__drop-down-section">
      <h4 class="mdl-mega-footer__heading">NOS PARTENAIRES</h4>
      <div class="mdl-mega-footer__link-list">
<a href="http://smbxcity.forumactif.org/" rel="nofollow" title="SMBX City" target="_blank"><img src="../images/partenaires/SMBXCITY.png" alt="SMBX City Site partneiare" title="SMBX City site partenaire" width="88" height="31" /></a>
<a href="http://timsiteweb.free.fr/mkpc/index.php" rel="nofollow" title="Mario Kart PC" target="_blank"><img src="../images/partenaires/mkpc.png" alt="Mario Kart PC Site Partenaire" title="Mario Kart PC site partenaire" width="88" height="31" /></a>
<a href="http://www.vanilladome.fr/" rel="nofollow" title="Vanilla Dome" target="_blank"><img src="../images/partenaires/vdpartenaire.png" alt="Vanilla Dome" title="Vanilla Dome" width="88" height="31" /></a>
<a href="https://pokekalos.fr/" rel="nofollow" title="PokeKalos" target="_blank"><img src="../images/partenaires/pokekalos.png" alt="Pokekalos" title="Vanilla Dome" width="88" height="31" /></a><br>
<p class="footerText">&copy; Planète Toad 2014-<?php echo date('Y') ?>. Site crée et codé entièrement par Champoad et Toaddle.<br> Toute reproduction partielle ou complète est strictement interdite.<br>Hébergement fourni par <a href="http://outout.xyz">@outout</a> <3</p>
      </div>
    </div>

    <div class="mdl-mega-footer__drop-down-section">
      <div class="mdl-mega-footer__link-list">
<?php 
// Admin
if ($lvl>4) {
echo'<a href="/admin/index.php" style="color:white;">Administration</a><br>';
}
// Modos
if ($lvl>3) {
echo'<a href="/modo/index.php" style="color:white;">Modération</a><br>';
}
//Rédacteurs
if ($lvl>=3) {
	$redacReq = $db->prepare('SELECT * FROM news WHERE valide <> 1');
	$redacReq->execute();
	$newsValidate = $redacReq->rowCount();
	$redacReq->closeCursor();
echo'<a href="/liste_news.php" style="color:white;">Rédaction ';
if ($newsValidate!="0") { echo'<span style="color:cyan;">('.$newsValidate.' à valider)</span></a><br>'; } else {
echo'('.$newsValidate.' à valider)</a><br>'; } // NEWS A VALIDER
} 
//Qui est en ligne détaillé
if ($lvl>3) {
echo'<a href="/quiestenligne.php" style="color:white;">Qui est en ligne détaillé</a><br>';
}
?>
<p><a href="./equipe.html" style="color:white;font-weight:normal;" title="Equipe du site">EQUIPE</a>&nbsp; - &nbsp;
<a href="./topic-1-1.html" style="color:white;font-weight:normal;" title="Charte du site">CHARTE</a>&nbsp; - &nbsp;
<a href="./contact.html" style="color:white;font-weight:normal;" title="Contacter le site">CONTACT</a><br>
<a href="./apropos.html" style="color:white;font-weight:normal;" title="A propos de P.T">A PROPOS</a>&nbsp; - &nbsp;
<a href="./devenir-partenaire.html" style="color:white;font-weight:normal;" title="Devenir partenaire">DEVENIR PARTENAIRE</a></p><br>
      </div>
    </div>
  </div>

</footer>
<?php
$balises=(isset($balises))?$balises:0;
if($balises) {
?>
<script src="/js/bbcode.js" async defer></script>
<?php
} ?>
<a href="#" title="Haut de page" class="scrollup"><i class="fa fa-arrow-up"></i></a>
<script src="/js/material.min.js" async defer></script>
</main></div></body>
</html>
