<?php
session_start();

      if (isset($_POST['valider3'])==True){

// Connexion à la base de données MySQL 
$base = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

//lancement de la requête
    $requete = $base->prepare('SELECT ID_enseignant FROM enseignant'); //On selectionne toutes les données de la table tuteur
    $requete->execute();
    while ($data = $requete->fetch()){

$conn2 = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

$id = $data['ID_enseignant'];
$Nom = $_POST['Nom'.$id.''];
$Prenom = $_POST['Prenom'.$id.''];
$Email_perso = $_POST['Email_perso'.$id.''];
$Email_pro = $_POST['Email_pro'.$id.''];
$Tel_perso = $_POST['Tel_perso'.$id.''];
$Tel_pro = $_POST['Tel_pro'.$id.''];

$res = $conn2->prepare('UPDATE enseignant SET Nom=? , Prenom=? , Email_perso=? , Email_pro=? , Tel_perso=? , Tel_pro=? WHERE ID_enseignant=?');
$res->execute(array($Nom, $Prenom, $Email_perso, $Email_pro, $Tel_perso, $Tel_pro, $id));

    if(isset($_POST['Supprimer'.$id.''])=='supprimer'){
$conn3 = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$res2 = $conn3->prepare('DELETE FROM enseignant WHERE ID_enseignant=?');
$res2->execute(array($id));
}

}
$requete->closeCursor();

header('Location:Gestion_des_utilisateurs.php');
}

?>