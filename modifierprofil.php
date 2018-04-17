<?php
session_start();
$titre="Planète Toad &bull; Modification de votre profil";
include("includes/identifiants.php");
include("includes/debut.php");
if ($lvl<2) {header('Location: erreur_403.html'); 
exit();}
if ($id==0) header('Location: connexion.html'); 
include("includes/menu.php");
$membre = isset($_GET['m'])?(int) $_GET['m']:'';
$cat = (isset($_GET['cat']))?htmlspecialchars($_GET['cat']):'';
switch($cat) {
case "mdp":
    if (empty($_POST['sent'])) { // Si la variable est vide, on peut considérer qu on est sur la page de formulaire
echo '<div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> <a href="./motifierprofil.html">Modifier son profil</a> --> <a href="./modifiermdp.html">Modifier son mot de passe</a></div><br />';
echo '<h1>Modifier son mot de passe</h1><br><br>

        <form method="post" action="modifiermdp.php">
        <fieldset><legend>Mot de passe</legend>
        <label for="password">Nouveau mot de Passe :</label>
        <input type="password" name="password" id="password" /><br><br>
        <label for="confirm">Confirmer le mot de passe :</label>
        <input type="password" name="confirm" id="confirm"  />
        </fieldset>
        <p>
        <input class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit" value="Modifier son mot de passe" />
        <input type="hidden" id="sent" name="mdpchange" value="1" /></p></form>';
}
break;
default:
    if (empty($_POST['sent'])) {
//On prend les infos du membre
     $query=$db->prepare('SELECT * FROM forum_membres WHERE membre_id=:id');
     $query->bindValue(':id',$id,PDO::PARAM_INT);
     $query->execute();
     $data=$query->fetch();
echo '<div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> <a href="./motifierprofil.html">Modifier son profil</a></div><br>';
echo '<h1>Modifier son profil</h1>';
        
        echo '<form method="post" action="modifierprofil.html" enctype="multipart/form-data">       
 
        <fieldset><legend>Identifiants</legend>
        Pseudo : '; if($data['changerpseudo'] == 0) { echo '<span style="color:'.$data['membre_couleur'].'; font-weight:bold;">'.stripslashes(htmlspecialchars($data['membre_pseudo'])).'</span>'; } 
        else { echo'<input type="text" name="pseudo" id="pseudo" style="color:'.$data['membre_couleur'].'; font-weight:bold;" value="'.stripslashes(htmlspecialchars($data['membre_pseudo'])).'" />'; } echo '<br />';       
        echo 'Mot de passe : <a href="/modifiermdp.html">[Modifier son mot de passe]</a><br />
        <label for="email">Votre adresse E-Mail :</label>
        <input type="text" name="email" id="email"
        value="'.stripslashes($data['membre_email']).'" /><br>
        </fieldset>
               
        <fieldset><legend>Profil sur le site</legend>
        Avatar : <input type="file" name="avatar"></input>
        (Taille maximale : 150x150px et 100 Ko)<br><br>
        <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-1">
        <input type="checkbox" id="switch-1" class="mdl-switch__input" name="delete" value="Delete">
        <span class="mdl-switch__label">Supprimer l\'avatar</span>
        </label>
        <br><br><hr />';
                
        echo'<label for="signature">Signature :</label>
        <textarea cols="60" rows="8" name="signature" id="signature">'.stripslashes($data['membre_signature']).'</textarea><br><br><br>
        <label for="description">Votre description (255 caractères max) :</label>
        <textarea cols="60" rows="3" name="description" id="description">'.stripslashes($data['description']).'</textarea><br><br><br>';
    $birthday = $data['birthday'];
    $date = date_parse($birthday);
    $jour = $date['day'];
    $mois = $date['month'];
    $annee = $date['year'];

        echo'<label for="birthday">Date de naissance (indiquer "0000" pour l\'année si vous ne souhaitez pas que votre âge soit affiché) :</label>
        <select name="jour"> 
        <option selected="selected" value="'.$jour.'">'.$jour.'</option><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option></select>                
        <select name="mois">
        <option selected="selected" value="'.$mois.'">'.getMonth($mois).'</option><option value="01">Janvier</option><option value="02">Fevrier</option><option value="03">Mars</option><option value="04">Avril</option><option value="05">Mai</option><option value="06">Juin</option><option value="07">Juillet</option><option value="08">Aout</option><option value="09">Septembre</option><option value="10">Octobre</option><option value="11">Novembre</option><option value="12">Decembre</option></select>
        <select name="annee"> 
        <option selected="selected" value="'.$annee.'">'.$annee.'</option>
        <option>0000</option>';
        $anneeY = 1900;
        while ($anneeY<=2007) { echo'<option>'.$anneeY.'</option>'; $anneeY++; }
        echo'</select><br><br><br><br><br><br>
        <label for="averto">Avertissements :</label> '.$data['avertissement'].' <br><br></fieldset>

        <fieldset><legend>Codes-Amis</legend>
        <label for="ca_3ds">Code-Ami 3DS :</label>
        <input type="text" name="ca_3ds" id="ca_3ds"
        value="'.stripslashes($data['ca_3ds']).'" /><br />
        <label for="nintendo_network">Identifiant Nintendo Network :</label>
        <input type="text" name="nintendo_network" id="nintendo_network"
        value="'.stripslashes($data['nintendo_network']).'" /><br><br>
		<label for="ca_switch">Code-Ami Nintendo Switch :</label>
        SW-<input type="text" name="ca_switch" id="ca_switch"
        value="'.stripslashes($data['ca_switch']).'" /><br />
        </fieldset>

        <fieldset><legend>Boutique</legend>';
        $article1 = $data['article1'];
        // Pour la jauge d experience
        $article4 = $data['article4'];
        $article4_color = $data['article4_color'];

        if ($data['article1']==1) {
        echo'<label for="article1">Couleur du pseudo :</label><textarea type="text" name="article1" id="article1">'.stripslashes($data['membre_couleur']).'</textarea><br><br>';
        } else {
        echo'<p align=center>Vous n\'avez pas encore acheté l\'article pour personnaliser la couleur de votre pseudo. <a href="/boutique.html">Pourquoi ne pas aller y faire un tour ?</a></p><br><br>';
        }
        if ($data['article4']==1) {
        echo'<label for="article4">Couleur de la barre d\'expérience :</label>
        <select name="article4">
        <option selected="selected" value="'.$article4_color.'">Garder votre couleur actuelle</option>
        <option value="1">Vert (couleur par défaut)</option>
        <option value="2">Orange</option>
        <option value="3">Soleil</option>
        <option value="4">Jaune</option>
        <option value="5">Violet clair</option>
        <option value="6">Violet foncé</option>
        <option value="7">Vert-bleu</option>
        </select>';
        } else {
        echo'<p align=center>Vous n\'avez pas encore acheté l\'article pour personnaliser la couleur de votre barre d\'expérience. <a href="/boutique.html">Pourquoi ne pas aller y faire un tour ?</a></p>';
        }
        echo'<br><br>
        </fieldset>

        <p>
        <div style="text-align:center;"><input class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit" value="Modifier son profil" /></div>
        <input type="hidden" id="sent" name="sent" value="1" />
        </p></form>';
    }   
    else //Cas du traitement
    {
     //On déclare les variables 

    $email_erreur1 = NULL;
    $email_erreur2 = NULL;
    $signature_erreur = NULL;
    $avatar_erreur = NULL;
    $avatar_erreur1 = NULL;
    $avatar_erreur2 = NULL;
    $avatar_erreur3 = NULL;

    //Encore et toujours notre belle variable $i :p
    $i = 0;
    $temps = time();
    $pseudo = $_POST['pseudo'];
    $signature = $_POST['signature'];
    $description = $_POST['description'];
    $CA3DS = $_POST['ca_3ds'];
    $IDNETWORK = $_POST['nintendo_network'];
	$ca_switch = $_POST['ca_switch'];
    $couleur = $_POST['article1'];
    $couleur_exp = $_POST['article4'];
    $email = $_POST['email'];
    $avatar = $_FILES['avatar'];
    $annee = $_POST['annee'];
    $mois = $_POST['mois'];
    $jour = $_POST['jour'];
    $date = new DateTime();
    $date->setDate($annee, $mois, $jour); 
    $dateimm = date_format($date, 'Y-m-d');

    //Vérification de l'adresse email
    //Il faut que l'adresse email n'ait jamais été utilisée (sauf si elle n'a pas été modifiée)

    //On commence donc par récupérer le mail
    $query=$db->prepare('SELECT * FROM forum_membres WHERE membre_id =:id'); 
    $query->bindValue(':id',$id,PDO::PARAM_INT);
    $query->execute();
    $data=$query->fetch();
    if (strtolower($data['membre_email']) != strtolower($email))
    {
        //Il faut que l'adresse email n'ait jamais été utilisée
        $query=$db->prepare('SELECT COUNT(*) AS nbr FROM forum_membres WHERE membre_email =:mail');
        $query->bindValue(':mail',$email,PDO::PARAM_STR);
        $query->execute();
        $mail_free=($query->fetchColumn()==0)?1:0;
        $query->closeCursor();
        if(!$mail_free)
        {
            $email_erreur1 = "Votre adresse email est déjà utilisée par un membre";
            $i++;
        }

        //On vérifie la forme maintenant
        if (!preg_match("#^[a-z0-9A-Z._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $email) || empty($email))
        {
            $email_erreur2 = "Votre nouvelle adresse E-Mail n'a pas un format valide";
            $i++;
        }
    }

    //Vérification de la signature
    if (strlen($signature) > 700)
    {
        $signature_erreur = "Votre nouvelle signature est trop longue";
        $i++;
    }
	
    if (strlen($description) > 250)
    {
        $description_erreur = "Votre nouvelle description est trop longue";
        $i++;
    }
    
    if (!empty($_FILES['avatar']['size']))
    {
        //On définit les variables :
        $maxsize = 102400; //Poids de l'image
        $maxwidth = 150; //Largeur de l'image
        $maxheight = 150; //Longueur de l'image
        //Liste des extensions valides
        $extensions_valides = array('jpg','jpeg','png','bmp');
 
        if ($_FILES['avatar']['error']>0)
        {
         $i++;
        $avatar_erreur = "Erreur lors du tranfsert de l'avatar : ";
        }

 if(is_uploaded_file($_FILES['avatar']['tmp_name'])){
    $info = @getimagesize($_FILES['avatar']['tmp_name']);
    if($info){ // c'est une image
    }else{ 
    $i++;
    $erreur_changeData = "Données qui prouvent que ce n'est pas une image";
    }
}


$handle = fopen($_FILES['avatar'], 'r');
if ($handle)
{
    while (!feof($handle))
    {
        $buffer = fgets($handle);
        
        switch (true) {
        
        case strstr($buffer,'<'):
                $i++;
        break;
        
        case strstr($buffer,'>'):
                $i++;
        break;
        
        case strstr($buffer,';'):
                $i++;
        break;
        
        case strstr($buffer,'&'):
                $i++;
        break;
        
        case strstr($buffer,'?'):
                $i++;
        break;
        }
    }
    
    fclose($handle);
}

        if ($_FILES['avatar']['size']>$maxsize)
        {
        $i++;
        $avatar_erreur1 = "Le fichier est trop gros :
        (<strong>".$_FILES['avatar']['size']." Octets</strong>
        contre <strong>".$maxsize." Octets</strong>)";
        }
 
        $image_sizes = getimagesize($_FILES['avatar']['tmp_name']);
        if ($image_sizes[0] > $maxwidth OR $image_sizes[1] > $maxheight)
        {
        $i++;
        $avatar_erreur2 = "Image trop large ou trop longue :
        (<strong>".$image_sizes[0]."x".$image_sizes[1]."</strong> contre
        <strong>".$maxwidth."x".$maxheight."</strong>)";
        }
 
        $extension_upload = strtolower(substr(  strrchr($_FILES['avatar']['name'], '.')  ,1));
        if (!in_array($extension_upload,$extensions_valides) )
        {
                $i++;
                $avatar_erreur3 = "Extension de l'avatar incorrecte";
        }
    }
    
    echo '<p><i>Vous êtes ici</i> : <a href="./">Index</a> --> Modification du profil';

 
    if ($i == 0) // Si $i est vide, il n'y a pas d'erreur
    {
        if (!empty($_FILES['avatar']['size']))
        {

                $nomavatar=move_avatar($_FILES['avatar']);
                $change=$db->prepare('UPDATE forum_membres
                SET membre_avatar = :avatar 
                WHERE membre_id = :id');
                $change->bindValue(':avatar',$nomavatar,PDO::PARAM_STR);
                $change->bindValue(':id',$id,PDO::PARAM_INT);
                $change->execute() or die(print_r($change->errorInfo()));
                $change->closeCursor();
        }
 
        //Si on suppr
        if (isset($_POST['delete']))
        {
                $query=$db->prepare('UPDATE forum_membres SET membre_avatar= :ava WHERE membre_id = :id');
                $query->bindValue(':id',$id,PDO::PARAM_INT);
                $query->bindValue(':ava',"/images/avatars/avadefaut.png",PDO::PARAM_STR);
                $query->execute();
                $query->closeCursor();
        }
 
        echo'<h1>Modification terminée</h1>';
        echo'<p>Votre profil a été modifié avec succès !</p>';
        echo'<p>Cliquez <a href="./">ici</a> 
        pour revenir à la page d\'accueil</p>';
 
        //On modifie la table
        
        $query=$db->prepare('UPDATE forum_membres SET membre_email=:mail, membre_signature=:sign, description=:description, ca_3ds=:ca3ds, nintendo_network=:idnn,
        ca_switch=:ca_switch, birthday=:birthday WHERE membre_id=:id');
        $query->bindValue(':mail',$email,PDO::PARAM_STR);
        $query->bindValue(':sign',$signature,PDO::PARAM_STR);
        $query->bindValue(':description',$description,PDO::PARAM_STR);
        $query->bindValue(':ca3ds',$CA3DS,PDO::PARAM_STR);
        $query->bindValue(':idnn',$IDNETWORK,PDO::PARAM_STR);
		$query->bindValue(':ca_switch',$ca_switch,PDO::PARAM_STR);
        $query->bindValue(':birthday',$dateimm,PDO::PARAM_STR);
        $query->bindValue(':id',$id,PDO::PARAM_INT);
        $query->execute();


        $pseudoRe1q=$db->prepare('SELECT changerpseudo FROM forum_membres WHERE membre_id = '.$id.'');
        $pseudoRe1q->execute();
        $data24 = $pseudoRe1q->fetch();
        if ($data24['changerpseudo']=="1") {
        $pseudoReq=$db->prepare('UPDATE forum_membres SET membre_pseudo = :pseudo, changerpseudo = 0 WHERE membre_id=:id');
        $pseudoReq->bindValue(':pseudo',$pseudo,PDO::PARAM_STR);
        $pseudoReq->bindValue(':id',$id,PDO::PARAM_INT);
        $pseudoReq->execute(); }
        
        $colorRe1q=$db->prepare('SELECT article1 FROM forum_membres WHERE membre_id = '.$id.'');
        $colorRe1q->execute();
        $data23 = $colorRe1q->fetch();
        if ($data23['article1']=="1") {
        if (stripos($couleur, ';') !== FALSE) { // Si y a un point virgule dans la couleur
        $couleurReal = strstr($couleur, ';', true);
        } elseif (stripos($couleur, '"') !== FALSE) {
        $couleurReal = strstr($couleur, '"', true);
        } elseif (stripos($couleur, '\'') !== FALSE) {
        $couleurReal = strstr($couleur, '\'', true);
        }
        else { $couleurReal = $couleur; }
        
        if (empty($couleur)) { $couleurReal = "black"; }

        $colorReq=$db->prepare('UPDATE forum_membres SET membre_couleur = :couleur WHERE membre_id=:id');
        $colorReq->bindValue(':couleur',$couleurReal,PDO::PARAM_STR);
        $colorReq->bindValue(':id',$id,PDO::PARAM_INT);
        $colorReq->execute(); }


        // POUR LA JAUGE
        $colorRe4q=$db->prepare('SELECT article4 FROM forum_membres WHERE membre_id = '.$id.'');
        $colorRe4q->execute();
        $data24 = $colorRe4q->fetch();
        if ($data24['article4']==1) {
        if ($couleur_exp<1 OR $couleur_exp>7) {
        $i++;
        } else {
        $colorReq=$db->prepare('UPDATE forum_membres SET article4_color = :couleurexp WHERE membre_id=:id');
        $colorReq->bindValue(':couleurexp',$couleur_exp,PDO::PARAM_STR);
        $colorReq->bindValue(':id',$id,PDO::PARAM_INT);
        $colorReq->execute(); }
        }

    }
    else
    {
        echo'<h1>Modification interrompue</h1>';
        echo'<p>Une ou plusieurs erreurs se sont produites pendant la modification du profil</p>';
        echo'<p>'.$i.' erreur(s)</p>';
        echo'<p>'.$email_erreur1.'</p>';
        echo'<p>'.$email_erreur2.'</p>';
        echo'<p>'.$signature_erreur.'</p>';
        echo'<p>'.$description_erreur.'</p>';
        echo'<p>'.$avatar_erreur.'</p>';
        echo'<p>'.$avatar_erreur1.'</p>';
        echo'<p>'.$avatar_erreur2.'</p>';
        echo'<p>'.$avatar_erreur3.'</p>';
        echo'<p>'.$erreur_changeData.'</p>';
        echo'<p> Cliquez <a href="./modifierprofil.html">ici</a> pour recommencer</p>';
    }
} //Fin du else
break;
}
include("includes/fin.php");
?>