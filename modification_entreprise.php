<?php
session_start();


//Valider mes informations
      if (isset($_POST['submit'])==True){

$date1 = $_POST['date1'];
$date2 = $_POST['date2'];
$annee = $_POST['annee'];
$semestre = $_POST['semestre'];
$date_modification = time();

if($annee=='TRTE'){
  $semestre = 'TRTE';
}

//faire une vérification des dates contenu dans le fichier csv
$db = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $db->prepare('SELECT * FROM calendriers');
$requete->execute();
while($data1 = $requete->fetch())
{
  $nom = strrchr($data1[$annee], '/');
}
$requete->closeCursor();

if (($handle = fopen('data'.$nom.'', "r")) !== FALSE) {
  while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
    $tab[] = $data; //récupère les valeurs dans un tableau
  }
  fclose($handle);
}

$fileLines = file('data'.$nom.'');
$nb_ligne = count($fileLines);
$verif=false;
//de 1 jusqu'à la derniere ligne du fichier
for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];
$date_modification = time();

if($date1==$date_debut && $date2==$date_fin){
  $verif=true;
}

}

if($verif==false){
  header('Location:Periode_Entreprise_'.$semestre.'.php?erreur=3&&date1='.$date1.'&&date2='.$date2.'');
}


if ($_SESSION['statut']=='alternant')
{
  $id = $_SESSION['ID_alternant'];
}
else 
{
  $id = $_SESSION['dataalt']['ID_alternant'];
}


$code=htmlspecialchars($_POST['code']);

// Connexion à la base de données MySQL 
$conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

$requete = $conn->prepare('SELECT * FROM provisoire_periode WHERE Annee=? AND Date1=? AND Date2=? AND ID_alternant=?');
$requete->execute(array($annee, $date1, $date2, $id));
$nb = $requete->rowCount();

if($_SESSION['statut']=='alternant'){
  $missions = $_POST['missions'];
  $difficultes = $_POST['difficultes'];
    if ($nb==0) {
     $iut = $conn->prepare('INSERT INTO provisoire_periode (Annee, Date1, Date2, ID_alternant) VALUES (?, ?, ?, ?)');
     $iut->execute(array($annee, $date1, $date2, $id));
    }

  $requete2 = $conn->prepare ('UPDATE provisoire_periode SET missions=?, difficultes=?, Date_modification=?, Modif_alternant=1 WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
  $requete2->execute(array($missions, $difficultes, $date_modification, $id, $date1, $date2, $annee));

  if($missions !=="" && $difficultes!==""){
    $mail = $conn->prepare('SELECT Prenom, Nom FROM alternant WHERE ID_alternant=?');
    $mail->execute(array($id));
    while($donnees = $mail->fetch()){
        $prenom=$donnees['Prenom'];
        $nom=$donnees['Nom'];
    }

    $mail = $conn->prepare('SELECT Email_pro FROM tuteur WHERE ID_tuteur=?');
    $mail->execute(array($_SESSION['ID_tuteur']));
    while($donnees = $mail->fetch()){
        $dest=$donnees['Email_pro'];
    }


  $requete2 = $conn->prepare ('UPDATE tuteur SET Code=? WHERE ID_tuteur=?');
  $requete2->execute(array($code, $_SESSION['ID_tuteur']));


          $sujet = "Validation de la période actuelle";
          $corp = "Bonjour,\nvotre alternant ".$prenom." ".$nom." a validé la période en cours.\nVoici un code de confirmation : ".$code."\nVeuillez valider les modifications grâce à ce code\n\nCordialement, \nL'administrateur ;)";
          $headers = "From: iut35400@gmail.com";
          if (mail($dest, $sujet, $corp, $headers))
          {
            header('Location:Periode_Entreprise_'.$semestre.'.php?date1='.$date1.'&&date2='.$date2.'');
          }
          else{
            header('Location:Periode_Entreprise_'.$semestre.'.php?erreur=4&&date1='.$date1.'&&date2='.$date2.'');
          }
    
    header('Location:Periode_Entreprise_'.$semestre.'.php?date1='.$date1.'&&date2='.$date2.'');
  }
  else{
    header('Location:Periode_Entreprise_'.$semestre.'.php?erreur=1&&date1='.$date1.'&&date2='.$date2.'');
  }
}

elseif($_SESSION['statut']=='tuteur'){
  $commentaires = $_POST['commentaires'];
  if(isset($_POST['competence1'])){
$competence1 = $_POST['competence1'];}else{$competence1="";}
if(isset($_POST['competence2'])){
$competence2 = $_POST['competence2'];}else{$competence2="";}
if(isset($_POST['competence3'])){
$competence3 = $_POST['competence3'];}else{$competence3="";}
if(isset($_POST['competence4'])){
$competence4 = $_POST['competence4'];}else{$competence4="";}
if(isset($_POST['competence5'])){
$competence5 = $_POST['competence5'];}else{$competence5="";}
if(isset($_POST['competence6'])){
$competence6 = $_POST['competence6'];}else{$competence6="";}
if(isset($_POST['competence7'])){
$competence7 = $_POST['competence7'];}else{$competence7="";}
if(isset($_POST['competence8'])){
$competence8 = $_POST['competence8'];}else{$competence8="";}
if(isset($_POST['competence9'])){
$competence9 = $_POST['competence9'];}else{$competence9="";}
if(isset($_POST['competence10'])){
$competence10 = $_POST['competence10'];}else{$competence10="";}
if(isset($_POST['competence11'])){
$competence11 = $_POST['competence11'];}else{$competence11="";}
if(isset($_POST['competence12'])){
$competence12 = $_POST['competence12'];}else{$competence12="";}
if(isset($_POST['competence13'])){
  $competence13 = $_POST['competence13'];
}else{$competence13="";}

if(isset($_POST['competence14'])){
  $competence14 = $_POST['competence14'];
}else{$competence14="";}

if(isset($_POST['competence15'])){
  $competence15 = $_POST['competence15'];
}else{$competence15="";}

    if ($nb==0) {
     $iut = $conn->prepare('INSERT INTO provisoire_periode (ID_alternant, Date1, Date2, Annee) VALUES (?, ?, ?, ?)');
     $iut->execute(array($id, $date1, $date2, $annee));
  }

$requete2 = $conn->prepare('UPDATE provisoire_periode SET commentaires=?, competence1=?, competence2=?, competence3=?, competence4=?, competence5=?, competence6=?, competence7=?, competence8=?, competence9=?, competence10=?, competence11=?, competence12=?, competence13=?, competence14=?, competence15=?, Date_modification=?, Modif_tuteur=1 WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
$requete2->execute(array($commentaires, $competence1, $competence2, $competence3, $competence4, $competence5, $competence6, $competence7, $competence8, $competence9, $competence10, $competence11, $competence12, $competence13, $competence14, $competence15, $date_modification, $id, $date1, $date2, $annee));

    if($commentaires!=="" && isset($competence1) && isset($competence2) && isset($competence3) && isset($competence4) && isset($competence5) && isset($competence6) && isset($competence7) && isset($competence8) && isset($competence9) && isset($competence10) && isset($competence11) && isset($competence12) && isset($competence13) && isset($competence14) && isset($competence15)){

    $mail = $conn->prepare('SELECT Prenom, Nom FROM tuteur WHERE ID_tuteur=?');
    $mail->execute(array($_SESSION['ID_tuteur']));
    while($donnees = $mail->fetch()){
        $prenom=$donnees['Prenom'];
        $nom=$donnees['Nom'];
    }

    $mail = $conn->prepare('SELECT Email_pro FROM alternant WHERE ID_alternant=?');
    $mail->execute(array($id));
    while($donnees = $mail->fetch()){
        $dest=$donnees['Email_pro'];
    }


  $requete2 = $conn->prepare ('UPDATE alternant SET Code=? WHERE ID_alternant=?');
  $requete2->execute(array($code, $id));

       
          $sujet = "Validation de la période actuelle";
          $corp = "Bonjour,\nvotre tuteur ".$prenom." ".$nom." a validé la période en cours.\nVoici un code de confirmation : ".$code."\nVeuillez valider les modifications grâce à ce code\n\nCordialement, \nL'administrateur ;)";
          $headers = "From: iut35400@gmail.com";
          if (mail($dest, $sujet, $corp, $headers))
          {
            header('Location:Periode_Entreprise_'.$semestre.'.php?date1='.$date1.'&&date2='.$date2.'');
          }
          else{
            header('Location:Periode_Entreprise_'.$semestre.'.php?erreur=4&&date1='.$date1.'&&date2='.$date2.'');
          }
    
    header('Location:Periode_Entreprise_'.$semestre.'.php?date1='.$date1.'&&date2='.$date2.'');
  }
  else{
    header('Location:Periode_Entreprise_'.$semestre.'.php?erreur=1&&date1='.$date1.'&&date2='.$date2.'');
  }
}


}



//Valider les informations du tuteur ou de l'alternant ==> Valider le code de validation
if (isset($_POST['submit2'])==True) {

  $date1 = $_POST['date1'];
  $date2 = $_POST['date2'];
  $annee = $_POST['annee'];
  $statut = $_SESSION['statut'];
  $id_statut = $_SESSION['ID_'.$statut.''];
  $code2 = $_POST['code2'];
  $semestre = $_POST['semestre'];

if($annee=='TRTE'){
  $semestre = 'TRTE';
}

  //faire une vérification des dates contenu dans le fichier csv
$db = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $db->prepare('SELECT * FROM calendriers');
$requete->execute();
while($data1 = $requete->fetch())
{
  $nom = strrchr($data1[$annee], '/');
}
$requete->closeCursor();

if (($handle = fopen('data'.$nom.'', "r")) !== FALSE) {
  while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
    $tab[] = $data; //récupère les valeurs dans un tableau
  }
  fclose($handle);
}

$fileLines = file('data'.$nom.'');
$nb_ligne = count($fileLines);
$verif=false;
//de 1 jusqu'à la derniere ligne du fichier
for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];

