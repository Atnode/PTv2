<?php

session_start();

$balises = true;

$titre = "Planète Toad &bull; Découvrez le magnifique univers de Toad";

$descrip = "Une communauté active pour partager et découvrir de nombreuses choses sur l'univers de Toad. Inscrivez-vous pour profiter de nombreux avantages";

$canonical = "http://www.planete-toad.fr/";

$og_img = "http://www.planete-toad.fr/images/LOGOPT3100.png";

include("includes/identifiants.php");

include("includes/bbcode.php");

include("includes/debut.php");

include("includes/menu.php");

?>

<div class="mdl-layout--large-screen-only">

<link rel="stylesheet" type="text/css" href="slider/style.css" />

<?php

if ((isset($_COOKIE['design']) && $_COOKIE['design']==0)) {

	echo'<link rel="stylesheet" type="text/css" href="slider/style.css" />';

}

if ((isset($_COOKIE['design']) && $_COOKIE['design']==1)) {

	echo'<link rel="stylesheet" type="text/css" href="slider/styleRouge.css" />';

}

if ((isset($_COOKIE['design']) && $_COOKIE['design']==4)) {

	echo'<link rel="stylesheet" type="text/css" href="slider/styleGris.css" />';

} ?><div id="wowslider-container1">

<div class="ws_images"><ul>

		<li><a href="/news-2780-le-jeu-de-l-anneesur-planete-toad-est.html"><img src="/images/sliders/jeu-de-lannee.png" alt="Vous avez élu le jeu de l'année et c'est..." title="Vous avez élu le jeu de l'année et c'est..." id="wows1_1"/></a></li>

        <li><a href="/game-32-super-mario-odyssey.html"><img src="/images/sliders/super-mario-odyssey-sortie.jpg" alt="Super Mario Odyssey est sorti le 27 octobre !" title="Super Mario Odyssey est sorti le 27 octobre !" id="wows1_0"/></a></li>

		<li><a href="/news-2724--wrestlemarioune-nouvelle-animation-va-voir-le-jour.html"><img src="/images/sliders/WrestleMario.jpg" alt="Découvrez Wrestle Mario, la nouvelle animation de Planète Toad." title="Découvrez Wrestle Mario, la nouvelle animation de Planète Toad." id="wows1_2"/></a></li>


	</ul></div>

	<div class="ws_bullets"><div>

    <a href="#" title="Vous avez élu le jeu de l'année et c'est..."><span>1</span></a>

    <a href="#" title="Super Mario Odyssey est sorti le 27 octobre !"><span>2</span></a>

    <a href="#" title="Découvrez Wrestle Mario, la nouvelle animation de Planète Toad !"><span>3</span></a>

	</div></div>

<div class="ws_shadow"></div>

</div>	

<script type="text/javascript" src="//js.planete-toad.fr/slider/wowslider.js" async defer></script>

</div>

