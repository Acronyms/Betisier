<?php
  $db = new Mypdo();
  $manager = new PersonneManager($db);
  $manager->ajouterPersonne($_SESSION['nom'], $_SESSION['prenom'], $_SESSION['tel'], $_SESSION['mail'], $_SESSION['login'], $_SESSION['passwd']);

  $manager = new EtudiantManager($db);
  $manager->ajouterEtudiant($_POST['listerDepartements'], $_POST['listerAnnees']);
?>
  <!-- message de confirmation -->
<br/><img src="image/valid.png" alt="ImageValide" /> L'étudiant <b>"<?php echo $_SESSION['prenom']." ".$_SESSION['nom'] ?>"</b> a bien été ajouté

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
