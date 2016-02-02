<?php
	$db = new Mypdo();
	$managerC = new CitationManager($db);
	$managerP = new PersonneManager($db);
	$managerV = new VoteManager($db);
?>

<h1>Supprimer une citation</h1>
<p>Actuellement <?php echo $managerC->getNbCitationValide()->nbCitation;?> citation(s) enregistrée(s) </p>

<table class="tableCli">
	<tr class="hautTableau">
		<td><b>Nom de l'enseignant 	</b></td>
		<td><b>Libellé							</b></td>
		<td><b>Date									</b></td>
		<td><b>Moyenne des notes		</b></td>
		<td><b>Validée ?						</b></td>
		<td><b>Supprimer						</b></td>
	</tr>

	<!-- liste des citations -->
	<?php
	$listeCitation = $managerC->getListeCitations();
	foreach($listeCitation as $citation)
	{
		$numCitation = $citation->getNumCit();
		$numPersonne = $citation->getNumPers();
		$personne = $managerP->getPersonneById($numPersonne);
		$moyenneCit=$managerC->getMoyenneCitationNum($numCitation);
		?>
		<tr>
			<td> <?php echo $personne->per_prenom." ".$personne->per_nom; ?> </td>
			<td> <?php echo $citation->getNomCitation() ; ?> </td>
			<td> <?php echo getFrenchDate($citation->getDateCitation()) ; ?> </td>
			<td> <?php
				if(!is_numeric($moyenneCit)) //si pas de moyenne pour cette citation
				{
					echo "N/A";
				}
				else
				{
					echo $moyenneCit;
				}?>
			</td>
			<td><?php
				if(!$managerC->isCitationValide($numCitation)) //on indique si la citation a été validée ou non
				{?>
					<img src="image/erreur.png" alt="Non validee" /><?php
				}
				else
				{?>
					<img src="image/valid.png" alt="Validee" /><?php
				}?>
			</td>
			<td><a href="index.php?page=126&citation=<?php echo $numCitation;?>"><img src="image/erreur.png" alt="Supprimer" title="Cliquez pour supprimer la citation" /></a></td>
		</tr> <?php
	} ?>
</table>
