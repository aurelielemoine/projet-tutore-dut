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
<style>
input[type=checkbox] {
    -webkit-appearance: none;
    -moz-appearance: none;
    -ms-appearance: none;
    -border-radius: 4px;
    height: 15px;
    width: 15px;
    background: #fff;
    border: 1px solid #ccc;
    transform : scale(2);
}

input[type="checkbox"]:checked {
  background: red;
  margin:0px;
  position: relative;
  &:before {
    font-family: FontAwesome;
    content: '\f00c';
    display: block;
    color: grey;
    font-size: 13px;
    position: absolute;
  }
}
</style>
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

<form action="modification_gestion_alternant.php" method="post">
<?php

$base = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
//lancement de la requête
$requete = $base->prepare('SELECT * FROM alternant ORDER BY Annee'); //On sélectionne toutes les données de la table alternant
$requete->execute();
echo '<table class="table table-bordered">';
    echo '<tr>';
    echo '<th>ID</th> <th>Nom</th> <th>Prenom</th> <th>Email perso</th> <th>Email pro</th> <th>Tel perso</th> <th>Tel pro</th> <th>Année</th> <th>Tuteur</th> 
    <th>Enseignant</th> <th>Supprimer</th> ';
    echo '</tr>';
while($data = $requete->fetch()){
    echo '<tr>';
    echo '<td> '.$data['ID_alternant'].'<br></td>';
    echo '<td> <input size="12" name="Nom'.$data['ID_alternant'].'" value="'.$data['Nom'].'"><br></td>';
    echo '<td> <input size="12" name="Prenom'.$data['ID_alternant'].'" value="'.$data['Prenom'].'"><br></td>';
    echo '<td> <input size="16" name="Email_perso'.$data['ID_alternant'].'" value="'.$data['Email_perso'].'"><br></td>';
    echo '<td> <input size="16" name="Email_pro'.$data['ID_alternant'].'" value="'.$data['Email_pro'].'"><br></td>';
    echo '<td><input size="10" name="Tel_perso'.$data['ID_alternant'].'" value="'.$data['Tel_perso'].'"><br></td>';
    echo '<td><input size="10" name="Tel_pro'.$data['ID_alternant'].'" value="'.$data['Tel_pro'].'"><br></td>';

    if($data['Annee']!=NULL){
    
    echo '<td><div class="form-group">
      <select class="form-control" name="Annee'.$data['ID_alternant'].'">';

        echo '<option value="1A" name="Annee'.$data['ID_alternant'].'"';
        if ($data['Annee']=="1A") {
            echo 'selected'; }
        echo '>1A</option>';

        echo '<option value="2AP1" name="Annee'.$data['ID_alternant'].'"';
        if ($data['Annee']=="2AP1") {
            echo 'selected'; }
        echo '>2AP1</option>';

        echo '<option value="2AP2" name="Annee'.$data['ID_alternant'].'"';
        if ($data['Annee']=="2AP2") {
            echo 'selected'; }
        echo '>2AP2</option>';

        echo '<option value="TRTE" name="Annee'.$data['ID_alternant'].'"';
        if ($data['Annee']=="TRTE") {
            echo 'selected'; }
        echo '>TRTE</option>';

      echo '</select> </div><br></td>';

    }else{echo '<td>Pas de valeur</td>';};



    if($data['ID_tuteur']!=NULL){

    $base2 =new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $requete2 = $base2->prepare('SELECT * FROM tuteur');
    $requete2->execute();
    echo '<td><div class="form-group">
      <select class="form-control" name="Tuteur'.$data['ID_alternant'].'">';
    while($data2 = $requete2->fetch())
    {
      echo '<option value="'.$data2['ID_tuteur'].'" name="Tuteur'.$data['ID_alternant'].'"';

        if ($data['ID_tuteur']==$data2['ID_tuteur']) {
            echo 'selected';
        }

        echo '>'.$data2['Prenom'].' '.$data2['Nom'].'</option>';
    }
    $requete2->closeCursor();

echo '</select> </div><br></td>';

    }else{echo '<td>Pas de valeur</td>';};



    if($data['ID_enseignant']!=NULL){

    $base3 = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $requete3 = $base3->prepare('SELECT * FROM enseignant');
    $requete3->execute();    
    echo '<td><div class="form-group">
      <select class="form-control" name="Enseignant'.$data['ID_alternant'].'">';
    while($data3 = $requete3->fetch())
    {
      echo '<option value="'.$data3['ID_enseignant'].'" name="Enseignant'.$data['ID_alternant'].'"';

        if ($data['ID_enseignant']==$data3['ID_enseignant']) {
            echo 'selected';
        }
    

        echo '>'.$data3['Prenom'].' '.$data3['Nom'].'</option>';

      }$requete3->closeCursor();

echo '</select> </div><br></td>';

    }else{echo '<td>Pas de valeur</td>';};
    echo '<td class="align-middle text-center"><input type="checkbox" name="Supprimer'.$data['ID_alternant'].'" value="supprimer"></td>';

    echo '</tr>';

    }

    echo '</table>';

?>
<input type="submit" name="valider" class="btn btn-outline-dark" value="Valider">
</form>
<?php
 }
?>
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