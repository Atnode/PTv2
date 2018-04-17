<span id="gras" class="button simple-tooltip" style="padding:3px;" title="Mettre en gras un texte" name="gras" value="Gras" onClick="javascript:bbcode('[b]', '[/b]');return false;"><i class="material-icons md-18">&#xE238;</i></span>
<span id="italic" class="button simple-tooltip" style="padding:3px;" title="Mettre en italique un texte" name="italic" value="Italique" onClick="javascript:bbcode('[i]', '[/i]');return(false)"><i class="material-icons md-18">&#xE23F;</i></span>
<span id="souligné" class="button simple-tooltip" style="padding:3px;" title="Souligner un texte" name="souligné" value="Souligné" onClick="javascript:bbcode('[s]', '[/s]');return(false)"><i class="material-icons md-18">&#xE249;</i></span>
<span id="barré" class="button simple-tooltip" style="padding:3px;" title="Barrer un texte" name="barré" value="Barré" onClick="javascript:bbcode('[barre]', '[/barre]');return(false)"><i class="material-icons md-18">&#xE257;</i></span>
<span class="button simple-tooltip" style="padding:3px;" name="quote" value="Citation" title="Pour mettre un auteur (optionnel) : [quote auteur=NomDeL'auteur]Texte[/quote]" onClick="javascript:bbcode('[quote]', '[/quote]');return(false)"><i class="material-icons md-18">&#xE244;</i></span>
<span id="image" class="button simple-tooltip" style="padding:3px;" title="Mettre une image" name="image" value="Image" onClick="javascript:bbcode('[img]', '[/img]');return(false)"><i class="material-icons md-18">&#xE251;</i></span>
<span id="tableau" class="button simple-tooltip" style="padding:3px;" title="Faire un tableau" name="tableau" value="tableau" onClick="javascript:bbcode('[tableau][tableauligne][tableaucellule]', '[/tableaucellule][/tableauligne][/tableau]');return(false)"><i class="material-icons md-18">&#xE228;</i></span>
<span id="centre" class="button simple-tooltip" style="padding:3px;" title="Centrer un texte" name="centre" value="Centrer" onClick="javascript:bbcode('[center]', '[/center]');return(false)"><i class="material-icons md-18">&#xE234;</i></span>
<span id="right" class="button simple-tooltip" style="padding:3px;" title="Aligner un texte à droite" name="right" value="Right" onClick="javascript:bbcode('[right]', '[/right]');return(false)"><i class="material-icons md-18">&#xE237;</i></span>
<span id="url" class="button simple-tooltip" style="padding:3px;" title="Mettre une URL" name="url" title="Pour mettre un texte à votre lien [url=http://votrelien]Texte[/url]" value="Lien" onClick="javascript:bbcode('[url]', '[/url]');return(false)"><i class="material-icons md-18">&#xE250;</i></span>
<span id="spoiler" class="button simple-tooltip" style="padding:6px;" title="Mettre un texte sous forme de spoiler" name="spoiler" value="Spoiler" onClick="javascript:bbcode('[spoiler]', '[/spoiler]');return(false)"><i class="material-icons md-18">&#xE8F5;</i></span>
<?php if($Chat==1) { echo'<a href="/classement-chat.html" id="spoiler" class="button simple-tooltip" style="padding:6px;" title="Voir le classement des meilleurs posteurs sur le chat" name="spoiler" value="spoiler"><i class="material-icons md-18">&#xE7FB;</i></a>'; } ?>

<span id="liste_couleurs" class="button simple-tooltip" style="padding:3px;" name="couleur" title="Colorer le texte" value="Couleur"><i class="material-icons md-18">&#xE23C;</i></span>
<span id="liste_smilies" class="button simple-tooltip" style="padding:3px;" name="smilies" style="display:inline;" title="Ajouter des smileys" value="Smileys"><i class="material-icons md-18">&#xE24E;</i></span>
<div id="color" style="display:none;">
<span id="rouge" name="rouge" class="button" value="Rouge" onClick="bbcode('[rouge]', '[/rouge]');return(false)"><i class="material-icons md-18" style="color:red;">&#xE061;</i></span>
<span id="orange" name="orange" class="button" value="Orange" onClick="bbcode('[orange]', '[/orange]');return(false)"><i class="material-icons md-18" style="color:orange;">&#xE061;</i></span>
<span id="jaune" name="jaune" class="button" value="jaune" onClick="bbcode('[jaune]', '[/jaune]');return(false)"><i class="material-icons md-18" style="color:yellow;">&#xE061;</i></span>
<span id="vert" name="vert" class="button" value="Vert" onClick="bbcode('[vert]', '[/vert]');return(false)"><i class="material-icons md-18" style="color:green;">&#xE061;</i></span>
<span id="bleu" name="bleu" class="button" value="Bleu" onClick="bbcode('[bleu]', '[/bleu]');return(false)"><i class="material-icons md-18" style="color:blue;">&#xE061;</i></span>
<span id="rose" name="rose" class="button" value="Rose" onClick="bbcode('[rose]', '[/rose]');return(false)"><i class="material-icons md-18" style="color:pink;">&#xE061;</i></span>
<span id="gris" name="gris" class="button" value="Gris" onClick="bbcode('[gris]', '[/gris]');return(false)"><i class="material-icons md-18" style="color:grey;">&#xE061;</i></span>
</div>

