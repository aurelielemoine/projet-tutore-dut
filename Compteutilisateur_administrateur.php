<!DOCTYPE html>
<html>
<head>
	<title>Utilisateur</title>
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
  .image
  {
    float: right;
    width: 100px;
height: 200px;
  }
</style>
<body>
  
<?php include 'barre_de_navigation_connecte.php';
?>

<div class="container">
	<div class="row">
    <div class="col-12">
    <br>
    <h3 class="text-center">Compte de l'utilisateur</h3>
  </div>
</div>
		<div class="col-6">

<?php

    echo '<form action="barre_de_navigation_connecte.php" method="post">
    <td><div class="form-group">
    <label for="altern">Sélectionner un alternant :</label>
      <select class="form-control" id="altern" name="altern">';

//sélection de tout les alternants
    $base = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));    
    $requete = $base->prepare('SELECT * FROM alternant ORDER BY Prenom');
    $requete->execute();
    while($data = $requete->fetch())
    {
      echo '<option value="'.$data['ID_alternant'].'"';
        if ($data['ID_alternant']==$_SESSION['dataalt']['ID_alternant']) {
          echo 'selected';
        }
        echo '>'.$data['Prenom'].' '.$data['Nom'].'</option>';
    }
    $requete->closeCursor();      

echo '</select> </div></td>
<input type="submit" name="valideraltern" class="btn btn-outline-dark" value="Valider">
</form>';

?>

	<br>
</div>
<div class="row">
    <div class="col-6">
      <div class="text-dark bg-white border border-warning p-3 rounded">
        <?php
  $base = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  $requete_administrateur = $base->prepare('SELECT * FROM administrateur WHERE ID_administrateur=?');
  $requete_administrateur->execute(array($_SESSION['ID_administrateur']));
  while($dataadministrateur = $requete_administrateur->fetch())
  {
    $data_administrateur=$dataadministrateur;
  }
      $requete_administrateur->closeCursor();
  ?>
  <img class="image" src="<?php echo  htmlspecialchars($data_administrateur['file_url']);?>"/>
      <h5>ADMINISTRATEUR</h5>
      <br>
      <label>Prénom :</label>
      <?php echo $data_administrateur['Prenom']; ?>
      <br>
      <br>
      <label>Nom :</label>
      <?php echo $data_administrateur['Nom']; ?>
      <br>
      <br>
      <label>Email personnel :</label>
      <?php echo $data_administrateur['Email_perso']; ?>
      <br>
      <br>
      <label>Email professionnel :</label>
      <?php echo $data_administrateur['Email_pro']; ?>
      <br>
      <br>
      <label>Numéro de téléphone personnel :</label>
      <?php echo $data_administrateur['Tel_perso']; ?>
      <br>
      <br>
      <label>Numéro de téléphone professionnel :</label>
      <?php echo $data_administrateur['Tel_pro']; ?>
      <br>
      <br>
      <a href="Utilisateur.php" type="button" class="btn btn-outline-dark">Modifier mes informations</a>
      <br>
    </div>
      </div>
    <?php       ?>

      <div class="col-6">
      <?php 
      if($_SESSION['dataalt']['ID_tuteur']!=NULL){
          $base = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
          $requete_tuteur = $base->prepare('SELECT * FROM tuteur WHERE ID_tuteur=?');
          $requete_tuteur->execute(array($_SESSION['dataalt']['ID_tuteur']));
          while($datatuteur = $requete_tuteur->fetch())
          {
            $data_tuteur=$datatuteur;
          }
          $requete_tuteur->closeCursor();

          $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
          $requete_entreprise = $bdd->prepare('SELECT * FROM entreprise WHERE ID_entreprise=?');
          $requete_entreprise->execute(array($data_tuteur['ID_entreprise']));
          while($dataentreprise = $requete_entreprise->fetch())
          {
            $data_entreprise=$dataentreprise; 
          }
          $requete_entreprise->closeCursor();

      }else{}
      ?>
      <div class="text-dark bg-white border border-warning p-3 rounded">
        <img class="image" src="<?php echo  htmlspecialchars($data_tuteur['file_url']);?>"/>
      <h5>MAITRE D'APPRENTISSAGE</h5>
      <br>
      <label>Prénom :</label>
      <?php echo $data_tuteur['Prenom']; ?>
      <br><br>
      <label>Nom :</label>
      <?php echo $data_tuteur['Nom']; ?>
      <br><br>
      <label>Email personnel :</label>
      <?php echo $data_tuteur['Email_perso']; ?>
      <br><br>
      <label>Email professionnel :</label>
      <?php echo $data_tuteur['Email_pro']; ?>
      <br><br>
      <label>Numéro de téléphone personnel :</label>
      <?php echo $data_tuteur['Tel_perso']; ?>
      <br><br>
      <label>Numéro de téléphone professionnel :</label>
      <?php echo $data_tuteur['Tel_pro']; ?>
      <br><br>
      <label>Entreprise :</label>
      <?php echo $data_entreprise['Entreprise']; ?>
      <br>
