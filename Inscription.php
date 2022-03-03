<!DOCTYPE html>
<html>
<head>
  <title>Page d'inscription</title>
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

<?php include 'barre_de_navigation_connecte.php'; ?>

<div class="container">
  <div class="row">
    <div class="col-12">
    <br>
    <h3 class="text-center">Inscription des utilisateurs</h3>
<br>

<form action="" method="post">

<p>Je souhaite inscrire un : </p>
<button type="submit" name="Alternant" class="btn btn-outline-primary"><i class="fas fa-user-plus"></i> Alternant</button>
<button type="submit" name="Tuteur" class="btn btn-outline-success"><i class="fas fa-user-plus"></i> Tuteur</button>
<button type="submit" name="Superviseur" class="btn btn-outline-info"><i class="fas fa-user-plus"></i> Superviseur</button>
<button type="submit" name="Enseignant" class="btn btn-outline-danger"><i class="fas fa-user-plus"></i> Enseignant</button>
<button type="submit" name="Administrateur" class="btn btn-outline-dark"><i class="fas fa-user-plus"></i> Administrateur</button>
<button type="submit" name="Entreprise" class="btn btn-outline-warning"><i class="fas fa-building"></i> Entreprise</button>

</form>

<br>
<br>

<?php

$conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

if (isset($_POST['Alternant'])==True) {

$requet = $conn->prepare('SELECT * FROM tuteur');
$requet->execute();

$requet1 = $conn->prepare('SELECT * FROM enseignant');
$requet1->execute();

$requet2 = $conn->prepare('SELECT * FROM superviseur');
$requet3 = $conn->prepare('SELECT * FROM superviseur');
$requet2->execute();
$requet3->execute();
  
?>

<form action="" method="post">

<div class="text-dark bg-white border border-primary p-3 rounded">
  <div class="row">
    <div class="col-6">
      <h5>ALTERNANT</h5>
      <br> 
      <label>Nom :</label>
      <input type="text" name="Nom" id="Nom" onchange="identifiant() & mdp()"  required>
      <br>
      <br>
      <label>Prénom :</label>
      <input type="text" name="Prenom" id="Prenom" onchange="identifiant()" required>
      <br>
      <br>
      </div>
    <div class="col-6">
      <br>
      <br>
      <label>Identifiant :</label>
      <input type="text" name="Identifiant" id="Identifiant" required>
      <br>
      <br>
      <label>Mot de passe :</label>
      <input type="password" name="Mot_de_passe2" id="Mot_de_passe2" disabled="disabled" required>
      <input type="hidden" & type="password" name="Mot_de_passe" id="Mot_de_passe" required>
      <br>
      <br>
    </div>
  </div>
      <label>Email :</label>
      <input type="email" name="Email" id="Email" required>
      <br>
      <br>
      <div class="form-group">
  <label for="Annee" required>Année :</label>
  <select class="form-control" id="annee" name="Annee">
    <option value="" name="Annee"></option>
    <option value="1A" name="Annee">1ère Année</option>
    <option value="2AP1" name="Annee">2ème Année P1</option>
    <option value="2AP2" name="Annee">2ème Année P2</option>
    <option value="TRTE" name="Annee">TRTE</option>
  </select>
</div>

<?php

echo '<div class="form-group">
      <label for="Lestuteurs" required>Maître d\'apprentissage :</label>
      <select class="form-control" id="Lestuteurs" name="Lestuteurs">
      <option value="" name="Lestuteurs"></option>';
      while($repons = $requet->fetch()){
        echo '<option value="'.$repons['ID_tuteur'].'" name="Lestuteurs">'.$repons['Prenom'].' '.$repons['Nom'].'</option>';
      }
echo '</select> </div>

<div class="form-group">
      <label for="Lesenseignants" required>Tuteur enseignant :</label>
      <select class="form-control" id="Lesenseignants" name="Lesenseignants">
      <option value="" name="Lesenseignants"></option>';
      while ($repons1 = $requet1->fetch()) {
        echo '<option value="'.$repons1['ID_enseignant'].'" name="Lesenseignants">'.$repons1['Prenom'].' '.$repons1['Nom'].'</option>';
      }
echo '</select> </div>

<div class="form-group">
      <label for="Lessuperviseurs" required>Superviseur n°1 (facultatif) :</label>
      <select class="form-control" id="Lessuperviseurs" name="Lessuperviseurs">
      <option value="" name="Lessuperviseurs"></option>';
      while ($repons2 = $requet2->fetch()) {
        echo '<option value="'.$repons2['ID_superviseur'].'" name="Lessuperviseurs">'.$repons2['Prenom'].' '.$repons2['Nom'].'</option>';
      }
echo '</select> </div>

<div class="form-group">
      <label for="Lessuperviseurs2" required>Superviseur n°2 (facultatif) :</label>
      <select class="form-control" id="Lessuperviseurs2" name="Lessuperviseurs2">
      <option value="" name="Lessuperviseurs2"></option>';
      while ($repons3 = $requet3->fetch()) {
        echo '<option value="'.$repons3['ID_superviseur'].'" name="Lessuperviseurs2">'.$repons3['Prenom'].' '.$repons3['Nom'].'</option>';
      }
echo '</select> </div>';



?>
      <br>
    <input type="submit" name="submit" value="S'inscrire" class="btn btn-outline-primary">

</form>


<?php   

}