<div id="smilies" style="display:none;">
<img src="//images.planete-toad.fr/smileys/bulle_pop_corn.png" title="zut" alt="Smiley qui prends du pop corn" onClick="smil(':grabspopcorn:');return false;" />
<img src="//images.planete-toad.fr/smileys/smiley-content.png" title="Smiley content" alt="Smiley content" onClick="smil(':)');return false;" width="16" height="16" />
<img src="//images.planete-toad.fr/smileys/super-content.png" title="super content" alt="Smiley Super Content" onClick="smil(':D');return false;" width="16" height="16" />
<img src="//images.planete-toad.fr/smileys/clin_d_oeil.png" title="Smiley Clin d'oeil" alt="Smiley Clin d'oeil" onClick="smil(';)');return false;" width="16" height="16" />
<img src="//images.planete-toad.fr/smileys/smiley-langue.png" title="Smiley qui tire la langue" alt="Tire la langue" onClick="smil(':p');return false;" width="16" height="16" />
<img src="//images.planete-toad.fr/smileys/neutre.png" title="Smiley neutre" alt="Smiley neutre" onClick="smil(':|');return false;" width="16" height="16" />
<img src="//images.planete-toad.fr/smileys/pas_content.png" title="Smiley pas content" alt="Smiley pas content" onClick="smil(':(');return false;" width="16" height="16" />
<img src="//images.planete-toad.fr/smileys/surpris.png" title="Smiley surpris" alt="Smiley surpris" onClick="smil(':o');return false;" width="16" height="16" />
<img src="//images.planete-toad.fr/smileys/triste.png" title="Smiley triste" alt="Smiley triste" onClick="smil(';(');return false;" />
<img src="//images.planete-toad.fr/smileys/pouce_leve.png" title="Toad positif" alt="Toad positif" onClick="smil(':+:');return false;" />
<img src="//images.planete-toad.fr/smileys/pouce_baisse.png" title="Toad négatif" alt="Toad négatif" onClick="smil(':-:');return false;" />
<img src="//images.planete-toad.fr/smileys/cool.png" title="cool" alt="Smiley cool" onClick="smil(':cool:');return false;" /> 
<img src="//images.planete-toad.fr/smileys/hap.gif" title="Smiley hap" alt="Smiley hap" onclick="smil(':hap:');return false;"‏ />
<img src="//images.planete-toad.fr/smileys/noel.gif" title="noel" alt="noel" onClick="smil(':noel:');return false;" />
<img src="//images.planete-toad.fr/smileys/paf.gif" title="paf" alt="paf" onclick="smil(':PAF:');return false;"‏ />
<img src="//images.planete-toad.fr/smileys/haha.gif" title="haha" alt="haha" onclick="smil(':haha:');return false;"‏ />
<img src="//images.planete-toad.fr/smileys/sisi.gif" title="Si, si" alt="Si, si" onClick="smil(':sisi:');return false;" />
<img src="//images.planete-toad.fr/smileys/8D.png" title="8D" alt="8D" onClick="smil('8D');return false;" />
<img src="//images.planete-toad.fr/smileys/a.gif" title="a" alt="a" onClick="smil(':a:');return false;" />
<img src="//images.planete-toad.fr/smileys/nohap.gif" title="nohap" alt="nohap" onClick="smil(':nohap:');return false;" />
<img src="//images.planete-toad.fr/smileys/nerdz.png" title="Smiley nerdz" alt="Smiley nerdz" onClick="smil(':nerdz:');return false;" />
<img src="//images.planete-toad.fr/smileys/toast.png" title="toast" alt="toast" onClick="smil(':toast:');return false;" />
<img src="./champi.png" title="champi" alt="champi" onClick="smil(':champi:');return false;" />
<img src="//images.planete-toad.fr/smileys/happy.png" title="happy" alt="Happy" onClick="smil(':happy:');return false;" />
<img src="//images.planete-toad.fr/smileys/Hum.png" title="hum" alt="Hum" onClick="smil(':hum:');return false;" />
<img src="//images.planete-toad.fr/smileys/note.png" title="^^" alt="^^" onClick="smil(':8:');return false;" />

</div><br>
<script>
$("#liste_couleurs").click(function(){$("#color").is(":visible")?$("#color").slideUp():$("#color").slideDown()}),$(".color").click(function(){$("#color").slideUp()}),
$("#liste_smilies").click(function(){$("#smilies").is(":visible")?$("#smilies").slideUp():$("#smilies").slideDown()}),$(".smilies").click(function(){$("#smilies").slideUp()});
</script>
<script type="text/javascript" src="//js.planete-toad.fr/tipped/tipped.js"></script>
<link rel="stylesheet" type="text/css" href="//js.planete-toad.fr/tipped/tipped.css"/>
  <script>
 $(document).ready(function() {
    Tipped.create('.simple-tooltip');
  });
  </script>