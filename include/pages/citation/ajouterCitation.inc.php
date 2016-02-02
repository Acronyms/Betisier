<?php
$db = new Mypdo();
$managerP = new PersonneManager($db);
$managerE = new EtudiantManager($db);
$managerC = new CitationManager($db);
$managerM = new MotManager($db);

//si premiere saisie de la citation
if((empty($_POST['listerEnseignants'])) && (empty($_POST['dateCit'])) && (empty($_POST['citation'])))
{?>
  <h1>Ajouter une citation</h1>
  <div class="divCentre" id="ajout">
    <form action="index.php?page=52" method="post" name="ajoutCit">
      <div class="texteFormulaire">
        <p>Enseignant :</p>
        <p>Date citation :</p>
        <p>Citation : </p>
      </div>

      <div class="champsFormulaire">
        <!-- liste deroulante de salaries -->
        <select class="zoneTexte" name="listerEnseignants"><?php
          $listePersonnes = $managerP->getList();
          foreach($listePersonnes as $personne)
          { echo "\n";
            if(!$managerE->isEtudiant($personne->getNumPers()))
            {?>
              <option value="<?php echo $personne->getNumPers() ; ?>"><?php echo $personne->getNomPers();?></option><?php
            }
          }?>
        </select>
        <!-- saisie de la date à laquelle la citation a été exprimée -->
        <input id="minAndMax" class="zoneTexte" name="dateCit" size="10" type="text" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])/(0[1-9]|1[012])/[0-9]{4}" required><br/><br/>
        <textarea class="zoneTexte" name="citation"></textarea>
      </div>
      <input class="bouton" type="submit" value="Valider">
    </form>
  </div><?php
}
else //si premiere saisie echouée (mots interdits présents)
{
  if ($managerM->motsInterditsCitation($_POST['citation']))
  {
    $listeMotsInterdits=$managerM->motsInterditsCitation($_POST['citation']);
    $nouvelleCitation=$_POST['citation'];
    foreach($listeMotsInterdits as $mot)
    {
      $nouvelleCitation = str_replace($mot->getMotInterdit(), "---", $nouvelleCitation);
    }

    ?>
    <h1>Ajouter une citation</h1>
    <div class="divCentre" id="ajout">
      <form action="index.php?page=52" method="post" name="ajoutCit">
        <div class="texteFormulaire">
          <p>Enseignant :</p>
          <p>Date citation :</p>
          <p>Citation : </p>
        </div>

        <div class="champsFormulaire">
          <!-- liste deroulante de salaries -->
          <select class="zoneTexte" name="listerEnseignants"><?php
            $listePersonnes = $managerP->getList();
            foreach($listePersonnes as $personne)
            { echo "\n";
              if(!$managerE->isEtudiant($personne->getNumPers()))
              {
                if($personne->getNumPers()==$_POST['listerEnseignants']) //si salarie précedemment selectionné -> selected
                {?>
                  <option value="<?php echo $personne->getNumPers() ; ?>" selected><?php echo $personne->getNomPers();?></option><?php
                }
                else //sinon salarie précedemment selectionné -> non selected
                {?>
                  <option value="<?php echo $personne->getNumPers() ; ?>"><?php echo $personne->getNomPers();?></option><?php
                }
              }
            }?>
          </select>
          <!-- saisie de la date à laquelle la citation a été exprimée -->
          <input id="minAndMax" class="zoneTexte" name="dateCit" value="<?php echo $_POST['dateCit']; ?>" size="10" type="text" required><br/><br/>
          <textarea class="zoneTexte" name="citation"><?php echo $nouvelleCitation ;?></textarea>
        </div>
        <input class="bouton" type="submit" value="Valider">
      </form>
    </div>
    <?php
    //on liste les mots interdits sous le textarea
    foreach($listeMotsInterdits as $mot)
    {?>
      <img src="image/erreur.png" alt="Erreur" /> Le mot <b>"<?php echo $mot->getMotInterdit();?>"</b> n'est pas autorisé <br/><?php echo "\n";
    }echo "<br/>";
  }
  else //si pas de mot interdit
  {
    //on recupere la date au format mySQL
    $dateEng=getEnglishDate($_POST['dateCit']);

    //on ajoute la citation
    $managerC->ajouterCitation($_POST['listerEnseignants'], $_SESSION['id'], $_POST['citation'], $dateEng)?>
    <br/><img src="image/valid.png" alt="ImageValide" /> La citation a bien été ajoutée<?php
  }
}
?>

<script>
  datepickr('#minAndMax', {
    dateFormat: 'd/m/Y',
    minDate: 0, //date minimale selectionnable
    maxDate: new Date().getTime(), //date maximale selectionnable
  });
</script>
<!-- SCRIPT POUR SAISIR LA DATE PAR CALENDRIER (Voir copyrights dans /js/datepickr.js)-->
