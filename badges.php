 <?php
session_start();
$titre = "Planète Toad &bull; Badges";
$descrip = "Tous les badges à obtenir sur le site.";
include("includes/identifiants.php");
include("includes/debut.php");
include("includes/menu.php");
?>
<div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> <a href="./badges.html">Badges</a></div><br />
<h1>Badges</h1>

<br><div style="text-align:center;" >

<div class="gavatar" ><img src="badges/10-msg.png" alt="Badge" class="simple-tooltip" title="Toad 8-bit : 10 Messages postés !" />
<br><p>Toad 8-bit</p></div>
 
<div class="gavatar" ><img src="badges/50-msg.png" alt="Badge" class="simple-tooltip" title="Jouet Mini-Toad : 50 Messages postés !" />
<br><p>Jouet Mini-Toad </p></div>

<div class="gavatar" ><img src="badges/100-msg.png" alt="Badge" class="simple-tooltip" title="Toad : 100 Messages postés !" />
<br><p>Toad</p></div>
 
<div class="gavatar" ><img src="badges/250-msg.png" alt="Badge" class="simple-tooltip" title="Toad pilote de Kart : 250 Messages postés !" />
<br><p>Toad pilote de Kart</p></div>
 
<div class="gavatar" ><img src="badges/500-msg.png" alt="Badge" class="simple-tooltip" title="Capitaine Toad : 500 Messages postés !" />
<br><p>Capitaine Toad</p></div>
 
<div class="gavatar" ><img src="badges/1000-msg.png" alt="Badge" class="simple-tooltip" title="Toad astronaute : 1000 Messages postés !" />
<br><p>Toad astronaute</p></div>
 
<div class="gavatar" ><img src="badges/esprit-critique.png" alt="Badge" class="simple-tooltip" title="Esprit critique : Vous avez posté votre avis sur le livre d\'or." /><br><p>Esprit critique</p></div>

<div class="gavatar" ><img src="badges/gamer.png" alt="Badge" class="simple-tooltip" title="Gamer : Vous avez enregistré votre identifiants pour jouer en ligne ! " />
<br><p>Gamer</p></div>

<div class="gavatar" ><img src="badges/competiteur.png" alt="Badge" class="simple-tooltip" title="Compétiteur : Vous avez déjà gagné au moins une étoile tournoi !" />
<br><p>Compétiteur</p></div>
 
<div class="gavatar" ><img src="badges/topic-15.png" alt="Badge" class="simple-tooltip" title="Topicologue : Vous avez posté 15 topics." />
<br><p>Topicologue</p></div>
 
 <div class="gavatar" ><img src="badges/topic-35.png" alt="Badge" class="simple-tooltip" title="Super Topicologue : Vous avez posté 30 topics." />
<br><p>Super Topicologue</p></div>
 
<div class="gavatar" ><img src="badges/1-an.png" alt="Badge" class="simple-tooltip" title="Vous êtes sur le site depuis un an !<" />
<br><p>1 AN !</p></div>
 
<div class="gavatar" ><img src="badges/2-an.png" alt="Badge" class="simple-tooltip" title="Vous êtes sur le site depuis deux ans !" />
<br><p>2 ANS !</p></div>
 
<div class="gavatar" ><img src="badges/3-an.png" alt="Badge" class="simple-tooltip" title="Vous êtes sur le site depuis trois ans !" />
<br><p>3 ans !</p></div>
 
<div class="gavatar" ><img src="badges/15-amis.png" alt="Badge" class="simple-tooltip" title="Super pote : Vous avez 15 amis sur le site." />
<br><p>Super pote</p></div>
 
<div class="gavatar" ><img src="badges/30-amis.png" alt="Badge" class="simple-tooltip" title="Hyper pote : Vous avez 30 amis sur le site" />
<br><p>Hyper pote</p></div>
 
<div class="gavatar" ><img src="badges/encyclo-10.png" alt="Badge" class="simple-tooltip" title="Encyclopédiste : Vous avez posté 10 fiches !" />
<br><p>Encyclopédiste</p></div>
 
<div class="gavatar" ><img src="badges/encyclo-25.png" alt="Badge" class="simple-tooltip" title="Super Encyclopédiste : Vous avez posté 25 fiches !" />
<br><p>Super Encyclopédiste</p></div>
 
<div class="gavatar" ><img src="badges/encyclo-50.png" alt="Badge" class="simple-tooltip" title="Hyper Encyclopédiste : Vous avez posté 50 fiches !" />
<br><p>Hyper Encyclopédiste</p></div>

</div>
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