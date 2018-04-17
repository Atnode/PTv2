<?php
session_start();
$titre="Planète Toad &bull; Inscription";
$descrip = "Vous inscrire sur Planète Toad est gratuit, et vous permet de profiter de nombreux avanatages comme participer, contribuer, connaître des nouvelles informations sur l'univers de Toad";
include("includes/identifiants.php");
include("includes/debut.php");
if ($id!=0) header('Location: erreur_403.html');
include("includes/menu.php");
//$secret = '6Lc6Vx8TAAAAADUbtI69I8jU0LSSShfQU6dYUj_w'; // votre clé privée
//require 'recaptchalib.php';

echo '<div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> <a href="./inscription.html">Inscription</a></div><br />';

if (empty($_POST['pseudo'])) // Si on la variable est vide, on peut considérer qu'on est sur la page de formulaire
{

// CAPTCHA
$number1 = mt_rand(0, 10);
$number2 = mt_rand(0, 10);
$captchaReal = $number1 + $number2;

	echo '<h1>Inscription</h1><br>
    <div style="text-align:center;">Vous inscrire sur Planète Toad, c\'est rejoindre une grande communauté de passionnés de jeux-vidéo, c\'est avoir accès à un 
    forum, à un chat, à une boutique où les articles s\'achètent avec une monnaie virtuelle, une encyclopédie. Et tout cela est géré par des membres volontaires
    comme vous, et comme nous. Il y a <a href="/topic-1-1-reglement-du-site.html">un règlement à suivre</a> ou vous risquerez une sanction.</div><br><br>';
	echo '<form method="post" action="inscription.html"><div class="commentaires"><br><br>
	<p><label for="pseudo">Pseudo :</label>  <input name="pseudo" type="text" id="pseudo" /></p><br><br>
	<p><label for="email">Votre adresse Mail :</label><input type="text" name="email" id="email" /></p><br><br>
	<p><label for="password">Mot de Passe :</label><input type="password" name="password" id="password" /></p><br><br>
	<p><label for="sconfirm">Confirmer le mot de passe :</label><input type="password" name="confirm" id="confirm" /></p><br><br>
    <p><label for="captcha">'.$number1.' + '.$number2.' (captcha) :</label>  <input name="captcha" type="number" id="captcha" /></p><br><br>
    <input name="captchaReal" type="hidden" value="'.$captchaReal.'" />
    <p><input class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit" value="S\'inscrire" /></p></div></form>';
	
	
} //Fin de la partie formulaire
else //On est dans le cas traitement
{
    $pseudo_erreur1 = NULL;
    $pseudo_erreur2 = NULL;
    $mdp_erreur = NULL;
    $email_erreur1 = NULL;
    $email_erreur2 = NULL;

    //On récupère les variables
    $i = 0;
    $temps = time(); 
    $pseudo = $_POST['pseudo'];
    $email = $_POST['email'];
    $captcha = $_POST['captcha'];
    $captchaReal = $_POST['captchaReal'];
    $pass = crypt('sha512', md5($_POST['password']));
    $confirm = crypt('sha512', md5($_POST['password']));
	
    //Vérification du pseudo
    $query=$db->prepare('SELECT COUNT(*) AS nbr FROM forum_membres WHERE membre_pseudo =:pseudo');
    $query->bindValue(':pseudo',$pseudo, PDO::PARAM_STR);
    $query->execute();
    $pseudo_free=($query->fetchColumn()==0)?1:0;
    $query->CloseCursor();
    if(!$pseudo_free)
    {
        $pseudo_erreur1 = "Votre pseudo est déjà utilisé par un membre";
        $i++;
    }

    if (strlen($pseudo) < 3 || strlen($pseudo) > 15)
    {
        $pseudo_erreur2 = "Votre pseudo est soit trop grand, soit trop petit";
        $i++;
    }

    //Vérification du mdp
    if ($pass != $confirm || empty($confirm) || empty($pass))
    {
        $mdp_erreur = "Votre mot de passe et votre confirmation diffèrent, ou sont vides";
        $i++;
    }
$query=$db->prepare('SELECT COUNT(*) AS nbr FROM forum_membres WHERE membre_pseudo =:pseudo');
$query->bindValue(':pseudo',$pseudo, PDO::PARAM_STR);
$query->execute();
$pseudo_free=($query->fetchColumn()==0)?1:0;
    //Vérification de l'adresse email

    //Il faut que l'adresse email n'ait jamais été utilisée
    $query=$db->prepare('SELECT COUNT(*) AS nbr FROM forum_membres WHERE membre_email =:mail');
    $query->bindValue(':mail',$email, PDO::PARAM_STR);
    $query->execute();
    $mail_free=($query->fetchColumn()==0)?1:0;
    $query->CloseCursor();
    
    if(!$mail_free)
    {
        $email_erreur1 = "Votre adresse email est déjà utilisée par un membre";
        $i++;
    }
    //On vérifie la forme maintenant
    if (!preg_match("#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$#", $email) || empty($email))
    {
        $email_erreur2 = "Votre adresse E-Mail n'a pas un format valide";
        $i++;
    }

    //CAPTCHA
    if ($captcha!=$captchaReal) {
       $captcha_error = "Captcha invalide";
       $i++;
    }

   if ($i==0)
    {	
    echo'<h1>Inscription terminée</h1>';
    echo'<p>Bienvenue '.stripslashes(htmlspecialchars($_POST['pseudo'])).' vous êtes maintenant inscrit sur Planète Toad.</p>
	<p>Cliquez <a href="./index.html">ici</a> pour revenir à la page d\'accueil</p>';
	   
    $query=$db->prepare('INSERT INTO forum_membres (membre_pseudo, membre_mdp, membre_email, membre_avatar, membre_inscrit, membre_derniere_visite, membre_couleur, membre_champi, champi_total, membre_rang)
    VALUES (:pseudo, :pass, :email, :ava, :temps, :temps, :black, :quinze, :quinze, :deux)');
	$query->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
	$query->bindValue(':pass', $pass, PDO::PARAM_INT);
	$query->bindValue(':email', $email, PDO::PARAM_STR);
	$query->bindValue(':ava',"images/avadefaut.png",PDO::PARAM_STR);
	$query->bindValue(':temps', time(), PDO::PARAM_INT);
	$query->bindValue(':temps', time(), PDO::PARAM_INT);
	$query->bindValue(':black', "black", PDO::PARAM_INT);
	$query->bindValue(':quinze', "15", PDO::PARAM_INT);
	$query->bindValue(':quinze', "15", PDO::PARAM_INT);
	$query->bindValue(':deux', "2", PDO::PARAM_INT);
    $query->execute() or die(print_r($query->errorInfo()));
  
	//Et on définit les variables de sessions
        $_SESSION['pseudo'] = $pseudo;
        $_SESSION['id'] = $db->lastInsertId();
        $_SESSION['level'] = 2;
    }
    else
    {
        echo'<h1>Inscription interrompue</h1>';
        echo'<p>Une ou plusieurs erreurs se sont produites pendant l\'incription</p>';
        echo'<p>'.$i.' erreur(s)</p>';
        echo'<p>'.$pseudo_erreur1.'</p>';
        echo'<p>'.$pseudo_erreur2.'</p>';
        echo'<p>'.$mdp_erreur.'</p>';
        echo'<p>'.$email_erreur1.'</p>';
        echo'<p>'.$email_erreur2.'</p>';
        echo'<p>'.$captcha_error.'</p>';
       
        echo'<p>Cliquez <a href="./inscription.html">ici</a> pour recommencer</p>';
    }
}
?> <!--<script src='https://www.google.com/recaptcha/api.js'></script> --><?php
include("includes/fin.php");
?>