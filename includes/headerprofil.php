
<?php
	$membre = isset($_GET['m'])?(int) $_GET['m']:'';
	include("../experience.php");
	//On récupère les infos du profil à voir
	$query=$db->prepare('SELECT * FROM forum_membres WHERE membre_id=:membre');
	$query->bindValue(':membre',$membre, PDO::PARAM_INT);
	$query->execute();
	$data=$query->fetch();
	$time_max = time() - (60 * 10);
	if ($query->rowCount()<1)
	{
    echo'<META http-equiv="refresh" content="0; URL=/erreur_404.html">';
	} else {
         //POUR CALCULER L'XP     
         $rangReq = $db->prepare('SELECT * FROM rangs WHERE tchampi_min <= '.$data['champi_total'].' AND tchampi_max >='.$data['champi_total'].'');
         $rangReq->execute() or die(print_r($rangReq->errorInfo()));
         $rang = $rangReq->fetch();

         $calcul1 = $rang['tchampi_max'] - $rang['tchampi_min'];
         $calcul2 = $data['champi_total'] - $rang['tchampi_min'];
         $calcul3 = $calcul2 / $calcul1 * 100;
         
         if ($calcul3<10) { $experience = substr($calcul3, 0, 1); } else { $experience = substr($calcul3, 0, 2); }

         // COULEUR JAUGE
         	$choix_color = array('', '#1f671b', '#fba026', '#f37934', '#fac51c', '#9365b8', '#553982', '#00a885');
	if (isset ($data['article4_color']))
		$colorJ = $choix_color[$data['article4_color']];
	else
		$colorJ = $choix_color[0];
	echo'<style>.c100.orange .bar, .c100.orange .fill {
    border-color: '.$colorJ.'!important;</style>';

		//On affiche les infos du profil
		echo '</div>
		<div class="mdl-layout__headerprofil">
		<div style="height:200px;">';
		if ($data['banniere_champi']==1) {
		echo'<img src="images/banniere/banniere-champi.jpg" alt="Image de couverture" />
		<style>
.profil-view{background-color:#CB5050!important}
.mdl-layout__tab-bar{background-color:#ad0000!important}
		</style>';
		} else {
        echo'<img src="images/banniere/banniere-defaut.jpg" alt="Image de couverture" />';
		}
		echo'</div>

		<div class="profil-view">
		<div class="profil-view-container">

         <div class="c100 p'.$experience.' orange">
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                    <img src="'.$data['membre_avatar'].'" alt="avatar" style="width:150px;height:150px; border-radius: 50%;margin:14px 25px 37px 15px;" />
                </div>
		&nbsp;<span style="font-weight:bold;color:'.$data['membre_couleur'].';">'.stripslashes(htmlspecialchars($data['membre_pseudo'])).'</span>&nbsp;';
			if ($data['membre_derniere_visite']>$time_max) {
				echo '<span style="color:#1ff11f;font-size:22px;" title="Connecté">•</span><br>';
			} else {
				echo '<span style="color:red;font-size:22px;" title="Non connecté">•</span><br>';
			}

        if ($id!=0 AND $id != $membre) {
	     $AmisYou = $db->prepare('SELECT * FROM forum_amis WHERE (ami_from = '.$id.' AND ami_to = '.$membre.') OR (ami_from = '.$membre.' AND ami_to = '.$id.')');
	     $AmisYou->execute();
	     if ($AmisYou->rowCount()>0){
	     $amisM = $AmisYou->fetch();
	     if ($amisM['ami_confirm']==1) { echo'<a href="./envoi-mp-dest'.$membre.'.html" class="buyButton" style="margin-left:auto;display:inline-table;font-size:12px;">Envoyer un MP</a>'; } else { echo'<div class="butButton" style="color:grey;margin-left:auto;display:inline-table;font-size:12px;">Demande en attente...</div>'; }
	     } else {
           echo'<a href="./add-ami.php?add='.$membre.'" class="buyButton" style="color:#00ff00!important;border-color:#00ff00!important;margin-left:auto;display:inline-table;font-size:12px;">Ajouter en ami</a>';
	     }
        } elseif ($id==$membre) {
           echo'<a href="./modifierprofil.html" class="buyButton" style="margin-left:auto;display:inline-table;font-size:12px;">Modifier mon profil</a>';
        }
		echo'</div></div>
		<div class="mdl-layout__tab-bar mdl-js-ripple-effect">
      <a href="profil-'.$membre.'.html" ';
      if (isset($profil) AND $profil==1) { echo'class="mdl-layout__tab is-active" style="color:rgba(255,255,255,1)"'; } else { echo'class="mdl-layout__tab" style="color:rgba(255,255,255,0.77)"'; } echo'>Mur</a>

      <a href="profil-amis-'.$membre.'.html" '; 
      if (isset($amis) AND $amis==1) { echo'class="mdl-layout__tab is-active" style="color:rgba(255,255,255,1)"'; } else { echo'class="mdl-layout__tab" style="color:rgba(255,255,255,0.77)"'; } echo'>Amis</a>

      <a href="profil-badges-'.$membre.'.html" '; 
      if (isset($badge) AND $badge==1) { echo'class="mdl-layout__tab is-active" style="color:rgba(255,255,255,1)"'; } else { echo'class="mdl-layout__tab" style="color:rgba(255,255,255,0.77)"'; } echo'>Badges</a>

      <a href="profil-collection-'.$membre.'.html" '; 
      if (isset($collection) AND $collection==1) { echo'class="mdl-layout__tab is-active" style="color:rgba(255,255,255,1)"'; } else { echo'class="mdl-layout__tab" style="color:rgba(255,255,255,0.77)"'; } echo'>Collection</a>

      <a href="profil-topics-'.$membre.'.html" '; 
      if (isset($topicsMembre) AND $topicsMembre==1) { echo'class="mdl-layout__tab is-active" style="color:rgba(255,255,255,1)"'; } else { echo'class="mdl-layout__tab" style="color:rgba(255,255,255,0.77)"'; } echo'>Topics</a>
    </div>
    </div>';
}