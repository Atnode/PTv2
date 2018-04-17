<?php
session_start();
$titre="Planète Toad &bull; Modération";
$admin = 1;
include("../includes/identifiants.php");
include("../includes/debut.php");
if ($lvl<4) header('Location: ../erreur_403.html'); 
include("../includes/menu.php");
echo'<h1>Gérer les membres</h1>';

if (empty($_POST['membre'])) // Si la variable est vide, on peut considérer qu'on est sur la page de formulaire
{
echo'<form method="post" action="./membres.php">
<label for="membre">Entrez l\'ID du membre à gérer :</label>
        <input type="text" id="membre" name="membre">
        <input type="submit" value="Envoyer"><br></form><br>';
} else {
    if (empty($_POST['sent'])) {
    	     $membre = $_POST['membre'];
            $query = $db->prepare('SELECT * FROM forum_membres WHERE membre_id = :pseudo');
            $query->bindValue(':pseudo',$membre,PDO::PARAM_INT);
            $query->execute();    
            //Si la requête retourne un truc, le membre existe
            if ($data = $query->fetch()) 
            {
		?>
        <form method="post" action="./membres.php">
		<fieldset><legend>Identifiants</legend>
		<label for="pseudo">Pseudo :</label>
		<input type="text" name="pseudo" id="pseudo" 
		value="<?php echo stripslashes(htmlspecialchars($data['membre_pseudo'])) ?>" /><br>
		<label for="email">Adresse E-Mail :</label>
		<input type="text" name="email" id="email"
		value="<?php echo stripslashes(htmlspecialchars($data['membre_email'])) ?>" /><br>
		<label for="champis">Champis :</label>
		<input type="text" name="champis" id="champis"
		value="<?php echo stripslashes(htmlspecialchars($data['membre_champi'])) ?>" /><br>
		<label for="tchampis">Total Champis :</label>
		<input type="text" name="tchampis" id="tchampis"
		value="<?php echo stripslashes(htmlspecialchars($data['champi_total'])) ?>" /><br>
		<label for="couleur">Couleur :</label>
		<input type="text" name="couleur" id="couleur"
		value="<?php echo stripslashes(htmlspecialchars($data['membre_couleur'])) ?>" /><br>
		<label for="ip">IP :</label>
		<?php echo $data['ip'] ?><br><br>
		<label for="useragent">User Agent :</label>
		<?php echo $data['useragent'] ?><br>

		</fieldset>
			   
		<fieldset><legend>Profil sur le site</legend>
        Avatar : <input type="file" name="avatar"></input>
        (Taille maximale : 150x150px et 100 Ko)<br><br>
        <label><input type="checkbox" name="delete" value="Delete" />
        Supprimer l'avatar</label>
        <br><br><hr>Avatar actuel :
		<?php echo'<img src="../'.$data['membre_avatar'].'" alt="Pas d\'avatar" />' ?>
		<hr>Signature : <textarea cols="40" rows="4" name="signature" id="signature"><?php echo $data['membre_signature'] ?></textarea>
		<br>
		</fieldset>
		<?php
		echo'<input type="hidden" value="'.stripslashes($membre).'" name="membre">
		<input type="hidden" value="1" name="sent">
		<input class="button" type="submit" value="Modifier le profil" /></form>';
            }
            else echo' <p>Erreur : Ce membre n\'existe pas, cliquez <a href="./membres.php">ici</a> pour réessayez</p>';
    } else { // Traitement

$signature = $_POST['signature'];
    $email = $_POST['email'];
	$champis = $_POST['champis'];
	$tchampis = $_POST['tchampis'];
	$couleur = $_POST['couleur'];
    $pseudo = $_POST['pseudo'];
	$membre = $_POST['membre'];
	$avatar = $_FILES['avatar'];
        //Une nouveauté ici : on peut choisis de supprimer l'avatar
        if (isset($_POST['delete']))
        {
                $query=$db->prepare('UPDATE forum_membres SET membre_avatar= :ava WHERE membre_id = :id');
                $query->bindValue(':id',$membre,PDO::PARAM_STR);
                $query->bindValue(':ava',"images/avadefaut.jpg",PDO::PARAM_STR);
                $query->execute();
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

// On récupère l'extension du fichier
$extension_fichier = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);

// deuxième vérification d'extension
if (!in_array($extension_fichier, $extensions_valides))
    {
        echo "Impossible d'uploader ce type de fichier";
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


        if ($i==0) {

        if (!empty($_FILES['avatar']['size']))
        {

function move_avatarM($avatar)
{
    $extension_upload = strtolower(substr(  strrchr($avatar['name'], '.')  ,1));
    $name = $membre.'-'.time();
    $nomavatar ="../images/avatars/". str_replace(' ','',$name).".".$extension_upload;
    $name = "../images/avatars/". str_replace(' ','',$name).".".$extension_upload;
    move_uploaded_file($avatar['tmp_name'],$name);
    return $nomavatar;
}
                $nomavatar=move_avatarM($_FILES['avatar']);
                $change=$db->prepare('UPDATE forum_membres SET membre_avatar = :avatar WHERE membre_id = :membre');
                $change->bindValue(':avatar',$nomavatar,PDO::PARAM_STR);
                $change->bindValue(':id',$_POST['membre'],PDO::PARAM_INT);
                $change->execute() or die(print_r($change->errorInfo()));
        }

        echo'<h1>Modification terminée</h1>';
        echo'<p>Le profil a été modifié avec succès !</p>';
        echo'<p>Cliquez <a href="./index.php">ici</a> 
        pour revenir à la page d\'accueil de la modération.</p>';
 
        //On modifie la table
		
			
        $modifProfil=$db->prepare('UPDATE forum_membres SET membre_pseudo = :pseudo, membre_email=:mail, membre_signature=:sign, membre_champi=:champis, champi_total=:tchampis, membre_couleur=:couleur
        WHERE membre_id=:membre');
        $modifProfil->bindValue(':pseudo',$pseudo,PDO::PARAM_STR);
        $modifProfil->bindValue(':mail',$email,PDO::PARAM_STR);
        $modifProfil->bindValue(':sign',$signature,PDO::PARAM_STR);
        $modifProfil->bindValue(':champis',$champis,PDO::PARAM_INT);
        $modifProfil->bindValue(':tchampis',$tchampis,PDO::PARAM_INT);
		$modifProfil->bindValue(':couleur',$couleur,PDO::PARAM_STR);
        $modifProfil->bindValue(':membre',$_POST['membre'],PDO::PARAM_INT);
        $modifProfil->execute() or die(print_r($modifProfil->errorInfo()));
 
		$notejournaladmin = 'L\'utilisateur '.$data['membre_pseudo'].' vient de modifier le profil de '.$pseudo.' (ID:'.$membre.').';
		
        $query2 = $db->prepare('INSERT INTO journalmodo(date,note) VALUES(:date, :note)');
		$query2->bindValue(':date',time(),PDO::PARAM_STR);
		$query2->bindValue(':note',$notejournaladmin,PDO::PARAM_STR);
		$query2->execute();
	    }
}
}

include("../includes/fin.php");
?>