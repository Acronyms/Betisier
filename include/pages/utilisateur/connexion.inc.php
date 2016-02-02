<?php
  $rand1 = rand(1,9); //generation d'un chiffre aléatoire entre 1 et 9
  $rand2 = rand(1,9); //generation d'un chiffre aléatoire entre 1 et 9
  $img1=$rand1.".jpg"; //recupération de l'image correspondant au nombre généré
  $img2=$rand2.".jpg"; //recupération de l'image correspondant au nombre généré
  $_SESSION["resCaptcha"]=$rand1+$rand2;?>

<h1> Pour vous connecter </h1>
<div class="divCentre">
  <form action="index.php?page=15" method="post">
    <div class="texteFormulaire">
      <p>Nom d'utilisateur :</p>
      <p>Mot de passe :</p>
      <img class="captcha" <?php echo 'src="image/nb/'.$img1.'"'?> alt="ImageCaptcha" />
      +
      <img class="captcha" <?php echo 'src="image/nb/'.$img2.'"'?> alt="ImageCaptcha" />
      =
    </div>

    <div class="champsFormulaire">
      <input class="zoneTexte" type="text" name="pseudo" pattern="[a-zA-Z0-9-]+" title="L'identifiant doit etre composé de lettres et de chiffres seulement" placeholder="Pseudo" required>
      <input class="zoneTexte" type="password" name="passwd" pattern=".{3,}" title="Le mot de passe doit contenir au moins 3 caractères" placeholder="Mot de passe" required><br/>
      <input class="zoneTexte" type="text" name="reponseCaptcha" pattern="[0-9]+" title="Veuillez entrer un entier" placeholder="Reponse">
    </div>
    <input class="bouton" type="submit" value="Valider">
  </form>
</div>
