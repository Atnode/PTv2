<?php
session_start();
$titre="Planète Toad &bull; Poster";
$balises = true;
include("includes/identifiants.php");
include("includes/debut.php");
if ($id==0) header('Location: erreur_403.html');
include("includes/menu.php");
//Qu'est ce qu'on veut faire ? poster, répondre ou éditer ?
$action = (isset($_GET['action']))?htmlspecialchars($_GET['action']):'';

//Si on veut poster un nouveau topic, la variable f se trouve dans l'url,
//On récupère certaines valeurs
if (isset($_GET['f']))
{
    $forum = (int) $_GET['f'];
    $query= $db->prepare('SELECT forum_id, forum_name, auth_view, auth_post, auth_topic, auth_annonce, auth_modo FROM forum_forum WHERE forum_id =:forum');
    $query->bindValue(':forum',$forum,PDO::PARAM_INT);
    $query->execute();
    if ($query->rowCount()<1) { echo'<META http-equiv="refresh" content="0; URL=/erreur_403.html">'; }
    $data=$query->fetch();
    $authtopic = $data['auth_topic'];
    echo '<div id="filariane"><i>Vous êtes ici</i> : <a href="./index.html">Index</a> --> 
    <a href="./forum-'.$data['forum_id'].'.html">'.stripslashes(htmlspecialchars($data['forum_name'])).'</a>
    --> Créer un topic</div><br>';
}
 
