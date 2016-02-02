<?php
  $db = new Mypdo();
  $managerP = new PersonneManager($db);
?>

<h1>Supprimer une personnes enregistrée</h1>
<p>Actuellement <?php echo $managerP->getNbPersonnes()->nbPersonnes;?> personne(s) sont enregistrées </p>

<!-- liste des personnes enregistrées -->
<table class="tableCli">
  <tr class="hautTableau">
    <td><b>Nom				</b></td>
    <td><b>Prenom			</b></td>
    <td><b>Supprimer	</b></td>
  </tr>
  <?php
  $listePersonnes = $managerP->getList();
  foreach($listePersonnes as $personne)
  {?>
    <tr>
      <td> <?php echo $personne->getNomPers() ; ?> </td>
      <td> <?php echo $personne->getPrenomPers() ; ?> </td>
      <td> <a href="index.php?page=125&personne=<?php echo $personne->getNumPers();?>"><img src="image/erreur.png" alt="supprimer" title="Cliquez pour supprimer la personne"/><a> </td>
    </tr> <?php
  } ?>
</table>
