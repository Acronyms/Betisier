<?php
	$db = new Mypdo();
	$managerC = new CitationManager($db);
	$managerP = new PersonneManager($db);
	$managerV = new VoteManager($db);
?>
<h1>Liste des citations déposées</h1>
<p>Actuellement <?php echo $managerC->getNbCitationValide()->nbCitation;?> citation(s) enregistrée(s) </p>


<table class="tableCli">
	<tr class="hautTableau">
		<td><b>Nom de l'enseignant </b></td>
		<td><b>Libellé</b></td>
		<td><b>Date</b></td>
		<td><b>Moyenne des notes</b></td><?php
		if(isset($_SESSION['id']))
		{?>
			<td><b>Noter</b></td><?php
		}?>
	</tr>

	<?php
	$listeCitation = $managerC->getListeCitations();
	//on liste les citations validées
	foreach($listeCitation as $citation)
	{
		$numCitation = $citation->getNumCit();
		if($managerC->isCitationValide($numCitation))
		{
			$numPersonne = $citation->getNumPers();
			$personne = $managerP->getPersonneById($numPersonne);
			$moyenneCit=$managerC->getMoyenneCitationNum($numCitation);
			?>
			<tr bgcolor="#FFFF99">
				<td> <?php echo $personne->per_prenom." ".$personne->per_nom; ?>	</td>
				<td> <?php echo $citation->getNomCitation() ; ?> 									</td>
				<td> <?php echo getFrenchDate($citation->getDateCitation()) ; ?> 	</td>
				<td> <?php
				if(!is_numeric($moyenneCit)) //si pas de moyenne, on affiche "N/A"
				{
					echo "N/A";
				}
				else //sinon on affiche la moyenne
				{
					echo $moyenneCit;
				}?>
				</td><?php
				if(isset($_SESSION['id'])) //un utilisateur non connecté ne peut pas noter une citation
				{?>
					<td><?php
					if ($managerV->aVote($citation->getNumCit(), $_SESSION['id'])) //si l'utilisateur a déja voté pour une citation
					{
						?><img src="image/erreur.png" alt="Erreur" title="Vous avez déja noté cette citation !"/> <?php
					}
					else
					{
						?><a href="index.php?page=80&citation=<?php echo $numCitation;?>"><img src="image/modifier.png" alt="Noter" /><a><?php
					}?></td><?php
				}?>
			</tr> <?php
		}
	} ?>
</table>
