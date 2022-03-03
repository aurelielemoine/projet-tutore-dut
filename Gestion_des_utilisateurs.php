<!DOCTYPE html>
<html>
<head>
	<title>Gestion des utilisateurs</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <!-- Code des icônes FontAwesome -->
    <script src="https://kit.fontawesome.com/f0ea6a706e.js" crossorigin="anonymous"></script>
</head>
<body>
  
<?php include 'barre_de_navigation_connecte.php'; 

                $identifiant = $_SESSION['Identifiant'];

                if($identifiant !== ""){
                    
?>

<div class="container">
	<div class="row">
		<div class="col-12">
      <br>
    <h3 class="text-center">Gestion des utilisateurs</h3>
<br>

<h4>Les alternants</h4>


<?php

$base = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
//lancement de la requête
$requete = $base->prepare('SELECT * FROM alternant ORDER BY Annee'); //On selectionne toutes les données de la table alternant
$requete->execute();



    echo '<table class="table table-bordered">';
    echo '<tr>';
    echo '<th>ID</th> <th>Nom</th> <th>Prenom</th> <th>Email perso</th> <th>Email pro</th> <th>Tel perso</th> <th>Tel pro</th> <th>Année</th> <th>Tuteur</th> 
    <th>Enseignant</th> ';
    echo '</tr>';while($data = $requete->fetch()){
    echo '<tr>';
    echo '<td> '.$data['ID_alternant'].'<br></td>';
    echo '<td> '.$data['Nom'].'<br></td>';
    echo '<td> '.$data['Prenom'].'<br></td>';
    echo '<td> '.$data['Email_perso'].'<br></td>';
    echo '<td> '.$data['Email_pro'].'<br></td>';
    echo '<td> '.$data['Tel_perso'].'<br></td>';
    echo '<td> '.$data['Tel_pro'].'<br></td>';
    echo '<td> '.$data['Annee'].'<br></td>';

    if($data['ID_tuteur']!=NULL){

    $base2 = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $requete2 = $base2->prepare('SELECT Nom, Prenom FROM tuteur WHERE ID_tuteur=?');
    $requete2->execute(array($data['ID_tuteur']));
    while($data2 = $requete2->fetch())
    {
      echo '<td>'.$data2['Prenom'].' '.$data2['Nom'].'<br></td>';
    }
    $requete2->closeCursor();

    }else{};

    if($data['ID_enseignant']!=NULL){

    $base3 = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $requete3 = $base3->prepare('SELECT Nom, Prenom FROM enseignant WHERE ID_enseignant=?');
    $requete3->execute(array($data['ID_enseignant']));
    while($data3 = $requete3->fetch()){
      echo '<td>'.$data3['Prenom'].' '.$data3['Nom'].'<br></td>';
    }
    $requete3->closeCursor();

    }else{};

    echo '</tr>';

}
$requete->closeCursor();

    }
    echo '</table>';

?>
<div class="float-right">
<a href="gestion_alternant.php" class="btn btn-outline-dark">Modifier</a>
</div>

<br>
<br>
<h4>Les tuteurs</h4>
<?php

$base = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
//lancement de la requête
$requete = $base->prepare('SELECT * FROM tuteur'); //On selectionne toutes les données de la table alternant
$requete->execute();

echo '<table class="table table-bordered">';
    echo '<tr>';
    echo '<th>ID</th> <th>Nom</th> <th>Prenom</th> <th>Email perso</th> <th>Email pro</th> <th>Tel perso</th> <th>Tel pro</th> <th>Entreprise</th> 
    <th>Nb d\'alternants</th>';
    echo '</tr>';while($data = $requete->fetch()){
    echo '<tr>';
    echo '<td> '.$data['ID_tuteur'].'<br></td>';
    echo '<td> '.$data['Nom'].'<br></td>';
    echo '<td> '.$data['Prenom'].'<br></td>';
    echo '<td> '.$data['Email_perso'].'<br></td>';
    echo '<td> '.$data['Email_pro'].'<br></td>';
    echo '<td> '.$data['Tel_perso'].'<br></td>';
    echo '<td> '.$data['Tel_pro'].'<br></td>';

    if($data['ID_entreprise']!=NULL){

    $base5 = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $requete5 = $base5->prepare('SELECT Entreprise FROM entreprise WHERE ID_entreprise=?');
    $requete5->execute(array($data['ID_entreprise']));
    if($data['ID_entreprise']!=NULL){
    while($data5 = $requete5->fetch())
    {
      echo '<td>'.$data5['Entreprise'].'<br></td>';
    }
    $requete5->closeCursor();
      
    }else{echo '<td> erreur </td>'; };

    }else{};

    $base4 = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $requete4 = $base4->prepare('SELECT count(*) FROM alternant WHERE ID_tuteur=?');
    $requete4->execute(array($data['ID_tuteur']));
    while($data4 = $requete4->fetch())
    {
      if($data4['count(*)']!=NULL){
      echo '<td>'.$data4['count(*)'].'<br></td>';
      }else{echo '<td> erreur </td>';};
    }
    $requete4->closeCursor();
    echo '</tr>';
    }
$requete->closeCursor();
    echo '</table>';

?>
<div class="float-right">
<a href="gestion_tuteur.php" class="btn btn-outline-dark">Modifier</a>
</div>
<br>
<br>
<h4>Les superviseurs</h4>
<?php