<?php if ($lvl==7) { ?>

<!--<script>

$(document).ready(function(){

  //

  (function(e){

    e.fn.countdown = function (t, n){

      function i(){

        eventDate = Date.parse(r.date) / 1e3;

        currentDate = Math.floor(e.now() / 1e3);

        //

        if(eventDate <= currentDate){

          n.call(this);

          clearInterval(interval)

        }

        //

        seconds = eventDate - currentDate;

        days = Math.floor(seconds / 86400);

        seconds -= days * 60 * 60 * 24;

        hours = Math.floor(seconds / 3600);

        seconds -= hours * 60 * 60;

        minutes = Math.floor(seconds / 60);

        seconds -= minutes * 60;

        //

        days == 1 ? thisEl.find(".timeRefDays").text("JOURS") : thisEl.find(".timeRefDays").text("JOURS");

        hours == 1 ? thisEl.find(".timeRefHours").text("HEURES") : thisEl.find(".timeRefHours").text("HEURES");

        minutes == 1 ? thisEl.find(".timeRefMinutes").text("MINUTES") : thisEl.find(".timeRefMinutes").text("MINUTES");

        seconds == 1 ? thisEl.find(".timeRefSeconds").text("SECONDES") : thisEl.find(".timeRefSeconds").text("SECONDES");

        //

        if(r["format"] == "on"){

          days = String(days).length >= 2 ? days : "0" + days;

          hours = String(hours).length >= 2 ? hours : "0" + hours;

          minutes = String(minutes).length >= 2 ? minutes : "0" + minutes;

          seconds = String(seconds).length >= 2 ? seconds : "0" + seconds

        }

        //

        if(!isNaN(eventDate)){

          thisEl.find(".days").text(days);

          thisEl.find(".hours").text(hours);

          thisEl.find(".minutes").text(minutes);

          thisEl.find(".seconds").text(seconds)

        }

        else{

          errorMessage = "Invalid date. Example: 27 March 2015 17:00:00";

          alert(errorMessage);

          console.log(errorMessage);

          clearInterval(interval)

        }

      }

      //

      var thisEl = e(this);

      var r = {

        date: null,

        format: null

      };

      //

      t && e.extend(r, t);

      i();

      interval = setInterval(i, 1e3)

    }

  })(jQuery);

  //

  $(document).ready(function(){

    function e(){

      var e = new Date;

      e.setDate(e.getDate() + 60);

      dd = e.getDate();

      mm = e.getMonth() + 1;

      y = e.getFullYear();

      futureFormattedDate = mm + "/" + dd + "/" + y;

      return futureFormattedDate

    }

    //

    $("#countdown").countdown({

      date: "04 March 2017 00:00:00", // change date/time here - do not change the format!

      format: "on"

    });

  });

});</script>

  <br><br><section>

  <div class="wrapper reboursSwitch"><div id="countdown"><br><br><br>

  SORTIE DE LA NINTENDO SWITCH DANS 

        <span class="numbers days">00</span>

        <span class="strings timeRefDays">Jours</span>

        <span class="numbers hours">00</span>

        <span class="strings timeRefHours">Heures</span>

        <span class="numbers minutes">00</span>

        <span class="strings timeRefMinutes">Minutes</span>

        <span class="numbers seconds">00</span>

        <span class="strings timeRefSeconds">Secondes</span>

    </div><!-- end div#countdown -->

   <!-- </div></section>-->

<?php } ?>



<br><h1>Planète Toad</h1><br>

<?php

// Requête sur les sondages

$query = $db->prepare('SELECT * FROM sondage');

$query->execute();

$sondage = $query->fetch();

echo'<div id="sondage">

<h3 style="background-color:#8f41af;"><i class="material-icons materialIndex">&#xE801;</i> Sondage</h3><br>';

