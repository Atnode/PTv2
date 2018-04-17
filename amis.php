<?php
session_start();
$titre="Planète Toad &bull; Gestion des amis";
$descript = "Vous pouvez gérer vos amis sur le site, en ajouter, leur envoyer un MP.";
include("includes/identifiants.php");
$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
if ($id==0) header('Location: erreur_403.html'); 
include("includes/debut.php");
include("includes/menu.php");
$action = isset($_GET['action'])?htmlspecialchars($_GET['action']):'';

echo '<div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> <a href="./amis.html">Gestion des amis</a></div><br>';
//Le titre
echo '<h1>Gestion des amis</h1>';
    if (!isset($_POST['pseudo'])) {
    echo '<h2>Ajouter un ami</h2>
    <form action="amis.html" method="post">
    <p><label for="pseudo">Entrez le pseudo</label>
    <input type="text" name="pseudo" id="pseudo" />
    <input class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit" value="Envoyer" />
    </p></form>';
    } else {
        $pseudo_d = $_POST['pseudo'];
        //On vérifie que le pseudo renvoit bien quelque chose 

        $query=$db->prepare('SELECT membre_id, COUNT(*) AS nbr FROM forum_membres 
        WHERE LOWER(membre_pseudo) = :pseudo GROUP BY membre_pseudo');
        $query->bindValue(':pseudo',strtolower($pseudo_d),PDO::PARAM_STR);
        $query->execute();
        $data = $query->fetch();
        $pseudo_exist = $data['nbr'];
        $i = 0;
        $id_to=$data['membre_id'];
        if(!$pseudo_exist) {
            echo '<p align="center">Ce membre ne semble pas exister<br />
            Cliquez <a href="./amis.html">ici</a> pour réessayer</p>';
            $i++;
        }
        $query->closeCursor();
        $query = $db->prepare('SELECT COUNT(*) AS nbr FROM forum_amis 
        WHERE ami_from = :id AND ami_to = :id_to
        OR ami_from = :id AND ami_to = :id_to');
        $query->bindValue(':id',$id,PDO::PARAM_INT);
        $query->bindValue(':id_to', $id_to, PDO::PARAM_INT);
        $query->execute();
        $deja_ami=$query->fetchColumn();
        $query->closeCursor();

        if ($deja_ami != 0) {
            echo '<p align="center">Ce membre fait déjà parti de vos amis ou a déjà fait une demande.<br>
            Cliquez <a href="./amis.html">ici</a> pour réessayer</p>';
            $i++;
        }
        if ($id_to == $id)
        {
            echo '<p align="center">Vous ne pouvez pas vous ajouter vous même<br>Cliquez sur <a href="./amis.html">ici</a> pour réessayer</p>';
            $i++;
        }
        if ($i == 0) {
            $query=$db->prepare('INSERT INTO forum_amis (ami_from, ami_to, ami_confirm, ami_date) VALUES(:id, :id_to, :conf, :temps)');
            $query->bindValue(':id',$id,PDO::PARAM_INT);
            $query->bindValue(':id_to', $id_to, PDO::PARAM_INT);
            $query->bindValue(':conf','0',PDO::PARAM_STR);
            $query->bindValue(':temps', time(), PDO::PARAM_INT);
            $query->execute();
            echo '<p align="center"><a href="/profil-'.$data['membre_id'].'.html">'.stripslashes(htmlspecialchars($pseudo_d)).'</a> 
            a bien été ajouté à vos amis, il faut toutefois qu\'il donne son accord.<br />
            Cliquez <a href="./index.html">ici</a> pour retourner à l\'accueil<br />
            Cliquez <a href="./amis.html">ici</a> pour retourner à la page de la gestion de vos amis</p>';
        }
    }
    $add = (isset($_GET['add']))?htmlspecialchars($_GET['add']):0;
    if (empty($add)) {
        $query = $db->prepare('SELECT ami_from, ami_date, membre_pseudo, membre_avatar FROM forum_amis
        LEFT JOIN forum_membres ON membre_id = ami_from
        WHERE ami_to = :id AND ami_confirm = :conf
        ORDER BY ami_date DESC');
        $query->bindValue(':id',$id,PDO::PARAM_INT);
        $query->bindValue(':conf','0',PDO::PARAM_STR); 
        $query->execute();


        if ($query->rowCount()>0)
        {
        	echo'<h2>Demandes en attente</h2>';
        while ($data = $query->fetch())
        {
            echo '<div class="commentaires"><table><tbody><tr><td><a href="/profil-'.$data['ami_from'].'.html"><img src="'.$data['membre_avatar'].'" alt="amis" title="'.$data['membre_pseudo'].'" style="max-height:130px;max-width:130px;border-radius:50%;" /></a></td>
<td style="vertical-align:middle;padding-left:15px;"><a href="/profil-'.$data['ami_from'].'.html" style="color:'.$data['membre_couleur'].';">'.$data['membre_pseudo'].'</span></a><br><br>';
$idMec = $data['membre_id'];
echo'<a href="./amis.html?action=check&amp;add=ok&amp;m='.$data['ami_from'].'" class="buyButton" style="color:#00ff00!important;border-color:#00ff00!important;background:transparent;font-size:12px;text-shadow:0 0 0;">Accepter l\'invitation</a>&nbsp;&nbsp;&nbsp;
<a href="./amis.html?action=delete&amp;m='.$data['ami_from'].'" class="buyButton" style="color:orangered!important;border-color:orangered!important;background:transparent;font-size:12px;text-shadow:0 0 0;">Refuser l\'invitation</a>';
echo'</td></tr></tbody></table></div><br><br>';
        } }
        $query->closeCursor();
    } else {
        $membre = (int) $_GET['m'];
              
        $reqNotif = $db->prepare('INSERT INTO notifs (id_receveur, image, text, time, lu) VALUES(:membre, :image, :text, :time, :lu)');
        $reqNotif->bindValue(':membre',$membre,PDO::PARAM_INT);
        $reqNotif->bindValue(':image',$avatar,PDO::PARAM_STR);
        $reqNotif->bindValue(':text',"<a href=\"/profil-".$id.".html\" style=\"font-weight:bold;color:".$couleur."\">".$pseudo."</a> a bien accepté votre demande d'amitié. Vous êtes dorénavant amis et pourrez vous échanger des MP",PDO::PARAM_STR);
        $reqNotif->bindValue(':time',time(),PDO::PARAM_INT);
        $reqNotif->bindValue(':lu','0',PDO::PARAM_INT);               
        $reqNotif->execute() or die(print_r($reqNotif->errorInfo()));
		
		//La publi qui annonce
		$IDPSEUDO = $db->prepare('SELECT * FROM forum_membres WHERE membre_id = '.$membre.'');
		$IDPSEUDO->execute();
		$idps = $IDPSEUDO->fetch();
		$msgPUBLI = "[b][couleur=".$couleur."]".$pseudo."[/couleur][/b] et [url=/profil-".$membre.".html][b][couleur=".$idps['membre_couleur']."]".$idps['membre_pseudo']."[/couleur][/b][/url] sont désormais amis.";

		$publication = $db->prepare('INSERT INTO publications (id_posteur, id_receveur, message, timestamp, officielle) VALUES(:id, :id, :msgPUBLI, :time, :officielle)');
		$publication->bindValue(':id',$id,PDO::PARAM_INT);
        $publication->bindValue(':msgPUBLI',$msgPUBLI,PDO::PARAM_STR);  
        $publication->bindValue(':time',time(),PDO::PARAM_INT);
        $publication->bindValue(':officielle',"1",PDO::PARAM_INT);
        $publication->execute();

        $query = $db->prepare('UPDATE forum_amis SET ami_confirm = :conf  WHERE ami_from = :membre AND ami_to = :id');
        $query->bindValue(':conf','1',PDO::PARAM_STR);
        $query->bindValue(':membre',$membre,PDO::PARAM_INT);
        $query->bindValue(':id',$id,PDO::PARAM_INT);
        $query->execute();
        echo '<p align="center">Ce membre a bien été ajouté à votre liste d\'amis.<br>
        Cliquez <a href="./amis.html">ici</a> pour retourner à la liste des amis';
    }
switch($action)
{
case "delete":
    $membre = $_GET['m'];
    if (!isset($_GET['ok']))
    {
        echo '<p align="center">Etes-vous certain de vouloir supprimer ce membre ?<br />
        <a href="./amis.html?action=delete&amp;ok=ok&amp;m='.$membre.'">Oui</a> - <a href="./amis.html">Non</a></p>';
    } else {
        $reqNotif = $db->prepare('INSERT INTO notifs (id_receveur, image, text, time, lu) VALUES(:membre, :image, :msg, :time, :lu)');
        $reqNotif->bindValue(':membre',$membre,PDO::PARAM_INT);
        $reqNotif->bindValue(':image',$avatar,PDO::PARAM_STR);
        $reqNotif->bindValue(':msg',"<a href=\"/profil-".$id.".html\" style=\"font-weight:bold;color:".$couleur."\">".$pseudo."</a> a malheureusement refusé votre demande d'amitié",PDO::PARAM_STR);
        $reqNotif->bindValue(':time',time(),PDO::PARAM_INT);
        $reqNotif->bindValue(':lu','0',PDO::PARAM_INT);               
        $reqNotif->execute() or die(print_r($reqNotif->errorInfo()));

        $query = $db->prepare('DELETE FROM forum_amis WHERE (ami_from = :membre AND ami_to = :id) OR (ami_to = :membre AND ami_from = :id)');
        $query->bindValue(':membre',$membre,PDO::PARAM_INT);
        $query->bindValue(':id',$id,PDO::PARAM_INT);
        $query->execute();
        $query->closeCursor();
        echo '<p align="center">Ce membre a bien été supprimé de votre liste d\'amis. <br />
        Cliquez <a href="./amis.html">ici</a> pour retourner à la liste des amis</p>';
    }
break;
default:

    $searchAmis = $db->prepare('SELECT (ami_from + ami_to - :id) AS ami_id, ami_date, membre_id, membre_pseudo, membre_couleur, membre_derniere_visite, membre_avatar
    FROM forum_amis
    LEFT JOIN forum_membres ON membre_id = (ami_from + ami_to - :id)
    WHERE (ami_from = :id OR ami_to = :id) AND ami_confirm = :conf ORDER BY membre_pseudo');
    $searchAmis->bindValue(':id',$id,PDO::PARAM_INT);       
    $searchAmis->bindValue(':conf','1',PDO::PARAM_STR);
    $searchAmis->execute();

	    if ($searchAmis->rowCount()<1) {
        echo '<p align="center">Vous n\'avez aucun ami pour l\'instant.</p>';
    } else {
    	echo'<h2>Amis</h2><br>
        Vous avez <b>'.$searchAmis->rowCount().'</b> amis.';
    while ($data2 = $searchAmis->fetch())
    {
echo '<div class="commentaires"><table><tbody><tr><td><a href="/profil-'.$data2['membre_id'].'.html"><img src="'.$data2['membre_avatar'].'" alt="amis" title="'.$data2['membre_pseudo'].'" style="max-height:130px;max-width:130px;border-radius:50%;" /></a></td>
<td style="vertical-align:middle;padding-left:15px;"><a href="/profil-'.$data2['membre_id'].'.html" style="color:'.$data2['membre_couleur'].';">'.$data2['membre_pseudo'].'</span></a><br><br>';
$idMec = $data2['membre_id'];
echo'<a href="./envoi-mp-dest'.$idMec.'.html" class="buyButton" style="color:rgba(0, 171, 255, 0.78)!important;border-color:rgba(0, 171, 255, 0.78)!important;background:transparent;font-size:12px;text-shadow:0 0 0;"><i class="material-icons">&#xE163;</i> Envoyer un MP</a>';
echo'</td></tr></tbody></table></div><br><br>';
    }
    }
break;
}
include("includes/fin.php");
?>