</div>
</div>
</div>

  <div class="row">
     <div class="col-6">
      <br>
  <div class="text-dark bg-white border border-warning p-3 rounded">
    <img class="image" src="<?php echo  htmlspecialchars($_SESSION['dataalt']['file_url']);?>"/>
      <h5>ALTERNANT</h5>
      <br>
      <label>Prénom :</label>
      <?php 
      echo $_SESSION['dataalt']['Prenom']; 
      ?>
      <br>
      <br>
      <label>Nom :</label>
      <?php 
      echo $_SESSION['dataalt']['Nom']; 
      ?>
      <br>
      <br>
      <label>Email personnel :</label>
      <?php 
      echo $_SESSION['dataalt']['Email_perso']; 
      ?>
      <br>
      <br>
      <label>Email professionnel :</label>
      <?php 
      echo $_SESSION['dataalt']['Email_pro']; 
      ?>
      <br>
      <br>
      <label>Numéro de téléphone personnel :</label>
      <?php
      echo $_SESSION['dataalt']['Tel_perso']; 
      ?>
      <br>
      <br>
      <label>Numéro de téléphone professionnel :</label>
      <?php
      echo $_SESSION['dataalt']['Tel_pro']; 
      ?>
    </div>
  </div>
  
    <div class="col-6">
      <?php 
      if($_SESSION['dataalt']['ID_enseignant']!=NULL){
          $base = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
          $requete_enseignant = $base->prepare('SELECT * FROM enseignant WHERE ID_enseignant=?');
          $requete_enseignant->execute(array($_SESSION['dataalt']['ID_enseignant']));
          while($dataenseignant = $requete_enseignant->fetch())
          {
            $data_enseignant=$dataenseignant; 
          }
          $requete_enseignant->closeCursor();
      }else{};
      ?>
      <br>
      <div class="text-dark bg-white border border-warning p-3 rounded">
        <img class="image" src="<?php echo  htmlspecialchars($data_enseignant['file_url']);?>"/>
      <h5>TUTEUR ENSEIGNANT</h5>
      <br>
      <label>Prénom :</label>
      <?php echo $data_enseignant['Prenom']; ?>
      <br><br>
      <label>Nom :</label>
      <?php echo $data_enseignant['Nom']; ?>
      <br><br>
      <label>Email personnel :</label>
      <?php echo $data_enseignant['Email_perso']; ?>
      <br><br>
      <label>Email professionnel :</label>
      <?php echo $data_enseignant['Email_pro']; ?>
      <br><br>
      <label>Numéro de téléphone personnel :</label>
      <?php echo $data_enseignant['Tel_perso']; ?>
      <br><br>
      <label>Numéro de téléphone professionnel :</label>
      <?php echo $data_enseignant['Tel_pro']; ?>
      <br>
      </div>
    </div>
</div>
    

<?php

