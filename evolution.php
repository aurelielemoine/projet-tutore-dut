<!DOCTYPE html>
<html>
<head>
	<title>Page d'évolution</title>
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
if($_SESSION['statut']!='alternant')
                {
                  $id=$_SESSION['dataalt']['ID_alternant'];
                }
                else{
                  $id = $_SESSION['ID_alternant'];
                }

$conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT Annee FROM alternant WHERE ID_alternant=?');
$requete->execute(array($id));
while($data = $requete->fetch())
{
  $annee=$data['Annee'];
}
$requete->closeCursor();

if($annee=='2AP1' || $annee=='2AP2'){
  $annee='2A';
}

?>

<div class="container">
  <div class="row">
    <div class="col-12">
    <br>
    <h3 class="text-center">L'évolution au cours de l'année</h3>
<br>

<form action="" method="post">
<?php if($annee!='TRTE'){ ?>
<p>Je souhaite observer mon évolution du semestre : </p>
<button type="submit" name="semestre1" class="btn btn-outline-primary"><i class="fas fa-calendar"></i> Semestre 1</button>
<button type="submit" name="semestre2" class="btn btn-outline-success"><i class="fas fa-calendar"></i> Semestre 2</button>
<button type="submit" name="semestre3" class="btn btn-outline-danger"><i class="fas fa-calendar"></i> Semestre 3</button>
<button type="submit" name="semestre4" class="btn btn-outline-dark"><i class="fas fa-calendar"></i> Semestre 4</button>
<?php }else{ ?>

<div class="container">
<div class="row">
<div class="col-sm-12">

  <table class="table table-bordered table-sm">
    <thead>
      <tr class="thead-light">
        <th></th>
        <th class="align-middle text-center">Compétences</th>

<?php

$db = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $db->prepare('SELECT * FROM calendriers');
$requete->execute();
while($data_1 = $requete->fetch())
{
  $data1=$data_1;
}
$requete->closeCursor();

  $nom = strrchr($data1[$annee], '/');

  if (($handle = fopen('data'.$nom, "r")) !== FALSE) {
     while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
      $tab[] = $data; //récupère les valeurs dans un tableau
    }
    fclose($handle);
  }

$fileLines = file('data'.$nom.'');
$nb_ligne = count($fileLines);
//de 1 jusqu'à la derniere ligne du fichier
for($p=1; $p < $nb_ligne;$p++){
  
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='se'){
  setlocale(LC_TIME, "fr_FR", "French");
echo '<th class="align-middle text-center">Du '.utf8_encode(strftime("%d %B %G", strtotime($date_debut))).' au '.utf8_encode(strftime("%d %B %G", strtotime($date_fin))).'</th>';

}
}

echo '<tr>
</thead>
    <tbody>
      <tr>
      <td rowspan="5" class="align-middle text-center"> Critère personnel et comportemental </td>
      <td class="align-middle text-center"> Adaptation à l\'entreprise (culture, règles, personnels) </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='se'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence1'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td class="align-middle text-center"> Capacité d\'adaptation au poste </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='se'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence2'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td class="align-middle text-center"> Autonomie, esprit d\'initiative </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='se'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence3'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td class="align-middle text-center"> Créativité, imagination </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='se'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence4'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
      <td class="align-middle text-center"> Capacité de communication </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='se'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence5'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td rowspan="8" class="align-middle text-center"> Compétences </td>
    <td class="align-middle text-center"> Aptitude à progresser </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='se'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence6'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td class="align-middle text-center"> Aptitude à mettre en oeuvre les outils </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='se'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence7'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td class="align-middle text-center"> Capacité à appliquer les méthodes </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='se'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence8'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td class="align-middle text-center"> Rigueur, organisation </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='se'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence9'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
      <td class="align-middle text-center"> Capacité d\'analyse </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='se'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence10'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td class="align-middle text-center"> Esprit de synthèse </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='se'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence11'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td class="align-middle text-center"> Aptitude à se documenter soi-même </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='se'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence12'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td class="align-middle text-center"> Aptitude à rendre compte </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='se'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence13'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td rowspan="2" class="align-middle text-center"> Aptitude à remplir sa mission </td>
    <td class="align-middle text-center"> Capacité à travailler en équipe </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='se'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence14'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td class="align-middle text-center"> Sens des responsablités </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='se'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence15'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    </tbody>
  </table>
  </div>