if (isset($_POST['Tuteur'])==True) {

$conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requet3 = $conn->prepare('SELECT * FROM entreprise');
$requet3->execute();

?>

<form action="" method="post">

<div class="text-dark bg-white border border-success p-3 rounded">
  <div class="row">
    <div class="col-6">
      <h5>TUTEUR</h5>
      <br> 
      <label>Nom :</label>
      <input type="text" name="Nom" id="Nom" onchange="identifiant() & mdp()"  required>
      <br>
      <br>
      <label>Prénom :</label>
      <input type="text" name="Prenom" id="Prenom" onchange="identifiant()" required>
      <br>
      <br>
      </div>
    <div class="col-6">
      <br>
      <br>
      <label>Identifiant :</label>
      <input type="text" name="Identifiant" id="Identifiant" required>
      <br>
      <br>
      <label>Mot de passe :</label>
      <input type="password" name="Mot_de_passe2" id="Mot_de_passe2" disabled="disabled" required>
      <input type="hidden" & type="password" name="Mot_de_passe" id="Mot_de_passe" required>
      <br>
    </div>
  </div> 
      <label>Email :</label>
      <input type="email" name="Email" id="Email" required>
      <br>
      <br>
    
      <?php

echo '<div class="form-group">
      <label for="entreprise" required>Entreprise :</label>
      <select class="form-control" id="entreprise" name="entreprise">
      <option value="" name="entreprise"></option>';
      while ($repons3 = $requet3->fetch()) {
        echo '<option value="'.$repons3['ID_entreprise'].'" name="entreprise">'.$repons3['Entreprise'].'</option>';
      }
echo '</select> </div>';

      ?>
      <br>
    <input type="submit" name="submit2" value="S'inscrire" class="btn btn-outline-success">

</form>


<?php   

}   

if (isset($_POST['Superviseur'])==True) {

$conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requet3 = $conn->prepare('SELECT * FROM entreprise');
$requet3->execute();

?>

<form action="" method="post">

<div class="text-dark bg-white border border-info p-3 rounded">
  <div class="row">
    <div class="col-12">
      <h5>SUPERVISEUR (Tuteur avec seulement des droits de lecture)</h5>
      <br> 
    </div>
    <div class="col-6">
      <label>Nom :</label>
      <input type="text" name="Nom" id="Nom" onchange="identifiant() & mdp()"  required>
      <br>
      <br>
      <label>Prénom :</label>
      <input type="text" name="Prenom" id="Prenom" onchange="identifiant()" required>
      <br>
      <br>
      </div>
    <div class="col-6">
      <br>
      <br>
      <label>Identifiant :</label>
      <input type="text" name="Identifiant" id="Identifiant" required>
      <br>
      <br>
      <label>Mot de passe :</label>
      <input type="password" name="Mot_de_passe2" id="Mot_de_passe2" disabled="disabled" required>
      <input type="hidden" & type="password" name="Mot_de_passe" id="Mot_de_passe" required>
      <br>
    </div>
  </div> 
      <label>Email :</label>
      <input type="email" name="Email" id="Email" required>
      <br>
      <br>
    
      <?php

echo '<div class="form-group">
      <label for="entreprise" required>Entreprise :</label>
      <select class="form-control" id="entreprise" name="entreprise">
      <option value="" name="entreprise"></option>';
      while ($repons3 = $requet3->fetch()) {
        echo '<option value="'.$repons3['ID_entreprise'].'" name="entreprise">'.$repons3['Entreprise'].'</option>';
      }
echo '</select> </div>';

      ?>
      <br>
    <input type="submit" name="submit6" value="S'inscrire" class="btn btn-outline-info">

</form>


<?php   

}   

