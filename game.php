<?php
session_start();
$id_game = (int) $_GET['id'];
$infosGame = 1;
include("./includes/identifiants.php");
$reponse = $db->prepare('SELECT nom FROM jeux WHERE id='.$id_game.'');
$reponse->execute();
$donnees = $reponse->fetch();
$titre =  ''.$donnees['nom'].' &bull; Planète Toad';
$descrip = "Consulter la fiche du jeu ".$donnees['nom']." sur le site Planète Toad";
include("./includes/debut.php");
include("./includes/menu.php");
include("./includes/headergame.php");
if ($lvl=="191") {echo'<script type="text/javascript" src="/js/percircle.js" async defer></script>
<link rel="stylesheet" href="/percircle.css">'; }
$query=$db->prepare('SELECT * FROM jeux WHERE id='.$id_game.'');
$query->execute();
$data=$query->fetch();
if ($query->rowCount()<1)
{ header('Location: http://www.planete-toad.fr/erreur_403.html'); } else {
echo '<div class="corps" style="margin-top:0px;"><div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> <a href="./jeux.html">Encyclopédie : jeux</a> -->
<a href="./game-'.$id_game.'-'.$data['nom_url'].'.html">'.$data['nom'].'</a></div><br>';
echo'<h1>'.$data['nom'].'</h1><br>
<br><br><div class="commentaires">
<table><tbody><tr><td>
<div style="text-align:justify;"><h2>Fiche technique</h2><br>
<b>Console :</b> '.$data['console'].'<br>
<b>Developpeur :</b> '.$data['developpeur'].'<br>
<b>Editeur :</b> '.$data['editeur'].'<br>
<b>Classification :</b> '.$data['classification'].'<br>
<b>Genre :</b> '.$data['genre'].'<br>
<b>Public :</b> '.$data['public'].'<br>
<b>Multijoueur :</b> '.$data['multijoueurs'].'<br>
<b>Online :</b> '.$data['online'].'<br>
<b>Sortie en Europe :</b> '.date("d/m/Y", strtotime($data['sortie_ue'])).'<br>
<b>Sortie aux Etats-Unis :</b> '.date("d/m/Y", strtotime($data['sortie_us'])).'<br>
<b>Sortie au Japon :</b> '.date("d/m/Y", strtotime($data['sortie_jp'])).'<br>
<b>Description :</b> '.$data['description'].'

</div></td><td style="vertical-align:middle;">
<img src="'.$data['jaquette'].'"style="max-height:205px;" alt="Jaquette de '.$data['nom'].'" title="Jaquette de '.$data['nom'].'" />
<br><br></td></tr></tbody></table>
</div><br>

<div class="clearboth"></div><br><hr />';
if ($lvl=="191") {
echo'<div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">

            <div id="greencircle" data-percent="17" class="big green">
            </div>
            <div id="orangecircle" data-percent="37" class="orange">
            </div>
            <div id="greencircle" data-percent="94" class="small green">
            </div>

            <svg fill="currentColor" color="#9644ff" width="200px" height="200px" viewBox="0 0 1 1" class="demo-chart mdl-cell mdl-cell--4-col mdl-cell--3-col-desktop">
              <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#piechart" mask="url(#piemask)"></use>
              <text x="0.5" y="0.5" letter-spacing="0px" font-size="0.3" fill="#888" text-anchor="middle" dy="0.1">82<tspan font-size="0.2" dy="-0.07">%</tspan></text>
            </svg>
            <svg fill="currentColor" color="#44b9ff" width="200px" height="200px" viewBox="0 0 1 1" class="demo-chart mdl-cell mdl-cell--4-col mdl-cell--3-col-desktop">
              <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#piechart" mask="url(#piemask)"></use>
              <text x="0.5" y="0.5" letter-spacing="0px" font-size="0.3" fill="#888" text-anchor="middle" dy="0.1">82<tspan dy="-0.07" font-size="0.2">%</tspan></text>
            </svg>
          </div>

<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" style="position: fixed; left: -1000px; height: -1000px;">
        <defs>
          <mask id="piemask" maskContentUnits="objectBoundingBox">
            <circle cx="0.5" cy="0.5" r="0.49" fill="white"></circle>
            <circle cx="0.5" cy="0.5" r="0.40" fill="black"></circle>
          </mask>
          <g id="piechart">
            <circle cx="0.5" cy="0.5" r="0.5"></circle>
            <path stroke="none" fill="rgba(255, 255, 255, 0.75)" d="M 0.5 0.5 0.5 0 A 0.5 0.5 0 0 1 0.95 0.28 z"></path>
          </g>
        </defs>
      </svg>
    <script type="text/javascript">
        $(function(){ 
            $("[id$=\'circle\']").percircle();
            
            $("#clock").percircle({
                perclock: true
            });
            
            $("#countdown").percircle({
                perdown: true,
                secs: 14,
                timeUpText: \'finally!\',
                reset: true
            });
            
            $("#custom").percircle({
                text:"custom",
                percent: 27
            });
            $("#custom-color").percircle({
                progressBarColor: "#CC3366",
                percent: 64
            });
        });
    </script>';
  }
}
include("includes/fin.php"); ?>
