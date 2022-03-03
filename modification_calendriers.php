<?php

session_start();

if (isset($_POST['valide'])==True){

// Connexion à la base de données MySQL 
$base = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

$cal0 = $_POST['1AA'];
$cal1 = $_POST['1A'];
$cal2 = $_POST['2A'];
$cal3 = $_POST['TRTE'];

if($cal0!=""){
	$res = $base->prepare('UPDATE calendriers SET 1AA=?');
    $res->execute(array($cal0));
}
if($cal1!=""){
	$res = $base->prepare('UPDATE calendriers SET 1A=?');
    $res->execute(array($cal1));
}
if($cal2!=""){
	$res = $base->prepare('UPDATE calendriers SET 2A=?');
    $res->execute(array($cal2));
}
if($cal3!=""){
	$res = $base->prepare('UPDATE calendriers SET TRTE=?');
    $res->execute(array($cal3));
}

if ($cal0 == "" && $cal1 == "" && $cal2 == "" && $cal3 == "") {
	header('Location:modification_calendrier.php?modif=2');
}
else{header('Location:modification_calendrier.php?modif=1');}


}

?>