if (isset($_POST['Enseignant'])==True) {

?>

<form action="" method="post">

<div class="text-dark bg-white border border-danger p-3 rounded">
  <div class="row">
    <div class="col-6">
      <h5>ENSEIGNANT</h5>
      <br> 
      <label>Nom :</label>
      <input type="text" name="Nom" id="Nom" onchange="identifiant() & mdp()"  required>
      <br>
      <br>
      <label>Prénom :</label>
      <input type="text" name="Prenom" id="Prenom" onchange="identifiant()" required>
      <br>
      <br>
    </div>
    <div class="col-6">
      <br>
      <br>
      <label>Identifiant :</label>
      <input type="text" name="Identifiant" id="Identifiant" required>
      <br>
      <br>
      <label>Mot de passe :</label>
      <input type="password" name="Mot_de_passe2" id="Mot_de_passe2" disabled="disabled" required>
      <input type="hidden" & type="password" name="Mot_de_passe" id="Mot_de_passe" required>
      <br>
    </div>
  </div> 
      <label>Email :</label>
      <input type="email" name="Email" id="Email" required>
      <br>
      <br>
    <input type="submit" name="submit3" value="S'inscrire" class="btn btn-outline-danger">

</form>

<?php

}

if (isset($_POST['Administrateur'])==True) {

?>

<form action="" method="post">

<div class="text-dark bg-white border border-dark p-3 rounded">
  <div class="row">
    <div class="col-6">
      <h5>ADMINISTRATEUR</h5>
      <br> 
      <label>Nom :</label>
      <input type="text" name="Nom" id="Nom" onchange="identifiant() & mdp()"  required>
      <br>
      <br>
      <label>Prénom :</label>
      <input type="text" name="Prenom" id="Prenom" onchange="identifiant()" required>
      <br>
      <br>
    </div>
    <div class="col-6">
      <br>
      <br>
      <label>Identifiant :</label>
      <input type="text" name="Identifiant" id="Identifiant" required>
      <br>
      <br>
      <label>Mot de passe :</label>
      <input type="password" name="Mot_de_passe2" id="Mot_de_passe2" disabled="disabled" required>
      <input type="hidden" & type="password" name="Mot_de_passe" id="Mot_de_passe" required>
      <br>
    </div>
  </div> 
      <label>Email :</label>
      <input type="email" name="Email" id="Email" required>
      <br>
      <br>
    <input type="submit" name="submit4" value="S'inscrire" class="btn btn-outline-dark">

</form>

<?php

}

if (isset($_POST['Entreprise'])==True) {

?>

<form action="" method="post" enctype="multipart/form-data">

<div class="text-dark bg-white border border-warning p-3 rounded">
      <h5>ENTREPRISE</h5>
      <br> 
      <label>Nom de l'entreprise :</label>
      <input type="text" name="entreprise" id="entreprise" required>
      <br>
      <br>
      <label>Logo :</label>
      <div class="form-group">
      <input type="file" class="form-control-file border" name="logo">
    </div>
      <br>
    <input type="submit" name="submit5" value="S'inscrire" class="btn btn-outline-dark">

</form>

<?php   

}  

