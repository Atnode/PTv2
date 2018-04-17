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
        //Une nouveauté ici : on peut choisis de supprimer l'avatar
        if (isset($_POST['delete']))
        {
                $query=$db->prepare('UPDATE forum_membres SET membre_avatar= :ava WHERE membre_id = :id');
                $query->bindValue(':id',$membre,PDO::PARAM_STR);
                $query->bindValue(':ava',"images/avadefaut.jpg",PDO::PARAM_STR);
                $query->execute();
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

include("../includes/fin.php");
?>