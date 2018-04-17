<?php
if (!isset($_POST['champ'])) { // SI LE CHAMP EST VIDE
	echo '<form method="post" action="Gdd747nd.php"><br>
    <p><label for="champ">0100110101100001011100100110100101101111001000000110000101101110011001000010000001110011011011110110111001101001011000110010000000111111</label>  <input name="champ" type="text" id="champ" /></p><br><br>
    <p><input type="submit" value="Valider" /></p></form>';
} else {
	$BonneDate = "101111";
    $champ = $_POST['champ'];
	if ($champ==$BonneDate) {
		echo'n. 12 ROUGE';
	} else {
		echo'Faux, reccomence.';
	}
}