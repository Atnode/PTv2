<?php
session_start();
$titre = "Planète Toad &bull; Equipe";
$descript = "L'équipe de Planète Toad est composée de membres bénévoles qui contribuent à l'avancement du site.";
include("includes/identifiants.php");
include("includes/debut.php");
include("includes/menu.php");
echo '<div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> <a href="./equipe.html">Equipe</a></div><br>';
echo'<h1>Equipe</h1>
<p style="text-align:center;">L\'équipe de Planète Toad est composée de membres bénévoles qui contribuent à l\'avancement du site. En cas de problème, n\'hésitez pas à contacter les webmasters.</p><hr><br>';
echo'<h2>Webmasters</h2><br>
<p style="text-align:center;font-style:italic;">Les webmasters sont ceux qui gèrent le site, ils se chargent de son organisation globale et gèrent l\'équipe du site.</p><br><br>';
$query = $db->prepare('SELECT * FROM forum_membres WHERE rang = "Webmaster"');
$query->execute();
while ($data1 = $query->fetch()) {
   echo'<table class="equipemembre" style="width:88%;margin-left:auto;margin-right:auto;"><tr><br><td><img src="'.$data1['membre_avatar'].'" alt="Membre avatar" title="Membre avatar" style="border-radius:50%;" /></td><td><b>Pseudo :</b> <a href="/profil-'.$data1['membre_id'].'.html" style="color:'.$data1['membre_couleur'].';">'.$data1['membre_pseudo'].'</a><br><br>
   <b>Rôle :</b> '.$data1['rang'].'</td>
   </tr></table><br><br>';
}
//
echo'<hr><h2>Administrateurs</h2><br>
<p style="text-align:center;font-style:italic;">Les Administrateurs sont chargés d\'assister les Webmasters. Entres autres, ils gèrent le site et développent de nouvelles fonctionnalités</p><br><br>';
$query = $db->prepare('SELECT * FROM forum_membres WHERE rang = "Administrateur"');
$query->execute();
while ($data1 = $query->fetch()) {
   echo'<table class="equipemembre" style="width:88%;margin-left:auto;margin-right:auto;"><tr><br><td><img src="'.$data1['membre_avatar'].'" alt="Membre avatar" title="Membre avatar" style="border-radius:50%;" /></td><td><b>Pseudo :</b> <a href="/profil-'.$data1['membre_id'].'.html" style="color:'.$data1['membre_couleur'].';">'.$data1['membre_pseudo'].'</a><br><br>
   <b>Rôle :</b> '.$data1['rang'].'</td>
   </tr></table><br><br>';
}
//
echo'<hr><h2>Modérateurs</h2><br>
<p style="text-align:center;font-style:italic;">Les modérateurs veillent à ce que chaque membre respecte le règlement du site, sinon ils sanctionnent.</p><br><br>';
$query = $db->prepare('SELECT * FROM forum_membres WHERE rang = "Modérateur"');
$query->execute();
while ($data1 = $query->fetch()) {
   echo'<table class="equipemembre" style="width:88%;margin-left:auto;margin-right:auto;"><tr><br><td><img src="'.$data1['membre_avatar'].'" alt="Membre avatar" title="Membre avatar" style="border-radius:50%;" /></td><td><b>Pseudo :</b> <a href="/profil-'.$data1['membre_id'].'.html" style="color:'.$data1['membre_couleur'].';">'.$data1['membre_pseudo'].'</a><br><br>
   <b>Rôle :</b> '.$data1['rang'].'</td>
   </tr></table><br><br>';
}

//
echo'<hr><h2>Rédacteurs</h2><br>
<p style="text-align:center;font-style:italic;">Les rédacteurs rédigent et valident les news, les fiches de l\'encyclopédie, le Tennindo...</p><br><br>';
$query = $db->prepare('SELECT * FROM forum_membres WHERE rang = "Rédacteur"');
$query->execute();
while ($data1 = $query->fetch()) {
   echo'<table class="equipemembre" style="width:88%;margin-left:auto;margin-right:auto;"><tr><br><td><img src="'.$data1['membre_avatar'].'" alt="Membre avatar" title="Membre avatar" style="border-radius:50%;" /></td><td><b>Pseudo :</b> <a href="/profil-'.$data1['membre_id'].'.html" style="color:'.$data1['membre_couleur'].';">'.$data1['membre_pseudo'].'</a><br><br>
   <b>Rôle :</b> '.$data1['rang'].'</td>
   </tr></table><br><br>';
}
//
echo'<hr><h2>Animateurs</h2><br>
<p style="text-align:center;font-style:italic;">Les animateurs organisent des animations pour le site et l\'animent par le biais de concours/tournois en différents genres..</p><br><br>';
$query = $db->prepare('SELECT * FROM forum_membres WHERE rang = "Animateur"');
$query->execute();
while ($data1 = $query->fetch()) {
   echo'<table class="equipemembre" style="width:88%;margin-left:auto;margin-right:auto;"><tr><br><td><img src="'.$data1['membre_avatar'].'" alt="Membre avatar" title="Membre avatar" style="border-radius:50%;" /></td><td><b>Pseudo :</b> <a href="/profil-'.$data1['membre_id'].'.html" style="color:'.$data1['membre_couleur'].';">'.$data1['membre_pseudo'].'</a><br><br>
   <b>Rôle :</b> '.$data1['rang'].'</td>
   </tr></table><br><br>';
}
//
echo'<hr><h2>Développeurs</h2><br>
<p style="text-align:center;font-style:italic;">Les développeurs s\'occupent de la partie code du site. Ce sont eux qui le rendent stable et y ajoutent de nouvelles fonctions.</p><br><br>';
$query = $db->prepare('SELECT * FROM forum_membres WHERE rang = "Développeur"');
$query->execute();
while ($data1 = $query->fetch()) {
   echo'<table class="equipemembre" style="width:88%;margin-left:auto;margin-right:auto;"><tr><br><td><img src="'.$data1['membre_avatar'].'" alt="Membre avatar" title="Membre avatar" style="border-radius:50%;" /></td><td><b>Pseudo :</b> <a href="/profil-'.$data1['membre_id'].'.html" style="color:'.$data1['membre_couleur'].';">'.$data1['membre_pseudo'].'</a><br><br>
   <b>Rôle :</b> '.$data1['rang'].'</td>
   </tr></table><br><br>';
}
//
echo'<br>';
include("includes/fin.php");
?>