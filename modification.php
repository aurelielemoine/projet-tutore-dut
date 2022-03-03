<?php
session_start();

      if (isset($_POST['submit'])==True){

$Prenom = $_POST['Prenom'];
$Prenom = ucfirst($Prenom);
$Nom = $_POST['Nom'];
$Nom = strtoupper($Nom);
$Email_perso = $_POST['Email_perso'];
$Email_pro = $_POST['Email_pro'];
$Tel_perso = $_POST['Tel_perso'];
$Tel_pro = $_POST['Tel_pro'];
$id = $_SESSION['ID_'.$_SESSION['statut'].''];

if(!empty($_FILES)){
		$file_name = $_FILES[''.$_SESSION['statut'].'']['name'];
		$file_extension = strrchr($file_name, ".");
		
		$file_tmp_name = $_FILES[''.$_SESSION['statut'].'']['tmp_name'];
		$file_dest = 'files/'.$file_name;

		$extensions_autorisees = array('.jpg', '.JPG', '.img', '.IMG', '.png', '.PNG');

		if(in_array($file_extension, $extensions_autorisees)){
			if(move_uploaded_file($file_tmp_name, $file_dest)){ 

$conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('UPDATE '.$_SESSION['statut'].' SET Prenom=?, Nom=?, Email_perso=?, Email_pro=?, Tel_perso=?, Tel_pro=?, name=?, file_url=? WHERE ID_'.$_SESSION['statut'].'=?');
$requete->execute(array($Prenom, $Nom, $Email_perso, $Email_pro, $Tel_perso, $Tel_pro, $file_name, $file_dest, $id));

}}}

$conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('UPDATE '.$_SESSION['statut'].' SET Prenom=?, Nom=?, Email_perso=?, Email_pro=?, Tel_perso=?, Tel_pro=? WHERE ID_'.$_SESSION['statut'].'=?');
$requete->execute(array($Prenom, $Nom, $Email_perso, $Email_pro, $Tel_perso, $Tel_pro, $id));

header('Location:Compteutilisateur_'.$_SESSION['statut'].'.php');
}


?>