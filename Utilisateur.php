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
<body>
  
<?php include 'barre_de_navigation_connecte.php';

$base = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete_utilisateur = $base->prepare('SELECT * FROM '.$_SESSION['statut'].' WHERE ID_'.$_SESSION['statut'].'=?');
$requete_utilisateur->execute(array($_SESSION['ID_'.$_SESSION['statut'].'']));
while($datautilisateur = $requete_utilisateur->fetch())
{
  $data_utilisateur=$datautilisateur;
}
$requete_utilisateur->closeCursor();

?>

<form action="modification.php" method="post" enctype="multipart/form-data">
<div class="container">
	<div class="row">
		<div class="col-12">
      
			<br>
			<h3 class="text-center">Compte de l'utilisateur</h3>
			<br>

    </div>
  </div>

  <div class="row">
    <div class="col-6">

      <h5>Veuillez remplir les informations suivantes :</h5>
      <br>
      <label>Prénom :</label>
      <input type="text" name="Prenom" id="Prenom" value="<?php if($_SESSION['statut']=='alternant'){echo $_SESSION['dataalt']['Prenom'];}else{echo $data_utilisateur['Prenom'];} ?>">
      <br>
      <br>
      <label>Nom :</label>
      <input type="text" name="Nom" id="Nom" value="<?php if($_SESSION['statut']=='alternant'){echo $_SESSION['dataalt']['Nom'];}else{echo $data_utilisateur['Nom'];} ?>">
      <br>
      <br>
      <label>Email_perso :</label>
      <input type="email" name="Email_perso" id="Email_perso" value="<?php if($_SESSION['statut']=='alternant'){echo $_SESSION['dataalt']['Email_perso'];}else{echo $data_utilisateur['Email_perso'];} ?>">
      <br>
      <br>
      <label>Email_pro :</label>
      <input type="email" name="Email_pro" id="Email_pro" value="<?php if($_SESSION['statut']=='alternant'){echo $_SESSION['dataalt']['Email_pro'];}else{echo $data_utilisateur['Email_pro'];} ?>">
      <br>
      <br>
      <label>Numéro de téléphone perso :</label>
      <input type="tel" name="Tel_perso" id="Tel_perso" value="<?php if($_SESSION['statut']=='alternant'){echo $_SESSION['dataalt']['Tel_perso'];}else{echo $data_utilisateur['Tel_perso'];} ?>">
      <br>
      <br>
      <label>Numéro de téléphone pro:</label>
      <input type="tel" name="Tel_pro" id="Tel_pro" value="<?php if($_SESSION['statut']=='alternant'){echo $_SESSION['dataalt']['Tel_pro'];}else{echo $data_utilisateur['Tel_pro'];} ?>">
      <br>
      <br>
      <label><i class="fas fa-camera"></i>  Photo :</label>
      <div class="form-group">
      <input type="file" name="<?php echo $_SESSION['statut']; ?>" /> <br/>
      </div>
      <input type="submit" name="submit" class="btn btn-outline-warning" value="Valider">
      </form>
      <br>

    </div>
    <div class="col-6">
      <h5>Changement de mot de passe :</h5>
      <br>
      <h6>Le mot de passe doit contenir les éléments suivants :</h6>
      <p>--> au minimum 8 caracteres</p>
      <p>--> une lettre minuscule</p>
      <p>--> un lettre majuscule</p>
      <p>--> un chiffre</p>
      <p>--> un caractère spécial</p>
      <p>Pour changer de mot de passe, veuillez insérer votre mot de passe actuel ainsi que votre nouveau mot de passe :</p>
      <br>
    <form action="modification_mdp.php" method="post">
      <label>Mot de passe actuel :</label>
      <input type="password" name="Mot_de_passe" id="Mot_de_passe">
      <br>
      <label>Nouveau mot de passe :</label>
      <input type="password" name="Mot_de_passe1" id="Mot_de_passe1">
      <br>
      <label>Nouveau mot de passe :</label>
      <input type="password" name="Mot_de_passe2" id="Mot_de_passe2">
      <br>
      <br>
      <input type="submit" name="submit" class="btn btn-outline-danger" value="Changer de mot de passe">
      <br>
      <br>

    <?php
      if(isset($_GET['erreur'])){
                    $err = $_GET['erreur'];
                    if($err==1)
                        echo "<p style='color:red'>Vous n'avez pas rempli toutes vos informations !</p>";
                    if($err==2)
                        echo "<p style='color:red'>Le mot de passe actuel est incorrect !</p>";
                    if($err==3)
                        echo "<p style='color:red'>Les nouveaux mots de passe saisi ne sont pas identiques !</p>";
                    if($err==4)
                        echo "<p style='color:green'>Le mot de passe a été changé avec succès !</p>";
                    if($err==5)
                        echo "<p style='color:red'>Le nouveau mot de passe est le même que le précédent !</p>";
                    if($err==6)
                        echo "<p style='color:red'>Le mot de passe n'est pas assez sécurisé !</p>";
                }
    ?>

      <br>
    </form>


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