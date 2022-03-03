<?php

session_start();

if (!isset($_SESSION['Identifiant']))
{header ('Location: Page_de_connexion.php'); exit();}

if((time()-$_SESSION['temps']) >= 900)
{
  header("Location:deconnexion.php");
}else{$_SESSION['temps']=time();}


if($_SESSION['Identifiant'] !== ""){

//récupère les informations de l'utilisateur
$db = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $db->prepare('SELECT * FROM '.$_SESSION['statut'].' WHERE Identifiant=?');
$requete->execute(array($_SESSION['Identifiant']));
while($data = $requete->fetch()){
  if($_SESSION['statut']=='alternant'){$_SESSION['dataalt']=$data;}

//récupération de l'identifiant de l'alternant sélectioné par le tuteur, l'enseignant ou l'administrateur
if(isset($_POST['valideraltern'])==True){
$alt = $_POST['altern'];

if ($alt!=NULL) {
$dbalt = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requetealt = $dbalt->prepare('SELECT * FROM alternant WHERE ID_alternant=?');
$requetealt->execute(array($alt));
while($dataalt = $requetealt->fetch()){
$_SESSION['dataalt']=$dataalt;                
}
}
  
header('Location:Compteutilisateur_'.$_SESSION['statut'].'.php');

}
        
echo '<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <a class="navbar-brand" href="Page_d_accueil_connecté.php"><i class="fas fa-home"></i>    Accueil</a>';

echo '<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>';


if($_SESSION['statut']!='alternant'){
      if($_SESSION['dataalt']['Annee']=='1A'){
    echo '<div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item active">
          <a class="navbar-brand" href="calendrier1A.php">
            Calendrier
          </a>
        </li>
        <li class="nav-item active">
          <a class="navbar-brand" href="Page_de_competences_1ere_annee.php">
            Programme
          </a>
        </li>
        <li class="nav-item active">
          <a class="navbar-brand" href="Page_de_notes_1ere_annee.php">
            Notes
          </a>
        </li>'; 
    }
    elseif($_SESSION['dataalt']['Annee']=='2AP1'||$_SESSION['dataalt']['Annee']=='2AP2'){
    echo '<div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item dropdown">
      <a class="navbar-brand dropdown-toggle" id="navbardrop" data-toggle="dropdown" href="#">
        Calendrier
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="calendrier1AA.php">1ère Année</a>
        <a class="dropdown-item" href="calendrier2A.php">2ème Année</a>
      </div>
    </li>
    <li class="nav-item dropdown">
      <a class="navbar-brand dropdown-toggle" id="navbardrop" data-toggle="dropdown" href="#">
        Programme
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="Page_de_competences_1ere_annee.php">1ère Année</a>
        <a class="dropdown-item" href="Page_de_competences_2eme_annee.php">2ème Année</a>
      </div>
    </li>
    <li class="nav-item dropdown">
      <a class="navbar-brand dropdown-toggle" id="navbardrop" data-toggle="dropdown" href="#">
        Notes
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="Page_de_notes_1ere_annee.php">1ère Année</a>';
        if($_SESSION['dataalt']['Annee']=='2AP1'){
          echo '<a class="dropdown-item" href="Page_de_notes_2eme_annee.php">2ème Année</a>';
        }
        if($_SESSION['dataalt']['Annee']=='2AP2'){
          echo '<a class="dropdown-item" href="Page_de_notes_2eme_annee_P2.php">2ème Année</a>';
        }
      echo '</div>
    </li>';
    }
    elseif($_SESSION['dataalt']['Annee']=='TRTE'){
    echo '<div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item active">
          <a class="navbar-brand" href="calendrierTRTE.php">
            Calendrier
          </a>
        </li>
        <li class="nav-item active">
          <a class="navbar-brand" href="Page_de_competences_TRTE.php">
            Programme
          </a>
        </li>
        <li class="nav-item active">
          <a class="navbar-brand" href="Page_de_notes_TRTE.php">
            Notes
          </a>
        </li>';
    }
}else{
            if($_SESSION['Annee']=='1A'){
      echo '<div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item active">
            <a class="navbar-brand" href="calendrier1A.php">
              Calendrier
            </a>
          </li>
          <li class="nav-item active">
            <a class="navbar-brand" href="Page_de_competences_1ere_annee.php">
              Programme
            </a>
          </li>
          <li class="nav-item active">
            <a class="navbar-brand" href="Page_de_notes_1ere_annee.php">
              Notes
            </a>
          </li>'; 
      }
      elseif($_SESSION['Annee']=='2AP1'||$_SESSION['Annee']=='2AP2'){
      echo '<div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item dropdown">
      <a class="navbar-brand dropdown-toggle" id="navbardrop" data-toggle="dropdown" href="#">
        Calendrier
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="calendrier1AA.php">1ère Année</a>
        <a class="dropdown-item" href="calendrier2A.php">2ème Année</a>
      </div>
    </li>
    <li class="nav-item dropdown">
      <a class="navbar-brand dropdown-toggle" id="navbardrop" data-toggle="dropdown" href="#">
        Programme
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="Page_de_competences_1ere_annee.php">1ère Année</a>
        <a class="dropdown-item" href="Page_de_competences_2eme_annee.php">2ème Année</a>
      </div>
    </li>
    <li class="nav-item dropdown">
      <a class="navbar-brand dropdown-toggle" id="navbardrop" data-toggle="dropdown" href="#">
        Notes
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="Page_de_notes_1ere_annee.php">1ère Année</a>';
        if($_SESSION['dataalt']['Annee']=='2AP1'){
          echo '<a class="dropdown-item" href="Page_de_notes_2eme_annee.php">2ème Année</a>';
        }
        if($_SESSION['dataalt']['Annee']=='2AP2'){
          echo '<a class="dropdown-item" href="Page_de_notes_2eme_annee_P2.php">2ème Année</a>';
        }
      echo '</div>
    </li>';
      }
      elseif($_SESSION['Annee']=='TRTE'){
      echo '<div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item active">
            <a class="navbar-brand" href="calendrierTRTE.php">
              Calendrier
            </a>
          </li>
          <li class="nav-item active">
            <a class="navbar-brand" href="Page_de_competences_TRTE.php">
              Programme
            </a>
          </li>
          <li class="nav-item active">
            <a class="navbar-brand" href="Page_de_notes_TRTE.php">
              Notes
            </a>
          </li>';
      }
}

echo '<li class="nav-item dropdown">
      <a class="navbar-brand dropdown-toggle" id="navbardrop" data-toggle="dropdown" href="#">
        Suivi
      </a>
      <div class="dropdown-menu">
   <a class="dropdown-item" href="Grille_d_évaluation.php">Grille d\'évaluation</a>
   <a class="dropdown-item" href="evolution.php">Suivi de l\'évolution</a>
   </div>
    </li>';

if ($_SESSION['statut']=='administrateur') {
  echo '<li class="nav-item active">
   <a class="navbar-brand" href="Inscription.php">Inscription</a>
    </li>
    <li class="nav-item active">
   <a class="navbar-brand" href="Gestion_des_utilisateurs.php">Gestion</a>
    </li>
    <li class="nav-item dropdown">
      <a class="navbar-brand dropdown-toggle" id="navbardrop" data-toggle="dropdown" href="#">
        Modif calendrier
      </a>
      <div class="dropdown-menu">
   <a class="dropdown-item" href="creation_calendrier.php">Créer un calendrier</a>
   <a class="dropdown-item" href="modification_calendrier.php">Gestion des calendriers</a>
   </div>
    </li>';
}
  
if($_SESSION['statut']!='alternant'){
  echo '<li class="nav-item active"><a class="navbar-brand text-warning">'.'&emsp;&emsp;&emsp;&emsp;'.$_SESSION['dataalt']['Prenom'].' '.$_SESSION['dataalt']['Nom'].'</a></li>';
}

  echo ' </ul>
  <div class="float-right ml-auto">
    
      <ul class="navbar-nav">
          <li class="nav-item dropdown">
      
      <a class="navbar-brand dropdown-toggle" id="navbardrop" data-toggle="dropdown" href="#">
               <i class="fas fa-user"></i>'.' '.$data['Prenom'].' '.$data['Nom'].'
    </a>
    
          <div class="dropdown-menu">
          <a class="dropdown-item" href="Compteutilisateur_'.$_SESSION['statut'].'.php"><i class="fas fa-user-edit"></i>   Mon compte</a>
            <a class="dropdown-item" href="deconnexion.php"><i class="fas fa-sign-out-alt"></i>   Se déconnecter</a>

          </div>
          </li> 
      </ul>


  </div>
</div>
</nav>';
}
$requete->closeCursor();

}    
?>