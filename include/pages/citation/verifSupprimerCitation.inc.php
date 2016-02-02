<h1>Supprimer une citation</h1>

<?php
$db = new Mypdo();
$managerP = new PersonneManager($db);
$managerC = new CitationManager($db);
$managerV = new VoteManager($db);

if(!$managerP->isAdminId($_SESSION['id'])) //il faut etre administrateur pour supprimer une citation
{?>
  <img src="image/erreur.png" alt="Erreur" /> Seul les <b>administrateurs</b> ont le droit de noter une citation <br/><br/>
  <a href="index.php?page=2" class="bouton">Retour aux citations</a><?php
}
else {
  if(!$managerC->getLibelleCitation($_GET['citation'])) //si la citation n'existe pas
  {?>
    <img src="image/erreur.png" alt="Erreur" /> La citation n'existe plus <br/><br/>
    <a href="index.php?page=2" class="bouton">Retour aux citations</a><?php
  }
  else //si l'utilisateur est un administrateur et que la citation existe
  {
    //on recupere le libelle de la citation pour l'afficher
    $libelle=$managerC->getLibelleCitation($_GET['citation'])->cit_libelle;

    //on supprime la citation et les votes associés
    supprimerVoteEtCitation($_GET['citation']);?>

    <!-- message de confirmation -->
    <img src="image/valid.png" alt="OK" /> La citation <b>"<?php echo $libelle; ?>"</b> a bien été supprimée <br/><br/>
    <a href="index.php?page=2" class="bouton">Retour aux citations</a><?php
  }
}
?>
