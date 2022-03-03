<?php
session_start();
if(isset($_POST['username']) && isset($_POST['password']))
{
    // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour éliminer toute attaque de type injection SQL et XSS
    //$username = mysqli_real_escape_string($db, htmlspecialchars($_POST['username']));
    $username = $_POST['username'];

    //$password = mysqli_real_escape_string($db,htmlspecialchars($_POST['password']));
    $password = $_POST['password'];
    
    if($username !== "" && $password !== "")
    {
        // connexion à la base de données
        $db = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

        //recherche dans la table des alternants
        $requetea = $db->prepare('SELECT * FROM alternant where Identifiant = ?');
        $requetea->execute(array($username));
        while($reponsea = $requetea->fetch())
        {
          $reponse=$reponsea;
        }
        $requetea->closeCursor();

        //recherche dans la table des tuteurs
        $requete2a = $db->prepare('SELECT * FROM tuteur where Identifiant = ?');
        $requete2a->execute(array($username));
        while($reponse2a = $requete2a->fetch())
        {
          $reponse2=$reponse2a;
        }
        $requete2a->closeCursor();

        //recherche dans la table des enseignants
        $requete3a = $db->prepare('SELECT * FROM enseignant where Identifiant = ?');
        $requete3a->execute(array($username));
        while($reponse3a = $requete3a->fetch())
        {
          $reponse3=$reponse3a;
        }
        $requete3a->closeCursor();

        //recherche dans la table des administrateurs
        $requete4a = $db->prepare('SELECT * FROM administrateur where Identifiant = ?');
        $requete4a->execute(array($username));
        while($reponse4a = $requete4a->fetch())
        {
          $reponse4=$reponse4a;
        }
        $requete4a->closeCursor();


        //recherche dans la table des superviseurs
        $requete5a = $db->prepare('SELECT * FROM superviseur where Identifiant = ?');
        $requete5a->execute(array($username));
        while($reponse5a = $requete5a->fetch())
        {
          $reponse5=$reponse5a;
        }
        $requete5a->closeCursor();


          if ((password_verify($password, $reponse['Mot_de_passe']))==True) {
          
          $_SESSION['Identifiant'] = $username;
           $_SESSION['ID_alternant']=$reponse['ID_alternant'];
           $_SESSION['ID_tuteur']=$reponse['ID_tuteur'];
           $_SESSION['ID_enseignant']=$reponse['ID_enseignant'];
           $_SESSION['statut']='alternant';
           $_SESSION['Annee']=$reponse['Annee'];
           $_SESSION['temps']=time();
           $_SESSION['Validation_reglement']=$reponse['Validation_reglement'];

           $date = date('Y-m-d');
           $heure = date('H:i:s');
           $ip = $_SERVER['REMOTE_ADDR'];

           $log = $db->prepare('INSERT INTO logs (Identifiant, Date1, Heure, Adresse_IP) VALUES (?, ?, ?, ?)');
           $log->execute(array($username, $date, $heure, $ip));

           if($_SESSION['Validation_reglement']==NULL){
              header('Location: Page_de_réglementation_des_absences.php');
           }else{
            header('Location: Compteutilisateur_alternant.php');
           }
        }
        
        
          elseif((password_verify($password, $reponse2['Mot_de_passe']))==True) // nom d'utilisateur et mot de passe correctes
        {
           $_SESSION['Identifiant'] = $username;
           $_SESSION['ID_tuteur']=$reponse2['ID_tuteur'];

           $base2 = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
           $requete2 = $base2->prepare('SELECT * FROM alternant  WHERE ID_tuteur=?');
           $requete2->execute(array($_SESSION['ID_tuteur']));
           while($data2 = $requete2->fetch())
           {
              $_SESSION['dataalt']=$data2;
           }
           $requete2->closeCursor();
           
           $_SESSION['statut']='tuteur';
           $_SESSION['temps']=time();
           $_SESSION['Validation_reglement']=$reponse2['Validation_reglement'];

           $date = date('Y-m-d');
           $heure = date('H:i:s');
           $ip = $_SERVER['REMOTE_ADDR'];

           $log = $db->prepare('INSERT INTO logs (Identifiant, Date1, Heure, Adresse_IP) VALUES (?, ?, ?, ?)');
           $log->execute(array($username, $date, $heure, $ip));

           if($_SESSION['Validation_reglement']==NULL){
              header('Location: Page_de_réglementation_des_absences.php');
           }else{
              header('Location: Compteutilisateur_tuteur.php');
            }
        }
        

          elseif((password_verify($password, $reponse3['Mot_de_passe']))==True) // nom d'utilisateur et mot de passe correctes
        {
           $_SESSION['Identifiant'] = $username;
           $_SESSION['ID_enseignant']=$reponse3['ID_enseignant'];

           $base3 = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
           $requete3 = $base3->prepare('SELECT * FROM alternant  WHERE ID_enseignant=?');
           $requete3->execute(array($_SESSION['ID_enseignant']));
           while($data3 = $requete3->fetch())
           {
             $_SESSION['dataalt']=$data3;
           }
           $requete3->closeCursor();
           
           $_SESSION['statut']='enseignant';
           $_SESSION['temps']=time();
           $_SESSION['Validation_reglement']=$reponse3['Validation_reglement'];

           $date = date('Y-m-d');
           $heure = date('H:i:s');
           $ip = $_SERVER['REMOTE_ADDR'];

           $log = $db->prepare('INSERT INTO logs (Identifiant, Date1, Heure, Adresse_IP) VALUES (?, ?, ?, ?)');
           $log->execute(array($username, $date, $heure, $ip));

           if($_SESSION['Validation_reglement']==NULL){
              header('Location: Page_de_réglementation_des_absences.php');
           }else{
              header('Location: Compteutilisateur_enseignant.php');
            }
        }


          elseif((password_verify($password, $reponse4['Mot_de_passe']))==True) // nom d'utilisateur et mot de passe correctes
        {
           $_SESSION['Identifiant'] = $username;
           $_SESSION['ID_administrateur']=$reponse4['ID_administrateur'];

           $base4 = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
           $requete4 = $base4->prepare('SELECT * FROM alternant ORDER BY ID_alternant');
           $requete4->execute(array($_SESSION['ID_alternant']));
           while($data4 = $requete4->fetch())
           {
             $_SESSION['dataalt']=$data4;
           }
           $requete4->closeCursor();
           
           $_SESSION['statut']='administrateur';
           $_SESSION['temps']=time();
           $_SESSION['Validation_reglement']=$reponse4['Validation_reglement'];

           $date = date('Y-m-d');
           $heure = date('H:i:s');
           $ip = $_SERVER['REMOTE_ADDR'];

           $log = $db->prepare('INSERT INTO logs (Identifiant, Date1, Heure, Adresse_IP) VALUES (?, ?, ?, ?)');
           $log->execute(array($username, $date, $heure, $ip));

           if($_SESSION['Validation_reglement']==NULL){
              header('Location: Page_de_réglementation_des_absences.php');
           }else{
            header('Location: Compteutilisateur_administrateur.php');
          }
        }
        

          elseif((password_verify($password, $reponse5['Mot_de_passe']))==True) // nom d'utilisateur et mot de passe correctes
        {
           $_SESSION['Identifiant'] = $username;
           $_SESSION['ID_superviseur']=$reponse5['ID_superviseur'];

           $base5 = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
           $requete5 = $base5->prepare('SELECT * FROM alternant  WHERE ID_superviseur=? OR ID2_superviseur=?');
           $requete5->execute(array($_SESSION['ID_superviseur'], $_SESSION['ID_superviseur']));
           while($data5 = $requete5->fetch())
           {
             $_SESSION['dataalt']=$data5; 
           }
           $requete5->closeCursor();
           
           $_SESSION['statut']='superviseur';
           $_SESSION['temps']=time();
           $_SESSION['Validation_reglement']=$reponse5['Validation_reglement'];

           $date = date('Y-m-d');
           $heure = date('H:i:s');
           $ip = $_SERVER['REMOTE_ADDR'];

           $log = $db->prepare('INSERT INTO logs (Identifiant, Date1, Heure, Adresse_IP) VALUES (?, ?, ?, ?)');
           $log->execute(array($username, $date, $heure, $ip));

           if($_SESSION['Validation_reglement']==NULL){
              header('Location: Page_de_réglementation_des_absences.php');
           }else{
              header('Location: Compteutilisateur_superviseur.php');
            }
        }else
        {
           header('Location: Page_de_connexion.php?erreur=1'); // utilisateur ou mot de passe incorrect
        }
        
    }
    else
    {
       header('Location: Page_de_connexion.php?erreur=2'); // utilisateur ou mot de passe vide
    }
}
else
{
   header('Location: Page_de_connexion.php');
}

?>