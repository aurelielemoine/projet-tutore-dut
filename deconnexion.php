<?php
   session_start();
   if (!isset($_SESSION['Identifiant']))
      {header ('Location: Page_de_connexion.php'); exit();}
   session_destroy();
   header("location:Page_de_connexion.php");
?>