if ($id!=0) {

$affiche = $db->prepare('SELECT * FROM sondage_vote WHERE id_membre = '.$id.'');

$affiche->execute();

if ($affiche->rowCount()<1) {

echo'<form method="post" action="sondage-vote.php" method="post" style="padding:5px;">

<b>'.$sondage['question'].'</b><br><br>

<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-1" style="width:auto;" for="'.$sondage['r1'].'"><input id="option-1" type="radio" class="mdl-radio__button" name="vote" value="1"><span class="mdl-radio__label">'.$sondage['r1'].'</span></label><br><br>

<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-2" style="width:auto;" for="'.$sondage['r2'].'"><input id="option-2" type="radio" class="mdl-radio__button" name="vote" value="2"><span class="mdl-radio__label">'.$sondage['r2'].'</span></label><br><br>';

if (!empty($sondage['r3'])) { echo'<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-3" style="width:auto;" for="'.$sondage['r3'].'"><input id="option-3" type="radio" class="mdl-radio__button" name="vote" value="3"><span class="mdl-radio__label">'.$sondage['r3'].'</span></label><br><br>'; }

if (!empty($sondage['r4'])) { echo'<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-4" style="width:auto;" for="'.$sondage['r4'].'"><input id="option-4" type="radio" class="mdl-radio__button" name="vote" value="4"><span class="mdl-radio__label">'.$sondage['r4'].'</span></label><br><br>'; }

if (!empty($sondage['r5'])) { echo'<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-5" style="width:auto;" for="'.$sondage['r5'].'"><input id="option-5" type="radio" class="mdl-radio__button" name="vote" value="5"><span class="mdl-radio__label">'.$sondage['r5'].'</span></label><br><br>'; }

if (!empty($sondage['r6'])) { echo'<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-6" style="width:auto;" for="'.$sondage['r6'].'"><input id="option-6" type="radio" class="mdl-radio__button" name="vote" value="6"><span class="mdl-radio__label">'.$sondage['r6'].'</span></label><br><br>'; }

echo'<input class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit" value="Voter" /></form>

<br><br></div>'; } else {

echo'<b>'.$sondage['question'].'</b><br><br>

<span>&bull; '.$sondage['r1'].'</span><br><br>

<span>&bull; '.$sondage['r2'].'</span><br><br>';

if (!empty($sondage['r3'])) { echo'<span>&bull; '.$sondage['r3'].'</span><br><br>'; }

if (!empty($sondage['r4'])) { echo'<span>&bull; '.$sondage['r4'].'</span><br><br>'; }

if (!empty($sondage['r5'])) { echo'<span>&bull; '.$sondage['r5'].'</span><br><br>'; }

echo'<u>Vous avez déjà voté. Vous pourrez revoter au prochain sondage.</u>

<br><br></div>';

} } else {

echo'<b>'.$sondage['question'].'</b><br><br>

<span>'.$sondage['r1'].'</span><br><br>

<span>'.$sondage['r2'].'</span><br><br>

<span>'.$sondage['r3'].'</span><br><br>

<span>'.$sondage['r4'].'</span><br><br>

<u>Vous devez vous <a href="/connexion.html">connecter</a> ou vous <a href="/inscription.html">inscrire</a> pour pouvoir participer au sondage.</u>

<br><br></div>';

}



// ACTU SITE

$query = $db->prepare('SELECT * FROM publications LEFT JOIN forum_membres ON forum_membres.membre_id = publications.id_receveur WHERE officielle = 1 ORDER BY timestamp DESC LIMIT 5');

$query->execute();

	echo'<div id="communaute">

<h3 style="background-color:#ea4c36;"><i class="material-icons materialIndex">people</i> Communauté</h3>';

while ($publiC = $query->fetch()) {

	$m = date('n',$publiC["timestamp"]);



	echo'<div class="commentaires">

   <div class="publindex1"><img src="'.$publiC['membre_avatar'].'" alt="Avatar du posteur" title="Avatar du posteur" style="border-radius:50%;" width="75" height="75" /></div>

   <div class="publindex2"><br>'.code(stripslashes(htmlspecialchars($publiC['message']))).'<br></div>

   <div class="clearboth"></div>

   <div style="color:grey;text-align:right;font-style:italic;margin-right:10px;">Envoyée le '.date('d',$publiC["timestamp"]) .' ' . getMinMonth($m) .' '. date('Y',$publiC["timestamp"]) .' à '. date('H:i',$publiC["timestamp"]) .'</div></div><br>';

}

echo'<br><br></div><br>'; ?>



<div class="clearboth"></div>



<h2>News</h2>

<div>

<?php

$retour = $db->prepare('SELECT * FROM news LEFT JOIN forum_membres ON membre_id = posteur_id WHERE valide = 1 AND icon <> 8 ORDER BY id DESC LIMIT 0, 6');

$retour->execute();

echo'<div class="tableNews">';

$NNews =0;

while ($donnees = $retour->fetch())

