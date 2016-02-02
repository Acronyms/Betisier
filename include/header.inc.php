<?php session_start();
$logo="";
?>

<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <?php
    $title = "Bienvenue sur le site du bétisier de l'IUT.";?>
    <title>
      <?php echo $title ?>
    </title>
    <link rel="stylesheet" type="text/css" href="css/stylesheet.css" />

    <!-- pour la saisie des dates avec un calendrier javascript -->
    <link rel="stylesheet" type="text/css" href="css/datepickr.css" />
    <script type="text/javascript" src="js/datepickr.js"></script>
  </head>

  <body>
    <div id="header">
      <div id="connect">
        <?php
        if(!isset($_SESSION['pseudo'])){ //Utilisateur non connecté
          $logo="lebetisier.png"; ?>
          <a href="index.php?page=5">Connexion</a><?php
        }
        else{ //Utilisateur connecté
          $logo="smile.png";?>
          <b>Utilisateur :</b> <?php echo $_SESSION['pseudo']."\n";  //on affiche le pseudo ?>
          <a href="index.php?page=50">| Deconnexion <img class="icone" title="Se déconnecter" src="image/quitter.png" alt="Déconnexion"/></a> <?php
        }?>
      </div>
      <div id="entete">
        <div id="logo">
          <img id="imLogo" src="image/<?php echo $GLOBALS['logo']; ?>" title="Logo du bêtisier" alt="logo" />
        </div>
        <div id="titre">
          Le bétisier de l'IUT,<br />Partagez les meilleures perles !!!
        </div>
      </div>
    </div>
