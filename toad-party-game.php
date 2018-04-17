<?php
session_start();
include("./includes/identifiants.php");
$titre =  'Planète Toad &bull; Toad Party Game';
$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
if ($id==0) header('Location: erreur_403.html'); 
include("./includes/debut.php");
include("./includes/menu.php");
?>
<div id="filariane">>> <a href="./">Index</a> --> <a href="./toad-party.php">Toad Party</a></div>
<br><h1>Toad Party Game</h1>
<?php
echo'<div style="width:96%;margin-left:2%;margin-right:2%;" id="starBloc"></div>
<br><br>
<div style="float:left;width:40%;margin-left:4%;" class="commentaires" id="dice"></div>
<div style="float:right;width:40%;margin-left:4%;"class="commentaires" id="evenementCase"></div>
<div class="clearboth"></div><br><br>
<div style="float:left;width:40%;margin-left:4%;height:350px;overflow-y:auto;"class="commentaires" id="evenements"></div>
<div style="float:right;width:40%;margin-left:4%;height:350px;overflow-y:auto;"class="commentaires" id="statist"></div>
<div class="clearboth"></div><br><br>
<div style="width:100%;" id="plateau"></div><br><br>';
include("./includes/fin.php");
?>
<script>
$(function() {
    function e() {
        $("#dice").load("toad-party-dice.php")
    } setInterval(e, 500)

    function f() {
        $("#evenementCase").load("toad-party-evenementCase.php")
    } setInterval(f, 500)

    function g() {
        $("#evenements").load("toad-party-evenements.php")
    } setInterval(g, 500)

    function h() {
        $("#statist").load("toad-party-stats.php")
    } setInterval(h, 500)

    function i() {
        $("#starBloc").load("toad-party-stars.php")
    } setInterval(i, 500)

    function j() {
        $("#plateau").load("toad-party-plateau.php")
    } setInterval(j, 500)
});</script>