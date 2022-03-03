<?php  
session_start();

if(isset($_POST['enregistrer'])){

  $notes1 = array('ct1' => $_POST['ct1'], 'tp1' => $_POST['tp1'], 'cp2' => $_POST['cp2'], 'cp3' => $_POST['cp3'], 'tp3' => $_POST['tp3'], 'tp4' => $_POST['tp4'], 'cp5' => $_POST['cp5'], 'cp52' => $_POST['cp52'], 'cp6' => $_POST['cp6']); 

  $notes2 = array('tp6' => $_POST['tp6'], 'ct7' => $_POST['ct7'] ,'tp7' => $_POST['tp7'], 'tp8' => $_POST['tp8'], 'ct9' => $_POST['ct9'], 'tp9' => $_POST['tp9'], 'cp10' => $_POST['cp10'], 'tp10' => $_POST['tp10'], 'ct11' => $_POST['ct11']);

  $notes3 = array('tp11' => $_POST['tp11'], 'cp12' => $_POST['cp12'], 'tp12' => $_POST['tp12'], 'ct13' => $_POST['ct13'], 'cp13' => $_POST['cp13'], 'tp13' => $_POST['tp13'], 'cc14' => $_POST['cc14'], 'cc15' => $_POST['cc15']);

  $notes4 = array('ct16' => $_POST['ct16'], 'cc16' => $_POST['cc16'], 'cc161' => $_POST['cc161'], 'cc162' => $_POST['cc162'], 'ct17' => $_POST['ct17'], 'cc17' => $_POST['cc17'], 'cc171' => $_POST['cc171'], 'cc172' => $_POST['cc172'], 'ct18' => $_POST['ct18'], 'cc18' => $_POST['cc18']); 

  $notes5 = array('ct19' => $_POST['ct19'], 'cc19' => $_POST['cc19'], 'cc191' => $_POST['cc191'], 'cc20' => $_POST['cc20'], 'cp21' => $_POST['cp21'], 'cp212' => $_POST['cp212'], 'cp22' => $_POST['cp22'], 'cp222' => $_POST['cp222'], 'cp23' => $_POST['cp23'], 'cp232' => $_POST['cp232']);

  $notes6 = array('ct24' => $_POST['ct24'], 'tp24' => $_POST['tp24'], 'cp25' => $_POST['cp25'], 'cp252' => $_POST['cp252'], 'tp25' => $_POST['tp25'], 'ct26' => $_POST['ct26'], 'cp26' => $_POST['cp26'], 'tp26' => $_POST['tp26'], 'ct27' => $_POST['ct27'], 'cp27' => $_POST['cp27'], 'tp27' => $_POST['tp27']);

  $serialize1 = serialize($notes1);
  $serialize2 = serialize($notes2);
  $serialize3 = serialize($notes3);
  $serialize4 = serialize($notes4);
  $serialize5 = serialize($notes5);
  $serialize6 = serialize($notes6);

$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

$requete = $bdd->prepare('SELECT * FROM notes1 WHERE ID_alternant = ?');
$requete->execute(array($_SESSION['ID_alternant']));

//$reponse = $bdd->query($requete);

//$donnees = $reponse->fetch();

//$reponse->closeCursor();

if($requete->rowCount()==0){
  $requete2 = $bdd->prepare('INSERT INTO notes1 (ID_alternant, UE1, UE1bis, UE1ter, UE2, UE2bis, UE2ter) VALUES (?,?,?,?,?,?,?)');
  $requete2->execute(array($_SESSION['ID_alternant'], $serialize1, $serialize2, $serialize3, $serialize4, $serialize5, $serialize6));
}
else{
  $requete2 = $bdd->prepare('UPDATE notes1 SET UE1 = ?, UE1bis = ?, UE1ter = ?, UE2 = ?, UE2bis = ?, UE2ter = ? WHERE ID_alternant = ?');
  $requete2->execute(array($serialize1, $serialize2, $serialize3, $serialize4, $serialize5, $serialize6, $_SESSION['ID_alternant']));
}

header('Location:Page_de_notes_1ere_annee.php');

}

?>