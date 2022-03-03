<?php

if(isset($_POST['supprime'])==True){

$fichier = $_POST['fichier'];

$dirname = 'data'; 
$dir = opendir($dirname); 

while($file = readdir($dir)) {
	if($file==$fichier){
		unlink($dirname.'/'.$file);
	}
}

header('Location:modification_calendrier.php');

}

?>