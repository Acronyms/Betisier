<h1>Recherche de citation(s)</h1>
<?php

$num='%';
$dateUn="0000-01-01";
$dateDeux=date("Y-m-d");
$noteUn=0;
$noteDeux=20;

if(!empty($_POST['listerEnseignant']))
{
  $num=$_POST['listerEnseignant'];
}

if(!empty($_POST['dateUn']))
{
  $dateUn=getEnglishDate($_POST['dateUn']);
}

if(!empty($_POST['dateDeux']))
{
  $dateDeux=getEnglishDate($_POST['dateDeux']);
}

if(isset($_POST['note']))
{
  $noteUn=$_POST['note'];
}

if(isset($_POST['noteUn']))
{
  $noteDeux=$_POST['noteDeux'];
}

$db = new Mypdo();
$managerC = new CitationManager($db);
$managerP = new PersonneManager($db);

$listeCitation = $managerC->getListeCitationsTri($num, $dateUn, $dateDeux);

if(!empty($listeCitation))
{?>
  <p>Les citations suivantes correspondent à vos critères</p>
  <table class="tableCli">
    <tr class="hautTableau">
      <td><b>Nom de l'enseignant </b></td>
      <td><b>Libellé</b></td>
      <td><b>Date</b></td>
      <td><b>Moyenne des notes</b></td>
    </tr><?php

  foreach($listeCitation as $citation)
  {
    $numCitation = $citation->getNumCit();
    if($managerC->isCitationValide($numCitation))
    {
      $numPersonne = $citation->getNumPers();
      $moyenneCit=$managerC->getMoyenneCitationNum($numCitation);
      //si noteUn vide ET noteDeux vide -> TOUT AFFICHER
      //si noteUn non-vide ET noteDeux vide -> AFFICHER >= noteUn
      //si noteUn vide ET noteDeux non-vide -> AFFICHER <= noteDeux
      //si noteUn non-vide ET noteDeux non-vide -> AFFICHER >= noteUn ET <= noteDeux
      //pour les 3 derniers cas, on accepte pas les citations sans moyenne
      if( (empty($_POST['noteUn']) && empty($_POST['noteDeux'])) ||
          (((empty($_POST['noteDeux']) && $moyenneCit>=$_POST['noteUn']) ||
          (empty($_POST['noteUn']) && $moyenneCit<=$_POST['noteDeux']) ||
          (!empty($_POST['noteUn']) && empty($_POST['noteUn']) && ($moyenneCit>=$_POST['noteUn'] && $moyenneCit<=$_POST['noteDeux']))) && is_numeric($moyenneCit)) )
      {
        $personne = $managerP->getPersonneById($numPersonne);?>
        <tr>
          <td> <?php echo $personne->per_prenom." ".$personne->per_nom; ?> </td>
          <td> <?php echo $citation->getNomCitation(); ?> </td>
          <td> <?php echo getFrenchDate($citation->getDateCitation()) ; ?> </td>
          <td> <?php 	if(!is_numeric($moyenneCit))
                      {
                        echo "N/A";
                      }
                      else
                      {
                        echo $moyenneCit;
                      }?>
          </td>
        </tr>
         <?php
      }
    }
  }
}
else
{?>
  <img src="image/erreur.png" alt="Erreur" /> Pas de citation pour ces critères <br/><br/>
  <a href="index.php?page=60" class="bouton">Réessayer</a><?php
}?>
</table>
