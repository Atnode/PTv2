<?php
function code($texte) {
$texte = str_replace(':hap:', '<img src="/images/smileys/hap.gif" title="Smiley hap" width="19" height="19" alt="Smiley hap" />', $texte);
$texte = str_replace(':reddape:', '<img src="/images/smileys/REDDAPE.gif" title="Smiley hap rouge" alt="Smiley hap rouge" />', $texte);
$texte = str_replace(':noreddape:', '<img src="/images/smileys/noreddape.gif" title="Smiley nohap rouge" alt="Smiley nohap rouge" />', $texte);
$texte = str_replace(':a:', '<img src="/images/smileys/a.gif" title="Awesome face" alt="Awesome face" />', $texte);
$texte = str_replace('8D', '<img src="/images/smileys/8D.png" width="19" height="19" title="8D" alt="8D" />', $texte);
$texte = str_replace(':nohap:', '<img src="/images/smileys/nohap.gif" title="No hap" alt="No hap" />', $texte);
$texte = str_replace(':noel:', '<img src="/images/smileys/noel.gif" title="Noël" alt="Noël" />', $texte);
$texte = str_replace(':)', '<img src="/images/smileys/smiley-content.png" width="16" height="16" title="Toad Content" alt="Toadd Content" />', $texte);
$texte = str_replace(':D', '<img src="/images/smileys/super-content.gif" title=" Toad super content" width="16" height="16" alt="Toad super content" />', $texte);
$texte = str_replace(':|', '<img src="/images/smileys/neutre.png" title="Toad Neutre" alt="Toad Neutre" />', $texte);
$texte = str_replace(';)', '<img src="/images/smileys/clin_d_oeil.gif" title="Toad clin d\'oeil " alt="Toad clin d\'\oeil" width="16" height="16" />', $texte);
$texte = str_replace(':(', '<img src="/images/smileys/pas_content.png" title="Toad pas content" alt=" Toad pas content" />', $texte);
$texte = str_replace(':+:', '<img src="/images/smileys/pouce_leve.png" title="Toad positif" alt="Toad positif" />', $texte);
$texte = str_replace(':o', '<img src="/images/smileys/surpris.png" title="surpris" alt="(surpris)" width="16" height="16" />', $texte);
$texte = str_replace(';(', '<img src="/images/smileys/triste.png" title="triste" alt="(triste)" />', $texte);
$texte = str_replace(':p', '<img src="/images/smileys/smiley-langue.png" title="langue" width="16" height="16" alt="(Smiley qui tire la langue)" />', $texte);
$texte = str_replace(':dead:', '<img src="/images/smileys/dead.png" title="dead" alt="(Smiley Mort)" />', $texte);
$texte = str_replace(':rire:', '<img src="/images/smileys/rire.gif" title="rire" alt="(Smiley qui rigole)" />', $texte);
$texte = str_replace(':cool:', '<img src="/images/smileys/cool.png" width="16" height="16" title="cool" alt="(Smiley cool)" />', $texte);
$texte = str_replace(':-:', '<img src="/images/smileys/pouce_baisse.png" title="nopouce" alt="(Pouce baissé)" />', $texte);
$texte = str_replace('/gigahap/', '<img src="/images/smileys/gigahap.gif" title="gigahap" alt="(Hap géant)" />', $texte);
$texte = str_replace('/giganoel/', '<img src="/images/smileys/giganoel.gif" title="giganoel" alt="(Noel géant)" />', $texte);
$texte = str_replace(':toast:', '<img src="/images/smileys/toast.png" title="toast" alt="(Toast)" />', $texte);
$texte = str_replace(':+1:', '<img src="/images/smileys/bulle_+1.png" title="+1" alt="(+1)" />', $texte);
$texte = str_replace(':bref:', '<img src="/images/smileys/bulle_bref.png" title="bref" alt="(Bref...)" />', $texte);
$texte = str_replace(':vivept:', '<img src="/images/smileys/bulle_PT.png" title="vivept" alt="(Vive Planète Toad !)" />', $texte);
$texte = str_replace(':salut:', '<img src="/images/smileys/bulle_salut.png" title="salut" alt="(Salut !)" />', $texte);
$texte = str_replace(':toaddlegenial:', '<img src="/images/smileys/bulle_toaddle.png" title="toaddlegenial" alt="(Toaddle est génial !)" />', $texte);
$texte = str_replace(':tusors:', '<img src="/images/smileys/bulle_tu_sors.png" title="tusors" alt="(Tu sors !)" />', $texte);
$texte = str_replace(':zut:', '<img src="/images/smileys/bulle_zut.png" title="zut" alt="(Zut !)" />', $texte);
$texte = str_replace(':champi:', '<img src="./champi.png" title="champi" alt="Champi" width="15" height="14" />', $texte);
$texte = str_replace(':champoadgenie:', '<img src="/images/smileys/bulle_champoad.png" title="champoadgenie" alt="(Champoad est un génie !)" />', $texte);
$texte = str_replace(':tanktoad:', '<img src="/images/smileys/tanktoad.png" title="tanktoad" alt="(Tank Toad)" />', $texte);
$texte = str_replace(':malou:', '<img src="/images/smileys/bulle_malou.png" title="malou" alt="Mais oui c\'est clair !" />', $texte);
$texte = str_replace(':sandero:', '<img src="/images/smileys/bulle_sandero.png" title="sandero" alt="This is the Dacia Sandero !" />', $texte);
$texte = str_replace(':haha:', '<img src="/images/smileys/haha.gif" title="haha" alt="HAHAHAHAHAHA !" />', $texte);
$texte = str_replace(':mariodance:', '<img src="/images/smileys/dance.gif" title="dance" alt="(Mario qui danse)" />', $texte);
$texte = str_replace(':mariodanse:', '<img src="/images/smileys/dance.gif" title="dance" alt="(Mario qui danse)" />', $texte);
$texte = str_replace(':mariobanane:', '<img src="/images/smileys/mariobanane.gif" title="banane" alt="(Mario qui danse avec une banane)" />', $texte);
$texte = str_replace(':PAF:', '<img src="/images/smileys/paf.gif" title="paf" alt="PAF!" />', $texte);
$texte = str_replace(':nerdz:', '<img src="/images/smileys/nerdz.png" title="Smiley nerdz" alt="Smiley nerdz" />', $texte);
$texte = str_replace(':kdo:', '<img src="/images/smileys/kdo.gif" title="Point K-Do" alt="Point K-Do" />', $texte);
$texte = str_replace(':facepalm:', '<img src="/images/smileys/facepalm.gif" title="Smiley Facepalm" alt="Smiley Facepalm" />', $texte);
$texte = str_replace(':grabspopcorn:', '<img src="/images/smileys/bulle_pop_corn.png" title="Grabs Pop Corn !" alt="Grabs Pop Corn !" />', $texte);
$texte = str_replace(':grabpopcorn:', '<img src="/images/smileys/bulle_pop_corn.png" title="Grab Pop Corn !" alt="Grabs Pop Corn !" />', $texte);
$texte = str_replace(':rire2:', '<img src="/images/smileys/rire2.png" title="Rire2" alt="(Smiley qui rigole 2)" />', $texte);
$texte = str_replace(':swaghap:', '<img src="/images/smileys/swaghap.gif" title="SwagHap" alt="(Swag Hap Maggle !)" />', $texte);
$texte = str_replace('#TournoisEté2016', '<b>#TournoisEté2016</b> <img src="/images/anims.png" title="#TournoisEté2016" alt="#TournoisEté2016" />', $texte);
$texte = str_replace(':happy:', '<img src="/images/smileys/happy.png" title="Smiley happy" alt="Smiley hap rouge" />', $texte);
$texte = str_replace(':hum:', '<img src="/images/smileys/Hum.png" title="Smiley réfléchi" alt="Smiley hap rouge" />', $texte);
$texte = str_replace(':sisi:', '<img src="/images/smileys/sisi.gif" title="Si, si" alt="Si, si" />', $texte);
$texte = str_replace(':8:', '<img src="/images/smileys/note.png" title="^^" alt="^^" />', $texte);
$texte = str_replace(':dab:', '<img src="/images/smileys/dab.png" title="Luigi\'s doing the dab !" alt="Luigi\'s doing the dab !" />', $texte);
$texte = str_replace(':deathstare:', '<img src="/images/smileys/deathstare.png" title="Luigi\'s death stare !" alt="Luigi\'s death stare !" />', $texte);
$texte = str_replace(':milk&cookies:', '<img src="/images/smileys/MilkAndCookies.gif" title="Milk And Cookies !" alt="Milk And Cookies !" />', $texte);
$texte = str_replace(':AH:', '<img src="/images/smileys/AH.png" title="AH !" alt="AH !" />', $texte);

// RPG !!!

		// Cases
$texte = str_replace('{ble}', '<img src="/images/rpg/Case-Simple.png" title="Case Simple" alt="" />', $texte);
$texte = str_replace('{obs}', '<img src="/images/rpg/Case-Obstacle.png" title="Case Obstacle" alt="" />', $texte);
$texte = str_replace('{bns}', '<img src="/images/rpg/Case-Bonus.png" title="Case Bonus" alt="" />', $texte);
$texte = str_replace('{tuy}', '<img src="/images/rpg/Case-Tuyau.png" title="Case Tuyau" alt="" />', $texte);
$texte = str_replace('{vid}', '<img src="/images/rpg/Case-Vide.png" title="Case Vide" alt="" />', $texte);
$texte = str_replace('{dor}', '<img src="/images/rpg/Case-Porte.png" title="Case Porte" alt="" />', $texte);
$texte = str_replace('{key}', '<img src="/images/rpg/Case-Cle.png" title="Case Cle" alt="" />', $texte);

		// Objets
	
$texte = str_replace('{pieceschampis}', '<img src="/images/rpg/Piece-Champi.png" title="Pièce Champi" alt="Pièce Champi" />', $texte);	
$texte = str_replace('{obj:champi}', '<img src="/images/rpg/Objets/Champignon.png" title="Champignon" alt="Champignon" />', $texte);
$texte = str_replace('{obj:1up}', '<img src="/images/rpg/Objets/Champi-up.png" title="Champignon-1up" alt="Champignon-1up" />', $texte);
$texte = str_replace('{obj:champipower}', '<img src="/images/rpg/Objets/Champi-power.png" title="Champignon-Power" alt="Champignon-Power" />', $texte);
$texte = str_replace('{obj:sir}', '<img src="/images/rpg/Objets/Sirop.png" title="Sirop" alt="Sirop" />', $texte);
$texte = str_replace('{obj:cac}', '<img src="/images/rpg/Objets/Cacahuete.png" title="Cacahuete" alt="Cacahuete" />', $texte);
$texte = str_replace('{obj:cook}', '<img src="/images/rpg/Objets/Cookie.png" title="Cookie" alt="Cookie" />', $texte);
$texte = str_replace('{obj:cook-cac}', '<img src="/images/rpg/Objets/Cookie-Cacahuete.png" title="Cookie-Cacahuete" alt="Cookie-Cacahuete" />', $texte);

		// Power-ups
		
$texte = str_replace('{pup:fdefeu}', '<img src="/images/rpg/Power-ups/Fleur-de-Feu.png" title="Fleur De Feu" alt="Fleur De Feu" />', $texte);
$texte = str_replace('{pup:fdeglace}', '<img src="/images/rpg/Power-ups/Fleur-de-Glace.png" title="Fleur De Glace" alt="Fleur De Glace" />', $texte);
$texte = str_replace('{pup:feuille}', '<img src="/images/rpg/Power-ups/Feuille.png" title="Feuille" alt="Feuille" />', $texte);
$texte = str_replace('{pup:cloche}', '<img src="/images/rpg/Power-ups/Cloche.png" title="Cloche" alt="Cloche" />', $texte);
$texte = str_replace('{pup:fboomerang}', '<img src="/images/rpg/Power-ups/Fleur-Boomerang.png" title="Fleur Boomerang" alt="Fleur Boomerang" />', $texte);

		// Ennemis
		
$texte = str_replace('{B01}', '<img src="/images/rpg/Ennemis/Goomba.png" title="Goomba" alt="Goomba" />', $texte);
$texte = str_replace('{B02}', '<img src="/images/rpg/Ennemis/Koopa-Vert.png" title="Koopa Vert" alt="Koopa Vert" />', $texte);
$texte = str_replace('{B03}', '<img src="/images/rpg/Ennemis/Koopa-Rouge.png" title="Koopa Rouge" alt="Koopa Rouge" />', $texte);
$texte = str_replace('{B04}', '<img src="/images/rpg/Ennemis/Paragoomba.png" title="Paragoomba" alt="Paragoomba" />', $texte);
$texte = str_replace('{B05}', '<img src="/images/rpg/Ennemis/Paratroopa-Vert.png" title="Paratroopa-vert" alt="Paratroopa-vert" />', $texte);
$texte = str_replace('{B06}', '<img src="/images/rpg/Ennemis/Paratroopa-Rouge.png" title="Paratroopa-rouge" alt="Paratroopa-rouge" />', $texte);
$texte = str_replace('{B07}', '<img src="/images/rpg/Ennemis/Heriss.png" title="Heriss" alt="Heriss" />', $texte);
$texte = str_replace('{B08}', '<img src="/images/rpg/Ennemis/frere-marto.png" title="Frère Marto" alt="Frère Marto" />', $texte);
$texte = str_replace('{B09}', '<img src="/images/rpg/Ennemis/Kamek.png" title="Kamek" alt="Kamek" />', $texte);
$texte = str_replace('{B10}', '<img src="/images/rpg/Ennemis/Lakitu.png" title="Lakitu" alt="Lakitu" />', $texte);
$texte = str_replace('{B11}', '<img src="/images/rpg/Ennemis/Wingo.png" title="Wingo" alt="Wingo" />', $texte);


		// Personnages
		
$texte = str_replace('{Pma}', '<img src="/images/rpg/Persos/Mario.png" title="Mario" alt="Mario" />', $texte);
$texte = str_replace('{Plu}', '<img src="/images/rpg/Persos/Luigi.png" title="Luigi" alt="Luigi" />', $texte);
$texte = str_replace('{Ppe}', '<img src="/images/rpg/Persos/Peach.png" title="Peach" alt="Peach" />', $texte);
$texte = str_replace('{Pto}', '<img src="/images/rpg/Persos/Toad.png" title="Toad" alt="Toad" />', $texte);
$texte = str_replace('{Pyo}', '<img src="/images/rpg/Persos/Yoshi.png" title="Yoshi" alt="Yoshi" />', $texte);
$texte = str_replace('{Pwa}', '<img src="/images/rpg/Persos/Wario.png" title="Wario" alt="Wario" />', $texte);
$texte = str_replace('{Pbo}', '<img src="/images/rpg/Persos/Bowser.png" title="Bowser" alt="Bowser" />', $texte);
$texte = str_replace('{Pjr}', '<img src="/images/rpg/Persos/BowserJr.png" title="BowserJr" alt="BowserJr" />', $texte);
$texte = str_replace('{Pct}', '<img src="/images/rpg/Persos/CaptainToad.png" title="CaptainToad" alt="CaptainToad" />', $texte);
$texte = str_replace('{Pha}', '<img src="/images/rpg/Persos/Rosalina.png" title="Harmonie" alt="Harmonie" />', $texte);



	

//Mise en forme du texte
//gras
$texte = preg_replace('`\[b\](.+)\[/b\]`isU', '<b>$1</b>', $texte); 
//italique
$texte = preg_replace('`\[i\](.+)\[/i\]`isU', '<i>$1</i>', $texte);
//souligné
$texte = preg_replace('`\[s\](.+)\[/s\]`isU', '<u>$1</u>', $texte);
$texte = preg_replace('`\[barre\](.+)\[/barre\]`isU', '<strike>$1</strike>', $texte);
//IMG
$texte = preg_replace('`\[img\](.+)\[/img\]`isU', '<img src="$1" alt="Image non disponible" style="max-width:300px;max-height:300px;" />', $texte);
$texte = preg_replace('`\[imgclick\](.+)\[/imgclick\]`isU', '<a href="$1" onclick="window.open(this.href); return false;"><img src="$1" alt="Image non disponible" style="max-width:300px;max-height:300px;" /></a>', $texte);
//etc., etc.
$texte = preg_replace('`\[center\](.+)\[/center\]`isU', '<div style="text-align:center;">$1</div>', $texte);
$texte = preg_replace('`\[right\](.+)\[/right\]`isU', '<div style="text-align:right;">$1</div>', $texte);
$texte = preg_replace('`\[quote\](.+)\[/quote\]`isU', '<div id="quote"><span style="font-size:16px; font-weight:bold; margin-left:5px;">Citation :</span><span style="margin-left:280px; font-style:italic;"><p>$1</p></span><br /></div>', $texte);
$texte = preg_replace('`\[quote auteur=(.+)\](.+)\[/quote\]`isU', '<div id="quote"><span style="font-size:16px; font-weight:bold; margin-left:5px;">Citation de $1 :</span><span style="margin-left:280px; font-style:italic;"><p>$2</p></span><br /></div>', $texte);
$texte = preg_replace('`\[url\](.+)\[/url\]`isU', '<a href="$1" target="_blank">$1</a>', $texte);
$texte = preg_replace('`\[url=(.+)\](.+)\[/url\]`isU', '<a href="$1" target="_blank">$2</a>', $texte);
$texte = preg_replace('`\[hr-tiret\]`', '<hr-dashed>', $texte);
//Couleurs
$texte = preg_replace('`\[couleur=(.+)\](.+)\[/couleur\]`isU', '<span style="color:$1;">$2</span>', $texte);
$texte = preg_replace('`\[rouge\](.+)\[/rouge\]`isU', '<span style="color:red; font-weight:bold;">$1</span>', $texte);
$texte = preg_replace('`\[orange\](.+)\[/orange\]`isU', '<span style="color:orange; font-weight:bold;">$1</span>', $texte);
$texte = preg_replace('`\[jaune\](.+)\[/jaune\]`isU', '<span style="color:yellow; font-weight:bold;">$1</span>', $texte);
$texte = preg_replace('`\[vertfonce\](.+)\[/vertfonce\]`isU', '<span style="color:darkgreen; font-weight:bold;">$1</span>', $texte);
$texte = preg_replace('`\[vert\](.+)\[/vert\]`isU', '<span style="color:green; font-weight:bold;">$1</span>', $texte);
$texte = preg_replace('`\[lime\](.+)\[/lime\]`isU', '<span style="color:lime; font-weight:bold;">$1</span>', $texte);
$texte = preg_replace('`\[bleufonce\](.+)\[/bleufonce\]`isU', '<span style="color:darkblue; font-weight:bold;">$1</span>', $texte);
$texte = preg_replace('`\[bleu\](.+)\[/bleu\]`isU', '<span style="color:blue; font-weight:bold;">$1</span>', $texte);
$texte = preg_replace('`\[cyan\](.+)\[/cyan\]`isU', '<span style="color:cyan; font-weight:bold;">$1</span>', $texte);
$texte = preg_replace('`\[violet\](.+)\[/violet\]`isU', '<span style="color:purple; font-weight:bold;">$1</span>', $texte);
$texte = preg_replace('`\[rose\](.+)\[/rose\]`isU', '<span style="color:pink; font-weight:bold;">$1</span>', $texte);
$texte = preg_replace('`\[blanc\](.+)\[/blanc\]`isU', '<span style="color:white; font-weight:bold;">$1</span>', $texte);
$texte = preg_replace('`\[marron\](.+)\[/marron\]`isU', '<span style="color:brown; font-weight:bold;">$1</span>', $texte);
$texte = preg_replace('`\[gris\](.+)\[/gris\]`isU', '<span style="color:grey; font-weight:bold;">$1</span>', $texte);
$texte = preg_replace('`\[noir\](.+)\[/noir\]`isU', '<span style="color:black; font-weight:bold;">$1</span>', $texte);

//Surligneur

$texte = preg_replace('`\[surligneur=(.+)\](.+)\[/surligneur\]`isU', '<span style="background-color:$1;">$2</span>', $texte);
$texte = preg_replace('`\[surligneur=(.+)\](.+)\[/surligneur\]`isU', '<span style="background-color:$1;">$2</span>', $texte);
$texte = preg_replace('`\[surligneurrouge\](.+)\[/rouge\]`isU', '<span style="background-color:red; font-weight:bold;">$1</span>', $texte);
$texte = preg_replace('`\[surligneurorange\](.+)\[/orange\]`isU', '<span style="background-color:orange; font-weight:bold;">$1</span>', $texte);
$texte = preg_replace('`\[surligneurjaune\](.+)\[/jaune\]`isU', '<span style="background-color:yellow; font-weight:bold;">$1</span>', $texte);
$texte = preg_replace('`\[surligneurvertfonce\](.+)\[/vertfonce\]`isU', '<span style="background-color:darkgreen; font-weight:bold;">$1</span>', $texte);
$texte = preg_replace('`\[surligneurvert\](.+)\[/vert\]`isU', '<span style="background-color:green; font-weight:bold;">$1</span>', $texte);
$texte = preg_replace('`\[surligneurlime\](.+)\[/lime\]`isU', '<span style="background-color:lime; font-weight:bold;">$1</span>', $texte);
$texte = preg_replace('`\[surligneurbleufonce\](.+)\[/bleufonce\]`isU', '<span style="background-color:darkblue; font-weight:bold;">$1</span>', $texte);
$texte = preg_replace('`\[surligneurbleu\](.+)\[/bleu\]`isU', '<span style="background-color:blue; font-weight:bold;">$1</span>', $texte);
$texte = preg_replace('`\[surligneurcyan\](.+)\[/cyan\]`isU', '<span style="background-color:cyan; font-weight:bold;">$1</span>', $texte);
$texte = preg_replace('`\[surligneurviolet\](.+)\[/violet\]`isU', '<span style="background-color:purple; font-weight:bold;">$1</span>', $texte);
$texte = preg_replace('`\[surligneurrose\](.+)\[/rose\]`isU', '<span style="background-color:pink; font-weight:bold;">$1</span>', $texte);
$texte = preg_replace('`\[surligneurblanc\](.+)\[/blanc\]`isU', '<span style="background-color:white; font-weight:bold;">$1</span>', $texte);
$texte = preg_replace('`\[surligneurmarron\](.+)\[/marron\]`isU', '<span style="background-color:brown; font-weight:bold;">$1</span>', $texte);
$texte = preg_replace('`\[surligneurgris\](.+)\[/gris\]`isU', '<span style="background-color:grey; font-weight:bold;">$1</span>', $texte);
$texte = preg_replace('`\[surligneurnoir\](.+)\[/noir\]`isU', '<span style="background-color:black; font-weight:bold;">$1</span>', $texte);

// Tableau

$texte = preg_replace('`\[tableau\](.+)\[/tableau\]`isU', '<table>$1</table>', $texte); 
$texte = preg_replace('`\[tableauligne\](.+)\[/tableauligne\]`isU', '<tr>$1</tr>', $texte); 
$texte = preg_replace('`\[tableauentete\](.+)\[/tableauentete\]`isU', '<th>$1</th>', $texte); 
$texte = preg_replace('`\[tableaucellule\](.+)\[/tableaucellule\]`isU', '<td>$1</td>', $texte); 

// Encadré
$texte = preg_replace('`\[cadre\](.+)\[/cadre\]`isU', '<span style="border: solid black 1px;;">$1</span>', $texte);
$texte= preg_replace('#\[spoiler\](.+)\[/spoiler\]#isU','<div><div><b>Spoiler:</b> <input type="button" value="Afficher" class="spoil_inp" onclick="if (this.parentNode.parentNode.getElementsByTagName(\'div\')[1].getElementsByTagName(\'div\')[0].style.display != \'\') { this.parentNode.parentNode.getElementsByTagName(\'div\')[1].getElementsByTagName(\'div\')[0].style.display = \'\'; this.innerText = \'\'; this.value = \'Cacher\'; } else { this.parentNode.parentNode.getElementsByTagName(\'div\')[1].getElementsByTagName(\'div\')[0].style.display = \'none\'; this.innerText = \'\'; this.value = \'Afficher\'; }" /></div><div class="quotecontent"><div style="display: none;" class="spoil_aff">$1</div></div></div>', $texte);

// Twitter
$texte = preg_replace('`\[twitter\](.+)\[/twitter\]`isU', '<blockquote class="twitter-tweet" lang="fr"><p lang="fr" dir="ltr">N&#39;oubliez pas qu&#39;on a aussi une page Facebook qui est mis à jour plus régulièrement que Twitter ;)&#10;<a href="https://t.co/1fO0ztzDmc">https://t.co/1fO0ztzDmc</a></p>&mdash; Planète Toad (@planetetoad) <a href="$1">11 Avril 2015</a></blockquote>
<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>', $texte);

// Commentaire

// PlayerCard
$texte = preg_replace('`\[playercard CA3ds=(.+) NintendoNetwork=(.+)\]`isU', '<div style="border: solid black 1px; background-color:#6BD7FF; height=80px; width=10px;"><h2>PlayerCard</h2><br/>Code-ami 3DS=$1<br/><img src="/images/2n.png"/> : $2</div>', $texte);

//On retourne la variable texte
return $texte;
}
?>