<?php
	$db = new Mypdo();
	$managerC = new CitationManager($db);
	$managerP = new PersonneManager($db);
	$managerV = new VoteManager($db);
?>

<h1>Valider une citation</h1>
<table class="tableCli">
	<tr class="hautTableau">
		<td><b>Nom de l'enseignant 	</b></td>
		<td><b>Libellé							</b></td>
		<td><b>Date									</b></td>
		<td><b>Valider							</b></td>
	</tr>

	<!-- liste des citations non validées -->
	<?php
	$listeCitation = $managerC->getListeCitations();
	foreach($listeCitation as $citation)
	{
		$numCitation = $citation->getNumCit();
		if(!$managerC->isCitationValide($numCitation))
		{
			$numPersonne = $citation->getNumPers();
			$personne = $managerP->getPersonneById($numPersonne);
			?>
			<tr>
				<td> <?php echo $personne->per_prenom." ".$personne->per_nom; ?> </td>
				<td> <?php echo $citation->getNomCitation() ; ?> </td>
				<td> <?php echo getFrenchDate($citation->getDateCitation()) ; ?> </td>
				<td> <a href="index.php?page=115&citation=<?php echo $numCitation;?>"><img src="image/valid.png" alt="Valider" title="Cliquez pour valider la citation" /><a> </td>
			</tr> <?php
		}
	} ?>
</table>
