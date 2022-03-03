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
			<h3 class="text-center"><i class="far fa-calendar-alt"></i>  Gestion des calendriers</h3>
			<br>
			<p>Glissez le fichier csv correspondant à une formation. Attention ! Chaque modification sera immédiate.</p>
			<br>
		</div>
	</div>
	<div class="row">
		<div class="col-6">
			<?php
			$dirname = 'data'; 
			$dir = opendir($dirname);

			while($file = readdir($dir)) {
			if($file != '.' && $file != '..' && !is_dir($dirname.$file)) 
			{
			echo '<form action="supprimer_calendrier.php" method="post">
			<a href="'.$dirname.'/'.$file.'">'.$file.'</a>
			--> 
			<input type="hidden" name="fichier" value="'.$file.'">
			<input type="submit" class="btn btn-outline-danger" name="supprime" value="Supprimer">
			</form>
			<br>'; 
			} 
			} 

			closedir($dir); 

			?>
		</div>
		<div class="col-6">
			<form action="modification_calendriers.php" method="post">
				<label>Calendrier des anciens 1ère année :</label>
				<input type="text" name="1AA">
				<br>
				<label>Calendrier des 1ère année :</label>
				<input type="text" name="1A">
				<br>
				<label>Calendrier des 2ème année :</label>
				<input type="text" name="2A">
				<br>
				<label>Calendrier des TRTE :</label>
				<input type="text" name="TRTE">
				<br>
				<br>
				<input type="submit" class="btn btn-outline-dark" name="valide" value="Enregistrer">
				<br>
				<?php
				if(isset($_GET['modif'])){
				                    $modif = $_GET['modif'];
				                    if($modif==1)
				                        echo "<br><p style='color:green'>Les modifications ont bien été prises en compte !</p>";
				                    if($modif==2)
				                        echo "<br><p style='color:red'>Aucune modification n'a été éffectuée !</p>";
				                }
				?>
			</form>
		</div>
	</div>
<br>
</div>
<br>
<?php include ("Pied_de_page.php"); ?>
</body>
</html>