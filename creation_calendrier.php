<!DOCTYPE html>
<html>
<head>
	<title>Calendrier</title>
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
			<h3 class="text-center"><i class="far fa-calendar-alt"></i>  Création d'un calendrier</h3>
			<br>

<p>Je souhaite créer un calendrier pour les : </p>

<form action="" method="post">
<div class="form-check">
   <input class="form-check-input" type="radio" name="annee" id="1A" value="1A" required>
   <label class="form-check-label" for="1A">
   <i class="far fa-calendar-alt"></i> 1ère année
   </label>
</div>
<div class="form-check">
   <input class="form-check-input" type="radio" name="annee" id="2A" value="2A" required>
   <label class="form-check-label" for="2A">
   <i class="far fa-calendar-alt"></i> 2ème année
   </label>
</div>
<div class="form-check">
   <input class="form-check-input" type="radio" name="annee" id="TRTE" value="TRTE" required>
   <label class="form-check-label" for="TRTE">
   <i class="far fa-calendar-alt"></i> TRTE
   </label>
</div>

<br>
<label>Nom du fichier (exemple : type_de_formartion-année_année) :</label>
<input type="text" name="nom" required>
<br>
<br>
<label>Année de la rentrée scolaire :</label>
<input type="number" name="annee_scolaire" min="2015" max="3000" required>
<br>
<br>
<label>Nombre de périodes IUT :</label>
<input type="number" name="iut" min="0" max="10" required>
<br>
<label>Nombre de périodes Entreprise :</label>
<input type="number" name="entreprise" min="0" max="10" required>
<br><br>
<div class="form-group">
      <label for="periode_debut" required>Par quelle période commence le calendrier ?</label>
      <select class="form-control" id="periode_debut" name="periode_debut" required>
      <option value="1" name="periode_debut">Période Entreprise</option>
      <option value="0" name="periode_debut">Période IUT</option>
</select>
</div>

<input type="submit" class="btn btn-outline-primary" name="valid" value="Afficher les périodes">
</form>

<br><br>


