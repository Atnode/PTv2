<?php
session_start();
  $membre = isset($_GET['m'])?(int) $_GET['m']:'';
  $badge = 1;
  $balises = true;
  include("includes/identifiants.php");
  $reponse = $db->query('SELECT membre_pseudo FROM forum_membres WHERE membre_id=' . $membre . '');
  $donnees = $reponse->fetch();
  $titre =  'Planète Toad &bull; Badges de ' . $donnees['membre_pseudo'] . '';
  $descrip = 'Consulter le nombre de badges obtenus par le membre '.$donnees['membre_pseudo'].' sur le site Planète Toad';
  include("includes/debut.php");
  include("includes/menu.php");
  include("includes/bbcode.php");
  include("includes/headerprofil.php");

  //On récupère les infos du profil à voir
  $query=$db->prepare('SELECT * FROM forum_membres WHERE membre_id= :membre');
  $query->bindValue(':membre',$membre, PDO::PARAM_INT);
  $query->execute();
  $data=$query->fetch();
  if ($query->rowCount()>0) {
    echo '<div class="corps" style="margin-top:-12.999px;"><br><h1>Badges de '.stripslashes(htmlspecialchars($data['membre_pseudo'])).'</h1>
       <br>';
    // BADGES
    ?><h2>Badges <a href="badges.html">(Cliquez ici pour voir tous les badges)</a></h2><p style="text-align:center;"></p><?php

       $badgesnb = 0;
     // Messages
     echo '<br>';
       $query=$db->prepare('SELECT COUNT(*) FROM forum_amis WHERE ami_from = :membre AND ami_confirm = :confirm OR ami_to = :membre AND ami_confirm = :confirm');
       $query->bindValue(':membre',$membre, PDO::PARAM_INT);
       $query->bindValue(':confirm','1', PDO::PARAM_STR);
       $query->execute() or die(print_r($query->errorInfo()));
       $amism=$query->fetchColumn();

           // Compter les topics
$countTopic = $db->prepare('SELECT COUNT(*) FROM forum_topic WHERE topic_createur = :membre');
$countTopic->bindValue(':membre',$data['membre_id'],PDO::PARAM_INT);
$countTopic->execute();
$topicM=$countTopic->fetchColumn();
?><br><div style="text-align:center;" ><?php

if ($data['membre_post']>=10){echo '<div class="gavatar" ><img src="badges/10-msg.png" alt="Badge" class="simple-tooltip" title="Toad 8-bit : 10 Messages postés !" />
<br><p>Toad 8-bit</p></div>'; $badgesnb++;}
 else{echo '<div class="gavatar"><img src="badges/locked.png" alt="A débloquer" class="simple-tooltip" title="Ce badge n\'est pas encore débloqué"> <p>A débloquer</p></div>';}
 
 if ($data['membre_post']>=50){echo '<div class="gavatar" ><img src="badges/50-msg.png" alt="Badge" class="simple-tooltip" title="Jouet Mini-Toad : 50 Messages postés !" />
<br><p>Jouet Mini-Toad </p></div>'; $badgesnb++;}
 else{echo '<div class="gavatar"><img src="badges/locked.png" alt="A débloquer" class="simple-tooltip" title="Ce badge n\'est pas encore débloqué"> <p>A débloquer</p></div>';}

 if ($data['membre_post']>=100){echo '<div class="gavatar" ><img src="badges/100-msg.png" alt="Badge" class="simple-tooltip" title="Toad : 100 Messages postés !" />
<br><p>Toad</p></div>'; $badgesnb++;}
 else{echo '<div class="gavatar"><img src="badges/locked.png" alt="A débloquer" class="simple-tooltip" title="Ce badge n\'est pas encore débloqué"> <p>A débloquer</p></div>';}
 
  if ($data['membre_post']>=250){echo '<div class="gavatar" ><img src="badges/250-msg.png" alt="Badge" class="simple-tooltip" title="Toad pilote de Kart : 250 Messages postés !" />
<br><p>Toad pilote de Kart</p></div>'; $badgesnb++;}
 else{echo '<div class="gavatar"><img src="badges/locked.png" alt="A débloquer" class="simple-tooltip" title="Ce badge n\'est pas encore débloqué"> <p>A débloquer</p></div>';}
 
  if ($data['membre_post']>=500){echo '<div class="gavatar" ><img src="badges/500-msg.png" alt="Badge" class="simple-tooltip" title="Capitaine Toad : 500 Messages postés !" />
<br><p>Capitaine Toad</p></div>'; $badgesnb++;}
 else{echo '<div class="gavatar"><img src="badges/locked.png" alt="A débloquer" class="simple-tooltip" title="Ce badge n\'est pas encore débloqué"> <p>A débloquer</p></div>';}
 
  if ($data['membre_post']>=1000){echo '<div class="gavatar" ><img src="badges/1000-msg.png" alt="Badge" class="simple-tooltip" title="Toad astronaute : 1000 Messages postés !" />
<br><p>Toad astronaute</p></div>'; $badgesnb++;}
 else{echo '<div class="gavatar"><img src="badges/locked.png" alt="A débloquer" class="simple-tooltip" title="Ce badge n\'est pas encore débloqué"> <p>A débloquer</p></div>';}
 
  // Regarder le livre d'or
     $Dejaposte = $db->query('SELECT * FROM livreor WHERE id_posteur = '. $membre .'');
     $Dejaposte->execute();
     if ($Dejaposte->rowCount()>0){ echo '<div class="gavatar" ><img src="badges/esprit-critique.png" alt="Badge" class="simple-tooltip" title="Esprit critique : Vous avez posté votre avis sur le livre d\'or." /><br><p>Esprit critique</p></div>'; $badgesnb++;} else{echo '<div class="gavatar"><img src="badges/locked.png" alt="A débloquer" class="simple-tooltip" title="Ce badge n\'est pas encore débloqué"> <p>A débloquer</p></div>';}


   if (!empty($data['ca_3ds']) OR !empty($data['nintendo_network']) OR !empty($data['ca_switch'])) {echo '<div class="gavatar" ><img src="badges/gamer.png" alt="Badge" class="simple-tooltip" title="Gamer : Vous avez enregistré votre identifiants pour jouer en ligne ! " />
<br><p>Gamer</p></div>'; $badgesnb++;
}
 else{echo '<div class="gavatar"><img src="badges/locked.png" alt="A débloquer" class="simple-tooltip" title="Ce badge n\'est pas encore débloqué"> <p>A débloquer</p></div>';}
 
 if ($data['points_JV']>=1){echo '<div class="gavatar" ><img src="badges/competiteur.png" alt="Badge" class="simple-tooltip" title="Compétiteur : Vous avez déjà gagné au moins une étoile tournoi !" />
<br><p>Compétiteur</p></div>'; $badgesnb++;}
 else{echo '<div class="gavatar"><img src="badges/locked.png" alt="A débloquer" class="simple-tooltip" title="Ce badge n\'est pas encore débloqué"> <p>A débloquer</p></div>';}
 
 if ($topicM>=15){echo '<div class="gavatar" ><img src="badges/topic-15.png" alt="Badge" class="simple-tooltip" title="Topicologue : Vous avez posté 15 topics." />
<br><p>Topicologue</p></div>'; $badgesnb++;}
 else{echo '<div class="gavatar"><img src="badges/locked.png" alt="A débloquer" class="simple-tooltip" title="Ce badge n\'est pas encore débloqué"> <p>A débloquer</p></div>';}
 
    if ($topicM>=30){echo '<div class="gavatar" ><img src="badges/topic-35.png" alt="Badge" class="simple-tooltip" title="Super Topicologue : Vous avez posté 30 topics." />
<br><p>Super Topicologue</p></div>'; $badgesnb++;}
 else{echo '<div class="gavatar"><img src="badges/locked.png" alt="A débloquer" class="simple-tooltip" title="Ce badge n\'est pas encore débloqué"> <p>A débloquer</p></div>';}
 
     if ($data['membre_inscrit']+31536000<=time()){echo '<div class="gavatar" ><img src="badges/1-an.png" alt="Badge" class="simple-tooltip" title="Vous êtes sur le site depuis un an !<" />
<br><p>1 AN !</p></div>'; $badgesnb++;}
 else{echo '<div class="gavatar"><img src="badges/locked.png" alt="A débloquer" class="simple-tooltip" title="Ce badge n\'est pas encore débloqué"> <p>A débloquer</p></div>';}
 
      if ($data['membre_inscrit']+63072000<=time()){echo '<div class="gavatar" ><img src="badges/2-an.png" alt="Badge" class="simple-tooltip" title="Vous êtes sur le site depuis deux ans !" />
<br><p>2 ANS !</p></div>'; $badgesnb++;}
 else{echo '<div class="gavatar"><img src="badges/locked.png" alt="A débloquer" class="simple-tooltip" title="Ce badge n\'est pas encore débloqué"> <p>A débloquer</p></div>';}
 
       if ($data['membre_inscrit']+94608000<=time()){echo '<div class="gavatar" ><img src="badges/3-an.png" alt="Badge" class="simple-tooltip" title="Vous êtes sur le site depuis trois ans !" />
<br><p>3 ANS !</p></div>'; $badgesnb++;}
 else{echo '<div class="gavatar"><img src="badges/locked.png" alt="A débloquer" class="simple-tooltip" title="Ce badge n\'est pas encore débloqué"> <p>A débloquer</p></div>';}
 
     if ($amism>15){echo '<div class="gavatar" ><img src="badges/15-amis.png" alt="Badge" class="simple-tooltip" title="Super pote : Vous avez 15 amis sur le site." />
<br><p>Super pote</p></div>'; $badgesnb++;}
 else{echo '<div class="gavatar"><img src="badges/locked.png" alt="A débloquer" class="simple-tooltip" title="Ce badge n\'est pas encore débloqué"> <p>A débloquer</p></div>';}
 
        if ($amism>30){echo '<div class="gavatar" ><img src="badges/30-amis.png" alt="Badge" class="simple-tooltip" title="Hyper pote : Vous avez 30 amis sur le site" />
<br><p>Hyper pote</p></div>'; $badgesnb++;}
 else{echo '<div class="gavatar"><img src="badges/locked.png" alt="A débloquer" class="simple-tooltip" title="Ce badge n\'est pas encore débloqué"> <p>A débloquer</p></div>';}
 
		if ($data['membre_fiches']>=10){echo '<div class="gavatar" ><img src="badges/encyclo-10.png" alt="Badge" class="simple-tooltip" title="Encyclopédiste : Vous avez posté 10 fiches !" />
<br><p>Encyclopédiste</p></div>'; $badgesnb++;}
 else{echo '<div class="gavatar"><img src="badges/locked.png" alt="A débloquer" class="simple-tooltip" title="Ce badge n\'est pas encore débloqué"> <p>A débloquer</p></div>';}
 
 		if ($data['membre_fiches']>=25){echo '<div class="gavatar" ><img src="badges/encyclo-25.png" alt="Badge" class="simple-tooltip" title="Super Encyclopédiste : Vous avez posté 25 fiches !" />
<br><p>Super Encyclopédiste</p></div>'; $badgesnb++;}
 else{echo '<div class="gavatar"><img src="badges/locked.png" alt="A débloquer" class="simple-tooltip" title="Ce badge n\'est pas encore débloqué"> <p>A débloquer</p></div>';}
 
  		if ($data['membre_fiches']>=50){echo '<div class="gavatar" ><img src="badges/encyclo-50.png" alt="Badge" class="simple-tooltip" title="Hyper Encyclopédiste : Vous avez posté 50 fiches" />
<br><p>Hyper Encyclopédiste</p></div>'; $badgesnb++;}
 else{echo '<div class="gavatar"><img src="badges/locked.png" alt="A débloquer" class="simple-tooltip" title="Ce badge n\'est pas encore débloqué"> <p>A débloquer</p></div>';}

 
} 
if ($badgesnb<=1){
echo '<p>Vous avez '.$badgesnb.' badge débloqué sur 19.</p>';}
else {echo '<p>Vous avez ' .$badgesnb.' badges débloqués sur 19.</p>';}
?></div>
<script type="text/javascript" src="//js.planete-toad.fr/tipped/tipped.js"></script>
<link rel="stylesheet" type="text/css" href="//js.planete-toad.fr/tipped/tipped.css"/>
  <script>
 $(document).ready(function() {
    Tipped.create('.simple-tooltip');
  });
  </script>
<?php
include("includes/fin.php");
?>