{

	$titreurl=nettoyage($donnees['titre']);

	$recente = time () - $donnees['timestamp'];

	$choix_icon = array('site', '3ds', 'wii-u', 'multi', 'eShop', 'miiverse', 'divers', 'NTXP', '', 'Switch', 'mobile');

	if (isset ($_POST['$donnees']))

		$sort = $choix_icon[$_POST['$donnees']];

	else

		$sort = $choix_icon[0];

	?>

	<div class="affichNews">

		<a href="/news-<?php echo $donnees['id']; ?>-<?php echo $titreurl; ?>.html"> 

		<?php if (!empty($donnees['image'])) {

			$dimensions = getimagesize($donnees['image']);

			echo'<img src="'.$donnees['image'].'" style="margin-left:auto;margin-right:auto;box-shadow:2px 1px 10px grey;" '.$dimensions[3].' title="'.$donnees['titre'].'" alt="'.$donnees['titre'].'" />';

		 } else {

        echo'<img src="./images/LOGOPT3100.png" style="margin-left:auto;margin-right:auto;box-shadow:2px 1px 10px grey;" width="100" height="100" title="'.$donnees['titre'].'" alt="'.$donnees['titre'].'" />';

			 } ?>



	</a><br><br><div class="news-<?php echo $image = $choix_icon[$donnees['icon']]; ?>"><?php echo $image = $choix_icon[$donnees['icon']]; ?></div><br>

	<?php $TotalDesCommentaires = $db->query('SELECT COUNT(*) FROM commentaires WHERE id_news = '.$donnees['id'].'')->fetchColumn(); // On compte le nombre de commentaires ici

	if ($TotalDesCommentaires>9) { // News HOT ?>

		<a href="/news-<?php echo $donnees['id']; ?>-<?php echo $titreurl; ?>.html" title="news" style="margin-left:3px;color:red"><b><?php echo $donnees['titre']; ?></b></a><br><br>

		<?php echo'<span style="font-weight:bold;color:red;"><i class="material-icons md-18">comment</i> '.$TotalDesCommentaires.'</span>';



	} else { //Fin news hot

		if ($recente<604800) {  ?>

		<a href="/news-<?php echo $donnees['id']; ?>-<?php echo $titreurl; ?>.html" title="news" style="margin-left:3px;color:darkgreen"><b><?php echo $donnees['titre']; ?></b></a><br><br>

		<?php } else { ?>

		<a href="/news-<?php echo $donnees['id']; ?>-<?php echo $titreurl; ?>.html" title="news" style="margin-left:3px;"><b><?php echo $donnees['titre']; ?></b></a><br>

		<?php }

		echo'<b><i class="material-icons md-18">comment</i> '.$TotalDesCommentaires.'</b>';

	}

	echo '</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

	$NNews++; if($NNews==3) { echo'</div><br><div class="tableNews">'; $NNews = 0; }

}

?>

<br><a href="/archives-news.html" title="Archives des news"><div class="archiveNews">Voir plus de news</div></a><br></div>

<?php if ($id!=0) {

echo'&nbsp;&nbsp;&nbsp;<a href="/rediger-news.php" style="background-color:#2597dd;margin-left:1%;" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored"><i class="material-icons md-18">&#xE255;</i> Publier une news</a>';

} ?>

</div><br>



<?php

$jeuxRsortis = $db->prepare('SELECT * FROM jeux ORDER BY sortie_ue DESC LIMIT 12');

$jeuxRsortis->execute(); ?>

<div class="top-jeux">

<h3 style="background-color:#d65400;"><i class="material-icons materialIndex">date_range</i> Jeux récemment sortis</h3>

<div style="width:100%;display:table;text-align:center;">

