<!DOCTYPE html>
<html lang="en">
<head>
  <title>grille d'évaluation</title>
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
?>
<div class="container">
<div class="row">
<div class="col-sm-12">

<br>
  <h3 class="text-center">Grille d'évaluation des apprentis en entreprise</h3>
<br>

<?php if($annee!='TRTE'){ ?>

  <table class="table table-bordered table-sm">
    <thead>
      <tr class="thead-light">
        <th class="align-middle text-center">Première année</th>
        <th class="align-middle text-center">Attentes du semestre</th>
        <th class="align-middle text-center">Comportement Communication Intégration</th>
        <th class="align-middle text-center">Compréhension de l'environnement professionnel</th>
        <th class="align-middle text-center">Compétences organisationnelles</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td style="background-color : #f1c40f" class="align-middle text-center">S1</td>
        <td style="background-color : #f4d03f" class="align-middle text-center">Intégration</td>
        <td style="background-color : #f7dc6f" class="align-middle"> 
          <label>Assiduité, ponctualité <br>
             Politesse, sociabilité <br>
             Dynamisme, enthousiasme <br>
             Capacité à décrire son activité </label>

        <td style="background-color : #f9e79f" class="align-middle">
          <label>Capacité d'observation <br>
             Aptitude à s'approprier des méthodes de travail, de nouveaux outils <br>
             Capacité à faire part de ses difficultés <br>
             Capacité à se renseigner, se documenter <br>
             Capacité à reproduire une activité en étant guidé </label>

        <td style="background-color : #fcf3cf" class="align-middle">
          <label>Capacité à prendre des notes <br>
             Organisation de l'espace de travail <br>
             Acquisition du vocabulaire métier </label>
      </tr>
      <tr>
        <td style="background-color : #f39c12" class="align-middle text-center">S2</td>
        <td style="background-color : #f5b041" class="align-middle text-center">Montée en compétences</td>
        <td style="background-color : #f8c471" class="align-middle">
          <label>Intégration au seine de l'équipe <br>
             Implication, motivation <br>
             Curiosité pour les tâches à effectuer <br>
             Ténacité <br>
             Capacité à expliquer son activité </label>

        <td style="background-color : #fad7a0" class="align-middle">
          <label>Capacité à vérifier son travail <br>
             Capacité à signaler un problème, une erreur <br>
             Capacité à questionner pour comprendre <br>
             Respect des règles, procédures et méthodes <br>
             Capacité à reproduire une activité sans intervention du tuteur </label>

        <td style="background-color : #fdebd0" class="align-middle">
          <label>Capacité à traiter les informations nouvelles <br>
             Capacité à prévoir les moyens nécessaires à l'activité <br>
             Connaissance théorique des tâches élémentaires </label>
      </tr>
    </tbody>
    <thead>
      <tr class="thead-light">
      <th>Deuxième année</th>
        <th class="align-middle text-center">Attentes du semestre</th>
        <th class="align-middle text-center">Comportement Communication Intéraction</th>
        <th class="align-middle text-center">Maîtrise de l'environnement professionnel</th>
        <th class="align-middle text-center">Optimisation Efficacité Autonomie</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td style="background-color : #e67e22" class="align-middle text-center">S3</td>
        <td style="background-color : #eb984e" class="align-middle text-center">Accession à l'autonomie</td>
        <td style="background-color : #f0b27a" class="align-middle">
          <label>Capacité d'écoute <br>
             Réaction face aux conseils et remarques <br>
             Relation clientèle/utilisateurs <br>
             Capacité à analyser son activité <br>
             Qualité de l'expression écrite/orale </label>

        <td style="background-color : #f5cba7" class="align-middle">
          <label>Capacité à analyser un problème <br>
             Capacité à s'adapter à des situations nouvelles et/ou complexes <br>
             Capacité à surmonter ses difficultés <br>
             Capacité à travailler en équipe <br>
             Capacité à agir en autonomie </label>

        <td style="background-color : #fae5d3" class="align-middle">
          <label>Respect des engagements <br>
             Prise d'autonomie <br>
             Qualité du travail effectué <br>
             Capacité à gérer son temps <br>
             Connaissances théoriques des tâches complexes </label>
      </tr>
      <tr>
        <td style="background-color : #e74c3c" class="align-middle text-center">S4</td>
        <td style="background-color : #ec7063" class="align-middle text-center">Technicien opérationnel</td>
        <td style="background-color : #f1948a" class="align-middle">
          <label>Capacité à échanger, partages ses connaissances <br>
             Relation clientèle/utilisateurs <br>
             Capacité à auto évaluer ses compétences </label>

        <td style="background-color : #f5b7b1" class="align-middle">
          <label>Capacité à résoudre un problème <br>
             Capacité à rendre compte de choix techniques <br>
             Capacité à participer/à mener un projet <br>
             Capacité à faire partie intégrante de l'équipe </label>

        <td style="background-color : #fadbd8" class="align-middle">
          <label>Capacité à prendre des initiatives <br>
             Autonomie <br>
             Conscience professionnelle <br>
             Capacité à optimiser son temps <br>
             Maîtrise théorique de son activité </label>
      </tr>
    </tbody>
  </table>

<?php }else{ ?>

<table class="table table-bordered table-sm">
    <thead>
      <tr class="thead-light">
        <th class="align-middle text-center">Critère personnel et comportemental</th>
        <th class="align-middle text-center">Compétences</th>
        <th class="align-middle text-center">Aptitude à remplir sa mission</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td style="background-color : #f7dc6f" class="align-middle"> 
          <label>Adaptation à l'entreprise (culture, règles, personnels) <br>      
          Capacité d'adaptation au poste <br>       
          Autonomie, esprit d'initiative <br>        
          Créativité, imagination <br>        
          Capacité de communication <br></label>

        <td style="background-color : #f9e79f" class="align-middle">
          <label>Aptitude à progresser <br>         
Aptitude à mettre en oeuvre les outils <br>         
Capacité à appliquer les méthodes <br>        
Rigueur, organisation  <br>       
Capacité d'analyse   <br>       
Esprit de synthèse   <br>       
Aptitude à se documenter soi-même <br>        
Aptitude à rendre compte </label>

        <td style="background-color : #fcf3cf" class="align-middle">
          <label>Capacité à travailler en équipe <br>         Sens des responsablités </label>
      </tr>
    </tbody>
  </table>

<?php } ?>
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