</div>
</div>';
}

 ?>

</form>
<br>
<?php

if (isset($_POST['semestre1'])==True) {

?>
<div class="container">
<div class="row">
<div class="col-sm-12">

  <table class="table table-bordered table-sm">
    <thead>
      <tr class="thead-light">
        <th></th>
        <th class="align-middle text-center">Compétences</th>

<?php

if($annee=='2A'){
  $annee='1AA';
}

$db = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $db->prepare('SELECT * FROM calendriers');
$requete->execute();
while($data_1 = $requete->fetch())
{
  $data1=$data_1;
}
$requete->closeCursor();

  $nom = strrchr($data1[$annee], '/');

  if (($handle = fopen('data'.$nom.'', "r")) !== FALSE) {
     while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
      $tab[] = $data; //récupère les valeurs dans un tableau
    }
    fclose($handle);
  }

$fileLines = file('data'.$nom.'');
$nb_ligne = count($fileLines);
//de 1 jusqu'à la derniere ligne du fichier
for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S1'){
  setlocale(LC_TIME, "fr_FR", "French");
echo '<th class="align-middle text-center">Du '.utf8_encode(strftime("%d %B %G", strtotime($date_debut))).' au '.utf8_encode(strftime("%d %B %G", strtotime($date_fin))).'</th>';

}
}

echo '<tr>
</thead>
    <tbody>
      <tr>
      <td rowspan="4" class="align-middle text-center"> Comportement, communication, intégration </td>
      <td class="align-middle text-center"> Assiduité, ponctualité </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S1'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence1'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td class="align-middle text-center"> Politesse, sociabilité </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S1'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence2'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td class="align-middle text-center"> Dynamisme, enthousiasme </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S1'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence3'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td class="align-middle text-center"> Capacité à décrire son activité </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S1'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence4'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td rowspan="5" class="align-middle text-center"> Compréhension de l\'environnement professionnel </td>
      <td class="align-middle text-center"> Capacité d\'observation </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S1'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence5'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td class="align-middle text-center"> Aptitude à s\'approprier des méthodes de travail, de nouveaux outils </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S1'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence6'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td class="align-middle text-center"> Capacité à faire part de ses difficultés </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S1'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence7'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td class="align-middle text-center"> Capacité à se renseigner, se documenter </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S1'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence8'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td class="align-middle text-center"> Capacité à reproduire une activité en étant guidé </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S1'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence9'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td rowspan="3" class="align-middle text-center"> Compétences organisationnelles </td>
      <td class="align-middle text-center"> Capacité à prendre des notes </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S1'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence10'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td class="align-middle text-center"> Organisation de l\'espace de travail </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S1'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence11'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td class="align-middle text-center"> Acquisition du vocabulaire métier </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S1'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence12'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    </tbody>
  </table>
  </div>
</div>
</div>';
}

if (isset($_POST['semestre2'])==True) {

if($annee=='2A'){
  $annee='1AA';
}

echo '<div class="container">
<div class="row">
<div class="col-sm-12">

  <table class="table table-bordered table-sm">
    <thead>
      <tr class="thead-light">
        <th> </th>
        <th class="align-middle text-center">Compétences</th>';

$db = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $db->prepare('SELECT * FROM calendriers');
$requete->execute();
while($data_1 = $requete->fetch())
{
  $data1=$data_1;
}
$requete->closeCursor();

  $nom = strrchr($data1[$annee], '/');

  if (($handle = fopen('data'.$nom.'', "r")) !== FALSE) {
     while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
      $tab[] = $data; //récupère les valeurs dans un tableau
    }
    fclose($handle);
  }

$fileLines = file('data'.$nom.'');
$nb_ligne = count($fileLines);
//de 1 jusqu'à la derniere ligne du fichier
for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S2'){
  setlocale(LC_TIME, "fr_FR", "French");
