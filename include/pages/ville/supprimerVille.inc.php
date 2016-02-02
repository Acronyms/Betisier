<?php
	$db=new Mypdo();
	$managerV= new VilleManager($db);
?>
<h1>Supprimer une ville</h1>
<p>Actuellement <?php echo $managerV->getNbVilles()->nbVilles; ?> villes sont enregistrées</p>

<!-- tableau des villes enregistrées -->
<table class="tableCli">
	<tr class="hautTableau">
		<td>Numéro</td>
		<td>Nom</td>
		<td>Supprimer</td>
	</tr>

	<?php
	$listeVilles=$managerV->getVilles();
	foreach ($listeVilles as $ville)
	{?>
		<tr>
			<td> <?php echo $ville->getNumVille(); ?> </td>
			<td> <?php echo $ville->getNomVille(); ?> </td>
			<td> <a href="index.php?page=127&ville=<?php echo $ville->getNumVille();?>"><img src="image/erreur.png" alt="Supprimer" title="Cliquez pour supprimer la ville" /><a> </td>
		</tr><?php
	}?>
</table>