$base = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
//lancement de la requête
$requete = $base->prepare('SELECT * FROM superviseur'); //On selectionne toutes les données de la table alternant
$requete->execute();


    echo '<table class="table table-bordered">';
    echo '<tr>';
    echo '<th>ID</th> <th>Nom</th> <th>Prenom</th> <th>Email perso</th> <th>Email pro</th> <th>Tel perso</th> <th>Tel pro</th> <th>Entreprise</th> 
    <th>Nb d\'alternants</th>';
    echo '</tr>';while($data = $requete->fetch()){
    echo '<tr>';
    echo '<td> '.$data['ID_superviseur'].'<br></td>';
    echo '<td> '.$data['Nom'].'<br></td>';
    echo '<td> '.$data['Prenom'].'<br></td>';
    echo '<td> '.$data['Email_perso'].'<br></td>';
    echo '<td> '.$data['Email_pro'].'<br></td>';
    echo '<td> '.$data['Tel_perso'].'<br></td>';
    echo '<td> '.$data['Tel_pro'].'<br></td>';

    if($data['ID_entreprise']!=NULL){

    $base5 = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $requete5 = $base5->prepare('SELECT Entreprise FROM entreprise WHERE ID_entreprise=?');
    $requete5->execute(array($data['ID_entreprise']));
    if($data['ID_entreprise']!=NULL){
    while($data5 = $requete5->fetch()){
      echo '<td>'.$data5['Entreprise'].'<br></td>';
    }
    $requete5->closeCursor();
    }else{echo '<td> erreur </td>'; };

    }else{};

    $base4 = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $requete4 = $base4->prepare('SELECT count(*) FROM alternant WHERE ID_superviseur=? OR ID2_superviseur=?');
    $requete4->execute(array($data['ID_superviseur'], $data['ID_superviseur']));
    while($data4 = $requete4->fetch())
    {
      if($data4['count(*)']!=NULL){
      echo '<td>'.$data4['count(*)'].'<br></td>';
      }else{echo '<td> erreur </td>';};
    }
    $requete4->closeCursor();
    echo '</tr>';
    }
$requete->closeCursor();
    echo '</table>';

?>
<div class="float-right">
<a href="gestion_superviseur.php" class="btn btn-outline-dark">Modifier</a>
</div>
<br>
<br>
<h4>Les enseignants</h4>
<?php

$base = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
//lancement de la requête
$requete = $base->prepare('SELECT * FROM enseignant'); //On selectionne toutes les données de la table alternant
$requete->execute();


echo '<table class="table table-bordered">';
    echo '<tr>';
    echo '<th>ID</th> <th>Nom</th> <th>Prenom</th> <th>Email perso</th> <th>Email pro</th> <th>Tel perso</th> <th>Tel pro</th>
    <th>Nb d\'alternants</th>';
    echo '</tr>';while($data = $requete->fetch()){
    echo '<tr>';
    echo '<td> '.$data['ID_enseignant'].'<br></td>';
    echo '<td> '.$data['Nom'].'<br></td>';
    echo '<td> '.$data['Prenom'].'<br></td>';
    echo '<td> '.$data['Email_perso'].'<br></td>';
    echo '<td> '.$data['Email_pro'].'<br></td>';
    echo '<td> '.$data['Tel_perso'].'<br></td>';
    echo '<td> '.$data['Tel_pro'].'<br></td>';

    $base4 = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $requete4 = $base4->prepare('SELECT count(*) FROM alternant WHERE ID_enseignant=?');
    $requete4->execute(array($data['ID_enseignant']));
    while($data4 = $requete4->fetch())
    {
       echo '<td>'.$data4['count(*)'].'<br></td>';
    }
    $requete4->closeCursor();
    echo '</tr>';
    }
$requete->closeCursor();
    echo '</table>';

?>
<div class="float-right">
<a href="gestion_enseignant.php" class="btn btn-outline-dark">Modifier</a>
</div>
<br>
<br>
<h4>Les administrateurs</h4>
<?php

$base = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
//lancement de la requête
$requete = $base->prepare('SELECT * FROM administrateur'); //On selectionne toutes les données de la table alternant
$requete->execute();


echo '<table class="table table-bordered">';
    echo '<tr>';
    echo '<th>ID</th> <th>Nom</th> <th>Prenom</th> <th>Email perso</th> <th>Email pro</th> <th>Tel perso</th> <th>Tel pro</th>';
    echo '</tr>';while($data = $requete->fetch()){
    echo '<tr>';
    echo '<td> '.$data['ID_administrateur'].'<br></td>';
    echo '<td> '.$data['Nom'].'<br></td>';
    echo '<td> '.$data['Prenom'].'<br></td>';
    echo '<td> '.$data['Email_perso'].'<br></td>';
    echo '<td> '.$data['Email_pro'].'<br></td>';
    echo '<td> '.$data['Tel_perso'].'<br></td>';
    echo '<td> '.$data['Tel_pro'].'<br></td>';
    echo '</tr>';
    }
$requete->closeCursor();
    echo '</table>';

?>
<div class="float-right">
<a href="gestion_administrateur.php" class="btn btn-outline-dark">Modifier</a>
</div>
<br>
<br>
		</div>
	</div>
</div>

<footer>
  <?php
    include ("Pied_de_page.php");
  ?>
</footer>

</body>

</html>