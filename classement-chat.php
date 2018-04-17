<?php
session_start();
$titre = "Planète Toad &bull; Classement des membres qui postent le plus de messages sur le chat";
$descrip = "Page qui indique les 30 membres qui postent le plus de messages sur le chat";
include("includes/identifiants.php");
include("includes/debut.php");
include("includes/menu.php");
?>
<div id="filariane">>> <a href="./">Index</a> --> Classement</div>
<br><h1>Classement</h1>
<?php
$Number = 1;
if ($id!=0) {
$query = $db->prepare('SELECT * FROM forum_membres WHERE membre_id = '.$id.'');
$query->execute();
$data = $query->fetch();
$msgchat = $data['msgchat'];

$beforeMember = $db->prepare('SELECT * FROM forum_membres WHERE msgchat > '.$msgchat.'');
$beforeMember->execute();
$rangmemberM = $beforeMember->rowCount();
$rangmember = $rangmemberM + 1;

echo'<p style="text-align:center;margin:5px;">Vous êtes à la <b>'.$rangmember.'ème</b> place du classement avec <b>'.$msgchat.'</b> messages.</p><br>'; }

$retour = $db->prepare('SELECT * FROM forum_membres ORDER BY msgchat DESC LIMIT 0, 30 ');
$retour->execute();
echo'<table style="width:100%;" class="mdl-data-table mdl-js-data-table mdl-shadow--2dp"><thead>
        <tr>
          <th>POSITION</th>
          <th class="mdl-data-table__cell--non-numeric">MEMBRE</th>
          <th>MESSAGES SUR LE CHAT</th>
        </tr>
      </thead>
      <tbody>
';
while ($donnees = $retour->fetch())
{
echo'<tr>
          <td>'.$Number.'</td>
          <td class="mdl-data-table__cell--non-numeric"><a href="/profil-'.$donnees['membre_id'].'.html" style="color:'.$donnees['membre_couleur'].';">'.$donnees['membre_pseudo'].'</a></td>
          <td>'.$donnees['msgchat'].'</td>
        </tr>';
$Number++;
}
echo'</tbody></table>';
include("includes/fin.php");
?>