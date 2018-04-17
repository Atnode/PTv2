<?php
session_start();
$titre = "Planète Toad &bull; Tennindo";
$descript = "Le Tennindo est une parodie de Nintendo. Tout ce qui est présent est bien sûr faux et est fait pour que vous vous détendiez.";
include("includes/identifiants.php");
include("includes/debut.php");
include("includes/menu.php");
?>

  <dialog class="mdl-dialog">
    <div class="mdl-dialog__title">Fusion du Tennindo et des chroniques</div>
    <div class="mdl-dialog__content">
      <p>
        Le Tennindo n'existe plus désormais. Si vous voulez retrouver le Tennindo, allez dans les chroniques.
      </p>
    </div>
    <div class="mdl-dialog__actions">
      <button type="button" class="mdl-button close">D'accord</button>
    </div>
  </dialog>

  <script>
    var dialog = document.querySelector('dialog');
    var showDialogButton = document.querySelector('#show-dialog');
    if (! dialog.showModal) {
      dialogPolyfill.registerDialog(dialog);
    }
      dialog.showModal();

    dialog.querySelector('.close').addEventListener('click', function() {
      dialog.close();
    });
  </script>

<div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> Tennindo</div><br />
<h1>Tennindo</h1>
<div style="text-align:center;"><img src="/images/tennindo.png" alt="Tennindo" title="Tennindo" />
<br>Le Tennindo est un concept révolutionnaire : il transforme l'actualité Nintendo en une parodie faite pour vous détendre et caricaturer l'actualité.</div>
<?php
$retour = $db->query('SELECT * FROM tennindo LEFT JOIN forum_membres ON membre_id = posteur_id ORDER BY id DESC') or die(print_r($db->errorInfo()));
echo'<div style="padding-left:4px;">';
while ($donnees = $retour->fetch())
{
$titreurl=nettoyage($donnees['titre']);
$recente = time () - $donnees['timestamp'];
echo'<br>'; 
if ($recente<604800) { echo'<div class="commentaires" style="display:table;vertical-align:middle;background-color:#DBFFE8;padding:10px;">';
} else { echo'<div class="commentaires" style="display:table;vertical-align:middle;padding:10px;">'; } ?>
<div style="display:table-cell;width:80px;"><img src="<?php echo $donnees['image']; ?>" alt="Image Tennindo" title="Image Tennindo" style="max-width:75px;max-height:75px;border-radius:50%;" /></div><div style="display:table-cell;vertical-align:middle;">
<?php if ($recente<604800) {	?>
<a href="/tenninews-<?php echo $donnees['id']; ?>-<?php echo $titreurl; ?>.html" title="news" style="margin-left:3px;color:darkgreen"><b><?php echo $donnees['titre']; ?></b></a>
<?php } else { ?>
<a href="/tenninews-<?php echo $donnees['id']; ?>-<?php echo $titreurl; ?>.html" title="news" style="margin-left:3px;"><b><?php echo $donnees['titre']; ?></b></a>
<?php } 
$TotalDesCommentaires = $db->query('SELECT COUNT(*) FROM commentairest WHERE id_news = '.$donnees['id'].'')->fetchColumn(); // On compte le nombre de commentaires ici
echo'<br>'.$TotalDesCommentaires.' commentaires(s) &bull; ';
if (date('d/m/Y', $donnees['timestamp'])==date('d/m/Y',time())) { echo'Publiée aujourd\'hui à '.date('H:i',$donnees['timestamp']).''; } else {
echo'Publiée le '.date('d/m/Y à H\hi', $donnees['timestamp']).'';
} echo'</div></div>';
}
echo'</div>';
include("includes/fin.php");
?>