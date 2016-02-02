<?php
  $db = new Mypdo();
  $managerP = new PersonneManager($db);
  $managerS = new SalarieManager($db);

  //ajout de la personne avec les paramètres entrés
  $managerP->ajouterPersonne($_SESSION['nom'], $_SESSION['prenom'], $_SESSION['tel'], $_SESSION['mail'], $_SESSION['login'], $_SESSION['passwd']);
  $managerS->ajouterSalarie($_POST['telpro'], $_POST['listerFonctions']);
?>
<!-- message de confirmation -->
<br/><img src="image/valid.png" alt="ImageValide" /> Le salarié <b>"<?php echo $_SESSION['prenom']." ".$_SESSION['nom'] ?>"</b> a bien été ajouté

<?php
//désinitialisation des variables de session utilisées
  unset($_SESSION['nom']);
  unset($_SESSION['prenom']);
  unset($_SESSION['tel']);
  unset($_SESSION['mail']);
  unset($_SESSION['login']);
  unset($_SESSION['passwd']);
  unset($_SESSION['LAST_ID_PERSONNE']);
 ?>
