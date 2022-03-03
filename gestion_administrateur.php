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

<h4>Les administrateurs</h4>
<form action="modification_gestion_administrateur.php" method="post">
<?php

$base = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
//lancement de la requête
$requete = $base->prepare('SELECT * FROM administrateur');
$requete->execute();
echo '<table class="table table-bordered">';
    echo '<tr>';
    echo '<th>ID</th> <th>Nom</th> <th>Prenom</th> <th>Email perso</th> <th>Email pro</th> <th>Tel perso</th> <th>Tel pro</th> <th>Supprimer</th>';
    echo '</tr>';
while($data = $requete->fetch()){
    echo '<tr>';
    echo '<td> '.$data['ID_administrateur'].'<br></td>';
    echo '<td><input size="12" name="Nom'.$data['ID_administrateur'].'" value="'.$data['Nom'].'"><br></td>';
    echo '<td><input size="12" name="Prenom'.$data['ID_administrateur'].'" value="'.$data['Prenom'].'"><br></td>';
    echo '<td><input size="16" name="Email_perso'.$data['ID_administrateur'].'" value="'.$data['Email_perso'].'"><br></td>';
    echo '<td><input size="16" name="Email_pro'.$data['ID_administrateur'].'" value="'.$data['Email_pro'].'"><br></td>';
    echo '<td><input size="10" name="Tel_perso'.$data['ID_administrateur'].'" value="'.$data['Tel_perso'].'"><br></td>';
    echo '<td><input size="10" name="Tel_pro'.$data['ID_administrateur'].'" value="'.$data['Tel_pro'].'"><br></td>';  
    echo '<td class="align-middle text-center"><input type="checkbox" name="Supprimer'.$data['ID_administrateur'].'" value="supprimer"></td>';
    echo '</tr>';

    }
    $requete->closeCursor();
    echo '</table>';

?>

<input type="submit" name="valider4" class="btn btn-outline-dark" value="Valider">

</form>

<br>
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