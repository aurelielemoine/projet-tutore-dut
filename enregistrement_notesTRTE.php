<?php  
session_start();

if(isset($_POST['enregistrer'])){

  $notes1 = array('cc1' => $_POST['cc1'], 'ct2' => $_POST['ct2'], 'tp2' => $_POST['tp2'], 'ct3' => $_POST['ct3'], 'tp3' => $_POST['tp3'], 'ct4' => $_POST['ct4'], 'tp4' => $_POST['tp4'], 'cc5' => $_POST['cc5'], 'tp6' => $_POST['tp6']); 

  $notes2 = array('ct7' => $_POST['ct7'] ,'tp7' => $_POST['tp7'], 'ct8' => $_POST['ct8'], 'tp8' => $_POST['tp8'], 'cc9' => $_POST['cc9'], 'cc10' => $_POST['cc10'], 'ct11' => $_POST['ct11'], 'tp11' => $_POST['tp11'], 'ct12' => $_POST['ct12']);

  $notes3 = array('tp12' => $_POST['tp12'], 'cc13' => $_POST['cc13'], 'cc14' => $_POST['cc14'], 'cc15' => $_POST['cc15']);

  $serialize1 = serialize($notes1);
  $serialize2 = serialize($notes2);
  $serialize3 = serialize($notes3);

$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

$requete = $bdd->prepare('SELECT * FROM notes3 WHERE ID_alternant = ?');
$requete->execute(array($_SESSION['ID_alternant']));

//$reponse = $bdd->query($requete);

//$donnees = $reponse->fetch();

//$reponse->closeCursor();

if($requete->rowCount()==0){
  $requete2 = $bdd->prepare('INSERT INTO notes3 (ID_alternant, UE1, UE1bis, UE1ter) VALUES (?,?,?,?)');
  $requete2->execute(array($_SESSION['ID_alternant'], $serialize1, $serialize2, $serialize3));
}
else{
  $requete2 = $bdd->prepare('UPDATE notes3 SET UE1 = ?, UE1bis = ?, UE1ter = ? WHERE ID_alternant = ?');
  $requete2->execute(array($serialize1, $serialize2, $serialize3, $_SESSION['ID_alternant']));
}

header('Location:Page_de_notes_TRTE.php');

}

?>