<?php
session_start();
	$membre = isset($_GET['m'])?(int) $_GET['m']:'';
	$profil = 1;
	$balises = true;
	include("includes/identifiants.php");
	$reponse = $db->query('SELECT membre_pseudo FROM forum_membres WHERE membre_id=' . $membre . '');
	$donnees = $reponse->fetch();
	$titre =  'Planète Toad &bull; Profil de ' . $donnees['membre_pseudo'] . '';
	$descrip = 'Consulter le profil, les statistiques, le nombre d\'amis, ses publication du membre '.$donnees['membre_pseudo'].' sur le site Planète Toad';
	include("includes/debut.php");
	include("includes/menu.php");
	include("includes/bbcode.php");
	include("includes/headerprofil.php");
  ?>
  <script type="text/javascript">
//$(function(){function e(){var e="<?php echo $membre; ?>";$("#publimembre").load("murAjax.php?id="+e)}e(),$("#envoyer").click(function(){var p=$("#publier").val(),i="<?php echo $membre; ?>";return $.post("postok.php?action=publier&id="+i,{publier:p},function(){$("#publier").val(""),$("#publier").focus(),e()}),!1}),document.addEventListener("keypress",function(p){if(10==p.keyCode){var i="<?php echo $membre; ?>",r=$("#publier").val();return $.post("postok.php?action=publier&id="+i,{publier:r},function(){$("#publier").val(""),$("#publier").focus(),e()})}},!1)});
      $(function(){
        var membreID = "<?php echo $membre; ?>";  
        var j = 20,
          $infinite = $('.infiniteScroll'),
          $body = $('body'),
          timer

        $body.append('<div id="loader"><img src="/champi.png" alt="loader ajax"></div>');

        load_next();

        $(window).scroll(function() {
          $body.removeClass('publiContent');
          clearTimeout(timer);
          timer = setTimeout(function(){
            if ( j < 700 ) {
              load_next();
            }
            else {
              $('.loader').remove();
            }
          },100);
        });

        function load_next() {
          if($(window).scrollTop() + 75 >= $(document).height() - $(window).height()) {
            $body.addClass('publiContent');
            $.ajax({
              url: "/murAjaxMore.php?id="+membreID+"&offsetID="+j+"",
              success: function(html) {
                if(html) {
                  j+= 20;
                  $infinite.append(html);
                }
              }
            });
          }
        }
      });
      var winCached = $(window),
  docCached = $(document)

var currLeng = 0;

function addContent() {
  dettachScrollEvent();
  setTimeout(function() { //this timeout simulates the delay from the ajax post
    for (var i = currLeng; i < currLeng + 100; i++)
      $('div').append(i + '<br />');
    currLeng = i;
    console.log("called loader!");
    attachScrollEvent();
  }, 500);

}

function infiNLoader() {
  if (winCached.scrollTop() + winCached.height() > docCached.height() - 300) {
    addContent();
    //alert("near bottom! Adding more dummy content for infinite scrolling");
  }
}

function attachScrollEvent() {

  winCached.scroll(infiNLoader);
}

