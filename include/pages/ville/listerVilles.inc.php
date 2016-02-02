<?php
	$db=new Mypdo();
	$manager= new VilleManager($db);
?>

<h1>Liste des villes</h1>
<p>Actuellement <?php echo $manager->getNbVilles()->nbVilles; ?> villes sont enregistrées</p>

<!-- tableau des villes enregistrées -->
<table class="tableCli">
	<tr class="hautTableau">
		<td>Numéro</td>
		<td>Nom</td>
	</tr>

	<?php
	$listeVilles=$manager->getVilles();
	foreach ($listeVilles as $ville)
	{?>
		<tr>
			<td> <?php echo $ville->getNumVille(); //id de la ville?> </td>
			<td> <?php echo $ville->getNomVille(); //nom de la ville?> </td>
		</tr><?php
	}?>
</table>
