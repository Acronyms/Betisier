<h1>Modifier un salarié</h1>
<?php
$db = new Mypdo();
$managerP = new PersonneManager($db);
$managerE = new EtudiantManager($db);
$managerS = new SalarieManager($db);
//modification de la personne avec les paramètres entrés
$managerP->modifierPersonne($_SESSION['numPers'], $_SESSION['nom'], $_SESSION['prenom'], $_SESSION['tel'], $_SESSION['mail'], $_SESSION['login'], $_SESSION['passwd']);

if(!$managerE->isEtudiant($_SESSION['numPers']))
{
  //si on modifie un salarie en salarie
  $managerS->modifierSalarie($_SESSION['numPers'], $_POST['telpro'], $_POST['listerFonctions']);
}
else {
  //si on modifie un salarie en etudiant
  $managerE->supprimerEtudiant($_SESSION['numPers']);
  $managerS->ajouterSalarieId($_SESSION['numPers'], $_POST['telpro'], $_POST['listerFonctions']);
}?>
  <!-- message de confirmation -->
  <br/><img src="image/valid.png" alt="ImageValide" /> L'étudiant <b>"<?php echo $_SESSION['prenom']." ".$_SESSION['nom'] ?>"</b> a bien été modifié
<?php
  unset($_SESSION['numPers']);
  unset($_SESSION['nom']);
  unset($_SESSION['prenom']);
  unset($_SESSION['tel']);
  unset($_SESSION['mail']);
  unset($_SESSION['login']);
  unset($_SESSION['passwd']);
?>
