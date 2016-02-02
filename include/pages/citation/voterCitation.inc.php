<h1> Noter une citation </h1>

<?php $db = new Mypdo();
$managerP = new PersonneManager($db);
$managerE = new EtudiantManager($db);
$managerC = new CitationManager($db);
$managerV = new VoteManager($db);

$_SESSION['numCitation']=$_GET['citation'];
if(!$managerE->isEtudiant($_SESSION['id'])) //il faut etre etudiant pour valider une citation
{?>
  <img src="image/erreur.png" alt="Erreur" /> Seul les <b>étudiants</b> ont le droit de noter une citation <br/><br/>
  <a href="index.php?page=2" class="bouton">Retour aux citations</a><?php
}
else {
  if($managerV->aVote($_SESSION['numCitation'], $_SESSION['id'])) //si l'etudiant a deja voté pour cette citation
  {?>
    <img src="image/erreur.png" alt="Erreur" /> Vous avez déjà voté pour cette citation <br/><br/>
    <a href="index.php?page=2" class="bouton">Retour aux citations</a><?php
  }
  else {
    if($managerC->isCitationValide($_GET['citation'])) //on ne peut voter que pour une citation valide
    {?>
      <!-- libellé de la citation-->
      <p>Evaluez la citation : <b>"<?php echo $managerC->getLibelleCitation($_GET['citation'])->cit_libelle ?>"</b></p>
      <div class="divCentre" id="ajout">
        <form action="index.php?page=85" method="post" name="voteCitation">
          <div class="texteFormulaire">
            <p>Note :</p>
          </div>

          <!-- pour entrer la note à attribuer (entre 0 et 20) -->
          <div class="champsFormulaire">
            <select class="zoneTexte" name="noteCit"><?php
              for ($i=0; $i <= 20 ; $i++)
              {echo "\n";?>
                <option value="<?php echo $i ?>"><?php echo $i ?></option><?php
              } ?>
            </select>
          </div>
          <input class="bouton" type="submit" value="Valider">
        </form>
      </div><?php
    }
    else { //si le numero de la citation n'existe pas (ou si la citation a déja été supprimée) ?>
      <h2>Erreur 404: Citation non trouvée</h2><?php
    }
  }
}
