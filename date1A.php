<?php

class Date{

	//récupération de tous les jours de l'année scolaire
	function recup($annee){
		$r = array();
		$date = strtotime($annee.'-08-01'); //le calendrier commence en août
		//strtotime --> le nombre de secondes depuis le 1er Janvier 1970 à 00:00:00 UTC

		//tant que la $date est inférieur à la date de fin
		//de août à août (annee scolaire)
		while(date('Y-m-d',$date) < ($annee+1).'-09-01'){ 

		$a = date('Y', $date); //année
		$m = date('n', $date); //mois
		$j = date('j', $date); //jour
		//les jours de la semaine 'w' sont compris entre 0 et 6
		//0 : dimanche et 6 : samedi
		//ici on remplace le 0 par un 7
		$s = str_replace('0','7',date('w',$date)); //semaine
		$r[$a][$m][$j] = $s;
		//on incrémente la $date d'un jour
		$date = strtotime(date('Y-m-d',$date).' +1 DAY'); 
		//autre méthode : $date = $date + 24 * 3600;

		}
		return $r;
	}

}


	$date = new Date(); //initialise l'objet
	$annee = 2020;
	$dates = $date->recup($annee); //la fonction recup retourne un tableau que l'on stocke dans la variable $dates

	//tableaux des mois et des jours de la semaine
    $Mois = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
    $Jours = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');


	function afficherCalendrier($n, $y){

	$date = new Date(); //initialise l'objet
	$annee = 2020;
	$dates = $date->recup($annee);
	$Mois = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
    $Jours = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');

    $db = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    //lancement de la requête
    $requete = $db->prepare('SELECT * FROM calendriers');
    $requete->execute();
    while($data1 = $requete->fetch())
    {
      $nom = strrchr($data1['1A'], '/');
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

		foreach ($dates as $A=>$datesA): if($A==$y){ 
			foreach ($datesA as $M=>$datesAM): if($M==$n){ 
				echo '<table class="table table-bordered">
						<thead>
							<tr>';
								foreach ($Jours as $j): 
									echo '<th>'.$j.'</th>';
								endforeach; 
							echo '</tr>
						</thead>
						<tbody>
							<tr>';
								$dernier_jour = end($datesAM);
								foreach ($datesAM as $J=>$datesAMJ):
									if($J == 1 and $datesAMJ != 1):
									echo '<td colspan="'.($datesAMJ-1).'" class="padding"></td>';
									endif; 

									echo '<td';

    								$o = 0;
    								$o2 = 0;
    								$o3 = 0;
    								$o4 = 0;

    								//de 1 jusqu'à la derniere ligne du fichier
								    for($p=1; $p < $nb_ligne;$p++){
								    $date1 = $tab[$p][1];
								    $date2 = $tab[$p][2];
								    $periode = DateTime::createFromFormat('Y-n-j', ($A.'-'.$M.'-'.$J));
									$debut = DateTime::createFromFormat('Y-m-d', $date1);
									$fin = DateTime::createFromFormat('Y-m-d', $date2);

									if(substr($tab[$p][0], 2)=="IUT"){
										//$numero = substr($tab[$p][0], 0, 1);
										if ($periode >= $debut && $periode <= $fin)
										{#fea347#e2ccba
										  echo ' style="background-color:#dcc8b9" onclick="location.href=\'Periode_IUT.php?date1='.$date1.'&&date2='.$date2.'\'" ';
										}
									}
									else{
										$semestre = substr($tab[$p][0], -2);//récupère le semestre

										if ($periode >= $debut && $periode <= $fin)
										{#806D5A
										  echo ' style="background-color:#cee1b2" onclick="location.href=\'Periode_Entreprise_'.$semestre.'.php?date1='.$date1.'&&date2='.$date2.'\'" ';
										}

									}#D3D3D3#856D4D
								    }#f0d19e#e0cda9

									

									echo '>';
									if($J == date('j') && $M == date('n') && $A == date('Y')){ echo '<b>';}
									echo $J;
									if($J == date('j') && $M == date('n') && $A == date('Y')){ echo '</b>';}
									echo '</td>';

									if($datesAMJ == 7): 
									echo '</tr><tr>';
									endif;
							    endforeach;
								if($dernier_jour != 7):
									echo '<td colspan="'.(7-$dernier_jour).'" class="padding"></td>';
								endif; 
							echo '</tr>
						</tbody>
					</table>';
	 } endforeach; 
	 } endforeach; 

	}

?>