if($_SESSION['dataalt']['ID_superviseur']!=0){
  $base = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  $requete_superviseur = $base->prepare('SELECT * FROM superviseur WHERE ID_superviseur=?');
  $requete_superviseur->execute(array($_SESSION['dataalt']['ID_superviseur']));
  while($datasuperviseur = $requete_superviseur->fetch())
  {
    $data_superviseur=$datasuperviseur; 
  }
  $requete_superviseur->closeCursor();
  $base = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  $requete_entreprise = $base->prepare('SELECT * FROM entreprise WHERE ID_entreprise=?');
  $requete_entreprise->execute(array($data_superviseur['ID_entreprise']));
  while($dataentreprise = $requete_entreprise->fetch())
  {
    $data_entreprise=$dataentreprise; 
  }
  $requete_entreprise->closeCursor();
?>

<div class="row">
<div class="col-6">
  <br>
<div class="text-dark bg-white border border-warning p-3 rounded">
        <img class="image" src="<?php echo  htmlspecialchars($data_superviseur['file_url']);?>"/>
      <h5>SUPERVISEUR</h5>
      <br>
      <label>Prénom :</label>
      <?php echo $data_superviseur['Prenom']; ?>
      <br><br>
      <label>Nom :</label>
      <?php echo $data_superviseur['Nom']; ?>
      <br><br>
      <label>Email personnel :</label>
      <?php echo $data_superviseur['Email_perso']; ?>
      <br><br>
      <label>Email professionnel :</label>
      <?php echo $data_superviseur['Email_pro']; ?>
      <br><br>
      <label>Numéro de téléphone personnel :</label>
      <?php echo $data_superviseur['Tel_perso']; ?>
      <br><br>
      <label>Numéro de téléphone professionnel :</label>
      <?php echo $data_superviseur['Tel_pro']; ?>
      <br><br>
      <label>Entreprise :</label>
      <?php echo $data_entreprise['Entreprise']; ?>
      <br>
</div>
</div>

<?php
}

if($_SESSION['dataalt']['ID2_superviseur']!=0){
  $base = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  $requete_superviseur2 = $base->prepare('SELECT * FROM superviseur WHERE ID_superviseur=?');
  $requete_superviseur2->execute(array($_SESSION['dataalt']['ID2_superviseur']));
  while($datasuperviseur2 = $requete_superviseur2->fetch())
  {
    $data_superviseur2 = $datasuperviseur2; 
  }
  $requete_superviseur2->closeCursor();
  $base = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  $requete_entreprise2 = $base->prepare('SELECT * FROM entreprise WHERE ID_entreprise=?');
  $requete_entreprise2->execute(array($data_superviseur2['ID_entreprise']));
  while($dataentreprise2 = $requete_entreprise2->fetch())
  {
    $data_entreprise2 = $dataentreprise2; 
  }
  $requete_entreprise2->closeCursor();
?>

<div class="col-6"><br>
<div class="text-dark bg-white border border-warning p-3 rounded">
        <img class="image" src="<?php echo  htmlspecialchars($data_superviseur2['file_url']);?>"/>
      <h5>SUPERVISEUR n°2</h5>
      <br>
      <label>Prénom :</label>
      <?php echo $data_superviseur2['Prenom']; ?>
      <br><br>
      <label>Nom :</label>
      <?php echo $data_superviseur2['Nom']; ?>
      <br><br>
      <label>Email personnel :</label>
      <?php echo $data_superviseur2['Email_perso']; ?>
      <br><br>
      <label>Email professionnel :</label>
      <?php echo $data_superviseur2['Email_pro']; ?>
      <br><br>
      <label>Numéro de téléphone personnel :</label>
      <?php echo $data_superviseur2['Tel_perso']; ?>
      <br><br>
      <label>Numéro de téléphone professionnel :</label>
      <?php echo $data_superviseur2['Tel_pro']; ?>
      <br><br>
      <label>Entreprise :</label>
      <?php echo $data_entreprise2['Entreprise']; ?>
      <br>
</div>
</div>
<?php } ?>
</div>
</div>
<br>
<br>

<footer>
  <?php
    include ("Pied_de_page.php");
  ?>
</footer>

</body>
</html>