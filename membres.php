<?php
session_start();
$titre="Planète Toad &bull; Membres";
$descrip = "Cette page contient la liste de tous les membres inscrits sur Planète Toad";
include("includes/identifiants.php");
include("includes/debut.php");
include("includes/menu.php");
echo '<div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> <a href="./membres.html">Membres</a></div><br />';
echo'<h1>Membres</h1>';
//A partir d'ici, on va compter le nombre de members
$query=$db->query('SELECT COUNT(*) AS nbr FROM forum_membres');
$data = $query->fetch();

$total = $data['nbr'];
$MembreParPage = 30;
$NombreDePages = ceil($total / $MembreParPage);

//Nombre de pages

$page = (isset($_GET['page']))?intval($_GET['page']):1;

//On affiche les pages 1-2-3, etc.
echo '<ul class="pagination modal-4">';

$pagePrev = $page - 1;
$pageNext = $page + 1;
if ($page != "1") { echo'<li><a href="membres-'.$pagePrev.'.html" class="prev"><i class="material-icons md-18">keyboard_arrow_left</i> Précédent</a></li>'; } // Page précédente si on est pas sur la first
for ($i = 1 ; $i <= $NombreDePages ; $i++)
{
    if ($i == $page) //On ne met pas de lien sur la page actuelle
    {
        echo '<li><a href="membres-'.$i.'.html" class="active">'.$i.'</a></li>';
    }
    else
    {
        echo '<li><a href="membres-'.$i.'.html">'.$i.'</a></li>';
    }
}
if ($page != $NombreDePages) { echo'<li><a href="membres-'.$pageNext.'.html" class="next">Suivante <i class="material-icons md-18">keyboard_arrow_right</i></a></li>'; } // Page après si on é pas sur la last

echo'</ul>';

$premier = ($page - 1) * $MembreParPage;
//Tri

$convert_order = array('membre_derniere_visite', 'membre_inscrit', 'membre_pseudo', 'membre_post', 'membre_champi', 'champi_total'); 
$convert_tri = array('DESC', 'ASC');
//On récupère la valeur de s
if (isset ($_POST['s'])) $sort = $convert_order[$_POST['s']];
else $sort = $convert_order[0];
//On récupère la valeur de t
if (isset ($_POST['t'])) $tri = $convert_tri[$_POST['t']];
else $tri = $convert_tri[0];

?>
<form action="membres.html" method="post">
<div class="bulleinfos">
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
    <label class="mdl-button mdl-js-button mdl-button--icon" for="sample6">
      <i class="material-icons">search</i>
    </label>
    <div class="mdl-textfield__expandable-holder">
      <input class="mdl-textfield__input" type="text" name="user_search" placeholder="Rechercher un pseudo..." id="sample6">
      <label class="mdl-textfield__label" for="sample-expandable">Expandable Input</label>
    </div>
  </div>&nbsp;
<span for="s">Trier par : </span>

<select name="s" id="s">
<option value="0">Dernière visite</option>
<option value="1">Inscription</option>
<option value="2">Pseudo</option>
<option value="3">Messages</option>
<option value="4">Champis</option>
<option value="5">Activité</option>
</select>

