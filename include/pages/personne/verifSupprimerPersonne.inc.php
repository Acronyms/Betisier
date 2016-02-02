<h1>Supprimer une personnes enregistrée</h1>
<?php $db = new Mypdo();
      $managerP = new PersonneManager($db);
      $managerC = new CitationManager($db);
      $managerE = new EtudiantManager($db);
      $managerS = new SalarieManager($db);
      $managerV = new VoteManager($db);
      $supprimer = TRUE;

//verification que l'id personne existe (au cas d'une URL tapée)
if($managerP->isPersonne($_GET['personne']))
{
  $personne=$managerP->getPersonneById($_GET['personne']);
  $prenom=$personne->per_prenom;
  $nom=$personne->per_nom;
  //on recupere le nom et le prenom de la personne pour affchage de confirmation

  //cas etudiant
  if($managerE->isEtudiant($_GET['personne']))
  {
    $listeCit=$managerC->getCitationIdEtudiant($_GET['personne']);
    foreach($listeCit as $citation)
    {
      supprimerVoteEtCitation($citation->getNumCit());
      //suppression des citations et des votes associés à l'étudiant
    }
    //suppression des votes restants (pour citations entrées par un autre etudiant)
    $managerV->supprimerVoteIdPersonne($_GET['personne']);

    //suppression de l'etudiant
    $managerE->supprimerEtudiant($_GET['personne']);
  }
  //cas salarie
  else {
    //cas administrateur
    if($managerP->isAdminId($_GET['personne']))
    {
      //on ne peut pas supprimer le derniere administrateur de la base de données
      if($managerP->nbAdmin() == 1)
      {?>
        <img src="image/erreur.png" alt="Erreur" /> Cette personne est le dernier administrateur, nous ne pouvez pas le supprimer <br/>
        <a href="index.php?page=120" class="bouton">Retour à la suppression de personne</a><?php
        $supprimer = FALSE;
      }
      else {
        //on recupere les citations validées par l'admin
        $listeCit=$managerC->getCitationIdAdmin($_GET['personne']);
        foreach($listeCit as $citation)
        {
          supprimerVoteEtCitation($citation->getNumCit());
        }
      }
    }

    //on recupere les citations exprimées par le salarié
    $listeCit=$managerC->getCitationIdSalarie($_GET['personne']);
    foreach($listeCit as $citation)
    {
      supprimerVoteEtCitation($citation->getNumCit());
    }
    //on supprime le salarié
    $managerS->supprimerSalarie($_GET['personne']);
  }

  if($supprimer) //si non dernier admin
  {
    //suppression de la personne
    $managerP->supprimerPersonne($_GET['personne']);?>

    <!-- message de confirmation -->
    <img src="image/valid.png" alt="ImageValide" />
    La personne <b>"<?php echo $prenom." ".$nom; ?>"</b> a bien été supprimée !<?php

    //si la personne supprimée est la personne connectée
    if($_SESSION['id']==$_GET['personne'])
    {
      session_destroy();
      ?><br/>
      <a href="index.php?page=0" class="bouton">Adieu !</a><?php
    }
  }

}
else //si le numero de la personne n'existe pas (entrée par URL)
{?>
  <h2>Erreur 404: Personne non trouvée</h2><?php
}
?>