<?php while ($jeux=$jeuxRsortis->fetch()) {

echo'<div style="display:table-row;"><div style="display:table-cell;padding:15px;border-bottom:1px solid rgba(150, 150, 150, 0.28);"><div class="'.$jeux['console'].'">'.$jeux['console'].'</div></div>

<div style="display:table-cell;padding:15px;border-bottom:1px solid rgba(150, 150, 150, 0.28);"><a href="game-'.$jeux['id'].'-'.$jeux['nom_url'].'.html">'.$jeux['nom'].'</a></div>

<div style="display:table-cell;padding:15px;border-bottom:1px solid rgba(150, 150, 150, 0.28);"><i class="material-icons md-18">&#xE916;</i> &nbsp;';

$age = $jeux['sortie_ue'];

$date = date_parse($age);

$jour = $date['day'];

$mois = $date['month'];

$annee = $date['year'];

echo '<i>'.$jour.' '.getMinMonth($mois).' '.$annee.' </i></div></div>';

} ?> </div></div>



<div class="chronique">

<h3 style="background-color:#1b7fbb;"><i class="material-icons materialIndex">create</i> Chroniques</h3>

<?php

$retour = $db->prepare('SELECT * FROM news LEFT JOIN forum_membres ON membre_id = posteur_id WHERE valide = 1 AND icon = 8 ORDER BY id DESC LIMIT 0, 10 ');

$retour->execute();

echo'<div style="padding-left:4px;">';

while ($donnees = $retour->fetch())

{

$titreurl=nettoyage($donnees['titre']);

$recente = time () - $donnees['timestamp'];

echo'<br>'; ?>

<div style="border-bottom:1px solid rgba(150, 150, 150, 0.28);"><div class="news-chronique">Chronique</div>

<?php if ($recente<604800) {  ?>

<a href="/chronique-<?php echo $donnees['id']; ?>-<?php echo $titreurl; ?>.html" title="news" style="margin-left: 3px;color:darkgreen"><b><?php echo $donnees['titre']; ?></b></a>

<?php } else { ?>

<a href="/chronique-<?php echo $donnees['id']; ?>-<?php echo $titreurl; ?>.html" title="news" style="margin-left: 3px;"><b><?php echo $donnees['titre']; ?></b></a>

<?php } ?>

<div style="float:right;margin-right:5px;">

<?php $TotalDesCommentaires = $db->query('SELECT COUNT(*) FROM commentaires WHERE id_news = '.$donnees['id'].'')->fetchColumn(); // On compte le nombre de commentaires ici

echo'&nbsp; &nbsp; &nbsp; <b><i class="material-icons md-18">comment</i> '.$TotalDesCommentaires.'</b></div><br><br></div><br>';

}

?>

<a href="/archives-chroniques.html" title="Archives des chroniques" class="archives">Archives</a><br><br>

</div></div>

<div class="clearboth"></div><br>

<div id="last_publis">

<h3 style="background-color:#e97f0a;">Publications <i class="floatright material-icons">public</i></h3>

<?php if($id!=0) { echo'<form method="post" style="padding:5px;" action="postok.php?action=publier&amp;id='.$id.'" name="formulaire">

<div class="commentaires" style="padding:20px;"><table>

    <tbody>

      <tr>

        <td style="width:80px;">

          <img src="'.$avatar.'" alt="avatar" width="80" height="80" style="border-radius:50%;margin-top:5px;" />

        </td>';

     include("code.php");

     echo'<td><textarea name="publier" rows="6" cols="60" id="message" placeholder="Publier un p\'tit message..."></textarea><br>
     <input type="submit" name="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" value="Envoyer" /></form></td></tr></tbody></table></div><br>';

}

$query=$db->prepare('SELECT * FROM publications LEFT JOIN forum_membres ON forum_membres.membre_id = publications.id_receveur WHERE officielle <> 1 ORDER BY timestamp DESC LIMIT 5');

