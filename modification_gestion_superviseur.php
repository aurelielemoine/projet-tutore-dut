<?php
session_start();

if (!isset($_SESSION['Identifiant']))
{header ('Location: Page_de_connexion.php'); exit();}

      if (isset($_POST['valider2'])==True){

// Connexion à la base de données MySQL 
$conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

//lancement de la requête
    $requete = $conn->prepare('SELECT ID_superviseur FROM superviseur'); //On selectionne toutes les données de la table superviseur
    $requete->execute();
    while ($data = $requete->fetch()){

$conn2 = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

$id = $data['ID_superviseur'];
$Nom = $_POST['Nom'.$id.''];
$Prenom = $_POST['Prenom'.$id.''];
$Email_perso = $_POST['Email_perso'.$id.''];
$Email_pro = $_POST['Email_pro'.$id.''];
$Tel_perso = $_POST['Tel_perso'.$id.''];
$Tel_pro = $_POST['Tel_pro'.$id.''];
$Entreprise = $_POST['Entreprise'.$id.''];

    $base5 = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $requete5 = $base5->prepare('SELECT * FROM entreprise WHERE Entreprise=?');
    $requete5->execute(array($Entreprise));
    while($data5 = $requete5->fetch())
  {
    $id_entreprise=$data5['ID_entreprise'];
  }
  $requete5->closeCursor();

$res = $conn2->prepare('UPDATE superviseur SET Nom=? , Prenom=? , Email_perso=? , Email_pro=? , Tel_perso=? , Tel_pro=? , ID_entreprise=? WHERE ID_superviseur=?');
$res->execute(array($Nom, $Prenom, $Email_perso, $Email_pro, $Tel_perso, $Tel_pro, $id_entreprise, $id));

    if(isset($_POST['Supprimer'.$id.''])=='supprimer'){
$conn3 = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$res2 = $conn3->prepare('DELETE FROM superviseur WHERE ID_superviseur=?');
$res2->execute(array($id));

}

}
$requete->closeCursor();

header('Location:Gestion_des_utilisateurs.php');
}

?>

    

