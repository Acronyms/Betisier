<h1>Supprimer une ville</h1>
<?php
$db=new Mypdo();
$managerP= new PersonneManager($db);
$managerV= new VilleManager($db);
$managerVo= new VoteManager($db);
$managerC = new CitationManager($db);
$managerE = new EtudiantManager($db);
$managerDe = new DepartementManager($db);
$managerDi = new DivisionManager($db);

if($managerV->isVille($_GET['ville'])) //si id ville existe
{
  $nomVille=$managerV->getNomVilleIdVille($_GET['ville']); //recuperation du nom de la ville

  //on recupere la liste des departements correspondant à la ville
  $listeDepartements=$managerDe->getDepartementIdVille($_GET['ville']);
  if(!empty($listeDepartements))
  {
    foreach($listeDepartements as $departement)
    {
      //on recupere la liste des etudiants correspondant au departement
      $listeEtudiant=$managerE->getEtudiantIdDepartement($departement->getDepNum());
      if(!empty($listeEtudiant))
      {
        foreach($listeEtudiant as $etudiant)
        {
          //on recupere la liste des citations correspondant à l'étudiant
          $listeCit=$managerC->getCitationIdEtudiant($etudiant->getNumPers());
          foreach($listeCit as $citation)
          {
            supprimerVoteEtCitation($citation->getNumCit());
          }
          //suppression des votes restants (pour citations entrées par un autre etudiant)
          $managerVo->supprimerVoteIdPersonne($etudiant->getNumPers());

          //suppression de l'etudiant
          $managerE->supprimerEtudiant($etudiant->getNumPers());

          //suppression de la personne
          $managerP->supprimerPersonne($etudiant->getNumPers());
        }
      }
    }
  }

  //suppression de tous les departements correspondant à la ville
  $managerDe->supprimerDepartementIdVille($_GET['ville']);

  //suppression de la ville
  $managerV->supprimerVille($_GET['ville']);
  ?>

  <!-- message de confirmation -->
  <img src="image/valid.png" alt="ImageValide" />
  La ville <b>"<?php echo $nomVille; ?>"</b> a bien été supprimée !<?php
}
else //si le numero de la ville n'existe pas (entrée par URL)
{?>
  <h2>Erreur 404: Ville non trouvée</h2><?php
}
