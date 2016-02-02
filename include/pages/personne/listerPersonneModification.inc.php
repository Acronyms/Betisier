<h1>Modifier une personne enregistrée</h1>
<?php
	$db = new Mypdo();
	$managerP = new PersonneManager($db);
?>
<!-- listage des personnes pour modification -->
<p>Actuellement <?php echo $managerP->getNbPersonnes()->nbPersonnes;?> personne(s) sont enregistrées </p>

<table class="tableCli">
	<tr class="hautTableau">
		<td><b>Nom				</b></td>
		<td><b>Prenom			</b></td>
		<td><b>Modifier		</b></td>
	</tr>
	<?php
	$listePersonnes = $managerP->getList();

	foreach($listePersonnes as $personne)
	{?>
		<tr>
			<td> <?php echo $personne->getNomPers() ; ?> </td>
			<td> <?php echo $personne->getPrenomPers() ; ?> </td>
			<td> <a href="index.php?page=105&personne=<?php echo $personne->getNumPers();?>"><img src="image/modifier.png" alt="modifier" title="Cliquez pour modifier la personne"/><a> </td>
		</tr> <?php
	} ?>
</table>


<?php
