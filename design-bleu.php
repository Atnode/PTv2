<?php
session_start();
$expire = time() + 365*24*3600;
setcookie('design', '0', $expire);
header("Status: 301 Moved Permanently", false, 301);
header("Location: /changedesign.html");
?>