echo '<th class="align-middle text-center">Du '.utf8_encode(strftime("%d %B %G", strtotime($date_debut))).' au '.utf8_encode(strftime("%d %B %G", strtotime($date_fin))).'</th>';

}
}

echo '<tr>
</thead>
    <tbody>
      <tr>
      <td rowspan="5" class="align-middle text-center"> Comportement, communication, intégration </td>
      <td class="align-middle text-center"> Intégration au sein de l\'équipe </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S2'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence1'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td class="align-middle text-center"> Implication, motivation </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S2'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence2'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td class="align-middle text-center"> Curiosité pour les tâches à effectuer </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S2'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence3'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td class="align-middle text-center"> Ténacité </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S2'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence4'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td class="align-middle text-center"> Capacité à expliquer son activité </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S2'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence5'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td rowspan="5" class="align-middle text-center"> Compréhension de l\'environnement professionnel </td>
      <td class="align-middle text-center"> Capacité à vérifier son travail </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S2'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence6'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td class="align-middle text-center"> Capacité à signaler un problème, une erreur </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S2'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence7'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td class="align-middle text-center"> Capacité à questionner pour comprendre </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S2'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence8'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td class="align-middle text-center"> Respect des règles, procédures et méthodes </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S2'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence9'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td class="align-middle text-center"> Capacité à reproduire une activité sans intervention du tuteur </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S2'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence10'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td rowspan="3" class="align-middle text-center"> Compétences organisationnelles </td>
      <td class="align-middle text-center"> Capacité à traiter les informations </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S2'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence11'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td class="align-middle text-center"> Capacité à prévoir les moyens nécessaires à l\'activité </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S2'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence12'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td class="align-middle text-center"> Connaissance théorique des tâches élémentaires </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S2'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence13'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    </tbody>
  </table>
  </div>
</div>
</div>';

}
if (isset($_POST['semestre3'])==True) {

echo '<div class="container">
<div class="row">
<div class="col-sm-12">

  <table class="table table-bordered table-sm">
    <thead>
      <tr class="thead-light">
        <th> </th>
        <th class="align-middle text-center">Compétences</th>';

$db = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $db->prepare('SELECT * FROM calendriers');
$requete->execute();
while($data_1 = $requete->fetch())
{
  $data1=$data_1;
}
$requete->closeCursor();

  $nom = strrchr($data1[$annee], '/');

  if (($handle = fopen('data'.$nom.'', "r")) !== FALSE) {
     while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
      $tab[] = $data; //récupère les valeurs dans un tableau
    }
    fclose($handle);
  }

$fileLines = file('data'.$nom.'');
$nb_ligne = count($fileLines);
//de 1 jusqu'à la derniere ligne du fichier
for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S3'){
  setlocale(LC_TIME, "fr_FR", "French");
echo '<th class="align-middle text-center">Du '.utf8_encode(strftime("%d %B %G", strtotime($date_debut))).' au '.utf8_encode(strftime("%d %B %G", strtotime($date_fin))).'</th>';

}
}

echo '<tr>
</thead>
    <tbody>
      <tr>
      <td rowspan="5" class="align-middle text-center"> Comportement, communication, intégration </td>
      <td class="align-middle text-center"> Capacité d\'écoute </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S3'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence1'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td class="align-middle text-center"> Réaction face aux conseils et remarques </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S3'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence2'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td class="align-middle text-center"> Relation clientèle / utilisateurs </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S3'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence3'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td class="align-middle text-center"> Capacité à analyser son activité </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S3'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence4'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td class="align-middle text-center"> Qualité de l\'expression écrite / orale </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S3'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence5'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td rowspan="5" class="align-middle text-center"> Maîtrise de l\'environnement professionnel </td>
      <td class="align-middle text-center"> Capacité à analyser un problème </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S3'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence6'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td class="align-middle text-center"> Capacité à s\'adapyer à des situations nouvelles et / ou complexes </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S3'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence7'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td class="align-middle text-center"> Capacité à surmonter ses difficultés </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S3'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence8'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td class="align-middle text-center">Capacité à travailler en équipe </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S3'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence9'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td class="align-middle text-center"> Capacité à agir en autonomie </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S3'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence10'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td rowspan="5" class="align-middle text-center"> Optimisation, efficacité, autonomie </td>
      <td class="align-middle text-center"> Respect des engagements </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S3'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence11'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td class="align-middle text-center"> Prise d\'autonomie </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S3'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence12'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td class="align-middle text-center"> Qualité du travail effectué </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S3'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence13'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td class="align-middle text-center"> Capacité à gérer son temps </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S3'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence14'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td class="align-middle text-center"> Connaissances théoriques des tâches complexes </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S3'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence15'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    </tbody>
  </table>
  </div>
