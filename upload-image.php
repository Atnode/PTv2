<?php
session_start();
$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
if ($id==0) header('Location: erreur_403.html');
$titre = "Planète Toad &bull; Upload une image";
include("includes/identifiants.php");
include("includes/debut.php");
include("includes/menu.php");
if ($lvl==3 OR $lvl==4 OR $lvl==5) {
?>
<div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> -->  <a href="/upload-image.php">Upload Image</a></div><br>
<h1>Upload Image</h1><br>
Bon cet espace vous servira à attribuer une image pour une news (les trucs de l'index quoi). Attention elle devra pas dépasser 230X170px sinon !!!!
<?php
    if (empty($_POST['idnews'])) {
        echo '<form method="post" action="upload-image.php" enctype="multipart/form-data">       
               
        Image : <input type="file" name="avatar"></input>
        (Taille maximale : 230x170px et 200 Ko)<br><br>
        <br>
        <label for="nameI">Nom de l\'image :</label> <input type="text" name="nameI" id="nameI" value="" /><br>
        <label for="idnews">ID news :</label><input type="text" name="idnews" id="idnews" value="" /><br>
        <p><div style="text-align:center;"><input class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit" value="Envoyer" /></div>
        </p></form>';
    } else {

$i = 0;
$nameI = $_POST['nameI'];
$idnews = $_POST['idnews'];
$avatar = $_FILES['avatar'];

if (!empty($_FILES['avatar']['size'])) {
        $maxsize = 204800; //Poids de l'image
        $maxwidth = 230; //Largeur de l'image
        $maxheight = 170; //Longueur de l'image
        $extensions_valides = array( 'jpg' , 'jpeg' , 'png', 'bmp' );
 
        if ($_FILES['avatar']['error']>0)
        {
	     $i++;
        $avatar_erreur = "Erreur lors du tranfsert de l'avatar : ";
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

if (empty($nameI) OR empty($idnews) OR empty($_FILES['avatar']['size'])) {
	$i++;
                $avatar_erreur4 = "JSPP";
}

if ($i==0) {

	    if (!empty($_FILES['avatar']['size'])) {
                $nomavatarNews = move_news($avatar);
                $change=$db->prepare('UPDATE news SET image = :nomavatar WHERE id = :idnews');
                $change->bindValue(':nomavatar',$nomavatarNews,PDO::PARAM_STR);
                $change->bindValue(':idnews',$idnews,PDO::PARAM_INT);
                $change->execute() or die(print_r($change->errorInfo()));
                $change->closeCursor();

                echo'<br><br>Image uploadée<br>';
        }
} else {
        echo'<h1>Modification interrompue</h1>';
        echo'<p>Une ou plusieurs erreurs se sont produites pendant la modification de l\'image de news.</p>';
        echo'<p>'.$i.' erreur(s)</p>';
        echo'<p>'.$avatar_erreur.'</p>';
        echo'<p>'.$avatar_erreur1.'</p>';
        echo'<p>'.$avatar_erreur2.'</p>';
        echo'<p>'.$avatar_erreur3.'</p>';
        echo'<p>'.$avatar_erreur4.'</p>';
   }
}
}
include("includes/fin.php");
?>