function dettachScrollEvent() {
  winCached.unbind('scroll', infiNLoader);
}
addContent();
</script><div></div>
<?php

	//On récupère les infos du profil à voir
	$query=$db->prepare('SELECT * FROM forum_membres WHERE membre_id=:membre');
	$query->bindValue(':membre',$membre, PDO::PARAM_INT);
	$query->execute();
	$data=$query->fetch();
	if ($query->rowCount()<1)
	{
		echo '<p>Ce membre n\'existe pas.</p>';
	} else {
		echo '<div class="corps" style="margin-top:-12.999px;"><br><h1>Profil de '.stripslashes(htmlspecialchars($data['membre_pseudo'])).'</h1>';
		if ($data['description']!=NULL) {echo '<br><div style="text-align:center;"><i>“'.$data['description'].'”</i></div><br><br>';}

		//Infos			
         $rangReq = $db->prepare('SELECT * FROM rangs WHERE tchampi_min <= '.$data['champi_total'].' AND tchampi_max >='.$data['champi_total'].'');
         $rangReq->execute();
         $rang = $rangReq->fetch();
         //Détails sur le membre qui a posté
         echo'<div class="infop"><div style="font-size:18px;border-bottom:1px dashed grey;">INFORMATIONS<br></div><br><img src="'.$rang['name'].'" alt="Rang du membre" width="220" height="30" /><br><br><div style="float:left;">';

			$age = $data['birthday'];
			$date = date_parse($age);
			$jour = $date['day'];
			$mois = $date['month'];
			$annee = $date['year'];
			if ($age!="0000-00-00") {
			echo '<p><strong>Âge : </strong>'; if (substr($age, 0, 3)!="0000") { echo''.age($age).' ans'; } echo' (né le '.$jour.' '.getMonth($mois).''; if (substr($age, 0, 3)!="0000") { echo' '.$annee.''; } echo')</p>'; }
			echo '<p><strong>Inscription : </strong>Le '.date('d/m/Y à H:i',$data['membre_inscrit']).'</p>
			<p><strong>Dernière visite : </strong>Le '.date('d/m/Y à H:i',$data['membre_derniere_visite']).'</p>';
			if ($data['membre_post']<2) {
				echo '<p><strong>Message :</strong> '.$data['membre_post'].'</p>';
			} else {
			echo '<p><strong>Messages :</strong> '.$data['membre_post'].'</p>'; }
			echo '<p><b>Fiche(s) :</b> '.$data['membre_fiches'].'</p></div><div style="float:right;">
			<p><b>Champis :</b> '.$data['membre_champi'].' <img src="/champi.png" alt="Champi"></p>
			<p><strong>Code-Ami 3DS :</strong> '.$data['ca_3ds'].'</p>
			<p><strong>Identifiant Nintendo Network :</strong> <a href="https://miiverse.nintendo.net/users/'.$data['nintendo_network'].'">'.$data['nintendo_network'].'</a></p>
			<p><strong>Étoiles Tournois :</strong> '.$data['points_JV'].' <img src="/images/etoilestournois.png" alt="Etoiles Tournois"></p>
			<p><strong>Avertissement(s) :</strong> '.$data['avertissement'].'</p></div><br><br><div class="clearboth"></div>';
			if ($id!=0 AND $membre!=$id) { 
				echo '&nbsp; <a href="./don-champi-'.$membre.'.html" style="font-size:11px;" title="Faire un don"><br>[Faire un don]</a>';
			}
		echo '</div>';

//Publications
echo '</p><h2>Mur de '.$donnees['membre_pseudo'].'</h2><br>'; // On affiche les publis
       $amiMembre=$db->prepare('SELECT * FROM forum_membres LEFT JOIN forum_amis ON membre_id = ami_from OR membre_id = ami_to WHERE (ami_from = :membre AND ami_confirm = :confirm AND ami_to = :id) OR (ami_to = :membre AND ami_from = :id AND ami_confirm = :confirm)'); // On vérifie si le membre qui consulte est ami avec le profil.
       $amiMembre->bindValue(':membre',$membre, PDO::PARAM_INT);
       $amiMembre->bindValue(':id',$id, PDO::PARAM_INT);
       $amiMembre->bindValue(':confirm','1', PDO::PARAM_STR);
       $amiMembre->execute() or die(print_r($amiMembre->errorInfo()));
 if ($amiMembre->rowCount()>0 OR $id == $membre)
 {
// include"code.php";
echo '<form method="post" action="#" name="formulaire">
<div class="commentaires" style="padding:20px;"><table>
		<tbody>
			<tr>
				<td style="width:80px;">
					<img src="'.$avatar.'" alt="avatar" width="80" height="80" style="border-radius:50%;margin-top:5px;" />
				</td>
     <td><textarea name="publier" rows="6" cols="60" id="publier" placeholder="Publier un p\'tit message..."></textarea><br>
     <input type="submit" name="submit" id="envoyer" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" value="Envoyer" /></td></tr></tbody></table></div></form><br><hr /><br>';
 }
 echo'<div class="publimembre infiniteScroll">';
       $query=$db->prepare('SELECT * FROM publications LEFT JOIN forum_membres ON forum_membres.membre_id = publications.id_receveur WHERE id_receveur = :membre ORDER BY timestamp DESC LIMIT 20 OFFSET 0'); // On sélectionne les publications
       $query->bindValue(':membre',$membre, PDO::PARAM_INT);
       $query->execute();
 if ($query->rowCount()>0)
 {
   echo'<div class="publiContent">';
   $publiNumber = 1;
     while ($dataP=$query->fetch()) {
$publi = $dataP['id'];
    $CountComms=$db->prepare('SELECT COUNT(*) FROM publis_com WHERE id_publi = '.$publi.''); // On sélectionne les publications
    $CountComms->execute();
    $NbrComm=$CountComms->fetchColumn();

if ($dataP['id_posteur'] == $dataP['id_receveur']) { // Si le membre poste sur son profil
    echo '<div class="commentaires" id="'.$publiNumber.'" style="padding:20px;"><table>
    <tbody>
      <tr>
        <td style="width:80px;">
          <img src="'.$dataP['membre_avatar'].'" alt="avatar" width="80" height="80" style="border-radius:50%;margin-top:5px;" />
        </td>';

      if ($dataP['officielle']==0) {
        echo'<td style="width:98%; text-align:left;padding-left:15px;"><span style="font-size:14px;"><p style="color:#888;">
        <a href="/profil-'.$dataP['membre_id'].'.html" style="color:'.$dataP['membre_couleur'].';">'.$dataP['membre_pseudo'].'</a> a publié sur son mur</p><a href="/publi-'.$publi.'.html" style="color:#a0a0a0;"><i class="material-icons" style="font-size:14px;">av_timer</i>
          le '.date('d/m/Y à H\hi', $dataP['timestamp']).'</a></span>
          <p>'.code(stripslashes(htmlspecialchars($dataP['message']))).'</p>';
        if ($dataP['id_posteur'] == $id OR $lvl>3) { 
          echo '&nbsp;&nbsp; <a href="./postok.php?action=suppr_publi&amp;id='.$publi.'" style="color:red;float:right;background:#f1c5c5;" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">SUPPRIMER</a>';
        }
        echo '<a href="/publi-'.$publi.'.html" style="color:darkblue;float:right;background:#c3fcff;" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">['.$NbrComm.'] COMMENTAIRE(S)</a></td>';
      } else { // Si c'est OFFICIEL
        echo'<td style="width:98%; text-align:left;padding-left:15px;"><span style="font-size:14px;"><p style="color:#888;">'.code(stripslashes(htmlspecialchars($dataP['message']))).'</p><p style="color:#a0a0a0;"><i class="material-icons" style="font-size:14px;">av_timer</i>
          le '.date('d/m/Y à H\hi', $dataP['timestamp']).'</p></span>&nbsp;';
        if ($lvl>3) {
          echo '&nbsp; <a href="./postok.php?action=suppr_publi&amp;id='.$publi.'" style="color:red;float:right;background:#f1c5c5;" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">SUPPRIMER</a>';
        }
      }
      echo'</tr>
    </tbody>
  </table></div>';
} else { //Sil publie sur un autre profil
     $receveur=$db->prepare('SELECT * FROM publications LEFT JOIN forum_membres ON forum_membres.membre_id = publications.id_posteur WHERE id = :id AND officielle = 0'); // On sélectionne les publications
     $receveur->bindValue(':id',$publi, PDO::PARAM_INT);
     $receveur->execute();
     $post=$receveur->fetch();

     echo '<div class="commentaires" id="'.$publiNumber.'" style="padding:20px;"><table><tbody><tr>
   <td style="width:80px;"><img src="'.$post['membre_avatar'].'" alt="avatar" width="80" height="80" style="border-radius:50%;margin-top:5px;" /></td>
     <td style="width:98%;text-align:left;padding-left:15px;"><span style="font-size:14px;"><p style="color:#888;">
     <a href="/profil-'.$post['membre_id'].'.html" style="color:'.$post['membre_couleur'].';">'.$post['membre_pseudo'].'</a> a publié sur le mur de <a href="/profil-'.$dataP['membre_id'].'.html" style="color:'.$dataP['membre_couleur'].';">'.$dataP['membre_pseudo'].'</a></p>
      <a href="/publi-'.$publi.'.html" style="color:#a0a0a0;"><i class="material-icons" style="font-size:14px;">av_timer</i> le '.date('d/m/Y à H\hi', $post['timestamp']).'</a></span>
      <p>'.code(stripslashes(htmlspecialchars($dataP['message']))).'</p>';
        if ($dataP['id_posteur'] == $id OR $lvl>3) { 
          echo '&nbsp;&nbsp; <a href="./postok.php?action=suppr_publi&amp;id='.$publi.'" style="color:red;float:right;background:#f1c5c5;" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">SUPPRIMER</a>';
        }
        echo '<a href="/publi-'.$publi.'.html" style="color:darkblue;float:right;background:#c3fcff;" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">['.$NbrComm.'] COMMENTAIRE(S)</a></td></tr></tbody>
   </table></div>';
       }
    $publiNumber++;
   }
   echo'</div>';
} else { echo 'Rien de récent !'; }
    }
?> </div>
<style>#publiContent .hidden{display:none}#publiContent #loader{display:none}</style>
<?php
include("includes/fin.php");
?>