</div>
</div>';

}
if (isset($_POST['semestre4'])==True) {

echo '<div class="container">
<div class="row">
<div class="col-sm-12">

  <table class="table table-bordered table-sm">
    <thead>
      <tr class="thead-light">
        <th> </th>
        <th class="align-middle text-center">Compétences</th>';

$db = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $db->prepare('SELECT * FROM calendriers');
$requete->execute();
while($data_1 = $requete->fetch())
{
  $data1=$data_1;
}
$requete->closeCursor();

  $nom = strrchr($data1[$annee], '/');

  if (($handle = fopen('data'.$nom.'', "r")) !== FALSE) {
     while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
      $tab[] = $data; //récupère les valeurs dans un tableau
    }
    fclose($handle);
  }

$fileLines = file('data'.$nom.'');
$nb_ligne = count($fileLines);
//de 1 jusqu'à la derniere ligne du fichier
for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S4'){
  setlocale(LC_TIME, "fr_FR", "French");
echo '<th class="align-middle text-center">Du '.utf8_encode(strftime("%d %B %G", strtotime($date_debut))).' au '.utf8_encode(strftime("%d %B %G", strtotime($date_fin))).'</th>';

}
}

echo '<tr>
</thead>
    <tbody>
      <tr>
      <td rowspan="4" class="align-middle text-center"> Comportement, communication, intégration </td>
      <td class="align-middle text-center"> Capacité à échanger, partager ses connaissances </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S4'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence1'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td class="align-middle text-center"> Relation clientèle / utilisateurs </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S4'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence2'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td class="align-middle text-center"> Capacité à auto évaluer ses compétences </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S4'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence3'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
      <td class="align-middle text-center"> Qualité des présentations écrites / orales </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S4'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence4'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td rowspan="4" class="align-middle text-center"> Maîtrise de l\'environnement professionnel </td>
    <td class="align-middle text-center"> Capacité à résoudre un problème </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S4'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence5'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
      <td class="align-middle text-center"> Capacité à rendre compte de choix techniques </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S4'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence6'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td class="align-middle text-center"> Capacité à participer / à mener un projet </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S4'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence7'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td class="align-middle text-center"> Capacité à faire partie intégrante de l\'équipe </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S4'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence8'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td rowspan="5" class="align-middle text-center"> Autonomie, efficacité, optimisation </td>
    <td class="align-middle text-center"> Capacité à prendre des initiatives </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S4'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence9'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td class="align-middle text-center"> Capacité à agir en autonomie </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S4'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence10'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
      <td class="align-middle text-center"> Conscience professionnelle </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S4'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence11'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td class="align-middle text-center"> Capacité à optimiser son temps </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S4'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence12'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    <tr>
    <td class="align-middle text-center"> Maîtrise théorique de son activité </td>';

for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$semestre = substr($tab[$p][0], -2);

if($semestre=='S4'){
  $erreur=1;
  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete->execute(array($id, $date_debut, $date_fin, $annee));
while($data = $requete->fetch())
{
  echo '<td class="align-middle text-center">'.$data['competence13'].'</td>';
  $erreur=0;    
}
$requete->closeCursor();

if($erreur==1){ echo '<td> </td>'; }

}
}

echo '</tr>
    </tbody>
  </table>
  </div>
</div>
</div>';

}
?>
<br>
<br>
</body>
</html>