$query->execute();

    while ($data = $query->fetch()) {

$publi = $data['id'];

    $CountComms=$db->prepare('SELECT COUNT(*) FROM publis_com WHERE id_publi = '.$publi.''); // On sélectionne les publications

    $CountComms->execute();

    $NbrComm=$CountComms->fetchColumn();

if ($data['id_posteur'] == $data['id_receveur']) { // Si le membre poste sur son profil

    echo '<div class="commentaires" '; if(isset($data['article3_color'])) { echo'style="background-color:'.$data['article3_color'].';padding:20px;"'; } else{echo'padding:20px;';} echo'><table>

		<tbody>

			<tr>

				<td style="width:80px;">

					<img src="'.$data['membre_avatar'].'" alt="avatar" width="80" height="80" style="border-radius:50%;margin-top:5px;" />

				</td>';

        echo'<td style="width:98%; text-align:left;padding-left:15px;"><div style="font-size:14px;"><p style="color:#888;">

        <a href="/profil-'.$data['membre_id'].'.html" style="color:'.$data['membre_couleur'].';">'.$data['membre_pseudo'].'</a> a publié sur son mur</p><a href="/publi-'.$publi.'.html" style="color:#a0a0a0;"><i class="material-icons md-18" style="font-size:14px;">av_timer</i>

          le '.date('d/m/Y à H\hi', $data['timestamp']).'</a></div>

          <p>'.code(stripslashes(htmlspecialchars($data['message']))).'</p>';

        if ($data['id_posteur'] == $id OR $lvl>3) { 

          echo '&nbsp;&nbsp; <a href="./postok.php?action=suppr_publi&amp;id='.$publi.'" style="color:red;float:right;background:#f1c5c5;" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored"><i class="material-icons md-18">delete_forever</i> Supprimer</a>';

        }

        echo '<a href="/publi-'.$publi.'.html" style="float:right;background:#2597dd;" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored"><i class="material-icons md-18">comment</i> Commentaires ('.$NbrComm.')</a></td></tr>

            </tbody>

  </table></div>';

} else { // s'il publie sur un autre profil

       $receveur=$db->prepare('SELECT * FROM publications LEFT JOIN forum_membres ON forum_membres.membre_id = publications.id_posteur WHERE id = :id'); // On sélectionne les publications

       $receveur->bindValue(':id',$publi, PDO::PARAM_INT);

       $receveur->execute();

     $post=$receveur->fetch();

     echo '<div class="commentaires" style="padding:20px;"><table><tbody><tr>

   <td style="width:80px;"><img src="'.$post['membre_avatar'].'" alt="avatar" width="80" height="80" style="border-radius:50%;margin-top:5px;" /></td>

     <td style="width:98%;text-align:left;padding-left:15px;"><div style="font-size:14px;"><p style="color:#888;">

     <a href="/profil-'.$post['membre_id'].'.html" style="color:'.$post['membre_couleur'].';">'.$post['membre_pseudo'].'</a> a publié sur le mur de <a href="/profil-'.$data['membre_id'].'.html" style="color:'.$data['membre_couleur'].';">'.$data['membre_pseudo'].'</a></p>

      <a href="/publi-'.$publi.'.html" style="color:#a0a0a0;"><i class="material-icons md-18" style="font-size:14px;">av_timer</i> le '.date('d/m/Y à H\hi', $post['timestamp']).'</a></div>

      <p>'.code(stripslashes(htmlspecialchars($data['message']))).'</p>';

        if ($data['id_posteur'] == $id OR $lvl>3) { 

          echo '&nbsp;&nbsp; <a href="./postok.php?action=suppr_publi&amp;id='.$publi.'" style="color:red;float:right;background:#f1c5c5;" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored"><i class="material-icons md-18">delete_forever</i> Supprimer</a>';

        }

        echo '<a href="/publi-'.$publi.'.html" style="float:right;background:#2597dd;" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored"><i class="material-icons md-18">comment</i> Commentaires ('.$NbrComm.')</a></td>

   </table></div>';} }

echo'<br><a href="/touteslespublis.html" style="background-color:#e97f0a;margin-left:1%;" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored"><i class="material-icons md-18">group</i> Voir toutes les publications</a><br><br></div>';

include("includes/fin.php");

?>