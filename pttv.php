 <?php
session_start();
$titre = "Planète Toad &bull; PTTV";
$descrip = "La télévision officielle de Planète Toad afin de voir les différents événements officiels";
include("includes/identifiants.php");
include("includes/debut.php");
include("includes/menu.php");
?>
<div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> <a href="./pttv.html">Planète Toad TV</a></div><br />
<h1>Planète Toad TV</h1>

<center>

<div style="text-align:left; display:inline-block; vertical-align:top;float:left;" >
<iframe width="560" height="315" src="https://www.youtube.com/embed/no-pFsk2-rQ" frameborder="0" allowfullscreen></iframe>
<!--<iframe width="560" height="315" src="https://www.youtube.com/embed/kAuVga9GWIg" frameborder="0" allowfullscreen></iframe>-->
<!--<iframe width="429" height="320" src="http://www.catchmyworld.com/vm/b66b4kas9wrs/embedtest" frameborder="0" allowfullscreen></iframe>-->

<!--- Programme à écrire ici -->

<h2>Programme</h2>
<p>15h heure française : Super Mario Direct</p>


</div>
<?php
if ($id!=0) { ?>
<div style="background-color: white; display:inline-block; vertical-align:top;width:800px;float:right;"><?php
include("minichat_frame.php"); ?></div>
<?php } ?>
<div class="clearboth"></div>
</center>
<?php
include("includes/fin.php");
?>