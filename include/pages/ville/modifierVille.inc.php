<h1> Modifier une ville</h1>
<?php
$db=new Mypdo();
$managerV= new VilleManager($db);

if(empty($_GET['ville']))
{?>
	<p>Actuellement <?php echo $managerV->getNbVilles()->nbVilles; ?> villes sont enregistrées</p>

	<!-- tableau des villes enregistrées -->
	<table class="tableCli">
		<tr class="hautTableau">
			<td>Numéro</td>
			<td>Nom</td>
			<td>Modifier</td>
		</tr>

		<?php
		$listeVilles=$managerV->getVilles();

		foreach ($listeVilles as $ville)
		{?>
			<tr>
				<td> <?php echo $ville->getNumVille(); ?> </td>
				<td> <?php echo $ville->getNomVille(); ?> </td>
				<td> <a href="index.php?page=70&ville=<?php echo $ville->getNumVille();?>"><img src="image/modifier.png" alt="Noter" title="Cliquez pour modifier la ville"/><a> </td>
			</tr><?php
		}?>
	</table><?php
}
else
{
	if($managerV->isVille($_GET['ville']))
	{
		$_SESSION['numVille']=$_GET['ville'];
		?>
		<div class="divCentre">
			<!-- formulaire de modification d'une ville d'une ville -->
			<form action="index.php?page=75" method="post">
				<div class="texteFormulaire">
					<p>Nom :</p>
				</div>

				<div class="champsFormulaire">
					<input class="zoneTexte" type="text" name="ville" value="<?php echo $managerV->getNomVilleIdVille($_GET['ville']); ?>" required>
				</div>
				<input class="bouton" type="submit" value="Valider">
			</form>
		</div>
		<?php
	}
	else//si le numero de la ville n'existe pas (entrée par URL)
	{?>
		<h2>Erreur 404: Ville non trouvée</h2><?php
	}
}
?>