<select name="t" id="t">
<option value="0">Décroissant</option>
<option value="1">Croissant</option>
</select>
<input class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit" value="Envoyer" /></div><hr>
</form>
<?php
//Requête
if (empty($_POST['user_search'])) {
$query = $db->prepare('SELECT * FROM forum_membres ORDER BY '. $sort .' '. $tri .', membre_derniere_visite '. $tri .' LIMIT :premier, :membreparpage');
} else {
$user_search = $_POST['user_search'];
$query = $db->prepare("SELECT * FROM forum_membres WHERE membre_pseudo LIKE '%".$user_search."%' ORDER BY ". $sort ." ". $tri .", membre_derniere_visite ". $tri ." LIMIT :premier, :membreparpage");
}
$query->bindValue(':premier',$premier,PDO::PARAM_INT);
$query->bindValue(':membreparpage',$MembreParPage, PDO::PARAM_INT);
$query->execute() or die(print_r($query->errorInfo()));
$time_max = time() - (60 * 10);
if ($query->rowCount()>0)
{
?>
       <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp"><thead>
       <tr>
	     <th style="width:5%;" class="dieze">#</th>
	     <th style="width:6%;" class="mdl-data-table__cell--non-numeric">Avatar</th>
       <th style="width:5%;" class="mdl-data-table__cell--non-numeric">Pseudo</th>
       <th style="width:8%;" class="topics">Topics</th>
       <th style="width:8%;" class="posts">Messages</th>
       <th style="width:8%;" class="champis">Champis</th>
       <th style="width:8%;" class="amis">Amis</th>
       <th style="width:20%;" class="mdl-data-table__cell--non-numeric">Inscription</th>
       <th style="width:20%;" class="mdl-data-table__cell--non-numeric">Dernière visite</th>
       <th style="width:12%;"><strong>Statut</strong></th>   
       </tr></thead>
       <?php
	   $Number = ($page - 1) * 30 + 1;
       //On lance la boucle
       while ($data = $query->fetch())
       {
// Compter les topics
$countTopic = $db->prepare('SELECT COUNT(*) FROM forum_topic WHERE topic_createur = :membre');
$countTopic->bindValue(':membre',$data['membre_id'],PDO::PARAM_INT);
$countTopic->execute();
$topicM=$countTopic->fetchColumn();  
// Compter les amis
$countAmis = $db->prepare('SELECT COUNT(*) FROM forum_amis WHERE ami_from = :membre AND ami_confirm = :confirm OR ami_to = :membre AND ami_confirm = :confirm');
$countAmis->bindValue(':membre',$data['membre_id'],PDO::PARAM_INT);
$countAmis->bindValue(':confirm','1', PDO::PARAM_STR);
$countAmis->execute();
$amisM=$countAmis->fetchColumn();
   
           echo '<tr style="border:1px dashed grey;">
		   <td>'.$Number.'</td>
		   <td class="mdl-data-table__cell--non-numeric"><img src="'.stripslashes(htmlspecialchars($data['membre_avatar'])).'" alt="avatar" style="max-width:50px; max-height:50px; border-radius:50%;" /></td>
		   <td class="mdl-data-table__cell--non-numeric">
        <a href="./profil-'.$data['membre_id'].'.html" style="color:'.$data['membre_couleur'].'">
        '.stripslashes(htmlspecialchars($data['membre_pseudo'])).'</a></td>
        <td>'.$topicM.'</td>
        <td>'.$data['membre_post'].'</td>
        <td>'.$data['membre_champi'].'</td>
        <td>'.$amisM.'</td>';
        if (date('d/m/Y',$data['membre_inscrit'])==date('d/m/Y',time())) { echo'<td class="mdl-data-table__cell--non-numeric">Aujourd\'hui à '.date('H:i',$data['membre_inscrit']).'</td>'; }
        elseif (date('d/m/Y',$data['membre_inscrit'])==date('d/m/Y',strtotime("yesterday"))) { echo'<td class="mdl-data-table__cell--non-numeric">Hier à '.date('H:i',$data['membre_inscrit']).'</td>'; } else {
        $m = date('n',$data["membre_inscrit"]);
        echo '<td class="mdl-data-table__cell--non-numeric">'.date('d',$data["membre_inscrit"]) .' ' . getMinMonth($m) .' '. date('Y',$data["membre_inscrit"]) .' à '. date('H:i',$data["membre_inscrit"]) .'</td>'; }
        if (date('d/m/Y',$data['membre_derniere_visite'])==date('d/m/Y',time())) { echo'<td class="mdl-data-table__cell--non-numeric">Aujourd\'hui à '.date('H:i',$data['membre_derniere_visite']).'</td>'; } 
        elseif (date('d/m/Y',$data['membre_derniere_visite'])==date('d/m/Y',strtotime("yesterday"))) { echo'<td class="mdl-data-table__cell--non-numeric">Hier à '.date('H:i',$data['membre_derniere_visite']).'</td>'; } else {
        $m = date('n',$data["membre_derniere_visite"]);
        echo '<td class="mdl-data-table__cell--non-numeric">'.date('d',$data["membre_derniere_visite"]) .' ' . getMinMonth($m) .' '. date('Y',$data["membre_derniere_visite"]) .' à '. date('H:i',$data["membre_derniere_visite"]) .'</td>'; }
        if ($data['membre_derniere_visite']<$time_max)
        {
         echo '<td><b><span style="color:red;">[Hors Ligne]</span></b></td>'; }
         else { echo '<td><b><span style="color:green;">[En Ligne]</span></b></td>'; }
         echo '</tr>';
	     $Number++;
       }
       ?>
       </table>
       <?php
}
else //S'il n'y a pas de membre
{
    echo'<p>Aucun membre ne correspond à votre recherche.</p>';
}
include("includes/fin.php");
?>