if (isset($_POST['submit'])==True){

  $username =  htmlspecialchars($_POST['Identifiant']);// récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire
  $email =  htmlspecialchars($_POST['Email']);

  $tab = ['alternant', 'tuteur', 'enseignant', 'administrateur', 'superviseur'];
  $a = "";

  for ($i=0; $i < 5; $i++) { 
    $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $requete = $conn->prepare('SELECT * FROM '.$tab[$i].' WHERE Identifiant = ?');
    $requete->execute(array($username));
    $nb = $requete->rowCount();

    if ($nb!=0) {
    echo "<p class=\"text-danger\"><i class=\"fas fa-exclamation-triangle\"></i> L'identifiant ".$username." est déjà utilisé !\nL'inscription a échoué !</p>";
    $a = "impossible";}    
  }

for ($i=0; $i < 5; $i++) {
    $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $requete = $conn->prepare('SELECT * FROM '.$tab[$i].' WHERE Email_pro = ? OR Email_perso = ?');
    $requete->execute(array($email, $email));
    $nb = $requete->rowCount();

    if ($nb!=0) {
    echo "<p class=\"text-danger\"><i class=\"fas fa-exclamation-triangle\"></i> Le mail ".$email." est déjà utilisé !\nL'inscription a échoué !</p>";
    $a = "impossible";}  
  }
  if($a!="impossible"){

  $nom = htmlspecialchars($_POST['Nom']);  // récupérer le nom et supprimer les antislashes ajoutés par le formulaire
  $nom = strtoupper($nom);  //en majuscules
  $prenom = htmlspecialchars($_POST['Prenom']); // récupérer le prenom et supprimer les antislashes ajoutés par le formulaire
  $prenom = ucfirst($prenom);
  $password = htmlspecialchars($_POST['Mot_de_passe']); // récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
  $annee = htmlspecialchars($_POST['Annee']);
  $id_tuteur = htmlspecialchars($_POST['Lestuteurs']);
  $id_enseignant = htmlspecialchars($_POST['Lesenseignants']);
  $id_superviseur = htmlspecialchars($_POST['Lessuperviseurs']);
  $id2_superviseur = htmlspecialchars($_POST['Lessuperviseurs2']);

if($id_superviseur==0 && $id2_superviseur!=0){
  $id_superviseur = $id2_superviseur;
  $id2_superviseur = 0;
}

if($id_superviseur==$id2_superviseur){
  $id2_superviseur==0;
}

  if($annee!=null && $id_tuteur!=null && $id_enseignant!=null){
  $dest = $email;
  $sujet = "Inscription";
  $corp = "Bonjour, \nVous êtes officiellement inscrit comme alternant sur le site web \"livret de compétences des alternants\". 
  \nVotre identifiant est : ".$username." et votre mot de passe est : ".$password.". \nIl est très fortement recommandé de changer
  votre mot de passe lors de votre première connexion. \n\nCordialement, \nL'administrateur ;)";
  $headers = "From: iut35400@gmail.com";
  if (mail($dest, $sujet, $corp, $headers)) {
    echo "<p class=\"text-success\">L'email a été envoyé avec succès à $dest.</p>";
  } else {
    echo "<p class=\"text-danger\">Échec de l'envoi de l'email...</p>";
  }

  //le mot de passe n'est pas hashé lorsqu'il est envoyé à l'utilisateur mais il l'est lors de l'inscription dans la base de donnée
  $password = password_hash($password, PASSWORD_DEFAULT);

  //requéte SQL + mot de passe crypté
    $inscrit = $conn->prepare('INSERT INTO alternant (Identifiant, Mot_de_passe, Nom, Prenom, Email_pro, Annee, ID_tuteur, ID_superviseur, ID2_superviseur, ID_enseignant) VALUES (?,?,?,?,?,?,?,?,?,?)');

    $inscrit->execute(array($username, $password, $nom, $prenom, $email, $annee, $id_tuteur, $id_superviseur, $id2_superviseur, $id_enseignant));  // Exécuter la requête sur la base de données
    $inscrit->closeCursor();

    if($inscrit==true)
    { echo "<p class=\"text-success\"><i class=\"fas fa-check\"></i> Vous avez inscrit un alternant avec succès !</p>";
     }else{ echo "<p class=\"text-danger\"><i class=\"fas fa-exclamation-triangle\"></i> L'inscription a échoué !</p>"; }

   }else{echo "<p class=\"text-danger\"><i class=\"fas fa-exclamation-triangle\"></i> Toutes les informations ne sont pas saisies !\nL'inscription a échoué !</p>";}
  }

}