<?php
if(isset($_POST['valid'])==True){

	$annee = $_POST['annee'];
	$annee_scolaire = $_POST['annee_scolaire'];
	$p_iut = $_POST['iut'];
	$p_entreprise = $_POST['entreprise'];
	$debut = $_POST['periode_debut'];
	$nom = $_POST['nom'];

	$annee_debut = $annee_scolaire.'-08-01';
	$annee_fin = ($annee_scolaire+1).'-08-01';
	if($annee=='TRTE'){
		$annee_fin = ($annee_scolaire+1).'-11-01';
	}
	$max = max($p_iut,$p_entreprise);

	echo '<p>Veuillez entrer les dates de début de chaque période : </p><br>';

	echo '<form action="" method="post">';

	echo'<table style="border:2px solid black"  class="table table-bordered"><thead><tr>
					<th>Période</th>
					<th>Date de début</th>';
					if($annee!='TRTE'){
					echo '<th>Semestre</th>';}
						echo '</tr></thead>
				<tbody>';

	if($debut==0){
		
		for($i=1;$i<=$max;$i++){

			if($i>$p_iut){}else{
				echo '<tr><td><label>'.$i; if($i==1){echo 'ère';}else{echo 'ème';} echo ' période IUT : </label></td>';
				echo '<td><input type="date" id="iut'.$i.'" name="iut'.$i.'" value="'.date('Y-m-d').'" min="'.$annee_debut.'" 	max="'.$annee_fin.'"></td>';
				if($annee!='TRTE'){
				echo '<td></td>';}
				echo '</tr>';
			}
			if($i>=($p_entreprise+1)){}else{
				echo '<tr><td><label>'.$i;	if($i==1){echo 'ère';}else{echo 'ème';} echo ' période Entreprise : </label></td>';
				echo '<td><input type="date" id="e'.$i.'" name="e'.$i.'" value="'.date('Y-m-d').'" min="'.$annee_debut.'" max="'.$annee_fin.'"></td>';
				if($annee!='TRTE'){
				echo '<td>
				<div class="form-group">
						  <select class="form-control" id="Semestre'.$i.'" name="Semestre'.$i.'">';
						  	if($annee=='1A'){
						    echo '<option value="S1" name="Semestre'.$i.'">Semestre 1</option>
						    	<option value="S2" name="Semestre'.$i.'">Semestre 2</option>';}
						    if($annee=='2A'){
						    echo '<option value="S3" name="Semestre'.$i.'">Semestre 3</option>
						    	<option value="S4" name="Semestre'.$i.'">Semestre 4</option>';}
						  echo '</select>
						</div>
						</td>';}
						echo '</tr>';
			}
	}
	}else{
		
		for($i=1;$i<=$max;$i++){

			if($i>$p_entreprise){}else{
				echo '<tr><td><label>'.$i; if($i==1){echo 'ère';}else{echo 'ème';} echo ' période Entreprise : </label></td>';
				echo '<td><input type="date" id="e'.$i.'" name="e'.$i.'" value="'.date('Y-m-d').'" min="'.$annee_debut.'" max="'.$annee_fin.'"></td>';
				if($annee!='TRTE'){
				echo '<td>
				<div class="form-group">
						  <select class="form-control" id="Semestre'.$i.'" name="Semestre'.$i.'">';
						  	if($annee=='1A'){
						    echo '<option value="S1" name="Semestre'.$i.'">Semestre 1</option>
						    	<option value="S2" name="Semestre'.$i.'">Semestre 2</option>';}
						    if($annee=='2A'){
						    echo '<option value="S3" name="Semestree'.$i.'">Semestre 3</option>
						    	<option value="S4" name="Semestre'.$i.'">Semestre 4</option>';}
						  echo '</select>
						</div>
						</td>';}
						echo '</tr>';
			}
			if($i>=($p_iut+1)){}else{
				echo '<tr><td><label>'.$i; if($i==1){echo 'ère';}else{echo 'ème';} echo ' période IUT : </label></td>';
				echo '<td><input type="date" id="iut'.$i.'" name="iut'.$i.'" value="'.date('Y-m-d').'" min="'.$annee_debut.'" max="'.$annee_fin.'"></td>';
				if($annee!='TRTE'){
				echo '<td></td>';}
				echo '</tr>';
	}
	}
	}

	echo '<tr><td><label>Fin de la dernière période : </label></td>';
	echo '<td><input type="date" id="derniere_periode" name="derniere_periode" value="'.date('Y-m-d').'" min="'.$annee_debut.'" max="'.$annee_fin.'"></td>';
	if($annee!='TRTE'){
				echo '<td></td>';}
				echo '</tr>';
	echo '</tr></tbody></table><br>';

	echo '<input type="hidden" name="max" value="'.$max.'">';
	echo '<input type="hidden" name="debut" value="'.$debut.'">';
	echo '<input type="hidden" name="annee" value="'.$annee.'">';
	echo '<input type="hidden" name="p_iut" value="'.$p_iut.'">';
	echo '<input type="hidden" name="p_entreprise" value="'.$p_entreprise.'">';
	echo '<input type="hidden" name="nom" value="'.$nom.'">';
	echo '<input type="submit" class="btn btn-outline-primary" name="valid2" value="Créer un nouveau calendrier">';
	echo '<br>';
	echo '</form>';

}

if(isset($_POST['valid2'])==True){

$annee = $_POST['annee'];
$p_iut = $_POST['p_iut'];
$p_entreprise = $_POST['p_entreprise'];
$debut = $_POST['debut'];
$nom = $_POST['nom'];

$max = max($p_iut,$p_entreprise);

//ouvre ou créer le fichier si il n'existe pas en lecture et en écriture et place le curseur au début du fichier
$ouverture = fopen('data\\'.$nom.'.csv', 'w+');

$chaine = "";
$chaine .= $annee."\n";


if($debut==0){

for($i=1;$i<=$max;$i++){

			if($i>$p_iut){}else{
				$chaine .= $i."-IUT;".$_POST['iut'.$i.'']."\n";
			}
			if($i>=($p_entreprise+1)){}else{
				$chaine .= $i."-Entreprise";
				if($annee!='TRTE'){
					$chaine .= "-".$_POST['Semestre'.$i.''];
				}
				$chaine .= ";".$_POST['e'.$i.'']."\n";
			}
	}
}
else{

for($i=1;$i<=$max;$i++){

			if($i>$p_entreprise){}else{
				$chaine .= $i."-Entreprise";
				if($annee!='TRTE'){
					$chaine .= "-".$_POST['Semestre'.$i.''];
				}
				$chaine .= ";".$_POST['e'.$i.'']."\n";
			}
			if($i>=($p_iut+1)){}else{
				$chaine .= $i."-IUT;".$_POST['iut'.$i.'']."\n";
	}
	}

}

//écriture de $chaine dans le fichier
fwrite($ouverture, $chaine);
fclose($ouverture);

//lecture du fichier pour récupérer les dates de début de période afin de déterminer les dates de fin de périodes
if (($handle = fopen('data\\'.$nom.'.csv', "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
    	$tab[] = $data; //récupère les valeurs dans un tableau
    }
	fclose($handle);

    $fileLines = file('data\\'.$nom.'.csv');
    $nb_ligne = count($fileLines);
    $tab2[] = "";
	$update="";

    //de 1 jusqu'à la derniere ligne du fichier
    for($p=2; $p < $nb_ligne;$p++){
    	$date = $tab[$p][1];
    	$tab2[] .= date('Y-m-d', strtotime($date.' - 1 DAY')); //$tab2 contient les dates de fin des périodes
    }

    //ajoute $ab2 dans $tab
	for($p=1; $p < count($tab2);$p++){
    	$tab[$p][2] = $tab2[$p];
    }
    
    $tab[(count($tab)-1)][2] = $_POST['derniere_periode']; //ajout de la dernière période

    $ouvre = fopen('data\\'.$nom.'.csv',"w+");

    foreach ($tab as $element) {
    	fputcsv($ouvre, $element, ';');
	}

    fclose($ouvre);

	echo "<p class=\"text-success\"><i class=\"fas fa-check\"></i> Le calendrier a bien été créé !</p>";
}else{
	echo "<p class=\"text-danger\"><i class=\"fas fa-exclamation-triangle\"></i> Une erreur s\'est produite lors de la création du calendrier, veuillez recommencer !</p>";
}

}

?>

</div>
</div>
</div>
<br>
<?php include ("Pied_de_page.php"); ?>
</body>
</html>