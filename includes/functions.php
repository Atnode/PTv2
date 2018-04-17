<?php
function verif_auth($auth_necessaire)
{
//Dans un premier temps, on vérifie si le membre est connecté
if(isset($_SESSION['id'])) $auth = intval($_SESSION['level']);
else $auth = 1;
if ($auth_necessaire < $auth) return true;
else return false;
}

function move_avatar($avatar)
{
    $extension_upload = strtolower(substr(  strrchr($avatar['name'], '.')  ,1));
    $name = $_SESSION['id'].'-'.time();
    $nomavatar ="//avatars.planete-toad.fr/". str_replace(' ','',$name).".".$extension_upload;
    $name = "./images/avatars/". str_replace(' ','',$name).".".$extension_upload;
    move_uploaded_file($avatar['tmp_name'],$name);
    return $nomavatar;
}

function move_news($avatar) {
    $extension_upload = strtolower(substr(  strrchr($avatar['name'], '.')  ,1));
    $nomavatar ="//images.planete-toad.fr/news/". str_replace(' ','',$_POST['nameI']).".".$extension_upload;
    $name = "./images/news/". str_replace(' ','',$_POST['nameI']).".".$extension_upload;
    move_uploaded_file($avatar['tmp_name'],$name);
    return $nomavatar;
}

function nettoyage($text)
{
 $p=array(
        '/[ÀÁÂÃÄÅàáâãäå]/u',
        '/[ÈÉÊËéèêë]/u',
        '/[ÌÍÎÏìíîï]/u',
        '/[ÒÓÔÕÖØòóôõöø]/u',
        '/[ÙÚÛÜùúûü]/u',
        '/[ýÿ]/u',
        '/[Çç]/u',
        '/[Ññ]/u',
        '/[#]/u',
        '/[^a-z]/'
    );
    $s=preg_replace($p,array('a','e','i','o','u','y','c','n', '', '-'),strtolower($text));
    return preg_replace('/-{2,}/','',$s);
}
//Fonction listant les pages
function get_list_page($page, $nb_page, $link, $link2, $nb = 5){
$list_page = array();
for ($i=1; $i <= $nb_page; $i++){
if (($i < $nb) OR ($i > $nb_page - $nb) OR (($i < $page + $nb) AND ($i > $page -$nb)))
$list_page[] = ($i==$page)?'<a href="'.$link.''.$i.'-'.$link2.'.html" class="active">'.$i.'</a>':'<a href="'.$link.''.$i.'-'.$link2.'.html">'.$i.'</a>'; 
else{
if ($i >= $nb AND $i <= $page - $nb)
$i = $page - $nb;
elseif ($i >= $page + $nb AND $i <= $nb_page - $nb)
$i = $nb_page - $nb;
$list_page[] = '...';
}
}
$print= implode('-', $list_page);
return $print;
}

//Fonction listant les pages en Material Design
function get_list_page_MDesign($page, $nb_page, $link, $link2, $nb = 5){
$list_page = array();
for ($i=1; $i <= $nb_page; $i++){
if (($i < $nb) OR ($i > $nb_page - $nb) OR (($i < $page + $nb) AND ($i > $page -$nb)))
$list_page[] = ($i==$page)?'<li><a href="'.$link.''.$i.'-'.$link2.'.html" class="active">'.$i.'</a><li>':'<li><a href="'.$link.''.$i.'-'.$link2.'.html">'.$i.'</a><li>'; 
else{
if ($i >= $nb AND $i <= $page - $nb)
$i = $page - $nb;
elseif ($i >= $page + $nb AND $i <= $nb_page - $nb)
$i = $nb_page - $nb;
$list_page[] = '<li><a>...</a><li>';
}
}
$print= implode('', $list_page);
return $print;
}

//Fonction calcul âge
function age($age)
{
  $d = strtotime($age);
  return (int) ((time() - $d) / 3600 / 24 / 365.242);
}

//Mois en lettre
function getMonth($month) {
        $month_arr[1]=   "Janvier";
        $month_arr[2]=   "Février";
        $month_arr[3]=   "Mars";
        $month_arr[4]=   "Avril";
        $month_arr[5]=   "Mai";
        $month_arr[6]=   "Juin";
        $month_arr[7]=   "Juillet";
        $month_arr[8]=   "Août";
        $month_arr[9]=   "Septembre";
        $month_arr[10]=  "Octobre";
        $month_arr[11]=  "Novembre";
        $month_arr[12]=  "Décembre";

        return $month_arr[$month];
}

//Mois en lettre min
function getMinMonth($month) {
        $month_arr[1]=   "jan";
        $month_arr[2]=   "fév";
        $month_arr[3]=   "mars";
        $month_arr[4]=   "avr";
        $month_arr[5]=   "mai";
        $month_arr[6]=   "juin";
        $month_arr[7]=   "juil";
        $month_arr[8]=   "août";
        $month_arr[9]=   "sept";
        $month_arr[10]=  "oct";
        $month_arr[11]=  "nov";
        $month_arr[12]=  "déc";

        return $month_arr[$month];
}
?>