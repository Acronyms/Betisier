<h1>Recherche de citation(s)</h1>
<?php
$db = new Mypdo();
$managerS = new SalarieManager($db);
$listeSalaries = $managerS->getListeSalarie();?>

<div class="divCentre">
	<form action="index.php?page=65" name="rechercheCit" method="post">
		<div class="texteFormulaire">
			<p>Nom de l'enseignant :</p>
			<p>Date :</p>
			<p>Note :</p>
		</div>

		<!-- choix du salarie ayant exprimé la citation -->
		<div class="champsFormulaire">
			<select class="zoneTexte" name="listerEnseignant">
				<option value="">-</option><?php
				foreach ($listeSalaries as $salarie)
				{ echo "\n";?>
					<option value="<?php echo $salarie->getNumPers(); ?>"><?php echo $salarie->getNomPers();?></option><?php
				}?>
			</select>

			<div class="aligne">
				<!-- saisie de la date minimale de la citation -->
				DU <input id="minAndMax" class="zoneTexte" name="dateUn" size="9" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])/(0[1-9]|1[012])/[0-9]{4}" type="text">
				<!-- saisie de la date maximale de la citation -->
				AU <input id="minAndMax" class="zoneTexte" name="dateDeux" size="9" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])/(0[1-9]|1[012])/[0-9]{4}" type="text">
			</div>

			<div class="aligne">
				<!-- choix note minimale -->
				DE
				<select class="zoneTexte" name="noteUn">
					<option value="">-</option><?php
					for ($i=0; $i <= 20 ; $i++)
					{echo "\n";?>
						<option value="<?php echo $i ?>"><?php echo $i ?></option><?php
					}echo "\n";  ?>
				</select>

				<!-- choix note maximale -->
				A
				<select class="zoneTexte" name="noteDeux">
					<option value="">-</option><?php
					for ($i=0; $i <= 20 ; $i++)
					{echo "\n";?>
						<option max="5" value="<?php echo $i ?>"><?php echo $i ?></option><?php
					}echo "\n"; ?>
				</select>
			</div>

		</div>
		<input class="bouton" type="submit" value="Valider">
	</form>
</div>

<script>
	datepickr('#minAndMax', {
		dateFormat: 'd/m/Y',
		minDate: 0, //date minimale selectionnable
		maxDate: new Date().getTime(), //date maximale selectionnable
	});
</script>
<!-- SCRIPT POUR SAISIR LA DATE PAR CALENDRIER (Voir copyrights dans /js/datepickr.js)-->