//On récupère f grâce à une requête
elseif (isset($_GET['t']))
{
    $topic = (int) $_GET['t'];
    $query=$db->prepare('SELECT topic_titre, forum_topic.forum_id,
    forum_name, auth_view, auth_post, auth_topic, auth_annonce, auth_modo
    FROM forum_topic
    LEFT JOIN forum_forum ON forum_forum.forum_id = forum_topic.forum_id
    WHERE topic_id =:topic');
    $query->bindValue(':topic',$topic,PDO::PARAM_INT);
    $query->execute();
    if ($query->rowCount()<1) { echo'<META http-equiv="refresh" content="0; URL=/erreur_403.html">'; }
    $topicdata=$query->fetch();
    $forum = $topicdata['forum_id'];
    $authtopic = $topicdata['auth_topic'];
    echo '<div id="filariane"><i>Vous êtes ici</i> : <a href="./index.html">Index</a> --> 
    <a href="./forum-'.$data['forum_id'].'.html">'.stripslashes(htmlspecialchars($data['forum_name'])).'</a>
    --> <a href="./topic-'.$topic.'.html">'.stripslashes(htmlspecialchars($data['topic_titre'])).'</a>
    --> Répondre</div><br>';
}
 
//Enfin sinon c'est au sujet de la modération(on verra plus tard en détail)
//On ne connait que le post, il faut chercher le reste
elseif (isset ($_GET['p']))
{
    $post = (int) $_GET['p'];
    $query=$db->prepare('SELECT post_createur, forum_post.topic_id, topic_titre, forum_topic.forum_id,
    forum_name, auth_view, auth_post, auth_topic, auth_annonce, auth_modo
    FROM forum_post
    LEFT JOIN forum_topic ON forum_topic.topic_id = forum_post.topic_id
    LEFT JOIN forum_forum ON forum_forum.forum_id = forum_topic.forum_id
    WHERE forum_post.post_id =:post');
    $query->bindValue(':post',$post,PDO::PARAM_INT);
    $query->execute();
    if ($query->rowCount()<1) { echo'<META http-equiv="refresh" content="0; URL=/erreur_403.html">'; }
    $data=$query->fetch();

    $topic = $data['topic_id'];
    $forum = $data['forum_id'];
 
    echo '<div id="filariane"><i>Vous êtes ici</i> : <a href="./index.html">Index</a> --> 
    <a href="./forum-'.$data['forum_id'].'.html">'.stripslashes(htmlspecialchars($data['forum_name'])).'</a>
    --> <a href="./topic-'.$topic.'.html">'.stripslashes(htmlspecialchars($data['topic_titre'])).'</a>
    --> Modérer un message</div><br>';
}

switch($action) {
 
case "nouveautopic":

if ($lvl>=$authtopic) {
?>
<h1>Créer un topic</h1>
<form method="post" action="action/nouveau-topic.php?f=<?php echo $forum ?>" name="formulaire">
<fieldset><legend>Créer un topic</legend>
<div style="text-align:center;"><b>Titre :</b><div class="margin-top:10px;"></div> <input type="text" id="titre" name="titre" />
<?php
if ($lvl>3) {
echo'<br><br><b>Poster ce sujet en tant que :</b><br><label style="float:none;width:auto;"><input type="radio" name="mess" value="Message" checked="checked" />Topic</label>
<label style="float:none;width:auto;"><input type="radio" name="mess" value="Annonce" />Annonce</label><br />';
}
?>
<b>
<br><?php include("code.php") ?><br>Message :</b><div style="margin-top:10px;"></div><textarea cols="80" rows="8" id="message" name="message"></textarea>
<p>
<input type="submit" name="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" value="Envoyer" />
</fieldset></form>
<?php
}
break;

case "edit": //Si on veut éditer le post
    //On récupère la valeur de p
if (isset ($_GET['p'])) {
    $post = (int) $_GET['p'];
    echo'<h1>Edition</h1>';
 
    //On lance enfin notre requête
        $query = $db->prepare('SELECT topic_first_post FROM forum_topic WHERE topic_id = :topic');
        $query->bindValue(':topic',$topic,PDO::PARAM_INT);
        $query->execute();
        $data_post=$query->fetch(); 
		
        $query = $db->prepare('SELECT * FROM forum_topic WHERE topic_id = :topic');
        $query->bindValue(':topic',$topic,PDO::PARAM_INT);
        $query->execute();
        $data_post2=$query->fetch(); 
 
    $query=$db->prepare('SELECT * FROM forum_post LEFT JOIN forum_forum ON forum_post.post_forum_id = forum_forum.forum_id WHERE post_id=:post');
    $query->bindValue(':post',$post,PDO::PARAM_INT);
    $query->execute();
    $data=$query->fetch();

    $text_edit = $data['post_texte']; //On récupère le message

    //Ensuite on vérifie que le membre a le droit d'être ici (soit le créateur soit un modo/admin) 
    if ($data['post_createur']==$id || $lvl>3)
    {
        //Le formulaire de postage
        ?>
        <form method="post" action="postok.php?action=edit&amp;p=<?php echo $post ?>" name="formulaire">
        <br>
        <fieldset style="text-align:center;">
		<?php if ($data_post['topic_first_post']==$post) { ?>
		<input type="text" id="titre" name="titre" value="<?php echo $data_post2['topic_titre'] ?>" /><br><br><br>
        <?php if ($lvl>3) { ?>
        Genre du topic : <select name="genre">
        <option <?php if ($data_post2['topic_genre']=="Message") echo'selected="selected"';?> value="Message">Message</option>
        <option <?php if ($data_post2['topic_genre']=="Annonce") echo'selected="selected"';?> value="Annonce">Annonce</option>
        <option <?php if ($data_post2['topic_genre']=="Annonce Globale") echo'selected="selected"';?> value="Annonce Globale">Annonce Globale</option>
        </select><br><br> <?php } }
        if ($lvl>3) { echo'ID Posteur : <input type="number" id="id_posteur" name="id_posteur" value="'.$data['post_createur'].'" />'; } ?><br><br><br>
		<legend>Message</legend>
		<?php include("code.php") ?>
		<br><textarea cols="80" rows="8" id="message" name="message" style="height:260px;width:90%;"><?php echo $text_edit ?></textarea>
		<br><br><input type="submit" name="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" value="Editer" />
        </fieldset>
        </form>
        <?php
    }}
break; 
case "delete": //Si on veut supprimer le post
    $post = (int) $_GET['p'];
    //Ensuite on vérifie que le membre a le droit d'être ici
    echo'<h1>Suppression</h1>';
    $query=$db->prepare('SELECT post_createur, auth_modo
    FROM forum_post
    LEFT JOIN forum_forum ON forum_post.post_forum_id = forum_forum.forum_id
    WHERE post_id= :post');
    $query->bindValue(':post',$post,PDO::PARAM_INT);
    $query->execute();
    $data = $query->fetch();
 
    if ($lvl>3)
    {
        echo'<p>Êtes-vous certain de vouloir supprimer ce post ?</p>';
        echo'<p><a href="./postok.php?action=delete&amp;p='.$post.'">Oui</a> ou <a href="./">Non</a></p>';
    }
break;

default: //Si jamais c'est aucun de ceux là c'est qu'il y a un problème
echo'<p>Cette action est impossible</p>';
} //Fin du switch
include("includes/fin.php");
?>