if($date1==$date_debut && $date2==$date_fin){
  $verif=true;
}

}

if($verif==false){
  header('Location:Periode_Entreprise_'.$semestre.'.php?erreur=3&&date1='.$date1.'&&date2='.$date2.'');
}


if ($_SESSION['statut']=='alternant')
{
  $id=$_SESSION['ID_alternant'];
}
else 
{
  $id = $_SESSION['dataalt']['ID_alternant'];
}


  $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

  $code = $conn->prepare('SELECT * FROM '.$statut.' WHERE ID_'.$statut.'=?');
  $code->execute(array($id_statut));
  while($donnees = $code->fetch()){
    $code1 = $donnees['Code'];
  }

  if($code1==$code2){

    //récupération des données de la table provisoire
    $provisoire = $conn->prepare('SELECT * FROM provisoire_periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
    $provisoire->execute(array($id, $date1, $date2, $annee));
    while($data1 = $provisoire->fetch())
    {
      $missions = $data1['missions'];
      $difficultes = $data1['difficultes'];
      $commentaires = $data1['commentaires'];
      $competence1 = $data1['competence1'];
      $competence2 = $data1['competence2'];
      $competence3 = $data1['competence3'];
      $competence4 = $data1['competence4'];
      $competence5 = $data1['competence5'];
      $competence6 = $data1['competence6'];
      $competence7 = $data1['competence7'];
      $competence8 = $data1['competence8'];
      $competence9 = $data1['competence9'];
      $competence10 = $data1['competence10'];
      $competence11 = $data1['competence11'];
      $competence12 = $data1['competence12'];
      $competence13 = $data1['competence13'];
      $competence14 = $data1['competence14'];
      $competence15 = $data1['competence15'];
    }


    //vérifie si une ligne de la table permanente est déjà créée + en créer une sinon

    $iut = $conn->prepare('SELECT * FROM periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
    $iut->execute(array($id, $date1, $date2, $annee));
    $nb = $iut->rowCount();

    if($nb==0){
    $insertion_iut = $conn->prepare('INSERT INTO periode (Annee, Date1, Date2, ID_alternant) VALUES (?, ?, ?, ?)');
    $insertion_iut->execute(array($annee, $date1, $date2, $id));
    }

    //copie des données de la table provisoire dans la table permanente

    if($_SESSION['statut']=='alternant'){

        $insertion_iut = $conn->prepare('UPDATE periode SET commentaires=?, competence1=?, competence2=?, competence3=?, competence4=?, competence5=?, competence6=?, competence7=?, competence8=?, competence9=?, competence10=?, competence11=?, competence12=?, competence13=?, competence14=?, competence15=? WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
        $insertion_iut->execute(array($commentaires, $competence1, $competence2, $competence3, $competence4, $competence5, $competence6, $competence7, $competence8, $competence9, $competence10, $competence11, $competence12, $competence13, $competence14, $competence15, $id, $date1, $date2, $annee));

        $modif_provisoireiut = $conn->prepare('UPDATE provisoire_periode SET Modif_tuteur=0 WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
        $modif_provisoireiut->execute(array($id, $date1, $date2, $annee));

    }elseif($_SESSION['statut']=='tuteur'){

        $insertion_iut = $conn->prepare('UPDATE periode SET missions=?, difficultes=? WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
        $insertion_iut->execute(array($missions, $difficultes, $id, $date1, $date2, $annee));

        $modif_provisoireiut = $conn->prepare('UPDATE provisoire_periode SET Modif_alternant=0 WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
        $modif_provisoireiut->execute(array($id, $date1, $date2, $annee));

    }

  $provisoireiut = $conn->prepare('SELECT * FROM provisoire_periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
  $provisoireiut->execute(array($id, $date1, $date2, $annee));
  while($data = $provisoireiut->fetch()){
    $modif_alternant = $data['Modif_alternant'];
    $modif_tuteur = $data['Modif_tuteur'];
  }
  $provisoireiut->closeCursor();

if($modif_tuteur==0 && $modif_alternant==0){
    //supprime la ligne dans la table provisoire

    $requete = $db->prepare('DELETE FROM provisoire_periode WHERE ID_alternant=? AND Date1=? AND Date2=? AND Annee=?');
    $requete->execute(array($id, $date1, $date2, $_SESSION['annee_calendrier']));

}
    header('Location:Periode_Entreprise_'.$semestre.'.php?date1='.$date1.'&&date2='.$date2.'');

  }else{
    header('Location:Periode_Entreprise_'.$semestre.'.php?erreur=5&&date1='.$date1.'&&date2='.$date2.'');
  }

}





if (isset($_POST['pdf'])==True){

$date1 = $_POST['date1'];
$date2 = $_POST['date2'];
$annee = $_POST['annee'];
$semestre = $_POST['semestre'];

//faire une vérification des dates contenu dans le fichier csv
$db = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $db->prepare('SELECT * FROM calendriers');
$requete->execute();
while($data1 = $requete->fetch())
{
  $nom = strrchr($data1[$annee], '/');
}
$requete->closeCursor();

if (($handle = fopen('data'.$nom.'', "r")) !== FALSE) {
  while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
    $tab[] = $data; //récupère les valeurs dans un tableau
  }
  fclose($handle);
}

$fileLines = file('data'.$nom.'');
$nb_ligne = count($fileLines);
$verif=false;
//de 1 jusqu'à la derniere ligne du fichier
for($p=1; $p < $nb_ligne;$p++){
$date_debut = $tab[$p][1];
$date_fin = $tab[$p][2];

if($date1==$date_debut && $date2==$date_fin){
  $verif=true;
}

}

if($verif==false){
  if($annee=='TRTE'){
      header('Location:Periode_Entreprise_TRTE.php?erreur=3&&date1='.$date1.'&&date2='.$date2.'');
  }else{
      header('Location:Periode_Entreprise_'.$semestre.'.php?erreur=3&&date1='.$date1.'&&date2='.$date2.'');
  }
}

if ($_SESSION['statut']=='alternant')
{
  $id=$_SESSION['ID_alternant'];
}
else 
{
  $id = $_SESSION['dataalt']['ID_alternant'];
}


$conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $conn->prepare('SELECT * FROM periode WHERE Annee=? AND Date1=? AND Date2=? AND ID_alternant=?');
$requete->execute(array($annee, $date1, $date2, $id));
while($data = $requete->fetch()){
  $donnees = $data;
}
$nbr=$requete->rowCount();
$requete->closeCursor();

if($nbr==0){
  if($annee=='TRTE'){
      header('Location:Periode_Entreprise_TRTE.php?date1='.$date1.'&&date2='.$date2.'');
  }else{
      header('Location:Periode_Entreprise_'.$semestre.'.php?date1='.$date1.'&&date2='.$date2.'');
  }
}

$requete = $conn->prepare('SELECT * FROM alternant WHERE ID_alternant=?');
$requete->execute(array($id));
while($data = $requete->fetch()){
  $donnees_alternant = $data;
}
$requete->closeCursor();

$requete = $conn->prepare('SELECT * FROM tuteur WHERE ID_tuteur=?');
$requete->execute(array($donnees_alternant['ID_tuteur']));
while($data = $requete->fetch()){
  $donnees_tuteur = $data;
}
$requete->closeCursor();

$requete = $conn->prepare('SELECT * FROM enseignant WHERE ID_enseignant=?');
$requete->execute(array($donnees_alternant['ID_enseignant']));
while($data = $requete->fetch()){
  $donnees_enseignant = $data;
}
$requete->closeCursor();



require('fpdf.php');

class PDF extends FPDF
{
// En-tête
function Header()
{
  $date1 = $_POST['date1'];
    $date2 = $_POST['date2'];
    setlocale(LC_TIME, "fr_FR", "French");
    $titre = 'Période Entreprise du '.utf8_encode(strftime("%d %B %G", strtotime($date1))).' au '.utf8_encode(strftime("%d %B %G", strtotime($date2)));
    // Logo
    $this->Image('RT-stmalo.png',10,6,45);
    // Police Arial gras 15
    $this->SetFont('Times','B',17);
    // Décalage à droite
    $this->Cell(93);
    // Titre
    $this->Cell(45,10,utf8_decode($titre),0,0,'C');
    // Saut de ligne
    $this->Ln(20);
}

// Pied de page
function Footer()
{
    // Positionnement à 1,5 cm du bas
    $this->SetY(-15);
    // Police Arial italique 8
    $this->SetFont('Times','I',8);
    // Numéro de page
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}

function BasicTable($header, $data)
{
    // En-tête
    foreach($header as $col)
        $this->Cell(40,7,$col,1);
    $this->Ln();
    // Données
    foreach($data as $row)
    {
        foreach($row as $col)
            $this->Cell(40,6,$col,1);
        $this->Ln();
    }
}

// Fonction en-tête des tableaux en 3 colonnes de largeurs variables
function entete_table($position_entete) {
  global $pdf;
  $pdf->SetDrawColor(183); // Couleur du fond RVB
  $pdf->SetFillColor(221); // Couleur des filets RVB
  $pdf->SetTextColor(0); // Couleur du texte noir
  $pdf->SetY($position_entete);
  // position de colonne 1 (10mm à gauche)  
  $pdf->SetX(15);
  $pdf->Cell(100,8,utf8_decode('Compétences'),1,0,'C',1);  // 60 >largeur colonne, 8 >hauteur colonne
  // position de la colonne 2 (70 = 10+60)
  $pdf->SetX(115); 
  $pdf->Cell(50,8,'Evaluation',1,0,'C',1);

  $pdf->Ln(); // Retour à la ligne
}

}

// Instanciation de la classe dérivée
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetTitle(utf8_decode('Période_IUT_'.$date1.'_'.$date2));
$pdf->Ln(5);
$pdf->SetFont('Times','B',12);
$pdf->SetTextColor(0,0,0);

if(!empty($donnees_alternant['file_url'])){
  $pdf->Image($donnees_alternant['file_url'],30,30,30);
}
if(!empty($donnees_tuteur['file_url'])){
  $pdf->Image($donnees_tuteur['file_url'],90,30,30);
}
if(!empty($donnees_enseignant['file_url'])){
  $pdf->Image($donnees_enseignant['file_url'],150,30,30);
}

$pdf->SetLeftMargin(35);
$pdf->Cell(0,0,utf8_decode('Alternant'),0,1);
$pdf->SetLeftMargin(85);
$pdf->Cell(0,0,utf8_decode('Maître d\'apprentissage'),0,1);
$pdf->SetLeftMargin(148);
$pdf->Cell(0,0,utf8_decode('Tuteur enseignant'),0,1);

$pdf->SetFont('Times','',12);
$pdf->SetLeftMargin(27);
$pdf->Ln(50);
$pdf->Cell(0,0,utf8_decode($donnees_alternant['Prenom'].' '.$donnees_alternant['Nom']),0,1);
$pdf->SetLeftMargin(90);
$pdf->Cell(0,0,utf8_decode($donnees_tuteur['Prenom'].' '.$donnees_tuteur['Nom']),0,1);
$pdf->SetLeftMargin(148);
$pdf->Cell(0,0,utf8_decode($donnees_enseignant['Prenom'].' '.$donnees_enseignant['Nom']),0,1);

$pdf->SetLeftMargin(15);
$pdf->Ln(5);
if(!empty($donnees_entreprise['file_url'])){
  $pdf->Image($donnees_entreprise['file_url'],15,90,90);
}
$requete = $conn->prepare('SELECT * FROM entreprise WHERE ID_entreprise=?');
$requete->execute(array($donnees_tuteur['ID_entreprise']));
while($data = $requete->fetch()){
  $donnees_entreprise = $data;
}
$requete->closeCursor();
$pdf->SetFont('Times','',12);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(50,15,utf8_decode('Entreprise : '.$donnees_entreprise['Entreprise']),0,1);
$pdf->SetFont('Times','B',14);
$pdf->SetTextColor(220,50,50);
$pdf->Cell(0,15,utf8_decode('Missions confiées à l\'apprenti(e)'),0,1);
$pdf->SetFont('Times','',12);
$pdf->SetTextColor(0,0,0);
$pdf->MultiCell(0,6,utf8_decode($donnees['missions']),0,1);

$pdf->SetFont('Times','B',14);
$pdf->SetTextColor(220,50,50);
$pdf->Cell(0,15,utf8_decode('Difficultés rencontrées'),0,1);
$pdf->SetFont('Times','',12);
$pdf->SetTextColor(0,0,0);
$pdf->MultiCell(0,6,utf8_decode($donnees['difficultes']),0,1);
$pdf->SetFont('Times','B',14);
$pdf->SetTextColor(220,50,50);
$pdf->Cell(0,15,utf8_decode('Commentaire du maître d\'apprentissage'),0,1);
$pdf->SetFont('Times','',12);
$pdf->SetTextColor(0,0,0);
$pdf->MultiCell(0,6,utf8_decode($donnees['commentaires']),0,1);
$pdf->AddPage();
$pdf->SetFont('Times','B',14);
$pdf->SetTextColor(220,50,50);
$pdf->Cell(0,0,utf8_decode('Evaluation du maître d\'apprentissage'),0,1);
$pdf->SetFont('Times','',10);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(0,15,utf8_decode('(A : Très bien; B : Bien; C : Moyen; D : Doit s\'améliorer; NE : Non évalué)'),0,1);




if($semestre=='S1'){
  
  $tab_competences = array('Assiduité, ponctualité', 'Politesse, sociabilité','Dynamisme, enthousiasme','Capacité à décrire son activité','Capacité d\'observation','Aptitude à s\'approprier des méthodes de travail, de nouveaux outils','Capacité à faire part de ses difficultés','Capacité à se renseigner, se documenter','Capacité à reproduire une activité en étant guidé','Capacité à prendre des notes','Organisation de l\'espace de travail','Acquisition du vocabulaire métier');

$pdf->SetFont('Times','B',14);
$pdf->SetTextColor(30,127,203);
$pdf->Cell(0,10,utf8_decode('Attentes du semestre 1 : Intégration'),0,1);
$pdf->SetFont('Times','B',12);
$pdf->SetTextColor(220,50,50);
$pdf->Cell(0,10,utf8_decode('~~ Intégration, comportement, communication ~~'),0,1);

// AFFICHAGE EN-TÊTE DU TABLEAU
// Position ordonnée de l'entête en valeur absolue par rapport au sommet de la page (70 mm)
$position_entete = 65;
// police des caractères
$pdf->SetFont('Times','',9);
$pdf->SetTextColor(0);
// on affiche les en-têtes du tableau
$pdf->entete_table($position_entete);
$position_detail = 73; // Position ordonnée = $position_entete+hauteur de la cellule d'en-tête (300+8)

for($i=1; $i<=4; $i++){
  // position abcisse de la colonne 1 (15mm du bord)
  //$pdf->SetY($position_detail);
  $pdf->SetX(15);
  $pdf->Cell(100,8,utf8_decode($tab_competences[$i-1]),1,0);
    // position abcisse de la colonne 2 (115 = 15 + 100)  
  //$pdf->SetY($position_detail);
  $pdf->SetX(115); 
  $pdf->Cell(50,8,utf8_decode($donnees['competence'.$i.'']),1,0,'C');
  $pdf->Ln();
  // on incrémente la position ordonnée de la ligne suivante (+8mm = hauteur des cellules)  
  $position_detail += 8;

}

$pdf->SetFont('Times','B',12);
$pdf->SetTextColor(220,50,50);
$pdf->Cell(0,15,utf8_decode('~~ Compréhension de l\'environnement professionnel ~~'),0,1);

// AFFICHAGE EN-TÊTE DU TABLEAU
// Position ordonnée de l'entête en valeur absolue par rapport au sommet de la page (70 mm)
$position_entete = 117;
// police des caractères
$pdf->SetFont('Times','',9);
$pdf->SetTextColor(0);
// on affiche les en-têtes du tableau
$pdf->entete_table($position_entete);
$position_detail = 125; // Position ordonnée = $position_entete+hauteur de la cellule d'en-tête (300+8)

for($i=5; $i<=9; $i++){
  // position abcisse de la colonne 1 (15mm du bord)
  //$pdf->SetY($position_detail);
  $pdf->SetX(15);
  $pdf->Cell(100,8,utf8_decode($tab_competences[$i-1]),1,0);
    // position abcisse de la colonne 2 (115 = 15 + 100)  
  //$pdf->SetY($position_detail);
  $pdf->SetX(115); 
  $pdf->Cell(50,8,utf8_decode($donnees['competence'.$i.'']),1,0,'C');
  $pdf->Ln();
  // on incrémente la position ordonnée de la ligne suivante (+8mm = hauteur des cellules)  
  $position_detail += 8;

}


$pdf->SetFont('Times','B',12);
$pdf->SetTextColor(220,50,50);
$pdf->Cell(0,15,utf8_decode('~~ Compétences organisationnelles ~~'),0,1);

// AFFICHAGE EN-TÊTE DU TABLEAU
// Position ordonnée de l'entête en valeur absolue par rapport au sommet de la page (70 mm)
$position_entete = 177;
// police des caractères
$pdf->SetFont('Times','',9);
$pdf->SetTextColor(0);
// on affiche les en-têtes du tableau
$pdf->entete_table($position_entete);
$position_detail = 185; // Position ordonnée = $position_entete+hauteur de la cellule d'en-tête (300+8)

for($i=10; $i<=12; $i++){
  // position abcisse de la colonne 1 (15mm du bord)
  //$pdf->SetY($position_detail);
  $pdf->SetX(15);
  $pdf->Cell(100,8,utf8_decode($tab_competences[$i-1]),1,0);
    // position abcisse de la colonne 2 (115 = 15 + 100)  
  //$pdf->SetY($position_detail);
  $pdf->SetX(115); 
  $pdf->Cell(50,8,utf8_decode($donnees['competence'.$i.'']),1,0,'C');
  $pdf->Ln();
  // on incrémente la position ordonnée de la ligne suivante (+8mm = hauteur des cellules)  
  $position_detail += 8;

}

}

if($semestre=='S2'){

$tab_competences = array('Intégration au sein de l\'équipe', 'Implication, motivation','Curiosité pour les tâches à effectuer','Ténacité','Capacité à expliquer son activité','Capacité à vérifier son travail','Capacité à signaler un problème, une erreur','Capacité à questionner pour comprendre','Respect des règles, procédures et méthodes','Capacité à reproduire une activité sans intervention du tuteur','Capacité à traiter les informations nouvelles','Capacité à prévoir les moyens nécessaires à l\'activité','Connaissance théorique des tâches élémentaires');

$pdf->SetFont('Times','B',14);
$pdf->SetTextColor(30,127,203);
$pdf->Cell(0,10,utf8_decode('Attentes du semestre 2 : Montée en compétences'),0,1);
$pdf->SetFont('Times','B',12);
$pdf->SetTextColor(220,50,50);
$pdf->Cell(0,10,utf8_decode('~~ Intégration, comportement, communication ~~'),0,1);

// AFFICHAGE EN-TÊTE DU TABLEAU
// Position ordonnée de l'entête en valeur absolue par rapport au sommet de la page (70 mm)
$position_entete = 65;
// police des caractères
$pdf->SetFont('Times','',9);
$pdf->SetTextColor(0);
// on affiche les en-têtes du tableau
$pdf->entete_table($position_entete);
$position_detail = 73; // Position ordonnée = $position_entete+hauteur de la cellule d'en-tête (300+8)

for($i=1; $i<=5; $i++){
  // position abcisse de la colonne 1 (15mm du bord)
  //$pdf->SetY($position_detail);
  $pdf->SetX(15);
  $pdf->Cell(100,8,utf8_decode($tab_competences[$i-1]),1,0);
    // position abcisse de la colonne 2 (115 = 15 + 100)  
  //$pdf->SetY($position_detail);
  $pdf->SetX(115); 
  $pdf->Cell(50,8,utf8_decode($donnees['competence'.$i.'']),1,0,'C');
  $pdf->Ln();
  // on incrémente la position ordonnée de la ligne suivante (+8mm = hauteur des cellules)  
  $position_detail += 8;

}

$pdf->SetFont('Times','B',12);
$pdf->SetTextColor(220,50,50);
$pdf->Cell(0,15,utf8_decode('~~ Compréhension de l\'environnement professionnel ~~'),0,1);

// AFFICHAGE EN-TÊTE DU TABLEAU
// Position ordonnée de l'entête en valeur absolue par rapport au sommet de la page (70 mm)
$position_entete = 125;
// police des caractères
$pdf->SetFont('Times','',9);
$pdf->SetTextColor(0);
// on affiche les en-têtes du tableau
$pdf->entete_table($position_entete);
$position_detail = 133; // Position ordonnée = $position_entete+hauteur de la cellule d'en-tête (300+8)

for($i=6; $i<=10; $i++){
  // position abcisse de la colonne 1 (15mm du bord)
  //$pdf->SetY($position_detail);
  $pdf->SetX(15);
  $pdf->Cell(100,8,utf8_decode($tab_competences[$i-1]),1,0);
    // position abcisse de la colonne 2 (115 = 15 + 100)  
  //$pdf->SetY($position_detail);
  $pdf->SetX(115); 
  $pdf->Cell(50,8,utf8_decode($donnees['competence'.$i.'']),1,0,'C');
  $pdf->Ln();
  // on incrémente la position ordonnée de la ligne suivante (+8mm = hauteur des cellules)  
  $position_detail += 8;

}


$pdf->SetFont('Times','B',12);
$pdf->SetTextColor(220,50,50);
$pdf->Cell(0,15,utf8_decode('~~ Compétences organisationnelles ~~'),0,1);

// AFFICHAGE EN-TÊTE DU TABLEAU
// Position ordonnée de l'entête en valeur absolue par rapport au sommet de la page (70 mm)
$position_entete = 185;
// police des caractères
$pdf->SetFont('Times','',9);
$pdf->SetTextColor(0);
// on affiche les en-têtes du tableau
$pdf->entete_table($position_entete);
$position_detail = 193; // Position ordonnée = $position_entete+hauteur de la cellule d'en-tête (300+8)

for($i=11; $i<=13; $i++){
  // position abcisse de la colonne 1 (15mm du bord)
  //$pdf->SetY($position_detail);
  $pdf->SetX(15);
  $pdf->Cell(100,8,utf8_decode($tab_competences[$i-1]),1,0);
    // position abcisse de la colonne 2 (115 = 15 + 100)  
  //$pdf->SetY($position_detail);
  $pdf->SetX(115); 
  $pdf->Cell(50,8,utf8_decode($donnees['competence'.$i.'']),1,0,'C');
  $pdf->Ln();
  // on incrémente la position ordonnée de la ligne suivante (+8mm = hauteur des cellules)  
  $position_detail += 8;

}

}

if($semestre=='S3'){
  
  $tab_competences = array('Capacité d\'écoute', 'Réaction face aux conseils et remarques', 'Relation clientèle / utilisateurs', 'Capacité à analyser son activité', 'Qualité de l\'expression écrite / orale', 'Capacité à analyser un problème', 'Capacité à s\'adapter à des situations nouvelles et / ou complexes', 'Capacité à surmonter ses difficultés', 'Capacité à travailler en équipe', 'Capacité à agir en autonomie', 'Respect des engagements', 'Prise d\'autonomie', 'Qualité du travail effectué', 'Capacité à gérer son temps', 'Connaissance théorique des tâches complexes');

$pdf->SetFont('Times','B',14);
$pdf->SetTextColor(30,127,203);
$pdf->Cell(0,10,utf8_decode('Attentes du semestre 3 : Accession à l\'autonomie'),0,1);
$pdf->SetFont('Times','B',12);
$pdf->SetTextColor(220,50,50);
$pdf->Cell(0,10,utf8_decode('~~ Comportement, communication, interaction ~~'),0,1);

// AFFICHAGE EN-TÊTE DU TABLEAU
// Position ordonnée de l'entête en valeur absolue par rapport au sommet de la page (70 mm)
$position_entete = 65;
// police des caractères
$pdf->SetFont('Times','',9);
$pdf->SetTextColor(0);
// on affiche les en-têtes du tableau
$pdf->entete_table($position_entete);
$position_detail = 73; // Position ordonnée = $position_entete+hauteur de la cellule d'en-tête (300+8)

for($i=1; $i<=5; $i++){
  // position abcisse de la colonne 1 (15mm du bord)
  //$pdf->SetY($position_detail);
  $pdf->SetX(15);
  $pdf->Cell(100,8,utf8_decode($tab_competences[$i-1]),1,0);
    // position abcisse de la colonne 2 (115 = 15 + 100)  
  //$pdf->SetY($position_detail);
  $pdf->SetX(115); 
  $pdf->Cell(50,8,utf8_decode($donnees['competence'.$i.'']),1,0,'C');
  $pdf->Ln();
  // on incrémente la position ordonnée de la ligne suivante (+8mm = hauteur des cellules)  
  $position_detail += 8;

}

$pdf->SetFont('Times','B',12);
$pdf->SetTextColor(220,50,50);
$pdf->Cell(0,15,utf8_decode('~~ Maîtrise de l\'environnement professionnel ~~'),0,1);

// AFFICHAGE EN-TÊTE DU TABLEAU
// Position ordonnée de l'entête en valeur absolue par rapport au sommet de la page (70 mm)
$position_entete = 125;
// police des caractères
$pdf->SetFont('Times','',9);
$pdf->SetTextColor(0);
// on affiche les en-têtes du tableau
$pdf->entete_table($position_entete);
$position_detail = 133; // Position ordonnée = $position_entete+hauteur de la cellule d'en-tête (300+8)

for($i=6; $i<=10; $i++){
  // position abcisse de la colonne 1 (15mm du bord)
  //$pdf->SetY($position_detail);
  $pdf->SetX(15);
  $pdf->Cell(100,8,utf8_decode($tab_competences[$i-1]),1,0);
    // position abcisse de la colonne 2 (115 = 15 + 100)  
  //$pdf->SetY($position_detail);
  $pdf->SetX(115); 
  $pdf->Cell(50,8,utf8_decode($donnees['competence'.$i.'']),1,0,'C');
  $pdf->Ln();
  // on incrémente la position ordonnée de la ligne suivante (+8mm = hauteur des cellules)  
  $position_detail += 8;

}


$pdf->SetFont('Times','B',12);
$pdf->SetTextColor(220,50,50);
$pdf->Cell(0,15,utf8_decode('~~ Autonomie, efficacité, optimisation ~~'),0,1);

// AFFICHAGE EN-TÊTE DU TABLEAU
// Position ordonnée de l'entête en valeur absolue par rapport au sommet de la page (70 mm)
$position_entete = 185;
// police des caractères
$pdf->SetFont('Times','',9);
$pdf->SetTextColor(0);
// on affiche les en-têtes du tableau
$pdf->entete_table($position_entete);
$position_detail = 193; // Position ordonnée = $position_entete+hauteur de la cellule d'en-tête (300+8)

for($i=11; $i<=15; $i++){
  // position abcisse de la colonne 1 (15mm du bord)
  //$pdf->SetY($position_detail);
  $pdf->SetX(15);
  $pdf->Cell(100,8,utf8_decode($tab_competences[$i-1]),1,0);
    // position abcisse de la colonne 2 (115 = 15 + 100)  
  //$pdf->SetY($position_detail);
  $pdf->SetX(115); 
  $pdf->Cell(50,8,utf8_decode($donnees['competence'.$i.'']),1,0,'C');
  $pdf->Ln();
  // on incrémente la position ordonnée de la ligne suivante (+8mm = hauteur des cellules)  
  $position_detail += 8;

}

}

if($semestre=='S4'){
  
  $tab_competences = array('Capacité à échanger, partager ses connaissances', 'Relation clientèle / utilisateurs', 'Capacité à auto évaluer ses compétences', 'Qualité des présentations écrites / orales', 'Capacité à résoudre un problème', 'Capacité à rendre compte de choix techniques', 'Capacité à participer / à mener un projet', 'Capacité à faire partie intégrante de l\'équipe', 'Capacité à prendre des initiatives', 'Capacité à agir en autonomie', 'Conscience professionnelle', 'Capacité à optimiser son temps', 'Maîtrise théorique de son activité');

$pdf->SetFont('Times','B',14);
$pdf->SetTextColor(30,127,203);
$pdf->Cell(0,10,utf8_decode('Attentes du semestre 4 : Technicien opérationnel'),0,1);
$pdf->SetFont('Times','B',12);
$pdf->SetTextColor(220,50,50);
$pdf->Cell(0,10,utf8_decode('~~ Comportement, communication, interaction ~~'),0,1);

// AFFICHAGE EN-TÊTE DU TABLEAU
// Position ordonnée de l'entête en valeur absolue par rapport au sommet de la page (70 mm)
$position_entete = 65;
// police des caractères
$pdf->SetFont('Times','',9);
$pdf->SetTextColor(0);
// on affiche les en-têtes du tableau
$pdf->entete_table($position_entete);
$position_detail = 73; // Position ordonnée = $position_entete+hauteur de la cellule d'en-tête (300+8)

for($i=1; $i<=4; $i++){
  // position abcisse de la colonne 1 (15mm du bord)
  //$pdf->SetY($position_detail);
  $pdf->SetX(15);
  $pdf->Cell(100,8,utf8_decode($tab_competences[$i-1]),1,0);
    // position abcisse de la colonne 2 (115 = 15 + 100)  
  //$pdf->SetY($position_detail);
  $pdf->SetX(115); 
  $pdf->Cell(50,8,utf8_decode($donnees['competence'.$i.'']),1,0,'C');
  $pdf->Ln();
  // on incrémente la position ordonnée de la ligne suivante (+8mm = hauteur des cellules)  
  $position_detail += 8;

}

$pdf->SetFont('Times','B',12);
$pdf->SetTextColor(220,50,50);
$pdf->Cell(0,15,utf8_decode('~~ Maîtrise de l\'environnement professionnel ~~'),0,1);

// AFFICHAGE EN-TÊTE DU TABLEAU
// Position ordonnée de l'entête en valeur absolue par rapport au sommet de la page (70 mm)
$position_entete = 117;
// police des caractères
$pdf->SetFont('Times','',9);
$pdf->SetTextColor(0);
// on affiche les en-têtes du tableau
$pdf->entete_table($position_entete);
$position_detail = 125; // Position ordonnée = $position_entete+hauteur de la cellule d'en-tête (300+8)

for($i=5; $i<=8; $i++){
  // position abcisse de la colonne 1 (15mm du bord)
  //$pdf->SetY($position_detail);
  $pdf->SetX(15);
  $pdf->Cell(100,8,utf8_decode($tab_competences[$i-1]),1,0);
    // position abcisse de la colonne 2 (115 = 15 + 100)  
  //$pdf->SetY($position_detail);
  $pdf->SetX(115); 
  $pdf->Cell(50,8,utf8_decode($donnees['competence'.$i.'']),1,0,'C');
  $pdf->Ln();
  // on incrémente la position ordonnée de la ligne suivante (+8mm = hauteur des cellules)  
  $position_detail += 8;

}


$pdf->SetFont('Times','B',12);
$pdf->SetTextColor(220,50,50);
$pdf->Cell(0,15,utf8_decode('~~ Autonomie, efficacité, optimisation ~~'),0,1);

// AFFICHAGE EN-TÊTE DU TABLEAU
// Position ordonnée de l'entête en valeur absolue par rapport au sommet de la page (70 mm)
$position_entete = 169;
// police des caractères
$pdf->SetFont('Times','',9);
$pdf->SetTextColor(0);
// on affiche les en-têtes du tableau
$pdf->entete_table($position_entete);
$position_detail = 177; // Position ordonnée = $position_entete+hauteur de la cellule d'en-tête (300+8)

for($i=9; $i<=13; $i++){
  // position abcisse de la colonne 1 (15mm du bord)
  //$pdf->SetY($position_detail);
  $pdf->SetX(15);
  $pdf->Cell(100,8,utf8_decode($tab_competences[$i-1]),1,0);
    // position abcisse de la colonne 2 (115 = 15 + 100)  
  //$pdf->SetY($position_detail);
  $pdf->SetX(115); 
  $pdf->Cell(50,8,utf8_decode($donnees['competence'.$i.'']),1,0,'C');
  $pdf->Ln();
  // on incrémente la position ordonnée de la ligne suivante (+8mm = hauteur des cellules)  
  $position_detail += 8;

}

}

if($semestre=='TRTE'){
  
  $tab_competences = array('Adaptation à l\'entreprise (culture, règles, personnels)', 'Capacité d\'adaptation au poste', 'Autonomie, esprit d\'initiative', 'Créativité, imagination', 'Capacité de communication', 'Aptitude à progresser', 'Aptitude à mettre en oeuvre les outils', 'Capacité à appliquer les méthodes', 'Rigueur, organisation', 'Capacité d\'analyse', 'Esprit de synthèse', 'Aptitude à se documenter soi-même', 'Aptitude à rendre compte', 'Capacité à travailler en équipe', 'Sens des responsablités');

$pdf->SetFont('Times','B',12);
$pdf->SetTextColor(220,50,50);
$pdf->Cell(0,10,utf8_decode('~~ Critère personnel et comportemental ~~'),0,1);

// AFFICHAGE EN-TÊTE DU TABLEAU
// Position ordonnée de l'entête en valeur absolue par rapport au sommet de la page (70 mm)
$position_entete = 55;
// police des caractères
$pdf->SetFont('Times','',9);
$pdf->SetTextColor(0);
// on affiche les en-têtes du tableau
$pdf->entete_table($position_entete);
$position_detail = 63; // Position ordonnée = $position_entete+hauteur de la cellule d'en-tête (300+8)

for($i=1; $i<=5; $i++){
  // position abcisse de la colonne 1 (15mm du bord)
  //$pdf->SetY($position_detail);
  $pdf->SetX(15);
  $pdf->Cell(100,8,utf8_decode($tab_competences[$i-1]),1,0);
    // position abcisse de la colonne 2 (115 = 15 + 100)  
  //$pdf->SetY($position_detail);
  $pdf->SetX(115); 
  $pdf->Cell(50,8,utf8_decode($donnees['competence'.$i.'']),1,0,'C');
  $pdf->Ln();
  // on incrémente la position ordonnée de la ligne suivante (+8mm = hauteur des cellules)  
  $position_detail += 8;

}

$pdf->SetFont('Times','B',12);
$pdf->SetTextColor(220,50,50);
$pdf->Cell(0,15,utf8_decode('~~ Compétences ~~'),0,1);

// AFFICHAGE EN-TÊTE DU TABLEAU
// Position ordonnée de l'entête en valeur absolue par rapport au sommet de la page (70 mm)
$position_entete = 115;
// police des caractères
$pdf->SetFont('Times','',9);
$pdf->SetTextColor(0);
// on affiche les en-têtes du tableau
$pdf->entete_table($position_entete);
$position_detail = 123; // Position ordonnée = $position_entete+hauteur de la cellule d'en-tête (300+8)

for($i=6; $i<=13; $i++){
  // position abcisse de la colonne 1 (15mm du bord)
  //$pdf->SetY($position_detail);
  $pdf->SetX(15);
  $pdf->Cell(100,8,utf8_decode($tab_competences[$i-1]),1,0);
    // position abcisse de la colonne 2 (115 = 15 + 100)  
  //$pdf->SetY($position_detail);
  $pdf->SetX(115); 
  $pdf->Cell(50,8,utf8_decode($donnees['competence'.$i.'']),1,0,'C');
  $pdf->Ln();
  // on incrémente la position ordonnée de la ligne suivante (+8mm = hauteur des cellules)  
  $position_detail += 8;

}


$pdf->SetFont('Times','B',12);
$pdf->SetTextColor(220,50,50);
$pdf->Cell(0,15,utf8_decode('~~ Aptitude à remplir sa mission ~~'),0,1);

// AFFICHAGE EN-TÊTE DU TABLEAU
// Position ordonnée de l'entête en valeur absolue par rapport au sommet de la page (70 mm)
$position_entete = 200;
// police des caractères
$pdf->SetFont('Times','',9);
$pdf->SetTextColor(0);
// on affiche les en-têtes du tableau
$pdf->entete_table($position_entete);
$position_detail = 208; // Position ordonnée = $position_entete+hauteur de la cellule d'en-tête (300+8)

for($i=14; $i<=15; $i++){
  // position abcisse de la colonne 1 (15mm du bord)
  //$pdf->SetY($position_detail);
  $pdf->SetX(15);
  $pdf->Cell(100,8,utf8_decode($tab_competences[$i-1]),1,0);
    // position abcisse de la colonne 2 (115 = 15 + 100)  
  //$pdf->SetY($position_detail);
  $pdf->SetX(115); 
  $pdf->Cell(50,8,utf8_decode($donnees['competence'.$i.'']),1,0,'C');
  $pdf->Ln();
  // on incrémente la position ordonnée de la ligne suivante (+8mm = hauteur des cellules)  
  $position_detail += 8;

}

}

//$pdf->Cell(0,10,$remarques,0,1);
$pdf->Output();

}



?>