if (isset($_POST['submit2'])==True){

  $username = htmlspecialchars($_POST['Identifiant']); // récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire

  $email = htmlspecialchars($_POST['Email']);

  $tab = ['alternant', 'tuteur', 'enseignant', 'administrateur', 'superviseur'];
  $a = "";

  for ($i=0; $i < 5; $i++) { 
    $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $requete = $conn->prepare('SELECT * FROM '.$tab[$i].' WHERE Identifiant = ?');
    $requete->execute(array($username));
    $nb = $requete->rowCount();

    if ($nb!=0) {
    echo "<p class=\"text-danger\"><i class=\"fas fa-exclamation-triangle\"></i> L'identifiant ".$username." est déjà utilisé !\nL'inscription a échoué !</p>";
    $a = "impossible";}    
    }

    for ($i=0; $i < 5; $i++) {
      $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $requete = $conn->prepare('SELECT * FROM '.$tab[$i].' WHERE Email_pro = ? OR Email_perso = ?');
    $requete->execute(array($email, $email));
    $nb = $requete->rowCount();

    if ($nb!=0) {
    echo "<p class=\"text-danger\"><i class=\"fas fa-exclamation-triangle\"></i> Le mail ".$email." est déjà utilisé !\nL'inscription a échoué !</p>";
    $a = "impossible";}  
    } 

  if($a!="impossible"){

  $nom = htmlspecialchars($_POST['Nom']);  // récupérer le nom et supprimer les antislashes ajoutés par le formulaire
  $nom = strtoupper($nom);  //en majuscules
  $prenom = htmlspecialchars($_POST['Prenom']); // récupérer le prenom et supprimer les antislashes ajoutés par le formulaire
  $prenom = ucfirst($prenom);
  $password = htmlspecialchars($_POST['Mot_de_passe']); // récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
  $id_entreprise = htmlspecialchars($_POST['entreprise']);

  if($id_entreprise!=null){
  $dest = $email;
  $sujet = "Inscription";
  $corp = "Bonjour, \nVous êtes officiellement inscrit comme tuteur sur le site web \"livret de compétences des alternants\". 
  \nVotre identifiant est : ".$username." et votre mot de passe est : ".$password.". \nIl est très fortement recommandé de changer
  votre mot de passe lors de votre première connexion. \n\nCordialement, \nL'administrateur ;)";
  $headers = "From: iut35400@gmail.com";
  if (mail($dest, $sujet, $corp, $headers)) {
    echo "<p class=\"text-success\">L'email a été envoyé avec succès à $dest.</p>";
  } else {
    echo "<p class=\"text-danger\">Échec de l'envoi de l'email...</p>";
  }

  //le mot de passe n'est pas hashé lorsqu'il est envoyé à l'utilisateur mais il l'est lors de l'inscription dans la base de donnée
  $password = password_hash($password, PASSWORD_DEFAULT);

  //requéte SQL + mot de passe crypté
    $inscrit = $conn->prepare('INSERT INTO tuteur (Identifiant, Mot_de_passe, Nom, Prenom, Email_pro, ID_entreprise) VALUES (?,?,?,?,?,?)');
    $inscrit->execute(array($username, $password, $nom, $prenom, $email, $id_entreprise));  // Exécuter la requête sur la base de données
    $inscrit->closeCursor();

    if($inscrit==true)
    { echo "<p class=\"text-success\"><i class=\"fas fa-check\"></i> Vous avez inscrit un tuteur avec succès !</p>";
     }else{ echo "<p class=\"text-danger\"><i class=\"fas fa-exclamation-triangle\"></i> L'inscription a échoué !</p>"; }

   }else{echo "<p class=\"text-danger\"><i class=\"fas fa-exclamation-triangle\"></i> Toutes les informations ne sont pas saisies !\nL'inscription a échoué !</p>";}
  }

}

