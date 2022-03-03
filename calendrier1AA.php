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

<style type="text/css">

td  {
  text-align:center;
  vertical-align:middle
  border:2px ,solid, black; }

tr  {
  text-align:center;
  vertical-align:middle; }

</style>


</head>


<body>

<?php

	include 'barre_de_navigation_connecte.php';
	include('date1AA.php');
	$annee = 2020;
	$Mois = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
	$_SESSION['annee_calendrier']='1AA';

?>

<?php
	if (isset($_POST['precedent'])==True) {
	$n = $_POST['n'];
	$y = $_POST['y'];

	$n--;

		if ($n < 1) {
			$y--;
			$n = 12;
		}

}elseif (isset($_POST['suivant'])==True) {
	$n = $_POST['n'];
	$y = $_POST['y'];
	
	$n++;

		if ($n > 12) {
			$y++;
			$n = 1;
		}

}else{
	$n = date('n');  //mois actuel
	$y = date('Y');  //année actuelle
}



?>

<div class="container">
	<div class="row">
		<div class="col-12">
			<br>
			<h3 class="text-center">Calendrier <?php echo $annee.' - '.($annee+1); ?></h3>
			<br>



<form action="" method="post">
<input type="hidden" name="n" value="<?php echo $n; ?>">
<input type="hidden" name="y" value="<?php echo $y; ?>">


<?php if ($n <= 8 && $y <= $annee) {}else { ?>
<button class="btn btn-outline-dark" type="submit" name="precedent">Précédent</button>
<?php } ?>

<?php if ($n >= 8 && $y >= ($annee+1)) {}else { ?>
<div class="float-right">
<button class="btn btn-outline-dark" type="submit" name="suivant">Suivant</button>
</div>
<?php } ?>
</form>


<h3 class="text-warning text-center"><?php echo $Mois[($n-1)].' '.$y; ?></h3>

		
<br><br>
 <?php
afficherCalendrier($n, $y);
?>

<br>
<p>Cliquez sur une des périodes du tableau pour accéder à la page correspondante.</p>
<br>


</div>
</div>
</div>
<?php
    include ("Pied_de_page.php");
  ?>
</body>
</html>