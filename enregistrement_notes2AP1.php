<?php  
session_start();

if(isset($_POST['enregistrer'])){

  $notes1 = array('ct1' => $_POST['ct1'], 'tp1' => $_POST['tp1'], 'cp2' => $_POST['cp2'], 'tp2' => $_POST['tp2'], 'cp3' => $_POST['cp3'], 'cp4' => $_POST['cp4'], 'ct5' => $_POST['ct5'], 'tp5' => $_POST['tp5'], 'cc6' => $_POST['cc6']); 

  $notes2 = array('tp6' => $_POST['tp6'], 'cp7' => $_POST['cp7'] ,'tp7' => $_POST['tp7'], 'cp8' => $_POST['cp8'], 'cp82' => $_POST['cp82'], 'tp8' => $_POST['tp8'], 'cc9' => $_POST['cc9'], 'cc10' => $_POST['cc10'], 'cc102' => $_POST['cc102']);

  $notes3 = array('cc103' => $_POST['cc103'], 'cp11' => $_POST['cp11'], 'cp112' => $_POST['cp112'], 'cp12' => $_POST['cp12'], 'cp122' => $_POST['cp122'], 'cp13' => $_POST['cp13'], 'cp132' => $_POST['cp132']);

  $notes4 = array('cp14' => $_POST['cp14'], 'cp142' => $_POST['cp142'], 'cc15' => $_POST['cc15'], 'cc152' => $_POST['cc152'], 'ct16' => $_POST['ct16'], 'cc16' => $_POST['cc16'], 'cc17' => $_POST['cc17'], 'cc18' => $_POST['cc18']);

  $notes5 = array('cc19' => $_POST['cc19'], 'cc192' => $_POST['cc192'], 'cc20' => $_POST['cc20'], 'ct21' => $_POST['ct21'], 'cp22' => $_POST['cp22'], 'cp222' => $_POST['cp222'], 'cp223' => $_POST['cp223'], 'ct23' => $_POST['ct23']);

  $notes6 = array('tp23' => $_POST['tp23'], 'cp24' => $_POST['cp24'], 'tp24' => $_POST['tp24'], 'cp25' => $_POST['cp25'], 'tp25' => $_POST['tp25'], 'cp26' => $_POST['cp26'], 'tp26' => $_POST['tp26'], 'ct27' => $_POST['ct27']);

  $notes7 = array('tp27' => $_POST['tp27'], 'ct28' => $_POST['ct28'], 'tp28' => $_POST['tp28'], 'cp29' => $_POST['cp29'], 'cp292' => $_POST['cp292'], 'tp29' => $_POST['tp29']);

  $serialize1 = serialize($notes1);
  $serialize2 = serialize($notes2);
  $serialize3 = serialize($notes3);
  $serialize4 = serialize($notes4);
  $serialize5 = serialize($notes5);
  $serialize6 = serialize($notes6);
  $serialize7 = serialize($notes7);

$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

$requete = $bdd->prepare('SELECT * FROM notes2 WHERE ID_alternant = ?');
$requete->execute(array($_SESSION['ID_alternant']));

if($requete->rowCount()==0){
  $requete2 = $bdd->prepare('INSERT INTO notes2 (ID_alternant, UE1, UE1bis, UE1ter, UE2, UE2bis, UE2ter, UE2quater) VALUES (?,?,?,?,?,?,?,?)');
  $requete2->execute(array($_SESSION['ID_alternant'], $serialize1, $serialize2, $serialize3, $serialize4, $serialize5, $serialize6, $serialize7));
}
else{
  $requete2 = $bdd->prepare('UPDATE notes2 SET UE1 = ?, UE1bis = ?, UE1ter = ?, UE2 = ?, UE2bis = ?, UE2ter = ?, UE2quater = ? WHERE ID_alternant = ?');
  $requete2->execute(array($serialize1, $serialize2, $serialize3, $serialize4, $serialize5, $serialize6, $serialize7, $_SESSION['ID_alternant']));
}

header('Location:Page_de_notes_2eme_annee.php');

}

?>