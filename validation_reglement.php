<?php
session_start();

if (isset($_POST['validation_reglement'])){

if(isset($_POST['validation'])){//si la case est cochée

  $_SESSION['Validation_reglement']='1';

$base = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)) or die('Impossible de se connecter à la base de données !');
$res = $base->prepare('UPDATE '.$_SESSION['statut'].' SET Validation_reglement="1" WHERE ID_'.$_SESSION['statut'].'=? ');
$res->execute(array($_SESSION['ID_'.$_SESSION['statut'].'']));

header('Location: Compteutilisateur_'.$_SESSION['statut'].'.php');
}else{
    header('Location: Page_de_réglementation_des_absences.php');
  }
}

?>