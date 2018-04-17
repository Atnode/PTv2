<?php
session_start();
$titre="Planète Toad &bull; Modification de votre profil";
include("includes/identifiants.php");
include("includes/debut.php");
if ($id==0) header('Location: connexion.html'); 

    $pass = crypt('sha512', md5($_POST['password']));
    $confirm = crypt('sha512', md5($_POST['confirm']));
if (!empty($pass) || !empty($confirm)) {    
    //On déclare les variables 

    $mdp_erreur = NULL;
	$mdp_tpetit = NULL;
	
    //Encore et toujours notre belle variable $i :p
    $i = 0;
    $temps = time();
   
    if (strlen($_POST['password']) < 3)
    {
 
         $mdp_tpetit = "Votre mot de passe n'est pas valide. Il doit contenir 3 caractères au minimum.";
	      $i++;
	 }   

    //Vérification du mdp
    if ($pass != $confirm || empty($confirm) || empty($pass))
    {
         $mdp_erreur = "Votre mot de passe et votre confirmation diffèrent ou sont vides";
         $i++;
    }
 
    if ($i == 0) // Si $i est vide, il n'y a pas d'erreur
    {
        $timestamp_expiration = time() + 365*24*3600;
        setcookie('password', $pass, $timestamp_expiration);

        //On modifie la table
 
        $query=$db->prepare('UPDATE forum_membres
        SET  membre_mdp = :mdp WHERE membre_id=:id');
        $query->bindValue(':mdp',$pass,PDO::PARAM_INT);
        $query->bindValue(':id',$id,PDO::PARAM_INT);
        $query->execute();
        echo'<META http-equiv="refresh" content="0; URL=/modifiermdp.html">';
    }
    else
    {
include("includes/menu.php");
        echo'<h1>Modification interrompue</h1>';
        echo'<p>Une ou plusieurs erreurs se sont produites pendant la modification du mot de passe.</p>';
        echo'<p>'.$i.' erreur(s)</p>';
        echo'<p>'.$mdp_erreur.'</p>';
	  	echo'<p>'.$mdp_tpetit.'</p>';
        echo'<p> Cliquez <a href="./modifiermdp.html">ici</a> pour recommencer</p>';
    }
}