if (isset($_POST['submit6'])==True){

  $username = htmlspecialchars($_POST['Identifiant']); // récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire

  $email = htmlspecialchars($_POST['Email']);

  $tab = ['alternant', 'tuteur', 'enseignant', 'administrateur', 'superviseur'];
  $a = "";

  for ($i=0; $i < 5; $i++) { 
    $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $requete = $conn->prepare('SELECT * FROM '.$tab[$i].' WHERE Identifiant = ?');
    $requete->execute(array($username));
    $nb = $requete->rowCount();

    if ($nb!=0) {
    echo "<p class=\"text-danger\"><i class=\"fas fa-exclamation-triangle\"></i> L'identifiant ".$username." est déjà utilisé !\nL'inscription a échoué !</p>";
    $a = "impossible";}    
  }

  for ($i=0; $i < 5; $i++) {
    $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $requete = $conn->prepare('SELECT * FROM '.$tab[$i].' WHERE Email_pro = ? OR Email_perso = ?');
    $requete->execute(array($email, $email));
    $nb = $requete->rowCount();

    if ($nb!=0) {
    echo "<p class=\"text-danger\"><i class=\"fas fa-exclamation-triangle\"></i> Le mail ".$email." est déjà utilisé !\nL'inscription a échoué !</p>";
    $a = "impossible";}  
  }

  if($a!="impossible"){

  $nom = htmlspecialchars($_POST['Nom']);  // récupérer le nom et supprimer les antislashes ajoutés par le formulaire
  $nom = strtoupper($nom);  //en majuscules
  $prenom = htmlspecialchars($_POST['Prenom']); // récupérer le prenom et supprimer les antislashes ajoutés par le formulaire
  $prenom = ucfirst($prenom);
  $password = htmlspecialchars($_POST['Mot_de_passe']); // récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
  $id_entreprise = htmlspecialchars($_POST['entreprise']);

  if($id_entreprise!=null){
  $dest = $email;
  $sujet = "Inscription";
  $corp = "Bonjour, \nVous êtes officiellement inscrit comme superviseur sur le site web \"livret de compétences des alternants\". 
  \nVotre identifiant est : ".$username." et votre mot de passe est : ".$password.". \nIl est très fortement recommandé de changer
  votre mot de passe lors de votre première connexion. \n\nCordialement, \nL'administrateur ;)";
  $headers = "From: iut35400@gmail.com";
  if (mail($dest, $sujet, $corp, $headers)) {
    echo "<p class=\"text-success\">L'email a été envoyé avec succès à $dest.</p>";
  } else {
    echo "<p class=\"text-danger\">Échec de l'envoi de l'email...</p>";
  }

  //le mot de passe n'est pas hashé lorsqu'il est envoyé à l'utilisateur mais il l'est lors de l'inscription dans la base de donnée
  $password = password_hash($password, PASSWORD_DEFAULT);

  //requéte SQL + mot de passe crypté
    $inscrit = $conn->prepare('INSERT INTO superviseur (Identifiant, Mot_de_passe, Nom, Prenom, Email_pro, ID_entreprise) VALUES (?,?,?,?,?,?)');

    $inscrit->execute(array($username, $password, $nom, $prenom, $email, $id_entreprise));  // Exécuter la requête sur la base de données
    $inscrit->closeCursor();

    if($inscrit==true)
    { echo "<p class=\"text-success\"><i class=\"fas fa-check\"></i> Vous avez inscrit un tuteur avec succès !</p>";
     }else{ echo "<p class=\"text-danger\"><i class=\"fas fa-exclamation-triangle\"></i> L'inscription a échoué !</p>"; }

   }else{echo "<p class=\"text-danger\"><i class=\"fas fa-exclamation-triangle\"></i> Toutes les informations ne sont pas saisies !\nL'inscription a échoué !</p>";}
  }

}


