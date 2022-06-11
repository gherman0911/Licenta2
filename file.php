<?php

$user= 'root';
$pass='';
$db='antrenor';

$db= new mysqli ('localhost', $user, $pass, $db) or die("Conectare nereusita");

echo "ok";
?>
