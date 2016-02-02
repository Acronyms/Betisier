<?php
$db = new Mypdo();
$manager = new PersonneManager($db);

if($_POST["reponseCaptcha"]==$_SESSION["resCaptcha"]) //si bonne reponse au captcha
{
  if($manager->isUtilisateur($_POST["pseudo"], $_POST["passwd"])) //si identifiants corrects
  {
    ?>
    <div>
      <img src="image/valid.png" alt="ImageValide" /> Vous avez bien été connecté
      <br/>
      Redirection automatique dans 2 secondes
      <?php header ("Refresh:2;URL=index.php?page=0");?>
    </div>
    <?php
    $_SESSION['pseudo']=$_POST["pseudo"];
    $_SESSION['id']=$manager->getIdPseudo($_POST["pseudo"])->per_num; //stockage de l'id et du login de la personne
  }
  else //si identifiants incorrects
  {?>
    <img src="image/erreur.png" alt="Erreur" /> Mauvais identifiant ou mot de passe <br/>
    <a href="index.php?page=5" class="bouton">Retour à la connexion</a>
    <?php
  }
}
else //si captcha incorrect
{?>
  <br/>
  <img src="image/erreur.png" alt="Erreur" /> Captcha incorrect <br/>
  <a href="index.php?page=5" class="bouton">Retour à la connexion</a>
  <?php
}

unset($_SESSION['resCaptcha']); //désinitialisation de la variable de captcha
?>
