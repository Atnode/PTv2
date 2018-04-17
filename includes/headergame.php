<?php
    $id_game = (int) $_GET['id'];
	//On récupère les infos du profil à voir
	$query=$db->prepare('SELECT * FROM jeux WHERE id='.$id_game.'');
	$query->execute();
	$data=$query->fetch();
	if ($query->rowCount()<1)
	{
    echo'<META http-equiv="refresh" content="0; URL=/erreur_404.html">';
	} else {
		//On affiche les infos du profil
		echo '</div>
		<div class="mdl-layout__headerprofil">
		<div class="profil-view" style="height:206px;overflow:hidden;padding:0;background-image: url('.$data['background'].')!important;background-position:center;opacity: 0.96;">
		<div class="profil-view-container">
		&nbsp;<span class="nameGame">'.stripslashes(htmlspecialchars($data['nom'])).'</span>&nbsp;

		</div></div>
		<div class="mdl-layout__tab-bar mdl-js-ripple-effect">
      <a href="game-'.$id_game.'-'.$data['nom_url'].'.html" ';
      if (isset($infosGame) AND $infosGame==1) { echo'class="mdl-layout__tab is-active" style="color:rgb(255,255,255,1)"'; } else { echo'class="mdl-layout__tab" style="color:rgba(255,255,255,0.77)"'; } echo'>INFOS</a>

      <a href="test-game-'.$id_game.'-'.$data['nom_url'].'.html" '; 
      if (isset($testGame) AND $testGame==1) { echo'class="mdl-layout__tab is-active" style="color:rgb(255,255,255,1)"'; } else { echo'class="mdl-layout__tab" style="color:rgba(255,255,255,0.77)"'; } echo'>TEST</a>

      <a href="astuces-game-'.$id_game.'-'.$data['nom_url'].'.html" '; 
      if (isset($astucesGame) AND $astucesGame==1) { echo'class="mdl-layout__tab is-active" style="color:rgb(255,255,255,1)"'; } else { echo'class="mdl-layout__tab" style="color:rgba(255,255,255,0.77)"'; } echo'>ASTUCES</a>

      <a href="avis-game-'.$id_game.'-'.$data['nom_url'].'.html" '; 
      if (isset($avisGame) AND $avisGame==1) { echo'class="mdl-layout__tab is-active" style="color:rgb(255,255,255,1)"'; } else { echo'class="mdl-layout__tab" style="color:rgba(255,255,255,0.77)"'; } echo'>AVIS</a>
    </div>
    </div>';
}