if (isset($_POST['submit3'])==True){

  $username = htmlspecialchars($_POST['Identifiant']); // récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire

  $email = htmlspecialchars($_POST['Email']);

  $tab = ['alternant', 'tuteur', 'enseignant', 'administrateur', 'superviseur'];
  $a = "";

  for ($i=0; $i < 5; $i++) { 
    $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $requete = $conn->prepare('SELECT * FROM '.$tab[$i].' WHERE Identifiant = ?');
    $requete->execute(array($username));
    $nb = $requete->rowCount();

    if ($nb!=0) {
    echo "<p class=\"text-danger\"><i class=\"fas fa-exclamation-triangle\"></i> L'identifiant ".$username." est déjà utilisé !\nL'inscription a échoué !</p>";
    $a = "impossible";}    
  }

  for ($i=0; $i < 5; $i++) {
    $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $requete = $conn->prepare('SELECT * FROM '.$tab[$i].' WHERE Email_pro = ? OR Email_perso = ?');
    $requete->execute(array($email, $email));
    $nb = $requete->rowCount();

    if ($nb!=0) {
    echo "<p class=\"text-danger\"><i class=\"fas fa-exclamation-triangle\"></i> Le mail ".$email." est déjà utilisé !\nL'inscription a échoué !</p>";
    $a = "impossible";}  
  }

  if($a!="impossible"){

  $nom = htmlspecialchars($_POST['Nom']);  // récupérer le nom et supprimer les antislashes ajoutés par le formulaire
  $nom = strtoupper($nom);  //en majuscules
  $prenom = htmlspecialchars($_POST['Prenom']); // récupérer le prenom et supprimer les antislashes ajoutés par le formulaire
  $prenom = ucfirst($prenom);
  $password = htmlspecialchars($_POST['Mot_de_passe']); // récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire

  $dest = $email;
  $sujet = "Inscription";
  $corp = "Bonjour, \nVous êtes officiellement inscrit comme enseignant sur le site web \"livret de compétences des alternants\". 
  \nVotre identifiant est : ".$username." et votre mot de passe est : ".$password.". \nIl est très fortement recommandé de changer
  votre mot de passe lors de votre première connexion. \n\nCordialement, \nL'administrateur ;)";
  $headers = "From: iut35400@gmail.com";
  if (mail($dest, $sujet, $corp, $headers)) {
    echo "<p class=\"text-success\">L'email a été envoyé avec succès à $dest.</p>";
  } else {
    echo "<p class=\"text-danger\">Échec de l'envoi de l'email...</p>";
  }

  //le mot de passe n'est pas hashé lorsqu'il est envoyé à l'utilisateur mais il l'est lors de l'inscription dans la base de donnée
  $password = password_hash($password, PASSWORD_DEFAULT);

  //requéte SQL + mot de passe crypté
    $inscrit = $conn->prepare('INSERT INTO enseignant (Identifiant, Mot_de_passe, Nom, Prenom, Email_pro) VALUES (?,?,?,?,?)');
    $inscrit->execute(array($username, $password, $nom, $prenom, $email));  // Exécuter la requête sur la base de données
    $inscrit->closeCursor();

    if($inscrit==true)
    { echo "<p class=\"text-success\"><i class=\"fas fa-check\"></i> Vous avez inscrit un enseignant avec succès !</p>";
     }else{ echo "<p class=\"text-danger\"><i class=\"fas fa-exclamation-triangle\"></i> L'inscription a échoué !</p>"; }

  }

}


if (isset($_POST['submit4'])==True){

    $username = htmlspecialchars($_POST['Identifiant']); // récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire

  $email = htmlspecialchars($_POST['Email']);

  $tab = ['alternant', 'tuteur', 'enseignant', 'administrateur', 'superviseur'];
  $a = "";

  for ($i=0; $i < 5; $i++) { 
    $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $requete = $conn->prepare('SELECT * FROM '.$tab[$i].' WHERE Identifiant = ?');
    $requete->execute(array($username));
    $nb = $requete->rowCount();

    if ($nb!=0) {
    echo "<p class=\"text-danger\"><i class=\"fas fa-exclamation-triangle\"></i> L'identifiant ".$username." est déjà utilisé !\nL'inscription a échoué !</p>";
    $a = "impossible";}    
  }

  for ($i=0; $i < 5; $i++) {
    $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $requete = $conn->prepare('SELECT * FROM '.$tab[$i].' WHERE Email_pro = ? OR Email_perso = ?');
    $requete->execute(array($email, $email));
    $nb = $requete->rowCount();

    if ($nb!=0) {
    echo "<p class=\"text-danger\"><i class=\"fas fa-exclamation-triangle\"></i> Le mail ".$email." est déjà utilisé !\nL'inscription a échoué !</p>";
    $a = "impossible";}  
  }

  if($a!="impossible"){

  $nom = htmlspecialchars($_POST['Nom']);  // récupérer le nom et supprimer les antislashes ajoutés par le formulaire
  $nom = strtoupper($nom);  //en majuscules
  $prenom = htmlspecialchars($_POST['Prenom']); // récupérer le prenom et supprimer les antislashes ajoutés par le formulaire
  $prenom = ucfirst($prenom);
  $password = htmlspecialchars($_POST['Mot_de_passe']); // récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire

  $dest = $email;
  $sujet = "Inscription";
  $corp = "Bonjour, \nVous êtes officiellement inscrit comme administrateur sur le site web \"livret de compétences des alternants\". 
  \nVotre identifiant est : ".$username." et votre mot de passe est : ".$password.". \nIl est très fortement recommandé de changer
  votre mot de passe lors de votre première connexion. \n\nCordialement, \nL'administrateur ;)";
  $headers = "From: iut35400@gmail.com";
  if (mail($dest, $sujet, $corp, $headers)) {
    echo "<p class=\"text-success\">L'email a été envoyé avec succès à $dest.</p>";
  } else {
    echo "<p class=\"text-danger\">Échec de l'envoi de l'email...</p>";
  }

  //le mot de passe n'est pas hashé lorsqu'il est envoyé à l'utilisateur mais il l'est lors de l'inscription dans la base de donnée
  $password = password_hash($password, PASSWORD_DEFAULT);

  //requéte SQL + mot de passe crypté
    $inscrit = $conn->prepare('INSERT INTO administrateur (Identifiant, Mot_de_passe, Nom, Prenom, Email_pro) VALUES (?,?,?,?,?)');
    $inscrit->execute(array($username, $password, $nom, $prenom, $email));  // Exécuter la requête sur la base de données
    $inscrit->closeCursor();

    if($inscrit==true)
    { echo "<p class=\"text-success\"><i class=\"fas fa-check\"></i> Vous avez inscrit un administrateur avec succès !</p>";
     }else{ echo "<p class=\"text-danger\"><i class=\"fas fa-exclamation-triangle\"></i> L'inscription a échoué !</p>"; }
     
  }

}


