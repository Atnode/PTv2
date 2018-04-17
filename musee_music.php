<?php
//Cette fonction doit être appelée avant tout code html
session_start();
$titre = "Planète Toad &bull; JukeBox";
$descrip = "La Zone Bonus contient des mini-jeux en flash disponibles uniquement en ligne sur Planète Toad.";
include("includes/identifiants.php");
include("includes/debut.php");
include("includes/menu.php");
?>
<div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> <a href="./musee_index.html">Musée Toad</a> --> <a href="./musee_music.html">Juke-box</a></div><br />
<h1>Musée Toad</h1>
<?php
if ($id!=0) 
{
	echo'<h2>JukeBox</h2>
	
<p>Bienvenue dans la JukeBox, ici vous pouvez écouter la musique tirée des jeux Mario. Les jeux sont triés par ordre de sortie.</p>

<h2>Super Mario Bros (NES - 1985)</h2>

<a href="./music/SMB (NES) - Main Theme.mp3">Theme Principal / Overworld</a><br/>
<a href="./music/SMB (NES) - Underground.mp3">Niveau souterrain</a><br/>
<a href="./music/SMB (NES) - Underwater.mp3">Niveau sous-marin</a><br/>
<a href="./music/SMB (NES) - Castle.mp3">Château</a><br/>
<a href="./music/SMB (NES) - Star.mp3">Etoile</a><br/>
<a href="./music/SMB (NES) - Ending.mp3">Fin du jeu</a><br/>

<h2>Super Mario Bros 2 (USA) (NES - 1988)</h2>

<a href="./music/Super Mario Bros 2 (NES) Music - Title Theme.mp3">Ecran Titre</a><br/>
<a href="./music/Super Mario Bros 2 (NES) Music - Character Select.mp3">Choix du personnage</a><br/>
<a href="./music/Super Mario Bros 2 (NES) Music - Overworld Theme.mp3">Theme Principal / Overworld</a><br/>
<a href="./music/Super Mario Bros 2 (NES) Music - Cave Theme.mp3">Cavernes</a><br/>
<a href="./music/Super Mario Bros 2 (NES) Music - Dark World.mp3">Subspace</a><br/>
<a href="./music/Super Mario Bros 2 (NES) Music - Star Theme.mp3">Etoile</a><br/>
<a href="./music/Super Mario Bros 2 (NES) Music - Boss battle.mp3">Combat de boss</a><br/>
<a href="./music/Super Mario Bros 2 (NES) Music - Wart Battle.mp3">Boss Final (Wart)</a><br/>
<a href="./music/Super Mario Bros 2 (NES) Music - Ending Theme.mp3">Fin du jeu</a><br/>

<h2>Super Mario Bros 3 (NES - 1991)</h2>

<a href="./music/Super Mario Bros 3 (NES) Music - Airship Theme.mp3">Bateau volant</a><br/>
<a href="./music/Super Mario Bros 3 (NES) Music - Boss Theme.mp3">Boss</a><br/>
<a href="./music/Super Mario Bros 3 (NES) Music - Bowser Theme.mp3">Bowser</a><br/>
<a href="./music/Super Mario Bros 3 (NES) Music - Castle Theme.mp3">Château</a><br/>
<a href="./music/Super Mario Bros 3 (NES) Music - Ending Theme.mp3">Fin du jeu</a><br/>
<a href="./music/Super Mario Bros 3 (NES) Music - Hammer Bros.mp3">Frères Marto	</a><br/>
<a href="./music/Super Mario Bros 3 (NES) Music - Music Box.mp3">Boîte à Musique</a><br/>
<a href="./music/Super Mario Bros 3 (NES) Music - Hammer Bros.mp3">Frères Marto	</a><br/>
<a href="./music/Super Mario Bros 3 (NES) Music - Overworld Theme 1.mp3">Overworld 1 / Thème Principal</a><br/>
<a href="./music/Super Mario Bros 3 (NES) Music - Overworld Theme 2.mp3">Overworld 3</a><br/>
<a href="./music/Super Mario Bros 3 (NES) Music - Sky Theme.mp3">Thème du Ciel<a><br/>
<a href="./music/Super Mario Bros 3 (NES) Music - Spade Bonus.mp3">Spade Bonus</a><br/>
<a href="./music/Super Mario Bros 3 (NES) Music - Star Theme.mp3">Etoile</a><br/>
<a href="./music/Super Mario Bros 3 (NES) Music - Toads Items.mp3">Maison de Toad</a><br/>
<a href="./music/Super Mario Bros 3 (NES) Music - Underground Theme.mp3">Niveau souterrain</a><br/>
<a href="./music/Super Mario Bros 3 (NES) Music - Underwater Theme.mp3">Niveau sous-marin</a><br/>
<a href="./music/Super Mario Bros 3 (NES) Music - World Map 1.mp3">Monde 1</a><br/>
<a href="./music/Super Mario Bros 3 (NES) Music - World Map 2.mp3">Monde 2</a><br/>
<a href="./music/Super Mario Bros 3 (NES) Music - World Map 3.mp3">Monde 3</a><br/>
<a href="./music/Super Mario Bros 3 (NES) Music - World Map 4.mp3">Monde 4</a><br/>
<a href="./music/Super Mario Bros 3 (NES) Music - World Map 5.mp3">Monde 5</a><br/>
<a href="./music/Super Mario Bros 3 (NES) Music - World Map 6.mp3">Monde 6</a><br/>
<a href="./music/Super Mario Bros 3 (NES) Music - World Map 7.mp3">Monde 7</a><br/>
<a href="./music/Super Mario Bros 3 (NES) Music - World Map 8.mp3">Monde 8</a><br/>

<h2>Super Mario World (SNES - 1992)</h2>

<a href="./music/SMW/Bonus Screen - Super Mario World.mp3">Salle bonus</a><br/>
<a href="./music/SMW/Castle Theme - Super Mario World.mp3">Château</a><br/>
<a href="./music/SMW/Donut Plains - Super Mario World.mp3">Plaine Beignets</a><br/>	
<a href="./music/SMW/Ending Theme - Super Mario World.mp3">Crédits</a><br/>
<a href="./music/SMW/Forest of Illusion - Super Mario World.mp3">Forêt Illusoire</a><br/>
<a href="./music/SMW/Ghost House - Super Mario World.mp3">Maison Hantée</a><br/>
<a href="./music/SMW/Invincible Theme - Super Mario World.mp3">Etoile</a><br/>
<a href="./music/SMW/Koopa Castle Emerges - Super Mario World.mp3">L\'arrivé du château de Bowser</a><br/>
<a href="./music/SMW/Koopa Kid Castle Clear - Super Mario World.mp3">Château terminé</a><br/>
<a href="./music/SMW/Overworld Theme - Super Mario World.mp3">Overworld / plaine</a><br/>
<a href="./music/SMW/Special World - Super Mario World.mp3">Monde spécial</a><br/>
<a href="./music/SMW/Star Road - Super Mario World.mp3">Route étoile</a><br/>
<a href="./music/SMW/Super Mario World Music - Athletic.mp3">Niveau aérien</a><br/>	
<a href="./music/SMW/Super Mario World Music - Title Theme.mp3">Ecran Titre</a><br/>
<a href="./music/SMW/Switch - Super Mario World.mp3">Switch</a><br/>
<a href="./music/SMW/The Evil King Bowser - Super Mario World.mp3">Combat contre Bowser : Première partie</a><br/>
<a href="./music/SMW/The Evil King Bowser (Final) - Super Mario World.mp3">Combat contre Bowser : Deuxième partie</a><br/>
<a href="./music/SMW/Underground Theme - Super Mario World.mp3">Niveau souterrain</a><br/>
<a href="./music/SMW/Underwater Theme - Super Mario World.mp3">Niveau sous-marin</a><br/>
<a href="./music/SMW/Valley of Bowser - Super Mario World.mp3">Vallée de Bowser</a><br/>
<a href="./music/SMW/Vanilla Dome - Super Mario World.mp3">Dôme Vanille</a><br/>
<a href="./music/SMW/Yoshi\'s Island - Super Mario World.mp3">Île des Yoshis</a><br/>

<h2>New Super Mario Bros (DS - 2006)</h2>

<a href="./music/NSMB/Athletic Theme.mp3">Niveau aérien</a><br/>
<a href="./music/NSMB/Beach Overworld Theme.mp3">Plage</a><br/>
<a href="./music/NSMB/Bowser Jr Battle Theme.mp3">Combat contre Bowser Jr.</a><br/>
<a href="./music/NSMB/Castle Boss Battle.mp3">Combat de boss</a><br/>
<a href="./music/NSMB/Castle Theme.mp3">Château</a><br/>
<a href="./music/NSMB/Desert Overworld Theme.mp3">Desert</a><br/>
<a href="./music/NSMB/Etoile.mp3">Etoile</a><br/>
<a href="./music/NSMB/Final Bowser Battle.mp3">Boss Final contre Bowser</a><br/>
<a href="./music/NSMB/Fortress Theme.mp3">Tour</a><br/>
<a href="./music/NSMB/Haunted Mansion Theme.mp3">Maison hantée</a><br/>
<a href="./music/NSMB/Lava Overworld Theme.mp3">Niveau volcanique</a><br/>
<a href="./music/NSMB/Mega Mushroom.mp3">Méga Champignon</a><br/>
<a href="./music/NSMB/Select MiniGame.mp3">Choix du mini-jeu</a><br/>
<a href="./music/NSMB/Overworld (Versus Mode).mp3">Niveau classique en Mode multijoueur</a><br/>
<a href="./music/NSMB/Overworld Theme.mp3">Plaine / Thème principal</a><br/>
<a href="./music/NSMB/Prologue.mp3">Prologue</a><br/>
<a href="./music/NSMB/Secret.mp3">Salle Bonus</a><br/>
<a href="./music/NSMB/Snow Overworld (Versus Mode).mp3">Niveau dans la neige en mode multijoueur</a><br/>
<a href="./music/NSMB/Title Theme.mp3">Ecran Titre</a><br/>
<a href="./music/NSMB/Underground Theme.mp3">Niveau souterrain</a><br/>
<a href="./music/NSMB/Underwater Theme.mp3">Niveau sous-marin</a><br/>
<a href="./music/NSMB/Versus Menu Screen.mp3">Mode multijoueur : Menu</a><br/>
<a href="./music/NSMB/Versus Results Screen.mp3">Résultat mode multijoueur</a><br/>
<a href="./music/NSMB/World 1.mp3">Monde 1</a><br/>
<a href="./music/NSMB/World 2.mp3">Monde 2</a><br/>
<a href="./music/NSMB/World 3.mp3">Monde 3</a><br/>
<a href="./music/NSMB/World 4.mp3">Monde 4</a><br/>
<a href="./music/NSMB/World 5.mp3">Monde 5</a><br/>
<a href="./music/NSMB/World 6.mp3">Monde 6</a><br/>
<a href="./music/NSMB/World 7.mp3">Monde 7</a><br/>
<a href="./music/NSMB/World 8.mp3">Monde 8</a><br/>

';
	
}
else
{
	echo'<h2>JukeBox</h2>
		
		<p>La JukeBox n\'est accessible qu\' aux membres.</p>
';
}
include("includes/fin.php");
?>