<?php
session_start();

if (!isset($_SESSION['Identifiant']))
{header ('Location: Page_de_connexion.php'); exit();}

      if (isset($_POST['valider'])==True){

// Connexion à la base de données MySQL 
$conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

//lancement de la requête
    $requete = $conn->prepare('SELECT * FROM alternant ORDER BY Annee'); //On selectionne toutes les données de la table alternant
    $requete->execute();
    while ($data = $requete->fetch()){

$conn2 = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

$id = $data['ID_alternant'];
$Nom = $_POST['Nom'.$id.''];
$Prenom = $_POST['Prenom'.$id.''];
$Email_perso = $_POST['Email_perso'.$id.''];
$Email_pro = $_POST['Email_pro'.$id.''];
$Tel_perso = $_POST['Tel_perso'.$id.''];
$Tel_pro = $_POST['Tel_pro'.$id.''];
$Annee = $_POST['Annee'.$id.''];
$ID_tuteur = $_POST['Tuteur'.$id.''];
$ID_enseignant = $_POST['Enseignant'.$id.''];

$res = $conn2->prepare('UPDATE alternant SET Nom=? , Prenom=? , Email_perso=? , Email_pro=? , Tel_perso=? , Tel_pro=? ,
Annee=? , ID_tuteur=? , ID_enseignant=? WHERE ID_alternant=?');
$res->execute(array($Nom, $Prenom, $Email_perso, $Email_pro, $Tel_perso, $Tel_pro, $Annee, $ID_tuteur, $ID_enseignant, $id));

if(isset($_POST['Supprimer'.$id.''])=='supprimer'){
$conn3 = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

$res2 = $conn3->prepare('DELETE FROM alternant WHERE ID_alternant=?');
$res2->execute(array($id));
}

}
$requete->closeCursor();

header('Location:Gestion_des_utilisateurs.php');
}


?>