if (isset($_POST['submit5'])==True){

  $entreprise = htmlspecialchars($_POST['entreprise']); // récupérer le nom et supprimer les antislashes ajoutés par le formulaire
  $entreprise = ucfirst($entreprise);

  if(!empty($_FILES)){
    $file_name = $_FILES['logo']['name'];
    $file_extension = strrchr($file_name, ".");
    
    $file_tmp_name = $_FILES['logo']['tmp_name'];
    $file_dest = 'files/'.$file_name;

    $extensions_autorisees = array('.jpg', '.JPG', '.img', '.IMG', '.png', '.PNG');

    if(in_array($file_extension, $extensions_autorisees)){
      if(move_uploaded_file($file_tmp_name, $file_dest)){ 

$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$result = $bdd->prepare('INSERT INTO entreprise (Entreprise, name, file_url) VALUES (?,?,?)');
$result = $result->execute(array($entreprise, $file_name, $file_dest));

if($result)
    { echo "<p class=\"text-success\"><i class=\"fas fa-check\"></i> Vous avez inscrit une entreprise avec succès !</p>";
     }else{ echo "<p class=\"text-danger\"><i class=\"fas fa-exclamation-triangle\"></i> L'inscription a échoué !</p>"; }

}}}else{

$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$result = $bdd->prepare('INSERT INTO entreprise (Entreprise) VALUES (?)');
//var_dump($inscrit);
$result = $result->execute(array($entreprise));
if($result)
    { echo "<p class=\"text-success\"><i class=\"fas fa-check\"></i> Vous avez inscrit une entreprise (sans logo) avec succès !</p>";
     }else{ echo "<p class=\"text-danger\"><i class=\"fas fa-exclamation-triangle\"></i> L'inscription a échoué !</p>"; }


}

}


 ?>
 

</div>
</div>
</div>
</div>

<br>
<br>
<footer>
 <?php include ("Pied_de_page.php"); ?>
</footer>
</body>
 <script language="JavaScript">

  function identifiant()
  {
    var nom = document.getElementById("Nom").value.replace(/\s/g,"");  //récupere la valeur de l'input Nom
    var prenom = document.getElementById("Prenom").value;  //récupere la valeur de l'input Prenom

    var prenom2lettres = prenom.substring(0,1);  //récupere la 1ère lettre du prenom
    var username = prenom2lettres + nom;  //concaténation de le 1ère lettre du prénom et du nom = identifiant
    username = username.toLowerCase(); //identifiant en minuscules
    document.getElementById('Identifiant').value = username;  //achiffage de username dans le champ d'id="Identifiant"
  }

  function mdp() {
        var chaine ="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPKRSTUVWXYZ0123456789";

        function creerMdp(){ mdp='';
        for(i=0; i < 10; i++){  //mdp contient 10 caractères
        mdp += chaine[Math.floor(Math.random()*chaine.length)];  //sélectionne un caractère de la variable chaine
        }
        return mdp;
        }

        var mdp = creerMdp();
        document.getElementById('Mot_de_passe').value = mdp;
        document.getElementById('Mot_de_passe2').value = mdp;
        }

</script>
</html>